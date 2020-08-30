<?php
if ( ! function_exists( 'tucita247_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tucita247_setup() {

		add_theme_support( 'title-tag' );



		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primario', 'tucita247' ),
				'menu-2' => esc_html__( 'Secundario', 'tucita247' ),
				'menu-3' => esc_html__( 'Pie', 'tucita247' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'style',
				'script',
			)
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'woocommerce' );
	}
endif;
add_action( 'after_setup_theme', 'tucita247_setup' );
