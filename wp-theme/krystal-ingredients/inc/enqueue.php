<?php
/**
 * Asset orchestration — fonts, Tailwind CDN, GSAP, theme JS/CSS.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function kipl_enqueue_assets() {
    // ---------- Google Fonts ----------
    wp_enqueue_style(
        'kipl-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap',
        [],
        null
    );

    // ---------- Theme stylesheet (registers theme + utility CSS) ----------
    wp_enqueue_style(
        'kipl-style',
        get_stylesheet_uri(),
        [ 'kipl-fonts' ],
        KIPL_THEME_VERSION
    );

    wp_enqueue_style(
        'kipl-main',
        KIPL_THEME_URI . '/assets/css/main.css',
        [ 'kipl-style' ],
        KIPL_THEME_VERSION
    );

    // ---------- Tailwind CDN runtime ----------
    wp_enqueue_script(
        'kipl-tailwind',
        'https://cdn.tailwindcss.com/3.4.16',
        [],
        null,
        false
    );

    // ---------- GSAP + ScrollTrigger ----------
    wp_enqueue_script(
        'kipl-gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        [],
        '3.12.5',
        true
    );
    wp_enqueue_script(
        'kipl-gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        [ 'kipl-gsap' ],
        '3.12.5',
        true
    );

    // ---------- Lenis (smooth scroll) ----------
    wp_enqueue_script(
        'kipl-lenis',
        'https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js',
        [],
        '1.1.13',
        true
    );

    // ---------- Three.js (WebGL — only on desktop, lazily booted by main.js) ----------
    wp_enqueue_script(
        'kipl-three',
        'https://cdnjs.cloudflare.com/ajax/libs/three.js/r150/three.min.js',
        [],
        'r150',
        true
    );

    // ---------- Theme JS ----------
    wp_enqueue_script(
        'kipl-theme',
        KIPL_THEME_URI . '/assets/js/main.js',
        [ 'kipl-gsap', 'kipl-gsap-scrolltrigger', 'kipl-lenis', 'kipl-three' ],
        KIPL_THEME_VERSION,
        true
    );

    wp_localize_script( 'kipl-theme', 'KIPL_DATA', [
        'restUrl'    => esc_url_raw( rest_url( 'kipl/v1/inquiry' ) ),
        'restNonce'  => wp_create_nonce( 'wp_rest' ),
        'homeUrl'    => esc_url( home_url( '/' ) ),
    ] );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'kipl_enqueue_assets' );

/**
 * Inline Tailwind theme extension — runs before tailwind.config = {…} is read.
 * Outputs in the head right after the CDN script.
 */
function kipl_inline_tailwind_config() {
    $config = <<<JS
tailwind.config = {
    theme: {
        extend: {
            colors: {
                kipl: {
                    navy:        '#0A192F',
                    'navy-2':    '#112240',
                    'navy-3':    '#1B2D4F',
                    emerald:     '#10B981',
                    'emerald-d': '#059669',
                    'emerald-x': '#022C22',
                    slate:       '#F8FAFC',
                    'slate-2':   '#E2E8F0'
                }
            },
            fontFamily: {
                display: ['Space Grotesk', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                sans:    ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                mono:    ['JetBrains Mono', 'ui-monospace', 'monospace']
            },
            letterSpacing: {
                tightest: '-0.04em'
            }
        }
    },
    corePlugins: {
        preflight: true
    }
};
JS;

    wp_add_inline_script( 'kipl-tailwind', $config, 'after' );
}
add_action( 'wp_enqueue_scripts', 'kipl_inline_tailwind_config', 20 );

/**
 * Preconnect / dns-prefetch for the CDN endpoints — small first-paint win.
 */
function kipl_resource_hints( $hints, $relation ) {
    if ( 'preconnect' === $relation ) {
        $hints[] = [ 'href' => 'https://fonts.googleapis.com', 'crossorigin' ];
        $hints[] = [ 'href' => 'https://fonts.gstatic.com', 'crossorigin' ];
        $hints[] = [ 'href' => 'https://cdn.tailwindcss.com' ];
        $hints[] = [ 'href' => 'https://cdnjs.cloudflare.com' ];
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'kipl_resource_hints', 10, 2 );

/**
 * Inject critical above-the-fold CSS so the navy hero never flashes white
 * before Tailwind's CDN runtime hydrates.
 */
function kipl_critical_inline_css() {
    echo "<style id=\"kipl-critical\">
    html, body { background:#0A192F; }
    body { font-family:'Inter', system-ui, sans-serif; color:#0A192F; margin:0; }
    .kipl-pre-loader { position:fixed; inset:0; display:flex; align-items:center; justify-content:center; background:#0A192F; z-index:9999; transition:opacity .5s ease,visibility .5s ease; }
    .kipl-pre-loader.is-hidden { opacity:0; visibility:hidden; pointer-events:none; }
    .kipl-pre-loader__mark { width:56px; height:56px; animation:kipl-mark-spin 6s linear infinite; }
    @keyframes kipl-mark-spin { to { transform:rotate(360deg); } }
    .kipl-fadeup { opacity:0; transform:translateY(20px); }
    </style>";
}
add_action( 'wp_head', 'kipl_critical_inline_css', 1 );
