<?php $config = get_option( 'tucita', array() );
$tiendas= $config['conf']['tiendas'];


// TRADUCCION

$txt_title=__('[:en]For the User:[:es]Para Clientes[:]');
$txt_disponible_en=__('[:en]Available on:[:es]Disponible en:[:]');
$txt_puntos=__('[:en]<li>It is the easiest and safest way to visit your favorite businesses.<br> It is a free booking app</li>
                            <li>You do not have to wait standing in line to visit a business. <br>You receive an alert message when you are next in line to be served</li>
                            <li>It gives you access to an extensive directory of products and services, <br>which you can easily search by: Name, Category, Location and Availability</li>
                            <li>You can choose priority for senior persons, persons with disabilities, and pregnant persons</li>
                [:es]<li>Una forma segura de visitar tus comercios favoritos, haciendo citas de forma gratuita.</li>
						<li>No tienes que hacer filas –&nbsp;funciona como los beepers de los restaurantes.</li>
						<li>Acceso a un extenso directorio de productos y servicios, que puedes buscar de forma fácil:<br>• ¿QUÉ? nombre o categoría de negocio<br>• ¿DÓNDE? Cercano a ti o por pueblo<br>• ¿CUÁNDO? La próxima disponibilidad o en un día
							específico.</li>
						<li>Puedes escoger prioridad para personas senior, con discapacidad, embarazadas.</li>[:]');
$txt_svg=__('[:en]customers[:es]clientes[:]');

?>
<div class="highlight2">
	<div class="container" data-aos="fade-left">
		<div class="intro"></div>
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 mb-3">
					<h1 class="heading-porque"><?php echo $txt_title;?></h1>
					<ul>
						<?php echo $txt_puntos;?>
					</ul>
					<div class="mt-4">
						<p class="ml-4 disponible"><?php echo $txt_disponible_en;?></p>
						<ul class="list-unstyled ml-5">
							<li><a class="item-tienda" href="<?php echo $tiendas['android'];?>" target="_blank"><i class="fa fa-android"></i>&nbsp;Android</a></li>
							<li><a class="item-tienda" href="<?php echo $tiendas['ios'];?>" target="_blank"><i class="fa fa-apple"></i>&nbsp;iOS</a></li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5 mb-3">
					<img class="img-fluid" src="<?php echo get_template_directory_uri();?>/assets/img/<?php echo $txt_svg;?>.svg?v=<?php echo _S_VERSION;?>">
				</div>
			</div>
		</div>
	</div>
</div>