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


if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
        header("Location: login-facebook.php");
    }
}

$hidecaptcha = (USE_CAPTCHA)?'':'hide';



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>userbase - user registration and login</title>
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

                 

                 set_ub_stats();
            });
            var RecaptchaOptions = {
                theme : 'white'
                
             };
             
             
             
    </script>
    
</head>
<body>
    
   Scripted versions of login and user registration.
    <noscript>
        
       
        it appears you have javascript turned off
        <p style='font-size:11px; margin:0px 0px 30px 0px;'>you might want to turn it on for a better experience</p>
          
    </noscript>
    Other features:<br/>
     <a href='forgot.php' class='link_img'><button class='button_sum'>forgot password</button></a>
     <a href='re_activate.php' class='link_img'><button class='button_sum'>re-send activation</button></a>
     <a href='activate.php' class='link_img'><button class='button_sum'>account activation</button></a>
    <a href='contact_us.php' class='link_img'><button class='button_sum'>contact us form</button></a>
     <br/>
     <span style='font-size:12px;'>
   Regular users also get access to "change password" &amp; "change email address" once signed in.
   </span>
    
   <div class='br7'></div>

   <div id='main_container'>
        
        <div id='main_inner'>
       
           
            <div id='user_profile' >
                <div id='buttons' style='margin:10px 10px 0px 10px; text-align:center;' >
                    <a href='?login&oauth_provider=facebook'><img src='images/connect_buttons_03.gif'/></a>
                    <a href='?login&oauth_provider=twitter'><img src='images/connect_buttons_06.gif'/></a>
                    <a href='openid_twitter_facebook.php'><img src='images/openid_08.gif'/></a>
                 </div>
                <div id='user_profile_options' >
                   
                   
                      <div id='regular_sms_login' class='fll pagecontainer' style='margin-bottom:20px;'>
                    
                                

                                
                            <div id="stylized" class="myform">    
                        <form name='login_regular' id='login_regular' action='javascript:void(0);' onsubmit='loginUser()'>
                                <h1>login</h1>
                                <p>
                                    Login with an <a href='openid_twitter_facebook.php'>OpenID provider</a> - including Google, Yahoo, GMail, MySpace and many more. Alternativly you can login with
                                    <a href='?login&oauth_provider=facebook' >facebook</a> or <a href='?login&oauth_provider=twitter'>twitter</a>
                                </p>
                                <label>
                                    username
                                    <span class="small" id='login_alert_username'></span>
                                </label>
                                <input  style='' type='text' id='ub_login_username'/>
                              
                                <div class='clb hruledotted'></div>
                                <label>
                                    password
                                    <span class="small" id='login_alert_p1'></span>
                                </label>
                                <input  style='' type='password' id='ub_login_p1'/>
                                <div class='clb hruledotted'></div>
                                <label>
                                    remember me
                                    <span class="small" id='login_alert_remember'></span>
                                </label>
                                <input  style='' type='checkbox' id='ub_remember'/>
                                <div class='clb '></div>
                                
                                
                                
                             
                                <button class='button_sum fll' type='submit'>login</button>
                                
                                <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='login_loader'/>
                                <div class='clb'></div>
                                <span class='err_txt' id='login_msg'></span>
                               
                                
                                
                        </form>
                        </div>
                        <div class='hruledotted'></div>
                        <div id='sms_token_login'>
                             <div id="stylized" class="myform">   
                                <h1>SMS token login</h1>
                                
                                <p>
                                    To login please enter your username and password. We will then send a SMS message to your phone with a
                                    security token. Type this in and then press 'login'.
                                </p>
                                
                                <label>
                                    username
                                    <span class="small" id='loginsms_alert_username'></span>
                                </label>
                                <input  style='' type='text' id='ub_loginsms_username'/>
                              
                                <div class='clb hruledotted'></div>
                                
                                <label>
                                    password
                                    <span class="small" id='loginsms_alert_p1'></span>
                                </label>
                                <input  style='' type='password' id='ub_loginsms_p1'/>
                              
                                <div class='clb hruledotted'></div>
                                
                                <label>
                                    security token
                                    <span class="small" id='loginsms_alert_smstok'></span>
                                </label>
                                <input  style='' type='password' id='ub_loginsms_smstok'/>
                              
                                <div class='clb '></div>
                                
                             
                                
                                
                            
                                    <button class='button_sum fll' onclick='getSMS_token()'>send sms token</button>&nbsp;&nbsp;
                                    <button class='button_sum fll' onclick='loginUser_x()'>login</button>
                                    
                                    <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='loginsms_loader'/>
                                    <div class='clb'></div>
                                    <span class='err_txt' id='loginsms_msg'></span>
                          
                            </div>
                                
                        </div>   
                  
                   </div>
                
                
                   
                   
                   
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                  
                  
            
                    <div id='register_user' class='fll pagecontainer' >
                        <div id="stylized" class="myform">
                           <form  name='register_regular' id='register_regular' action='javascript:void(0);' onsubmit='registerUser()'>
                                   <h1>Sign Up Today</h1>
                                   <p>Want to get involved and use all our sites/apps cool features? Well sign up today! It's free and amazing!</p>
                                    <label>
                                    username
                                    <span class="small" id='alert_username'></span>
                                    </label>
                                    <input  style='' type='text' id='username_register' onblur="checkUsername(0,'register');"/>
                                  
                    
                                <img src='images/loader/ub_l.gif' class='loading_img fll' id='username_register_load'/>
                                <div class='clb hruledotted'></div>
                                   
                                   
                                <label>
                                    email address
                                    <span class="small" id='alert_email'></span>
                                </label>
                                <input  style='' type='text' id='email_register' onblur="checkEmail(0,'register');"/>
                              
                                <img src='images/loader/ub_l.gif' class='loading_img fll' id='email_register_load'/>
                                <div class='clb hruledotted'></div>
                                
                                <label>
                                    password
                                    <span class="small" id='alert_p1'></span>
                                </label>
                                <input  style='' type='password' id='p1_register' />
                              
                               
                                <div class='clb hruledotted'></div>
                                
                                <label>
                                    confirm password
                                    <span class="small" id='alert_p2'></span>
                                </label>
                                <input  style='' type='password' id='p2_register' onblur="checkPasswords(0,'register');" />
                              
                               
                                <div class='clb hruledotted'></div>
                                
                                
                                  
                                   
                                   <div id='hide_captcha' class='<?php echo $hidecaptcha;?>'>
                                       
                                           <div class='fll'>
                                               <label>are you human?
                                               <span id='alert_capt' class="small"></span>
                                               </label>
                                               
                                           <?php
                                                   if (USE_CAPTCHA){
                                                       echo '<div class="clb" style="margin-top:30px">';
                                                       echo recaptcha_get_html(RECAPKEY_PUBLIC);
                                                       echo '</div>';
                                                   }
                                                   else{
                                                       ?>
                                                       <!--
                                                           for when captcha is not used:
                                                           you need some redundant empty fields
                                                           so full set of data is posted
                                                       -->
                                                       <input type='hidden' name='recaptcha_challenge_field' id='recaptcha_challenge_field'/>
                                                       <input type='hidden' name='recaptcha_response_field' id='recaptcha_response_field'/>
                                                       
                                                       <?php
                                                       
                                                   }
                                                                                      
                                                                                        
                                           ?>
                                           </div>
                                           <img id='alert_capt'  class='hide fll' src='images/alert.png' class=' alert_img '/>
                                       <div class='clb'></div>
                                   </div>
                                           
                                   
                                  
                                       <button class='button_sum fll' type='submit'>register</button>
                                       
                                       <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='reg_loader'/>
                                       <div class='clb'></div>
                                       <span class='err_txt' id='reg_msg'></span>
                                   
                                   
                                   
                           </form>
                      
                        </div>
                        </div>
                   
                   
                      
                      
                      
                       
                       
                       
                       
                      <div class='clb'></div>
               
               
                </div>
 
            </div>
            
            
            
        
        
        
        </div>
    </div>
    
    
    
    
  


  
</body>

</html>