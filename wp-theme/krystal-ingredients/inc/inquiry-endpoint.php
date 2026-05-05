<?php
/**
 * Front-end contact form — REST endpoint at /wp-json/kipl/v1/inquiry.
 *
 * - Accepts JSON or x-www-form-urlencoded POSTs.
 * - Validates fields, blocks honeypot fills, rate-limits per-IP via transient.
 * - Stores each submission as a `kipl_inquiry` post (admin-only) so the
 *   client can review every lead from inside WP Admin.
 * - Sends mail via wp_mail(); on Hostinger this routes through the box's
 *   default MTA. Drop in a plugin like WP Mail SMTP for higher deliverability.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ---------- Inquiry storage type (admin-only) ---------- */
function kipl_register_inquiry_cpt() {
    register_post_type( 'kipl_inquiry', [
        'labels' => [
            'name'         => __( 'Inquiries', 'krystal-ingredients' ),
            'singular_name'=> __( 'Inquiry', 'krystal-ingredients' ),
            'menu_name'    => __( 'Inquiries', 'krystal-ingredients' ),
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-email',
        'supports'            => [ 'title', 'editor', 'custom-fields' ],
        'capability_type'     => 'post',
        'capabilities'        => [ 'create_posts' => 'do_not_allow' ],
        'map_meta_cap'        => true,
        'exclude_from_search' => true,
    ] );
}
add_action( 'init', 'kipl_register_inquiry_cpt' );

/* ---------- Route registration ---------- */
function kipl_register_inquiry_route() {
    register_rest_route( 'kipl/v1', '/inquiry', [
        'methods'             => 'POST',
        'callback'            => 'kipl_handle_inquiry',
        'permission_callback' => '__return_true',
    ] );
}
add_action( 'rest_api_init', 'kipl_register_inquiry_route' );

/* ---------- Handler ---------- */
function kipl_handle_inquiry( WP_REST_Request $request ) {
    $clean = static function ( $value ) {
        if ( ! is_string( $value ) ) return '';
        return mb_substr( trim( wp_strip_all_tags( $value ) ), 0, 4000 );
    };

    $name        = $clean( $request->get_param( 'name' ) );
    $email       = $clean( $request->get_param( 'email' ) );
    $company     = $clean( $request->get_param( 'company' ) );
    $industry    = $clean( $request->get_param( 'industry' ) );
    $inquiryType = $clean( $request->get_param( 'inquiry_type' ) );
    $message     = $clean( $request->get_param( 'message' ) );
    $website     = $clean( $request->get_param( 'website' ) ); // honeypot

    /* Spam guard */
    if ( $website !== '' ) {
        return new WP_REST_Response( [ 'ok' => false, 'error' => 'Submission blocked.' ], 422 );
    }

    /* Field validation */
    $errors = [];
    if ( mb_strlen( $name ) < 2 )                $errors[] = 'Name is required.';
    if ( ! is_email( $email ) )                  $errors[] = 'A valid corporate email is required.';
    if ( $company === '' )                       $errors[] = 'Company is required.';
    if ( $industry === '' )                      $errors[] = 'Industry is required.';
    if ( $inquiryType === '' )                   $errors[] = 'Inquiry type is required.';
    if ( mb_strlen( $message ) < 10 )            $errors[] = 'Please share a few words about your inquiry.';

    if ( $errors ) {
        return new WP_REST_Response( [ 'ok' => false, 'error' => implode( ' ', $errors ) ], 422 );
    }

    /* Per-IP rate limit */
    $ip      = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : 'anon';
    $bucket  = 'kipl_rate_' . md5( $ip );
    if ( get_transient( $bucket ) ) {
        return new WP_REST_Response( [ 'ok' => false, 'error' => 'Please wait a moment before submitting again.' ], 429 );
    }
    set_transient( $bucket, 1, 30 );

    /* Reference + persistence */
    $reference = 'KIPL-' . strtoupper( wp_generate_password( 8, false, false ) );

    $post_id = wp_insert_post( [
        'post_type'   => 'kipl_inquiry',
        'post_status' => 'publish',
        'post_title'  => sprintf( '[%s] %s — %s', $reference, $company, $inquiryType ),
        'post_content' => $message,
        'meta_input'  => [
            'kipl_reference'    => $reference,
            'kipl_name'         => $name,
            'kipl_email'        => $email,
            'kipl_company'      => $company,
            'kipl_industry'     => $industry,
            'kipl_inquiry_type' => $inquiryType,
            'kipl_remote_addr'  => $ip,
        ],
    ], true );

    if ( is_wp_error( $post_id ) ) {
        return new WP_REST_Response( [ 'ok' => false, 'error' => 'Could not record inquiry.' ], 500 );
    }

    /* Notification email */
    $recipient = kipl_field( 'contact_email' ) ?: get_option( 'admin_email' );
    $brand     = get_bloginfo( 'name' );
    $subject   = sprintf( '[%s] %s — %s', $reference, $inquiryType, $company );

    $body  = "New inquiry received via " . home_url( '/' ) . "\n";
    $body .= "Reference: {$reference}\n";
    $body .= "Received:  " . current_time( 'D, d M Y H:i' ) . "\n";
    $body .= str_repeat( '-', 56 ) . "\n";
    $body .= "Name        : {$name}\n";
    $body .= "Email       : {$email}\n";
    $body .= "Company     : {$company}\n";
    $body .= "Industry    : {$industry}\n";
    $body .= "Inquiry     : {$inquiryType}\n";
    $body .= str_repeat( '-', 56 ) . "\n\n";
    $body .= "Message:\n{$message}\n\n";
    $body .= str_repeat( '-', 56 ) . "\n";
    $body .= "IP: {$ip}\n";

    $from    = sprintf( '%s <%s>', $brand, get_option( 'admin_email' ) );
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $from,
        'Reply-To: ' . sprintf( '%s <%s>', $name, $email ),
    ];

    wp_mail( $recipient, $subject, $body, $headers );

    /* Auto-responder */
    $auto_subject = 'We have received your inquiry — ' . $brand;
    $auto_body  = "Hello {$name},\n\n";
    $auto_body .= "Thank you for reaching out to {$brand}. Your inquiry has been received\n";
    $auto_body .= "and will be reviewed by our specialty chemistry team.\n\n";
    $auto_body .= "Reference number : {$reference}\n";
    $auto_body .= "Inquiry type     : {$inquiryType}\n\n";
    $auto_body .= "We typically respond within one business day.\n\n";
    $auto_body .= "Best regards,\n{$brand}\n";

    wp_mail( $email, $auto_subject, $auto_body, [
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $from,
    ] );

    return new WP_REST_Response( [
        'ok'        => true,
        'reference' => $reference,
    ], 200 );
}

/* ---------- Admin columns for inquiries ---------- */
function kipl_inquiry_columns( $cols ) {
    return [
        'cb'      => $cols['cb'],
        'title'   => __( 'Reference / Subject', 'krystal-ingredients' ),
        'company' => __( 'Company', 'krystal-ingredients' ),
        'email'   => __( 'Email', 'krystal-ingredients' ),
        'type'    => __( 'Type', 'krystal-ingredients' ),
        'date'    => __( 'Received', 'krystal-ingredients' ),
    ];
}
add_filter( 'manage_kipl_inquiry_posts_columns', 'kipl_inquiry_columns' );

function kipl_inquiry_column_content( $col, $post_id ) {
    if ( $col === 'company' ) {
        echo esc_html( get_post_meta( $post_id, 'kipl_company', true ) );
    } elseif ( $col === 'email' ) {
        $email = get_post_meta( $post_id, 'kipl_email', true );
        if ( $email ) {
            printf( '<a href="mailto:%1$s">%1$s</a>', esc_attr( $email ) );
        }
    } elseif ( $col === 'type' ) {
        echo esc_html( get_post_meta( $post_id, 'kipl_inquiry_type', true ) );
    }
}
add_action( 'manage_kipl_inquiry_posts_custom_column', 'kipl_inquiry_column_content', 10, 2 );
