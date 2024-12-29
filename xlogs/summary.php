<?php
require_once 'include/db.php';
require_once 'include/checksession.php';
require_once "include/getreg.php";
require_once "/home/sean/cc/func.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="xlogs provides logfiles for Amazon Web Services instances AWS as well as usage optimization and securtiy alerts" />
<meta name="keywords" content="free, logfiles, AWS, Amazon Web Services, monitoring, metrics, cost, savings, reserved instances strategy, cloud change alert, monthly spend" />
<link rel="canonical" href="http://www.tickletrunk.ca/" />

<title>xlogs - logfiles for Amazon AWS EC2</title>
	<link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon">

<link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200' rel='stylesheet' type='text/css'>

<link rel="stylesheet" media="screen" href="xlogs.css" />
<link rel="stylesheet" media="screen" href="basic.css" />
<link rel="stylesheet" media="screen" href="dialog.css" />

<!-- Demo Scripts -->
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="spin.js"></script>

<!-- Load jQuery, SimpleModal and Basic JS files -->
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/basic.js'></script>

<script type="text/javascript">
function DoScan(num, ip)
{

var target = document.getElementById(num);
                    $('#'+num).html("");
var spinner = new Spinner().spin(target);

	// alert("NUM: " + num + "IP: " + ip);
    $.ajax({
         type: "POST",
         url: "scan.php",
         data: "ip=" + ip + "&num=" + num,
         success: function(msg){
                    //show the success message
			// alert(msg.length);
			if (msg.length == 0) {
				msg="No ports appear to be open";
			}
                    	$('#'+num).html(msg);
                  }
    });
}
</script>

<script type="text/javascript">
function loadImg(img) {
	var fullimg = "<IMG SRC=snaps/" + img + ".png>";
	// alert(fullimg);
	$.modal(fullimg); // HTML
}
</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32405203-1']);
  _gaq.push(['_trackPageview']);

  function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<BODY>
<A HREF="https://xlo.gs"><div id="logo"><IMG SRC="xlogs.png" VALIGN=middle>xlogs</div></A>

<ul id="list-nav">
<li><a href="index.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="savings.php">Savings</a></li>
<li><a href="summary.php">Summary</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>


<div id="demo-header">
<div id="login-link">
<?php include "include/loginbutton.php"; ?>
</div>
</div><!-- /demoheader -->
        <br class="clear" /><br /><br /><br />
        <div id="content">
            <h1 class="pagehead"><div class="xl">xlogs:</div> EC2 What's Running? ... Hint: hit Scan Now and mouseover the blue links<BR></h1>


<?php

require_once "include/getreg.php";
require_once "include/awsprices.php";

if ($argc == 2) $id=$argv[1];
else if (isset($_SESSION['id'])) {
	$id= $_SESSION['id'];
	$client = $_SESSION['key1'];
}
else {
	// SMM TEST
	$id=2;
	$client="AKIAJ4W574IJXT4UCGCA";
}

	echo "<table id=xtab width=100% border=2 CELLPADDING=10>";

        // AND EACH SERVICE HAS IT'S OWN NAMESPACE
        $params=array("Action"=>"DescribeInstances");   // EC2
        // THIS IS THE BASIC UNIT OF MEASURE FOR THIS TEST
        $unit='//a:instanceId';
        // THIS IS WHAT THAT BASIC UNIT IS ENCLOSED WITHIN SO WE CAN LOOP
        $iterator='//a:reservationSet/a:item';
        // NAMESPACE FOR EC2
        $ns='http://ec2.amazonaws.com/doc/2010-11-15/';

$regions=getregions($client);	// GET THE REGIONS TO TEST

foreach ($regions as  $reg => $region) {
	# print "$reg IS $region\n";

	# LOAD OUR LAST FILE
	$lastlog='/home/sean/cc/data/' . $client . "-" . $reg . ".xml";
	// print "LASTLOG $lastlog<BR>";

	if (file_exists($lastlog)) {
		$xml1 = simplexml_load_file($lastlog);
	}
	else {
		$xml1="";
	}
	$xml1->registerXPathNamespace( 'a', $ns);

	$xml1->asXML();	 	// PREVIOUS - SO WE CAN COMPARE 3

	// LETS LOOK FOR CHANGES
	// THIS GRABS ALL OUR ITEMS TO CHECK
	$old = $xml1->xpath($iterator);
	$oldcount = count($old);
	// print "COUNT: OLD $oldcount\n";
	
	// print_r($result);
	
	// GO THROUGH ITEMS ONE BY ONE
	$x=0;
	for ($n1 = 0; $n1 < $oldcount; $n1++ ) {
		$oldxml = $old[$n1]->asXML();
  		$oldinst = new SimpleXMLElement($oldxml);

		$type=getval($oldinst, '//instanceType');
		$nickname=getval($oldinst, '//item/value');
		$state=getval($oldinst, '//instanceState/name');
		$launch=getval($oldinst, '//launchTime');
		// LETS SEE IF WE CAN FIGURE OUT A TIME IN HOURS AND A PRICE

		$oldiname=getval($oldinst, '//instanceId');
		$ipaddr=getval($oldinst, '//ipAddress');
		if ($state == "running") {
			$x++;
			$runtime = round((time() - strtotime($launch))/3600);  
			$cost = $price[chop($type)] * $runtime;
			$cost = sprintf("%01.2f", $cost);

			echo "<TR><TD class=xtcell>$x</TD><TD WIDTH=30% class=xtcell><H2><div class=xl2>$nickname<BR><div id=cost>$$cost</div></H2></TD>";
			echo "<TD class=xtcell><H2>[$type]<BR>$runtime hours<BR></H2></TD>";
			echo "<TD class=xtcell><H2>$oldiname<BR>$ipaddr</H2></TD>";
			echo "<TD WIDTH=40% class=xtcell><div id=$x><a href=\"javascript:void(0)\" OnClick=DoScan(\"$x\",\"$ipaddr\");> Scan Now</A></div></TD></TR>";
		}
	}
}
?>
        <!-- /content -->

        <div id="footer">
        </div><!-- /footer -->
    </BODY>
</html>
