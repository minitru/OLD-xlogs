<?php

include 'include/db.php';
 
// ALL OF OUR STARTUP FORMS SHOULD REALLY GO TO THE SMAE
// PLACE... BUT IM LAZY AND CONFUSED

//Retrieve form data.
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$id = ($_GET['id']) ? $_GET['id'] : $_POST['id'];
$key1 = ($_GET['key1']) ? $_GET['key1'] : $_POST['key1'];
$sec1 = ($_GET['sec1']) ?$_GET['sec1'] : $_POST['sec1'];
$notify = ($_GET['notify']) ?$_GET['notify'] : $_POST['notify'];

// print "ID: $id  KEY1: $key1 SEC1: $sec1";

include 'ec2test.php';
 
if ($id) {
 		$query = "SELECT * FROM users WHERE id = \"$id\"";
        	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

        	if (mysql_num_rows($result) != 0) {
			if ($notify) {
				logger("savekeys $id $notify");
				$query = "UPDATE users SET notify=\"$notify\" WHERE id = \"$id\"";
			}
			else {
				logger("savekeys $id $key1");
				$query = "UPDATE users SET key1=\"$key1\", sec1=\"$sec1\" WHERE id = \"$id\"";
			}
        		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
        		if ($result == TRUE) {
				if ($key1) {
					session_start();
                        		$_SESSION['key1']=$key1;
                        		$_SESSION['sec1']=$sec1;
                        		echo "JUMP: view.php";	// JUMP WHEN UPDATING KEYS
				}
				else echo "MSG:  Notifications updated";
			}
			else echo "ERROR: Database update error";
        	}
		else {
			echo "ERROR: Database user [$id] does not exist";
			
		}
	}
     
?>
