<?php
/**
 * Comments template — minimal, theme-styled.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( post_password_required() ) { return; }
?>
<div id="comments" class="mt-16 pt-12 border-t border-slate-200">
    <?php if ( have_comments() ) : ?>
        <h2 class="font-display font-bold text-2xl text-kipl-navy">
            <?php
            printf(
                esc_html( _n( '1 comment', '%s comments', get_comments_number(), 'krystal-ingredients' ) ),
                number_format_i18n( get_comments_number() )
            );
            ?>
        </h2>
        <ol class="mt-8 space-y-6">
            <?php wp_list_comments( [ 'style' => 'ol', 'short_ping' => true, 'avatar_size' => 44 ] ); ?>
        </ol>
        <nav class="mt-10 text-sm text-slate-500 flex justify-between">
            <span><?php previous_comments_link( esc_html__( 'Older', 'krystal-ingredients' ) ); ?></span>
            <span><?php next_comments_link( esc_html__( 'Newer', 'krystal-ingredients' ) ); ?></span>
        </nav>
    <?php endif; ?>

    <?php
    if ( comments_open() ) {
        comment_form( [
            'class_form'         => 'mt-12 grid grid-cols-1 gap-4 max-w-2xl',
            'class_submit'       => 'bg-kipl-emerald text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-kipl-emerald-d transition-colors',
            'comment_field'      => '<label class="flex flex-col gap-2"><span class="text-[11px] tracking-[0.22em] uppercase font-semibold text-kipl-navy/70">' . esc_html__( 'Your comment', 'krystal-ingredients' ) . '</span><textarea name="comment" rows="5" required class="kipl-input resize-none"></textarea></label>',
            'title_reply'        => esc_html__( 'Leave a comment', 'krystal-ingredients' ),
            'title_reply_before' => '<h3 class="font-display font-bold text-2xl text-kipl-navy">',
            'title_reply_after'  => '</h3>',
        ] );
    }
    ?>
</div>
