<?php
// Settings
function fm_tucita() {
	$fm = new Fieldmanager_Group(
		array(
			'name'        => 'tucita',
			'children'    => array(
				'conf' => new Fieldmanager_Group(
					array(
						'tabbed'   => 'vertical',
						'children' => array(
							'dynamics' => new Fieldmanager_Group(
								array(
									'label'    => 'Dynamics payment',
									'children' => array(
										'apiURL' => new Fieldmanager_Textfield(
											array(
												"label" => "API URL",
												"input_type" => "url"
											)
										),
										'siteId' => new Fieldmanager_Textfield(
											array(
												"label" => "Site Id",
												"input_type" => "text"
											)
										),
										'merchantKey' => new Fieldmanager_Textfield(
											array(
												"label" => "Merchant Key",
												"input_type" => "text"
											)
										),
									),
								)
							),
							'tiendas' => new Fieldmanager_Group(
								array(
									'label'    => 'Tiendas',
									'children' => array(
										'android' => new Fieldmanager_Textfield(
											array(
												"label" => "URL Google Play",
												"input_type" => "url"
											)
										),
										'ios' => new Fieldmanager_Textfield(
											array(
												"label" => "URL App Store",
												"input_type" => "url"
											)
										),
									),
								)
							),
							'llaves' => new Fieldmanager_Group(
								array(
									'label'    => "Google API's",
									'children' => array(
										'maps' => new Fieldmanager_Textfield(
											array(
												"label" => "Api key Google maps",
												"input_type" => "text"
											)
										),
										'recaptcha' => new Fieldmanager_Textfield(
											array(
												"label" => "Clave de sitio web reCaptcha V2",
												"input_type" => "text"
											)
										),
									),
								)
							),
							'paginas' => new Fieldmanager_Group(
								array(
									'label'    => "Páginas Especiales",
									'children' => array(
										'suscribirme' => new Fieldmanager_Textfield(
											array(
												"label" => "ID Página de suscripción",
												"input_type" => "number"
											)
										),
									),
								)
							),
							'redes' => new Fieldmanager_Group(
								array(
									'label'    => 'Redes Sociales',
									'children' => array(
										'facebook' => new Fieldmanager_Textfield(
											array(
												"label" => "URL Facebook",
												"input_type" => "url"
											)
										),
										'twitter' => new Fieldmanager_Textfield(
											array(
												"label" => "URL Twitter",
												"input_type" => "url"
											)
										),
										'instagram' => new Fieldmanager_Textfield(
											array(
												"label" => "URL Instagram",
												"input_type" => "url"
											)
										),
										'linkedin' => new Fieldmanager_Textfield(
											array(
												"label" => "URL Linkedin",
												"input_type" => "url"
											)
										),
										'telefono' => new Fieldmanager_Textfield(
											array(
												"label" => "URL Teléfono",
												"input_type" => "url"
											)
										),
										'email' => new Fieldmanager_Textfield(
											array(
												"label" => "URL Email",
												"input_type" => "url"
											)
										),
									),
								)
							),
							'planes' => new Fieldmanager_Group(
								array(
									'label'    => 'Planes',
									'children' => array(
										'plan' => new Fieldmanager_Group(
											array(
												'collapsible'    => true,
												'collapsed'      => true,
												'sortable'       => true,
												'label'          => 'Plan',
												'label_macro'    => array( 'Plan: %s', 'nombre' ),
												'add_more_label' => 'Agregar Patrocinador',
												'limit'          => 4,
												'minimum_count'  => 4,
												'extra_elements' => 0,
												'children'       => array(
													'id' => new Fieldmanager_Textfield(
														array(
															"label" => "ID Producto WC",
															"input_type" => "number"
														)
													),
													'nombre' => new Fieldmanager_Textfield(
														array(
															"label" => "Nombre",
															"input_type" => "text"
														)
													),
													'mensual' => new Fieldmanager_Textfield(
														array(
															"label" => "Costo mensual",
															"input_type" => "number"
														)
													),
													'no_citas' => new Fieldmanager_Textfield(
														array(
															"label" => "Citas al mes",
															"input_type" => "number"
														)
													),
													'costo_cita_adicional' => new Fieldmanager_Textfield(
														array(
															"label" => "Costo por cita adicional",
															"input_type" => "number"
														)
													),
													'soporte' => new Fieldmanager_Textfield(
														array(
															"label" => "Costo de Soporte",
															"input_type" => "number"
														)
													),
													'url' => new Fieldmanager_Textfield(
														array(
															"label" => "URL",
														)
													),
												),
											)
										),
									),
								)
							),
						),
					)
				),
			),
		)
	);
	$fm->activate_submenu_page();
}

add_action( 'fm_submenu_tucita', 'fm_tucita' );
if ( function_exists( 'fm_register_submenu_page' ) ) {
	fm_register_submenu_page( 'tucita', 'tucita247option', 'Configuración General', 'Configuración General', 'edit_pages' );
}


function arcadenoe_add_admin_page () {
	add_menu_page( 'Theme Setup', 'Theme Setup', 'manage_options', 'tucita247option', '', 'dashicons-admin-generic');
	add_submenu_page('tucita247option', 'Configuración ADN Theme', 'Configuración ADN Theme', 'manage_options', 'tucita247option', '');
	remove_submenu_page( 'tucita247option', 'tucita247option' );

}
add_action( 'admin_menu', 'arcadenoe_add_admin_page' );




function sanitize_elements( $value ) {
	return $value;
}
