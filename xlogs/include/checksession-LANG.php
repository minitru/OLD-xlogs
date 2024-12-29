<?php 

$id=1;

# CHECK SESSION STUFF
# IF WE DON'T HAVE A SESSION, THEN THE USER NEEDS TO LOGIN.

	header ("Pragma: no-cache"); 
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	# session_start();
	# print "IN CHECKSESSION<BR>";

	if(isset($_SESSION['id'])) {		/* WE HAVE A SESSION ID */
		# print "SESSION ID IS SET<BR>";
    		$id = $_SESSION['id'];
		$email = $_SESSION['email'];
		$lang = $_SESSION['lang'];
		# print "LANG IS [" . $lang . "]";

		if(! isset($pr_welcome)) {	/* MAKE SURE PROMPTS THERE */
			# print "LEN " . strlen($lang);
			if (strlen($lang) == 0) $_SESSION['lang'] = $lang = "en";
			$_SESSION['prompts'] = $lang;
			$fname = "/var/www/hownow/include/prompts." . $_SESSION['lang'];
			include $fname;
		}
		
		if ($_SESSION['prompts'] != $lang) {
			# print "CHANGE LANGUAGE TO " . $lang;
			$_SESSION['prompts'] = $lang;
			$fname = "/var/www/hownow/include/prompts." . $_SESSION['lang'];
			include $fname;
		}
	}
	else {					/* BEFORE LOGIN! */
		if ($_POST['lang'] || $_GET['lang'] ) {	
			$changelang = $_POST['lang'];
			# print "CHANGE LANGUAGE TO " . $changelang;
			$fname = "prompts." . $changelang;
			$_SESSION['lang'] = $changelang;
			$_SESSION['prompts'] = $changelang;
		} 
	
		if (!$pr_welcome) {		/* NO PROMPTS */	
			if ($_SESSION['lang']) $lang=$_SESSION['lang'];
			else $lang = 'en';
			$_SESSION['prompts'] = $lang;
			$_SESSION['lang'] = $lang;
			$fname = "/var/www/hownow/include/prompts." . $_SESSION['lang'];
			include $fname;
		}
	}
?>
