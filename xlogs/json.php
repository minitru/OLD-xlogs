<?php

// JSON.php
// GIVEN A LOGFILE NAME, OUTPUT IT IN THE FUNKY json NEEDED BY THE
// HTML TABLE THINGY

if ($argv[1]) $fname="/var/www/xlogs/log/" . $argv[1];
else $fname="/var/www/xlogs/log/sean.log";

$first="";

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

print "{ \"aaData\": [\n";

// FOR SOME REASON THERE'S A BOGUS LAST LINE IN HERE
// DON'T KNOW WHY - NEED TO GET RID OF IT
$array = explode("\n", file_get_contents($fname));
foreach($array as $line){
	if ($line == "") continue;
	if ($first) print ", \n";
	else $first="TRUE";
    	print "[" . $line . "]";
}
// NOW FOR EACH LINE, ENCAPSULATE IT IN [] AND ADD A COMMA
//      ["Trident","Internet Explorer 4.0","Win 95+","4","X"],

print "\n] }\n";		// LAST LINE
?>
