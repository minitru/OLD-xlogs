<?php

include 'pass.php';
include 'include/db.php';
 
// ALL OF OUR STARTUP FORMS SHOULD REALLY GO TO THE SMAE
// PLACE... BUT IM LAZY AND CONFUSED

//Retrieve form data.
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$action = ($_GET['action']) ?$_GET['action'] : $_POST['action'];
$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
$fname = ($_GET['fname']) ? $_GET['fname'] : $_POST['fname'];
$lname = ($_GET['lname']) ? $_GET['lname'] : $_POST['lname'];
$passwd = ($_GET['passwd']) ? $_GET['passwd'] : $_POST['passwd'];
$authcode = ($_GET['authcode']) ?$_GET['authcode'] : $_POST['authcode'];
 
if (!$authcode) {
	if ($passwd) {	// LOGIN REQUEST
        	$query = "SELECT * FROM users WHERE email = \"$email\"";
        	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
        	$row = mysql_fetch_assoc($result);
        	$hash = $row['password'];		# THE HASHED PASSWD
        	# print "It's a login [$id]"; 
	
        	if ((mysql_num_rows($result) != 0) && (validate_password($passwd, $hash))) {
			dologin($row);
        	}
		else {
			logger("$email LOGIN FAILED");
			# file_put_contents("logfile", "$date $email INVALID LOGIN\n", FILE_APPEND);
			echo "ERROR: invalid login - try again...";
		}
	}
} /* END NO AUTHCODE */

if (!$fname && !$passwd) {
	$query = "SELECT * FROM users WHERE email = \"$email\"";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

        if (mysql_num_rows($result) != 0) {
		if ($action != "lostpw") {
       			/* USER ALREADY EXISTS */
			logger("$email USER ALREADY EXISTS");
			# file_put_contents("logfile", "$date $email ALREADY EXISTS\n", FILE_APPEND);
			echo "ERROR: $email already exists (<a href=\"signup.php?action=lostpw\">Click here to reset password</A>)";
			exit;
		}
        }

    # file_put_contents("logfile", "$date $email SEND AUTHCODE\n", FILE_APPEND);

     $authcode = rand(100000,999999);
    `echo "$email" > /home/sean/xlogs/$authcode`;

    logger("$email SEND AUTHCODE");
    //recipient - change this to your name and email
    $to = $email;
    $from = "xlogs <sean@xlo.gs>";


    # WRITE THE EMAIL INTO A FILE NAMES WITH THE AUTHCODE
    # GET THIS OUT OF THE ROOT DIR
     
    //subject and the html message
    if ($action == "lostpw") {
    	$headers = "From: sean@xlo.gs" . "\r\n" .
    	$subject="xlogs: Password reset request";
    	$url="http://xlo.gs/signup.php?email=" . $email . "&auth=" . $authcode . "&action=lostpw";
    	$message = "Hi " .  $email .  "! 

We've received a password reset request for your account.

Just click on the link to reset your password.
$url 

Thanks,
-- 
Sean MacGuire
sean@xlo.gs";

    // $result = sendmail($to, $subject, $message, $from);
	$rc=mail($to,$subject,$message,$headers);

        `echo "$email $id" > /home/sean/xlogs/$authcode`;

    if ($rc) echo '<h2 style="color:grey; font-weight:200;"><BR><BR><CENTER>We have sent you an email with a link to reset your password<BR><BR>Please check your inbox</H2><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>';
    else echo 'Sorry, unexpected error. Please try again later';
    logger("$email SENT RESET EMAIL");
    }
    else if ($action == "invite"){
	if (checklogin() == FALSE) {
		logger("CAN'T SEND INVITE - NOT LOGGED IN");
		exit;
	}
        $authcode = rand(100000,999999);
        `echo "$email $id" > /home/sean/xlogs/$authcode`;
	logger("ID $id FNAME $fname LNAME $lname AFTER CHECKLOGIN");
    	$headers = "From: sean@xlo.gs" . "\r\n" .
    	$subject="xlogs: Invitation from $fname $lname";
    	$url="http://xlo.gs/signup.php?email=" . $email . "&auth=" . $authcode;
    	$message = "Hi " .  $email .  "! 

$fname $lname is inviting you to view their Amazon cloud information
using xlogs.

Just click on the link to sign in:
$url 

Thanks,
-- 
Sean MacGuire
sean@xlo.gs";

    // $result = sendmail($to, $subject, $message, $from);
	$rc=mail($to,$subject,$message,$headers);

    logger("$email SENT INVITATION FROM $id TO $to RC $rc");
	echo "MSG: Invitation sent to $to";
    }
    else {
    	$headers = "From: sean@xlo.gs" . "\r\n" .
    	$subject="xlogs: Please confirm your email address";
    	$url="http://xlo.gs/signup.php?email=" . $email . "&auth=" . $authcode;
    	$message = "Welcome " .  $email .  "! 

xlogs lets you see whats happening with your Amazon instances at a glance for free.

Just click on the link to complete your registration: 
$url 

If you have any questions or suggestions, please let me know!

Thanks,
-- 
Sean MacGuire
sean@xlo.gs";
 
    //send the mail
    // $result = sendmail($to, $subject, $message, $from);
	$rc=mail($to,$subject,$message,$headers);

    $authcode = rand(100000,999999);
        `echo "$email $id" > /home/sean/xlogs/$authcode`;

    if ($rc) echo '<h2 style="color:grey; font-weight:200;"><BR><BR><CENTER>We have sent you a confirmation email<BR><BR>Please check your inbox</H2><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>';
    else echo 'Sorry, unexpected error. Please try again later';
    logger("$email SENT CONFIRMATION EMAIL");
    }
}
else {
	//print "FNAME: $fname";
    	logger("$email CALLING ADDUSER");
	include "adduser.php";
	exit;
}
 
 
//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= 'From: ' . $from . "\r\n";
     
    $rc = mail($to,$subject,$message,$headers);
     
    if ($rc) return 1;
    else return 0;
}
?>
