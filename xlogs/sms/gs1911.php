<?php

// SEAN FOR SLACK-TO-TEXT

// GET THE INFO BEING SENT TO US...
$token=$_REQUEST['token']; 		# zOBjvfa9ppOzoMbqb72qzmS9
$team_id=$_REQUEST['team_id'];		# T0001
$team_domain=$_REQUEST['team_domain'];	# example
$channel_id=$_REQUEST['channel_id'];	# C2147483705
$channel_name=$_REQUEST['channel_name'];	# test
$user_id=$_REQUEST['user_id'];		# U2147483697
$user_name=$_REQUEST['user_name'];	# Steve
$command=$_REQUEST['command'];		# /weather
$text=$_REQUEST['text'];			# text

if ($user_name == "") {
	echo "911: missing user_name\n";
	exit(1);
}

list ($name, $msg) = explode(' ', $text, 2);
$name = str_replace("@", "", $name);

$searchname="^" . $name . "\ ";

$result = `grep $searchname /home/sean/phonelist`;
list ($name, $tel) = explode(' ', $result);
$tel=trim($tel);

$msg="OE WTF via Slack $user_name\n$msg";

if ($tel == "") {
	echo "911 failed: cant find phone for $name \n";
	exit(2);
}

if ($text == "") {
	echo "911: missing text\n";
	exit(3);
}


require('twilio/Services/Twilio.php');

$client = new Services_Twilio('XX', 'YY');
$message = $client->account->sms_messages->create(
  '+17866295647', // From a Twilio number in your account
  $tel, // Text any number
  $msg
);
$sid=$message->sid;

echo "Urgent SMS sent to $name";

// WRITE THE STUFF OUT TO A FILE
$date=trim(`date`);
$fname = "data/911";
$fp = fopen($fname, 'a+') or die("can't open file");
$stuff=("$date $tel $user_name => $text");
fprintf($fp, "$stuff\n");
fclose($fp);

// THIS IS THE MESSAGE ID
// print $message->sid;
?>
