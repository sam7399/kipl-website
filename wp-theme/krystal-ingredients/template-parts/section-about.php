<?php
/**
 * About / group + timeline.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$pillars = [
    [ 'icon' => 'globe',   'title' => kipl_field( 'about_pillar_1_title' ), 'body' => kipl_field( 'about_pillar_1_body' ) ],
    [ 'icon' => 'gem',     'title' => kipl_field( 'about_pillar_2_title' ), 'body' => kipl_field( 'about_pillar_2_body' ) ],
    [ 'icon' => 'factory', 'title' => kipl_field( 'about_pillar_3_title' ), 'body' => kipl_field( 'about_pillar_3_body' ) ],
];
?>
<section id="about" class="relative py-24 md:py-32 bg-kipl-slate overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-20">
            <div class="lg:col-span-6 flex flex-col gap-10">
                <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
                    <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                        <span class="h-px w-6 bg-kipl-emerald"></span>
                        <?php echo esc_html( kipl_field( 'about_eyebrow' ) ); ?>
                    </span>
                    <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-kipl-navy">
                        <span><?php echo esc_html( kipl_field( 'about_title_a' ) ); ?></span><br/>
                        <span class="text-kipl-emerald"><?php echo esc_html( kipl_field( 'about_title_accent' ) ); ?></span>
                    </h2>
                    <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-slate-600">
                        <?php echo esc_html( kipl_field( 'about_body' ) ); ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" data-kipl-stagger>
                    <?php foreach ( $pillars as $i => $p ) : ?>
                        <div class="kipl-fadeup group relative rounded-2xl bg-white border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-xl hover:border-kipl-emerald/40 transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-kipl-navy text-kipl-emerald flex items-center justify-center mb-4">
                                <?php kipl_icon( $p['icon'], [ 'class' => 'w-5 h-5' ] ); ?>
                            </div>
                            <h4 class="font-display font-semibold text-lg text-kipl-navy leading-tight">
                                <?php echo esc_html( $p['title'] ); ?>
                            </h4>
                            <p class="mt-2 text-sm text-slate-600 leading-relaxed"><?php echo esc_html( $p['body'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="lg:col-span-6">
                <div class="kipl-reveal relative rounded-3xl bg-kipl-navy text-white p-8 md:p-10 overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-kipl-emerald/10 blur-3xl"></div>
                    <div class="flex items-center justify-between mb-8">
                        <span class="text-xs tracking-[0.28em] uppercase font-semibold text-kipl-emerald">
                            <?php esc_html_e( 'Timeline · 1997 → Present', 'krystal-ingredients' ); ?>
                        </span>
                        <span class="font-mono text-[11px] text-white/40">GEM · KIPL</span>
                    </div>

                    <ol class="relative space-y-8">
                        <span class="absolute left-[11px] top-1 bottom-1 w-px bg-white/15" aria-hidden="true"></span>
                        <?php
                        $events = get_posts( [
                            'post_type'      => 'kipl_timeline',
                            'posts_per_page' => 12,
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ] );
                        if ( $events ) :
                            foreach ( $events as $event ) :
                                $year = get_post_meta( $event->ID, '_kipl_timeline_year', true );
                        ?>
                                <li class="kipl-fadeup relative pl-10">
                                    <span class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-kipl-emerald/10 border border-kipl-emerald flex items-center justify-center">
                                        <span class="w-2 h-2 rounded-full bg-kipl-emerald"></span>
                                    </span>
                                    <div class="font-mono text-xs tracking-widest text-kipl-emerald">
                                        <?php echo esc_html( $year ); ?>
                                    </div>
                                    <div class="mt-1 font-display text-lg font-semibold text-white">
                                        <?php echo esc_html( $event->post_title ); ?>
                                    </div>
                                    <p class="mt-1 text-sm text-white/60 leading-relaxed max-w-md">
                                        <?php echo esc_html( wp_strip_all_tags( $event->post_content ) ); ?>
                                    </p>
                                </li>
                        <?php
                            endforeach;
                            wp_reset_postdata();
                        else : ?>
                            <li class="pl-10 text-sm text-white/60">
                                <?php esc_html_e( 'No timeline entries yet — add some via WP Admin → Timeline.', 'krystal-ingredients' ); ?>
                            </li>
                        <?php endif; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
