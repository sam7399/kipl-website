<?php
/**
 * Document head + glassmorphism navigation.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="theme-color" content="#0A192F" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-white text-kipl-navy font-sans antialiased' ); ?>>
<?php wp_body_open(); ?>

<div class="kipl-pre-loader" id="kipl-pre-loader" aria-hidden="true">
    <svg class="kipl-pre-loader__mark" viewBox="0 0 40 40">
        <polygon points="20,3 35,12 35,28 20,37 5,28 5,12" fill="none" stroke="#10B981" stroke-width="1.6" />
        <circle cx="20" cy="20" r="3" fill="#10B981" />
    </svg>
</div>

<a class="screen-reader-text skip-link" href="#site-content">
    <?php esc_html_e( 'Skip to content', 'krystal-ingredients' ); ?>
</a>

<div id="kipl-scroll-progress" class="fixed top-0 inset-x-0 z-[60] h-[2px] bg-kipl-emerald origin-left scale-x-0 pointer-events-none" style="box-shadow:0 0 12px rgba(16,185,129,0.55)"></div>

<header
    id="kipl-nav"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-300 backdrop-blur-md bg-kipl-navy/40 border-b border-white/5"
    data-state="top"
>
    <div class="max-w-7xl mx-auto px-6 md:px-10 h-16 md:h-20 flex items-center justify-between">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 group" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                kipl_logo_mark( '#10B981', 36 );
            }
            ?>
            <span class="flex flex-col leading-tight">
                <span class="font-display text-white font-bold tracking-tight text-[17px]">
                    <?php echo esc_html( kipl_field( 'brand_short' ) ); ?>
                </span>
                <span class="text-[10px] tracking-[0.22em] uppercase text-white/60 -mt-0.5">
                    <?php echo esc_html( kipl_field( 'brand_long' ) ); ?>
                </span>
            </span>
        </a>

        <nav class="hidden lg:flex items-center gap-10" aria-label="<?php esc_attr_e( 'Primary', 'krystal-ingredients' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( [
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'items_wrap'      => '%3$s',
                    'depth'           => 1,
                    'fallback_cb'     => false,
                    'walker'          => null,
                    'link_before'     => '',
                    'link_after'      => '',
                ] );
            } else {
                $defaults = [
                    [ 'label' => __( 'Products', 'krystal-ingredients' ),       'href' => '#products' ],
                    [ 'label' => __( 'Manufacturing', 'krystal-ingredients' ),  'href' => '#manufacturing' ],
                    [ 'label' => __( 'Sustainability', 'krystal-ingredients' ), 'href' => '#sustainability' ],
                    [ 'label' => __( 'Contact', 'krystal-ingredients' ),        'href' => '#contact' ],
                ];
                foreach ( $defaults as $item ) {
                    printf(
                        '<a href="%1$s" class="text-sm font-medium text-white/75 hover:text-white transition-colors duration-200">%2$s</a>',
                        esc_url( $item['href'] ),
                        esc_html( $item['label'] )
                    );
                }
            }
            ?>
        </nav>

        <div class="flex items-center gap-3">
            <a href="#contact" class="hidden md:inline-flex items-center gap-2 bg-kipl-emerald text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-kipl-emerald-d transition-all duration-300 hover:scale-[1.02]">
                <?php esc_html_e( 'Request Consultation', 'krystal-ingredients' ); ?>
                <?php kipl_icon( 'arrow-up-right', [ 'class' => 'w-4 h-4' ] ); ?>
            </a>
            <button
                type="button"
                id="kipl-nav-toggle"
                class="lg:hidden text-white p-2 rounded-full hover:bg-white/10 transition"
                aria-controls="kipl-nav-mobile"
                aria-expanded="false"
                aria-label="<?php esc_attr_e( 'Toggle navigation', 'krystal-ingredients' ); ?>"
            >
                <span class="kipl-nav-toggle__open"><?php kipl_icon( 'menu', [ 'class' => 'w-6 h-6' ] ); ?></span>
                <span class="kipl-nav-toggle__close hidden"><?php kipl_icon( 'x', [ 'class' => 'w-6 h-6' ] ); ?></span>
            </button>
        </div>
    </div>

    <div id="kipl-nav-mobile" class="lg:hidden bg-kipl-navy/95 backdrop-blur-xl border-t border-white/10 max-h-0 overflow-hidden transition-[max-height,opacity] duration-500 opacity-0">
        <nav class="px-6 py-6 flex flex-col gap-5" aria-label="<?php esc_attr_e( 'Primary mobile', 'krystal-ingredients' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( [
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'items_wrap'      => '%3$s',
                    'depth'           => 1,
                    'fallback_cb'     => false,
                ] );
            } else {
                $defaults = [
                    [ 'label' => __( 'Products', 'krystal-ingredients' ),       'href' => '#products' ],
                    [ 'label' => __( 'Manufacturing', 'krystal-ingredients' ),  'href' => '#manufacturing' ],
                    [ 'label' => __( 'Sustainability', 'krystal-ingredients' ), 'href' => '#sustainability' ],
                    [ 'label' => __( 'Contact', 'krystal-ingredients' ),        'href' => '#contact' ],
                ];
                foreach ( $defaults as $item ) {
                    printf(
                        '<a href="%1$s" class="text-base font-medium text-white/85 hover:text-white">%2$s</a>',
                        esc_url( $item['href'] ),
                        esc_html( $item['label'] )
                    );
                }
            }
            ?>
            <a href="#contact" class="inline-flex items-center justify-center gap-2 bg-kipl-emerald text-white px-5 py-3 rounded-full text-sm font-semibold mt-2">
                <?php esc_html_e( 'Request Consultation', 'krystal-ingredients' ); ?>
                <?php kipl_icon( 'arrow-up-right', [ 'class' => 'w-4 h-4' ] ); ?>
            </a>
        </nav>
    </div>
</header>

<main id="site-content">
