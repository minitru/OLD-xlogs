<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
require_once("../local_config.php");
require_once(APP_INC_PATH."bootstrap.php");

sessionsClass::sessionStart();


        $postList = array("u","a");
        //var_dump($_POST);
        if (general::globalIsSet($_POST,$postList)){

            

            
          
            $userid = dbase::globalMagic($_POST['u']);
            $acticode = dbase::globalMagic($_POST['a']);

            //validate data
            
            $validationResponse = validateDataEdit($userid,$acticode);
         
            if ($validationResponse['validAck']=='ok'){
            
                   
                  
                     
               
                    if (User::activateUser($userid,$acticode,CONGRATS_NO_HTML)){
                        
               
                        $dataArray = array("Ack"=>"success", "Msg"=>"Your account has been activated.");
                        
                    
                        
                    }
                    else{
                        
                     
                        $dataArray = array("Ack"=>"fail", "Msg"=>"Could not activate your account. Make sure you copied the codes into the correct boxes.");
                    }
            }
            else{
                $dataArray = array("Ack"=>"validationFail", "Msg"=>"Make sure you copied the codes into the correct boxes.");
            }
        }
        else{
            
            //not sent all data
            $dataArray = array("Ack"=>"fail", "Msg"=>"Please refresh the page and try again.");
        }

echo json_encode($dataArray);

function validateDataEdit($userid,$acticode){
    
 
    $validArray = array();
    
    $validArray['validAck'] = 'ok';
    
    if(trim($userid)==''){
        $validArray['validAck'] = 'fail2';
    }

    if(!is_numeric(intval($acticode))){
        $validArray['validAck'] = 'fail1';
    }
    
    

    
    return $validArray;
    
}

?>