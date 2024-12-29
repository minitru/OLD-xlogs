<?php
// Get the PHP helper library from twilio.com/docs/php/install
// Loads the library
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
// require __DIR__ . '/var/www/xlogs/sms/twilio/Services/Twilio/Rest';

// Use the REST API Client to make requests to the Twilio REST API
// use Twilio\Rest\Client;

$client = new Lookups_Services_Twilio('XX', 'YY');
 
/*
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "{{account_sid}}";
$token = "{{ auth_token }}";
$client = new Lookups_Services_Twilio($sid, $token);
*/
 
// Make a call to the Lookup API
$number = $client->phone_numbers->get("15108675309");
 
// Print the nationally formatted phone number
echo $number->national_format . "\r\n"; // => (510) 867-5309
?>
