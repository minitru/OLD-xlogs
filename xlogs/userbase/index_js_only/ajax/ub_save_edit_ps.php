<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
require_once("../local_config.php");

require_once(APP_INC_PATH."bootstrap.php");

sessionsClass::sessionStart();
if (sessionsClass::sessionStartFind(false)){

        $postList = array("p1","p2","p4");
        //var_dump($_POST);
        if (general::globalIsSet($_POST,$postList)){

            

            
          
            $p1 = dbase::globalMagic($_POST['p1']);
            $p2 = dbase::globalMagic($_POST['p2']);
            $p4 = dbase::globalMagic($_POST['p4']);
          
           
            
            //$username = 'kingtob';
            $username = dbase::globalMagic($_SESSION['username']);
            
            //$userid = 172;
            $userid = dbase::globalMagic($_SESSION['userid']);
            
            //validate data
            
            $validationResponse = validateDataEdit($p1,$p2,$p4,$userid);
        
            if ($validationResponse['validAck']=='ok'){
            
                   $salt = general::generate_salt();
                   $phash = general::doubleSalt($p1,$salt);
                  
                     
        
                    if (User::changePassword($phash,$salt,$userid)){
                        
                  
                        $dataArray = array("Ack"=>"success", "Msg"=>"Your changes have been saved.");
                        
                    
                        
                    }
                    else{
                        
                  
                        $dataArray = array("Ack"=>"fail", "Msg"=>"Oops, look like something went wrong! Try clicking save again.");
                    }
            }
            else{
                $dataArray = array("Ack"=>"validationFail", "Msg"=>"Correct the errors and try again.", "validationdata" =>$validationResponse);
            }
        }
        else{
            
            //not sent all data
            $dataArray = array("Ack"=>"fail", "Msg"=>"Please refresh the page and try again.");
        }
}
else{
    
    //not logged in
    $dataArray = array("Ack"=>"fail", "Msg"=>"You do not have permission to edit this page");
    
}
echo json_encode($dataArray);

function validateDataEdit($p1,$p2,$p4,$userid){
    
 
    $validArray = array();
    
    $validArray['validAck'] = 'ok';
    
   
    
    
    
  
    $passwordResponse = validator::passwordValidate($p1,$p2,0);

    if ($passwordResponse['Ack']=='fail'){
        $validArray['validAck'] = 'fail';
    }
    $validArray['passwordAck'] = $passwordResponse['Ack'];
    $validArray['passwordMsg'] = $passwordResponse['Msg'];
    
    $passwordResponse = validator::checkPasswordDB($p4,$userid);
    
    if ($passwordResponse['validAck']=='fail'){
        $validArray['validAck'] = 'fail';
    }
    
    $validArray['passAck'] = $passwordResponse['validAck'];
    $validArray['passMsg'] = $passwordResponse['validMsg'];
    
    
    

    
    return $validArray;
    
}

?>