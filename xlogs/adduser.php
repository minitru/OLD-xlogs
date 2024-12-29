<?php

require_once 'include/auth.php';

if (! isset($_POST["authcode"])) {
	logger("$email NO AUTH CODE ERROR");
	exit;
}

$authcode = $_POST["authcode"];
$email = $_POST['email'];
$invite = "";		// EMPTY - CAN BE LOADED IN CHECKAUTH

if (checkauth($email, $authcode) == TRUE) {	/* VALID AUTHCODE */

	if ($invite) {
		logger("INVITE SET TO $invite");
		$query = "SELECT * FROM users WHERE id = \"$invite\"";
        	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		if (mysql_num_rows($result) != 0) {
			logger("SETTING KEYS FOR $email FROM $invite");
			$row = mysql_fetch_assoc($result);
			$key=$row['key1'];
			$sec=$row['sec1'];
		}
		else {
			logger("NO RECORD FOUND FOR $invite");
			$invite="";
		}
	}
	$passwd = create_hash($passwd);
	/* print "it's a new user"; */
	$query = "SELECT * FROM users WHERE email = \"$email\"";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	if (mysql_num_rows($result) != 0) {
		if ($action == "lostpw") {
			$row = mysql_fetch_assoc($result);
			$id=$row['id'];
			$query = "UPDATE users SET password=\"$passwd\" WHERE id = \"$id\"";
			logger("$email RESET PASSWORD FOR $id");
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			echo "JUMP: view.php";
			exit;
		}
		else {
			/* USER ALREADY EXISTS */
			logger("$email USER ADD FAILED");
			# file_put_contents("logfile", "$email USER ADD FAIL\n", FILE_APPEND);
			print "ERROR: Email already exists, try again";
			exit;
		}
	}
	/* print "add new user $login, $pw, $email"; */
	$email = $_POST['email'];
	if ($action != "lostpw") {
		$query = "INSERT INTO users (email, fname, lname, password, key1, sec1, lang) 
		VALUES ('$email', '$fname', '$lname', '$passwd', '$key', '$sec','$lang')";
		logger("$email - ADDING USER $query");
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	/* NOW READ IT BACK IN TO GET THE ID WHICH WILL HAVE BEEN CREATED */
	$query = "SELECT * FROM users WHERE email = \"$email\"";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row = mysql_fetch_assoc($result);
	if ($action == "lostpw") {
		// HMMM... BREAKS EVERYTHING! $id=row['id'];
		logger("$email - CHANGING PASSWORD FOR $id");
		$query = "UPDATE users SET password=\"$passwd\" WHERE id = \"$id\"";
	}
	else {
		checklogin();
		/* SEND THE WELCOME MESSAGE */
        	$mailfile='include/email.' . $lang;
        	# include $mailfile;
        	$to = $email;

    		//subject and the html message
    		//$subject = 'Complete your xlogs registration';
    		$headers = "From: xlogs <sean@xlo.gs>" . "\r\n" .
    		$headers .= "Reply-To: sean@xlo.gs\r\n";
    		$subject = "$fname - Welcome to xlogs!";
    		$url="http://xlo.gs/view.php";

		if ($invite) {
    			$message = "Welcome " .  $fname .  "! 

Thanks for accepting the invitation to xlogs.

You can login anytime by visiting $url.

If you have any questions or suggestions, please let me know!

Thanks,
-- 
Sean MacGuire
sean@xlo.gs";
		}
		else {
    			$message = "Welcome " .  $fname .  "! 

Thanks for registering for xlogs.

The next step is to enter an access key and secret so we can
watch your instances for you.  We strongly suggest using read
only keys!  

Just enter the key and secret in the fields at the bottom of
the viewing page.  Note, for security you can only update keys,
not view them.

You can login anytime by visiting $url.

If you have any questions or suggestions, please let me know!

Thanks,
-- 
Sean MacGuire
sean@xlo.gs";
		}
       		$rc = mail($to,$subject,$message,$headers);

		logger("$email USER ADD OK - EMAIL rc = $rc");
	}
}
	echo "JUMP: view.php"
?>
