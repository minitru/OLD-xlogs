$(document).ready(function(){
    //if submit button is clicked
    $('#submit').click(function () {       
        //Get the data from all the fields
        var email = $('input[name=email]');
        var passwd = $('input[name=passwd]');
        var passwd2 = $('input[name=passwd2]');
        var fname = $('input[name=fname]');
        var lname = $('input[name=lname]');
        var authcode = $('input[name=authcode]');
        var action = $('input[name=action]');
	fn = $('#submit').get(0).form.name;

	// alert(action.val());

	if (fn == "login") {
		// alert("IN LOGIN");
		if ((email.val().indexOf('.')) == -1){
			email.closest('.control-group').addClass('error');
			msg="Please enter a valid email address";
			document.getElementById('hdr').innerHTML = msg;
            		return false;
		}
		if ((email.val().indexOf('@')) == -1){
			email.closest('.control-group').addClass('error');
			msg="Please enter a valid email address";
			document.getElementById('hdr').innerHTML = msg;
            		return false;
		}
        	if (email.val()=='') {
			email.closest('.control-group').addClass('error');
			msg="Please enter a valid email address";
			document.getElementById('hdr').innerHTML = msg;
            		return false;
        	} else email.closest('.control-group').removeClass('error');

        	if (passwd.val()=='') {
			msg="Please enter your password";
			document.getElementById('hdr').innerHTML = msg;
			passwd.closest('.control-group').addClass('error');
            		return false;
        	} else passwd.closest('.control-group').removeClass('error');

        	var data = 'email=' + email.val() + '&passwd=' + passwd.val();
	}
	else if (fn == "signup2")  {	// JUST GET THE EMAIL ADDRESS IF IT'S A SIGNUP
		//alert("IN SIGNUP2");
        	//Simple validation to make sure user entered something
        	//If error found, add highlight class to the text field
        	if (fname.val()=='') {
			msg="Please enter your first name";
			document.getElementById('hdr').innerHTML = msg;
			fname.closest('.control-group').addClass('error');
            		return false;
        	} else fname.closest('.control-group').removeClass('error');
         	
        	if (lname.val()=='') {
			msg="Please enter your last name";
			document.getElementById('hdr').innerHTML = msg;
			lname.closest('.control-group').addClass('error');
            		return false;
        	} else lname.closest('.control-group').removeClass('error');
         	
        	if (passwd.val()=='') {
			msg="Please choose a password";
			document.getElementById('hdr').innerHTML = msg;
			passwd.closest('.control-group').addClass('error');
            		return false;
        	} else passwd.closest('.control-group').removeClass('error');
         
        	if (passwd.val()!=passwd2.val()) {
			msg="Passwords don't match, try again";
			document.getElementById('hdr').innerHTML = msg;
			passwd2.closest('.control-group').addClass('error');
            		return false;
        	} else passwd2.closest('.control-group').removeClass('error');
         
        	//organize the data properly
		// THE SERIALIZATION SHOULD BE AUTOMATIC
		if (action.val() == "lostpw") {
        		var data = 'email=' + email.val() + '&passwd=' + passwd.val() + "&authcode=" + authcode.val() + "&action=lostpw";
			// alert("LASTPW " . data);
		}
		else {
			// alert("NO LASTPW " . data);
        		var data = 'email=' + email.val() + '&passwd=' + passwd.val() + '&fname=' + fname.val() + '&lname=' + lname.val() + "&authcode=" + authcode.val();
		}

		// alert("DATA PART DEUX: " +  data);
	}
	else if (fn == "signup")  {	// JUST GET THE EMAIL ADDRESS IF IT'S A SIGNUP
		// alert("IN SIGNUP");
		if ((email.val().indexOf('.')) == -1){
			email.closest('.control-group').addClass('error');
			msg="Please enter a valid email address";
			document.getElementById('hdr').innerHTML = msg;
            		return false;
		}
		if ((email.val().indexOf('@')) == -1){
			email.closest('.control-group').addClass('error');
			msg="Please enter a valid email address";
			document.getElementById('hdr').innerHTML = msg;
            		return false;
		}
        	if (email.val()=='') {
			email.closest('.control-group').addClass('error');
			msg="Please enter a valid email address";
			document.getElementById('hdr').innerHTML = msg;
            		return false;
        	} else email.closest('.control-group').removeClass('error');

		// alert("OFF THE BOTTOM " + action.val());

		if (action.val()) {
        		var data = 'email=' + email.val() + "&action=lostpw";
			// alert("LASTPW2 " + data);
		}
		else {
			// alert("NO LASTPW2");
			// SMM TEST INVITE CODE
			// var data = 'email=' + email.val() + "&action=invite";
			var data = 'email=' + email.val();
		}

		// alert("OFF THE BOTTOM 2 " + action.val());
	}
	else return false;

	// alert("OFF THE BOTTOM 2");
         
        //disabled all the text fields
        $('.text').attr('disabled','true');
         
        //show the loading sign
        $('.loading').show();
         
        //start the ajax
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "process.php",
             
            type: "POST",
 
            //pass the data        
            data: data,    
             
            //Do not cache the page
            cache: false,
             
            //success
            success: function (msg) {             
                if (msg.indexOf("JUMP:") != -1) {
                        msg = msg.substr(7);    // SKIP JUMP
			// alert("JUMP: " . msg);
			window.location.href=msg;
                }

                if (msg.indexOf("ERROR:") != -1) {
                        msg = msg.substr(8);    // SKIP ERROR
                        document.getElementById('hdr').innerHTML = msg;
                }
                else { // SUCCESS
                	if (msg.indexOf("MSG:") != -1) {
                        	msg = msg.substr(6);    // SKIP MSG
                        	document.getElementById('hdr').innerHTML = msg;
			}
			else {
                    		//hide the form
                    		$("#myform").fadeOut('fast');                

                    		//show the success message
    		    		$('.done').html(msg);
		
                    		$('.done').fadeIn('slow');
			}
		}
	    }
        });
         
        //cancel the submit button default behaviours
        return false;
    });
}); 

