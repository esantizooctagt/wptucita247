<?php
/**
 * Add custom fields to menu item
 *
 * This will allow us to play nicely with any other plugin that is adding the same hook
 *
 * @param  int $item_id
 * @params obj $item - the menu item
 * @params array $args
 */
function menu_custom_fields( $item_id, $item ) {

	wp_nonce_field( 'anchor_nonce', '_anchor_nonce_name' );
	$anchor = get_post_meta( $item_id, '_anchor', true );
	?>
	<div class="field-anchor description-wide" style="margin: 5px 0;">
		<span class="description"><?php _e( "Anchor", 'tucita247' ); ?></span>
		<br />

		<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

		<div class="logged-input-holder">
			<input class="widefat" type="text" name="anchor[<?php echo $item_id ;?>]" id="anchor-for-<?php echo $item_id ;?>" value="<?php echo esc_attr( $anchor ); ?>" />
		</div>

	</div>

	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'menu_custom_fields', 10, 2 );


/**
 * Save the menu item meta
 *
 * @param int $menu_id
 * @param int $menu_item_db_id
 */
function menu_nav_update( $menu_id, $menu_item_db_id ) {

	// Verify this came from our screen and with proper authorization.
	if ( ! isset( $_POST['_anchor_nonce_name'] ) || ! wp_verify_nonce( $_POST['_anchor_nonce_name'], 'anchor_nonce' ) ) {
		return $menu_id;
	}

	if ( isset( $_POST['anchor'][$menu_item_db_id]  ) ) {
		$sanitized_data = sanitize_text_field( $_POST['anchor'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, '_anchor', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_anchor' );
	}
}
add_action( 'wp_update_nav_menu_item', 'menu_nav_update', 10, 2 );

/**
 * Displays text on the front-end.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @return string
 */
function menu_custom_menu_title( $title, $item ) {

	if( is_object( $item ) && isset( $item->ID ) ) {

		$anchor = get_post_meta( $item->ID, '_anchor', true );

		if ( ! empty( $anchor ) ) {
			$title .= ' - ' . $anchor;
		}
	}
	return $title;
}
add_filter( 'nav_menu_item_title', 'menu_custom_menu_title', 10, 2 );