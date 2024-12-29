<?php 
include "include/checksession.php";
if(! isset($_SESSION['id'])) {
	# header("location: signin.php");
	include 'signin.php';	/* FOR ERROR MESSAGES */
}
else include "input.php";
?>
