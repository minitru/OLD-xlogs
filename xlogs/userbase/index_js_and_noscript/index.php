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



//include to support noScript register

require_once(APP_INC_PATH."/no_script_includes/register_inc.php");

//include to support noScript regular login

require_once(APP_INC_PATH."/no_script_includes/regular_login_inc.php");

//include to support noScript sms login

require_once(APP_INC_PATH."/no_script_includes/sms_login_inc.php");


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
                 $('.noscript').html('');
                 

                 set_ub_stats();
            });
            var RecaptchaOptions = {
                theme : 'white'
                
             };
             
             
             
    </script>
    
</head>
<body>
    
    Ajax'd & regular versions of login and user registration.
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
                    <a class='otf_links' href='?login&oauth_provider=facebook'><img src='images/connect_buttons_03.gif'/></a>
                    <a class='otf_links' href='?login&oauth_provider=twitter'><img src='images/connect_buttons_06.gif'/></a>
                    <a class='otf_links' href='openid_twitter_facebook.php'><img src='images/openid_08.gif'/></a>
                 </div>
                <div id='user_profile_options' >
                   
                   
                   <noscript>
                            <div id='regular_sms_login_nojs' class='fll noscript' >
                                
                                
                
                                <!-- #### NO SCRIPT LOGIN START ### -->
                                
                                <div id="stylized" class="myform" style='margin-bottom:20px;'>    
                                <form name="login" id='login' action="index.php" method="POST">
                                    
                                        <h1>login</h1>
                                        <p>
                                            Login with an <a href='openid_twitter_facebook.php'>OpenID provider</a> - including Google, Yahoo, GMail, MySpace and many more. Alternativly you can login with
                                            <a href='?login&oauth_provider=facebook' >facebook</a> or <a href='?login&oauth_provider=twitter'>twitter</a>
                                        </p>
                                        
                                        <label>
                                            username
                                            <span class="small" id='login_alert_username_nojs'></span>
                                        </label>
                                        <input  style='' type='text' name='ub_login_username_nojs' id='ub_login_username_nojs'/>
                                      
                                        <div class='clb hruledotted'></div>
                                        <label>
                                            password
                                            <span class="small" id='login_alert_p1_nojs'></span>
                                        </label>
                                        <input  style='' type='password' name='ub_login_p1_nojs' id='ub_login_p1_nojs'/>
                                        <div class='clb hruledotted'></div>
                                        <label>
                                            remember me
                                            <span class="small" id='login_alert_rem_nojs'></span>
                                        </label>
                                        <input  style='' type='checkbox' name='ub_remember_nojs' id='ub_remember_nojs' value='yes'/>
                                        <div class='clb '></div>
                                
                                
                                
                             
                                   

                                       
                                            <input type="hidden" value='true' id='nojs_login' name='nojs_login' />
                                            <button class='button_sum' type='submit'>login</button>
                                            <br/>
                                            <span class='err_txt' id='login_msg'><?php echo $login_msg; ?></span>
                                       
                                        
                                        
                                </form>
                                </div>
                                <!-- #### NO SCRIPT LOGIN END ### -->
                                
                                <div class='hruledotted'></div>
                                <!-- #### NO SCRIPT SMS LOGIN START ### -->
                                <div id='sms_token_login'>
                                    
                                    <div id="stylized" class="myform">  
                                    <form name="login_sms" action="index.php" method="POST">
                                        
                                         <h1>SMS token login</h1>
                                
                                        <p>
                                            To login please enter your username and password. We will then send a SMS message to your phone with a
                                            security token. Type this in and then press 'login'.
                                        </p>
                                        
                                        <label>
                                            username
                                            <span class="small" id='loginsms_alert_username'></span>
                                        </label>
                                        <input  style='' type='text' name='ub_loginsms_username_nojs' id='ub_loginsms_username_nojs'/>
                                      
                                        <div class='clb hruledotted'></div>
                                        
                                        <label>
                                            password
                                            <span class="small" id='loginsms_alert_p1'></span>
                                        </label>
                                        <input  style='' type='password' name='ub_loginsms_p1_nojs' id='ub_loginsms_p1_nojs'/>
                                      
                                        <div class='clb hruledotted'></div>
                                        
                                        <label>
                                            security token
                                            <span class="small" id='loginsms_alert_smstok'></span>
                                        </label>
                                        <input  style='' type='password' name='ub_loginsms_smstok_nojs' id='ub_loginsms_smstok_nojs'/>
                                      
                                        <div class='clb '></div>
                                        
                                        
                                       
                                        
                                        
                                 
                                            <input type="hidden" value='true' id='nojs_loginsms' name='nojs_loginsms' />
                                        
                                            <button class='button_sum fll' type='submit' value='true' id='nojs_loginsms'>send sms token</button>&nbsp;&nbsp;
                                            <button class='button_sum fll' type='submit'  value="login" name='login'>login</button>
                                            <div class='clb'></div>
                                  
                                            <span class='err_txt' id='loginsms_msg'><?php echo $login_msg_sms; ?></span>
                                       
                                    </form>
                                    </div>
                                    
                                </div>   
                             <!-- #### NO SCRIPT SMS LOGIN END ### -->
                           </div>
                
                
                    
                   </noscript>
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
                
                
                   
                   
                   
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                  
                  
                <!-- #### NO SCRIPT REGISTER START ### -->
                    <noscript>
                        
                        <div id='register_user_nojs' class='fll noscript' >
                            <div id="stylized" class="myform">
                                <form  name="register" action="index.php" method="POST">
                                        <h1>Sign Up Today</h1>
                                   <p>Want to get involved and use all our sites/apps cool features? Well sign up today! It's free and amazing!</p>
                                   
                                   
                                    <label>
                                        username
                                        <span class="small" id='alert_username'><?php echo $user_msg_reg; ?></span>
                                    </label>
                                    <input  style='<?php echo $user_alert_reg;?>' type='text' id='username_register' id='username_register_nojs' name='username_register_nojs'/>
                                  
                    
                             
                                    <div class='clb hruledotted'></div>
                                       
                                       
                                    <label>
                                        email address
                                        <span class="small" id='alert_email'><?php echo $email_msg_reg; ?></span>
                                    </label>
                                    <input  style='<?php echo $email_alert_reg;?>' type='text' id='email_register_nojs' name='email_register_nojs'/>
                                  
                             
                                    <div class='clb hruledotted'></div>
                                    
                                    <label>
                                        password
                                        <span class="small" id='alert_p1'></span>
                                    </label>
                                    <input  style='' type='password' id='p1_register_nojs' name='p1_register_nojs'  />
                                  
                               
                                <div class='clb hruledotted'></div>
                                
                                <label>
                                    confirm password
                                    <span class="small" id='alert_p2'><?php echo $pass_msg_reg; ?></span>
                                </label>
                                <input  style='<?php echo $pass_alert_reg;?>' type='password' name='p2_register_nojs'  id='p2_register_nojs' />
                              
                               
                                <div class='clb hruledotted'></div>
                                
                               <div id='hide_captcha' class='<?php echo $hidecaptcha;?>'>
                                    <label>
                                    ? <?php echo $_SESSION['ub_rand1_nojs'].' '.$_SESSION['ub_op_nojs_txt'].' '.$_SESSION['ub_rand2_nojs']; ?>
                                        <span class="small" id=''><?php echo $captcha_msg_reg; ?></span>
                                    </label>
                                    <input  style='<?php echo $captcha_alert_reg;?>' type='text' id='captcha_register_nojs'  name='captcha_register_nojs' />
                                    </div>
                               
                                <div class='clb '></div>
                                   
                                   
                                        
                                      
                                                
                                        
                                       
                                            <input type="hidden" value='true' id='nojs_register' name='nojs_register' />
                                            <button class='button_sum ' type='submit'>register</button>
                                           <br/>
                                            <span class='err_txt' id='reg_msg'><?php echo $reg_msg; ?></span>
                                      
                                        
                                        
                                </form>
                            </div>
                        </div>

                    </noscript>
                    
                    
                   
                <!-- #### NO SCRIPT REGISTER END ### -->
                   
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