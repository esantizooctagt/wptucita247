<?php

function tucita247_scripts() {

	$config = get_option( 'tucita', array() );

	wp_enqueue_style( 'tucita247-style', get_stylesheet_uri(), array(), _S_VERSION );

	// CSS
	wp_enqueue_style( 'tucita247-template-min', get_template_directory_uri(). '/assets/css/template.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'tucita247-template-fixes', get_template_directory_uri(). '/assets/css/fixes.css', array(), _S_VERSION );

	// JS
	wp_enqueue_script( 'tucita247-catalogos', get_template_directory_uri() . '/assets/js/'.__("[:en]categories[:es]categorias[:]").'.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'tucita247-scroll-to-top', get_template_directory_uri() . '/assets/js/scrollToTop.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'tucita247-jquery-ui', get_template_directory_uri() . '/assets/js/jquery.ui.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'tucita247-jquery-validate', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'tucita247-jquery-wizard', get_template_directory_uri() . '/assets/js/jquery.wizard.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'tucita247-linkScroller', get_template_directory_uri() . '/assets/js/linkScroller.js', array(), _S_VERSION, true );

	$pagina_id= $config['conf']['paginas']['suscribirme'];
	if(is_page($pagina_id)){
		wp_enqueue_script( 'tucita247-googlemaps', get_template_directory_uri() . '/assets/js/googleMaps.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'tucita247-recaptcha', get_template_directory_uri() . '/assets/js/reCaptcha.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'tucita247-funciones', get_template_directory_uri() . '/assets/js/funciones.js', array(), _S_VERSION, true );

		$llaves= $config['conf']['llaves'];
		wp_localize_script( 'tucita247-recaptcha', 'theme_js_params',
			array(
				'sitekey' => $llaves['recaptcha'],
			)
		);
	}

	wp_enqueue_script( 'tucita247-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), _S_VERSION, true );
	wp_localize_script( 'tucita247-scripts', 'ajax_var', array(
		'url'    => admin_url( 'admin-ajax.php' ),
		'site_url' => site_url(),
        'ajax_nonce' => wp_create_nonce('scripts-ajax-nonce')
	) );


	if ( !is_admin() ) wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'tucita247_scripts' );