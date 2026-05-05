<?php
/**
 * Generic loop fallback — used when no more specific template applies.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>

<section class="relative pt-36 md:pt-44 pb-16 bg-kipl-navy text-white overflow-hidden">
    <div class="absolute -top-40 -right-32 w-[32rem] h-[32rem] rounded-full bg-kipl-emerald/10 blur-3xl" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-6 md:px-10">
        <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-semibold text-kipl-emerald">
            <span class="h-px w-8 bg-kipl-emerald"></span>
            <?php esc_html_e( 'Latest', 'krystal-ingredients' ); ?>
        </span>
        <h1 class="mt-6 font-display font-bold text-4xl sm:text-5xl lg:text-6xl leading-[1.05] tracking-tight">
            <?php
            if ( is_search() ) {
                printf( esc_html__( 'Results for "%s"', 'krystal-ingredients' ), '<span class="text-kipl-emerald">' . esc_html( get_search_query() ) . '</span>' );
            } elseif ( is_archive() ) {
                the_archive_title();
            } else {
                esc_html_e( 'From the Krystal Ingredients newsroom', 'krystal-ingredients' );
            }
            ?>
        </h1>
    </div>
</section>

<section class="relative py-24 bg-white">
    <div class="max-w-5xl mx-auto px-6 md:px-10">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class( 'group rounded-3xl overflow-hidden border border-slate-200 bg-kipl-slate hover:-translate-y-1 hover:shadow-xl transition-all duration-300' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="block aspect-[16/10] overflow-hidden">
                                <?php the_post_thumbnail( 'kipl-tile-wide', [ 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700' ] ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="p-7">
                            <div class="text-[11px] tracking-[0.22em] uppercase text-kipl-emerald font-semibold">
                                <?php echo esc_html( get_the_date() ); ?>
                            </div>
                            <h2 class="mt-3 font-display font-bold text-xl text-kipl-navy leading-tight">
                                <a href="<?php the_permalink(); ?>" class="hover:text-kipl-emerald transition-colors"><?php the_title(); ?></a>
                            </h2>
                            <p class="mt-3 text-sm text-slate-600 leading-relaxed"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-kipl-navy hover:text-kipl-emerald">
                                <?php esc_html_e( 'Read more', 'krystal-ingredients' ); ?>
                                <?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="mt-16 flex justify-center gap-4 text-sm text-kipl-navy/70">
                <?php
                the_posts_pagination( [
                    'prev_text' => __( 'Previous', 'krystal-ingredients' ),
                    'next_text' => __( 'Next', 'krystal-ingredients' ),
                    'class'     => 'flex gap-3',
                ] );
                ?>
            </div>
        <?php else : ?>
            <p class="text-slate-600"><?php esc_html_e( 'Nothing to display yet.', 'krystal-ingredients' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
