<?php
/**
 * Homepage — composes every section template-part in order.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

get_template_part( 'template-parts/section', 'hero' );
get_template_part( 'template-parts/section', 'numbers' );
get_template_part( 'template-parts/section', 'about' );
get_template_part( 'template-parts/section', 'two-brands' );
get_template_part( 'template-parts/section', 'products' );
get_template_part( 'template-parts/section', 'industries' );
get_template_part( 'template-parts/section', 'manufacturing' );
get_template_part( 'template-parts/section', 'quote' );
get_template_part( 'template-parts/section', 'sustainability' );
get_template_part( 'template-parts/section', 'rnd' );
get_template_part( 'template-parts/section', 'insights' );
get_template_part( 'template-parts/section', 'awards' );
get_template_part( 'template-parts/section', 'compliance' );
get_template_part( 'template-parts/section', 'contact' );

get_footer();
