<?php

require_once ('../includes/oAuth/twitter/twitteroauth.php');
require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");
require_once(APP_INC_PATH."openid.php");
session_start();

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
   /* echo '<pre>';
    print_r($user_info);
    echo '</pre><br/>';*/
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {
	   
       
   
	    //insert user here
	    $img = "https://api.twitter.com/1/users/profile_image?screen_name=".$user_info->screen_name."&size=bigger";
	   //$user_info->profile_image_url_https //direct access to img location
	    Admin::add_3rd_party_register('twitter',$user_info->email,$user_info->id,$user_info->screen_name,$img);

            

           header("Location: userarea.php");
      

    }
} else {
    // Something's missing, go back to square 1
    header('Location: login-twitter.php');
}
?>
