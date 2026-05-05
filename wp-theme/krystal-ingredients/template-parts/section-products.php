<?php
/**
 * Products section — horizontal-snap card rail backed by the kipl_product CPT.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$products = get_posts( [
    'post_type'      => 'kipl_product',
    'posts_per_page' => 12,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );
?>
<section id="products" class="relative py-24 md:py-32 bg-white" data-kipl-pin-products>
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
                <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                    <span class="h-px w-6 bg-kipl-emerald"></span>
                    <?php echo esc_html( kipl_field( 'products_eyebrow' ) ); ?>
                </span>
                <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-kipl-navy">
                    <?php echo esc_html( kipl_field( 'products_title' ) ); ?>
                </h2>
                <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-slate-600">
                    <?php echo esc_html( kipl_field( 'products_sub' ) ); ?>
                </p>
            </div>

            <div class="hidden md:flex items-center gap-2">
                <button type="button" class="kipl-product-rail-prev w-11 h-11 rounded-full border border-slate-200 hover:border-kipl-navy flex items-center justify-center transition" aria-label="<?php esc_attr_e( 'Previous', 'krystal-ingredients' ); ?>">
                    <?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4 -scale-x-100' ] ); ?>
                </button>
                <button type="button" class="kipl-product-rail-next w-11 h-11 rounded-full border border-slate-200 hover:border-kipl-navy flex items-center justify-center transition" aria-label="<?php esc_attr_e( 'Next', 'krystal-ingredients' ); ?>">
                    <?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?>
                </button>
            </div>
        </div>

        <div id="kipl-product-rail" class="mt-12 flex gap-6 overflow-x-auto kipl-snap-x kipl-scrollbar pb-4 -mx-6 md:-mx-10 px-6 md:px-10" data-kipl-stagger data-kipl-pin-track>
            <?php if ( $products ) :
                foreach ( $products as $product ) :
                    $no      = get_post_meta( $product->ID, '_kipl_product_no', true );
                    $tagline = get_post_meta( $product->ID, '_kipl_product_tagline', true );
                    $bullets = get_post_meta( $product->ID, '_kipl_product_bullets', true );
                    $bullet_lines = array_filter( array_map( 'trim', preg_split( "/\r\n|\r|\n/", $bullets ) ) );
            ?>
                <article class="kipl-fadeup kipl-tilt group relative min-w-[300px] md:min-w-[360px] lg:min-w-[380px] rounded-3xl border border-slate-200 bg-kipl-slate p-8 overflow-hidden hover:-translate-y-1 hover:shadow-2xl hover:border-kipl-emerald/40 transition-all duration-300">
                    <svg viewBox="0 0 200 200" class="absolute -right-8 -bottom-8 w-48 h-48 opacity-0 group-hover:opacity-20 transition-opacity duration-500 text-kipl-emerald pointer-events-none" aria-hidden="true">
                        <g fill="none" stroke="currentColor" stroke-width="1.2">
                            <polygon points="100,30 160,60 160,130 100,160 40,130 40,60"/>
                            <circle cx="100" cy="30" r="5" fill="currentColor"/>
                            <circle cx="160" cy="60" r="5" fill="currentColor"/>
                            <circle cx="160" cy="130" r="5" fill="currentColor"/>
                            <circle cx="100" cy="160" r="5" fill="currentColor"/>
                            <circle cx="40" cy="130" r="5" fill="currentColor"/>
                            <circle cx="40" cy="60" r="5" fill="currentColor"/>
                            <circle cx="100" cy="95" r="7" fill="currentColor"/>
                            <line x1="100" y1="95" x2="100" y2="30"/>
                            <line x1="100" y1="95" x2="160" y2="60"/>
                            <line x1="100" y1="95" x2="160" y2="130"/>
                            <line x1="100" y1="95" x2="100" y2="160"/>
                            <line x1="100" y1="95" x2="40" y2="130"/>
                            <line x1="100" y1="95" x2="40" y2="60"/>
                        </g>
                    </svg>

                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs tracking-[0.22em] text-kipl-emerald"><?php echo esc_html( $no ); ?></span>
                        <span class="text-[10px] tracking-[0.2em] uppercase text-slate-500"><?php esc_html_e( 'Series', 'krystal-ingredients' ); ?></span>
                    </div>

                    <h3 class="mt-8 font-display font-bold text-2xl md:text-[28px] text-kipl-navy leading-tight">
                        <?php echo esc_html( $product->post_title ); ?>
                    </h3>
                    <?php if ( $tagline ) : ?>
                        <p class="mt-2 text-sm text-kipl-emerald font-semibold"><?php echo esc_html( $tagline ); ?></p>
                    <?php endif; ?>
                    <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                        <?php echo esc_html( wp_strip_all_tags( $product->post_content ) ); ?>
                    </p>

                    <?php if ( $bullet_lines ) : ?>
                        <ul class="mt-6 space-y-2 text-sm text-kipl-navy/80">
                            <?php foreach ( $bullet_lines as $b ) : ?>
                                <li class="flex items-start gap-2">
                                    <span class="text-kipl-emerald mt-0.5 flex-shrink-0"><?php kipl_icon( 'check', [ 'class' => 'w-4 h-4' ] ); ?></span>
                                    <span><?php echo esc_html( $b ); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <a href="#contact" class="inline-flex items-center gap-2 text-sm font-semibold text-kipl-navy hover:text-kipl-emerald transition-colors">
                            <?php esc_html_e( 'Request technical spec', 'krystal-ingredients' ); ?>
                            <?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?>
                        </a>
                    </div>
                </article>
            <?php endforeach;
                wp_reset_postdata();
            else : ?>
                <p class="text-sm text-slate-500">
                    <?php esc_html_e( 'Add product families via WP Admin → Products to populate this section.', 'krystal-ingredients' ); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>
