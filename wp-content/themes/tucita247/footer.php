<div class="footer-basic">
    <footer>
        <div class="social">
	        <?php $config = get_option( 'tucita', array() );
	        $redes= $config['conf']['redes'];
	        ?>
            <a href="<?php echo $redes['instagram'];?>" target="_blank"><i class="icon ion-social-instagram"></i></a>
            <a href="<?php echo $redes['linkedin'];?>" target="_blank"><i class="icon ion-social-linkedin"></i></a>
            <a href="<?php echo $redes['twitter'];?>" target="_blank"><i class="icon ion-social-twitter"></i></a>
            <a href="<?php echo $redes['facebook'];?>" target="_blank"><i class="icon ion-social-facebook"></i></a>
            <a href="<?php echo $redes['telefono'];?>"><i class="icon ion-android-call"></i></a>
        </div>
        <?php
        $menu_name = 'menu-3';
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	        $menu_items = wp_get_nav_menu_items($menu->term_id);
	        $menu_list = '<ul class="list-inline" id="menu-' . $menu_name . '">';
	        foreach ( (array) $menu_items as $key => $menu_item ) {
		        $title = $menu_item->title;
		        $url = $menu_item->url;
		        $menu_list .= '<li class="list-inline-item">
                                   <a href="' . $url . '">' . $title . '</a>
                               </li>';
	        }
	        $menu_list .= '</ul>';
        } else {
	        $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
        }
        echo $menu_list;
        ?>
        <p class="copyright">Tu Cita 24/7 © <?php echo date('Y');?></p>
    </footer>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://www.myersdaily.org/joseph/javascript/md5.js"></script>
<?php wp_footer(); ?>

<?php if(is_page(57)){
	$llaves= $config['conf']['llaves'];
    ?>
<script src="https://www.google.com/recaptcha/api.js?onload=loadRecaptcha&render=explicit"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $llaves['maps'];?>&callback=initMap"></script>
<?php }?>

</body>
</html>
