<?php $config = get_option( 'tucita', array() );
$redes= $config['conf']['redes'];


// TRADUCCION

$txt_title=__('[:en]How does it work?[:es]¿Por qué Tu Cita 24/7?[:]');
$txt_subtitle=__('[:en]For the Business:[:es]Para Comercios:[:]');
$txt_puntos=__('[:en]<li>Tu Cita 24/7 manages the business visits calendar. It considers multiple opening-hours, locations and entrance doors</li>
                            <li>Maintains entrance control without people having to wait standing in line</li>
                            <li>Monitors the amount of people inside the business</li>
                            <li>Helps to comply with social distancing and other COVID-19 protocols</li>
                            <li>Businesses can promote their products and services in <br>Tu Cita 24/7 business directory</li>
                [:es]<li>Se adapta a las operaciones del comercio. Múltiples<br>horarios, localidades y entradas.</li>
						<li>Mantiene un control de entrada sin que las personas<br>tengan que hacer fila&nbsp;</li>
						<li>Monitorea la cantidad de personas en el negocio en todo<br>momento</li>
						<li>Ayuda en el cumplimiento de distaciamiento social y otros protocolos de COVID-19<br></li>
						<li>Puedes promover tu negocio en la aplicación de directorio<br>de servicios y productos Tu Cita 24/7</li>[:]');
$txt_registrar=__('[:en]Business Sign Up[:es]Registrar mi comercio[:]');
?>
<div data-aos="slide-right" data-aos-delay="500" id="<?php echo __('[:en]how-does-it-work[:es]por-que[:]');?>" class="highlight">
	<div class="container">
		<div class="intro">
			<h1 class="display-4 text-center mb-5"><?php echo $txt_title;?></h1>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
					<img class="img-fluid" src="<?php echo get_template_directory_uri();?>/assets/img/comercios.svg?v=<?php echo _S_VERSION;?>"></div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
					<h1 class="heading-porque"><?php echo $txt_subtitle;?></h1>
					<ul>
                        <?php echo $txt_puntos;?>
					</ul>
					<div class="text-center mt-4">
						<a class="link-orange" href="<?php echo $redes['email'];?>" target="_blank"><?php echo $txt_registrar;?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>