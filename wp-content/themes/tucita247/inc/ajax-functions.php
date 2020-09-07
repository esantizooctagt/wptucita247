<?php

function add_business()
{

    $checkNonce = check_ajax_referer('scripts-ajax-nonce', 'registration-nonce', false);
    if (!$checkNonce) {
        wp_send_json(["error" => "wrong nonce: "], 403);
    }

    global $woocommerce;

    $lat = isset($_POST['coordenadasLat']) ? $_POST['coordenadasLat'] : '';
    $lng = isset($_POST['coordenadasLng']) ? $_POST['coordenadasLng'] : '';

    $body = array(
        "Email" => isset($_POST['Email']) ? $_POST['Email'] : '',
        "First_Name" => isset($_POST['First_Name']) ? $_POST['First_Name'] : '',
        "Last_Name" => isset($_POST['Last_Name']) ? $_POST['Last_Name'] : '',
        "User_Phone" => isset($_POST['User_Phone']) ? preg_replace('/\D/', '', $_POST['User_Phone']) : '',
        "Address" => isset($_POST['Address']) ? $_POST['Address'] : '',
        "City" => isset($_POST['City']) ? $_POST['City'] : '',
        "Country" => isset($_POST['Country']) ? $_POST['Country'] : '',
        "CategoryId" => isset($_POST['CategoryId']) ? $_POST['CategoryId'] : '',
        "CategoryName" => isset($_POST['CategoryName']) ? $_POST['CategoryName'] : '',
        "Name" => isset($_POST['Name']) ? $_POST['Name'] : '',
        "Provider" => isset($_POST['proveedorDeServicioDetalle']) ? $_POST['proveedorDeServicioDetalle'] : '',
        "Phone" => isset($_POST['User_Phone']) ? preg_replace('/\D/', '', $_POST['User_Phone']) : '',
        "Geolocation" => '{"LAT": ' . $lat . ',"LNG": ' . $lng . '}',
        "Facebook" => isset($_POST['Facebook']) ? $_POST['Facebook'] : '',
        "Instagram" => isset($_POST['Instagram']) ? $_POST['Instagram'] : '',
        "Twitter" => isset($_POST['Twitter']) ? $_POST['Twitter'] : '',
        "Website" => isset($_POST['Website']) ? $_POST['Website'] : '',
        "Tags" => isset($_POST['Tags']) ? $_POST['Tags'] : '',
        "TuCitaLink" => isset($_POST['TuCitaLink']) ? $_POST['TuCitaLink'] : '',
        "ZipCode" => isset($_POST['ZipCode']) ? $_POST['ZipCode'] : '',
        "Description" => isset($_POST['Description']) ? $_POST['Description'] : '',
        "Plan" => 'FREE',
        "Locations" => array(array(
            "Name" => isset($_POST['Name']) ? $_POST['Name'] : '',
            "City" => isset($_POST['City']) ? $_POST['City'] : '',
            "Sector" => isset($_POST['Sector']) ? $_POST['Sector'] : '101',
            "Address" => isset($_POST['Address']) ? $_POST['Address'] : '',
            "Geolocation" => '{"LAT": ' . $lat . ',"LNG": ' . $lng . '}',
            "MaxCustomer" => isset($_POST['MaxCustomer']) ? $_POST['MaxCustomer'] : '',
        ))
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tucita247.com/business",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "origin: http://wordpress.test"
        ),
    ));

    $response = curl_exec($curl);
    $responseJson = json_decode($response);

    curl_close($curl);

    $businessId = $responseJson->BusinessId != "" ? $responseJson->BusinessId : "0";
    $return = $businessId;

    if ($businessId != "0") {
        $existsEmail = email_exists($_POST['Email']);

        if (!$existsEmail) {
            $userdata = array(
                'user_pass' => MD5($_POST['Email']),
                'user_login' => $businessId,
                'user_url' => $_POST['TuCitaLink'],
                'user_email' => $_POST['Email'],
                'display_name' => $_POST['First_Name'] . ' ' . $_POST['Last_Name'],
                'first_name' => $_POST['First_Name'],
                'last_name' => $_POST['Last_Name'],
                'show_admin_bar_front' => false,
            );

            $user_id = wp_insert_user($userdata);
            if (is_wp_error($user_id)) {
                $return = "0";
            }
        }

        wp_logout();

        $creds = array(
            'user_login' => $businessId,
            'user_password' => md5($_POST['Email']),
            'remember' => false
        );

        $userLogin = wp_signon($creds, is_ssl());

        if (is_wp_error($userLogin)) {
            $return = "0";
        } else {
            $woocommerce->cart->empty_cart();
            $woocommerce->cart->add_to_cart($_POST['p'], 1);
        }

        if ($_POST['p'] == "") {
            $return = "99";
        }
    }

    echo $return;
    wp_die();
}

add_action('wp_ajax_nopriv_add_business', 'add_business');
add_action('wp_ajax_add_business', 'add_business');


function direct_shopping()
{

    $checkNonce = check_ajax_referer('scripts-ajax-nonce', 'direct-shopping-nonce', false);
    if (!$checkNonce) {
        wp_send_json(["error" => "wrong nonce: "], 403);
    }

    global $woocommerce;

    if (!empty($_POST['business_id']) &&
        !empty($_POST['email']) &&
        !empty($_POST['product_id'])) {

        $businessId = $_POST['business_id'];
        $email = $_POST['email'];
        $productId = $_POST['product_id'];

        wp_logout();

        $credentials = array(
            'user_login' => $businessId,
            'user_password' => md5($email),
            'remember' => false
        );

        $userLogin = wp_signon($credentials, is_ssl());

        if (is_wp_error($userLogin)) {
            wp_send_json(["error" => "user does not exists"], 401);
        } else {
            $woocommerce->cart->empty_cart();
            $woocommerce->cart->add_to_cart($productId, 1);
        }

        /**
         * If the user comes from a free plan, he can only upgrade to a subscription
         * If the user comes from a subscription, he can upgrade to another subscription or buy direct packages
         */
        if (empty($productId)) {
            wp_send_json(["error" => "empty product"], 403);
        } else {
            wp_send_json(["product_id" => $productId]);
        }
    } else {
        wp_send_json(["error" => "incorrect parameters"], 403);
    }
}

add_action('wp_ajax_nopriv_direct_shopping', 'direct_shopping');
add_action('wp_ajax_direct_shopping', 'direct_shopping');
