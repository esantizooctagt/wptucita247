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

add_action( 'template_redirect', 'wc_custom_redirect_after_purchase' ); 
function wc_custom_redirect_after_purchase() { 
	global $wp;

	$order_id  = absint( $wp->query_vars['order-received'] );
  	if ( empty($order_id) || $order_id == 0 )
		return;
		
  	if ( is_checkout() && !empty($wp->query_vars['order-received']) ) {
		$order = wc_get_order( $order_id );
		if (!$order->has_status('completed')){
			$lang = get_locale() == "es_ES" ? "es/error-page" : "error-page";
			wp_redirect( 'https://tucita247.local/' . $lang );
		} else {
			$lang = get_locale() == "es_ES" ? "es/gracias" : "thankyou";
			wp_redirect( 'https://tucita247.local/' . $lang );
		}
    	exit;
  	}
}