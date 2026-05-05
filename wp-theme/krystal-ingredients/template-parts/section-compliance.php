<?php
/**
 * Compliance — marquee strip of certifications.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$badges_raw = kipl_field( 'compliance_list' );
$badges = array_filter( array_map( 'trim', explode( ',', $badges_raw ) ) );
?>
<section class="relative py-14 bg-white border-y border-slate-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="max-w-md">
                <span class="text-xs tracking-[0.28em] uppercase font-semibold text-kipl-emerald">
                    <?php echo esc_html( kipl_field( 'compliance_label' ) ); ?>
                </span>
                <p class="mt-2 font-display font-bold text-2xl text-kipl-navy leading-tight">
                    <?php echo esc_html( kipl_field( 'compliance_sub' ) ); ?>
                </p>
            </div>

            <div class="relative flex-1 overflow-hidden" aria-hidden="true">
                <div class="flex gap-10 kipl-marquee" style="width:max-content">
                    <?php
                    $loop = array_merge( $badges, $badges );
                    foreach ( $loop as $i => $b ) : ?>
                        <div class="flex items-center gap-3 text-kipl-navy font-mono text-sm whitespace-nowrap">
                            <span class="w-2 h-2 rounded-full bg-kipl-emerald"></span>
                            <?php echo esc_html( $b ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
