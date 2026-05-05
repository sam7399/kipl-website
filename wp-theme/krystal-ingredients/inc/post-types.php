<?php
/**
 * Custom post types — Products, Industries, Timeline events.
 *
 * Each type ships with its own meta box; no plugins required.
 * Field values are saved via update_post_meta() and read in templates with
 * get_post_meta( $id, $key, true ).
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ===================================================================
 * Product family — five-card catalog block on the homepage.
 * =================================================================== */
function kipl_register_product_cpt() {
    register_post_type( 'kipl_product', [
        'labels' => [
            'name'               => __( 'Products', 'krystal-ingredients' ),
            'singular_name'      => __( 'Product', 'krystal-ingredients' ),
            'add_new'            => __( 'Add Product', 'krystal-ingredients' ),
            'add_new_item'       => __( 'Add new product family', 'krystal-ingredients' ),
            'edit_item'          => __( 'Edit product family', 'krystal-ingredients' ),
            'all_items'          => __( 'All products', 'krystal-ingredients' ),
            'menu_name'          => __( 'Products', 'krystal-ingredients' ),
        ],
        'public'              => true,
        'show_in_rest'        => true,
        'has_archive'         => false,
        'menu_position'       => 22,
        'menu_icon'           => 'dashicons-archive',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'page-attributes' ],
        'rewrite'             => [ 'slug' => 'product', 'with_front' => false ],
        'exclude_from_search' => false,
    ] );
}
add_action( 'init', 'kipl_register_product_cpt' );

/* ===================================================================
 * Industry vertical — bento grid tiles.
 * =================================================================== */
function kipl_register_industry_cpt() {
    register_post_type( 'kipl_industry', [
        'labels' => [
            'name'          => __( 'Industries', 'krystal-ingredients' ),
            'singular_name' => __( 'Industry', 'krystal-ingredients' ),
            'add_new_item'  => __( 'Add new industry', 'krystal-ingredients' ),
            'edit_item'     => __( 'Edit industry', 'krystal-ingredients' ),
            'all_items'     => __( 'All industries', 'krystal-ingredients' ),
            'menu_name'     => __( 'Industries', 'krystal-ingredients' ),
        ],
        'public'              => true,
        'show_in_rest'        => true,
        'has_archive'         => false,
        'menu_position'       => 23,
        'menu_icon'           => 'dashicons-grid-view',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'page-attributes' ],
        'rewrite'             => [ 'slug' => 'industry', 'with_front' => false ],
        'exclude_from_search' => true,
    ] );
}
add_action( 'init', 'kipl_register_industry_cpt' );

/* ===================================================================
 * Timeline event — for the company-history block in About.
 * =================================================================== */
function kipl_register_timeline_cpt() {
    register_post_type( 'kipl_timeline', [
        'labels' => [
            'name'          => __( 'Timeline', 'krystal-ingredients' ),
            'singular_name' => __( 'Milestone', 'krystal-ingredients' ),
            'add_new_item'  => __( 'Add new milestone', 'krystal-ingredients' ),
            'edit_item'     => __( 'Edit milestone', 'krystal-ingredients' ),
            'all_items'     => __( 'All milestones', 'krystal-ingredients' ),
            'menu_name'     => __( 'Timeline', 'krystal-ingredients' ),
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'has_archive'         => false,
        'menu_position'       => 24,
        'menu_icon'           => 'dashicons-clock',
        'supports'            => [ 'title', 'editor', 'page-attributes' ],
        'exclude_from_search' => true,
    ] );
}
add_action( 'init', 'kipl_register_timeline_cpt' );

/* ===================================================================
 * Insight — newsroom / technical bulletin entry
 * =================================================================== */
function kipl_register_insight_cpt() {
    register_post_type( 'kipl_insight', [
        'labels' => [
            'name'          => __( 'Insights', 'krystal-ingredients' ),
            'singular_name' => __( 'Insight', 'krystal-ingredients' ),
            'add_new_item'  => __( 'Add new insight', 'krystal-ingredients' ),
            'edit_item'     => __( 'Edit insight', 'krystal-ingredients' ),
            'all_items'     => __( 'All insights', 'krystal-ingredients' ),
            'menu_name'     => __( 'Insights', 'krystal-ingredients' ),
        ],
        'public'              => true,
        'show_in_rest'        => true,
        'has_archive'         => true,
        'menu_position'       => 26,
        'menu_icon'           => 'dashicons-megaphone',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
        'rewrite'             => [ 'slug' => 'insights', 'with_front' => false ],
    ] );
}
add_action( 'init', 'kipl_register_insight_cpt' );

/* ===================================================================
 * Meta boxes
 * =================================================================== */
function kipl_register_meta_boxes() {
    add_meta_box(
        'kipl_product_meta',
        __( 'Product details', 'krystal-ingredients' ),
        'kipl_render_product_meta',
        'kipl_product',
        'normal',
        'high'
    );
    add_meta_box(
        'kipl_industry_meta',
        __( 'Industry tile', 'krystal-ingredients' ),
        'kipl_render_industry_meta',
        'kipl_industry',
        'normal',
        'high'
    );
    add_meta_box(
        'kipl_timeline_meta',
        __( 'Milestone year', 'krystal-ingredients' ),
        'kipl_render_timeline_meta',
        'kipl_timeline',
        'side',
        'high'
    );
    add_meta_box(
        'kipl_insight_meta',
        __( 'Insight metadata', 'krystal-ingredients' ),
        'kipl_render_insight_meta',
        'kipl_insight',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'kipl_register_meta_boxes' );

/* --------- Product meta UI --------- */
function kipl_render_product_meta( $post ) {
    wp_nonce_field( 'kipl_product_meta', 'kipl_product_meta_nonce' );
    $tagline = get_post_meta( $post->ID, '_kipl_product_tagline', true );
    $bullets = get_post_meta( $post->ID, '_kipl_product_bullets', true );
    $no      = get_post_meta( $post->ID, '_kipl_product_no', true );
    ?>
    <p>
        <label for="kipl_product_no" style="display:block;font-weight:600;">
            <?php esc_html_e( 'Series number (e.g. 01, 02 …)', 'krystal-ingredients' ); ?>
        </label>
        <input id="kipl_product_no" name="kipl_product_no" type="text" value="<?php echo esc_attr( $no ); ?>" class="widefat" />
    </p>
    <p>
        <label for="kipl_product_tagline" style="display:block;font-weight:600;">
            <?php esc_html_e( 'One-line tagline', 'krystal-ingredients' ); ?>
        </label>
        <input id="kipl_product_tagline" name="kipl_product_tagline" type="text" value="<?php echo esc_attr( $tagline ); ?>" class="widefat" placeholder="Olfactory precision at molecular scale" />
    </p>
    <p>
        <label for="kipl_product_bullets" style="display:block;font-weight:600;">
            <?php esc_html_e( 'Bullet points (one per line)', 'krystal-ingredients' ); ?>
        </label>
        <textarea id="kipl_product_bullets" name="kipl_product_bullets" rows="5" class="widefat" placeholder="> 99% purity grades&#10;Batch-to-batch consistency&#10;Low-odour impurities"><?php echo esc_textarea( $bullets ); ?></textarea>
    </p>
    <?php
}

function kipl_save_product_meta( $post_id ) {
    if ( ! isset( $_POST['kipl_product_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['kipl_product_meta_nonce'], 'kipl_product_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    update_post_meta( $post_id, '_kipl_product_no',      sanitize_text_field( $_POST['kipl_product_no'] ?? '' ) );
    update_post_meta( $post_id, '_kipl_product_tagline', sanitize_text_field( $_POST['kipl_product_tagline'] ?? '' ) );
    update_post_meta( $post_id, '_kipl_product_bullets', wp_kses_post( $_POST['kipl_product_bullets'] ?? '' ) );
}
add_action( 'save_post_kipl_product', 'kipl_save_product_meta' );

/* --------- Industry meta UI --------- */
function kipl_render_industry_meta( $post ) {
    wp_nonce_field( 'kipl_industry_meta', 'kipl_industry_meta_nonce' );
    $blurb = get_post_meta( $post->ID, '_kipl_industry_blurb', true );
    $span  = get_post_meta( $post->ID, '_kipl_industry_span', true );
    if ( ! $span ) {
        $span = 'normal';
    }
    ?>
    <p>
        <label for="kipl_industry_blurb" style="display:block;font-weight:600;">
            <?php esc_html_e( 'Tile copy', 'krystal-ingredients' ); ?>
        </label>
        <textarea id="kipl_industry_blurb" name="kipl_industry_blurb" rows="3" class="widefat"><?php echo esc_textarea( $blurb ); ?></textarea>
    </p>
    <p>
        <label for="kipl_industry_span" style="display:block;font-weight:600;">
            <?php esc_html_e( 'Tile size on the bento grid', 'krystal-ingredients' ); ?>
        </label>
        <select id="kipl_industry_span" name="kipl_industry_span" class="widefat">
            <option value="normal" <?php selected( $span, 'normal' ); ?>><?php esc_html_e( 'Standard (1 column)', 'krystal-ingredients' ); ?></option>
            <option value="wide"   <?php selected( $span, 'wide' ); ?>><?php esc_html_e( 'Wide (2 columns)', 'krystal-ingredients' ); ?></option>
            <option value="hero"   <?php selected( $span, 'hero' ); ?>><?php esc_html_e( 'Hero (2 cols × 2 rows)', 'krystal-ingredients' ); ?></option>
        </select>
    </p>
    <p style="font-size:12px;color:#666;">
        <?php esc_html_e( 'Set the featured image — it becomes the tile background. Use Page Attributes → Order to reorder tiles.', 'krystal-ingredients' ); ?>
    </p>
    <?php
}

function kipl_save_industry_meta( $post_id ) {
    if ( ! isset( $_POST['kipl_industry_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['kipl_industry_meta_nonce'], 'kipl_industry_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    update_post_meta( $post_id, '_kipl_industry_blurb', sanitize_textarea_field( $_POST['kipl_industry_blurb'] ?? '' ) );
    $span = $_POST['kipl_industry_span'] ?? 'normal';
    update_post_meta( $post_id, '_kipl_industry_span', in_array( $span, [ 'normal', 'wide', 'hero' ], true ) ? $span : 'normal' );
}
add_action( 'save_post_kipl_industry', 'kipl_save_industry_meta' );

/* --------- Timeline meta UI --------- */
function kipl_render_timeline_meta( $post ) {
    wp_nonce_field( 'kipl_timeline_meta', 'kipl_timeline_meta_nonce' );
    $year = get_post_meta( $post->ID, '_kipl_timeline_year', true );
    ?>
    <p>
        <label for="kipl_timeline_year" style="display:block;font-weight:600;">
            <?php esc_html_e( 'Year / label', 'krystal-ingredients' ); ?>
        </label>
        <input id="kipl_timeline_year" name="kipl_timeline_year" type="text" value="<?php echo esc_attr( $year ); ?>" class="widefat" placeholder="1997" />
    </p>
    <p style="font-size:12px;color:#666;">
        <?php esc_html_e( 'Use Page Attributes → Order to control the chronological order.', 'krystal-ingredients' ); ?>
    </p>
    <?php
}

function kipl_save_timeline_meta( $post_id ) {
    if ( ! isset( $_POST['kipl_timeline_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['kipl_timeline_meta_nonce'], 'kipl_timeline_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    update_post_meta( $post_id, '_kipl_timeline_year', sanitize_text_field( $_POST['kipl_timeline_year'] ?? '' ) );
}
add_action( 'save_post_kipl_timeline', 'kipl_save_timeline_meta' );

/* --------- Insight meta UI --------- */
function kipl_render_insight_meta( $post ) {
    wp_nonce_field( 'kipl_insight_meta', 'kipl_insight_meta_nonce' );
    $kicker   = get_post_meta( $post->ID, '_kipl_insight_kicker', true );
    $minutes  = get_post_meta( $post->ID, '_kipl_insight_minutes', true );
    ?>
    <p>
        <label for="kipl_insight_kicker" style="display:block;font-weight:600;">
            <?php esc_html_e( 'Kicker / category', 'krystal-ingredients' ); ?>
        </label>
        <input id="kipl_insight_kicker" name="kipl_insight_kicker" type="text" value="<?php echo esc_attr( $kicker ); ?>" class="widefat" placeholder="Application Note · Fragrance" />
    </p>
    <p>
        <label for="kipl_insight_minutes" style="display:block;font-weight:600;">
            <?php esc_html_e( 'Reading time (minutes)', 'krystal-ingredients' ); ?>
        </label>
        <input id="kipl_insight_minutes" name="kipl_insight_minutes" type="number" min="1" value="<?php echo esc_attr( $minutes ); ?>" class="widefat" />
    </p>
    <?php
}

function kipl_save_insight_meta( $post_id ) {
    if ( ! isset( $_POST['kipl_insight_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['kipl_insight_meta_nonce'], 'kipl_insight_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    update_post_meta( $post_id, '_kipl_insight_kicker',  sanitize_text_field( $_POST['kipl_insight_kicker'] ?? '' ) );
    update_post_meta( $post_id, '_kipl_insight_minutes', absint( $_POST['kipl_insight_minutes'] ?? 0 ) );
}
add_action( 'save_post_kipl_insight', 'kipl_save_insight_meta' );

/* ===================================================================
 * On theme activation, seed sample content if the site is empty.
 * =================================================================== */
function kipl_maybe_seed_content() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    if ( ! get_option( 'kipl_seeded_v2' ) ) {
        kipl_seed_sample_content();
        update_option( 'kipl_seeded_v2', 1 );
        update_option( 'kipl_seeded_v1', 1 );
    }
}
add_action( 'admin_init', 'kipl_maybe_seed_content' );

function kipl_seed_sample_content() {
    $samples = [
        'product' => [
            [ 'title' => 'Aroma Chemicals',         'no' => '01', 'tagline' => 'Olfactory precision at molecular scale', 'body' => 'High-purity synthetic and natural-identical aroma compounds engineered for stability, longevity, and superior olfactory performance.', 'bullets' => "> 99% purity grades\nBatch-to-batch consistency\nLow-odour impurities" ],
            [ 'title' => 'Specialty Ingredients',   'no' => '02', 'tagline' => 'Advanced molecular formulations',         'body' => 'Niche-grade molecules catering to high-growth sectors with stringent performance criteria.', 'bullets' => "Custom specifications\nCross-industry applications\nGMP-ready grades" ],
            [ 'title' => 'Phenol Derivatives',      'no' => '03', 'tagline' => 'Industrial intermediates, engineered',     'body' => 'Industry-leading intermediates manufactured under strict quality controls for downstream applications.', 'bullets' => "Large-scale availability\nStable supply chain\nREACH documentation" ],
            [ 'title' => 'Natural-Identical',       'no' => '04', 'tagline' => 'Nature-mimicking, sustainably sourced',    'body' => 'Sustainable, nature-mimicking ingredients that deliver authentic profiles without depleting natural resources.', 'bullets' => "Bio-inspired synthesis\nTraceable sourcing\nConsumer-safe grades" ],
            [ 'title' => 'Custom Manufacturing',    'no' => '05', 'tagline' => 'From lab bench to tonne-scale',            'body' => 'Bespoke, scalable molecule development tailored to specific client formulations and industrial needs.', 'bullets' => "NDA-protected\nLab → pilot → commercial\nDedicated campaigns" ],
        ],
        'industry' => [
            [ 'title' => 'Flavors & Fragrances',         'span' => 'hero',   'blurb' => 'Essential building blocks for global perfumery & sensory experiences.' ],
            [ 'title' => 'Cosmetics & Personal Care',    'span' => 'normal', 'blurb' => 'High-purity ingredients ensuring safety, stability & sensory excellence.' ],
            [ 'title' => 'Pharmaceuticals',              'span' => 'normal', 'blurb' => 'Rigorously tested intermediates for global health manufacturing.' ],
            [ 'title' => 'Food & Beverage',              'span' => 'normal', 'blurb' => 'Compliant food-grade ingredients elevating taste profiles consistently.' ],
            [ 'title' => 'Wellness & Nutraceuticals',    'span' => 'wide',   'blurb' => 'Specialized compounds designed for the modern health sector.' ],
        ],
        'timeline' => [
            [ 'title' => 'Group Origin',     'year' => '1997',   'body' => 'Gem Aromatics Ltd. founded — beginning a legacy in essential oils & aroma chemicals.' ],
            [ 'title' => 'Global Exports',   'year' => '2006',   'body' => 'Expanded distribution to flavour & fragrance houses across Europe, Americas & APAC.' ],
            [ 'title' => 'Custom Synthesis', 'year' => '2018',   'body' => 'Launched bespoke molecule engineering division for downstream industrial partners.' ],
            [ 'title' => 'KIPL Incorporated','year' => '2023',   'body' => 'Krystal Ingredients Pvt. Ltd. spun up as the next-generation specialty arm.' ],
            [ 'title' => 'Dahej Facility',   'year' => '2025',   'body' => 'Investment of ~₹230 Cr into a state-of-the-art fully automated plant.' ],
            [ 'title' => 'Global Scale',     'year' => 'Future', 'body' => 'Continuous-processing capacity targeting multi-thousand tonne annual output.' ],
        ],
    ];

    $order = 10;
    foreach ( $samples['product'] as $row ) {
        $post_id = wp_insert_post( [
            'post_type'    => 'kipl_product',
            'post_status'  => 'publish',
            'post_title'   => $row['title'],
            'post_content' => $row['body'],
            'menu_order'   => $order++,
        ] );
        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_kipl_product_no',      $row['no'] );
            update_post_meta( $post_id, '_kipl_product_tagline', $row['tagline'] );
            update_post_meta( $post_id, '_kipl_product_bullets', $row['bullets'] );
        }
    }

    $order = 10;
    foreach ( $samples['industry'] as $row ) {
        $post_id = wp_insert_post( [
            'post_type'   => 'kipl_industry',
            'post_status' => 'publish',
            'post_title'  => $row['title'],
            'menu_order'  => $order++,
        ] );
        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_kipl_industry_blurb', $row['blurb'] );
            update_post_meta( $post_id, '_kipl_industry_span',  $row['span'] );
        }
    }

    $order = 10;
    foreach ( $samples['timeline'] as $row ) {
        $post_id = wp_insert_post( [
            'post_type'    => 'kipl_timeline',
            'post_status'  => 'publish',
            'post_title'   => $row['title'],
            'post_content' => $row['body'],
            'menu_order'   => $order++,
        ] );
        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_kipl_timeline_year', $row['year'] );
        }
    }

    $insights = [
        [ 'title' => 'Continuous-flow chemistry: why Dahej is built around it', 'kicker' => 'Manufacturing · Editorial', 'minutes' => 6, 'excerpt' => 'How we re-architected our reactor block to eliminate batch-to-batch variance and unlock 99.5% conversion at tonne scale.' ],
        [ 'title' => 'Naturally-identical aroma: closing the gap on traceable sourcing', 'kicker' => 'Application Note · Fragrance', 'minutes' => 4, 'excerpt' => 'Inside our nature-mimicking synthesis program — and how it gives perfumers the consistency that natural extracts cannot.' ],
        [ 'title' => 'A pharma-grade phenol intermediate, audited for REACH', 'kicker' => 'Technical Bulletin · Pharma', 'minutes' => 3, 'excerpt' => 'Our latest phenol derivative campaign, with full DMF documentation and EU REACH dossiers attached.' ],
    ];
    if ( post_type_exists( 'kipl_insight' ) ) {
        $order = 10;
        foreach ( $insights as $row ) {
            $post_id = wp_insert_post( [
                'post_type'    => 'kipl_insight',
                'post_status'  => 'publish',
                'post_title'   => $row['title'],
                'post_excerpt' => $row['excerpt'],
                'post_content' => $row['excerpt'],
                'menu_order'   => $order++,
            ] );
            if ( $post_id && ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_kipl_insight_kicker',  $row['kicker'] );
                update_post_meta( $post_id, '_kipl_insight_minutes', $row['minutes'] );
            }
        }
    }
}

/* ===================================================================
 * Admin column tweaks for at-a-glance editing.
 * =================================================================== */
function kipl_product_columns( $cols ) {
    $cols = [
        'cb'    => $cols['cb'],
        'no'    => __( 'No.', 'krystal-ingredients' ),
        'title' => __( 'Title', 'krystal-ingredients' ),
        'tagline' => __( 'Tagline', 'krystal-ingredients' ),
        'order' => __( 'Order', 'krystal-ingredients' ),
    ];
    return $cols;
}
add_filter( 'manage_kipl_product_posts_columns', 'kipl_product_columns' );

function kipl_product_column_content( $col, $post_id ) {
    if ( $col === 'no' ) {
        echo esc_html( get_post_meta( $post_id, '_kipl_product_no', true ) );
    } elseif ( $col === 'tagline' ) {
        echo esc_html( get_post_meta( $post_id, '_kipl_product_tagline', true ) );
    } elseif ( $col === 'order' ) {
        echo absint( get_post_field( 'menu_order', $post_id ) );
    }
}
add_action( 'manage_kipl_product_posts_custom_column', 'kipl_product_column_content', 10, 2 );

function kipl_industry_columns( $cols ) {
    $cols = [
        'cb'    => $cols['cb'],
        'title' => __( 'Industry', 'krystal-ingredients' ),
        'span'  => __( 'Tile size', 'krystal-ingredients' ),
        'order' => __( 'Order', 'krystal-ingredients' ),
    ];
    return $cols;
}
add_filter( 'manage_kipl_industry_posts_columns', 'kipl_industry_columns' );

function kipl_industry_column_content( $col, $post_id ) {
    if ( $col === 'span' ) {
        echo esc_html( get_post_meta( $post_id, '_kipl_industry_span', true ) ?: 'normal' );
    } elseif ( $col === 'order' ) {
        echo absint( get_post_field( 'menu_order', $post_id ) );
    }
}
add_action( 'manage_kipl_industry_posts_custom_column', 'kipl_industry_column_content', 10, 2 );

function kipl_timeline_columns( $cols ) {
    $cols = [
        'cb'    => $cols['cb'],
        'year'  => __( 'Year', 'krystal-ingredients' ),
        'title' => __( 'Milestone', 'krystal-ingredients' ),
        'order' => __( 'Order', 'krystal-ingredients' ),
    ];
    return $cols;
}
add_filter( 'manage_kipl_timeline_posts_columns', 'kipl_timeline_columns' );

function kipl_timeline_column_content( $col, $post_id ) {
    if ( $col === 'year' ) {
        echo esc_html( get_post_meta( $post_id, '_kipl_timeline_year', true ) );
    } elseif ( $col === 'order' ) {
        echo absint( get_post_field( 'menu_order', $post_id ) );
    }
}
add_action( 'manage_kipl_timeline_posts_custom_column', 'kipl_timeline_column_content', 10, 2 );
