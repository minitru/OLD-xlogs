<?php

// test.php
// TEST TO SEE IF WE CAN IMPLEMENT PASSWORD CHECKING PER PAGE
// I SUSPECT WE COULD USE THIS FOR GENERIC EVERYTHING CHECKING

session_start();

// THE SESSION TYPE IS EITHER visitor | guest | admin
if (!isset($_SESSION['type'])) {
	$id=$_REQUEST['id'];		// PAGE ID
	$accesscode=$_REQUEST['accesscode'];		// PAGE ID

	$email=$_REQUEST['email'];	// USERNAME + PASSWD
	$pass=$_REQUEST['pass'];
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

// CHECK USERNAME AND PASSWORD
if ($email) {
	if (strcmp($pass, "bobo") == 0) {
		$_SESSION['type'] = $_POST['admin'];
	}
	else {
		if ($pass) $errmsg = "Invalid username/password - no soup for you";
		$pass="";
		include "login.php";
	}
}
else if ($id) {
	# THROW THE LOGIN PAGE

	// IF THERE's AN ACCESS CODE FOR THIS USER ID, ASK FOR IT
	if (strcmp($accesscode, "boborules") == 0) {
		$_SESSION['type'] = $_POST['guest'];
		// LOGIN
	}
	else {
		if ($accesscode) $errmsg = "Invalid access code - no soup for you";
		$accesscode="";
		include "login.php";
	}
}
else {
	header("Location: https://xlo.gs/");
}

?>
