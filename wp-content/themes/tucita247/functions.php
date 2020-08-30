<?php
/**
 * Tu Cita 24/7 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tu_Cita_24/7
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', rand() );
}

require get_template_directory() . '/inc/setup-theme.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/fields.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/menu-custom-fields.php';
require get_template_directory() . '/inc/ajax-functions.php';

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

add_filter( 'woocommerce_order_button_text', 'misha_custom_button_text' );
 
function misha_custom_button_text( $button_text ) {
   return 'Pay now'; // new text is here 
}