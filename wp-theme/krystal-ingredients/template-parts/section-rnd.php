<?php
/**
 * R&D — split image + capabilities.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$caps = [
    [ 'icon' => 'flask',      'title' => kipl_field( 'rnd_c1_title' ), 'body' => kipl_field( 'rnd_c1_body' ) ],
    [ 'icon' => 'atom',       'title' => kipl_field( 'rnd_c2_title' ), 'body' => kipl_field( 'rnd_c2_body' ) ],
    [ 'icon' => 'microscope', 'title' => kipl_field( 'rnd_c3_title' ), 'body' => kipl_field( 'rnd_c3_body' ) ],
];

$rnd_image_id = kipl_image_id( 'rnd_image' );
?>
<section id="rnd" class="relative py-24 md:py-32 bg-kipl-slate">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="kipl-reveal lg:col-span-6 relative rounded-3xl overflow-hidden border border-slate-200 aspect-[4/3]">
                <?php if ( $rnd_image_id ) : ?>
                    <?php echo wp_get_attachment_image( $rnd_image_id, 'kipl-tile-wide', false, [
                        'class' => 'absolute inset-0 w-full h-full object-cover',
                        'alt'   => __( 'KIPL research laboratory', 'krystal-ingredients' ),
                    ] ); ?>
                <?php else : ?>
                    <div class="absolute inset-0 bg-gradient-to-br from-kipl-navy via-[#0A1A35] to-kipl-emerald-x"></div>
                <?php endif; ?>
                <div class="absolute inset-0 bg-gradient-to-t from-kipl-navy/70 to-transparent"></div>

                <svg viewBox="0 0 400 260" class="absolute bottom-6 left-6 right-6 w-[calc(100%-3rem)] h-32 text-white/90" aria-hidden="true">
                    <g fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round">
                        <line x1="20" y1="130" x2="70" y2="100"/>
                        <line x1="70" y1="100" x2="120" y2="130"/>
                        <line x1="120" y1="130" x2="170" y2="100"/>
                        <line x1="170" y1="100" x2="220" y2="130"/>
                        <line x1="220" y1="130" x2="270" y2="100"/>
                        <line x1="270" y1="100" x2="320" y2="130"/>
                        <line x1="320" y1="130" x2="370" y2="100"/>
                        <line x1="170" y1="100" x2="170" y2="60"/>
                        <circle cx="170" cy="50" r="8" stroke="#10B981"/>
                        <text x="165" y="54" font-family="JetBrains Mono" font-size="12" fill="#10B981" stroke="none">O</text>
                        <circle cx="270" cy="100" r="8" stroke="#10B981"/>
                        <text x="265" y="104" font-family="JetBrains Mono" font-size="12" fill="#10B981" stroke="none">H</text>
                    </g>
                    <text x="20" y="230" font-family="JetBrains Mono" font-size="10" fill="#10B981">
                        C10H14O · molecular weight 150.22 g/mol · purity ≥ 99.5%
                    </text>
                </svg>

                <div class="absolute top-6 left-6 flex items-center gap-2 text-xs tracking-[0.2em] uppercase text-white/80">
                    <span class="w-2 h-2 rounded-full bg-kipl-emerald" style="animation:kipl-pulse 2s ease-in-out infinite"></span>
                    <?php esc_html_e( 'Live · R&D Lab, Mumbai', 'krystal-ingredients' ); ?>
                </div>
            </div>

            <div class="lg:col-span-6">
                <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
                    <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                        <span class="h-px w-6 bg-kipl-emerald"></span>
                        <?php echo esc_html( kipl_field( 'rnd_eyebrow' ) ); ?>
                    </span>
                    <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-kipl-navy">
                        <?php echo esc_html( kipl_field( 'rnd_title' ) ); ?>
                    </h2>
                    <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-slate-600">
                        <?php echo esc_html( kipl_field( 'rnd_sub' ) ); ?>
                    </p>
                </div>

                <div class="mt-10 space-y-3" data-kipl-stagger>
                    <?php foreach ( $caps as $c ) : if ( ! $c['title'] ) continue; ?>
                        <div class="kipl-fadeup flex gap-4 p-5 rounded-2xl bg-white border border-slate-200 hover:border-kipl-emerald/40 hover:-translate-y-0.5 transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-kipl-emerald/10 text-kipl-emerald flex items-center justify-center flex-shrink-0">
                                <?php kipl_icon( $c['icon'], [ 'class' => 'w-5 h-5' ] ); ?>
                            </div>
                            <div>
                                <div class="font-display font-semibold text-kipl-navy"><?php echo esc_html( $c['title'] ); ?></div>
                                <p class="text-sm text-slate-600 mt-1 leading-relaxed"><?php echo esc_html( $c['body'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
