<?php $config = get_option( 'tucita', array() );
$tiendas= $config['conf']['tiendas'];

// TRADUCCION

$txt_soon=__('[:en]Coming Soon...[:es]Pronto...[:]');
$txt_hero_text=__('[:en]The easiest and safest way to visit your favorite businesses[:es]La forma más fácil y segura de visitar tus comercios favoritos[:]');
$txt_disponible_en=__('[:en]Available on:[:es]Disponible en:[:]');
?>
<div class="container-fluid pulse animated mt-5 pb-5 contenedor-hero">
	<div data-aos="fade-up" class="container">
		<div class="row d-none d-sm-none d-md-flex d-lg-flex d-xl-flex">
			<div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 offset-0 offset-sm-0 offset-md-0 offset-lg-2 offset-xl-2">
				<div class="row">
					<div class="col-2 col-sm-5 col-md-6 col-lg-5 col-xl-5">
						<img class="telefono" src="<?php echo get_template_directory_uri();?>/assets/img/Preset.png?v=<?php echo _S_VERSION;?>"></div>
					<div class="col-12 col-sm-7 col-md-6 col-lg-7 col-xl-7">
						<h1 class="display-4 text-left pl-4 font-weight-light titulo-hero">
                                <span style="
                                    color: #ff4f00;
                                    font-weight: 600;
                                "><?php echo $txt_soon;?></span>
							<br><?php echo $txt_hero_text;?><br></h1>
						<div class="mt-5">
							<p class="ml-4 disponible"><?php echo $txt_disponible_en;?></p>
							<ul class="list-unstyled ml-5">
								<li><a class="item-tienda" href="<?php echo $tiendas['android'];?>" target="_blank"><i class="fa fa-android"></i>&nbsp;Android</a></li>
								<li><a class="item-tienda" href="<?php echo $tiendas['ios'];?>" target="_blank"><i class="fa fa-apple"></i>&nbsp;iOS</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row d-flex d-sm-flex d-md-none d-lg-none d-xl-none">
			<div class="col-6 col-sm-5 d-flex align-items-center">
				<img class="img-fluid" src="<?php echo get_template_directory_uri();?>/assets/img/Preset.png?v=<?php echo _S_VERSION;?>"></div>
			<div class="col-6 col-sm-7 d-flex align-items-center">
				<h1 class="display-4 text-left font-weight-light titulo-hero">
                        <span style="
                            color: #ff4f00;
                            font-weight: 600;
                        "><?php echo $txt_soon;?></span>
					<br><?php echo $txt_hero_text;?><br></h1>
			</div>
			<div class="col">
				<div class="mt-4">
					<p class="mb-0"><?php echo $txt_disponible_en;?></p>
					<ul class="list-unstyled">
						<li><a class="item-tienda" href="<?php echo $tiendas['android'];?>" target="_blank"><i class="fa fa-android"></i>&nbsp;Android</a></li>
						<li><a class="item-tienda" href="<?php echo $tiendas['android'];?>" target="_blank"><i class="fa fa-apple"></i>&nbsp;iOS</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>