<?php
/**
 * Hero section — animated molecules + headline.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<section
    id="kipl-hero"
    class="relative min-h-[100svh] flex items-center overflow-hidden bg-kipl-navy text-white"
>
    <div class="absolute inset-0 bg-gradient-to-br from-kipl-navy via-[#0A1A35] to-[#061022]" aria-hidden="true"></div>

    <!-- WebGL liquid orb canvas (Tier 3) — populated by JS, transparent fallback -->
    <canvas id="kipl-liquid-orb" class="absolute inset-0 w-full h-full pointer-events-none opacity-90 mix-blend-screen" aria-hidden="true"></canvas>

    <!-- Three.js 3D molecule mount (Tier 3) — populated by JS; sits over the SVG fallback -->
    <div id="kipl-three-mount" class="absolute inset-0 pointer-events-none" aria-hidden="true"></div>

    <div id="kipl-hero-svg-scene" class="absolute inset-0 opacity-[0.85] transition-opacity duration-700" aria-hidden="true">
        <svg id="kipl-hero-scene" viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice" class="w-full h-full">
            <defs>
                <radialGradient id="kipl-node-glow" cx="50%" cy="50%" r="50%">
                    <stop offset="0%"   stop-color="#10B981" stop-opacity="0.9"/>
                    <stop offset="60%"  stop-color="#10B981" stop-opacity="0.25"/>
                    <stop offset="100%" stop-color="#10B981" stop-opacity="0"/>
                </radialGradient>
                <linearGradient id="kipl-bond" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%"   stop-color="#10B981" stop-opacity="0.75"/>
                    <stop offset="100%" stop-color="#38BDF8" stop-opacity="0.35"/>
                </linearGradient>
                <filter id="kipl-soft"><feGaussianBlur stdDeviation="1.2"/></filter>
            </defs>

            <g opacity="0.06" stroke="#CBD5E1" stroke-width="0.5">
                <?php for ( $i = 0; $i < 14; $i++ ) : ?>
                    <line x1="<?php echo $i*90; ?>" y1="0" x2="<?php echo $i*90; ?>" y2="800"/>
                <?php endfor; ?>
                <?php for ( $i = 0; $i < 10; $i++ ) : ?>
                    <line x1="0" y1="<?php echo $i*90; ?>" x2="1200" y2="<?php echo $i*90; ?>"/>
                <?php endfor; ?>
            </g>

            <g class="kipl-mol-spin" id="kipl-mol-spin" style="transform-origin:600px 400px">
                <?php
                $angles = [ 0, 60, 120, 180, 240, 300 ];
                foreach ( $angles as $a ) :
                    $rad = $a * M_PI / 180;
                    $x   = 600 + cos( $rad ) * 180;
                    $y   = 400 + sin( $rad ) * 180;
                ?>
                    <line x1="600" y1="400" x2="<?php echo round($x,2); ?>" y2="<?php echo round($y,2); ?>" stroke="url(#kipl-bond)" stroke-width="1.2" stroke-linecap="round" class="kipl-mol-bond"/>
                    <circle cx="<?php echo round($x,2); ?>" cy="<?php echo round($y,2); ?>" r="7" fill="#0A192F" stroke="#10B981" stroke-width="1.4" class="kipl-mol-node"/>
                <?php endforeach; ?>
                <circle cx="600" cy="400" r="10" fill="#10B981" filter="url(#kipl-soft)" class="kipl-mol-node"/>
            </g>

            <g class="kipl-mol-float-a" id="kipl-mol-a">
                <g transform="translate(220,180)">
                    <circle cx="60" cy="60" r="70" fill="url(#kipl-node-glow)"/>
                    <?php
                    $pts = [ [60,20], [100,45], [100,85], [60,110], [20,85], [20,45] ];
                    $count = count( $pts );
                    foreach ( $pts as $i => $p ) :
                        list( $cx, $cy ) = $p;
                        list( $nx, $ny ) = $pts[ ( $i + 1 ) % $count ];
                    ?>
                        <line x1="<?php echo $cx; ?>" y1="<?php echo $cy; ?>" x2="<?php echo $nx; ?>" y2="<?php echo $ny; ?>" stroke="#10B981" stroke-opacity="0.7" stroke-width="1.1" class="kipl-mol-bond"/>
                        <circle cx="<?php echo $cx; ?>" cy="<?php echo $cy; ?>" r="4" fill="#E2E8F0"/>
                    <?php endforeach; ?>
                </g>
            </g>

            <g class="kipl-mol-float-b" id="kipl-mol-b">
                <g transform="translate(880,500)">
                    <circle cx="60" cy="60" r="80" fill="url(#kipl-node-glow)"/>
                    <?php
                    $pts = [ [60,10], [110,40], [110,80], [60,110], [10,80], [10,40] ];
                    $count = count( $pts );
                    foreach ( $pts as $i => $p ) :
                        list( $cx, $cy ) = $p;
                        list( $nx, $ny ) = $pts[ ( $i + 2 ) % $count ];
                    ?>
                        <line x1="<?php echo $cx; ?>" y1="<?php echo $cy; ?>" x2="<?php echo $nx; ?>" y2="<?php echo $ny; ?>" stroke="#38BDF8" stroke-opacity="0.55" stroke-width="1" class="kipl-mol-bond"/>
                        <circle cx="<?php echo $cx; ?>" cy="<?php echo $cy; ?>" r="3.5" fill="#CBD5E1"/>
                    <?php endforeach; ?>
                </g>
            </g>

            <g opacity="0.5">
                <?php for ( $i = 0; $i < 70; $i++ ) :
                    $x = ( $i * 97 ) % 1200;
                    $y = ( $i * 173 ) % 800; ?>
                    <circle cx="<?php echo $x; ?>" cy="<?php echo $y; ?>" r="1.2" fill="#64748B"/>
                <?php endfor; ?>
            </g>
        </svg>
    </div>

    <div class="absolute inset-0" aria-hidden="true" style="background:radial-gradient(ellipse at center, transparent 0%, rgba(10,25,47,0.4) 60%, rgba(10,25,47,0.85) 100%)"></div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-10 w-full pt-28 md:pt-32 pb-24 md:pb-28">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end">
            <div class="lg:col-span-8" data-kipl-stagger>
                <span class="kipl-fadeup inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-semibold text-kipl-emerald">
                    <span class="h-px w-10 bg-kipl-emerald"></span>
                    <?php echo esc_html( kipl_field( 'hero_eyebrow' ) ); ?>
                </span>

                <h1 class="mt-6 font-display font-bold text-4xl sm:text-6xl lg:text-[5.25rem] leading-[0.98] tracking-tightest" data-kipl-split-text>
                    <span class="kipl-split-line"><?php echo esc_html( kipl_field( 'hero_title_a' ) ); ?></span>
                    <br/>
                    <span class="kipl-split-line relative inline-block text-kipl-emerald">
                        <?php echo esc_html( kipl_field( 'hero_title_accent' ) ); ?>
                        <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 220 10" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M2 8 C 60 2, 120 2, 218 8" stroke="#10B981" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="kipl-split-line"><?php echo esc_html( kipl_field( 'hero_title_b' ) ); ?></span>
                </h1>

                <p class="kipl-fadeup mt-8 max-w-xl text-base sm:text-lg text-white/70 leading-relaxed">
                    <?php echo esc_html( kipl_field( 'hero_sub' ) ); ?>
                </p>

                <div class="kipl-fadeup mt-10 flex flex-wrap items-center gap-4">
                    <a href="<?php echo esc_url( kipl_field( 'hero_cta_primary_link' ) ); ?>" class="group inline-flex items-center gap-2 bg-kipl-emerald text-white px-7 py-4 rounded-full text-sm font-semibold hover:bg-kipl-emerald-d transition-colors duration-300" data-kipl-magnetic>
                        <span data-kipl-magnetic-inner class="inline-flex items-center gap-2">
                            <?php echo esc_html( kipl_field( 'hero_cta_primary_label' ) ); ?>
                            <?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?>
                        </span>
                    </a>
                    <a href="<?php echo esc_url( kipl_field( 'hero_cta_secondary_link' ) ); ?>" class="inline-flex items-center gap-2 border border-white/25 text-white px-7 py-4 rounded-full text-sm font-semibold hover:bg-white/10 transition-colors duration-300" data-kipl-magnetic>
                        <span data-kipl-magnetic-inner class="inline-flex items-center gap-2">
                            <?php echo esc_html( kipl_field( 'hero_cta_secondary_label' ) ); ?>
                        </span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-4 kipl-fadeup">
                <div class="grid grid-cols-2 gap-4">
                    <?php for ( $i = 1; $i <= 4; $i++ ) :
                        $value = kipl_field( "hero_stat_{$i}_value" );
                        $label = kipl_field( "hero_stat_{$i}_label" );
                        if ( ! $value && ! $label ) continue;
                    ?>
                        <div class="kipl-tilt rounded-2xl border border-white/10 bg-white/[0.03] backdrop-blur-md p-5 hover:border-kipl-emerald/40 transition-colors duration-300">
                            <div class="font-display text-3xl font-bold text-white">
                                <span class="kipl-counter" data-target="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $value ); ?></span>
                            </div>
                            <div class="mt-1 text-xs text-white/60 uppercase tracking-[0.18em]"><?php echo esc_html( $label ); ?></div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="hidden md:flex absolute bottom-8 left-1/2 -translate-x-1/2 items-center gap-2 text-white/50 text-xs tracking-[0.28em] uppercase">
            <?php kipl_icon( 'mouse', [ 'class' => 'w-3.5 h-3.5' ] ); ?>
            <?php esc_html_e( 'Scroll to explore', 'krystal-ingredients' ); ?>
        </div>
    </div>
</section>
