<?php
/* Template Name: direct-shopping */

get_header();

if (!empty($_GET['business_id']) &&
    !empty($_GET['email']) &&
    !empty($_GET['subscription_type'])) {


    $businessId = $_GET['business_id'];
    $email = $_GET['email'];
    $subscriptionType = $_GET['subscription_type'];
    $config = get_option('tucita', array());

    // Get plans.
    $args = array(
        'orderby' => 'price', //Does not work, see sortBySubValue as a workaround
        'order' => 'ASC',
        'category' => array('plans'),
    );
    $products = wc_get_products($args);
    $productNames = array_map(function ($product) {
        if (__($product->get_name()) == 'Free' || __($product->get_name()) == 'Gratis') {
            return false;
        } else {
            return md5(strtolower(__($product->get_name())));
        }
    }, $products);
    $showDirectShoppingProducts = in_array($subscriptionType, $productNames);

    wp_logout();

    $credentials = array(
        'user_login' => $businessId,
        'user_password' => md5($email),
        'remember' => false
    );
    $userLogin = wp_signon($credentials, is_ssl());

    if (is_wp_error($userLogin)) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }

    ?>
    <div id="<?php echo __('[:en]pricing-plans[:es]paquetes[:]'); ?>" class="pt-5 pb-5" style="background: white;">
        <div class="container-fluid">

            <?php
            // TRADUCCION
            $txt_titulo = __('[:en]Pricing Plans[:es]Planes[:]');
            $txt_titulo_direct = __('[:en]Direct Products[:es]Productos Directos[:]');
            $txt_promo = __('[:en]Promotional price prepaying three (3) months<br><strong>20%</strong> discount<br/> <strong>Free</strong> Set Up and Training[:es]Precio de promoción prepagando tres (3) Meses<br><strong>20%</strong> de descuento<br>Configuración y Adiestramiento <strong>gratis</strong>[:]');
            $txt_mensual = __('[:en]/month[:es]/mensual[:]');
            $txt_citas_mes = __('[:en]bookings/month[:es]/citas/mes[:]');
            $txt_cita = __('[:en]/booking[:es]/cita[:]');
            $txt_citas = __('[:en]/bookings[:es]/citas[:]');
            $txt_citas_adicionales = __('[:en]Additional bookings[:es]Citas Adicionales[:]');
            $txt_caso = __('[:en]/case[:es]/caso[:]');
            $txt_soporte = __('[:en]Support[:es]Soporte[:]');
            $txt_incluido = __('[:en]Included[:es]Incluido[:]');
            $txt_suscribirme = __('[:en]Sign Up Now[:es]Suscribirme[:]');
            $txt_comprar = __('[:en]Buy[:es]Comprar[:]');
            $txt_citas_adicionales_gratis = __('[:en]Limited features to:<br/>1 location, service & reason to visit[:es]Función limitada a:<br/>1 localización, servicio & propósito de visita[:]');

            // Get plans.
            $args = array(
                'orderby' => 'price', //Does not work, see sortBySubValue as a workaround
                'order' => 'ASC',
                'category' => array('plans'),
            );
            $products = wc_get_products($args);

            $orderedProducts = [];
            foreach ($products as $key => $product) {
                if (__($product->get_name()) == 'Free' || __($product->get_name()) == 'Gratis') {
                    continue;
                }
                $attributes = $product->get_attributes();
                $orderedProducts[] = [
                    "name" => $product->get_name(),
                    "price" => $product->get_price(),
                    "bookings" => $attributes['bookings']->get_options()[0],
                    "additional_bookings" => $attributes['additional_bookings']->get_options()[0],
                    "limited_features" => (!empty($attributes['limited_features'])) ? $attributes['limited_features']->get_options()[0] : '',
                    "additional_booking_price" => (!empty($attributes['additional_booking_price'])) ? $attributes['additional_booking_price']->get_options()[0] : '',
                    "support_price_case" => $attributes['support_price_case']->get_options()[0],
                    "url" => $attributes['url']->get_options()[0],
                    "position_number" => $attributes['position_number']->get_options()[0],
                    "product_id" => $product->get_id()
                ];
            }

            $orderedProducts = sortBySubValue($orderedProducts, 'position_number');

            // Get direct products.
            $args = array(
                'orderby' => 'price', //Does not work, see sortBySubValue as a workaround
                'order' => 'ASC',
                'category' => array('direct'),
            );
            $products = wc_get_products($args);

            $orderedDirectProducts = [];

            if ($showDirectShoppingProducts) {
                foreach ($products as $key => $product) {
                    $attributes = $product->get_attributes();
                    $orderedDirectProducts[] = [
                        "name" => $product->get_name(),
                        "price" => $product->get_price(),
                        "bookings" => $attributes['bookings']->get_options()[0],
                        //"additional_bookings" => $attributes['additional_bookings']->get_options()[0],
                        //"limited_features" => (!empty($attributes['limited_features'])) ? $attributes['limited_features']->get_options()[0] : '',
                        //"additional_booking_price" => (!empty($attributes['additional_booking_price'])) ? $attributes['additional_booking_price']->get_options()[0] : '',
                        "support_price_case" => $attributes['support_price_case']->get_options()[0],
                        //"url" => $attributes['url']->get_options()[0],
                        "position_number" => $attributes['position_number']->get_options()[0],
                        "product_id" => $product->get_id()
                    ];
                }

                $orderedDirectProducts = sortBySubValue($orderedDirectProducts, 'position_number');
            }

            ?>
            <div class="row">
                <div class="col-12" data-aos="fade-down">
                    <h1 class="display-4 text-center mt-4"><?php echo $txt_titulo; ?></h1>
                    <h4 class="text-center orange-text mb-5 font-weight-lighter"><?php echo $txt_promo; ?><br></h4>
                </div>
                <?php
                $cardNumber = 0;
                foreach ($orderedProducts as $key => $product) {
                    $delay = 500 * $cardNumber;
                    $dataaosdelay = ($cardNumber > 0) ? "data-aos-delay=\"{$delay}\"" : "";
                    $cardNumber++;
                    ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3 flex"
                         data-aos="zoom-in-up" <?php echo $dataaosdelay; ?>>
                        <div class="card card-paquetes">
                            <div class="card-header">
                                <h5 class="text-center mb-0"><?php echo __($product['name']); ?></h5>
                            </div>
                            <div class="card-body">
                                <h3 class="text-center titulo-paquete">$<?php echo __($product['price']); ?><span
                                            class="subtitulo-paquete"><?php echo $txt_mensual; ?></span></h3>
                                <h3 class="text-center titulo-paquete-nombre"><?php echo $product['bookings']; ?><span>&nbsp;<?php echo $txt_citas_mes; ?></span>
                                </h3>

                                <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_citas_adicionales; ?><br/>(100 <?php echo $txt_citas; ?>
                                    )<br></h4>
                                <?php if (!empty($product['limited_features'])) { ?>
                                    <h4 class="text-center titulo2-paquete mt-3"><?php echo $product['limited_features']; ?></h4>
                                <?php } else { ?>
                                    <h3 class="text-center titulo-paquete-nombre-2"><?php echo $product['additional_booking_price']; ?>
                                        ¢<span><?php echo $txt_cita; ?></span></h3>
                                <?php } ?>

                                <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_soporte; ?><br></h4>
                                <?php if (!empty($product['support_price_case']) && (strtolower($product['support_price_case']) != 'included' || empty($product['support_price_case']))) { ?>
                                    <h3 class="text-center titulo-paquete-nombre-2">
                                        $<?php echo $product['support_price_case']; ?>
                                        <span><?php echo $txt_caso; ?></span>
                                    </h3>
                                <?php } else { ?>
                                    <h3 class="text-center titulo-paquete-nombre-2">
                                        <?php echo $txt_incluido; ?>
                                    </h3>
                                <?php } ?>
                            </div>
                            <div class="p-3">
                                <a class="btn btn-block btn-lg orange-button direct-shopping-btn"
                                   data-product-id="<?php echo $product['product_id']; ?>" role="button"
                                   target="_blank"
                                   href="#"><?php echo $txt_suscribirme; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="row">
                <?php
                if ($showDirectShoppingProducts) {
                    foreach ($orderedDirectProducts as $key => $product) {
                        $delay = 500 * $cardNumber;
                        $dataaosdelay = ($cardNumber > 0) ? "data-aos-delay=\"{$delay}\"" : "";
                        $cardNumber++;
                        ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3 flex"
                             data-aos="zoom-in-up" <?php echo $dataaosdelay; ?>>
                            <div class="card card-paquetes">
                                <div class="card-header">
                                    <h5 class="text-center mb-0"><?php echo __($product['name']); ?></h5>
                                </div>
                                <div class="card-body">
                                    <h3 class="text-center titulo-paquete">$<?php echo __($product['price']); ?><span
                                                class="subtitulo-paquete"><?php echo $txt_mensual; ?></span></h3>
                                    <h3 class="text-center titulo-paquete-nombre"><?php echo $product['bookings']; ?>
                                        <span>&nbsp;<?php echo $txt_citas_mes; ?></span>
                                    </h3>

                                    <!--                                <h4 class="text-center titulo2-paquete mt-3">-->
                                    <?php //echo $txt_citas_adicionales; ?><!--<br/>(100 -->
                                    <?php //echo $txt_citas; ?><!--)<br></h4>-->
                                    <?php /*if (!empty($value['limited_features'])) { */ ?><!--
                                    <h4 class="text-center titulo2-paquete mt-3"><?php /*echo $value['limited_features']; */ ?></h4>
                                <?php /*} else { */ ?>
                                    <h3 class="text-center titulo-paquete-nombre-2"><?php /*echo $value['additional_booking_price']; */ ?>
                                        ¢<span><?php /*echo $txt_cita; */ ?></span></h3>
                                --><?php /*} */ ?>

                                    <h4 class="text-center titulo2-paquete mt-3"><?php echo $txt_soporte; ?><br></h4>
                                    <?php if (!empty($product['support_price_case']) && (strtolower($product['support_price_case']) != 'included' || empty($product['support_price_case']))) { ?>
                                        <h3 class="text-center titulo-paquete-nombre-2">
                                            $<?php echo $product['support_price_case']; ?>
                                            <span><?php echo $txt_caso; ?></span>
                                        </h3>
                                    <?php } else { ?>
                                        <h3 class="text-center titulo-paquete-nombre-2">
                                            <?php echo $txt_incluido; ?>
                                        </h3>
                                    <?php } ?>
                                </div>
                                <div class="p-3">
                                    <a class="btn btn-block btn-lg orange-button direct-shopping-btn"
                                       data-product-id="<?php echo $product['product_id']; ?>" role="button"
                                       target="_blank"
                                       href="#"><?php echo $txt_comprar; ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div>
                <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                <input type="hidden" name="businessId" id="businessId" value="<?php echo $businessId; ?>">
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
    <div class="modal fade" role="dialog" tabindex="-1" id="modalError">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-2">
                        <?php echo __('[:en]An error occurred, please reload the page and try again[:es]Ocurrió un error, por favor recarga la página e intenta de nuevo[:]');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part(404);
    exit();
}

get_footer();