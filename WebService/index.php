<?php
require 'vendor/autoload.php';

$app= new \Slim\Slim();

$app->get('/card', function () {
    // Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey("sk_test_oeqZpwXuDXdpyPSnwvUWs96m");

// Get the credit card details submitted by the form
    $token = $_POST['stripeToken'];

// Create the charge on Stripe's servers - this will charge the user's card
    try {
        $charge = \Stripe\Charge::create(array(
            "amount" => 1000, // amount in cents, again
            "currency" => "eur",
            "source" => $token,
            "description" => "Example charge"
        ));
    } catch(\Stripe\Error\Card $e) {
        // The card has been declined
    }

});


$app->run();


?>