<?php
/* 
 * Connecting, selecting database
 * GONNA NEED TO SELECT A USERNAME FOR DB STUFF ONLY
 */

$link = mysql_connect('localhost', 'xlogs', 'doodoo69')
    or die('Could not connect: ' . mysql_error());
/*
echo 'Connected successfully';
*/
mysql_select_db('xlogs') or die('Could not select database');

function logger($msg)
{
	if (isset($_SERVER['REMOTE_ADDR'])) {
        	$ip=$_SERVER['REMOTE_ADDR'];
	}
	$ip="localhost";

	$line = date('Y-m-d H:i:s') . " - $ip $msg";
	file_put_contents("/var/www/xlogs/logfile", "$line\n", FILE_APPEND);
	flush();
}

function logout()
{
session_start();
// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
}

// SEE IF WE'RE LOGGED IN - NO PENALTY IF WE'RE NOT
// SET THESE EXPLICITLY SINCE THEY MAY NOT BE DEFINED
// AND THE FUNCTION LIMITS THE SCOPE 
function checklogin()
{
	global $id, $fname, $lname;

        session_start();
        # print "IN CHECKSESSION<BR>";

        if(isset($_SESSION['fname'])) {         /* WE HAVE A SESSION ID */
                # print "SESSION ID IS SET<BR>";
                $id = $_SESSION['id'];
                $email = $_SESSION['email'];
                $lang = $_SESSION['lang'];
                $fname = $_SESSION['fname'];
                $lname = $_SESSION['lname'];
                $key1 = $_SESSION['key1'];
                $sec1 = $_SESSION['sec1'];
		logger("CHECKLOGIN $fname $id ARE SET");
                //print "FNAME IS [" . $fname . "]";
		return($id);
        }
	return(FALSE);
}

function dologin($dbrow)
{
 	$id = $dbrow['id'];
	$lang = $dbrow['lang'];
	$email = $dbrow['email'];
	$fname = $dbrow['fname'];
	$lname = $dbrow['lname'];
	$key1 = $dbrow['key1'];
	$sec1 = $dbrow['sec1'];

       	logger("$email LOGIN OK $id");

       	/* print "login OK"; */
       	$loginerror = "";
       	/* USER AND PASSWORD OK */
       	session_start();

       	$_SESSION['id']=$id;
       	$_SESSION['email']=$email;
       	$_SESSION['lang']=$lang;
	$_SESSION['fname']=$fname;
	$_SESSION['lname']=$lname;
	$_SESSION['key1']=$key1;
	$_SESSION['sec1']=$sec1;
	echo "JUMP: view.php";
}
