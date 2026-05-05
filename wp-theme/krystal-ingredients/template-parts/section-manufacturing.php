<?php
/**
 * Manufacturing / Dahej — split layout with hotspot map.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$highlights = [
    [ 'icon' => 'cpu',    'title' => kipl_field( 'mfg_h1_title' ), 'body' => kipl_field( 'mfg_h1_body' ) ],
    [ 'icon' => 'zap',    'title' => kipl_field( 'mfg_h2_title' ), 'body' => kipl_field( 'mfg_h2_body' ) ],
    [ 'icon' => 'shield', 'title' => kipl_field( 'mfg_h3_title' ), 'body' => kipl_field( 'mfg_h3_body' ) ],
];

$hotspots = [
    [ 'key' => 'reactions',    'label' => 'Reaction Block',    'x' => '22%', 'y' => '48%', 'detail' => 'Fully-automated batch & continuous reactors with inline process analytics.' ],
    [ 'key' => 'distillation', 'label' => 'Distillation Tower','x' => '52%', 'y' => '28%', 'detail' => 'Multi-stage fractional distillation for ultra-high purity separations.' ],
    [ 'key' => 'qc',           'label' => 'QC & Analytics Lab','x' => '78%', 'y' => '58%', 'detail' => 'GC-MS, HPLC & spectroscopy — every batch certified before release.' ],
];

$mfg_image_id = kipl_image_id( 'mfg_image' );
?>
<section id="manufacturing" class="relative py-24 md:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-14">
            <div class="lg:col-span-5 flex flex-col gap-10">
                <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
                    <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                        <span class="h-px w-6 bg-kipl-emerald"></span>
                        <?php echo esc_html( kipl_field( 'mfg_eyebrow' ) ); ?>
                    </span>
                    <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-kipl-navy">
                        <?php echo esc_html( kipl_field( 'mfg_title' ) ); ?>
                    </h2>
                    <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-slate-600">
                        <?php echo esc_html( kipl_field( 'mfg_sub' ) ); ?>
                    </p>
                </div>

                <div class="flex flex-col gap-4" data-kipl-stagger>
                    <?php foreach ( $highlights as $h ) : if ( ! $h['title'] ) continue; ?>
                        <div class="kipl-fadeup flex gap-4 p-5 rounded-2xl border border-slate-200 hover:border-kipl-emerald/40 hover:bg-kipl-slate transition-colors duration-300">
                            <div class="w-11 h-11 rounded-xl bg-kipl-navy text-kipl-emerald flex items-center justify-center flex-shrink-0">
                                <?php kipl_icon( $h['icon'], [ 'class' => 'w-5 h-5' ] ); ?>
                            </div>
                            <div>
                                <h4 class="font-display font-semibold text-kipl-navy"><?php echo esc_html( $h['title'] ); ?></h4>
                                <p class="text-sm text-slate-600 mt-1 leading-relaxed"><?php echo esc_html( $h['body'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="kipl-reveal relative rounded-3xl overflow-hidden border border-slate-200 bg-kipl-navy aspect-[4/3] lg:aspect-[5/4]" id="kipl-hotspot-map" data-active="reactions">
                    <?php if ( $mfg_image_id ) : ?>
                        <?php echo wp_get_attachment_image( $mfg_image_id, 'kipl-tile-wide', false, [
                            'class' => 'absolute inset-0 w-full h-full object-cover opacity-90',
                            'alt'   => __( 'KIPL Dahej facility', 'krystal-ingredients' ),
                        ] ); ?>
                    <?php else : ?>
                        <div class="absolute inset-0 bg-gradient-to-br from-[#0A192F] via-[#112240] to-[#022C22]"></div>
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-kipl-navy/80 via-transparent to-kipl-navy/30"></div>

                    <?php foreach ( $hotspots as $h ) : ?>
                        <button type="button" class="kipl-hotspot absolute -translate-x-1/2 -translate-y-1/2" style="left:<?php echo esc_attr( $h['x'] ); ?>; top:<?php echo esc_attr( $h['y'] ); ?>" data-hotspot="<?php echo esc_attr( $h['key'] ); ?>" data-label="<?php echo esc_attr( $h['label'] ); ?>" data-detail="<?php echo esc_attr( $h['detail'] ); ?>" aria-label="<?php echo esc_attr( $h['label'] ); ?>">
                            <span class="kipl-hotspot__dot block w-4 h-4 rounded-full bg-kipl-emerald"></span>
                            <span class="kipl-hotspot__label absolute top-6 left-1/2 -translate-x-1/2 whitespace-nowrap text-[11px] tracking-[0.18em] uppercase font-semibold px-3 py-1 rounded-full bg-kipl-navy/80 text-white transition-colors duration-300">
                                <?php echo esc_html( $h['label'] ); ?>
                            </span>
                        </button>
                    <?php endforeach; ?>

                    <div class="absolute bottom-6 left-6 right-6 p-5 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/15 text-white" id="kipl-hotspot-detail">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] tracking-[0.28em] uppercase text-kipl-emerald font-semibold">
                                <?php esc_html_e( 'Zone · ', 'krystal-ingredients' ); ?>
                                <span data-hotspot-active-label><?php echo esc_html( $hotspots[0]['label'] ); ?></span>
                            </span>
                            <span class="font-mono text-[10px] text-white/50" data-hotspot-active-index>1 / <?php echo count( $hotspots ); ?></span>
                        </div>
                        <p class="mt-2 text-sm text-white/85 leading-relaxed" data-hotspot-active-detail>
                            <?php echo esc_html( $hotspots[0]['detail'] ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
