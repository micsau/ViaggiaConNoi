<?php
    require_once('vendor/autoload.php');
    $config = file_get_contents('../../../config.json');
    $jConfig = json_decode($config, true);
    $baseurl = $jConfig["BASE_URL"];
    \Stripe\Stripe::setApiKey($jConfig["STRIPE_API_KEY"]);

    \Stripe\Checkout\Session::create([
        'success_url' => "$baseurl/main/buy/success",
        'cancel_url' => "$baseurl",
        'payment_method_types' => ['card'],
        'line_items' => [
        [
            'name' => 'T-shirt',
            'description' => 'Comfortable cotton t-shirt',
            'amount' => 1500,
            'currency' => 'usd',
            'quantity' => 2,
        ],
    ],
]);
?>