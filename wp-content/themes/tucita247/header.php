<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css">


	<?php wp_head(); ?>
</head>
<body id="page-top" <?php body_class(); ?>>
<a class="cd-top" href="#"> </a>
<?php wp_body_open(); ?>
<nav class="navbar navbar-light navbar-expand-md navigation-clean-button" id="mainNav">
    <div class="container">
	    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php
	            $custom_logo_id = get_theme_mod( 'custom_logo' );
	            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            ?>
            <img src="<?php echo $image[0];?>" width="150">
	    </a>
        <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <?php
            $menu_name = 'menu-1';
            if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	            $menu_items = wp_get_nav_menu_items($menu->term_id);
	            $menu_list = '<ul class="nav navbar-nav mr-auto" id="menu-' . $menu_name . '">';

	            foreach ( (array) $menu_items as $key => $menu_item ) {
		            $url=get_post_meta( $menu_item->ID, '_anchor', true );
		            $title = $menu_item->title;
		            if($url==""){
			            $url = $menu_item->url;
		            }

		            $menu_list .= '<li class="nav-item" role="presentation">
                                    	<a class="nav-link js-scroll-trigger" href="' . __($url) . '">' . __($title) . '</a>
                                   </li>';
	            }
	            $menu_list .= '</ul>';
            } else {
	            $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
            }
            echo $menu_list;

	        $menu_name = 'menu-2';
	        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		        $menu_items = wp_get_nav_menu_items($menu->term_id);
		        $menu_list = '<span class="navbar-text actions" id="menu-' . $menu_name . '">';

		        foreach ( (array) $menu_items as $key => $menu_item ) {

			        $url=get_post_meta( $menu_item->ID, '_anchor', true );
			        $title = $menu_item->title;
			        if($url==""){
				        $url = $menu_item->url;
			        }
			        $tel_class="";
			        if (strpos($url, 'tel:') !== false) {
				        $tel_class="icon ion-android-call";
			        }
			        $menu_list .= '<a class="btn btn-light js-scroll-trigger action-button mr-3 mb-1 '.$tel_class.'" href="' . __($url) . '"> ' . __($title) . '</a>';
		        }
		        $menu_list .= '</span>';
	        } else {
		        $menu_list = '<span><li>Menu "' . $menu_name . '" not defined.</li></span>';
	        }
	        echo $menu_list;
	        ?>
        </div>
    </div>
</nav>
