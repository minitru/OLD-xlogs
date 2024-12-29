<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/

require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");

sessionsClass::site_protection(true,true,false,false);

require_once(APP_INC_PATH."/no_script_includes/contact_inc.php");  
    
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>userbase - integrated contact us form</title>
    <link rel="stylesheet" href="css/new_style_css.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/jquery.qtip.min.css" />
         <script type="text/javascript" src="js/ubf_js.js"></script>
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>

    <script type="text/javascript" src="js/jquery.qtip.min.js"></script>
    <script >
            $(document).ready(function () {  
                
                 /*
                  
                  set_ub_stats should be called on every page 
                  
                 
                 */
                //get rid of no-script version of functionality to prevent id clashes (just in case)
                 $('.noscript').html('');
                 

                set_ub_stats();
            });
            
             
             
             
    </script>
    <style>
        #contactus_info{
            width:420px;
            padding:20px;
            margin:10px;
            
        }
        
        #contactus_info h1{
            margin-bottom:20px
        }
        
        #contactus_info p{
            margin-bottom:20px
        }
        
        #contactus_info li{
            margin-bottom:20px
        }
        textarea{
            font-family:Verdana,Arial,Helvetica,sans-serif;
            
            }
    </style>
</head>
<body>
    
    Ajax'd &amp; regular versions of the integrated contact us form.
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
                <div id='user_profile_options' class='fll'>
                   
                   
                     <noscript>
                        <div id='contact_us_nojs' class='noscript'>
                        
                                   <div id="stylized" class="myform">
                                        <form name="re_contact_nojs" action="contact_us.php" method="POST">    
                                              <h1>Contact Us</h1>
                                                    <p>
                                                        Need to get in touch? No worries. Just fill in the contact form below
                                                        and we'll get back to you as soon as we can.
                                                    </p>
                                                
                                                
                                                <label>
                                                    your name
                                                    <span class="small" id='alert_user_name_contact'><?php echo $con_name_msg;?></span>
                                                </label>
                                                <input  style='<?php echo $con_name_alert;?>' type='text' id='user_name_contact_nojs'  name='user_name_contact_nojs' />
                                                <div class='clb hruledotted'></div>
                                                
                                                <label>
                                                    your email address
                                                    <span class="small" id='alert_user_email_contact'><?php echo $con_email_msg;?></span>
                                                </label>
                                                <input  style='<?php echo $con_email_alert;?>' type='text' id='user_email_contact_nojs' name='user_email_contact_nojs' />
                                                <div class='clb hruledotted'></div>
                                              
                                                <label>
                                                    your message
                                                    <span class="small" id='alert_user_msg_contact'><?php echo $conact_msg;?></span>
                                                </label>
                                                <textarea  style='<?php echo $con_msg_alert;?>' type='text'  id='user_msg_contact_nojs' name='user_msg_contact_nojs' ></textarea>
                                               
                                               
                               
                                               
                                                
                                              
                                                    <input type="hidden" value='true' id='nojs_contact' name='nojs_contact' />
                                                    <button class='button_sum' type='submit'>send message</button>
                                                    <br/>
                                                    <span class='err_txt' id='contact_msg'><?php echo $contact_msg;?></span>
                                            
                                
                                    </form>
                                </div>
                        
                        </div>
                     
                    </noscript>
                   
                  
                   
                   
                    <div id='contact_us' class='pagecontainer'>
                         <div id="stylized" class="myform">
                            <form name='contact_us_form' id='contact_us_form' action='javascript:void(0);' onsubmit='contactus()'>    
                                       
                                            
                                    <h1>Contact Us</h1>
                                    <p>
                                        Need to get in touch? No worries. Just fill in the contact form below
                                        and we'll get back to you as soon as we can.
                                    </p>
                               
                                    
                                    <label>
                                        your name
                                        <span class="small" id='alert_user_name_contact'></span>
                                    </label>
                                    <input  style='' type='text' id='user_name_contact' />
                                    <div class='clb hruledotted'></div>
                                    
                                    <label>
                                        your email address
                                        <span class="small" id='alert_user_email_contact'></span>
                                    </label>
                                    <input  style='' type='text' id='user_email_contact' />
                                    <div class='clb hruledotted'></div>
                                  
                                    <label>
                                        your message
                                        <span class="small" id='alert_user_msg_contact'></span>
                                    </label>
                                    <textarea  style='' type='text' id='user_msg_contact' ></textarea>
                                   
                                   

                                    <button class='button_sum fll' type='submit'>contact us</button>
                                    
                                    <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='contact_loader'/>
                                    <div class='clb'></div>
                                    <span class='err_txt' id='contact_msg'></span>
                                 
                                    
                                    
                            </form>
                        
                         </div>
                    </div>
                
                
                
                
                </div>
               
                <div class='fll' id='contactus_info'>
                    <h1>How the contact us form works:</h1>
                    <p>
                        UserBase's integrated contact us form is not like any other. It plugs directly into
                        your user database (from userbase) and extract important information to help you support
                        your users.
                    </p>
                    <ol>
                        <li>
                            If the user is logged in then the system will extract their username, email on record (which could be different from the one used in the contact form)
                            and provide a direct link to their record in the UserBase admin area.
                        </li>
                        <li>
                            If the user is NOT logged in then the system will extract their username, email and provide a link to their record IF it can
                            match the email address to one in the system.
                        </li>
                        <li>
                            If the user is NOT logged in then the system and the email address does not match any in the system then the contact form will
                            forward the message to your chosen contact email address.
                        </li>
                    </ol>
                    <p>
                        All in all the integrated "contact us" form provides a new level of user support and visitor intelligence. 
                    </p>
                    
                    <p>
                        Oh; and it also validates all inputs (like valid email addresses) before allowing the message to be sent. 
                    </p>
                </div>
                <div class='clb'></div>
            </div>
            
            
            
        </div>
    </div>
    
    
    
    
  






    

</body>

</html>