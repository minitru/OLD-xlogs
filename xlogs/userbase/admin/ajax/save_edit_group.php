<?php
/*
    (c) copyright 2011 nadlabs.co.uk. All rights reserved.
    
    
    
    http://www.nadlabs.co.uk/licence.php

*/
require_once("../local_config.php");

require_once(APP_INC_PATH."bootstrap.php");

sessionsClass::sessionStart();
if (sessionsClass::sessionStartFind($groupTest=array(1))){

        $postList = array("group_name","group_id","short_desc");
        //var_dump($_POST);
        if (general::globalIsSet($_POST,$postList)){

            
            $groupName = dbase::globalMagic($_POST['group_name']);
            $groupdesc = dbase::globalMagic($_POST['short_desc']);
            $groupid = dbase::globalMagic($_POST['group_id']);
            
            
            //validate data
             
            $validationResponse = validateDataEdit($groupName,$groupid);
            
    
                
            if ($validationResponse['validAck']=='ok'){
                if (Admin::editUserGroupName($groupName,$groupdesc,$groupid)){
                    
                
                    $dataArray = array("Ack"=>"success", "Msg"=>"Your changes have been saved.");
                    
                }
                else{
                    
                    
                    $dataArray = array("Ack"=>"fail", "Msg"=>"Oops! Not sure what went wrong there. Refresh the page and try again.");
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

function validateDataEdit($groupName,$groupid){
    
    $validArray = array();
    
    $validArray['validAck'] = 'ok';

    
    if (!is_numeric($groupid) || $groupid==0){
    
       
        $validArray['validAck'] = 'fail';
        $validArray['groupidAck'] = 'fail';
        $validArray['groupidMsg'] = 'Oops, could not find this user group.';
        
    }
    else{
        
        $validArray['groupidAck'] = 'ok';
        $validArray['groupidMsg'] = 'ok';

    }
    
    if (trim($groupName) == ""){
    
       
        $validArray['validAck'] = 'fail';
        $validArray['nameAck'] = 'fail';
        $validArray['nameMsg'] = 'enter the a new name for this group.';
        
    }
    else{
        
        $validArray['nameAck'] = 'ok';
        $validArray['nameMsg'] = 'ok';

    }


 
  
   
    
    return $validArray;
    
}

?>