<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");
require_once(APP_INC_PATH."recaptchalib.php");
sessionsClass::site_protection(true,true,false,false);

//demo


    
    
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title>userbase - thanks for registering</title>
    <link rel="stylesheet" href="css/new_style_css.css" type="text/css">
      
    <style>
            .warningbox{
                border:solid 1px #ebebeb;
                background-color:#f8f8f8;
                padding:20px;
                text-align:left;
                font-size:12px;
    border-radius:5px;
    width:960px;
    display:inline-block;
    
            }
    #outerwarning{
    text-align:center;
    }
        </style>
</head>
<body>
    <div id='outerwarning'>
        <p class='warningbox'>
            Your account has been created. There will be an activation email heading to your inbox
            as we speak. Follow the in-email instructions to activate your account! 
        </p>
    </div>
  
</body>

</html>