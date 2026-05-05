<?php
/**
 * Single post template.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>

<section class="relative pt-36 md:pt-44 pb-16 md:pb-24 bg-kipl-navy text-white overflow-hidden">
    <div class="absolute -top-40 -right-32 w-[32rem] h-[32rem] rounded-full bg-kipl-emerald/10 blur-3xl" aria-hidden="true"></div>
    <div class="relative max-w-3xl mx-auto px-6 md:px-10">
        <?php while ( have_posts() ) : the_post(); ?>
            <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-semibold text-kipl-emerald">
                <span class="h-px w-8 bg-kipl-emerald"></span>
                <?php echo esc_html( get_the_date() ); ?>
            </span>
            <h1 class="mt-6 font-display font-bold text-4xl sm:text-5xl leading-[1.05] tracking-tight">
                <?php the_title(); ?>
            </h1>
            <p class="mt-6 text-white/60 text-sm">
                <?php
                printf(
                    esc_html__( 'By %1$s · %2$s read', 'krystal-ingredients' ),
                    esc_html( get_the_author() ),
                    esc_html( max( 1, (int) round( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) ) . ' min'
                ) );
                ?>
            </p>
        <?php endwhile; rewind_posts(); ?>
    </div>
</section>

<?php while ( have_posts() ) : the_post(); ?>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="relative bg-white">
            <div class="max-w-5xl mx-auto px-6 md:px-10 -mt-12 md:-mt-16">
                <?php the_post_thumbnail( 'large', [ 'class' => 'rounded-3xl border border-slate-200 shadow-2xl w-full h-auto' ] ); ?>
            </div>
        </div>
    <?php endif; ?>

    <section class="relative py-16 md:py-20 bg-white">
        <article <?php post_class( 'max-w-3xl mx-auto px-6 md:px-10 prose prose-slate prose-headings:font-display prose-headings:tracking-tight prose-a:text-kipl-emerald hover:prose-a:text-kipl-emerald-d' ); ?>>
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
        </article>
    </section>

    <section class="relative pb-24 bg-white">
        <div class="max-w-3xl mx-auto px-6 md:px-10">
            <?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer();
