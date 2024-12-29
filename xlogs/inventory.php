<?php 

/* DYNNAMIC VERSION 
   POLLS AND DISPLAYS IN ONE SHOT
 * FOR THE MANAGEMENT SCREEN
*/

error_reporting (E_ALL ^ E_NOTICE); 	/* SUPRESS NOTICES */

require_once "/home/sean/cc/aws_test.php";
require_once "/home/sean/cc/diffXML.php";
require_once "/home/sean/cc/func.php";

require_once "include/db.php";
require_once "include/getreg.php";


date_default_timezone_set('UTC');

logger("CALLING inventory.php");

$key1="";
$sec1="";

if ($key) {			# CALLED INTERNALLY 
	$key1=$key;
	$sec1=$sec;
	logger("CALLING FROM cron [$key]");
}
else if ($argv[1]) {		# CALLED FROM THE COMMAND LINE
	$key1=$argv[1];
	$sec1=$argv[2];
	logger("CALLING FROM view.php [$key1]");
}
# THIS ISN'T QUITE RIGHT.  ON INIT THE KEYS ARE BLANK BUT WE'RE CALLED FROM A WEBPAGE
else if (isset($_SERVER['REMOTE_ADDR'])) {
	require_once 'include/checksession.php';
	$ip=$_SERVER['REMOTE_ADDR'];
	if (isset($_SESSION['key1'])) {
		$key1 = $_SESSION['key1'];
		$sec1 = $_SESSION['sec1'];
		logger("dyn REQUEST FROM SESSION ON $ip $key1");
	}
	else if ($_REQUEST["key1"]) {
		if ($_REQUEST["key1"]) $key1=$_REQUEST["key1"];
		if ($_REQUEST["sec1"]) $sec1=$_REQUEST["sec1"];
		logger("dyn REQUEST FROM POST ON $ip $key1");
	}
	else {
		logger("ERROR KEYS NOT SET");
		#print ("ERROR: Please register your AWS keys");
		print '{ "aaData": [ ["2012-01-01 00:00:00", "***", "ERROR", "NO KEYS", "", "-", "-", "PLEASE REGISTER YOUR AWS KEYS BELOW"] ] }';
		exit;
	}
}
else {
	logger("CALLING FROM SOMEWHERE WE SHOULDN'T BE");
}
if ($key1) {
	$key1=str_replace(" ", "+", $key1);
	$sec1=str_replace(" ", "+", $sec1);

	$client=$key1;
	$public_key=$key1;
	$private_key=$sec1;
}
else {	/* STATIC VERSON */
	# JOSH
	# print "CALLING STATIC VERSION";
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

$logname="/var/www/xlogs/log/" . $client . ".log";
$logfile=fopen($logname, 'a+');

$date="";		// SMM SHARED
$nickname="";
$type="";		// INSTANCE TYPE <instanceType>t1.micro</instanceType>
$region="";

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
	# print "LASTLOG $lastlog<BR>";

	if (file_exists($lastlog)) {
		$xml1 = simplexml_load_file($lastlog);
	}
	$xml1->registerXPathNamespace( 'a', $ns);

	//$xml1->asXML($lastlog);	 	// PREVIOUS - SO WE CAN COMPARE 3
	// WITH NO ARG DOESN'T WRITE OUTPUT XML FILE
	$xml1->asXML();	 	// PREVIOUS - SO WE CAN COMPARE 3

	// LETS LOOK FOR CHANGES
	// THIS GRABS ALL OUR ITEMS TO CHECK
	$old = $xml1->xpath($iterator);
	$oldcount = count($old);
	print "COUNT: OLD $oldcount\n";
	
	# print_r($result);
	
	// GO THROUGH ITEMS ONE BY ONE
	for ($n1 = 0; $n1 < $oldcount; $n1++ ) {
		print "ITEM $n1";
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
			$runtime = round((time() - strtotime($launch))/3600);  
			print "$type $nickname $oldiname $ipaddr $lauch $runtime\n";
		}
	}
}
fclose($logfile);
?>
