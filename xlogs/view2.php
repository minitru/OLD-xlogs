<?php
require_once 'include/db.php';
require_once 'include/checksession.php';
/*
if ($_REQUEST["accesskey"]) $pub=$_REQUEST["accesskey"];
if ($_REQUEST["secretkey"]) $pri=$_REQUEST["secretkey"];
*/
$key1=$_SESSION['key1'];
$sec1=$_SESSION['sec1'];

$key1=str_replace(" ", "+", $key1);
$sec1=str_replace(" ", "+", $sec1);
$run="https://xlo.gs/dyn.php?key1=" . $key1 . "&"  . "sec1=" . $sec1;
// print "PUB: $pub, PRI=$pri RUN=$run<BR>\n";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>xlogs | logfiles for Amazon AWS EC2</title>
<link rel="shortcut icon" href="xlogs.png" />
<link rel="stylesheet" media="screen" href="xlogs.css" />

<link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200' rel='stylesheet' type='text/css'>

<style type="text/css" title="currentStyle">
	@import "dt/media/css/demo_page.css";
       	@import "dt/media/css/demo_table.css";
</style>

<!-- Demo Scripts -->
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" language="javascript" src="dt/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="dt/extras/TableTools/media/js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="dt/extras/TableTools/media/js/TableTools.js"></script>
<script type="text/javascript" src="dygraph-combined.js"></script>
<script type="text/javascript">
	var $run = "<?php  echo $run; ?>";
	if ($run == "") $run = "https://xlo.gs/dyn.php";
</script>


<link rel="stylesheet" type="text/css" href="xxx/source/css/style.css" media="screen" />

<!-- ANIMATE AND EASING LIBRARIES -->
<script type="text/javascript" src="services-plugin/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="services-plugin/js/jquery.cssAnimate.mini.js"></script>

<!-- TOUCH AND MOUSE WHEEL SETTINGS -->
<script type="text/javascript" src="services-plugin/js/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="services-plugin/js/jquery.mousewheel.min.js"></script>

<!-- jQuery SERVICES Slider -->
<script type="text/javascript" src="services-plugin/js/jquery.themepunch.services.js"></script>
<link rel="stylesheet" type="text/css" href="services-plugin/css/settings.css" media="screen" />

<script type="text/javascript">
$(document).ready(function(){
    //if submit button is clicked
     $(".savekeys, .notify, .invite").submit(function() { return false; });        // DISABLE THE SUBMIT KEY
    $(".savekeys, .notify, .invite").submit(function() {	// ENABLE IT FOR BOTH CLASSES

	// alert("WE MADE IT HERE");

        //Get the data from all the fields
        var email = $('input[name=email]');
        var key1 = $('input[name=key1]');
        var sec1 = $('input[name=sec1]');
	var notify="";
	var msgloc="";
        $("input[name='notify']:checked").each(function(i) {
                // alert("NOTIFY: " . notify);
                if (notify) notify = notify + "," + ($(this).val());
                else notify = ($(this).val());
        });

        // THE SERIALIZATION SHOULD BE AUTOMATIC
	if (email.val()) {
		//alert("IN INVITE");
		msgloc="hdrinvite";
		myurl="process.php?action=invite";
		var data = 'email=' + email.val();
	}
	else if (notify) {
		//alert("IN NOTIFY");
		msgloc="hdrnotify";
		myurl="savekeys.php";
		var data = 'notify=' + notify + '&id=' + <?php echo $id ?>;
	}
	else {
		//alert("KEY CHANGE");
		msgloc="hdr";
		myurl="savekeys.php";
		var data = 'key1=' + key1.val() + '&sec1=' + sec1.val() + '&id=' + <?php echo $id ?>;
	}

        // THE SERIALIZATION SHOULD BE AUTOMATIC
        // var data = 'key1=' + key1.val() + '&sec1=' + sec1.val() + '&id=' + <?php echo $id ?>;

        //show the loading sign
        $('.loading').show();
        //start the ajax
        $.ajax({
            //this is the php file that processes the data and send mail
            url: myurl,
            type: "POST",
            //pass the data        
            data: data,
            //Do not cache the page
            cache: false,
            //success
            success: function (msg) {
		//alert(msg);
                if (msg.indexOf("JUMP") != -1) {
                        msg = msg.substr(5);    // SKIP ERROR
                        window.location.href=msg;
                }
                else if (msg.indexOf("MSG") != -1) {
                        msg = msg.substr(6);    // GET THE MESSAGE
                        document.getElementById(msgloc).innerHTML = msg;
                }
                else if (msg.indexOf("ERROR") != -1) {
			// alert("CALLING ERROR");
                        msg = msg.substr(6);    // SKIP ERROR
                        document.getElementById(msgloc).innerHTML = msg;
                }
                else {
                    //hide the form
                    $('#c2').fadeOut('fast');
                    //show the success message
                    $('#c2').html(msg);
                    $('#c2').fadeIn('slow');
                }
            }
        });
        //cancel the submit button default behaviours
        return false;
    });

    $('#example').dataTable( {
        "sDom": '<"top"i>lrt<"bottom">f<"#filter"T><"clear">',
        "sScrollY": "250px",
        "bPaginate": false,
        "bProcessing": true,
        "oTableTools": {
            "sSwfPath": "/dt/tt/media/swf/copy_csv_xls_pdf.swf",
        },
        "aaSorting": [[ 0, "desc" ]],
                "aoColumns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null
                ],
        "sAjaxSource": $run
    } );

        jQuery('#services-example-1').services(
        {
                width:920,
                height:140,
                slideAmount:3,
                slideSpacing:20,
                carousel:"off",
                touchenabled:"off",
                mouseWheel:"on",
                slideshow:5000,
                transition:0,
                callBack:function() {}
        });
} );

</script>
</head>
    <body>
<A HREF="https://xlo.gs"><div id="logo"><IMG SRC="xlogs.png" VALIGN=middle>xlogs</div></A>

<ul id="list-nav">
<li><a href="index.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>

<div id="demo-header">
<div id="login-link">
	<?php include "include/loginbutton.php";?>
</div>
</div><!-- /demoheader -->

        <br class="clear" /><br /><br /><br />
        <div id="content">
            <h1 class="pagehead"><div class="xl">xlogs:</div> Welcome 
<?php echo "$fname... "; 
if ($key1) {
	include "/var/www/xlogs/chart.php";
	include "/var/www/xlogs/spend.php";
	//echo "Here are your transactions from Amazon EC2";
}
else {
	echo "Please enter your AWS access keys in the box at the bottom of the screen";
}
?></h1>
            <div class="description">
        <div id="dynamic" style="font-weight: regular; font-family: 'Ubuntu Mono', sans-serif;">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
        <thead>
                <th width="100%" colspan=8>
                        <div  style="font-family: 'Yanone Kaffeesatz', sans-serif;"> <h2>Recent transactions: <B>Amazon AWS EC2</B></H2> </div>
                </th>
                <tr>
                        <th width="22%">Date</th>
                        <th width="2%">From</th>
                        <th width="7%">Instance</th>
                        <th width="7%">Action</th>
                        <th width="5%">Type</th>
                        <th width="6%">Runtime</th>
                        <th width="4%">Cost</th>
                        <th width="50%">Comments</th>
                </tr>
        </thead>
        <tbody>

        </tbody>
</table>
<BR><BR>
            </div> <!-- /dynamic -->
           </div><!-- /desc -->

			<div class="example-wrapper">
					<div id="services-example-1" class="theme1">
						<ul>
							<li><div class="xcell">

<h2><div class=xl2>xlogs:</div> View Spending Trends</h2>
<div id="graphdiv2" style="width:280px; height:100px;"></div>
<script type="text/javascript">
  g2 = new Dygraph(
    document.getElementById("graphdiv2"),
   "/cdata/<?php echo $id;?>", // path to CSV file
   {
      rollPeriod: 7,
        gridLineColor: 'orange',
        strokeWidth: 3
}          // options
  );
</script>
</div>
									<div  class="closer"></div>
							</li>


							<!--	###############		-	SLIDE 2	-	###############	 -->
        <li><div class="xcell">
<?php
if (! $key1) print "<h2><div class=xl2>xlogs:</div>Register your keys</h2>";
else print "<h2><div class=xl2>xlogs:</div> Update your EC2 keys</h2>";
?>
<div id='hdr'>Please... Use keys with Read-Only access!</div>
<BR>

<form action="https://xlo.gs/savekeys.php" method="POST" id="save" class="savekeys">
<div class=field><label>Access Key:</label> <input type="text" name="key1" /></div>
<div class=field><label>Secret Key:</label> <input type="password" name="sec1" />
<input type="hidden" name="id" value=<?php echo $id;?> >
<input id="submit" type="submit" name="submit" value="Go"></form></div>
									<div  class="closer"></div>
							</li>
							<!--	###############		-	SLIDE 3	-	###############	 -->
 <li><div class="xcell">
          <h2><div class=xl2>xlogs:</div> Get Change Alerts</h2>
<div id='hdrnotify'></div>
<form action="https://xlo.gs/savekeys.php" method="POST" id="notify" class="notify">
<input type="checkbox" name="notify" value="recent"> As soon as possible<br>
<input type="checkbox" name="notify" value="daily"> Daily <BR>
<input type="checkbox" name="notify" value="weekly"> Weekly<BR>
<input type="checkbox" name="notify" value="monthly"> Monthly
<input type="hidden" name="id" value=<?php echo $id;?> >
<input id="submit" type="submit" name="submit" class="notify" value="Go"></div>
</form>
									<div  class="closer"></div>
							</li>

							<!--	###############		-	SLIDE 4	-	###############	 -->

 <li><div class="xcell">
          <h2><div class=xl2>xlogs:</div> Securely share this view</h2>
<div id="hdrinvite">Enter their email below - no access to your keys</div><BR>
   <form id="invite" method="post" class="invite" action="process.php?action=invite">
        <input id="signup" type="text" placeholder="Email" name="email">
<BR>
       <input type="submit" id="submit" value="Go"  class="invite">
       </form>
									<div  class="closer"></div>
							</li>

						</ul>

						<!--	###############		-	TOOLBAR (LEFT/RIGHT) BUTTONS	-	###############	 -->
						<div class="toolbar">
							<div class="left"></div><div class="right"></div>
						</div>
					</div>


        </div><!-- /content -->

 	<div id="footer">
 <script> (function(d, s, id) { bubble_bubble_autoshow_timer = 0; var js, hbjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = window.location.protocol + "//www.heybubble.com/vchat/frame/100292B642D48A83B6641B8453AD9BBD" + "?current_url=" + encodeURIComponent(window.location) + "&referer=" + encodeURIComponent(document.referrer); hbjs.parentNode.insertBefore(js, hbjs); }(document, 'script', 'heybubble-jssdk')); </script>
        </div><!-- /footer -->
    </body>
</html>
