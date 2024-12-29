<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
error_reporting(0);
require_once("../local_config.php");

require_once(APP_INC_PATH."bootstrap.php");
require_once(APP_INC_PATH."recaptchalib.php");

sessionsClass::sessionStart();

    if (REGISTER_ONLINE){

        $postList = array("username","p1","p2","email","contact","recaptcha_challenge_field","recaptcha_response_field");
        //var_dump($_POST);
        if (general::globalIsSet($_POST,$postList)){

            

            
            //clean up data before it goes in
            $username   = dbase::globalMagic($_POST['username']);
            $password   = dbase::globalMagic($_POST['p1']);
            $password2  = dbase::globalMagic($_POST['p2']);
            $email      = dbase::globalMagic($_POST['email']);
            $ipad       = dbase::globalMagic($_SERVER['REMOTE_ADDR']);
            
            $browser    = general::getBrowser();
            $os         = general::getOS();
            
            $lang       = general::getLang();
            $country    = general::getCountry();
            
            $screenres  = general::getScreenRes();
            $openid = '';
            //$referal  = general::getReferInfo();
            
            $contact    = dbase::globalMagic($_POST['contact']);
            
            $recaptcha_challenge_field      =   dbase::globalMagic($_POST['recaptcha_challenge_field']);
            $recaptcha_response_field       =   dbase::globalMagic($_POST['recaptcha_response_field']);
            
            if (isset($_SESSION['refurl'])){
                //which it should be
                $search_engine_term         =   general::get_search_term_engine(dbase::globalMagic($_SESSION['refurl']));
                
                $searchengine               =   $search_engine_term['searchengine'];
                $searchterm                 =   $search_engine_term['searchterm'];
                
            }
            else{
                $searchengine='none';
                $searchterm='---';
                
            }
            
            //should really be set by now
            if(isset($_SESSION['landingpage'])){
                $landingpage                =   dbase::globalMagic($_SESSION['landingpage']);
            }
            else{
                $landingpage='none';
            }
            
            //normal user
            $group = 4;
            
            //block user on email/domain of email/referal?/or IPAD
            
            //validate data
            
            $validationResponse = validateDataEdit($username,$password,$password2,$email,$ipad,$_SESSION['refdomain'],  $_SESSION['refurl'],$recaptcha_challenge_field,$recaptcha_response_field);
     
            if ($validationResponse['validAck']=='ok'){
                $salt = general::generate_salt();
                $password_hash = general::doubleSalt($password,$salt);
                
              
                    $acti_code = time();
                    $valid=0;
               
                    $keys_values = array(
                                "userid"=>"NULL",
                                "username"=>$username,
                                "screenname"=>$username,
                                "p_hash"=>$password_hash,
                                "s_hash"=>$salt,
                                "valid"=>$valid,
                                "acti_code"=>$acti_code,
                                "ipad"=>$ipad,
                                "date_joined"=>"now()",
                                "lastip"=>"no visit",
                                "last_visit"=>"",
                                "email"=>$email,
                                "gravtar_email"=>"",
                                "usergroup"=>$group,
                                "temppass"=>"",
                                "tpdate"=>"",
                                "tpip"=>"",
                                "tp_flag"=>0,
                                "browser"=>$browser,
                                "os"=>$os,
                                "lang"=>$lang,
                                "country"=>$country,
                                "refid"=>dbase::globalMagic($_SESSION['refid']),
                                "refurl"=>dbase::globalMagic($_SESSION['refurl']),
                                "refdomain"=>dbase::globalMagic($_SESSION['refdomain']),
                                "contact"=>$contact,
                                "fname"=>"NULL",
                                "sname"=>"NULL",
                                "mobilenum"=>"N/A",
                                "screenres"=>$screenres,
                                "searchengine"=>$searchengine,
                                "searchterm"=>$searchterm,
                                "smstok"=>"",
                                "smsip"=>"",
                                "smstimedate"=>"",
                                "oneuse"=>"",
                                "landingpage"=>$landingpage,
                                "openidurl"=>$openid,
                                "authentication_source"=>"userbase"
                             
                             );
                
            
    
                if (Admin::addUser($keys_values)){
                    
               
                    $dataArray = array("Ack"=>"success", "Msg"=>"New user account created.","captcha"=>USE_CAPTCHA);
                    
                   
                    
                }
                else{
                    
                    
                    $dataArray = array("Ack"=>"fail", "Msg"=>"Oops, not sure what went wrong there!","captcha"=>USE_CAPTCHA);
                }
            }
            else{
                $dataArray = array("Ack"=>"validationFail", "Msg"=>"Correct the errors and try again.", "validationdata" =>$validationResponse,"captcha"=>USE_CAPTCHA);
            }
            
            
            
    
        }
        else{
            
            //not sent all data
            $dataArray = array("Ack"=>"fail", "Msg"=>"Please refresh the page and try again.");
        }
    }
    else{
        $dataArray = array("Ack"=>"fail", "Msg"=>"New registrations are currently offline.");
    }

echo json_encode($dataArray);

function validateDataEdit($username,$password,$password2,$email,$ipad, $domain,  $addressreferal,$recaptcha_challenge_field,$recaptcha_response_field){
    
 
    $validArray = array();
    
    $validArray['validAck'] = 'ok';
    
    $userNameResponse = validator::usernameValidate($username,0,0);
    
    if ($userNameResponse['Ack']=='fail'){
        $validArray['validAck'] = 'fail';
    }
    
    $validArray['usernameAck'] = $userNameResponse['Ack'];
    $validArray['usernameMsg'] = $userNameResponse['Msg'];
    
    $passwordResponse = validator::passwordValidate($password,$password2,0);
    
    if ($passwordResponse['Ack']=='fail'){
        $validArray['validAck'] = 'fail';
    }
    
    $validArray['passwordAck'] = $passwordResponse['Ack'];
    $validArray['passwordMsg'] = $passwordResponse['Msg'];
    
    $emailResponse = validator::emailValidate($email,0,0);
    
    if ($emailResponse['Ack']=='fail'){
        $validArray['validAck'] = 'fail';
    }
    else{
        
        //then move whole block in to validation class
        global $conn;
        $email_domain=split("@",$email);
        $sql_where='';
        //really only the email domain area needs to be in this else statement
      /*
        types:  ip=1
                refdomain=5
                referurl=4
                email:3
                email domain:2
      
      */
        
        if(trim($addressreferal) !=''){
            $sql_where = " OR ( blockvalue = '$addressreferal' AND type=4 ) ";
        }
        
        if(trim($domain) !=''){
             $sql_where = " OR ( blockvalue = '$domain' AND type=5 ) ";
        }
        
        if(trim($email_domain[1]!='')){
            $sql_where = " OR ( blockvalue='".$email_domain[1]."' AND type=2 ) ";
        }
       
        $sqlBlock = " SELECT blockid FROM security_blocks WHERE (( blockvalue='$ipad' AND type=1 ) OR ( blockvalue='$email' AND type=3 ) $sql_where ) AND valid=1 AND blockarea IN (1,3) ";
                    
        $dataPostBack =  dbase::globalQueryPlus($sqlBlock,$conn,2);
          
       
        if ($dataPostBack[1]>0){
       
            $validArray['validAck'] = 'fail';
            $validArray['blockAck'] = 'fail';
            $validArray['blockMsg'] = 'could not register your account.';
            
        }
        else{
           
            $validArray['blockAck'] = 'ok';
            $validArray['blockMsg'] = 'ok';
        }
    }
    
    $validArray['emailAck'] = $emailResponse['Ack'];
    $validArray['emailMsg'] = $emailResponse['Msg'];
    
    
    
    
    if (USE_CAPTCHA){
        $resp = recaptcha_check_answer(RECAPKEY,
                                    $_SERVER["REMOTE_ADDR"],
                                    $recaptcha_challenge_field,
                                    $recaptcha_response_field);
    
        if (!$resp->is_valid) {
          
            $validArray['validAck'] = 'fail';
            $validArray['captAck'] = 'fail';
            $validArray['captMsg'] = 'You got the word wrong.';
          
        } else {
            $validArray['captAck'] = 'ok';
            $validArray['captMsg'] = 'ok';
        }
    }
    else{
        $validArray['captAck'] = 'ok';
        $validArray['captMsg'] = 'ok';
    }

    
    return $validArray;
    
}

?>