<?php
get_header();
?>

<?php
// TRADUCCIONES

$txt_titulo=__('[:en]Business Signup[:es]Registro de comercio[:]');
$txt_paso=__('[:en]Step[:es]Paso[:]');
$txt_de=__('[:en]from[:es]de[:]');

$txt_disponible = __('[:en]Available[:es]Disponible[:]');
$txt_no_disponible = __('[:en]Not available[:es]No disponible[:]');

$txt_nombre_negocio_ph = __('[:en]Business name[:es]Nombre de su negocio[:]');
$txt_descripcion_negocio_ph = __('[:en]Business description[:es]Descripción del negocio[:]');

$txt_elija_categoria = __('[:en]Choose the category that best suits your business.[:es]Elija la categoría que mejor se adapte a su negocio.[:]');
$txt_descripcion_negocio=__('[:en]Provide a brief description of your business.[:es]Provea una breve descripción de su negocio.[:]');
$txt_politicas_privacidad=__('[:en]By continuing, you accept the terms and privacy policy.[:es]Al continuar, usted acepta los términos y política de privacidad.[:]');
$txt_politicas_privacidad_2= __('[:en]Terms and privacy policy[:es]Términos y política de privacidad[:]');
$txt_politicas_privacidad_link= __('[:en]/privacy-policies[:es]/politicas-de-privacidad[:]');
$txt_acepta_correspondencia=__('[:en]You agree that we send you information and promotions.[:es]Acepta que le enviemos información y promociones.[:]');
$txt_aprender_mas=__('[:en]Learn more[:es]Aprender más[:]');
$txt_am1=__('[:en]This helps clients find it if they are looking for a business like yours.[:es]Esto ayuda a los clientes a encontrarlo si están buscando un negocio como el suyo.[:]');
$txt_am2=__('[:en]Business slogan; something simple and eye-catching that sets your business apart.[:es]Lema del negocio; algo simple y llamativo que distinga su negocio.[:]');

$txt_titulo_pregunta_1=__('[:en]What is your business name?[:es]¿Cómo se llama su negocio?[:]');
$txt_texto_pregunta_2=__('[:en]To use the system, you must create an administrator account. This information will not be published.[:es]Para utilizar el sistema, usted debe crear una cuenta de administrador. Esta información no será publicada.[:]');
$txt_texto_pregunta_22=__('[:en]Before continuing we need to validate your email. [:es]Antes de continuar necesitamos validar tu correo electrónico.[:]');
$txt_texto_pregunta_23=__('[:en]By pressing the button we will be sending your mobile a four-digit code which you must enter to continue. [:es]Al oprimir el botón estaremos enviando a tu móvil un código de cuatro dígitos el cual debes entrar para continuar.[:]');
$txt_nombre_administrador=__('[:en]Administrator name[:es]Nombre del administrador[:]');
$txt_apellido_administrador=__('[:en]Administrator last name[:es]Apellido del administrador[:]');
$txt_telefono_administrador=__('[:en]Administrator phone[:es]Teléfono del administrador[:]');
$txt_correo_administrador=__('[:en]Administrator e-mail[:es]Correo electrónico del administrador[:]');

$txt_reenviar_codigo=__('[:en]Resend code[:es]Re-enviar código[:]');
$txt_ingrese_codigo=__('[:en]Enter the received code[:es]Ingrese el código recibido[:]');

$txt_ayuda_codigo=__('[:en]Code not received? Check if your email is correct [:es]No ha recibido su código? Verifique si su correo electrónico es correcto[:]');
$txt_ayuda_codigo02=__('[:en]<br>*When the business registration is finished, the system will send an email to activate your account.[:es]<br>*Cuando finalice el registro del negocio, el sistema de enviará un email para activar su cuenta.[:]');


$txt_codigo_correcto=__('[:en]Valid code[:es]Código correcto[:]');
$txt_codigo_incorrecto=__('[:en]Invalid code, please re-enter again or resend another code[:es]Código incorrecto, escribalo bien o vuelva a generar uno reciente[:]');

$txt_titulo_pregunta_3=__('[:en]What is your business address?[:es]¿Cuál es la dirección de su negocio?[:]');
$txt_donde_esta_negocio=__('[:en]Where is your business located?[:es]¿Dónde está ubicado su negocio?[:]');
$txt_ayuda_mapa=__('[:en]Zoom in on the map and place the marker at the exact location where your business is located.[:es]Amplíe el mapa y coloque el marcador en el lugar exacto donde se encuentra su negocio.[:]');
$txt_direccion_negocio=__('[:en]Business Address[:es]Dirección de su negocio[:]');
$txt_zipcode_negocio=__('[:en]Zip code[:es]Código postal[:]');

$txt_instrucciones_4=__('[:en]The address provided will be used as your primary location. For this location, please answer the following questions:[:es]La dirección brindada será usada como su localidad principal. Para esta localidad, favor contestar las siguientes preguntas:[:]');
$txt_maximo_personas=__('[:en]What is the maximum number of customers per location?[:es]¿Cuál es la cantidad de clientes máxima por localidad?[:]');
$txt_servicios_ofrece=__('[:en]What service do you offer?[:es]¿Qué servicio ofrece?[:]');
$txt_servicios_ofrece_default=__('[:en]Default "Category", later you can add more services.[:es]Predeterminado “Categoría”, luego puedes añadir más servicios.[:]');
$txt_proveedor_servicio=__('[:en]Service Provider:[:es]Proveedor de Servicio:[:]');
$txt_proveedor_servicio_default=__('[:en]Default "Business Name", later you can add other employees and suppliers.[:es]Predeterminado “Nombre del Negocio”, luego puedes añadir otros empleados y proveedores. [:]');

$txt_siguiente=__('[:en]Next[:es]Siguiente[:]');
$txt_anterior=__('[:en]Previous[:es]Anterior[:]');
$txt_procesar=__('[:en]Sign up now[:es]Registrarse[:]');

$txt_cerrar=__('[:en]Close[:es]Cerrar[:]');

$txt_plan_contratar=__('[:en]Selected plan[:es]Plan elegido[:]');

?>
<div class="modal" role="dialog" tabindex="-1" id="modalHelp">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-right">
                    <div class="text-left modalContenido mb-3"></div>
                    <button class="btn btn-light btn-sm border rounded-0" type="button" data-dismiss="modal"><?php echo $txt_cerrar;?></button></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="modalLoading">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="text-center mt-2 mb-2">
						<?php echo __('[:en]Processing...[:es]Procesando...[:]');?>
				</div>
			</div>
		</div>
	</div>
</div>
	<div class="container mt-5 mb-5 container-principal">
	<div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2">
		<h1 class="mb-5"><?php echo $txt_titulo;?></h1>
		<div class="mb-5">
			<div id="wizard-registration">
				<form id="wrapped">
					<div class="step">
						<section>
							<h6><?php echo $txt_paso;?> 1 <?php echo $txt_de;?> 6</h6>
							<div class="progress mb-4" style="height: 1px;">
								<div class="progress-bar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><span class="sr-only">0%</span></div>
							</div><label><?php echo $txt_titulo_pregunta_1;?></label>
							<div class="form-row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
                                        <input class="form-control form-control-lg" type="text" id="nombreNegocio" placeholder="<?php echo $txt_nombre_negocio_ph?>" name="Name" minlength="1">
                                    </div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
                                        <input class="form-control form-control-lg" type="text" id="slugNegocio" name="TuCitaLink" placeholder="Tu cita link">
                                        <input class="form-control inputHiddeSteper" type="text" id="slugNegocioEstado" name="slugNegocioEstado" tabindex="-1" required="">
                                        <div class="valid-feedback"><?php echo $txt_disponible;?></div><div class="invalid-feedback"><?php echo $txt_no_disponible;?></div>
                                        <span class="spinner-border spinner-border-sm spinner" role="status" id="spinner-tucitalink"></span></div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group"><label><?php echo $txt_elija_categoria;?></label>
                                        <select class="form-control form-control-lg AutoSelectCategorias" id="categorias" name="CategoryId" required=""></select>
                                        <a class="ayuda" href="#" data-toggle="modal" data-target="#modalHelp" data-texto="<?php echo $txt_am1;?>"><?php echo $txt_aprender_mas;?></a>
                                    </div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group"><label><?php echo $txt_descripcion_negocio;?></label>
                                        <textarea class="form-control form-control-lg" placeholder="<?php echo $txt_descripcion_negocio_ph?>" name="Description"></textarea>
                                        <a class="ayuda" href="#" data-toggle="modal" data-target="#modalHelp" data-texto="<?php echo $txt_am2;?>"><?php echo $txt_aprender_mas;?></a></div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
                                        <label class="text-center mt-3 d-block bg-light pt-2 pb-2 mensaje-pequeno"><?php echo $txt_politicas_privacidad;?><br>
                                            <a class="link-naranja" href="<?php echo $txt_politicas_privacidad_link;?>"><?php echo $txt_politicas_privacidad_2;?></a>&nbsp;
                                        </label>
                                        <label
											class="mt-4 p-relative"><input type="checkbox" id="acepta_terminos" name="acepta_terminos">&nbsp;<?php echo $txt_acepta_correspondencia;?></label>
										<div class="p-relative"><input class="form-control inputHiddeSteper" type="text" id="reCaptcha" name="reCaptcha" tabindex="-1" required="">
											<div id="recaptchaInput" class="mt-4"></div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
					<div class="step">
						<section>
							<h6><?php echo $txt_paso;?> 2 <?php echo $txt_de;?> 6</h6>
							<div class="progress mb-4" style="height: 1px;">
								<div class="progress-bar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">20%</span></div>
							</div><label><?php echo $txt_texto_pregunta_2;?></label>
							<div class="form-row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
									<div class="form-group">
                                        <input class="form-control form-control-lg" type="text" id="nombres" placeholder="<?php echo $txt_nombre_administrador;?>" name="First_Name">
                                    </div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
									<div class="form-group">
                                        <input class="form-control form-control-lg" type="text" id="apellidos" placeholder="<?php echo $txt_apellido_administrador;?>" name="Last_Name">
                                    </div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
									<div class="form-group">
                                        <input class="form-control form-control-lg" type="tel" id="telefonos" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="1(001)-111-22222" name="User_Phone">
                                    </div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
									<div class="form-group">
                                        <input class="form-control form-control-lg" type="email" id="correoAdministrador" placeholder="<?php echo $txt_correo_administrador;?>" name="Email" required>
                                        <input class="form-control inputHiddeSteper" type="text" id="emailDisponible" name="emailDisponible" tabindex="-1" required>
                                        <div class="valid-feedback"><?php echo $txt_disponible;?></div><div class="invalid-feedback"><?php echo $txt_no_disponible;?></div>
                                        <span class="spinner-border spinner-border-sm spinner" role="status" id="spinner-email"></span>
                                    </div>
								</div>
							</div>
						</section>
					</div>
					<div class="step">
						<section>
							<h6><?php echo $txt_paso;?> 3 <?php echo $txt_de;?> 6</h6>
							<div class="progress mb-4" style="height: 1px;">
								<div class="progress-bar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">40%</span></div>
							</div>
							<div class="form-row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><label><?php echo $txt_texto_pregunta_22 . 'HOLA' . $txt_texto_pregunta_23;?></label>
									<div class="form-group p-relative">
                                        <div>
                                            <input class="form-control form-control-lg" type="text" id="codigoValidacion" placeholder="<?php echo $txt_ingrese_codigo;?>" style="margin-top: 2px;" name="codigoValidacion" required="">
                                            <div class="valid-feedback"><?php echo $txt_codigo_correcto;?></div>
                                            <div class="invalid-feedback"><?php echo $txt_codigo_incorrecto;?></div>
                                        </div>
                                            <a class="ayuda" href="#" style="bottom:-20px;" onclick="reEnvioCorreo();"><?php echo $txt_reenviar_codigo;?></a>

                                    </div>
                                    <label class="mensaje-pequeno mt-2"><?php echo $txt_ayuda_codigo;?><br></label>
								</div>
							</div>
						</section>
					</div>
					<div class="step">
						<section>
							<h6><?php echo $txt_paso;?> 4 <?php echo $txt_de;?> 6</h6>
							<div class="progress mb-4" style="height: 1px;">
								<div class="progress-bar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    <span class="sr-only">60%</span>
                                </div>
							</div>
                            <label><?php echo $txt_titulo_pregunta_3?></label>
							<div class="form-row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
									<div class="form-group">
                                        <select class="form-control form-control-lg AutoSelectPaises" name="Country"></select>
                                    </div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
									<div class="form-group">
                                        <select class="form-control form-control-lg AutoSelectCiudades" name="City">

                                        </select></div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
                                        <textarea class="form-control form-control-lg" placeholder="<?php echo $txt_direccion_negocio;?>" name="Address"></textarea>
                                    </div>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<div class="form-group">
                                        <input class="form-control form-control-lg" type="text" placeholder="<?php echo $txt_zipcode_negocio;?>" name="ZipCode">
                                    </div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
                                        <label class="d-block"><?php echo $txt_donde_esta_negocio;?></label>
                                        <label class="mensaje-pequeno"><?php echo $txt_ayuda_mapa;?></label>
                                        <div id="map-selector" style="width:100%;height:400px;"></div>
                                        <input type="hidden" id="coordenadasLat" name="coordenadasLat">
                                        <input type="hidden" id="coordenadasLng" name="coordenadasLng">
                                    </div>
								</div>
							</div>
						</section>
					</div>
					<div class="step">
						<section>
							<h6><?php echo $txt_paso;?> 5 <?php echo $txt_de;?> 6</h6>
							<div class="progress mb-4" style="height: 1px;">
								<div class="progress-bar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                    <span class="sr-only">80%</span>
                                </div>
							</div><label class="d-block"><?php echo $txt_instrucciones_4;?></label>
							<div class="form-row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
                                        <label class="d-block"><?php echo $txt_maximo_personas;?></label>
                                        <input class="form-control form-control-lg" min="0" type="number" name="MaxCustomer">
                                    </div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group"><label class="d-block"><?php echo $txt_servicios_ofrece;?></label>
                                        <input class="form-control form-control-lg" type="text" id="categoriaDetalle" name="CategoryName">
                                        <label class="d-block mensaje-pequeno"><?php echo $txt_servicios_ofrece_default?></label></div>
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group"><label class="d-block"><?php echo $txt_proveedor_servicio;?></label></div>
                                    <input class="form-control form-control-lg" type="text" id="proveedorDeServicioDetalle" name="proveedorDeServicioDetalle">
									<label
										class="d-block mensaje-pequeno"><?php echo $txt_proveedor_servicio_default?></label>
								</div>
							</div>
						</section>
					</div>
					<div class="step submit">
						<section>
							<h6><?php echo $txt_paso;?> 6 <?php echo $txt_de;?> 6</h6>
							<div class="progress mb-4" style="height: 1px;">
								<div class="progress-bar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
							</div><label class="d-block"><?php echo $txt_plan_contratar;?></label>
							<div class="form-row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
                                        <select class="form-control form-control-lg" name="Plan" id="planes">
                                            <?php
                                            $config = get_option( 'tucita', array() );
                                            $planes=$config['conf']['planes']['plan'];
                                            $plan1=$config['conf']['planes']['plan'][0];
                                            $plan2=$config['conf']['planes']['plan'][1];
                                            $plan3=$config['conf']['planes']['plan'][2];
                                            $plan4=$config['conf']['planes']['plan'][3];

                                            $display0 = $_GET['p']!=0 ? 'style="display:none"' : '';
                                            $display1 = $_GET['p']!=1 ? 'style="display:none"' : '';
                                            $display2 = $_GET['p']!=2 ? 'style="display:none"' : '';
                                            $display3 = $_GET['p']!=3 ? 'style="display:none"' : '';

                                            foreach($planes as $p => $k){
	                                            $selected="";
                                                if($_GET['p']==$p){
                                                    $selected="selected";
                                                }
                                                ?>
                                                <option value="<?php echo $p?>" <?php echo $selected;?> data-plan="<?php echo $config['conf']['planes']['plan'][$p]['id'];?>"><?php echo __($k['nombre']);?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
								</div>
                                <?php
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
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
                                        <!-- GRATUITO -->
                                        <div id="p0" class="card card-paquetes" <?php echo $display0;?>>
                                            <div class="card-header">
                                                <h5 class="text-center mb-0"><?php echo __($plan1['nombre']);?></h5>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="text-center titulo-paquete">$<?php echo __($plan1['mensual']);?><span class="subtitulo-paquete"><?php echo $txt_mensual;?></span></h3>
                                                <h3 class="text-center titulo-paquete-nombre"><?php echo $plan1['no_citas'];?><span>&nbsp;<?php echo $txt_citas_mes;?></span></h3>
                                                <!-- <h4 class="text-center titulo2-paquete mt-3"><php echo $txt_citas_adicionales;?><br/>(100 <php echo $txt_citas;?>)<br></h4> -->

                                                <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_citas_adicionales_gratis;?></h4>

                                                <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_soporte;?><br></h4>
                                                <h3 class="text-center titulo-paquete-nombre-2">
													<?php if($plan1['soporte']!=""){?>
                                                        $<?php echo $plan1['soporte'];?><span><?php echo $txt_caso;?></span>
													<?php }?>
                                                </h3>
                                            </div>
                                        </div>
                                        <!-- BASICO -->
                                        <div id="p1" class="card card-paquetes" <?php echo $display1;?>>
                                            <div class="card-header">
                                                <h5 class="text-center mb-0"><?php echo __($plan2['nombre']);?></h5>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="text-center titulo-paquete">$<?php echo $plan2['mensual'];?><span class="subtitulo-paquete"><?php echo $txt_mensual;?></span></h3>
                                                <h3 class="text-center titulo-paquete-nombre"><?php echo $plan2['no_citas'];?><span>&nbsp;<?php echo $txt_citas_mes;?></span></h3>
                                                <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_citas_adicionales;?><br/>(100 <?php echo $txt_citas;?>)<br></h4>
                                                <h3 class="text-center titulo-paquete-nombre-2"><?php echo $plan2['costo_cita_adicional'];?><span><?php echo $txt_cita;?></span></h3>
                                                <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_soporte;?><br></h4>
                                                <h3 class="text-center titulo-paquete-nombre-2">
													<?php if($plan2['soporte']!=""){?>
                                                        $<?php echo $plan2['soporte'];?><span><?php echo $txt_caso;?></span>
													<?php }?>
                                                </h3>
                                            </div>
                                        </div>
                                        <!-- ESTANDARD -->
                                        <div id="p2" class="card card-paquetes" <?php echo $display2;?>>
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
                                        </div>
                                        <!-- PREMIUM -->
                                        <div id="p3" class="card card-paquetes" <?php echo $display3;?>>
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
													<?php if($plan3['soporte']!=""){?>
                                                        $<?php echo $plan4['soporte'];?>&nbsp;<span><?php echo $txt_caso;?></span>
													<?php }else{?>
														<?php echo $txt_incluido;?>
													<?php }?>
                                                </h3>
                                            </div>
                                        </div>
									</div>
								</div>
							</div>
						</section>
					</div>
					<div class="text-right mt-4">
                        <?php wp_nonce_field( 'steper-nonce', 'nonce' );?>
                        <button class="btn btn-dark btn-lg backward" type="button"><?php echo $txt_anterior;?></button>
                        <button class="btn btn-lg forward btn-naranja ml-1" type="button"><?php echo $txt_siguiente;?></button>
                        <button class="btn btn-primary btn-lg submit ml-1" type="submit"><?php echo $txt_procesar;?></button>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();