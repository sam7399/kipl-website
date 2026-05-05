<?php
/**
 * Search form.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<form role="search" method="get" class="flex items-center gap-3" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="kipl-s" class="screen-reader-text"><?php esc_html_e( 'Search', 'krystal-ingredients' ); ?></label>
    <input id="kipl-s" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search…', 'krystal-ingredients' ); ?>" class="kipl-input" />
    <button type="submit" class="inline-flex items-center gap-2 bg-kipl-navy text-white px-5 py-3 rounded-full text-sm font-semibold hover:bg-kipl-navy-2 transition-colors">
        <?php esc_html_e( 'Search', 'krystal-ingredients' ); ?>
    </button>
</form>
