<?php

require_once 'include/db.php';
require_once "include/getreg.php";

// SMM TEST - IS THE DB EVEN AVAILBLE?

$link = mysql_connect('localhost', 'xlogs', 'doodoo69')
    or die('Could not connect: ' . mysql_error());
/*
echo 'Connected successfully';
*/
mysql_select_db('xlogs') or die('Could not select database');

// END SMM TEST


// WE'RE GOING TO TRAVERSE THESE FILES ONE AT A TIME
// IT WOULD BE NICE IF WE DO THE LEAST NUMBER OF PULLS (ONLY DELTAS)
// BUT MAKE IT WORK FIRST, THEN WORRY ABOUT THE REST OF THE CRAP

// FILE FORMAT: PUBLICKEY=REGION.xml
// AKIAJVT2QKGFJFSDP2QA-usw2.xml

//	http://www.ec2instances.info/

$gttl = 0;	// GRAND TOTAL
$boxttl = 0;	// HOW MANY INSTANCES?
$boxgttl = 0;	// TOTAL INSTANCES

// EVENT TIME
$phpdate = strtotime("now");
$statdate = date( 'Y-m-d H:i:s', $phpdate );

// print "ARGC = $argc\n";

if (isset($key)) $acct = $key;
else if ($argc == 2) $acct=$argv[1];
else $acct="AKIAJ4W574IJXT4UCGCA";

logger("in awsstats: KEY IS $acct");

$string = 'm1.small	m1.medium	m1.large	m1.xlarge	m3.xlarge	m2.2xlarge	t1.micro	m2.xlarge	m2.2xlarge	m2.4xlarge	c1.medium	c1.xlarge	cc1.4xlarge	cc2.8xlarge	cg1.4xlarge	h1.4xlarge';

$prices = '0.065	0.13	0.26	0.52	0.58	1.16	0.02	0.45	0.9	1.8	0.17	0.66	1.3	2.4	2.1	3.1';

$res = "0.038260274	0.076520548	0.153041096	0.306082192	0.335890411	0.673780822	0.012077626	0.205579909	0.411159817	0.822319635	0.097077626	0.388310502	0.76047032	0.931776256	1.273680365	1.452050228";

$res3 ="0.024415525	0.04883105	0.0976621	0.195324201	0.215456621	0.430913242	0.007359209	0.128980213	0.257960426	0.515920852	0.064490107	0.257960426	0.536726027	0.652856925	0.893162861	0.899047184";

$myresult = array();
$price = array();
$reserved = array();		// RESERVED ARRAY PRICES
$reserved3 = array();		// RESERVED ARRAY PRICES

$price = $myresult;		// ASSIGN THE LEFT SIDE

$reslist = explode('	', $res);
$reslist3 = explode('	', $res3);
$pricelist = explode('	', $prices);
$array = explode('	', $string);

$n=0;

foreach ($array as $chunk) {
  	$myresult[$chunk] = 0;
  	$price[$chunk] = $pricelist[$n];
  	$reslist[$chunk] = $reslist[$n];
  	$reslist3[$chunk] = $reslist3[$n];
	$n++;
}

// print "TESTING THANG $myresult['t1.micro']\n";

// NOW WE NEED TO DO IT FOR ALL THE REGION FILES UGH

$pattern = "/home/sean/cc/data/" . $acct . "*.xml";
foreach (glob($pattern) as $xmlfname) {

	$ttl = 0;
	$boxttl = 0;

	if (preg_match ("/PREV/", $xmlfname)) {
		# print "SKIPPING $xmlfname\n";
		continue;
	}

	if (preg_match ("/\-[^\.]*./", $xmlfname, $matches)) {
		// echo "MATCH: $matches[0]\n";
		$region=ltrim(rtrim($matches[0],'.'),'-');
		//echo "REGION: $region\n";
	}


	if (file_exists($xmlfname)) $xml = simplexml_load_file($xmlfname);
	else {
		echo "No data for $acct - exiting";
		exit;
	}
	
	if ( !$xml ){
    	exit('Failed to retrieve data.');
	}else{
    	foreach ( $xml->reservationSet->item AS $item){
		// $id = $item->{'reservationId'};
        	$type = $item->instancesSet->item->{'instanceType'};
        	$time  = $item->instancesSet->item->{'launchTime'};
        	$run  = $item->instancesSet->item->instanceState->{'name'};
	
		$size=(string) $type;
	
		// THIS WORKS
		// $myresult['t1.micro'] = 111;	// ME SO CLEVER
	
		if ($run == "running") {
			$myresult[$size]++ ;	// THIS WORKS TOO NEEDS STRING CAST
			// echo "ID: $id TYPE: [$type] ($time) $run COUNT $myresult[$size]\n";
		}
    	}
	}
	
	foreach ($array as $chunk) {
	//	print "HERE $chunk\n";
		if ($myresult[$chunk]) {		// IF THERES A COUNT
			$monthly =round($myresult[$chunk] * $price[$chunk] * 24 * 30, 2);
			$disc1 = round($myresult[$chunk] * $reslist[$chunk] * 24 * 30, 2);
			$disc3 = round($myresult[$chunk] * $reslist3[$chunk] * 24 * 30, 2);
			// print "$myresult[$chunk] $chunk -> $price[$chunk] $reslist[$chunk]\n";
			// UNCOMMENT FOR DETAILS
			// print "$myresult[$chunk] $chunk -> $monthly $disc1 $disc3\n";
			if (isset($key)) {
				$query = "INSERT INTO awsstats (id, statdate, region, type, count, cost)
				VALUES ('$id', '$statdate', '$region', '$chunk', '$myresult[$chunk]', '$monthly')";
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			}
			$ttl = $ttl + $monthly;
			$boxttl = $boxttl + $myresult[$chunk];
		}
	}
	$boxgttl = $boxgttl + $boxttl;
	$gttl = $gttl + $ttl;
	$ttl = sprintf("%01.2f", $ttl); // << this does the trick!
	if (isset($region) && $boxttl) {
		if (isset($key)) {
			$query = "INSERT INTO awsstats (id, statdate, region, type, count, cost)
			VALUES ('$id', '$statdate', '$region', 'all', '$boxttl', '$ttl')";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		}
		else print "<div id='boxttl'>EC2:$region ($boxttl instances) $$ttl</div>\n";
	}
}
$gttl = sprintf("%01.2f", $gttl); // << this does the trick!

if (isset($key)) {
	$query = "INSERT INTO awsstats (id, statdate, region, type, count, cost)
	VALUES ('$id', '$statdate', 'all', 'all', '$boxgttl', '$gttl')";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
}
else print "<div id='spendttl'>TOTAL ($boxgttl instances) $$gttl</div>\n";
?>
