<?php
/**
 * Two Brands — split-screen narrative tying Gem Aromatics legacy to KIPL's
 * next-generation specialty platform. Visually anchors the parent-subsidiary
 * story on the homepage.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<section class="relative py-24 md:py-32 bg-kipl-navy text-white overflow-hidden">
    <div class="absolute -top-40 -left-32 w-[36rem] h-[36rem] rounded-full bg-kipl-emerald/15 blur-[120px]" aria-hidden="true"></div>
    <div class="absolute -bottom-40 -right-32 w-[36rem] h-[36rem] rounded-full bg-sky-500/10 blur-[120px]" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-10">
        <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
            <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                <span class="h-px w-6 bg-kipl-emerald"></span>
                <?php echo esc_html( kipl_field( 'two_brands_eyebrow' ) ); ?>
            </span>
            <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.1] tracking-tight">
                <?php echo esc_html( kipl_field( 'two_brands_title' ) ); ?>
            </h2>
            <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-white/65">
                <?php echo esc_html( kipl_field( 'two_brands_sub' ) ); ?>
            </p>
        </div>

        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-px bg-white/10 rounded-3xl overflow-hidden border border-white/10 backdrop-blur" data-kipl-stagger>

            <!-- Gem Aromatics -->
            <article class="kipl-fadeup kipl-tilt relative bg-kipl-navy/50 p-8 md:p-12 group hover:bg-kipl-navy-2/70 transition-colors duration-500">
                <div class="flex items-center justify-between text-xs tracking-[0.28em] uppercase">
                    <span class="text-white/45 font-mono">Parent</span>
                    <span class="text-kipl-emerald font-semibold"><?php echo esc_html( kipl_field( 'gem_year' ) ); ?></span>
                </div>

                <h3 class="mt-8 font-display font-bold text-3xl md:text-4xl tracking-tight leading-tight">
                    <?php echo esc_html( kipl_field( 'gem_label' ) ); ?>
                </h3>
                <p class="mt-5 text-white/70 leading-relaxed max-w-md">
                    <?php echo esc_html( kipl_field( 'gem_blurb' ) ); ?>
                </p>

                <a href="<?php echo esc_url( kipl_field( 'gem_link' ) ); ?>" target="_blank" rel="noopener" class="mt-10 inline-flex items-center gap-2 text-sm font-semibold text-white hover:text-kipl-emerald transition-colors group/link">
                    <?php echo esc_html( kipl_field( 'gem_link_label' ) ); ?>
                    <span class="group-hover/link:translate-x-1 transition-transform"><?php kipl_icon( 'arrow-up-right', [ 'class' => 'w-4 h-4' ] ); ?></span>
                </a>

                <!-- watermark hexagon -->
                <svg class="absolute -right-12 -bottom-16 w-64 h-64 text-white/[0.03] pointer-events-none" viewBox="0 0 100 100" fill="currentColor" aria-hidden="true">
                    <polygon points="50,5 92,28 92,72 50,95 8,72 8,28"/>
                </svg>
            </article>

            <!-- Krystal Ingredients -->
            <article class="kipl-fadeup kipl-tilt relative bg-kipl-emerald-x/50 p-8 md:p-12 group hover:bg-kipl-emerald-x/80 transition-colors duration-500">
                <div class="flex items-center justify-between text-xs tracking-[0.28em] uppercase">
                    <span class="text-white/45 font-mono">Specialty Arm</span>
                    <span class="text-kipl-emerald font-semibold"><?php echo esc_html( kipl_field( 'kipl_year' ) ); ?></span>
                </div>

                <h3 class="mt-8 font-display font-bold text-3xl md:text-4xl tracking-tight leading-tight">
                    <?php echo esc_html( kipl_field( 'kipl_label' ) ); ?>
                </h3>
                <p class="mt-5 text-white/75 leading-relaxed max-w-md">
                    <?php echo esc_html( kipl_field( 'kipl_blurb' ) ); ?>
                </p>

                <a href="<?php echo esc_url( kipl_field( 'kipl_link' ) ); ?>" class="mt-10 inline-flex items-center gap-2 text-sm font-semibold text-white hover:text-kipl-emerald transition-colors group/link">
                    <?php echo esc_html( kipl_field( 'kipl_link_label' ) ); ?>
                    <span class="group-hover/link:translate-x-1 transition-transform"><?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?></span>
                </a>

                <!-- watermark molecule -->
                <svg class="absolute -right-8 -bottom-10 w-56 h-56 text-kipl-emerald/[0.06] pointer-events-none" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                    <polygon points="50,15 80,32 80,68 50,85 20,68 20,32"/>
                    <circle cx="50" cy="50" r="4" fill="currentColor"/>
                    <line x1="50" y1="50" x2="50" y2="15"/>
                    <line x1="50" y1="50" x2="80" y2="32"/>
                    <line x1="50" y1="50" x2="80" y2="68"/>
                    <line x1="50" y1="50" x2="50" y2="85"/>
                    <line x1="50" y1="50" x2="20" y2="68"/>
                    <line x1="50" y1="50" x2="20" y2="32"/>
                </svg>
            </article>
        </div>
    </div>
</section>
