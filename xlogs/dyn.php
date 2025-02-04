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

logger("CALLING dyn.php");

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
	$public_key="XX";
	$private_key="XX";

	# ANGEL
	$client="angel";
	$public_key="XX";
	$private_key="XX";

	# SEAN
	$client="sean";
	$public_key="XX";
	$private_key="XX";
}

$logname="/var/www/xlogs/log/" . $client . ".log";
$logfile=fopen($logname, 'a+');

$date="";		// SMM SHARED
$nickname="";
$type="";		// INSTANCE TYPE <instanceType>t1.micro</instanceType>
$region="";

$regions=getregions($client);	// GET THE REGIONS TO TEST

foreach ($regions as  $reg => $region) {
	# print "$reg IS $region\n";

	// HERE ARE THE POSSIBLE CALLS
	// WE SHOULD PRODUCE A LIST OF THESE AND LOOP OVER THEM
	// FOR EACH SUBSCRIBER
	# $params=array("Action"=>"DescribeVolumes");
	# $params=array("Action"=>"DescribeImages");
	# $params=array("Action"=>"DescribeKeyPairs");

	# $params=array("Action"=>"DescribeDBInstances"); // RDS
	# $params=array("Action"=>"ListUsers");	// IAM
	# $params=array("Action"=>"GetAccountSummary");	// IAM

	# https://route53.amazonaws.com/doc/2012-02-29/ // ROUTE53
	# $params=array("Action"=>"GetHostedZones");	// ROUTE53
	
	// EACH CALL WILL HAVE AN XML QUERY WHICH WE'LL BE ABLE TO ITERATE OVER
	// AND UNIT IS THE BASIC UNIT WE'RE MEASURING (an instance, an ID, etc)
	// AND EACH SERVICE HAS IT'S OWN NAMESPACE
	$params=array("Action"=>"DescribeInstances");	// EC2
	// THIS IS THE BASIC UNIT OF MEASURE FOR THIS TEST
	$unit='//a:instanceId';			
	// THIS IS WHAT THAT BASIC UNIT IS ENCLOSED WITHIN SO WE CAN LOOP
	$iterator='//a:reservationSet/a:item';
	// NAMESPACE FOR EC2
	$ns='http://ec2.amazonaws.com/doc/2010-11-15/';

	# LOAD OUR LAST FILE
	$lastlog='/home/sean/cc/data/' . $client . "-" . $reg . ".xml";
	$prev='/home/sean/cc/data/' . $client . "-" . $reg . "-PREV.xml";
	# print "LASTLOG $lastlog<BR>";

	if (file_exists($lastlog)) {
		$xml1 = simplexml_load_file($lastlog);
	}
	else $xml1 = new SimpleXMLElement("<news></news>");

	/*
 	* IT WORKS IF YOU REGISTER THE NAMESPACE AND CALL WITH THE REGISTERED
 	* PREFIX.  I VOTE FOR MAKING IT GO AWAY.  BUT AT LEAST I GET IT
 	*/
	$xml2=aws_signed_request($region, $params, $public_key, $private_key);
	if ($xml2 === FALSE) {
		logger("AWS RETURNED FALSE - INVALID KEY [$key1]");
		print "AWS RETURNED FALSE - INVALID KEY [$key1]\n";
		exit;
	}
	
	$xml1->registerXPathNamespace( 'a', $ns);
	$xml2->registerXPathNamespace( 'a', $ns);

        $deleted = $xml1->xpath($unit);	// OLD LIST 
        $added = $xml2->xpath($unit);	// NEW LIST

	if ($deleted == NULL) {	// IF THERE'S NOTING IN THAT REGION...
		# print "NOTHING IN XML1\n";
		if ($added == NULL) {
			# print "NOTHING IN XML2 - SKIPPING\n";
			continue;  // THERE'S NOTHING...
		}
	}

	// THIS LEAVES ADDED AND DELETED ITEMS IN THEIR RESPECITVE XML ARRAYS
	// I'VE BROKEN SHIT HERE
	array_diff_old_new($deleted, $added, 'VALUES');

        if ($deleted) { // OTHERWISE THEY'RE THE SAME!
		# print "DELETED: ";
		# print $deleted->asXML();
		# print "\n";
	}
        if ($added) {
		# print "ADDED: ";
		# print $added->asXML();
		# print "\n";
        }
	# print "SAVING $lastlog<BR>\n";
	# SAVE THE OLDER LOFGILE IN -PREV SO WE CAN DIFF THE LAST 2
	$xml1->asXML($prev);	 	// PREVIOUS - SO WE CAN COMPARE 3
	$xml2->asXML($lastlog); 	// NEW LASTLOG

	// LETS LOOK FOR CHANGES
	// THIS GRABS ALL OUR ITEMS TO CHECK
	$old = $xml1->xpath($iterator);
	$oldcount = count($old);
	$new = $xml2->xpath($iterator);
	$newcount = count($new);
	# print "COUNT: OLD $oldcount   NEW $newcount\n";
	
	# print_r($result);
	
	// COMPARE ITEMS ONE BY ONE
	$n2=0;	// NEW COUNTER
	for ($n1 = 0; $n1 < $oldcount; $n1++ ) {
		# print "COMPARE OLD INSTANCE $n1 VS NEW INSTANCE $n2<BR>\n";
		$oldxml = $old[$n1]->asXML();
		$newxml = $new[$n2]->asXML();
		if ($oldxml == $newxml)  {
			# print "INSTANCE $n1 IS THE SAME AS $n2<BR>\n";
			$n2++;
			continue;
		}
		else {
			# print "INSTANCE $n1 IS DIFFERENT<BR>\n";
	
			// SHOULD CHECK IF THE INSTANCE NUMBERS ARE THE SAME
			// THEN WE KNOW IT'S A CHANGE - OTHERWISE IT'S AN 
			// INSERT OR DELETE
		
			// OUT OF DESPARATION CREATING A NEW XML DOC TO SEARCH
			// THIS WORKS BUT IS AMAZINGLY GROSS - EVEN FOR ME.
			// I SHOULD BE ABLE TO REFERENCE SHIT DIRECTLY
			$oldinst = new SimpleXMLElement($oldxml);
			$newinst = new SimpleXMLElement($newxml);
	
			$type=getval($oldinst, '//instanceType');
			$nickname=getval($oldinst, '//item/value');
	
			$oldiname=getval($oldinst, '//instanceId');
			$newiname=getval($newinst, '//instanceId');
	
			if (strcmp($oldiname, $newiname) == 0) {	// IDs ARE THE SAME
				# print "$oldiname HAS CHANGED: ";	// SO SOMETHING INSIDE HAS CHANGED
				list($before, $after)=compval($oldinst, $newinst, '//instanceState/name');
	
				# STATE CHANGES running->stopped ARE MAJOR
				# IGNORE MINOR STATE CHANGES (pending, etc) WE'LL GET THEM NEXT TIME
				// if ($after)  print $before . " -> " . $after . "\n";
        			if ($after) {
                			// if (strcmp($after, "pending") == 0) printstart($oldiname,$oldinst);
					# shutting down?
                			if (strcmp($after,"running") == 0) printstart($newiname,$newinst);
					# STOPPING IS CLOSE ENOUGH.
                			if (strncmp($after,"stop", 4) == 0) {
						// print "INTO STOP\n";
						# IF WE HAVEN'T CALLED IT ALREADY
                				if (strncmp($before,"stop", 4) != 0) {
							// print "CALLING STOP\n";
							printstop($newiname, $newinst);
						}
					}
                			if (strcmp($after,"terminated") == 0) {
						// print "INTO TERM\n";
                				if (strncmp($before,"stop", 4) != 0) {
							// print "CALLING STOP\n";
							printstop($newiname, $newinst);
						}
						// print "CALLING TERM\n";
						printdelete($newiname,$newinst,$printstop);
					}
					$n2++;
					continue;
                		}
				# NOW CHECK FOR MINOR CHANGES
	
				$checklist=array('//item/value', '//monitoring/state', '//ipAddress', '//privateIpAddress');
				foreach($checklist as $check) {
					list($before, $after)=compval($oldinst, $newinst, $check);
        				if ($after) {
						# print $before . " -> " . $after . "\n";
                				printchange($oldiname,$oldinst,$before,$after);
					}
				}
	
			}
			// OTHERWISE IT'S ADDED OR DELETED
			if ($deleted) {
				// ARRGH
				// THE SEARCH FUNCTION ISN'T WORKING
				// NO IDEA WHY XPATH //[age=123] NOT WORKING
				// LOOPING THROUGH THIS SHIT IS PATHETIC
				$results = $deleted->xpath('//instanceId');
				# print "---------- RESULTS ----------\n";
				foreach($results as $xresult) {
					# print "checking $result vs $oldiname\n";
		    			if (strcmp($oldiname,$xresult) == 0) {
						# SMM THIS MAY NOT BE RIGHT
						# STATE NOT GETTING SET
						$state = getval($xresult, '//instanceState/name');
						// print "INSTANCE $oldiname DELETED [$state]\n";
						# IF WE DIDN'T CATCH IT WHILE
						# IT WAS A ZOMBIE ENTRY...
						# DON'T INCREMENT N2... 
						if (strncmp($state, "stop", 4) != 0) printstop($oldiname, $oldinst);
						if (strcmp($state, "terminated") != 0) printdelete($oldiname, $oldinst);
						# WE'LL TRY AGAIN 
						continue;
					}
				}
				# print "---------- END RESULTS ----------\n";
			}
	
			if ($added) {
				$results = $added->xpath('//instanceId');
				# print "---------- RESULTS ----------\n";
				foreach($results as $xresult) {
					# print "checking $result vs $n[0]\n";
		    			if (strcmp($n[0],$xresult) == 0) {
						# print "INSTANCE $n[0] ADDED\n";
						# PRINT OUT DELETE STUFF
						printinsert($n[0], $newinst);
						// SMM THIS BREAKS IF OLD=NEW HERE
						$n1--; // IT'LL BE REINCREMENTED ON LOOP
						$n2++;	// SKIP THE INSERED RECORD
						continue;
					}
				}
				# print "---------- END RESULTS ----------\n";
			}
		}
	}
	# IF WE MAKE IT HERE AND THERE ARE n2 INSTANCES LEFT
	# THE THEY MUST BE NEW/ADDED
	# print "CHECK FOR EXTRAS: $n2 VS $newcount\n";
	while ($n2 < $newcount) {
		# print "CHECKING NEW INSTANCE $n2\n";
		$newxml = $new[$n2]->asXML();
		$newinst = new SimpleXMLElement($newxml);
		$type=getval($newinst, '//instanceType');
               	$n = $newinst->xpath('//instanceId');
               	if ($added) {
                       	$results = $added->xpath('//instanceId');
                       	# print "---------- RESULTS ----------\n";
                       	foreach($results as $xresult) {
                       			# print "INSTANCE $n[0] ADDED\n";
                                	printinsert($n[0], $newinst);
                       	}
                       	# print "---------- END RESULTS ----------\n";
               	}
		$n2++;
	}			// END REGION
}
fclose($logfile);

// IF WE'RE CALLED FROM THE WEB PRINT OUT THE JSON
if (($key1) && (!$key)) json($logname);			// PRINT OUT AS JSON
# json($logname);			// PRINT OUT AS JSON
?>
