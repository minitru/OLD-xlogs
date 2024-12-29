<?php

// SEAN FOR XLOGS

// GET THE INFO BEING SENT TO US...
// require('twilio/Services/Twilio.php');
require_once('/var/www/xlogs/sms/Mogreet.php');

// MOGREET
$clientId = '5886'; // Your Client ID from https://developer.mogreet.com/dashboard SNS
// $clientId = '5887'; // Your Client ID from https://developer.mogreet.com/dashboard MMS
$token = 'd5c018372b2e7cc627921d11f4d36e53'; // Your token from https://developer.mogreet.com/dashboard
$client = new Mogreet($clientId, $token);
 
$response = $client->transaction->send(array(
    'campaign_id' => '63387', // Your SMS campaign ID from https://developer.mogreet.com/dashboard
    'to' => '3055091393',
    'message' => 'This is super easy! - bobo lives'
));
print $response->messageId;
?>
