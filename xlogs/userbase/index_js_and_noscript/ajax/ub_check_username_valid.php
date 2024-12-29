<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
require_once("../local_config.php");

require_once(APP_INC_PATH."bootstrap.php");

sessionsClass::sessionStart();


        $postList = array("source","username");
        //var_dump($_POST);
        if (general::globalIsSet($_POST,$postList)){

            

            
           
           
            $username = dbase::globalMagic($_POST['username']);
            $source = dbase::globalMagic($_POST['source']);
        
            //$userid = 99;
            $userid = (isset($_SESSION['userid']))?dbase::globalMagic($_SESSION['userid']):-9;
            
            
            
   
            
            $validationResponse = validateDataEdit($username, $userid,$source);
            
            
            if ($validationResponse['validAck']=='ok'){
            
                        $dataArray = array("Ack"=>"success", "Msg"=>"user name not in use.");
                        
                       
                        
                   
            }
            else{
                $dataArray = array("Ack"=>"validationFail", "Msg"=>"Correct the errors and try again.", "validationdata" =>$validationResponse);
            }
        }
        else{
            
            //not sent all data
            $dataArray = array("Ack"=>"fail", "Msg"=>"Please refresh the page and try again.");
        }

echo json_encode($dataArray);

function validateDataEdit($username, $userid,$source){
    
 
    $validArray = array();
    
    $validArray['validAck'] = 'ok';
    
  
    
  
    $userNameResponse = validator::usernameValidate($username,$source,$userid);
    
    if ($userNameResponse['Ack']=='fail' || $userid==0){
        $validArray['validAck'] = 'fail';
    }
    
    $validArray['usernameAck'] = $userNameResponse['Ack'];
    $validArray['usernameMsg'] = $userNameResponse['Msg'];
    
    
  
    
    

    
    return $validArray;
    
}

?>