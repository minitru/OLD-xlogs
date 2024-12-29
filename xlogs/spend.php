<?php

// GRAB STATS OUT OF THE LAST PULL FROM AWS DIRECTLY
// MORE OR LESS REAL TIME SPEND RATE

// FILE FORMAT: PUBLICKEY=REGION.xml
// AKIAJVT2QKGFJFSDP2QA-usw2.xml

//	http://www.ec2instances.info/
require_once "include/getreg.php";
require_once "include/awsprices.php";

$regionname=array();
$regionname=getregions($regionname);

$gttl = 0;	// GRAND TOTAL
$boxttl = 0;	// HOW MANY INSTANCES?
$boxgttl = 0;	// TOTAL INSTANCES

// print "ARGC = $argc\n";

if ($argc == 2) $acct=$argv[1];
else if (isset($_SESSION['key1'])) $acct = $_SESSION['key1'];
else {
	// $acct="AKIAJVT2QKGFJFSDP2QA";	 GARY
	// $acct="AKIAJ4W574IJXT4UCGCA";		// ANGEL
	$acct="AKIAJ7LPDR62QAB4YVCQ";		// SCANBUY
}
// print "TESTING THANG $result['t1.micro']\n";

// logger("spend.php SETTING ACCT TO [$id] $acct ");

// NOW WE NEED TO DO IT FOR ALL THE REGION FILES UGH

$pattern = "/home/sean/cc/data/" . $acct . "*.xml";
foreach (glob($pattern) as $xmlname) {

	$ttl = 0;
	$boxttl = 0;

	if (preg_match ("/PREV/", $xmlname)) {
		# print "SKIPPING $xmlname\n";
		continue;
	}

	if (preg_match ("/\-[^\.]*./", $xmlname, $matches)) {
		// echo "MATCH: $matches[0]\n";
		$region=ltrim(rtrim($matches[0],'.'),'-');
		// echo "REGION: $region\n";
	}

	// Failed to load data ERROR HERE - SOMEHOW AN EXTRA ";}" GETS APPENDED TO THE XML FILE....
	// THERES A BUG IN THERE 
	// HAPPENS AFTER FAILED savings.php
	if (file_exists($xmlname)) {
		$xml = simplexml_load_file($xmlname);
	}
	else {
		echo "No data for $acct - exiting";
		exit;
	}
	
	if ( !$xml ){
    		exit('Failed to retrieve data.');
	}
	else {
    	foreach ( $xml->reservationSet->item AS $item){
		$res = $item->{'reservationId'};
        	$type = $item->instancesSet->item->{'instanceType'};
        	$time  = $item->instancesSet->item->{'launchTime'};
        	$run  = $item->instancesSet->item->instanceState->{'name'};
	
		$size=(string) $type;
	
		// THIS WORKS
		// $result['t1.micro'] = 111;	// ME SO CLEVER
	
		if ($run == "running") {
			$result[$size]++ ;	// THIS WORKS TOO NEEDS STRING CAST
			 // echo "ID: $id TYPE: [$type] ($time) $run COUNT $result[$size]\n";
		}
    	}
	}

	foreach ($array as $chunk) {
	//	print "HERE $chunk\n";
		if ($result[$chunk]) {		// IF THERES A COUNT
			$monthly =round($result[$chunk] * $price[$chunk] * 24 * 30, 2);
			$disc1 = round($result[$chunk] * $reslist[$chunk] * 24 * 30, 2);
			$disc3 = round($result[$chunk] * $reslist3[$chunk] * 24 * 30, 2);
			// print "$result[$chunk] $chunk -> $price[$chunk] $reslist[$chunk]\n";
			// UNCOMMENT FOR DETAILS
			// print "$result[$chunk] $chunk -> $monthly 	$disc1 	$disc3\n";
			$ttl = $ttl + $monthly;
			$boxttl = $boxttl + $result[$chunk];
		}
	}
	$boxgttl = $boxgttl + $boxttl;
	// print "$boxgttl $boxttl\n";
	$gttl = $gttl + $ttl;
	$ttl = sprintf("%01.2f", $ttl); // << this does the trick!
	$rname=$regionname[$region];
	// SMM UNCOMMENT FOR REGIONAL SUMMARIES
	// if (isset($region) && $boxttl) print "$boxttl instances in $rname: $ttl<BR>\n";
}
$gttl = sprintf("%01.2f", $gttl); // << this does the trick!
print " your $boxgttl running instances will cost $$gttl this month\n";
?>
