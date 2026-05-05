<?php
/**
 * Numbers strip — animated counters that roll up on scroll.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$cells = [];
for ( $i = 1; $i <= 4; $i++ ) {
    $value  = kipl_field( "numbers_{$i}_value" );
    $suffix = kipl_field( "numbers_{$i}_suffix" );
    $label  = kipl_field( "numbers_{$i}_label" );
    if ( $value || $label ) {
        $cells[] = compact( 'value', 'suffix', 'label' );
    }
}
if ( ! $cells ) return;
?>
<section class="relative py-20 md:py-28 bg-white border-y border-slate-200 overflow-hidden">
    <div class="absolute -top-40 -right-32 w-[28rem] h-[28rem] rounded-full bg-kipl-emerald/5 blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-10">
        <div class="flex flex-col gap-3 max-w-3xl kipl-reveal">
            <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                <span class="h-px w-6 bg-kipl-emerald"></span>
                <?php echo esc_html( kipl_field( 'numbers_eyebrow' ) ); ?>
            </span>
            <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-kipl-navy">
                <?php echo esc_html( kipl_field( 'numbers_title' ) ); ?>
            </h2>
        </div>

        <div class="mt-12 md:mt-16 grid grid-cols-2 md:grid-cols-4 gap-px bg-slate-200 rounded-3xl overflow-hidden border border-slate-200" data-kipl-stagger>
            <?php foreach ( $cells as $cell ) : ?>
                <div class="kipl-fadeup relative bg-white p-8 md:p-10 group hover:bg-kipl-slate transition-colors duration-500">
                    <div class="font-display font-bold text-5xl md:text-6xl lg:text-7xl leading-none tracking-tightest text-kipl-navy flex items-baseline gap-1">
                        <span class="kipl-counter" data-target="<?php echo esc_attr( $cell['value'] ); ?>"><?php echo esc_html( $cell['value'] ); ?></span>
                        <span class="text-kipl-emerald text-3xl md:text-4xl lg:text-5xl"><?php echo esc_html( $cell['suffix'] ); ?></span>
                    </div>
                    <p class="mt-4 text-sm text-slate-600 leading-relaxed max-w-xs"><?php echo esc_html( $cell['label'] ); ?></p>
                    <span class="absolute bottom-0 left-0 h-px w-0 bg-kipl-emerald group-hover:w-full transition-all duration-700"></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
