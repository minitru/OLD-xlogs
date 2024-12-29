<?php

// SEAN FOR XLOGS

// GET THE INFO BEING SENT TO US...
$tel=$_REQUEST['tel'];	// SEND TO THIS PHONE NUMBER
$site=$_REQUEST['site'];	// ABOUT THIS SITE bobo.bb4.org
$ack=$_REQUEST['ack'];	// ACK CODE
$msg=$_REQUEST['msg'];	// THE MESSSAGE

if ($tel == "") {
	echo "xsms: missing telephone number\n";
	exit(1);
}

if ($site == "") {
	echo "xsms: missing site\n";
	exit(2);
}

if ($msg == "") {
	echo "xsms: missing msg\n";
	exit(3);
}

if ($ack == "") {
	echo "xsms: missing ackcode\n";
	exit(4);
}

$msg= urldecode ($msg);

require('twilio/Services/Twilio.php');

$client = new Services_Twilio('XX', 'YY');
$message = $client->account->sms_messages->create(
  '+17866295647', // From a Twilio number in your account
  $tel, // Text any number
  $msg
);
$sid=$message->sid;

// WRITE THE STUFF OUT TO A FILE
$fname = "data/$tel.php";
$fp = fopen($fname, 'w') or die("can't open file");
$stuff="<?php
\$sid=\"$sid\";
\$tel=\"$tel\";
\$ack=\"$ack\";
\$site=\"$site\";
\$msg=\"$msg\";
?>";
fprintf($fp, "$stuff\n");
fclose($fp);

// THIS IS THE MESSAGE ID
// print $message->sid;
?>
