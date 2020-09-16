<?php
/**
 * Created by PhpStorm.
 * User: Shishir Kumar
 * Date: 11-03-2018
 * Time: 13:16
 */
require_once "stripe-php-master/init.php";
$stripeDetails = array(
   "secretKey" => "sk_test_v5UdkbfVgenIv4fltK6lGhyS",
   "publisableKey"  => "pk_test_uK1Uf5ssw6HAq48jqn9MSJq"
);

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey('sk_test_v5UdkbfVgenIv4fltK6lGhyS');
