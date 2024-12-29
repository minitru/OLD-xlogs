<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");
require_once(APP_INC_PATH."recaptchalib.php");
sessionsClass::sessionStart();
//need on all external facing pages that a user may enter the site on (saveReferalData) after session started (sessionStart)
sessionsClass::saveReferalData();

    
    
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title>userbase - Wooops!</title>
    <link rel="stylesheet" href="css/f_s.css" type="text/css">
      
    
</head>
<body>
    
    Looks like something unexplainable happened.
    <div style='font-size:11px; margin:0px 0px 30px 0px;'>we're not sure what happened, try refreshing the page or try again later.</div>
   
  
    
  
</body>

</html>