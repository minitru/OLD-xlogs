<?php
error_reporting(0);
require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");
require_once(APP_INC_PATH."openid.php");
sessionsClass::sessionStart();
try {
    # Change 'localhost' to your domain name.
    $openid = new LightOpenID('localhost');
    if(!$openid->mode) {
        if(isset($_POST['openid_identifier'])) {
            $openid->identity = $_POST['openid_identifier'];
            # The following two lines request email, full name, and a nickname
            # from the provider. Remove them if you don't need that data.
            $openid->required = array('contact/email');
            $openid->optional = array('namePerson', 'namePerson/friendly');
            header('Location: ' . $openid->authUrl());
        }
?>

<?php
    } elseif($openid->mode == 'cancel') {
        //echo 'User has canceled authentication!';
	header( 'Location: index.php' ) ;
    } else {
	if ($openid->validate()){
	    
	    global $conn;
	    
	    
	    $openid_url = dbase::globalMagic($openid->identity);
	    $atrr = $openid->getAttributes();
	    $email = $atrr['contact/email'];
	    //need to check against 
	    
	    Admin::add_3rd_party_register('openid',$email,$openid_url);
	    
	    
	    //need to redirect
	    header( 'Location: userarea.php' ) ;
	}
	else{
	    //user did not validate/did not login
	    header( 'Location: index.php' ) ;
	}
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
