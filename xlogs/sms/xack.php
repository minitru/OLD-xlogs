<?php

// SEAN FOR XLOGS

// GET THE INFO BEING SENT TO US...
require('twilio/Services/Twilio.php');

$tel=$_REQUEST['From'];	// INCOMING FROM THIS PHONE NUMBER
$reply=$_REQUEST['Body'];	// INCOMING FROM THIS PHONE NUMBER
$newreply=urlencode($reply);

$tel = str_replace("+1", "", $tel);

$fname = "data/$tel.php";
if (file_exists($fname)) {
	include "$fname";
	$reply=$newreply;
}
/*

CAN USE CURL TO FORWARD INFO ...

// HERE'S THE ACK CODE TO SEND BY curl
// http://cloud.bb4.org/cgi-bin/bb-ack.sh?ACTION=Ack&DELAY=60&MESSAGE=&NUMBER=&SUB=send+ack&DISP=

// USE curl TO SEND THE STUFF ACROSS
// TRY AS A SHELL SCRIPT FIRST 
$url="$site/cgi-bin/bb-ack.sh/?ACTION=Ack&DELAY=60&MESSAGE=$reply&NUMBER=$ack&SUB=send+ack&DISP=";

// HARDCODED - WE NEED A BACKDOOR TO BE ABLE TO SEND THIS STUFF SOMEHOW

$username="cloudbb";
$password="bbcloud";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch,CURLOPT_USERPWD,"$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$head = curl_exec($ch);
curl_close($ch); 

// WRITE THE STUFF OUT TO A FILE
$fp = fopen($fname, 'w') or die("can't open file");
$stuff="<?php
\$sid=\"$sid\";
\$tel=\"$tel\";
\$ack=\"$ack\";
\$site=\"$site\";
\$msg=\"$msg\";
\$reply=\"$reply\";
\$url=\"$url\";
?>";
fprintf($fp, "$stuff\n");
fclose($fp);

// \$ack=\"$ack\";
// \$site=\"$site\";
*/
?>
