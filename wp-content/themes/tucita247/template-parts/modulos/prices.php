<?php $config = get_option( 'tucita', array() );?>
<div id="<?php echo __('[:en]pricing-plans[:es]paquetes[:]');?>" class="pt-5 pb-5" style="background: white;">
	<div class="container-fluid">

		<?php
		$plan1=$config['conf']['planes']['plan'][0];
		$plan2=$config['conf']['planes']['plan'][1];
		$plan3=$config['conf']['planes']['plan'][2];
		$plan4=$config['conf']['planes']['plan'][3];

		// TRADUCCION
		$txt_titulo=__('[:en]Pricing Plans[:es]Planes[:]');
		$txt_promo=__('[:en]Promotional price prepaying three (3) months<br><strong>20%</strong> discount<br/> <strong>Free</strong> Set Up and Training[:es]Precio de promoción prepagando tres (3) Meses<br><strong>20%</strong> de descuento<br>Configuración y Adiestramiento <strong>gratis</strong>[:]');
		$txt_mensual=__('[:en]/month[:es]/mensual[:]');
		$txt_citas_mes=__('[:en]bookings/month[:es]/citas/mes[:]');
		$txt_cita=__('[:en]/booking[:es]/cita[:]');
		$txt_citas=__('[:en]/bookings[:es]/citas[:]');
		$txt_citas_adicionales=__('[:en]Additional bookings[:es]Citas Adicionales[:]');
		$txt_caso=__('[:en]/case[:es]/caso[:]');
		$txt_soporte=__('[:en]Support[:es]Soporte[:]');
		$txt_incluido=__('[:en]Included[:es]Incluido[:]');
		$txt_suscribirme=__('[:en]Sign Up Now[:es]Suscribirme[:]');
		$txt_citas_adicionales_gratis=__('[:en]Limited features to:<br/>1 location, service & reason to visit[:es]Función limitada a:<br/>1 localización, servicio & propósito de visita[:]');
		?>


		<div class="row">
			<div class="col-12" data-aos="fade-down">
				<h1 class="display-4 text-center mt-4"><?php echo $txt_titulo;?></h1>
				<h4 class="text-center orange-text mb-5 font-weight-lighter"><?php echo $txt_promo;?><br></h4>
			</div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3 flex" data-aos="zoom-in-up">
                <div class="card card-paquetes">
                    <div class="card-header">
                        <h5 class="text-center mb-0"><?php echo __($plan1['nombre']);?></h5>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center titulo-paquete">$<?php echo __($plan1['mensual']);?><span class="subtitulo-paquete"><?php echo $txt_mensual;?></span></h3>
                        <h3 class="text-center titulo-paquete-nombre"><?php echo $plan1['no_citas'];?><span>&nbsp;<?php echo $txt_citas_mes;?></span></h3>
                        <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_citas_adicionales;?><br/>(100 <?php echo $txt_citas;?>)<br></h4>

                        <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_citas_adicionales_gratis;?></h4>

                        <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_soporte;?><br></h4>
                        <h3 class="text-center titulo-paquete-nombre-2">
							<?php if($plan1['soporte']!=""){?>
                                $<?php echo $plan1['soporte'];?><span><?php echo $txt_caso;?></span>
							<?php }?>
                        </h3>

                    </div>
                    <div class="p-3">
                        <a class="btn btn-block btn-lg orange-button" role="button" target="_blank" href="<?php echo __($plan1['url']);?>"><?php echo $txt_suscribirme;?></a>
                    </div>
                </div>
            </div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3 flex" data-aos="zoom-in-up" data-aos-delay="500">
				<div class="card card-paquetes">
					<div class="card-header">
						<h5 class="text-center mb-0"><?php echo __($plan2['nombre']);?></h5>
					</div>
					<div class="card-body">
						<h3 class="text-center titulo-paquete">$<?php echo $plan2['mensual'];?><span class="subtitulo-paquete"><?php echo $txt_mensual;?></span></h3>
						<h3 class="text-center titulo-paquete-nombre"><?php echo $plan2['no_citas'];?><span>&nbsp;<?php echo $txt_citas_mes;?></span></h3>
						<h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_citas_adicionales;?><br/>(100 <?php echo $txt_citas;?>)<br></h4>
						<h3 class="text-center titulo-paquete-nombre-2"><?php echo $plan2['costo_cita_adicional'];?>¢<span><?php echo $txt_cita;?></span></h3>
						<h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_soporte;?><br></h4>
						<h3 class="text-center titulo-paquete-nombre-2">
							<?php if($plan2['soporte']!=""){?>
							$<?php echo $plan2['soporte'];?><span><?php echo $txt_caso;?></span>
							<?php }?>
						</h3>

					</div>
                    <div class="p-3">
                        <a class="btn btn-block btn-lg orange-button" role="button" target="_blank" href="<?php echo __($plan2['url']);?>"><?php echo $txt_suscribirme;?></a>
                    </div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3 flex" data-aos="zoom-in-up" data-aos-delay="1000">
				<div class="card card-paquetes">
					<div class="card-header">
						<h5 class="text-center mb-0"><?php echo __($plan3['nombre']);?></h5>
					</div>
					<div class="card-body">
						<h3 class="text-center titulo-paquete">$<?php echo $plan3['mensual'];?><span class="subtitulo-paquete"><?php echo $txt_mensual;?></span></h3>
						<h3 class="text-center titulo-paquete-nombre"><?php echo $plan3['no_citas'];?><span>&nbsp;<?php echo $txt_citas_mes;?></span></h3>
						<h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_citas_adicionales;?><br/>(100 <?php echo $txt_citas;?>)<br></h4>
						<h3 class="text-center titulo-paquete-nombre-2"><?php echo $plan3['costo_cita_adicional'];?>¢<span><?php echo $txt_cita;?></span></h3>
						<h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_soporte;?><br></h4>
						<h3 class="text-center titulo-paquete-nombre-2">
							<?php if($plan3['soporte']!=""){?>
								$<?php echo $plan2['soporte'];?>&nbsp;<span><?php echo $txt_caso;?></span>
							<?php }else{?>
								<?php echo $txt_incluido;?>
							<?php }?>
						</h3>

					</div>
                    <div class="p-3">
                        <a class="btn btn-block btn-lg orange-button" role="button" target="_blank" href="<?php echo __($plan3['url']);?>"><?php echo $txt_suscribirme;?></a>
                    </div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3 flex" data-aos="zoom-in-up" data-aos-delay="1500">
				<div class="card card-paquetes">
					<div class="card-header">
						<h5 class="text-center mb-0"><?php echo __($plan4['nombre']);?></h5>
					</div>
					<div class="card-body">
						<h3 class="text-center titulo-paquete">$<?php echo $plan4['mensual'];?><span class="subtitulo-paquete"><?php echo $txt_mensual;?></span></h3>
						<h3 class="text-center titulo-paquete-nombre"><?php echo $plan4['no_citas'];?><span>&nbsp;<?php echo $txt_citas_mes;?></span></h3>
						<h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_citas_adicionales;?><br/>(100 <?php echo $txt_citas;?>)<br></h4>
						<h3 class="text-center titulo-paquete-nombre-2"><?php echo $plan4['costo_cita_adicional'];?>¢<span><?php echo $txt_cita;?></span></h3>
						<h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_soporte;?><br></h4>
						<h3 class="text-center titulo-paquete-nombre-2">
							<?php if($plan4['soporte']!=""){?>
								$<?php echo $plan4['soporte'];?>&nbsp;<span><?php echo $txt_caso;?></span>
							<?php }else{?>
								<?php echo $txt_incluido;?>
							<?php }?>
						</h3>

					</div>
                    <div class="p-3">
                        <a class="btn btn-block btn-lg orange-button" role="button" target="_blank" href="<?php echo __($plan4['url']);?>"><?php echo $txt_suscribirme;?></a>
                    </div>
				</div>
			</div>
		</div>
		<?php
		// TRADUCCION
		$txt_configuracion=__('[:en]Set up[:es]Configuración[:]');
		$txt_adiestramiento=__('[:en]Training[:es]Adiestramiento[:]');
		$txt_localidad=__('[:en]/location[:es]/localidad[:]');
		$txt_alertas=__('[:en]SMS alerts[:es]Alertas vía SMS[:]');

		$txt_disclaimer_valido=__('[:en]Valid until October 31, 2020[:es]Válido hasta el 31 de octubre de 2020[:]');
		$txt_disclaimer_puntos=__('[:es]Set up[:es]*Entrada de datos en el sistema (información del negocio, logo/foto, localidades, y usuarios).<br>
					Un Adiestramiento de dos (2) horas en una (1) localidad. Costo regular: $150.00<br>
					**Solo una localidad. Adiestramiento adicional por
					localidad hasta dos (2) horas $75/Localidad
					[:en]*Data entry in the system (business information, logo / photo, locations, and users).<br>
					A two (2) hour Training in one (1) location. Regular cost: $ 150.00<br>
					**Only one location. Additional training per location up to two (2) hours $ 75/location[:]');
		?>
    </div>
</div>
    <div class="container">
		<div class="row mt-4" data-aos="fade-up" data-aos-delay="500">
			<div class="col-12 col-sm-4 col-md-4 col-lg-2 offset-lg-3 col-xl-2 offset-xl-3 mt-2">
				<h1 class="text-center text-success"><i class="icon-check"></i><br></h1>
				<h4 class="text-center titulo2-paquete mt-3">*<?php echo $txt_configuracion?><br></h4>
				<h3 class="text-center titulo-paquete-nombre-2">$0.00</h3>
			</div>
			<div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 mt-2">
				<h1 class="text-center text-success"><i class="icon-check"></i><br></h1>
				<h4 class="text-center titulo2-paquete mt-3">**<?php echo $txt_adiestramiento?><br></h4>
				<h3 class="text-center titulo-paquete-nombre-2">$75<span><?php echo $txt_localidad?></span></h3>
			</div>
			<div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 mt-2">
				<h1 class="text-center text-success"><i class="icon-check"></i><br></h1>
				<h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_alertas;?></h4>
				<h3 class="text-center titulo-paquete-nombre-2"><?php echo $txt_incluido;?></h3>
			</div>
		</div>
		<div class="row mb-5" data-aos="fade-up" data-aos-delay="500">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
				<h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_disclaimer_valido;?></h4>
				<h4 class="text-center titulo-paquete-3 mt-3">
					<?php echo $txt_disclaimer_puntos;?>
				</h4>
			</div>
		</div>
	</div>
</div>