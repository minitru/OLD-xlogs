<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
//this is the configuration file

define('DB_HOST', 'localhost');
define('DB_NAME', 'ubase');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'doodoo99');



// Connect to the mysql database.
$conn = @mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Looks like our server is having a few issues. Try accessing our site in a few moments.");
@mysql_select_db(DB_NAME, $conn) or die("Looks like our server is having a few issues. Try accessing our site in a few moments.");


/*
  
  - basic user data calls -
  
  - see documentation to see how to create custom data calls

*/

$user_request = array (
    
                            'profile'=>array(
                                    
                                    'username'=>'username',
                                    'screenname'=>'displayname',
                                    'userid'=>'userid',
                                    'email'=>'email',
                                    'date_joined'=>'date_joined',
                                    'last_visit'=>'last_login',
                                    'img_url'=>'img_url',
                                    'img_flag'=>'img_flag'
                            ),
                            
                            'basic'=>array(
                                    
                                    'username'=>'User Name',
                                    'screenname'=>'Display Name',
                                    'userid'=>'User ID',
                                    'email'=>'Email Address',
                                    'date_joined'=>'Registration Date',
                                    'last_visit'=>'Last Login',
                                    'img_url'=>'img_url',
                                    'img_flag'=>'img_flag'
                            ),
                            
                            'advanced'=>array(
                                    
                                    'username'=>'User Name',
                                    'screenname'=>'Display Name',
                                    'userid'=>'User ID',
                                    'email'=>'Email Address',
                                    'date_joined'=>'Registration Date',
                                    'last_visit'=>'Last Login',
                                    'ipad'=>'Registration IP Address',
                                    'lastip'=>'Last Login IP Address',
                                    'img_url'=>'Profile Picture',
                                    'img_flag'=>'image_flag'
                            ),
                            
                            'cookie'=>array(
                                    
                                    'username'=>'username',
                                    'screenname'=>'screenname',
                                    'userid'=>'userid',
                                    'cookie_id'=>'cookie_id',
                                    'cookie_salt'=>'cookie_salt',
                                    'cookie_expire'=>'cookie_expire',
                            ),
                            
                            'all'=>array(
                                    
                                    '*'=>''
                            )
                            
                            
                       
                       
                       );



/* - UBase - */

define ('APP_INC_PATH',dirname(__FILE__).'/../includes/');


//facebook API keys
define('APP_ID', '344966068910246');
define('APP_SECRET', 'd8210f341bf381e61e7fb9a3700649e7');

//twitter API keys

define('YOUR_CONSUMER_KEY', 'omLQB57GA0wvMAYe5CXtA');
define('YOUR_CONSUMER_SECRET', 'M0P8ru2XjonTKkksG4CZdfwuTAFrivf6yksmVTwkg');

//make sure to change this
define('TWITTER_RETURN_URL','https://xlo.gs/userbase/index_js_and_noscript/getTwitterData.php');

define ('LOG_FAIL_LOGIN',true);
define ('MAX_LOGIN_FAIL',20);

define ('RECAPKEY','6LeK79ISAAAAAC45c4rqQZj_W9xm32LOI7I6jl1i');
define ('RECAPKEY_PUBLIC','6LeK79ISAAAAAADB1FXATfG6UxqjUhHoWKv2X_8j');

define ('TXTLOCALUSER','txtlocal username');
define ('TXTLOCALPASS','txtlocal password');

define ('CLICKATELLUSER','clickatell username');
define ('CLICKATELLPASS','clickatell password');
define ('CLICKATELLAPIID','clickatell api');

define('TWILLIOSID', 'Twillio SID');
define('TWILLIOTOK', 'Twillio Auth Token');
define('TWILLIOTEL', 'Twillio From Phone number');

define ('SMS_PROVIDER','txtlocal');

//set to 24hour or 1use
define ('SMSTOK','24hour');

define ('TRACK_VISIT',true);
define ('TRACK_PAGEVIEW',true);
define ('TRACK_ADMIN_VISIT',true);

define ('REGISTER_ONLINE',true);
define ('USE_CAPTCHA',true);
define ('ALLOW_DELETE',true);

define ('DEFAULT_IMG_LOCATION','https://xlo.gs/userbase/index_js_and_noscript/images/no_img.gif');
define ('IMG_SIZE',73);
define ('IMG_RATING','g');

$ext_allowed = array ('jpg','jpeg','png','bmp','gif');

define ('MAX_IMG_FILE_SIZE',1024);

define ('UPLOAD_PATH',"./uploaded_images/");

define ('ADMIN_URL',"https://xlog.gs/index_js_and_noscript/admin/");

define ('AUTO_PAGE_WANTED_REDIRECT',true);

define ('ADMIN_ACTIVATED',false);

//amount of time of inactivity in mins
define ('LOGIN_INACTIVE',30);

//number of days to keep a user logged in (30 days default)
define ('REMEMBER_DURATION',30);

define ('HASH_SETTING',"md5");

define ('VERSION_NUMBER',"1.2.03");

define ('SITE_DOMAIN','xlo.gs');

//email settings
define ('EMAIL_HOST',"xlo.gs");
define ('EMAIL_METHOD',"mail");
define ('POP_USERNAME',"yourusername");
define ('POP_PASSWORD',"yourpassword");

/* comments engine */

define ('FLOOD_CONTROL',true);
define ('FLOOD_CONTROL_DURATION',30);
define ('MOD_Q',true);

/* OTHER */

define ('ADMIN_EMAIL','sean@xlo.gs');
define ('REG_EMAIL','sean@xlo.gs');

define ('CONTACT_SUBJECT','You have a message from the contact form');

define ('SITENAME','xlogs');
define ('ACTIURL','https://xlo.gs/index_js_and_noscript/activate.php?');
define ('ACTI_NO_HTML','../../ajax/html/email/activate_email_sans_html.php');
define ('FGPS_NO_HTML','../../ajax/html/email/forgot_password_sans_html.php');
define ('CONGRATS_NO_HTML','../../ajax/html/email/congrats_sans_html.php');

define ('PASS_CHANGE_NO_HTML','../../ajax/html/email/password_sans_html.php');
define ('EMAIL_CHANGE_NO_HTML','../../ajax/html/email/re_activate_email_sans_html.php');

define ('ADMINACT_NO_HTML','../../ajax/html/email/admin_activate_sans_html.php');

//for those without js - called from different location - should really use includes path

define ('NOJS_ACTI_NO_HTML','../ajax/html/email/activate_email_sans_html.php');
define ('NOJS_FGPS_NO_HTML','../ajax/html/email/forgot_password_sans_html.php');
define ('NOJS_CONGRATS_NO_HTML','../ajax/html/email/congrats_sans_html.php');

define ('NOJS_PASS_CHANGE_NO_HTML','../ajax/html/email/password_sans_html.php');
define ('NOJS_EMAIL_CHANGE_NO_HTML','../ajax/html/email/re_activate_email_sans_html.php');

define ('NOJS_ADMINACT_NO_HTML','../ajax/html/email/admin_activate_sans_html.php');

//make sure this is something you can remember in case it gets deleted - else no one will be able to login!

/*
if you plan to change the salt value then:

1. login to the admin panel
2. change the salt value
3. change the administrators password (thus creating a new password with the new salt)

*/

define('UNIQUE_SALT','nablabsunqiquesalt');
?>
