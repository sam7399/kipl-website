<?php
/**
 * Generic page template.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>

<section class="relative pt-36 md:pt-44 pb-16 md:pb-24 bg-kipl-navy text-white overflow-hidden">
    <div class="absolute -top-40 -right-32 w-[32rem] h-[32rem] rounded-full bg-kipl-emerald/10 blur-3xl" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-6 md:px-10">
        <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-semibold text-kipl-emerald">
            <span class="h-px w-8 bg-kipl-emerald"></span>
            <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
        </span>
        <h1 class="mt-6 font-display font-bold text-4xl sm:text-5xl lg:text-6xl leading-[1.05] tracking-tight max-w-4xl">
            <?php the_title(); ?>
        </h1>
    </div>
</section>

<section class="relative py-20 bg-white">
    <article class="max-w-3xl mx-auto px-6 md:px-10 prose prose-slate prose-headings:font-display prose-headings:tracking-tight prose-a:text-kipl-emerald hover:prose-a:text-kipl-emerald-d">
        <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
    </article>
</section>

<?php get_footer();
