<?php
/**
 * 404 — Not found.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>

<section class="relative min-h-[80vh] flex items-center bg-kipl-navy text-white overflow-hidden">
    <div class="absolute -top-40 -right-32 w-[32rem] h-[32rem] rounded-full bg-kipl-emerald/10 blur-3xl" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-6 md:px-10 py-32 text-center">
        <div class="font-mono text-sm tracking-[0.32em] uppercase text-kipl-emerald">404 · Off-spec</div>
        <h1 class="mt-6 font-display font-bold text-5xl sm:text-6xl lg:text-7xl leading-[0.98] tracking-tight max-w-3xl mx-auto">
            <?php esc_html_e( 'This molecule is uncatalogued.', 'krystal-ingredients' ); ?>
        </h1>
        <p class="mt-6 text-white/70 max-w-xl mx-auto leading-relaxed">
            <?php esc_html_e( 'The page you were looking for is no longer in our index. Head back to the homepage or send our team a quick note.', 'krystal-ingredients' ); ?>
        </p>
        <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-2 bg-kipl-emerald text-white px-7 py-4 rounded-full text-sm font-semibold hover:bg-kipl-emerald-d hover:scale-[1.02] transition-all duration-300">
                <?php esc_html_e( 'Return home', 'krystal-ingredients' ); ?>
                <?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="inline-flex items-center gap-2 border border-white/25 px-7 py-4 rounded-full text-sm font-semibold hover:bg-white/10 transition-all duration-300">
                <?php esc_html_e( 'Contact our team', 'krystal-ingredients' ); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer();
