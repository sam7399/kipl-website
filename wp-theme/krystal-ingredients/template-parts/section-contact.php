<?php
/**
 * Contact — split layout with offices card + AJAX inquiry form.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$industries = [
    __( 'Flavors & Fragrances', 'krystal-ingredients' ),
    __( 'Cosmetics & Personal Care', 'krystal-ingredients' ),
    __( 'Pharmaceuticals', 'krystal-ingredients' ),
    __( 'Food & Beverage', 'krystal-ingredients' ),
    __( 'Wellness & Nutraceuticals', 'krystal-ingredients' ),
    __( 'Other', 'krystal-ingredients' ),
];
$inquiry_types = [
    __( 'Export', 'krystal-ingredients' ),
    __( 'Custom Manufacturing', 'krystal-ingredients' ),
    __( 'Product Spec', 'krystal-ingredients' ),
    __( 'General', 'krystal-ingredients' ),
];
?>
<section id="contact" class="relative py-24 md:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-5 flex flex-col gap-10">
                <div class="flex flex-col gap-4 max-w-3xl kipl-reveal">
                    <span class="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
                        <span class="h-px w-6 bg-kipl-emerald"></span>
                        <?php echo esc_html( kipl_field( 'contact_eyebrow' ) ); ?>
                    </span>
                    <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight text-kipl-navy">
                        <?php echo esc_html( kipl_field( 'contact_title' ) ); ?>
                    </h2>
                    <p class="text-base sm:text-lg leading-relaxed max-w-2xl text-slate-600">
                        <?php echo esc_html( kipl_field( 'contact_sub' ) ); ?>
                    </p>
                </div>

                <div class="kipl-reveal rounded-3xl bg-kipl-navy text-white p-8 md:p-10 relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-kipl-emerald/10 blur-3xl"></div>
                    <h4 class="font-display font-bold text-xl"><?php esc_html_e( 'Global Offices', 'krystal-ingredients' ); ?></h4>
                    <div class="mt-6 space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-kipl-emerald/15 text-kipl-emerald flex items-center justify-center flex-shrink-0">
                                <?php kipl_icon( 'pin', [ 'class' => 'w-5 h-5' ] ); ?>
                            </div>
                            <div>
                                <div class="text-xs tracking-[0.22em] uppercase text-kipl-emerald font-semibold">
                                    <?php echo esc_html( kipl_field( 'office_hq_label' ) ); ?>
                                </div>
                                <div class="mt-1 font-display text-lg font-semibold"><?php echo esc_html( kipl_field( 'office_hq_city' ) ); ?></div>
                                <div class="text-sm text-white/60"><?php echo esc_html( kipl_field( 'office_hq_country' ) ); ?></div>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-kipl-emerald/15 text-kipl-emerald flex items-center justify-center flex-shrink-0">
                                <?php kipl_icon( 'pin', [ 'class' => 'w-5 h-5' ] ); ?>
                            </div>
                            <div>
                                <div class="text-xs tracking-[0.22em] uppercase text-kipl-emerald font-semibold">
                                    <?php echo esc_html( kipl_field( 'office_mfg_label' ) ); ?>
                                </div>
                                <div class="mt-1 font-display text-lg font-semibold"><?php echo esc_html( kipl_field( 'office_mfg_city' ) ); ?></div>
                                <div class="text-sm text-white/60"><?php echo esc_html( kipl_field( 'office_mfg_country' ) ); ?></div>
                            </div>
                        </div>
                        <div class="pt-5 border-t border-white/10 flex flex-col gap-2 text-sm text-white/80">
                            <div class="flex items-center gap-3">
                                <span class="text-kipl-emerald"><?php kipl_icon( 'mail', [ 'class' => 'w-4 h-4' ] ); ?></span>
                                <a href="mailto:<?php echo esc_attr( kipl_field( 'contact_email' ) ); ?>" class="hover:text-white">
                                    <?php echo esc_html( kipl_field( 'contact_email' ) ); ?>
                                </a>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-kipl-emerald"><?php kipl_icon( 'phone', [ 'class' => 'w-4 h-4' ] ); ?></span>
                                <span><?php echo esc_html( kipl_field( 'contact_phone' ) ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="kipl-inquiry-form" class="kipl-reveal lg:col-span-7 rounded-3xl border border-slate-200 bg-kipl-slate p-8 md:p-10" novalidate>
                <div data-kipl-form-pane>
                    <div style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden" aria-hidden="true">
                        <label for="kipl-website">Leave this field empty</label>
                        <input id="kipl-website" name="website" type="text" tabindex="-1" autocomplete="off"/>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <label class="flex flex-col gap-2">
                            <span class="text-[11px] tracking-[0.22em] uppercase font-semibold text-kipl-navy/70">
                                <?php esc_html_e( 'Full name', 'krystal-ingredients' ); ?>
                            </span>
                            <input name="name" type="text" required autocomplete="name" placeholder="e.g. Priya Sharma" class="kipl-input"/>
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-[11px] tracking-[0.22em] uppercase font-semibold text-kipl-navy/70">
                                <?php esc_html_e( 'Corporate email', 'krystal-ingredients' ); ?>
                            </span>
                            <input name="email" type="email" required autocomplete="email" placeholder="priya@acme.com" class="kipl-input"/>
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-[11px] tracking-[0.22em] uppercase font-semibold text-kipl-navy/70">
                                <?php esc_html_e( 'Company name', 'krystal-ingredients' ); ?>
                            </span>
                            <input name="company" type="text" required autocomplete="organization" placeholder="Acme Fragrances Ltd." class="kipl-input"/>
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-[11px] tracking-[0.22em] uppercase font-semibold text-kipl-navy/70">
                                <?php esc_html_e( 'Industry segment', 'krystal-ingredients' ); ?>
                            </span>
                            <select name="industry" required class="kipl-input">
                                <option value="" disabled selected><?php esc_html_e( 'Select industry', 'krystal-ingredients' ); ?></option>
                                <?php foreach ( $industries as $ind ) : ?>
                                    <option value="<?php echo esc_attr( $ind ); ?>"><?php echo esc_html( $ind ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="flex flex-col gap-2 md:col-span-2">
                            <span class="text-[11px] tracking-[0.22em] uppercase font-semibold text-kipl-navy/70">
                                <?php esc_html_e( 'Inquiry type', 'krystal-ingredients' ); ?>
                            </span>
                            <select name="inquiry_type" required class="kipl-input">
                                <option value="" disabled selected><?php esc_html_e( 'Choose one', 'krystal-ingredients' ); ?></option>
                                <?php foreach ( $inquiry_types as $t ) : ?>
                                    <option value="<?php echo esc_attr( $t ); ?>"><?php echo esc_html( $t ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="flex flex-col gap-2 md:col-span-2">
                            <span class="text-[11px] tracking-[0.22em] uppercase font-semibold text-kipl-navy/70">
                                <?php esc_html_e( 'Message', 'krystal-ingredients' ); ?>
                            </span>
                            <textarea name="message" rows="5" required placeholder="<?php esc_attr_e( 'Share volumes, target specifications, timelines or a product code…', 'krystal-ingredients' ); ?>" class="kipl-input resize-none"></textarea>
                        </label>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <p class="text-xs text-slate-500">
                            <?php esc_html_e( 'By submitting, you agree to KIPL\'s privacy policy. We respond within one business day.', 'krystal-ingredients' ); ?>
                        </p>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-kipl-navy text-white px-7 py-4 rounded-full text-sm font-semibold hover:bg-[#112240] hover:scale-[1.02] transition-all duration-300 disabled:opacity-60 disabled:cursor-wait">
                            <span data-kipl-submit-default class="inline-flex items-center gap-2">
                                <?php esc_html_e( 'Request Consultation', 'krystal-ingredients' ); ?>
                                <?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?>
                            </span>
                            <span data-kipl-submit-loading class="hidden inline-flex items-center gap-2">
                                <span class="kipl-spin"><?php kipl_icon( 'spinner', [ 'class' => 'w-4 h-4' ] ); ?></span>
                                <?php esc_html_e( 'Sending…', 'krystal-ingredients' ); ?>
                            </span>
                        </button>
                    </div>
                </div>

                <div data-kipl-form-success class="hidden flex-col items-center text-center py-14">
                    <div class="w-14 h-14 rounded-full bg-kipl-emerald/15 text-kipl-emerald flex items-center justify-center">
                        <?php kipl_icon( 'check-circle', [ 'class' => 'w-7 h-7' ] ); ?>
                    </div>
                    <h3 class="mt-6 font-display font-bold text-2xl text-kipl-navy">
                        <?php esc_html_e( 'Inquiry received.', 'krystal-ingredients' ); ?>
                    </h3>
                    <p class="mt-2 text-slate-600 max-w-md">
                        <?php esc_html_e( 'Our business team will respond within one business day. A confirmation email has been dispatched to your inbox.', 'krystal-ingredients' ); ?>
                    </p>
                    <div data-kipl-form-reference class="mt-6 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 font-mono text-xs tracking-[0.18em] text-kipl-navy"></div>
                    <button type="button" data-kipl-form-reset class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-kipl-navy hover:text-kipl-emerald">
                        <?php esc_html_e( 'Send another inquiry', 'krystal-ingredients' ); ?>
                        <?php kipl_icon( 'arrow-right', [ 'class' => 'w-4 h-4' ] ); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
