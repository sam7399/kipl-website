<?php
/**
 * Awards / press strip — split layout with editorial header + award rows.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$awards_raw = kipl_field( 'awards_list' );
$awards     = array_filter( array_map( 'trim', explode( ',', $awards_raw ) ) );
if ( ! $awards ) return;
?>
<section class="relative py-24 md:py-32 bg-kipl-slate overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-4 flex flex-col gap-4 kipl-reveal">
                <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                    <span class="h-px w-6 bg-kipl-emerald"></span>
                    <?php echo esc_html( kipl_field( 'awards_label' ) ); ?>
                </span>
                <h2 class="font-display font-bold text-3xl sm:text-4xl leading-[1.1] tracking-tight text-kipl-navy">
                    <?php echo esc_html( kipl_field( 'awards_sub' ) ); ?>
                </h2>
            </div>

            <ul class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 divide-y divide-slate-200 sm:divide-y-0 sm:divide-x sm:gap-0 border-t border-b border-slate-200 sm:border" data-kipl-stagger>
                <?php foreach ( $awards as $i => $award ) :
                    $parts = array_map( 'trim', explode( '·', $award, 2 ) );
                    $main  = $parts[0] ?? $award;
                    $sub   = $parts[1] ?? '';
                ?>
                    <li class="kipl-fadeup group flex items-center justify-between gap-6 px-6 py-6 hover:bg-white transition-colors duration-300">
                        <div>
                            <div class="font-display font-semibold text-lg text-kipl-navy leading-tight"><?php echo esc_html( $main ); ?></div>
                            <?php if ( $sub ) : ?>
                                <div class="mt-1 text-xs tracking-[0.22em] uppercase text-slate-500"><?php echo esc_html( $sub ); ?></div>
                            <?php endif; ?>
                        </div>
                        <span class="font-mono text-xs tracking-[0.18em] text-kipl-emerald opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <?php printf( '%02d', $i + 1 ); ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
