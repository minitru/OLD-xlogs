<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");

sessionsClass::site_protection(true,true,false,false);



    
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>userbase - forgot my password</title>
    <link rel="stylesheet" href="css/new_style_css.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/jquery.qtip.min.css" />
         <script type="text/javascript" src="js/ubf_js.js"></script>
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>

    <script type="text/javascript" src="js/jquery.qtip.min.js"></script>
    <script>
            $(document).ready(function () {  
                
                 /*
                  
                  set_ub_stats should be called on every page 
                  
                 
                 */
           
                 

                 

                 set_ub_stats();
            });
            
             
             
             
    </script>
    
</head>
<body>
    
   Scripted versions of the forgot password area.
    <noscript>
        
       
        it appears you have javascript turned off
        <p style='font-size:11px; margin:0px 0px 30px 0px;'>you might want to turn it on for a better experience</p>
          
    </noscript>
    
   <div id='main_container'>
        
        <div id='main_inner'>
      
            <div id='user_profile'>
                <div id='user_profile_options' >
                   
                   
                     <div id='forgot_ps' class='pagecontainer'>
                        <div id="stylized" class="myform">
                        <form name='forgot_form' id='forgot_form' action='javascript:void(0);' onsubmit='forgotPs()'>    
                                <h1>forgot your password?</h1>
                                    <p >
                                        Don't worry, just smash in your email address or username in the box below and we'll send
                            you an email with a new password.
                                    </p>
                                    
                                <label>
                                    username or email
                                    <span class="small" id='alert_user_email'></span>
                                </label>
                                <input  style='' type='text' id='user_email_forgot' />
                              
                                <div class='clb'></div>
                                
                                
                           
                                    <button class='button_sum fll' type='submit'>remind me</button>
                                    
                                    <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='forgot_loader'/>
                                    <div class='clb'></div>
                                    <span class='err_txt' id='forgot_msg'></span>
                         
                                
                                
                        </form>
                    
                    
                    
                        </div>
                    </div>
                    
                
                
                
                
                </div>
               
            </div>
            
            
            
        </div>
    </div>
    
    
    
    
  




   

</body>

</html>