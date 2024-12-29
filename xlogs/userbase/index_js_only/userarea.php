<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/

require_once("local_config.php");
require_once(APP_INC_PATH."bootstrap_frontend.php");


//(collect referring data, block site access, test to see if user logged in, usergroups )
sessionsClass::site_protection(true,true,true,false);
$userid = dbase::globalMagic($_SESSION['userid']);




//upload images - this is for script + no script
$upload_error='';
if (isset($_FILES["files"])){

   $upload_error = User::upload_file($_FILES,$ext_allowed);
}






// get user data example
$data = Admin::get_user($userid,false,'profile',true);
if ($data !== false){

    
    if ($data['img_flag']==0){
        //check for gravatr
      
        $img_url = general::get_gravatar($data['email']);
    }
    else{
        //use stored value
    
        $img_url = $data['img_url'];
    }
    $username = dbase::globalMagic($data['username']);
    
    
}
else{
    $output = 'user data not found<br/><br/>';

}









//required for both script+noScript
$openidtest = explode('_',$username);

$openidflag = false;
$no_options = 'hide';
if($_SESSION['logintype']!='userbase'){
    if (count($openidtest)==2 ){
        if (is_numeric($openidtest[1]) && $openidtest[0]=='guest' ){
            $openidflag=true;
            $hideOpenId = '';
            $hideRegularUser = 'hide';
            
         
        }
        else{
     
                $hideOpenId = 'hide';
                $hideRegularUser = 'hide';
                $no_options = '';
            
            
        }
    }
    else{
            
            
                //hide everything
                $hideOpenId = 'hide';
                $hideRegularUser = 'hide';
                $no_options = '';
            
    
    }
}
else{
    $hideOpenId = 'hide';
    $hideRegularUser = '';

}





?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>userbase - user area</title>
    <link rel="stylesheet" href="css/new_style_css.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery.qtip.min.css" />
    <script type="text/javascript" src="js/ubf_js.js"></script>
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>

    <script type="text/javascript" src="js/jquery.qtip.min.js"></script>
    <script>
            $(document).ready(function () {  
        
                 
        
                 set_ub_stats();
                 
            });
          
             
             
             
    </script>
    <style>
       
    </style>
    
</head>
<body>
    
     Scripted versions of the user area.
   
    <noscript>
        
       
        
        it appears you have javascript turned off
        <p style='font-size:11px; margin:0px 0px 30px 0px;'>you might want to turn it on for a better experience</p>
          
    </noscript>
    <div id='main_container'>
        
        <div id='main_inner'>
            
            <div id='user_profile'>
                 <p class='<?php echo  $no_options;?> empty_warning' >
                        If you're seeing this message that means you've signed up via Facebook, Twitter or an OpenID provider
                        and so we do not have anything else for you to do here by default!
                    </p>
                <div id='user_profile_sidebar' class='fll' style='width:480px;'>
                    
                 
                        <div class='fll' id='prf_img' style='width:<?php echo IMG_SIZE;?>px;height:<?php echo IMG_SIZE;?>px; '>
                            <img src='<?php echo $img_url;?>' style='width:<?php echo IMG_SIZE;?>px;height:<?php echo IMG_SIZE;?>px; '/>
                        </div>
                        <div class='fll' id='profile_info'>
                            <span id='username_profile'><?php echo $data['displayname'];?></span>
                            <div></div>
                            <a href='logout.php' class='link'>logout</a>
                        </div>
                        <div class='clb'></div>
                    <br/>
                    <div id='profile_details'>
                         <div class='hruledotted'></div>
                            <span id='data_profile'>
                                
                              
                          <div id="stylized" class="myform" style='width:400px; margin-bottom:20px;'>
                                <form action="userarea.php" method="post" enctype="multipart/form-data">
                                   <h1>Upload Image</h1>
                                    <p>Upload your profile image. Only JPG, PNG and GIF images are allowed.</p>
                                 
                                <label>
                                                   Your Image
                                                    
                                 </label>
                                <input class='' type="file" name="files" id="files"  style='font-size:14px;' />
                                <br />
                                <button class='button_sum ' type='submit'>upload</button>
                           
                                </form>
                                <?php echo $upload_error;?>
                                </div>
                       
                                <div class='hruledotted'></div>
                              
                               <div id='hotlink' class='pagecontainer'>
                                 <div id="stylized" class="myform" style='width:400px'>
                                            <form action="javascript:void(0)" id='hotlink_form' name='hotlink_form' onsumbit='hotlink();'>
                                                <h1>Hotlink Image</h1>
                                <p>Hotlink your profile image. Only JPG, PNG and GIF images are allowed.</p>
                                                <label>
                                                   Image URL
                                                    
                                                </label>
                                                <input  style='' type='text' id="hotlink_url"  />
                                                <div class='clb'></div>
                                                
                                                
                                                <button class='button_sum fll' onclick='hotlink();'>link</button>
                                                <img src='images/loader/ub_l.gif' class='loading_img_button fll' id='hotlink_loader'/>
                                                <div class='clb'></div>
                                           
                                            </form>
                                            
                                            <div id='hotlink_msg'></div>
                                            </div>
                                </div>
                            
                            </span>
                            
                                
                            
                    </div>
                    
            
                    
                
                
                </div>
                <div id='user_profile_options' class='fll'>
                   
                   
                   
                   <div id='change_email' class='pagecontainer <?php echo $hideRegularUser;?>' style='margin-bottom:20px;'>
                           <div id="stylized" class="myform">
                        <form name='change_email_form' id='change_email_form' action='javascript:void(0);' onsubmit='changeEmail()'>
                                <h1>Change Email Address</h1>
                                <p>Changing your email address will require you to re-activate your account.</p>
                                
                                <label>
                                    Current Password
                                    <span class="small" id='change_email_password_alert'></span>
                                </label>
                                <input  style='' type='password' id='ub_ch_p3' />
                                 <div class='clb hruledotted'></div>
                                <label>
                                    Email Address
                                    <span class="small" id='change_email_email_alert'></span>
                                </label>
                                <input  style=''  class='input_boxesrx' type='text' id='email_change' />
                               
                        <div class='clb'></div>
                                
                                
                                
                               
                                    <button class='button_sum fll' type='submit'>save changes</button>
                                    
                                    <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='em_loader'/>
                                    <div class='clb'></div>
                                    <span class='err_txt' id='email_change_msg'></span>
                             
                                
                                
                        </form>
                        </div>
                   </div>
                
                <div class='hruledotted'></div>
                    <div id='change_password' class='pagecontainer <?php echo $hideRegularUser;?>'>
                      <div id="stylized" class="myform">
                        <form name='change_password_form' id='change_password_form' action='javascript:void(0);' onsubmit='changePs()'>
                               
                               
                                  <h1>Change Password</h1>
                                <p>You can use a temporary password as your current password if you've forgot your password.</p>
                                <label>
                                    Current Password
                                    <span class="small" id='alert_p4'></span>
                                </label>
                                <input  style='' type='password' id='p4_change' />
                                 <div class='clb hruledotted'></div>
                              <label>
                                   New Password
                                    <span class="small" id='alert_p1'></span>
                                </label>
                                <input  style='' type='password' id='p1_change' />
                                 <div class='clb hruledotted'></div>
                             
                              <label>
                                    Confirm Password
                                    <span class="small" id='alert_p2'></span>
                                </label>
                                <input  style='' type='password' id='p2_change' />
                                 <div class='clb hruledotted'></div>
                             
                               
                        <div class='clb'></div>
                                
                                
                               
                               
                               
                               
                             
                            <button class='button_sum fll' type='submit'>save changes</button>
                            
                            <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='pc_loader'/>
                            <div class='clb'></div>
                            <span class='err_txt' id='psword_change_msg'></span>
                 
                                
                                
                        </form>
                        </div>
                   </div>
                
                
                
                
                
                
                
                
                    
                    <div id='change_openid_name' class='pagecontainer <?php echo $hideOpenId;?>'>
                        <div id="stylized" class="myform">
                            <form name='openid_namechange_form' id='openid_namechange_form' action='javascript:void(0);' onsubmit='changeUsernameOTF()'>    
                                    <h1>change your username </h1>
                                    <p>you can only do this once</p>
                                <label>
                                        your new username
                                        <span class="small" id='alert_openid'></span>
                                    </label>
                                    <input type='text' id='openid_ub' />
                                    <div class='clb'></div>
                                    
                                    
                                    
                                    
                         
                                        <button class='button_sum fll' type='submit'>save changes</button>
                                        
                                        <img src='images/loader/ub_l.gif' class='loading_img_button fll hide' id='openid_loader'/>
                                        <div class='clb'></div>
                                        <span class='err_txt' id='openid_ch_msg'></span>
                                   
                                    
                                    
                            </form>
                        </div>
                    </div>
                
                
                
                
                
                </div>
                <div class='clb'></div>
            </div>
            
            
            
        </div>
    </div>
    
    
    
    
  


</body>

</html>