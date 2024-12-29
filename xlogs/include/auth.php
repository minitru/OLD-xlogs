<?php

function checkauth($email, $auth) {
	global $invite;				// MAKE THIS ACCESSIBLE
	$authcode="/home/sean/xlogs/" . $auth;
	if (is_file($authcode)) {
		$code=`cat $authcode`;
		list($authemail, $invite) = split(" ", $code, 2);
		if ($authemail) $authemail=chop($authemail);
		if ($invite) {
			$invite=chop($invite);
			logger("INVITE SET TO $invite");
		}
		if (strcmp($email, $authemail) == 0) {	/* ADD NEW USER */
			logger("$email AUTHCODE OK");
			return(TRUE);
		}
		else {
			logger("$email AUTHCODE ERROR");
			print "ERROR: $email DOESN'T MATCH $authemail";
		}
	}
	return(FALSE);
}
?>
