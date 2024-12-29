    //if submit button is clicked
    $('#submit').click(function () {       
	alert("MADE IT HERE");
        //Get the data from all the fields
        var key1 = $('input[name=key1]');
        var sec1 = $('input[name=sec1]');
	//
	// TACK ON CHECKPOXES
	var notify;
	$("input[name='notify']:checked").each(function(i) {
		if (notify) notify = notify + "," + ($(this).val());
		else notify = ($(this).val());
	});

	// THE SERIALIZATION SHOULD BE AUTOMATIC
	if (notify) {
		alert("NOTIFY: " . notify);
		var data = 'id=' + id  + '&notify=' + notify;
	}
	else {
		var data = 'key1=' + key1.val() + '&sec1=' + sec1.val() + '&id=' + id;
		alert("DATA: " . data);
	}

        //disabled all the text fields
        $('.text').attr('disabled','true');
        //show the loading sign
        $('.loading').show();
        //start the ajax
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "savekeys.php",
            type: "POST",
            //pass the data        
            data: data,    
            //Do not cache the page
            cache: false,
            //success
            success: function (msg) {             
                if (msg.indexOf("JUMP:") != -1) {
                        msg = msg.substr(6);    // SKIP ERROR
			window.location.href=msg;
                }

                if (msg.indexOf("ERROR:") != -1) {
                        msg = msg.substr(7);    // SKIP ERROR
                        document.getElementById('hdr').innerHTML = msg;
                }
                else {
                    //hide the form
                    $('#c2').fadeOut('slow');                
                    //show the success message
    		    $('#c2').html(msg);
                    $('#c2').fadeIn('slow');
		}
	    }
        });
        //cancel the submit button default behaviours
        return false;
    });
