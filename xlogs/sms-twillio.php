<?php
	/* TWILLIO SMS FUMCTION - SEE http://twillio.com
	 * sean@maclawran.ca
	 * YOU NEED AN SID+SECRET PLUS A TWILLIO # FOR THIS TO WORK
	 * PLUS THE TWILLIP php API
	 * THE NUMBER IS $1/month AND SMS IS $0.01 USD EACH
	 */
	define('TWILLIOSID', 'Insert-twillio-SID-here');
	//define('TWILLIOTOK', '5ca54f48888e0095229beaedc4888947');
	// TEST AUTH FAILED LOGIC
	define('TWILLIOTOK', 'Insert-twillio-TOKEN-here');
	define('TWILLIOTEL', 'Insert-twillio-FROM-TELNO-here');

	/* SET THE CALL INFO HERE */
	$tel = "13052402984";
	$msg = "TEXT MESSAGE TO SEND HERE...";

	$rc = twilliosms($tel, $msg, TWILLIOSID, TWILLIOTOK, TWILLIOTEL);
	exit($rc);

function twilliosms($to, $txt, $sid, $tok, $fromtel) 
{
	// Include the PHP TwilioRest library
	require "Services/Twilio.php";
	
	// Set our AccountSid and AuthToken
	$AccountSid = $sid;
	$AuthToken = $tok;
	$from= $fromtel;	

	// Instantiate a new Twilio Rest Client
	try {
		$client = new Services_Twilio($AccountSid, $AuthToken);
		$client->account->sms_messages->create($fromtel, $to, $txt);
	}
	catch(Exception $e) {
  		print "Message: " .$e->getMessage() . " - CHECK SID & TOKEN\n";
		return(1);
  	}
}
?>
