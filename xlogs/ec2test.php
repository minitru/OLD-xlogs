<?php 

include "/home/sean/cc/aws_test.php";

date_default_timezone_set('UTC');

$key1="";
$sec1="";
$region="";

if ($_REQUEST["key1"]) $key1=$_REQUEST["key1"];
if ($_REQUEST["sec1"]) $sec1=$_REQUEST["sec1"];

/* 
 * WE'RE BEING CALLED FROM THE WEB 
 */
if ($key1) {
	$key1=str_replace(" ", "+", $key1);
	$sec1=str_replace(" ", "+", $sec1);

	$client=$key1;
	$public_key=$key1;
	$private_key=$sec1;
}
else {	/* STATIC VERSON */
	# JOSH
	$client="josh";
	$public_key="";
	$private_key="";

	# SEAN
	$client="sean";
	$public_key="";
	$private_key="";

	# ANGEL
	$client="angel";
	$public_key="";
	$private_key="";


}
	$params=array("Action"=>"DescribeRegions");	// EC2
	// THIS IS THE BASIC UNIT OF MEASURE FOR THIS TEST
	$unit='//a:instanceId';			
	// THIS IS WHAT THAT BASIC UNIT IS ENCLOSED WITHIN SO WE CAN LOOP
	$iterator='//a:reservationSet/a:item';
	// NAMESPACE FOR EC2
	$ns='http://ec2.amazonaws.com/doc/2010-11-15/';

	/*
 	* IT WORKS IF YOU REGISTER THE NAMESPACE AND CALL WITH THE REGISTERED
 	* PREFIX.  I VOTE FOR MAKING IT GO AWAY.  BUT AT LEAST I GET IT
 	*/
	$out=aws_signed_request($region, $params, $public_key, $private_key);
	if ($out === FALSE) {
		echo "      <CENTER><FONT COLOR=red>ERROR: INVALID KEY - TRY AGAIN</FONT></CENTER>";
		exit;
	}
?>
