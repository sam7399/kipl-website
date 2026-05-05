<?php
/**
 * Krystal Ingredients — theme bootstrap.
 *
 * Loads in this order:
 *   1. Theme support / menus / image sizes
 *   2. Asset enqueuing (Tailwind CDN, fonts, GSAP, theme JS/CSS)
 *   3. Customizer panels & defaults
 *   4. Custom post types (Products, Industries, Timeline)
 *   5. Inquiry REST endpoint (front-end contact form)
 *   6. Helpers (SVG, kipl_field, kipl_default)
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'KIPL_THEME_VERSION', '1.0.0' );
define( 'KIPL_THEME_DIR', get_template_directory() );
define( 'KIPL_THEME_URI', get_template_directory_uri() );

/* ---------- Theme support ---------- */
function kipl_theme_setup() {
    load_theme_textdomain( 'krystal-ingredients', KIPL_THEME_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-logo', [
        'height'      => 64,
        'width'       => 220,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ] );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor.css' );

    // Custom image sizes for product / industry tiles
    add_image_size( 'kipl-tile', 960, 720, true );
    add_image_size( 'kipl-tile-wide', 1600, 800, true );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'krystal-ingredients' ),
        'footer'  => __( 'Footer Navigation', 'krystal-ingredients' ),
    ] );
}
add_action( 'after_setup_theme', 'kipl_theme_setup' );

/* ---------- Increase content width for full-bleed sections ---------- */
function kipl_content_width() {
    $GLOBALS['content_width'] = 1280;
}
add_action( 'after_setup_theme', 'kipl_content_width', 0 );

/* ---------- Module loaders ---------- */
require_once KIPL_THEME_DIR . '/inc/helpers.php';
require_once KIPL_THEME_DIR . '/inc/enqueue.php';
require_once KIPL_THEME_DIR . '/inc/post-types.php';
require_once KIPL_THEME_DIR . '/inc/customizer.php';
require_once KIPL_THEME_DIR . '/inc/inquiry-endpoint.php';

/* ---------- Body class additions ---------- */
function kipl_body_classes( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'kipl-front';
    }
    return $classes;
}
add_filter( 'body_class', 'kipl_body_classes' );

/* ---------- Strip emoji bloat for performance ---------- */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/* ---------- Pingback header noise ---------- */
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );

/* ---------- Default homepage on activation ---------- */
function kipl_after_switch_theme() {
    $front = get_page_by_path( 'home' );
    if ( ! $front ) {
        $page_id = wp_insert_post( [
            'post_title'  => 'Home',
            'post_name'   => 'home',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ] );
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $page_id );
        }
    } else {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front->ID );
    }
}
add_action( 'after_switch_theme', 'kipl_after_switch_theme' );
