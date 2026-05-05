<?php
/**
 * Industries — bento grid backed by the kipl_industry CPT.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$industries = get_posts( [
    'post_type'      => 'kipl_industry',
    'posts_per_page' => 12,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

$span_class = [
    'normal' => 'md:col-span-1',
    'wide'   => 'md:col-span-2',
    'hero'   => 'md:col-span-2 md:row-span-2',
];
?>
<section id="industries" class="relative py-24 md:py-32 bg-kipl-slate">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
            <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                <span class="h-px w-6 bg-kipl-emerald"></span>
                <?php echo esc_html( kipl_field( 'industries_eyebrow' ) ); ?>
            </span>
            <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-kipl-navy">
                <?php echo esc_html( kipl_field( 'industries_title' ) ); ?>
            </h2>
            <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-slate-600">
                <?php echo esc_html( kipl_field( 'industries_sub' ) ); ?>
            </p>
        </div>

        <div class="mt-14 grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-4 md:gap-5 md:auto-rows-[280px]" data-kipl-stagger>
            <?php if ( $industries ) :
                $count = count( $industries );
                foreach ( $industries as $i => $industry ) :
                    $blurb = get_post_meta( $industry->ID, '_kipl_industry_blurb', true );
                    $span  = get_post_meta( $industry->ID, '_kipl_industry_span', true ) ?: 'normal';
                    $cls   = $span_class[ $span ] ?? $span_class['normal'];
                    $img   = get_the_post_thumbnail_url( $industry->ID, 'kipl-tile-wide' );
            ?>
                <div class="kipl-fadeup kipl-tilt kipl-mask-reveal group relative rounded-3xl overflow-hidden border border-slate-200 <?php echo esc_attr( $cls ); ?> min-h-[240px] hover:scale-[1.01] transition-transform duration-500">
                    <?php if ( $img ) : ?>
                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $industry->post_title ); ?>" loading="lazy" class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.06] transition-transform duration-[1200ms] ease-out"/>
                    <?php else : ?>
                        <div class="absolute inset-0 bg-gradient-to-br from-kipl-navy via-[#112240] to-kipl-emerald-x"></div>
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-kipl-navy/90 via-kipl-navy/40 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-kipl-emerald/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative h-full flex flex-col justify-between p-6 md:p-7 text-white">
                        <div class="flex items-start justify-between">
                            <span class="font-mono text-[11px] tracking-[0.2em] text-white/70">
                                <?php printf( '%02d / %02d', $i + 1, $count ); ?>
                            </span>
                            <span class="w-9 h-9 rounded-full bg-white/10 backdrop-blur flex items-center justify-center border border-white/20 group-hover:bg-kipl-emerald group-hover:border-kipl-emerald transition-all duration-300">
                                <?php kipl_icon( 'arrow-up-right', [ 'class' => 'w-4 h-4' ] ); ?>
                            </span>
                        </div>

                        <div>
                            <h3 class="font-display font-bold text-xl md:text-2xl lg:text-3xl leading-tight">
                                <?php echo esc_html( $industry->post_title ); ?>
                            </h3>
                            <p class="mt-2 text-sm text-white/70 max-w-sm leading-relaxed">
                                <?php echo esc_html( $blurb ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach;
                wp_reset_postdata();
            else : ?>
                <p class="text-sm text-slate-500"><?php esc_html_e( 'Add industry tiles via WP Admin → Industries.', 'krystal-ingredients' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
