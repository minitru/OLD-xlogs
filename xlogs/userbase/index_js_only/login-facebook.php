<?php

require_once ('../includes/oAuth/facebook/facebook.php');
require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");

$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));

$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }






    if (!empty($user_profile )) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
	
        $username = $user_profile['name'];
	$uid = $user_profile['id'];
	$email = $user_profile['email'];
	$img = "http://graph.facebook.com/$uid/picture?type=large";
      
        
	  
            Admin::add_3rd_party_register('facebook',$email,$uid,$username,$img);
           
            header("Location: userarea.php");
        
    } else {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error.");
    }
} else {
    # There's no active session, let's generate one
	$login_url = $facebook->getLoginUrl(array( 'scope' => 'email'));
    header("Location: " . $login_url);
}
?>
