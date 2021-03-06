<?php
/*
Plugin Name: Dynamics Payment
Description: Implementación personalizada de Dynamics Payment para Woocommerce
Author: Edwin Castañeda
Author URI: https://about.me/edwin.castaneda
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
add_action('plugins_loaded', 'init_dinamics_gateway_class');
function init_dinamics_gateway_class()
{


    class WC_Gateway_Dynamics extends WC_Payment_Gateway
    {

        public $domain;
        public $apiUrl;
        public $siteId;
        public $merchantKey;

        public function __construct()
        {
            $config = get_option('tucita', array());

            $this->domain = 'dinamics_payment';
            $this->apiUrl = $config['conf']['dynamics']['apiURL']; //'https://stage.agilpay.net/WebApi/APaymentTokenApi/';
            $this->siteId = $config['conf']['dynamics']['siteId']; //'L5JzsfJamGYqkR6U';
            $this->merchantKey = $config['conf']['dynamics']['merchantKey']; // 'NDk5Mjk0ODky';

            $this->id = 'dinamics';
            $this->icon = apply_filters('woocommerce_custom_gateway_icon', '');
            $this->has_fields = true;
            $this->method_title = __('Dynamics Payments', $this->domain);
            $this->method_description = __('Integracion de Dynamics Payments', $this->domain);
            //$this->supports = array( 'products', 'subscriptions', 'subscription_cancellation', );
            $this->supports = array(
                'products',
                'subscriptions',
                'subscription_cancellation',
                'subscription_suspension',
                'subscription_reactivation',
                'subscription_amount_changes',
                'subscription_date_changes',
                'subscription_payment_method_change_admin'
            );

            // Load the settings.
            $this->init_form_fields();
            $this->init_settings();

            // Define user set variables
            $this->title = $this->get_option('title');
            $this->description = $this->get_option('description');
            $this->order_status = $this->get_option('order_status', 'completed');

            // Actions
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array(
                $this,
                'process_admin_options'
            ));

            // Subscriptions
            if (class_exists('WC_Subscriptions_Order')) {
                add_action('woocommerce_scheduled_subscription_payment_' . $this->id, array($this, 'scheduled_process_subscription_payment'), 10, 2);
            }
        }

        public function init_form_fields()
        {
            $this->form_fields = array(
                'enabled' => array(
                    'title' => __('Enable/Disable', $this->domain),
                    'type' => 'checkbox',
                    'label' => __('Enable Dynamics Payments', $this->domain),
                    'default' => 'yes'
                ),
                'title' => array(
                    'title' => __('Title', $this->domain),
                    'type' => 'text',
                    'description' => __('This controls the title which the user sees during checkout.', $this->domain),
                    'default' => __('Tarjeta de Crédito', $this->domain),
                    'desc_tip' => true,
                ),
                'order_status' => array(
                    'title' => __('Order Status', $this->domain),
                    'type' => 'select',
                    'class' => 'wc-enhanced-select',
                    'description' => __('Choose whether status you wish after checkout.', $this->domain),
                    'default' => 'wc-completed',
                    'desc_tip' => true,
                    'options' => wc_get_order_statuses()
                ),
            );
        }

        public function payment_fields()
        {

            if ($description = $this->get_description()) {
                echo wpautop(wptexturize($description));
            }

            $txt_tarjeta_credito = __('[:en]Credit card number[:es]Numeración de la tarjeta[:]');
            $txt_nombre_tarjeta = __('[:en]Name that appears on the card[:es]Nombre que aparece en la tarjeta[:]');
            $txt_fecha_vencimiento = __('[:en]Due date[:es]Fecha de vencimiento[:]');

            ?>
            <section>
                <div class="form-row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="d-block"><?php echo $txt_tarjeta_credito; ?></label>
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="number" name="numeroDeTarjeta" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="d-block"><?php echo $txt_nombre_tarjeta; ?></label>
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="nombreDeTarjeta" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-7 col-lg-6 col-xl-5">
                        <label class="d-block"><?php echo $txt_fecha_vencimiento; ?></label>
                        <div class="form-group">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <input class="form-control form-control-lg" type="number" placeholder="MM" min="01"
                                           max="12" name="mesVence" style="width: 100px;" required>
                                </li>
                                <li class="list-inline-item">/</li>
                                <li class="list-inline-item ml-3">
                                    <input class="form-control form-control-lg" type="number" placeholder="YYYY"
                                           min="<?php echo date('Y'); ?>" name="anoVence" style="width: 100px;"
                                           required>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--<div class="col-auto"><label class="d-block">CVV</label>
						<div class="form-group">
							<input class="form-control form-control-lg" type="number" name="cvv" placeholder="###"  min="000" max="999" style="width: 100px;" required></div>
					</div>-->
                </div>
            </section>
            <?php
            global $current_user;
            wp_get_current_user();
            ?>
            <input type="hidden" name="BusinessID" value="<?php echo $current_user->user_login; ?>">
            <input type="hidden" name="Email" value="<?php echo $current_user->user_email; ?>">
            <?php
        }

        public function process_payment($order_id)
        {
            $order = wc_get_order($order_id);
            // Processing subscription
            if (function_exists('wcs_order_contains_subscription') && (wcs_order_contains_subscription($order_id) || wcs_is_subscription($order_id) || wcs_order_contains_renewal($order_id))) {
                $this->process_subscription_payment($order_id);
            } else {
                $this->process_payment_generic($order_id);
            }

            // Return thankyou redirect
            // $this->get_return_url( $order )
            return array(
                'result' => 'success',
                'redirect' => $this->get_return_url($order)
            );
        }

        public function process_payment_generic($order_id)
        {
            $order = wc_get_order($order_id);
            $total = $this->get_order_total($order_id);

            if (get_post_meta($order_id, 'AccountToken', true) == "") {
                $this->registerToken($order_id);
            }

            $resultado = $this->authorizeToken($order_id, $total, "840", "0", "i-" . $order_id, "Pack Tu Cita 24/7.");
            $resultadoPOS = json_decode($resultado);

            if (in_array($resultadoPOS->Status, ['Rejected', 'Rechazada'])) {
                $order->add_order_note("Pago no ejecutado | Response Code: " . $resultadoPOS->ResponseCode);
                $order->add_order_note("Pago no ejecutado | Message: " . $resultadoPOS->Message);

                // Set order status
                $order->update_status('failed', __('Checkout con Dynamics POS Failed. ', $this->domain));
            } else {
                $transaction = $resultadoPOS->IDTransaction;
                $order->add_order_note("Pago ejecutado | Transacción TC: " . $transaction);
                // Set order status
                $order->update_status('completed', __('Checkout con Dynamics POS. ', $this->domain));
                $order->set_transaction_id($transaction);
                // Remove cart
                WC()->cart->empty_cart();
                wp_logout();
            }
        }

        public function process_subscription_payment($order_id)
        {
            $order = wc_get_order($order_id);
            $total = WC_Subscriptions_Order::get_recurring_total($order_id);

            if (get_post_meta($order_id, 'AccountToken', true) == "") {
                $this->registerToken($order_id);
            }
            $resultado = $this->authorizeToken($order_id, $total, "840", "0", "i-" . $order_id, "Suscripción Tu Cita 24/7");
            $resultadoPOS = json_decode($resultado);
            $order->add_order_note($resultado);

            if (in_array($resultadoPOS->Status, ['Rejected', 'Rechazada'])) {
                $order->add_order_note("Pago no ejecutado | Response Code: " . $resultadoPOS->ResponseCode);
                $order->add_order_note("Pago no ejecutado | Message: " . $resultadoPOS->Message);

                // Set order status
                $order->update_status('failed', __('Checkout con Dynamics POS Failed. ', $this->domain));
            } else {

                $transaction = $resultadoPOS->IDTransaction;
                $order->add_order_note("Pago ejecutado | Transacción TC: " . $transaction);
                $order->set_transaction_id($transaction);

                foreach ($order->get_items() as $item_id => $item) {
                    $product_id = $item['product_id'];
                }

                $tipo = get_post_meta($product_id, 'tipo', true);
                $no_citas = get_post_meta($product_id, 'citas', true);
                $update = $this->updatePlan($order_id, $tipo, $no_citas);

                if ($update->Code == "200") {
                    $order->add_order_note("Plan Activado | Transacción TC: " . $transaction);
                    $status = 'wc-' === substr($this->order_status, 0, 3) ? substr($this->order_status, 3) : $this->order_status;

                    // Set order status
                    $order->update_status($status, __('Checkout con Dynamics POS. ', $this->domain));

                    // Remove cart
                    WC()->cart->empty_cart();

                    $this->cancelPreviousSubscriptions();

                    wp_logout();

                } else {
                    $order->add_order_note("Fallo en la activación | Transacción TC:" . $transaction);
                }
            }
        }

        public function scheduled_process_subscription_payment($total, $order)
        {
            $order_id = $order->get_id();

            $resultado = $this->authorizeToken($order_id, $total, "840", "0", "i-" . $order_id, "Suscripción Tu Cita 24/7");
            $resultadoPOS = json_decode($resultado);
            $order->add_order_note($resultado);

            if (in_array($resultadoPOS->Status, ['Rejected', 'Rechazada'])) {
                $order->add_order_note("Pago no ejecutado | Response Code: " . $resultadoPOS->ResponseCode);
                $order->add_order_note("Pago no ejecutado | Message: " . $resultadoPOS->Message);

                // Set order status
                $order->update_status('failed', __('Checkout con Dynamics POS Failed. ', $this->domain));
            } else {
                $transaction = $resultadoPOS->IDTransaction;
                $order->add_order_note("Pago ejecutado | Transacción TC: " . $transaction);
                $order->set_transaction_id($transaction);
                foreach ($order->get_items() as $item_id => $item) {
                    $product_id = $item['product_id'];
                }
                $tipo = get_post_meta($product_id, 'tipo', true);
                $no_citas = get_post_meta($product_id, 'citas', true);
                $update = $this->updatePlan($order_id, $tipo, $no_citas);

                if ($update->Code == "200") {
                    $order->add_order_note("Plan Activado | Transacción TC: " . $transaction);
                    $status = 'wc-' === substr($this->order_status, 0, 3) ? substr($this->order_status, 3) : $this->order_status;

                    // Set order status
                    $order->update_status($status, __('Checkout con Dynamics POS. ', $this->domain));

                } else {
                    $order->add_order_note("Fallo en la activación | Transacción TC:" . $transaction);
                }
            }
        }

        public function getHash($type, $order_id, $amount = "", $currency = "")
        {

            if ($type == "Register") {
                $contentHash = $this->siteId . $order_id . $_POST['numeroDeTarjeta'] . $_POST['nombreDeTarjeta'] . $_POST['BusinessID'] . "1";
            } else if ($type == "Authorize") {
//				$AccountToken = get_post_meta( $order_id, 'AccountToken', true );
                $AccountToken = $this->getAccountToken($order_id);
                $contentHash = $this->siteId . $order_id . $this->merchantKey . $AccountToken . $amount . $currency;
            }

            $headers = [
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'SiteId' => $this->siteId,
                )
            ];

            $responseHash = wp_remote_get($this->apiUrl . 'GetHash?contentHash=' . $contentHash, $headers);

            if (is_array($responseHash) && !is_wp_error($responseHash)) {
                $Hash1 = $responseHash['body'];
                $Hash2 = substr($Hash1, 1);
                $Hash = substr($Hash2, 0, -1);

                return $Hash;
            }
        }

        public function getAccountToken($order_id)
        {

            $order = wc_get_order($order_id);
            $subscriptions_ids = wcs_get_subscriptions_for_order($order_id, array('order_type' => 'any'));

            if (count($subscriptions_ids) > 0) {

                $subscription_parent_id = 0;

                foreach ($subscriptions_ids as $subscription_id => $subscription_obj) {
                    $subscription_parent_id = $subscription_obj->order->id;
                    break;
                }

                return get_post_meta($subscription_parent_id, 'AccountToken', true);
            } else {
                return get_post_meta($order_id, 'AccountToken', true);
            }
        }

        public function registerToken($order_id)
        {

            //REGISTER TOKEN
            $headers = array(
                'Content-Type' => 'application/json',
                'SessionId' => $order_id,
                'SiteId' => $this->siteId,
                'MessageHash' => $this->getHash("Register", $order_id),
            );

            $body = array(
                "MerchantKey" => $this->merchantKey,
                "AccountNumber" => $_POST['numeroDeTarjeta'],
                "ExpirationMonth" => $_POST['mesVence'],
                "ExpirationYear" => $_POST['anoVence'],
                "CustomerName" => $_POST['nombreDeTarjeta'],
                "IsDefault" => false,
                "CustomerId" => $_POST['BusinessID'],
                "AccountType" => "1",
                "CustomerEmail" => $_POST['Email'],
                "ZipCode" => "12345"
            );

            $options = [
                'headers' => $headers,
                'body' => json_encode($body),
            ];

            $responseToken = wp_remote_post($this->apiUrl . 'RegisterToken', $options);

            if (is_array($responseToken) && !is_wp_error($responseToken)) {
                $Token = $responseToken['body'];
            }

            $AccountToken = json_decode($Token)->AccountToken;

            $order = wc_get_order($order_id);

            // GUARDO TOKEN EN CUSTOM FIELD DEL PARENT ORDER
            update_post_meta($order_id, 'AccountToken', $AccountToken);
            //update_post_meta($order_id, 'AccountToken', $AccountToken);
            //error_log(print_r($relatedOrders, true));
        }

        public function authorizeToken($order_id, $amount, $currency, $tax, $invoice, $detail)
        {

            //REGISTER AUTHORIZE
            $headers = array(
                'Content-Type' => 'application/json',
                'SessionId' => $order_id,
                'SiteId' => $this->siteId,
                'MessageHash' => $this->getHash("Authorize", $order_id, $amount, $currency),
            );

            $body = array(
                "MerchantKey" => $this->merchantKey,
                "AccountToken" => $this->getAccountToken($order_id),
                "Amount" => $amount,
                "Currency" => $currency,
                "Tax" => $tax,
                "Invoice" => $invoice,
                "Transaction_Detail" => $detail,
                "ReserveFunds" => false
            );

            $options = [
                'headers' => $headers,
                'body' => json_encode($body),
            ];


            $responseToken = wp_remote_post($this->apiUrl . 'AutorizeToken', $options);

            if (is_array($responseToken) && !is_wp_error($responseToken)) {
                $Token = $responseToken['body'];
            }

            return $Token;
        }

        public function updatePlan($order_id, $plan, $no_citas)
        {
            $order = new WC_Order($order_id);
            $user = new WP_User($order->get_user_id());

            /*$headers = [
                    'headers' => array(
                        'Content-Type' => 'application/json',
                        'origin' => 'http://tucita247.test',
                    ),
                    'method' => 'PUT'
            ];
            $url = 'https://api.tucita247.com/business/plan/'.$user->data->user_login.'/'.$plan.'/'.$no_citas.'/'.$order_id;

            $response = wp_remote_request( $url, $headers );
            if ( is_array( $response ) && ! is_wp_error( $response ) ) {
                $results = $response['body'];
            }

            return $results;

*/
            $curl = curl_init();
            $url = 'https://api.tucita247.com/business/plan/' . $user->data->user_login . '/' . $plan . '/' . $no_citas . '/' . $order_id;
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "origin: http://tucita247.test"
                ),
            ));

            $response = curl_exec($curl);
            $responseJson = json_decode($response);
            curl_close($curl);

            return $responseJson;

        }

        public function cancelPreviousSubscriptions(){
            $no_of_loops = 0;
            $user_id = get_current_user_id();

            // Get all customer subscriptions
            $args = array(
                'subscription_status'       => 'active',
                'subscriptions_per_page'    => -1,
                'customer_id'               => $user_id,
                'orderby'                   => 'ID',
                'order'                     => 'DESC'
            );
            $subscriptions = wcs_get_subscriptions($args);

            // Going through each current customer subscriptions
            foreach ( $subscriptions as $subscription ) {
                $no_of_loops = $no_of_loops + 1;

                if ($no_of_loops > 1){
                    $subscription->update_status( 'cancelled' );
                }
            }
        }
    }


}

function add_dinamics_gateway_class($methods)
{
    $methods[] = 'WC_Gateway_Dynamics';
    return $methods;
}

add_filter('woocommerce_payment_gateways', 'add_dinamics_gateway_class');


function process_dinamics_payment()
{

    if ($_POST['payment_method'] != 'dinamics')
        return;

}

add_action('woocommerce_checkout_process', 'process_dinamics_payment');


