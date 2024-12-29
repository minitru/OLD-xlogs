<?php

// HANDLE NOTIFICATIONS OF ANY CHANGES

require_once 'include/db.php';

if ($argc != 2) {
        print "format: blah asap | daily | weekly | monthly\n";
        exit;
}
$period = $argv[1];

$timenow=time();
// print "TIMENOW IS $timenow\n";
$asap=$timenow - (15 * 60);     // 15 MINUTES AGO - THIS SHOULD BE SET TO THE POLLING INTERVAL
$today=strtotime("-1 day");
$lastweek=strtotime("-1 week");
$lastmonth=strtotime("-1 month");

if ($period == "recent") $limit=$asap;
else if ($period == "daily") $limit = $today;
else if ($period == "weekly") $limit = $lastweek;
else if ($period == "monthly") $limit = $lastmonth;
else {
        print "Unknown period $period; exiting...\n";
        exit;
}

$query = "SELECT fname, key1, email FROM users where notify like '%$period%';"; 

$rc = mysql_query($query);
if (!$rc) {
	die("Error running $query: " . mysql_error());
}

while($row = mysql_fetch_array($rc)) {
	$key=$row['key1'];
	$fname=$row['fname'];
	$email=$row['email'];
    	// echo "==> $key $fname $email\n";
	if ($key) {
		logger("domail calling whatchanged for $key");
		include "whatchanged.php";
		if ($chgs) {
			logger("domail sending changes to $email");
			mailchgs($fname, $email, $chgs, $period);
		}
	}
}

function mailchgs($name,$email,$changes,$period) {

    //recipient - change this to your name and email
    $to = $email;
    $from = "xlogs <sean@xlo.gs>";

    $headers = "From: sean@xlo.gs" . "\r\n" .
    $subject="xlogs: $period changes in your AWS EC2 environment";
    $message = "Hi " .  $name .  ":

Here are the $period changes to your AWS environment:

$changes 

Visit http://xlo.gs for more info.

Thanks,
-- 
Sean MacGuire
sean@xlo.gs";

    //send the mail
    // $result = sendmail($to, $subject, $message, $from);
        $rc=mail($to,$subject,$message,$headers);
}
?>
