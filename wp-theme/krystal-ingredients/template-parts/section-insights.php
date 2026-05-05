<?php
/**
 * Insights teaser — newsroom strip backed by the kipl_insight CPT.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$insights = get_posts( [
    'post_type'      => 'kipl_insight',
    'posts_per_page' => 3,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
] );
if ( ! $insights ) return;
?>
<section class="relative py-24 md:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8">
            <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
                <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                    <span class="h-px w-6 bg-kipl-emerald"></span>
                    <?php echo esc_html( kipl_field( 'insights_eyebrow' ) ); ?>
                </span>
                <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-kipl-navy">
                    <?php echo esc_html( kipl_field( 'insights_title' ) ); ?>
                </h2>
                <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-slate-600">
                    <?php echo esc_html( kipl_field( 'insights_sub' ) ); ?>
                </p>
            </div>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'kipl_insight' ) ?: '#' ); ?>" class="hidden md:inline-flex items-center gap-2 text-sm font-semibold text-kipl-navy hover:text-kipl-emerald transition-colors group">
                <?php esc_html_e( 'Browse the newsroom', 'krystal-ingredients' ); ?>
                <span class="group-hover:translate-x-1 transition-transform"><?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?></span>
            </a>
        </div>

        <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-6" data-kipl-stagger>
            <?php foreach ( $insights as $insight ) :
                $kicker  = get_post_meta( $insight->ID, '_kipl_insight_kicker', true );
                $minutes = absint( get_post_meta( $insight->ID, '_kipl_insight_minutes', true ) );
                $img     = get_the_post_thumbnail_url( $insight->ID, 'kipl-tile-wide' );
                $excerpt = $insight->post_excerpt ?: wp_trim_words( wp_strip_all_tags( $insight->post_content ), 22 );
            ?>
                <a href="<?php echo esc_url( get_permalink( $insight ) ); ?>" class="kipl-fadeup kipl-tilt group rounded-3xl overflow-hidden border border-slate-200 bg-kipl-slate hover:-translate-y-1 hover:shadow-xl hover:border-kipl-emerald/40 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[16/10] overflow-hidden bg-kipl-navy">
                        <?php if ( $img ) : ?>
                            <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $insight->post_title ); ?>" loading="lazy" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                        <?php else : ?>
                            <div class="absolute inset-0 bg-gradient-to-br from-kipl-navy via-[#0A1A35] to-kipl-emerald-x"></div>
                            <svg class="absolute right-6 bottom-6 w-24 h-24 text-kipl-emerald/40" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <polygon points="50,15 80,32 80,68 50,85 20,68 20,32"/>
                                <circle cx="50" cy="50" r="6" fill="currentColor"/>
                            </svg>
                        <?php endif; ?>
                        <span class="absolute top-4 left-4 inline-flex items-center gap-2 bg-kipl-navy/90 backdrop-blur text-white text-[10px] tracking-[0.22em] uppercase font-semibold px-3 py-1 rounded-full">
                            <?php echo esc_html( $kicker ?: __( 'Insight', 'krystal-ingredients' ) ); ?>
                        </span>
                    </div>
                    <div class="p-7 flex flex-col flex-1">
                        <h3 class="font-display font-bold text-xl text-kipl-navy leading-tight group-hover:text-kipl-emerald transition-colors">
                            <?php echo esc_html( $insight->post_title ); ?>
                        </h3>
                        <p class="mt-3 text-sm text-slate-600 leading-relaxed flex-1">
                            <?php echo esc_html( $excerpt ); ?>
                        </p>
                        <div class="mt-6 pt-5 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500 tracking-wide">
                            <span><?php echo esc_html( get_the_date( '', $insight ) ); ?></span>
                            <?php if ( $minutes ) : ?>
                                <span><?php printf( esc_html__( '%d min read', 'krystal-ingredients' ), $minutes ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
