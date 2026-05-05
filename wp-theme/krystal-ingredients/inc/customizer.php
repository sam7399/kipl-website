<?php
/**
 * WordPress Customizer panels — every editable string and image on the
 * homepage is registered here. The setting keys match kipl_defaults() in
 * inc/helpers.php so kipl_field( 'key' ) and kipl_image( 'key' ) just work.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function kipl_register_customizer( $wp_customize ) {
    $defaults = kipl_defaults();

    /* ---------- Live preview transports ---------- */
    foreach ( [ 'blogname', 'blogdescription' ] as $existing ) {
        if ( $wp_customize->get_setting( $existing ) ) {
            $wp_customize->get_setting( $existing )->transport = 'postMessage';
        }
    }

    /* ---------- Master panel ---------- */
    $wp_customize->add_panel( 'kipl_panel', [
        'title'      => __( 'KIPL · Site Content', 'krystal-ingredients' ),
        'priority'   => 20,
        'description' => __( 'Edit the homepage sections, contact details and footer here. Each section maps directly to what appears on the front page.', 'krystal-ingredients' ),
    ] );

    /* ===================================================================
     * Section 1 — Hero
     * =================================================================== */
    $wp_customize->add_section( 'kipl_hero', [
        'title' => __( '01 · Hero', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );

    $hero_text_fields = [
        'hero_eyebrow'             => __( 'Eyebrow text', 'krystal-ingredients' ),
        'hero_title_a'             => __( 'Headline (line 1)', 'krystal-ingredients' ),
        'hero_title_accent'        => __( 'Accent word (emerald)', 'krystal-ingredients' ),
        'hero_title_b'             => __( 'Headline (line 2 ending)', 'krystal-ingredients' ),
        'hero_sub'                 => __( 'Sub-headline', 'krystal-ingredients' ),
        'hero_cta_primary_label'   => __( 'Primary CTA — label', 'krystal-ingredients' ),
        'hero_cta_primary_link'    => __( 'Primary CTA — URL', 'krystal-ingredients' ),
        'hero_cta_secondary_label' => __( 'Secondary CTA — label', 'krystal-ingredients' ),
        'hero_cta_secondary_link'  => __( 'Secondary CTA — URL', 'krystal-ingredients' ),
    ];
    foreach ( $hero_text_fields as $key => $label ) {
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ] );
        $type = ( false !== strpos( $key, 'sub' ) ) ? 'textarea' : 'text';
        $wp_customize->add_control( $key, [
            'label'   => $label,
            'section' => 'kipl_hero',
            'type'    => $type,
        ] );
    }

    for ( $i = 1; $i <= 4; $i++ ) {
        foreach ( [ 'value', 'label' ] as $kind ) {
            $key = "hero_stat_{$i}_{$kind}";
            $wp_customize->add_setting( $key, [
                'default'           => $defaults[ $key ] ?? '',
                'sanitize_callback' => 'sanitize_text_field',
            ] );
            $wp_customize->add_control( $key, [
                'label'   => sprintf( __( 'Stat %1$d — %2$s', 'krystal-ingredients' ), $i, ucfirst( $kind ) ),
                'section' => 'kipl_hero',
                'type'    => 'text',
            ] );
        }
    }

    /* ===================================================================
     * Section 2 — About
     * =================================================================== */
    $wp_customize->add_section( 'kipl_about', [
        'title' => __( '02 · About / Group', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );

    $about_fields = [
        'about_eyebrow'        => [ 'Eyebrow text', 'text' ],
        'about_title_a'        => [ 'Title — line 1', 'text' ],
        'about_title_accent'   => [ 'Title — line 2 (accent)', 'text' ],
        'about_body'           => [ 'About body copy', 'textarea' ],
        'about_pillar_1_title' => [ 'Pillar 1 — title', 'text' ],
        'about_pillar_1_body'  => [ 'Pillar 1 — body', 'textarea' ],
        'about_pillar_2_title' => [ 'Pillar 2 — title', 'text' ],
        'about_pillar_2_body'  => [ 'Pillar 2 — body', 'textarea' ],
        'about_pillar_3_title' => [ 'Pillar 3 — title', 'text' ],
        'about_pillar_3_body'  => [ 'Pillar 3 — body', 'textarea' ],
    ];
    foreach ( $about_fields as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_about',
            'type'    => $type,
        ] );
    }

    /* ===================================================================
     * Section 3 — Products (intro only — items are managed via CPT)
     * =================================================================== */
    $wp_customize->add_section( 'kipl_products', [
        'title'       => __( '03 · Products (intro)', 'krystal-ingredients' ),
        'panel'       => 'kipl_panel',
        'description' => __( 'Product cards are managed in WP Admin → Products. This section only controls the intro copy.', 'krystal-ingredients' ),
    ] );

    foreach ( [
        'products_eyebrow' => [ 'Eyebrow', 'text' ],
        'products_title'   => [ 'Title', 'text' ],
        'products_sub'     => [ 'Sub-headline', 'textarea' ],
    ] as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_products',
            'type'    => $type,
        ] );
    }

    /* ===================================================================
     * Section 4 — Industries (intro only — items are managed via CPT)
     * =================================================================== */
    $wp_customize->add_section( 'kipl_industries', [
        'title'       => __( '04 · Industries (intro)', 'krystal-ingredients' ),
        'panel'       => 'kipl_panel',
        'description' => __( 'Industry tiles are managed in WP Admin → Industries.', 'krystal-ingredients' ),
    ] );
    foreach ( [
        'industries_eyebrow' => [ 'Eyebrow', 'text' ],
        'industries_title'   => [ 'Title', 'text' ],
        'industries_sub'     => [ 'Sub-headline', 'textarea' ],
    ] as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_industries',
            'type'    => $type,
        ] );
    }

    /* ===================================================================
     * Section 5 — Manufacturing / Dahej Facility
     * =================================================================== */
    $wp_customize->add_section( 'kipl_mfg', [
        'title' => __( '05 · Manufacturing — Dahej', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );

    $mfg_fields = [
        'mfg_eyebrow' => [ 'Eyebrow', 'text' ],
        'mfg_title'   => [ 'Section title', 'text' ],
        'mfg_sub'     => [ 'Sub-headline', 'textarea' ],
        'mfg_h1_title' => [ 'Highlight 1 — title', 'text' ],
        'mfg_h1_body'  => [ 'Highlight 1 — body', 'textarea' ],
        'mfg_h2_title' => [ 'Highlight 2 — title', 'text' ],
        'mfg_h2_body'  => [ 'Highlight 2 — body', 'textarea' ],
        'mfg_h3_title' => [ 'Highlight 3 — title', 'text' ],
        'mfg_h3_body'  => [ 'Highlight 3 — body', 'textarea' ],
    ];
    foreach ( $mfg_fields as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_mfg',
            'type'    => $type,
        ] );
    }

    // Facility image
    $wp_customize->add_setting( 'mfg_image', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mfg_image', [
        'label'     => __( 'Facility image', 'krystal-ingredients' ),
        'section'   => 'kipl_mfg',
        'mime_type' => 'image',
    ] ) );

    /* ===================================================================
     * Section 6 — Sustainability
     * =================================================================== */
    $wp_customize->add_section( 'kipl_sus', [
        'title' => __( '06 · Sustainability / ESG', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );

    $sus_fields = [
        'sus_eyebrow'    => [ 'Eyebrow', 'text' ],
        'sus_title'      => [ 'Title', 'text' ],
        'sus_sub'        => [ 'Sub-headline', 'textarea' ],
        'sus_p1_title'   => [ 'Pillar 1 — title', 'text' ],
        'sus_p1_body'    => [ 'Pillar 1 — body', 'textarea' ],
        'sus_p2_title'   => [ 'Pillar 2 — title', 'text' ],
        'sus_p2_body'    => [ 'Pillar 2 — body', 'textarea' ],
        'sus_p3_title'   => [ 'Pillar 3 — title', 'text' ],
        'sus_p3_body'    => [ 'Pillar 3 — body', 'textarea' ],
        'sus_report_url' => [ 'ESG report download URL', 'url' ],
    ];
    foreach ( $sus_fields as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => ( $type === 'url' ) ? 'esc_url_raw' : 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_sus',
            'type'    => $type,
        ] );
    }

    /* ===================================================================
     * Section 7 — R&D
     * =================================================================== */
    $wp_customize->add_section( 'kipl_rnd', [
        'title' => __( '07 · R&D / Innovation', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );

    $rnd_fields = [
        'rnd_eyebrow' => [ 'Eyebrow', 'text' ],
        'rnd_title'   => [ 'Title', 'text' ],
        'rnd_sub'     => [ 'Sub-headline', 'textarea' ],
        'rnd_c1_title' => [ 'Capability 1 — title', 'text' ],
        'rnd_c1_body'  => [ 'Capability 1 — body', 'textarea' ],
        'rnd_c2_title' => [ 'Capability 2 — title', 'text' ],
        'rnd_c2_body'  => [ 'Capability 2 — body', 'textarea' ],
        'rnd_c3_title' => [ 'Capability 3 — title', 'text' ],
        'rnd_c3_body'  => [ 'Capability 3 — body', 'textarea' ],
    ];
    foreach ( $rnd_fields as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_rnd',
            'type'    => $type,
        ] );
    }

    $wp_customize->add_setting( 'rnd_image', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'rnd_image', [
        'label'     => __( 'R&D laboratory image', 'krystal-ingredients' ),
        'section'   => 'kipl_rnd',
        'mime_type' => 'image',
    ] ) );

    /* ===================================================================
     * Section 8 — Compliance Strip
     * =================================================================== */
    $wp_customize->add_section( 'kipl_compliance', [
        'title' => __( '08 · Compliance Strip', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );

    foreach ( [
        'compliance_label' => [ 'Eyebrow label', 'text' ],
        'compliance_sub'   => [ 'Sub-line', 'text' ],
        'compliance_list'  => [ 'Badges (comma separated)', 'textarea' ],
    ] as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_compliance',
            'type'    => $type,
        ] );
    }

    /* ===================================================================
     * Section 9 — Contact
     * =================================================================== */
    $wp_customize->add_section( 'kipl_contact', [
        'title' => __( '09 · Contact', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );

    $contact_fields = [
        'contact_eyebrow'    => [ 'Eyebrow', 'text' ],
        'contact_title'      => [ 'Title', 'text' ],
        'contact_sub'        => [ 'Sub-headline', 'textarea' ],
        'contact_email'      => [ 'Inquiry email', 'email' ],
        'contact_phone'      => [ 'Inquiry phone', 'text' ],
        'office_hq_label'    => [ 'Office 1 — label', 'text' ],
        'office_hq_city'     => [ 'Office 1 — city', 'text' ],
        'office_hq_country'  => [ 'Office 1 — country', 'text' ],
        'office_mfg_label'   => [ 'Office 2 — label', 'text' ],
        'office_mfg_city'    => [ 'Office 2 — city', 'text' ],
        'office_mfg_country' => [ 'Office 2 — country', 'text' ],
    ];
    foreach ( $contact_fields as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => ( $type === 'email' ) ? 'sanitize_email' : 'sanitize_text_field',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_contact',
            'type'    => ( $type === 'email' ) ? 'email' : 'text',
        ] );
    }

    /* ===================================================================
     * Section 9b — Numbers strip
     * =================================================================== */
    $wp_customize->add_section( 'kipl_numbers', [
        'title' => __( '11 · Numbers Strip', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );
    $number_fields = [
        'numbers_eyebrow' => [ 'Eyebrow', 'text' ],
        'numbers_title'   => [ 'Title', 'text' ],
    ];
    for ( $i = 1; $i <= 4; $i++ ) {
        $number_fields[ "numbers_{$i}_value" ]  = [ "Number {$i} — value (numeric only)", 'text' ];
        $number_fields[ "numbers_{$i}_suffix" ] = [ "Number {$i} — suffix (e.g. %, +, Cr)", 'text' ];
        $number_fields[ "numbers_{$i}_label" ]  = [ "Number {$i} — caption", 'text' ];
    }
    foreach ( $number_fields as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_numbers',
            'type'    => $type,
        ] );
    }

    /* ===================================================================
     * Section 9c — Awards / Press
     * =================================================================== */
    $wp_customize->add_section( 'kipl_awards', [
        'title' => __( '12 · Awards / Press', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );
    foreach ( [
        'awards_label' => [ 'Eyebrow', 'text' ],
        'awards_sub'   => [ 'Sub-line', 'text' ],
        'awards_list'  => [ 'Awards (comma separated)', 'textarea' ],
    ] as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_awards',
            'type'    => $type,
        ] );
    }

    /* ===================================================================
     * Section 9d — Leadership quote / testimonial
     * =================================================================== */
    $wp_customize->add_section( 'kipl_quote', [
        'title' => __( '13 · Leadership Quote', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );
    foreach ( [
        'quote_eyebrow' => [ 'Eyebrow', 'text' ],
        'quote_body'    => [ 'Quote body', 'textarea' ],
        'quote_author'  => [ 'Attribution — name / title', 'text' ],
        'quote_role'    => [ 'Attribution — role / company', 'text' ],
    ] as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_quote',
            'type'    => $type,
        ] );
    }
    // Optional headshot
    $wp_customize->add_setting( 'quote_image', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'quote_image', [
        'label'     => __( 'Quote image / headshot (optional)', 'krystal-ingredients' ),
        'section'   => 'kipl_quote',
        'mime_type' => 'image',
    ] ) );

    /* ===================================================================
     * Section 9e — Insights teaser
     * =================================================================== */
    $wp_customize->add_section( 'kipl_insights', [
        'title' => __( '14 · Insights / Newsroom (intro)', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
        'description' => __( 'Articles are managed in WP Admin → Insights.', 'krystal-ingredients' ),
    ] );
    foreach ( [
        'insights_eyebrow' => [ 'Eyebrow', 'text' ],
        'insights_title'   => [ 'Title', 'text' ],
        'insights_sub'     => [ 'Sub-headline', 'textarea' ],
    ] as $key => $meta ) {
        list( $label, $type ) = $meta;
        $wp_customize->add_setting( $key, [
            'default'           => $defaults[ $key ] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $label, 'krystal-ingredients' ),
            'section' => 'kipl_insights',
            'type'    => $type,
        ] );
    }

    /* ===================================================================
     * Section 10 — Footer
     * =================================================================== */
    $wp_customize->add_section( 'kipl_footer', [
        'title' => __( '10 · Footer', 'krystal-ingredients' ),
        'panel' => 'kipl_panel',
    ] );
    $wp_customize->add_setting( 'footer_blurb', [
        'default'           => $defaults['footer_blurb'],
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( 'footer_blurb', [
        'label'   => __( 'Footer blurb', 'krystal-ingredients' ),
        'section' => 'kipl_footer',
        'type'    => 'textarea',
    ] );
}
add_action( 'customize_register', 'kipl_register_customizer' );
