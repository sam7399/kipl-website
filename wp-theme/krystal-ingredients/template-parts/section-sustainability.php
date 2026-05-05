<?php
/**
 * Sustainability — emerald-deep section with three pillars and a report CTA.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$pillars = [
    [ 'icon' => 'leaf',      'title' => kipl_field( 'sus_p1_title' ), 'body' => kipl_field( 'sus_p1_body' ) ],
    [ 'icon' => 'shield',    'title' => kipl_field( 'sus_p2_title' ), 'body' => kipl_field( 'sus_p2_body' ) ],
    [ 'icon' => 'handshake', 'title' => kipl_field( 'sus_p3_title' ), 'body' => kipl_field( 'sus_p3_body' ) ],
];

$report_url = kipl_field( 'sus_report_url' );
?>
<section id="sustainability" class="relative py-24 md:py-32 text-white overflow-hidden" style="background-color:#022C22">
    <div class="absolute inset-0 bg-gradient-to-br from-[#022C22] via-[#022C22]/95 to-[#034430]/90" aria-hidden="true"></div>
    <div class="absolute -top-40 -left-20 w-[30rem] h-[30rem] bg-kipl-emerald/10 blur-3xl rounded-full" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-10">
        <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
            <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                <span class="h-px w-6 bg-kipl-emerald"></span>
                <?php echo esc_html( kipl_field( 'sus_eyebrow' ) ); ?>
            </span>
            <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-white">
                <?php echo esc_html( kipl_field( 'sus_title' ) ); ?>
            </h2>
            <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-white/70">
                <?php echo esc_html( kipl_field( 'sus_sub' ) ); ?>
            </p>
        </div>

        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-5" data-kipl-stagger>
            <?php foreach ( $pillars as $p ) : if ( ! $p['title'] ) continue; ?>
                <div class="kipl-fadeup rounded-3xl border border-white/10 bg-white/[0.04] backdrop-blur-md p-7 hover:bg-white/[0.07] hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-kipl-emerald/15 border border-kipl-emerald/40 text-kipl-emerald flex items-center justify-center">
                        <?php kipl_icon( $p['icon'], [ 'class' => 'w-5 h-5' ] ); ?>
                    </div>
                    <h3 class="mt-6 font-display font-bold text-xl text-white leading-tight">
                        <?php echo esc_html( $p['title'] ); ?>
                    </h3>
                    <p class="mt-3 text-sm text-white/70 leading-relaxed"><?php echo esc_html( $p['body'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="kipl-reveal mt-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 rounded-3xl border border-white/10 bg-white/[0.04] backdrop-blur-md p-7">
            <div>
                <div class="text-xs tracking-[0.24em] uppercase text-kipl-emerald font-semibold">
                    <?php esc_html_e( 'KIPL · ESG Report', 'krystal-ingredients' ); ?>
                </div>
                <h4 class="mt-2 font-display font-bold text-2xl">
                    <?php esc_html_e( 'Download our latest Sustainability Report.', 'krystal-ingredients' ); ?>
                </h4>
                <p class="text-sm text-white/60 mt-1 max-w-lg">
                    <?php esc_html_e( 'Detailed KPIs on emissions reduction, water recycling, solvent recovery & supply-chain audits.', 'krystal-ingredients' ); ?>
                </p>
            </div>
            <a href="<?php echo esc_url( $report_url ?: '#' ); ?>" <?php echo $report_url && $report_url !== '#' ? '' : 'aria-disabled="true"'; ?> class="inline-flex items-center gap-2 bg-kipl-emerald hover:bg-kipl-emerald-d text-white px-6 py-3.5 rounded-full text-sm font-semibold hover:scale-[1.02] transition-all duration-300">
                <?php esc_html_e( 'Download PDF', 'krystal-ingredients' ); ?>
                <?php kipl_icon( 'download', [ 'class' => 'w-4 h-4' ] ); ?>
            </a>
        </div>
    </div>
</section>
