<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
    <title>Custom grid and Dot</title>
    <!--[if IE]>
    <script type="text/javascript" src="../excanvas.js"></script>
    <![endif]-->
    <!--
    For production (minified) code, use:
    <script type="text/javascript" src="dygraph-combined.js"></script>
    -->
    <script type="text/javascript" src="dygraph-combined.js"></script>

    <script type="text/javascript" src="cdata/2.js"></script>
  </head>

  <body>

<?php

// THIS ISN'T WORKING AND IT SHOULD BE
// DOSAVINGS.php

// FOR A GIVEN USER, GET THEIR USAGE DATA AND FIGURE OUT HOW MUCH
// THEY CAN SAVE PER REGION/INSTANCE TYPE AND SAVE TO A FILE FOR
// LATER USE
// cdata/$id.php
// GET THE REGIONS THEY'RE IN: $allregions
// FOR EACH INSTANCE TYPE IN USE IN A REGION GET 3 MONTH AVG USE:
//   $use1-t1-micro: 3.8 instances,
//   $use1-t1-micro-cost: $XXX per month and $use1-cost-ttl
//   $use1-t1-micro-res1: $YYY per month and $use1-res1-ttl
//   $use1-t1-micro-res3: $ZZZ per month and $use1-res3-ttl

// AND THROW THE DATA FOR EACH OF THESE REGIONS INTO A FILE
// FOR GRAPHING... date count cost
// cdata?$id-use1-t1-micro etc.

require_once "include/getreg.php";
require_once "include/awsprices.php";
require_once 'include/db.php';
require_once 'addgraph.php';

$regionname=array();
$regionname=getregions($regionname);

$gttl = 0;	// GRAND TOTAL
$boxttl = 0;	// HOW MANY INSTANCES?
$boxgttl = 0;	// TOTAL INSTANCES

// print "ARGC = $argc\n";

if ($argc == 2) $id=$argv[1];
else if (isset($_SESSION['id'])) $acct = $_SESSION['id'];
else
	$id=2;		// ANGEL FOR TESTING, YO!

// GET THE REGIONS THEY'RE IN: $allregions
// MAYBE WE SHOULD JUST STICK THEM IN AN ARRAY AND READ THAT BACK IN
// $avg['region'] = blah - STORE IT AS JSON
// COULD ALSO JUST STORE IT IN THE DATABASE (CAUSE THAT'S WHAT DBs ARE FOR
// NOT OBVIOUS - WE NEED A COLUMN FOR EACH REGION/SIZE COMBO.  YUCK.
// OR WE COULD JUST STORE THE JSON IN THE DATABASE AND NOT IN A FLAT FILE
// BEWARE OF SQL INJECTION ISSUES

// SELECT DISTINCT region, type from awsstats where id=3;
/*
+--------+----------+
| region | type     |
+--------+----------+
| use1   | m1.large |
| use1   | t1.micro |
| use1   | all      |
| usw2   | m1.large |
| usw2   | t1.micro |
| usw2   | all      |
| all    | all      |
+--------+----------+
* WE WANT avg count, cost (avg count * rate), r1, r3, savings r1, savings r3
*/

// THE AVERAGE ISN'T THE AVERAGE OF ALL THE ELEMENTS, BECAUSE SOME
// ELEMENTS MAY BE MISSING CAUSE MACHINES WERE OFF (OR AT ZERO COUNT)
// HOW DO WE HANDLE THIS (id=1 WHEN I TURN OFF MY MACHINE...)
$query = "SELECT DISTINCT region, type from awsstats where id='$id'";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while ($row = mysql_fetch_array($result)) {
	}

$query = "SELECT statdate, region, type, cost, count FROM awsstats where statdate >= ( CURDATE() - INTERVAL 3 MONTH ) AND id = '$id' order BY region, type, statdate";
	
// NOW WE NEED TO DO IT FOR ALL THE REGION FILES UGH
// EACH GRAPH GETS ITS OWN DATA FUNCTION WHICH WE APPEND
// TO THE $id-data.js FILE
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$n = 0;
	$subttl = 0;
	$subcnt = 0;
	$lasttype = "";
	$lastregion = "";
	while ($row = mysql_fetch_array($result)) {
		$statdate=$row['statdate'];
		$region=$row['region'];
		$type=$row['type'];
		$type=str_replace(".", "_", $type);
		$cost=$row['cost'];
		$count=$row['count'];
		if ($lastregion == "") {	// JUST STARTED - MAKE DATAFILE
			echo "<TABLE BORDER=2 CELLPADDING=10>";
			$lastregion = $region;
			$lasttype = $type;
			$fname = "/var/www/xlogs/cdata/" . $id . ".js";
			$line="function $region" . "_" . "$type() {\nreturn \"\"";

			// echo "PUT CONTENTS $fname $line";
			file_put_contents($fname, $line);
		}

		if (($lasttype != $type) || ($lastregion != $region)) {
			$avg = $subcnt / $n;
			$avg = sprintf("%01.2f", $avg);
			$avgcost = $subttl / $n;
			$avgcost = sprintf("%01.2f", $avgcost);
			$regtype=$lastregion . "_" .  $lasttype;

			echo "<TR><TD>";
			addgraph($regtype, "400px", "160px");
			echo "</TD><TD>";
		 	print "$lastregion $lasttype AVERAGE INSTANCES $avg $avgcost<BR>\n";
			echo "</TD></TR>";

			$n = 0;
			$subttl = 0;
			$subcnt = 0;

			$line=";\n}\n\nfunction $region" . "_" . "$type() {\nreturn \"\"";
			// echo "PUT CONTENTS $fname $line";
			file_put_contents($fname, $line, FILE_APPEND);
		}
		//print "$statdate $region $type $count $cost\n";
		$line = " +\n\"$statdate,$count,$cost\\n\"";

		file_put_contents($fname, $line, FILE_APPEND);
		$n = $n + 1;
		$subttl = $subttl + $cost;
		$subcnt = $subcnt + $count;
		$lasttype = $type;
		$lastregion = $region;

	}
	$avg = $subcnt / $n;
	$avg = sprintf("%01.2f", $avg);
	$avgcost = $subttl / $n;
	$avgcost = sprintf("%01.2f", $avgcost);
	$regtype=$lastregion . "_" .  $lasttype;
	echo "<TR><TD>";
	addgraph($regtype, "400px", "160px");
	echo "</TD><TD>";
	print "$lastregion $lasttype AVERAGE INSTANCES $avg $avgcost\n";
	echo "</TD></TR></TABLE>";
	$line=";\n}\n";
	file_put_contents($fname, $line, FILE_APPEND);
?>
  </body>
</html>
