<?php
include 'include/db.php';
require_once 'include/auth.php';

//Retrieve form data.
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
logout();

$action = ($_GET['action']) ?$_GET['action'] : $_POST['action'];
$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
$auth = ($_GET['auth']) ?$_GET['auth'] : $_POST['auth'];

if (checkauth($email, $auth) == TRUE) {
	include "signup2.html";
}
else {	// ERROR
	include "signup.html";
}
?>
