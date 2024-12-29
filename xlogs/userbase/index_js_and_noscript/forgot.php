<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");

sessionsClass::site_protection(true,true,false,false);

//include to support noScript forgot password

require_once(APP_INC_PATH."/no_script_includes/forgot_inc.php");  

    
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
                //get rid of no-script version of functionality to prevent id clashes (just in case)
                 $('.noscript').html('');
                 

                 

                 set_ub_stats();
            });
            
             
             
             
    </script>
    
</head>
<body>
    
   Ajax'd & regular versions of the forgot password area.
    <p style='font-size:11px; margin:0px 0px 30px 0px;'>the regular version gets enabled if you disable javascript</p>
    <noscript>
        
        <!--##
    
        Please note putting the style tag inside the body area may not validate - so if you want
        something 100% valid you may have to work out a different technique to do this (ie hide the other
        ajax'd forms)
    
        ##-->
        
        <style type="text/css">
            .pagecontainer {display:none;}
        </style>
        
        it appears you have javascript turned off
        <p style='font-size:11px; margin:0px 0px 30px 0px;'>you might want to turn it on for a better experience</p>
          
    </noscript>
    
   <div id='main_container'>
        
        <div id='main_inner'>
      
            <div id='user_profile'>
                <div id='user_profile_options' >
                   
                   
                    <noscript>
                        <div id='forgot_ps_nojs' class='noscript'>
                            <div id="stylized" class="myform">
                                <form name='forgot_nojs'action="forgot.php" method="POST">    
                                    <h1>forgot your password?</h1>
                                    <p >
                                        Don't worry, just smash in your email address or username in the box below and we'll send
                                        you an email with a new password.
                                    </p>
                                       
                                       
                                        
                                        <label>
                                            username or email
                                            <span class="small" id='alert_user_email'></span>
                                        </label>
                                        <input  style='<?php echo $forgot_alert;?>' type='text' id='user_email_forgot_nojs' name='user_email_forgot_nojs' />
                                      
                                        <div class='clb'></div>
                                        
                                       
                                            <input type="hidden" value='true' id='nojs_forgot' name='nojs_forgot' />
                                            <button class='button_sum ' type='submit'>remind me</button>
                                            <br/>
                                            <span class='err_txt' id='forgot_msg'><?php echo $forgot_msg;?></span>
                                      
                                                
                                                
                                </form>
                            </div>             

                        </div>
                    </noscript>
                   
                   
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