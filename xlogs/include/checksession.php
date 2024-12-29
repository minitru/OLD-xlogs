<?php 

# CHECK SESSION STUFF
# IF WE DON'T HAVE A SESSION, THEN THE USER NEEDS TO LOGIN.

	header ("Pragma: no-cache"); 
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	session_start();
	# print "IN CHECKSESSION<BR>";

	$id=1;

	if(isset($_SESSION['fname'])) {		/* WE HAVE A SESSION ID */
		# print "SESSION ID IS SET<BR>";
    		$id = $_SESSION['id'];
		$email = $_SESSION['email'];
		$lang = $_SESSION['lang'];
		$fname = $_SESSION['fname'];
		$key1 = $_SESSION['key1'];
		$sec1 = $_SESSION['sec1'];
		//print "FNAME IS [" . $fname . "]";
	}
	else {
		$id=$_SESSION['id'];
		// print "SESSION NOT SET";
		logger("LOGGING OUT $id");
		session_destroy();	// SMM TOAST ALL VARIABLES
		header("Location: https://xlo.gs/signin.html");
		exit;
	}
?>
