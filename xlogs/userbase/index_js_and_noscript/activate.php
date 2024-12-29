<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");


sessionsClass::site_protection(true,true,false,false);

//include to support noScript activate

require_once(APP_INC_PATH."/no_script_includes/activate_inc.php");  
    
    
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
         
             
             
             
    </script>
    
</head>
<body>
    
    Ajax'd & regular versions of the activation area.
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
                        <div id='activate_nojs' class='noscript'>
                        
                            <div id="stylized" class="myform">
                                    <form name="activate_nojs" action="activate.php" method="POST">    
                                            <h3>Activate your account</h3>
                                            <p style='font-size:12px; margin:10px 0px 5px 0px;'>
                                                <?php echo $dataArray['QuickMsg']; ?>
                                                
                                                <?php echo $dataArray['Msg']; ?>
                                            </p>
                                            <br/>
                                            <div class='<?php echo $dataArray['hideshow']; ?>'>
                                            
                                                <label>
                                                    activation code [a]
                                                    <span class="small" id='alert_parta'></span>
                                                </label>
                                                <input  style='<?php echo $parts_alerts; ?>'  type='text'  id='parta_activate_nojs' name='parta_activate_nojs' />
                                                    <div class='clb hruledotted'></div>
                                                <label>
                                                    activation code [b]
                                                    <span class="small" id='alert_partb'></span>
                                                </label>
                                                <input  style='<?php echo $parts_alerts; ?>'  type='text' id='partb_activate_nojs' name='partb_activate_nojs' />
                                                
                                                    
                                                   
                                                        
                                                <input type="hidden" value='true' id='nojs_activate' name='nojs_activate' />
                                                <button class='button_sum ' type='submit'>activate account</button>
                                                <br/>  
                                                <span class='err_txt' id='activate_msg'><?php echo $activate_msg ;?></span>
                                            
                                            </div>
                                            
                                    </form>
                        </div>
                        
                        </div>
                    </noscript>
                   
                    <div id='activate' class='pagecontainer'>
                       <div id="stylized" class="myform">
                        <form name='activate' id='activate' action='javascript:void(0);' onsubmit='activateAcc()'>    
                                <h1>Activate your account</h1>
                                <p>
                                    <?php echo $dataArray['QuickMsg']; ?>
                                    
                                    <?php echo $dataArray['Msg']; ?>
                                </p>
                            
                                <div class='<?php echo $dataArray['hideshow']; ?>'>
                
                                        
                                         <label>
                                            activation code [a]
                                            <span class="small" id='alert_parta'></span>
                                        </label>
                                        <input  style='' type='text' id='parta_activate' />
                                            <div class='clb hruledotted'></div>
                                        <label>
                                            activation code [b]
                                            <span class="small" id='alert_partb'></span>
                                        </label>
                                        <input  style='' type='text' id='partb_activate' />
                                        <div class='clb'></div>
                                      
                                        
                                  
                                            <button class='button_sum fll' type='submit'>activate account</button>
                                            
                                            <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='activate_loader'/>
                                            <div class='clb'></div>
                                            <span class='err_txt' id='activate_msg'></span>
                                       
                                </div>
                                
                        </form>
                    
                       </div>
                    </div>
                
                
                
                
                </div>
               
            </div>
            
            
            
        </div>
    </div>
    
    
    
    
  




</body>

</html>