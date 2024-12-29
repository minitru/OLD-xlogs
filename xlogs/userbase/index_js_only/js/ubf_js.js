function changeUsernameOTF(){
         
         $('#openid_ch_msg').html('checking...');
         $('#alert_openid').attr({'title':''}).qtip('destroy').fadeOut(1);
         //for those who login with openid/twitter/facebook
         var openidname = $('#openid_ub').val();
         $('#openid_loader').fadeIn(100,function(){
		$.post("ajax/ub_change_OTF_username.php",{newusername:openidname},function(dataReturn){
			    
			    var obj = jQuery.parseJSON(dataReturn);
			    
			   
			    $('#openid_ch_msg').html(obj.Msg);
			    if (obj.Ack=="success"){
                                    
                            }
                             else if (obj.Ack=="validationFail"){
				//go through and display php validation
				
				
				
				if (obj.validationdata.usernameAck=='fail'){
				    //alert('username');
				    $('#alert_openid').attr({'title':obj.validationdata.usernameMsg}).fadeIn(1000);
				     errorTip('alert_openid');
				    //alert('username');
					
				}
                             }
                             
                             $('#openid_loader').fadeOut(100);
                  });
         });
         
}

function hotlink(){
         
         $('#hotlink_msg').html('linking...');
         $('#alert_hotlink_url').attr({'title':''}).qtip('destroy').fadeOut(1);
         //for those who login with openid/twitter/facebook
         var hotlink_url = $('#hotlink_url').val();
         $('#hotlink_loader').fadeIn(100,function(){
		$.post("ajax/ub_hotlink.php",{hotlink_url:hotlink_url},function(dataReturn){
			    
			    var obj = jQuery.parseJSON(dataReturn);
			    
			   
			    $('#hotlink_msg').html(obj.Msg);
			    if (obj.Ack=="success"){
                                    
                            }
                            else{
				
                            }
                             
                           $('#hotlink_loader').fadeOut(100);
                  });
         });
}

function clearTxt(id){
	
	 switch(id){
		  
		  case 'ub_login_username':
			   
			   if ($('#'+id).val()=='username'){
				$('#'+id).val('');    
			   }
			   break
		  case 'ub_login_p1':
			   
			   if ($('#'+id).val()=='YoUR PAs$W0rD'){
				$('#'+id).val('');    
			   }
			   break
		  default:
			   break;
	 }
	 
}

function set_ub_stats(){
         
	$.post("ajax/ub_set_stats.php",{width:screen.width,height:screen.height});
	//no data sent back - silent function - if it fails, oh well!
}

/* user management */

function registerUser(){
	
	
	
	error_manager('alert_username','username_register','',true);
        error_manager('alert_email','email_register','',true);
        error_manager('alert_p2','p2_register','',true);
        error_manager('alert_capt','recaptcha_response_field','',true);

	
	
	$('#reg_msg').html('');
	//in userBase give option to do this or ajax the regisrtaion
	$('#reg_loader').fadeOut(100);
	//$('#submit_register_load').attr('src','images/loader/sm_dg.gif');
	
	
	var username = $('#username_register').val();
	var email = $('#email_register').val();
	
	//check if js md5 is same as PHP and then use that
	
	var p1 = hex_md5($('#p1_register').val());
	var p2 = hex_md5($('#p2_register').val());
	
	var contact     = $('#contact_register').is(':checked');

	
	var recaptcha_challenge_field     = $('#recaptcha_challenge_field').val();
	var recaptcha_response_field      = $('#recaptcha_response_field').val();
	


	contact = (contact==false)?0:1;
	
	
	//system will do server side validation one more time 'just in case'.
	$('#reg_loader').fadeIn(100,function(){
		$.post("ajax/ub_register_user.php",{email:email,
						       username:username,
						       p1:p1,
						       p2:p2,
						       contact:contact,
						       recaptcha_challenge_field:recaptcha_challenge_field,
						       recaptcha_response_field:recaptcha_response_field
						       },function(dataReturn){
			    
			    var obj = jQuery.parseJSON(dataReturn);
			    
			   
			    
			    if (obj.Ack=="success"){
				 
				 
                                 
                                window.location = 'thankyou.php';
				 
				/*
				$('#reg_msg').html(obj.Msg).show(1);
				if (obj.captcha=='true')
                                    Recaptcha.reload();
				
                                */
				
				
				
				
	
			    }
			    else if (obj.Ack=="validationFail"){
				//go through and display php validation
				
				
				
				if (obj.validationdata.usernameAck=='fail'){
				    
				    error_manager('alert_username','username_register',obj.validationdata.usernameMsg,false);
				}
				
				
				
				if (obj.validationdata.emailAck=='fail'){
                                    error_manager('alert_email','email_register',obj.validationdata.emailMsg,false);
				}
				
				
				if (obj.validationdata.passwordAck=='fail'){
					
					
					error_manager('alert_p2','p2_register',obj.validationdata.passwordMsg,false);

					
					
				}
				
				
				
				 
				
                                if (obj.validationdata.blockAck=='fail'){
					$('#reg_msg').html(obj.validationdata.blockMsg).show(1);
					
					
				}
				else{
					$('#reg_msg').html('correct the errors and try again.').show(1);
				} 
				
                                //alert(obj.validationdata.captAck);
				if (obj.validationdata.captAck=='fail'){
					error_manager('alert_capt','recaptcha_response_field',obj.validationdata.captMsg,false);

					
					
					if (obj.captcha=='true')
                                             Recaptcha.reload();
					
				}
				 
				
				
			    }
			    else{
				$('#reg_msg').html(obj.Msg).show(1);
			    }
			   
		});
	});
	
	$('#reg_loader').fadeOut(100);
	
	
}

function checkUsername(source,endid){
	
	//alert($('#username_'+endid).val());

	var username= $('#username_'+endid).val();
	var return_value = '';
        
        error_manager('alert_username','username_'+endid,'',true);
	
	//$('#alert_username').attr({'title':''}).qtip('destroy').fadeOut(1);
	//check input/length/validness/if already exists (need to send in source)
	$('#username_'+endid+'_load').fadeIn(100,function(){
		$.post("ajax/ub_check_username_valid.php",{username:username,source:source},function(dataReturn){
			    var obj = jQuery.parseJSON(dataReturn);
						 
			    if (obj.Ack=="success"){
				 
				
				error_manager('alert_username','username_'+endid,'',true);
			        return_value=true;
				
				 //set tick
				
				 // return true;
	
			    }
			    else{
				//set cross
                           
				error_manager('alert_username','username_'+endid,obj.validationdata.usernameMsg,false);
				
				return_value =  false;
				
			       //return false;
			    }
			   $('#username_'+endid+'_load').fadeOut(100);
		});
	});
	return return_value;
	
}

function checkPasswords(source,endid){
	//$('#p2_'+endid+'_load').attr('src','images/loader/sm_dg.gif');
	var return_value = '';
	//1 = reg/change 2=for login (not really useful)
	
	
        error_manager('alert_p2','p2_'+endid,'',true);
	
	if (source==0){
		//register+change - check both passwords
		
		var p1 = $('#p1_'+endid).val();
		var p2 = $('#p2_'+endid).val();
		
		
			
			if (p1!=p2){
				//mismatch
				//$('#p2_'+endid+'_error').html('passwords do not match');
				//$('#p2_'+endid+'_load').attr('src','images/cross.png');
                                error_manager('alert_p2','p2_'+endid,'passwords do not match',false);
					
				return_value = false;
			}
			else{
				if(p1=='' || p2 ==''){
					
					//not entered
				
					      error_manager('alert_p2','p2_'+endid,'password not entered',false);
					//$('#p2_'+endid+'_load').attr('src','images/cross.png');
					return_value = false;
				}
				else{
					if (p1.length<6 || p2.length<6){
						//too short
						//eventually make more advanced version of this to test strength
						
						error_manager('alert_p2','p2_'+endid,'password too short',false);
						      return_value = false;
					}
					else{
						//ok
						
						//$('#p2_'+endid+'_error').html(check_password_safety(p1));
						//$('#p2_'+endid+'_load').attr('src','images/tick.png');
						return_value = true;
						
					}
				}
			}
			
		
		
	}
	else if (source==1){
	
		//this part is useless? - yes - not going to use it: marked for removal
		//login - make sure not empty
		var p1 = $('#p1_login').val();

		
		$('#p1_login_load').fadeIn(100,function(){
			if(p1=='' ){
				
				//not entered
				error_manager('alert_p2','p2_'+endid,'password not entered',false);
				//$('#p1_login_error').html('password not entered');
				//$('#p1_login_load').attr('src','images/cross.png');
                                return_value = false;
				return false;
                           
			}
			
			else{
				//ok
                                return_value = true;
				return true;
				
			}
			
		});
	}


	return return_value;
	
	
}

function checkEmail(source,endid){
	/*
		
	*/
	
	
	var email= $('#email_'+endid).val();
	var return_value = '';
	//source = 0 reg, 1 = change	
	//check input/length/validness/if already exists (need to send in source)
	
       // $('#alert_email').attr({'title':''}).qtip('destroy').fadeOut(1);
        error_manager('alert_email','email_'+endid,'',true);
        
	$('#email_'+endid+'_load').fadeIn(100,function(){
		$.post("ajax/ub_check_email_valid.php",{email:email,source:source},function(dataReturn){
			    var obj = jQuery.parseJSON(dataReturn);
						 
			    if (obj.Ack=="success"){
				 
			        //$('#alert_email').attr({'title':''}).qtip('destroy').fadeOut(1);
                                    error_manager('alert_email','email_'+endid,'',true);
				return_value = true;
	
			    }
			    else{
				
				error_manager('alert_email','email_'+endid,obj.validationdata.emailMsg,false);
				return_value = false;
			    }
			   $('#email_'+endid+'_load').fadeOut(100);
		});
		
		
	});
	return return_value;
}



function getSMS_token(){
         $('#loginsms_msg').html('');
	var username = $('#ub_loginsms_username').val();
	var password = hex_md5($('#ub_loginsms_p1').val());
	
	$('#loginsms_loader').fadeIn(100, function(){
		$.post("ajax/ub_get_smstok.php",{username:username,password:password},function(dataReturn){
			    var obj = jQuery.parseJSON(dataReturn);
						 
			    if (obj.Ack=="success"){
				 
				 //do anything else you need to on success - like refresh page
				 
				 $('#loginsms_msg').html(obj.Msg);
				 
	
			    }
			    else{
				//do anything else you need to on fail
				 
				 
				 $('#loginsms_msg').html(obj.Msg);
				
			       
			    }
			    $('#loginsms_loader').fadeOut(100);
			    
		});
	
         });
}

function loginUser_x(){
	
	
	//again use jquery for submiting but on userbase give two options
	
	$('#loginsms_msg').html('');
	var username = $('#ub_loginsms_username').val();
	var password = hex_md5($('#ub_loginsms_p1').val());
        var smstok   = $('#ub_loginsms_smstok').val();
	
	$('#loginsms_loader').fadeIn(100, function(){
		$.post("ajax/ub_login_user_sms.php",{username:username,password:password,smstok:smstok,loc:'usersms'},function(dataReturn){
			    var obj = jQuery.parseJSON(dataReturn);
						 
			    if (obj.Ack=="success"){
				 
				 //do anything else you need to on success - like refresh page
				 
				 $('#loginsms_msg').html(obj.Msg);
				  window.location = 'userarea.php';
	
			    }
			    else{
				//do anything else you need to on fail
				 
				 
				 $('#loginsms_msg').html(obj.Msg);
				
			       
			    }
			    $('#loginsms_loader').fadeOut(100);
			    
		});
	
         });
	
	
}

function loginUser(){
	
	
	//again use jquery for submiting but on userbase give two options
	
	$('#login_msg').html('');
	var username = $('#ub_login_username').val();
	var password = hex_md5($('#ub_login_p1').val());
        var remember = ($('#ub_remember').is(':checked'))?1:0;
        var loc = 'user';
	
	$('#login_loader').fadeIn(100, function(){
		$.post("ajax/ub_login_user.php",{username:username,password:password,loc:loc,remember:remember},function(dataReturn){
			    var obj = jQuery.parseJSON(dataReturn);
						 
			    if (obj.Ack=="success"){
				 
				 //do anything else you need to on success - like refresh page
				 
				 $('#login_msg').html(obj.Msg);
				  window.location = 'userarea.php';
	
			    }
			    else{
				//do anything else you need to on fail
				 
				 
				 $('#login_msg').html(obj.Msg);
				
			       
			    }
			    $('#login_loader').fadeOut(100);
			    
		});
	
         });
	
	
}



function errorTip(id){
	
	  $('#'+id).qtip({content: {attr: 'title'},overwrite: true,
                                                                    
                                    style:{
                                       
                                        tip: { offset: 5 }
                                     },
                                     position: {
					     at:'right top',
                                        my:'left bottom',
                                        viewport: $(window),
                                        adjust: {
                                           method: 'shift',
                                           x: parseInt(0, 10) || 0,
                                           y: parseInt(0, 10) || 0
                                        }

                                     },
				      show: {
					     event: false,
					     ready: true
					  },
					  hide: false
	 });
}

function error_manager(text_id,input_id,err_msg,clear){
         
         if(clear){
                  $('#'+text_id).html('');
                  $('#'+input_id).css('box-shadow','none');  
         }
         else{
                  $('#'+text_id).html(err_msg);
                  $('#'+input_id).css('box-shadow','inset 0 0 2px 1px #ff9f9f');    
         }
         
}

function contactus(){
         
         error_manager('alert_user_name_contact','user_name_contact','',true);
         
         error_manager('alert_user_email_contact','user_email_contact','',true);
         
         error_manager('alert_user_msg_contact','user_msg_contact','',true);
         
         $('#contact_msg').html('sending...');

         var user_email_contact = $('#user_email_contact').val();
         
         var user_name_contact = $('#user_name_contact').val();
         
         var user_msg_contact = $('#user_msg_contact').val();
         
         $('#contact_loader').fadeIn(200,function(){
		$.post("ajax/ub_contact_us.php",{user_email_contact:user_email_contact,
                                                 user_name_contact:user_name_contact,
                                                 user_msg_contact:user_msg_contact
                                                 
                                                      },function(dataReturn){
			   var obj = jQuery.parseJSON(dataReturn);
			   $('#contact_msg').html(obj.Msg);
                           
			    if (obj.Ack=="success"){
				
				 
				 
	
			    }
			    else if (obj.Ack=='validationFail'){
				
                                //validation failure
				
				if (obj.validationdata.emailAck == 'fail'){
			
				     error_manager('alert_user_email_contact','user_email_contact',obj.validationdata.emailMsg,false);
                                    
					
					
				}
				 
				if (obj.validationdata.msgAck == 'fail'){

			
				    error_manager('alert_user_msg_contact','user_msg_contact',obj.validationdata.msgMsg,false);
				    
				}
                                
                                if (obj.validationdata.nameAck == 'fail'){

			
				    error_manager('alert_user_name_contact','user_name_contact',obj.validationdata.nameMsg,false);
				    
				}
			        
			    }
			    else{
				
				 
				 //failure
			    }
			    
			    
			    
			    
			    $('#contact_loader').fadeOut(100);
			
			     
		});
	});

}

function changeEmail(){
	
	$('#email_change_msg').html('checking...');
        error_manager('change_email_email_alert','email_change','',true);
        error_manager('change_email_password_alert','ub_ch_p3','',true);
        
	$('#change_email_email_alert').html('');
	$('#change_email_password_alert').html('');
	
	var email = $('#email_change').val();
	var p1 = hex_md5($('#ub_ch_p3').val());
        
	$('#em_loader').fadeIn(200,function(){
		$.post("ajax/ub_save_edit_email.php",{email:email,p1:p1},function(dataReturn){
			    var obj = jQuery.parseJSON(dataReturn);
						 
			    if (obj.Ack=="success"){
				
				 
				 $('#email_change_msg').html(obj.Msg);
	
			    }
			    else if (obj.Ack=='validationFail'){
				
				
				if (obj.validationdata.emailAck == 'fail'){
			
				     error_manager('change_email_email_alert','email_change',obj.validationdata.emailMsg,false);
                                    
					
					
				}
				 
				if (obj.validationdata.passAck == 'fail'){

			
				    error_manager('change_email_password_alert','ub_ch_p3',obj.validationdata.passMsg,false);
				    
				}
			        $('#email_change_msg').html(obj.Msg);
			    }
			    else{
				
				 
				 $('#email_change_msg').html(obj.Msg);
			    }
			    
			    
			    
			    
			    $('#em_loader').fadeOut(100);
			
			     
		});
	});
	
	
	
}

function changePs(){

        $('#psword_change_msg').html('checking...');
        error_manager('alert_p4','p4_change','',true);
        error_manager('alert_p1','p1_change','',true);
        error_manager('alert_p2','p2_change','',true);
        

		if (checkPasswords(0,'change')){
			
			var p1 = hex_md5($('#p1_change').val());
			var p2 = hex_md5($('#p2_change').val());
                        
			var p4 = hex_md5($('#p4_change').val());
	
		$('#pc_loader').fadeIn(200,function(){
			$.post("ajax/ub_save_edit_ps.php",{p1:p1,p2:p2,p4:p4},function(dataReturn){
				    var obj = jQuery.parseJSON(dataReturn);
                             
				    $('#psword_change_msg').html(obj.Msg);		 
				    if (obj.Ack=="success"){
					 
					
					 
					 
								
					 
		
				    }
				    else if (obj.Ack=='validationFail'){
					
					if (obj.validationdata.passwordAck == 'fail'){
					     
                                             error_manager('alert_p2','p2_change',obj.validationdata.passwordMsg,false);
					  
						
					}
					
					if (obj.validationdata.passAck == 'fail'){
						
                                                 error_manager('alert_p4','p4_change',obj.validationdata.passMsg,false);
					      
						
					}
					
				       
				    }
				    else{
				
					
				
					
				    }
				    
				    
				    $('#pc_loader').fadeOut(100);
				   
			});
		
		
		
		});
		}
		else{
			$('#psword_change_msg').html('correct the errors and try again');
		}
	

	
}

function activateAcc(){
	var partA = $('#parta_activate').val();
	var partB = $('#partb_activate').val();
        
        
        error_manager('alert_parta','parta_activate','',true);
        error_manager('alert_partb','partb_activate','',true);
        
        
	$('#activate_loader').fadeIn(200,function(){
		  $.post("ajax/ub_activate.php",{a:partB,u:partA},function(dataReturn){
			  var obj = jQuery.parseJSON(dataReturn);
			    
                            $('#activate_msg').html(obj.Msg);				   
			    if (obj.Ack=="success"){
				 
			    }
			    else{
                                    
                                    error_manager('alert_parta','parta_activate','',false);
                                    error_manager('alert_partb','partb_activate','',false);
				 
				
				     
			    }
			  
			   $('#activate_loader').fadeOut(100);
			  
		  });
	 });
}

function react(){
	
	
	$('#react_msg').html('');
        
        error_manager('alert_user_email_react','user_email_react','',true);
        
	var username_email = $('#user_email_react').val();
        
	
	$('#alert_user_email_react').attr({'title':'','src':'images/blank.gif'});
	
	$('#react_loader').fadeIn(200,function(){
	 
		  $.post("ajax/ub_resend_activation.php",{username_email:username_email},function(dataReturn){
			   
			   var obj = jQuery.parseJSON(dataReturn);
				 $('#react_msg').html(obj.Msg);				  
			   if (obj.Ack=="success"){
				    
				   
				    
			   }
			   else{
				   error_manager('alert_user_email_react','user_email_react','',false); 
				
				   //$('#alert_user_email_react').attr({'title':'','src':'images/alert.gif'});
				   
			   }
			  
	 
			  $('#react_loader').fadeOut(100);
		  });
		  
	});
	
}

function forgotPs(){
	
	
	$('#forgot_msg').html('');
        error_manager('alert_user_email','user_email_forgot','',true);
	var username_email = $('#user_email_forgot').val();
        
        
	
	
	
	$('#forgot_loader').fadeIn(200,function(){
	 
		  $.post("ajax/ub_forgot_ps.php",{username_email:username_email},function(dataReturn){
			   
			   var obj = jQuery.parseJSON(dataReturn);
                           
		           $('#forgot_msg').html(obj.Msg);
                           
			   if (obj.Ack=="success"){
				    
				    
				    
			   }
			   else{
				    
				  error_manager('alert_user_email','user_email_forgot','',false);
				 
				   
			   }
			  
	 
			  $('#forgot_loader').fadeOut(100);
		  });
		  
	});
	
}

function check_password_safety(pwd){

	var msg = "";
	var points = pwd.length;
	
	
	var has_letter		= new RegExp("[a-z]");
	var has_caps		= new RegExp("[A-Z]");
	var has_numbers		= new RegExp("[0-9]");
	var has_symbols		= new RegExp("\\W");
	
	if(has_letter.test(pwd)) 	{ points += 4; }
	if(has_caps.test(pwd)) 		{ points += 4; }
	if(has_numbers.test(pwd)) 	{ points += 4; }
	if(has_symbols.test(pwd)) 	{ points += 4; }
	
	
	if( points >= 24 ) {
		msg = '<span style="color: #0f0;">Your password is strong.</span>';
	} else if( points >= 16 ) {
		msg = '<span style="color: #00f;">Your password is medium strength.</span>';
	} else if( points >= 12 ) {
		msg = '<span style="color: #fa0;">Your password is weak.</span>';
	} else {
		msg = '<span style="color: #f00;">Your password is very weak.</span>';
	}
	
	return msg ;
}









//not really sure if hashing pw before sending it is worth it at all.

//==============
/*
 * A JavaScript implementation of the RSA Data Security, Inc. MD5 Message
 * Digest Algorithm, as defined in RFC 1321.
 * Version 2.1 Copyright (C) Paul Johnston 1999 - 2002.
 * Other contributors: Greg Holt, Andrew Kepert, Ydnar, Lostinet
 * Distributed under the BSD License
 * 
 */

/*
 * Configurable variables. You may need to tweak these to be compatible with
 * the server-side, but the defaults work in most cases.
 */
var hexcase = 0;  /* hex output format. 0 - lowercase; 1 - uppercase        */
var b64pad  = ""; /* base-64 pad character. "=" for strict RFC compliance   */
var chrsz   = 8;  /* bits per input character. 8 - ASCII; 16 - Unicode      */

/*
 * These are the functions you'll usually want to call
 * They take string arguments and return either hex or base-64 encoded strings
 */
function hex_md5(s){ return binl2hex(core_md5(str2binl(s), s.length * chrsz));}
function b64_md5(s){ return binl2b64(core_md5(str2binl(s), s.length * chrsz));}
function str_md5(s){ return binl2str(core_md5(str2binl(s), s.length * chrsz));}
function hex_hmac_md5(key, data) { return binl2hex(core_hmac_md5(key, data)); }
function b64_hmac_md5(key, data) { return binl2b64(core_hmac_md5(key, data)); }
function str_hmac_md5(key, data) { return binl2str(core_hmac_md5(key, data)); }

/*
 * Perform a simple self-test to see if the VM is working
 */
function md5_vm_test()
{
  return hex_md5("abc") == "900150983cd24fb0d6963f7d28e17f72";
}

/*
 * Calculate the MD5 of an array of little-endian words, and a bit length
 */
function core_md5(x, len)
{
  /* append padding */
  x[len >> 5] |= 0x80 << ((len) % 32);
  x[(((len + 64) >>> 9) << 4) + 14] = len;

  var a =  1732584193;
  var b = -271733879;
  var c = -1732584194;
  var d =  271733878;

  for(var i = 0; i < x.length; i += 16)
  {
    var olda = a;
    var oldb = b;
    var oldc = c;
    var oldd = d;

    a = md5_ff(a, b, c, d, x[i+ 0], 7 , -680876936);
    d = md5_ff(d, a, b, c, x[i+ 1], 12, -389564586);
    c = md5_ff(c, d, a, b, x[i+ 2], 17,  606105819);
    b = md5_ff(b, c, d, a, x[i+ 3], 22, -1044525330);
    a = md5_ff(a, b, c, d, x[i+ 4], 7 , -176418897);
    d = md5_ff(d, a, b, c, x[i+ 5], 12,  1200080426);
    c = md5_ff(c, d, a, b, x[i+ 6], 17, -1473231341);
    b = md5_ff(b, c, d, a, x[i+ 7], 22, -45705983);
    a = md5_ff(a, b, c, d, x[i+ 8], 7 ,  1770035416);
    d = md5_ff(d, a, b, c, x[i+ 9], 12, -1958414417);
    c = md5_ff(c, d, a, b, x[i+10], 17, -42063);
    b = md5_ff(b, c, d, a, x[i+11], 22, -1990404162);
    a = md5_ff(a, b, c, d, x[i+12], 7 ,  1804603682);
    d = md5_ff(d, a, b, c, x[i+13], 12, -40341101);
    c = md5_ff(c, d, a, b, x[i+14], 17, -1502002290);
    b = md5_ff(b, c, d, a, x[i+15], 22,  1236535329);

    a = md5_gg(a, b, c, d, x[i+ 1], 5 , -165796510);
    d = md5_gg(d, a, b, c, x[i+ 6], 9 , -1069501632);
    c = md5_gg(c, d, a, b, x[i+11], 14,  643717713);
    b = md5_gg(b, c, d, a, x[i+ 0], 20, -373897302);
    a = md5_gg(a, b, c, d, x[i+ 5], 5 , -701558691);
    d = md5_gg(d, a, b, c, x[i+10], 9 ,  38016083);
    c = md5_gg(c, d, a, b, x[i+15], 14, -660478335);
    b = md5_gg(b, c, d, a, x[i+ 4], 20, -405537848);
    a = md5_gg(a, b, c, d, x[i+ 9], 5 ,  568446438);
    d = md5_gg(d, a, b, c, x[i+14], 9 , -1019803690);
    c = md5_gg(c, d, a, b, x[i+ 3], 14, -187363961);
    b = md5_gg(b, c, d, a, x[i+ 8], 20,  1163531501);
    a = md5_gg(a, b, c, d, x[i+13], 5 , -1444681467);
    d = md5_gg(d, a, b, c, x[i+ 2], 9 , -51403784);
    c = md5_gg(c, d, a, b, x[i+ 7], 14,  1735328473);
    b = md5_gg(b, c, d, a, x[i+12], 20, -1926607734);

    a = md5_hh(a, b, c, d, x[i+ 5], 4 , -378558);
    d = md5_hh(d, a, b, c, x[i+ 8], 11, -2022574463);
    c = md5_hh(c, d, a, b, x[i+11], 16,  1839030562);
    b = md5_hh(b, c, d, a, x[i+14], 23, -35309556);
    a = md5_hh(a, b, c, d, x[i+ 1], 4 , -1530992060);
    d = md5_hh(d, a, b, c, x[i+ 4], 11,  1272893353);
    c = md5_hh(c, d, a, b, x[i+ 7], 16, -155497632);
    b = md5_hh(b, c, d, a, x[i+10], 23, -1094730640);
    a = md5_hh(a, b, c, d, x[i+13], 4 ,  681279174);
    d = md5_hh(d, a, b, c, x[i+ 0], 11, -358537222);
    c = md5_hh(c, d, a, b, x[i+ 3], 16, -722521979);
    b = md5_hh(b, c, d, a, x[i+ 6], 23,  76029189);
    a = md5_hh(a, b, c, d, x[i+ 9], 4 , -640364487);
    d = md5_hh(d, a, b, c, x[i+12], 11, -421815835);
    c = md5_hh(c, d, a, b, x[i+15], 16,  530742520);
    b = md5_hh(b, c, d, a, x[i+ 2], 23, -995338651);

    a = md5_ii(a, b, c, d, x[i+ 0], 6 , -198630844);
    d = md5_ii(d, a, b, c, x[i+ 7], 10,  1126891415);
    c = md5_ii(c, d, a, b, x[i+14], 15, -1416354905);
    b = md5_ii(b, c, d, a, x[i+ 5], 21, -57434055);
    a = md5_ii(a, b, c, d, x[i+12], 6 ,  1700485571);
    d = md5_ii(d, a, b, c, x[i+ 3], 10, -1894986606);
    c = md5_ii(c, d, a, b, x[i+10], 15, -1051523);
    b = md5_ii(b, c, d, a, x[i+ 1], 21, -2054922799);
    a = md5_ii(a, b, c, d, x[i+ 8], 6 ,  1873313359);
    d = md5_ii(d, a, b, c, x[i+15], 10, -30611744);
    c = md5_ii(c, d, a, b, x[i+ 6], 15, -1560198380);
    b = md5_ii(b, c, d, a, x[i+13], 21,  1309151649);
    a = md5_ii(a, b, c, d, x[i+ 4], 6 , -145523070);
    d = md5_ii(d, a, b, c, x[i+11], 10, -1120210379);
    c = md5_ii(c, d, a, b, x[i+ 2], 15,  718787259);
    b = md5_ii(b, c, d, a, x[i+ 9], 21, -343485551);

    a = safe_add(a, olda);
    b = safe_add(b, oldb);
    c = safe_add(c, oldc);
    d = safe_add(d, oldd);
  }
  return Array(a, b, c, d);

}

/*
 * These functions implement the four basic operations the algorithm uses.
 */
function md5_cmn(q, a, b, x, s, t)
{
  return safe_add(bit_rol(safe_add(safe_add(a, q), safe_add(x, t)), s),b);
}
function md5_ff(a, b, c, d, x, s, t)
{
  return md5_cmn((b & c) | ((~b) & d), a, b, x, s, t);
}
function md5_gg(a, b, c, d, x, s, t)
{
  return md5_cmn((b & d) | (c & (~d)), a, b, x, s, t);
}
function md5_hh(a, b, c, d, x, s, t)
{
  return md5_cmn(b ^ c ^ d, a, b, x, s, t);
}
function md5_ii(a, b, c, d, x, s, t)
{
  return md5_cmn(c ^ (b | (~d)), a, b, x, s, t);
}

/*
 * Calculate the HMAC-MD5, of a key and some data
 */
function core_hmac_md5(key, data)
{
  var bkey = str2binl(key);
  if(bkey.length > 16) bkey = core_md5(bkey, key.length * chrsz);

  var ipad = Array(16), opad = Array(16);
  for(var i = 0; i < 16; i++)
  {
    ipad[i] = bkey[i] ^ 0x36363636;
    opad[i] = bkey[i] ^ 0x5C5C5C5C;
  }

  var hash = core_md5(ipad.concat(str2binl(data)), 512 + data.length * chrsz);
  return core_md5(opad.concat(hash), 512 + 128);
}

/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally
 * to work around bugs in some JS interpreters.
 */
function safe_add(x, y)
{
  var lsw = (x & 0xFFFF) + (y & 0xFFFF);
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
  return (msw << 16) | (lsw & 0xFFFF);
}

/*
 * Bitwise rotate a 32-bit number to the left.
 */
function bit_rol(num, cnt)
{
  return (num << cnt) | (num >>> (32 - cnt));
}

/*
 * Convert a string to an array of little-endian words
 * If chrsz is ASCII, characters >255 have their hi-byte silently ignored.
 */
function str2binl(str)
{
  var bin = Array();
  var mask = (1 << chrsz) - 1;
  for(var i = 0; i < str.length * chrsz; i += chrsz)
    bin[i>>5] |= (str.charCodeAt(i / chrsz) & mask) << (i%32);
  return bin;
}

/*
 * Convert an array of little-endian words to a string
 */
function binl2str(bin)
{
  var str = "";
  var mask = (1 << chrsz) - 1;
  for(var i = 0; i < bin.length * 32; i += chrsz)
    str += String.fromCharCode((bin[i>>5] >>> (i % 32)) & mask);
  return str;
}

/*
 * Convert an array of little-endian words to a hex string.
 */
function binl2hex(binarray)
{
  var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
  var str = "";
  for(var i = 0; i < binarray.length * 4; i++)
  {
    str += hex_tab.charAt((binarray[i>>2] >> ((i%4)*8+4)) & 0xF) +
           hex_tab.charAt((binarray[i>>2] >> ((i%4)*8  )) & 0xF);
  }
  return str;
}

/*
 * Convert an array of little-endian words to a base-64 string
 */
function binl2b64(binarray)
{
  var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
  var str = "";
  for(var i = 0; i < binarray.length * 4; i += 3)
  {
    var triplet = (((binarray[i   >> 2] >> 8 * ( i   %4)) & 0xFF) << 16)
                | (((binarray[i+1 >> 2] >> 8 * ((i+1)%4)) & 0xFF) << 8 )
                |  ((binarray[i+2 >> 2] >> 8 * ((i+2)%4)) & 0xFF);
    for(var j = 0; j < 4; j++)
    {
      if(i * 8 + j * 6 > binarray.length * 32) str += b64pad;
      else str += tab.charAt((triplet >> 6*(3-j)) & 0x3F);
    }
  }
  return str;
}






function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}





function linkify(inputText) {
	var replaceText, replacePattern1, replacePattern2, replacePattern3;

	
	replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
	replacedText = inputText.replace(replacePattern1, '<a rel="nofollow" href="$1" target="_blank">$1</a>');

	replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
	replacedText = replacedText.replace(replacePattern2, '$1<a rel="nofollow" href="http://$2" target="_blank">$2</a>');
	
	return replacedText
}

function URLShort(inputString,StrLength){
	
	if (StrLength==undefined || StrLength ==''){
		StrLength==25;
	}
	if (inputString.length>StrLength){
		inputString = inputString.substr(0,StrLength)+'...'+inputString.substr(-10);
	}
	return inputString;
	
}

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function nameCap(str){
    var strLower = str.toLowerCase();
    var newStr = strLower.split(" ");
    for (x in newStr){
        //may need to check for 'AND' and not upper case that
        newStr[x] = (newStr[x].substr(0,1)).toUpperCase()+newStr[x].substr(1);
    }
    return newStr.join(" ");
}

function formatCurrency(num) {
    num = isNaN(num) || num === '' || num === null ? 0.00 : num;
    return parseFloat(num).toFixed(2);
}