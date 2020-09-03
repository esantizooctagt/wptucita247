<?php
// ESTO QUITA TODOS LOS CAMPOS DEL CHECKOUT
add_filter( 'woocommerce_checkout_fields' , 'not_required_fields', 9999 );
function not_required_fields( $f ) {
	unset( $f['billing']);
	return $f;
}

add_filter('woocommerce_register_post_type_product', function($post_type) {
	$post_type['has_archive'] = false;
	return $post_type;
});


add_filter( 'woocommerce_show_page_title' , 'desactivar_pag_tienda' );
function desactivar_pag_tienda() {
	return false;
}