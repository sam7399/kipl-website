<?php
/**
 * Leadership quote — full-bleed editorial pull-quote with optional headshot.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$body   = kipl_field( 'quote_body' );
if ( ! $body ) return;
$author = kipl_field( 'quote_author' );
$role   = kipl_field( 'quote_role' );
$image  = kipl_image_id( 'quote_image' );
?>
<section class="relative py-28 md:py-40 bg-kipl-navy text-white overflow-hidden">
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[40rem] h-[40rem] rounded-full bg-kipl-emerald/15 blur-[120px] pointer-events-none" aria-hidden="true"></div>
    <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image:radial-gradient(circle, #fff 1px, transparent 1px); background-size:32px 32px" aria-hidden="true"></div>

    <div class="relative max-w-5xl mx-auto px-6 md:px-10 text-center kipl-reveal">
        <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-semibold text-kipl-emerald">
            <span class="h-px w-8 bg-kipl-emerald"></span>
            <?php echo esc_html( kipl_field( 'quote_eyebrow' ) ); ?>
            <span class="h-px w-8 bg-kipl-emerald"></span>
        </span>

        <svg class="mx-auto mt-10 w-12 h-12 text-kipl-emerald/40" viewBox="0 0 48 48" fill="currentColor" aria-hidden="true">
            <path d="M14 12c-5 2-8 6-8 12 0 6 4 10 9 10 4 0 7-3 7-7 0-4-2-7-6-7-1 0-1 0-2 1 1-4 4-7 8-9zm22 0c-5 2-8 6-8 12 0 6 4 10 9 10 4 0 7-3 7-7 0-4-2-7-6-7-1 0-1 0-2 1 1-4 4-7 8-9z"/>
        </svg>

        <blockquote class="mt-6 font-display font-bold text-2xl sm:text-3xl md:text-4xl lg:text-5xl leading-[1.18] tracking-tight">
            <span class="kipl-quote-text">&ldquo;<?php echo esc_html( $body ); ?>&rdquo;</span>
        </blockquote>

        <figcaption class="mt-12 flex flex-col items-center gap-4">
            <?php if ( $image ) : ?>
                <span class="w-14 h-14 rounded-full overflow-hidden ring-2 ring-kipl-emerald/40">
                    <?php echo wp_get_attachment_image( $image, 'thumbnail', false, [ 'class' => 'w-full h-full object-cover' ] ); ?>
                </span>
            <?php endif; ?>
            <div class="font-display font-semibold text-white"><?php echo esc_html( $author ); ?></div>
            <div class="text-sm text-white/60 tracking-wide"><?php echo esc_html( $role ); ?></div>
        </figcaption>
    </div>
</section>
