<?php
/**
 * Site footer.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
</main><!-- #site-content -->

<footer class="relative bg-kipl-navy text-white/70 pt-20 pb-10 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none opacity-30" aria-hidden="true">
        <div class="absolute -top-32 -left-24 w-96 h-96 rounded-full blur-3xl bg-kipl-emerald/10"></div>
        <div class="absolute bottom-0 right-0 w-[28rem] h-[28rem] rounded-full blur-3xl bg-sky-400/5"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-12 gap-10">
        <div class="md:col-span-5">
            <div class="flex items-center gap-3">
                <?php kipl_logo_mark( '#10B981', 36 ); ?>
                <div class="font-display text-white text-2xl font-bold tracking-tight">
                    <?php echo esc_html( kipl_field( 'brand_long' ) ); ?>
                </div>
            </div>
            <p class="mt-6 text-white/60 max-w-md leading-relaxed">
                <?php echo esc_html( kipl_field( 'footer_blurb' ) ); ?>
            </p>
            <div class="mt-8 flex flex-col gap-2 text-sm">
                <div class="flex items-start gap-3">
                    <span class="text-kipl-emerald mt-0.5"><?php kipl_icon( 'pin', [ 'class' => 'w-4 h-4' ] ); ?></span>
                    <span><?php echo esc_html( kipl_field( 'office_hq_label' ) ); ?> — <?php echo esc_html( kipl_field( 'office_hq_city' ) ); ?>, <?php echo esc_html( kipl_field( 'office_hq_country' ) ); ?></span>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-kipl-emerald mt-0.5"><?php kipl_icon( 'pin', [ 'class' => 'w-4 h-4' ] ); ?></span>
                    <span><?php echo esc_html( kipl_field( 'office_mfg_label' ) ); ?> — <?php echo esc_html( kipl_field( 'office_mfg_city' ) ); ?>, <?php echo esc_html( kipl_field( 'office_mfg_country' ) ); ?></span>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-kipl-emerald mt-0.5"><?php kipl_icon( 'mail', [ 'class' => 'w-4 h-4' ] ); ?></span>
                    <a href="mailto:<?php echo esc_attr( kipl_field( 'contact_email' ) ); ?>" class="hover:text-white">
                        <?php echo esc_html( kipl_field( 'contact_email' ) ); ?>
                    </a>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-kipl-emerald mt-0.5"><?php kipl_icon( 'phone', [ 'class' => 'w-4 h-4' ] ); ?></span>
                    <span><?php echo esc_html( kipl_field( 'contact_phone' ) ); ?></span>
                </div>
            </div>
        </div>

        <div class="md:col-span-2">
            <h4 class="text-xs tracking-[0.22em] uppercase font-semibold text-white mb-5">
                <?php esc_html_e( 'Company', 'krystal-ingredients' ); ?>
            </h4>
            <?php
            if ( has_nav_menu( 'footer' ) ) {
                wp_nav_menu( [
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'space-y-3 text-sm',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ] );
            } else {
                ?>
                <ul class="space-y-3 text-sm">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white"><?php esc_html_e( 'Home', 'krystal-ingredients' ); ?></a></li>
                    <li><a href="#manufacturing" class="hover:text-white"><?php esc_html_e( 'Manufacturing', 'krystal-ingredients' ); ?></a></li>
                    <li><a href="#sustainability" class="hover:text-white"><?php esc_html_e( 'Sustainability', 'krystal-ingredients' ); ?></a></li>
                    <li><a href="#contact" class="hover:text-white"><?php esc_html_e( 'Contact', 'krystal-ingredients' ); ?></a></li>
                </ul>
                <?php
            }
            ?>
        </div>

        <div class="md:col-span-2">
            <h4 class="text-xs tracking-[0.22em] uppercase font-semibold text-white mb-5">
                <?php esc_html_e( 'Solutions', 'krystal-ingredients' ); ?>
            </h4>
            <ul class="space-y-3 text-sm">
                <?php
                $product_titles = get_posts( [
                    'post_type'      => 'kipl_product',
                    'posts_per_page' => 4,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'fields'         => 'ids',
                ] );
                if ( ! $product_titles ) {
                    foreach ( [ 'Aroma Chemicals', 'Specialty Ingredients', 'Phenol Derivatives', 'Custom Manufacturing' ] as $t ) {
                        printf( '<li><a href="#products" class="hover:text-white">%s</a></li>', esc_html( $t ) );
                    }
                } else {
                    foreach ( $product_titles as $pid ) {
                        printf(
                            '<li><a href="#products" class="hover:text-white">%s</a></li>',
                            esc_html( get_the_title( $pid ) )
                        );
                    }
                }
                ?>
            </ul>
        </div>

        <div class="md:col-span-3">
            <h4 class="text-xs tracking-[0.22em] uppercase font-semibold text-white mb-5">
                <?php esc_html_e( 'Partner with KIPL', 'krystal-ingredients' ); ?>
            </h4>
            <p class="text-sm text-white/60 mb-4">
                <?php esc_html_e( 'Global export, custom synthesis and specification inquiries.', 'krystal-ingredients' ); ?>
            </p>
            <a href="#contact" class="inline-flex items-center gap-2 bg-kipl-emerald text-white px-5 py-3 rounded-full text-sm font-semibold hover:bg-kipl-emerald-d hover:scale-[1.02] transition-all duration-300">
                <?php esc_html_e( 'Request Consultation', 'krystal-ingredients' ); ?>
                <?php kipl_icon( 'arrow-up-right', [ 'class' => 'w-4 h-4' ] ); ?>
            </a>
        </div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-10 mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between gap-4 text-xs text-white/40">
        <span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( kipl_field( 'brand_long' ) ); ?> Pvt. Ltd. — A subsidiary of Gem Aromatics Ltd.</span>
        <span class="font-mono">v<?php echo esc_html( KIPL_THEME_VERSION ); ?> · Engineered in India · Delivered globally</span>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
