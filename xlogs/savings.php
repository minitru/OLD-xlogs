<?php
require_once 'include/db.php';
require_once 'include/checksession.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<style type="text/css" title="currentStyle">
	@import "dt/media/css/demo_page.css";
       	@import "dt/media/css/demo_table.css";
</style>

<link rel="stylesheet" media="screen" href="xlogs.css" />

<!-- Demo Scripts -->
<script type="text/javascript" src="mousy.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="joyride/modernizr.foundation.js"></script>
<script type="text/javascript" language="javascript" src="dt/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="dt/extras/TableTools/media/js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="dt/extras/TableTools/media/js/TableTools.js"></script>
<script type="text/javascript" src="dygraph-combined.js"></script>

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
    <body>
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
            <h1 class="pagehead"><div class="xl">xlogs:</div> The Mighty Savings Calculator<BR><CENTER>
<?php
	// $id=2;
        // include "/var/www/xlogs/chart.php";
	echo "$fname, ";
        include "/var/www/xlogs/spend.php";
?>
<div id="sum1"></div>
</H1>


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
require_once 'addgraph.php';

$width="400px";
$height="140px";
$allgraphs=array();

$regionname=array();
$regionname=getregions($regionname);

$fullregion=array();
$fullregion=getregname($fullregion);

$resttl=0;
$res1ttl=0;
$res3ttl=0;

// print "ARGC = $argc\n";

if ($argc == 2) $id=$argv[1];
else if (isset($_SESSION['id'])) {
	$id= $_SESSION['id'];
	$acct = $_SESSION['id'];
}
else {
	// $id=2;		// ANGEL FOR TESTING, YO!
	$cdata = "cdata/" . $id . ".js";
}
logger("savings.php ID SET TO $id");

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
$rowCount = mysql_num_rows($result);

$warning="";

if ($rowCount == 0) {
	logger("spend.php rowcount 0");
	$key=$_SESSION['key1'];
	include "awsstats.php";		// GET SOME STATS
	// TRY AGAIN... AT LEAST WE'LL HAVE A SINGLE DATA POINT.
	$query = "SELECT DISTINCT region, type from awsstats where id='$id'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$warning = "<div id=warn>Warning - only one data point - graphs will be empty... .</div>";
}

# logger("spend.php rowcount $rowCount");

$query = "SELECT statdate, region, type, cost, count FROM awsstats where statdate >= ( CURDATE() - INTERVAL 3 MONTH ) AND id = '$id' order BY region, type, statdate";
logger("spend.php QUERY $query");
	
// NOW WE NEED TO DO IT FOR ALL THE REGION FILES UGH
// EACH GRAPH GETS ITS OWN DATA FUNCTION WHICH WE APPEND
// TO THE $id-data.js FILE
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$rowCount = mysql_num_rows($result);
logger("spend.php rowcount $rowCount");
	$n = 0;
	$subttl = 0;
	$subcnt = 0;
	$lasttype = "";
	$lastregion = "";
	while ($row = mysql_fetch_array($result)) {
		$statdate=$row['statdate'];
		$region=$row['region'];
		$type=$row['type'];

		$stype=str_replace(".", "_", $type);
		$cost=$row['cost'];
		$count=$row['count'];
		if ($lastregion == "") {	// JUST STARTED - MAKE DATAFILE
			echo "<table cellpadding=\"5\" cellspacing=\"5\" border=\"1\" class=\"display\">";
			$lastregion = $region;
			$lasttype = $type;
			$fname = "/var/www/xlogs/cdata/" . $id . ".js";
			$line="function $region" . "_" . "$stype() {\nreturn \"\"";

			// echo "PUT CONTENTS $fname $line";
			file_put_contents($fname, $line);
		}

		if (($lasttype != $stype) || ($lastregion != $region)) {
			$avg = $subcnt / $n;
			$avg = sprintf("%01.2f", $avg);
			$avgcost = $subttl / $n;
			$avgcost = sprintf("%01.2f", $avgcost);
			$regtype=$lastregion . "_" .  $lasttype;


			if ($lastregion != "all" && $lasttype != "all") {
				echo "<TR><TD>";
				print "<div id=\"$regtype\" style=\"width:$width; height:$height;\"></div>";
				array_push($allgraphs, $regtype);	// SAVE THE NAME
				// PUT THE DOT BACK I NEED IT FOR PRICE LOOKUP
				$lasttype=str_replace("_", ".", $lasttype);

				// addgraph($regtype);
				$fullreg=$fullregion[$lastregion];
				echo "</TD><TD>";
          			echo "<h2><div class=xl2>$fullreg<BR>$lasttype</H2>";
				echo "<H2>avg instances: $avg<BR>avg cost/mo: $$avgcost</H1>";
		 		//print "$lastregion $lasttype AVERAGE INSTANCES $avg $avgcost<BR>\n";
				$rescnt = round($avg);
				$ressave = $avgcost - ($rescnt * $reslist[$lasttype] * 24 * 30);
				$ressave = sprintf("%01.2f", $ressave);

				$res3save = $avgcost - ($rescnt * $reslist3[$lasttype] * 24 * 30);
				$res3save = sprintf("%01.2f", $res3save);

				$resttl = $resttl + $rescnt;
				$res1ttl = $res1ttl + $ressave;
				$res3ttl = $res3ttl + $res3save;

				$res1pct = round(($ressave / $avgcost) * 100);
				$res3pct = round(($res3save / $avgcost) * 100);

				echo "</TD><TD>";
				echo "<CENTER><h2><div class=xl2>reserve $rescnt instances</div></H2><H2>reserve 1 yr save <B>$res1pct%</B>: $$ressave</B> / mo<BR>reserve 3 yrs save <B>$res3pct%</B> $$res3save / mo</h2></CENTER>";
				// SMM DEBUG
				// echo "<BR><B>$lasttype $reslist[$lasttype] $reslist3[$lasttype]</B></BR>";
				echo "</TD></TR>";
			}

			$n = 0;
			$subttl = 0;
			$subcnt = 0;

			$line=";\n}\n\nfunction $region" . "_" . "$stype() {\nreturn \"\"";
			// echo "PUT CONTENTS $fname $line";
			logger("spend.php PUT CONTENTS $fname $line");
			file_put_contents($fname, $line, FILE_APPEND);
		}
		//print "$statdate $region $stype $count $cost\n";
		$line = " +\n\"$statdate,$count,$cost\\n\"";

		file_put_contents($fname, $line, FILE_APPEND);
		$n = $n + 1;
		$subttl = $subttl + $cost;
		$subcnt = $subcnt + $count;
		$lasttype = $stype;
		$lastregion = $region;
	}
	$avg = $subcnt / $n;
	$avg = sprintf("%01.2f", $avg);
	$avgcost = $subttl / $n;
	$avgcost = sprintf("%01.2f", $avgcost);
	$regtype=$lastregion . "_" .  $lasttype;
	echo "<TR><TD>";
	print "<div id=\"$regtype\" style=\"width:$width; height:$height;\"></div>";
	array_push($allgraphs, $regtype);	// SAVE THE NAME
	// addgraph($regtype, "400px", "160px");
	// PUT THE DOT BACK I NEED IT FOR PRICE LOOKUP
	$lasttype=str_replace("_", ".", $lasttype);
        $fullreg=$fullregion[$lastregion];
	echo "</TD><TD>";
        echo "<h2><div class=xl2>$fullreg<BR>$lasttype</H2>";
	echo "<H2>avg instances: $avg<BR>avg cost/mo: $$avgcost</H1>";
	
	//print "$lastregion $lasttype AVERAGE INSTANCES $avg $avgcost\n";
	echo "</TD><TD>";
// SAVINGS AREA
	$rescnt = round($avg);
	$ressave = $avgcost - sprintf("%01.2f", $rescnt * $reslist[$type] * 24 * 30);
	$res3save = $avgcost - sprintf("%01.2f", $avg * $reslist3[$type] * 24 * 30);
	$ressave = sprintf("%01.2f", $ressave);
	$res3save = sprintf("%01.2f", $res3save);

	$resttl = $resttl + $rescnt;
	$res1ttl = $res1ttl + $ressave;
	$res3ttl = $res3ttl + $res3save;

 	$res1pct = round(($ressave / $avgcost) * 100);
        $res3pct = round(($res3save / $avgcost) * 100);

        echo "<CENTER><h2><div class=xl2>reserve $rescnt instances</div></H2><H2>reserve 1 yr save <B>$res1pct%</B>: $ressave / mo<BR>reserve 3 yrs save <B>$res3pct%</B>: $res3save / mo</h2></CENTER>";
	echo"</TD></TR></TABLE>";
	$line=";\n}\n";
	file_put_contents($fname, $line, FILE_APPEND);
	# logger("spend.php $fname $line");
	$res1yr = $res1ttl * 12;
	$res3yr = $res3ttl * 12;
	$res1yr = sprintf("%01.2f", $res1yr);
	$res3yr = sprintf("%01.2f", $res3yr);

 	$res1pct = round(($res1ttl / $gttl) * 100);
        $res3pct = round(($res3ttl / $gttl) * 100);
	$res3ttl = sprintf("%01.2f", $res3ttl);
	$res1ttl = sprintf("%01.2f", $res1ttl);

	echo "<script>$(\"#sum1\").append(\"<CENTER>$warning reserve $resttl instances for 3 years - save <B>$res3pct%</B> - $$res3ttl a month / $$res3yr per year<BR>reserve $resttl instances for 1 year - save <B>$res1pct%</B> - $$res1ttl a month / $$res1yr per year</CENTER>\");</script>";

?>
	</div>
        <!-- /content -->

        <div id="footer">
<?php
	// PRINT THE GRAPHS
	echo "<script type=\"text/javascript\" src=\"cdata/$id.js\"></script>";
	foreach ($allgraphs as $graph) {
		//print "GRAPH: $graph<BR>";
		addgraph($graph);
	}
	
?>
        </div><!-- /footer -->
    </body>
</html>
