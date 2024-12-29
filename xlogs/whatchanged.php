<?php
/*
 * THIS IS FOR OUR EMAIL ALERTS
 * ASAP, DAILY, WEEKLY, MONTHLY
 * THIS MIGHT AS WELL BE SELF CONTAINED, JUST CALL WITH asap, daily, weekly or monthly
 * select * from users where notify like "%monthly%";
 */
$chgs="";
$lines=array();
$row = 1;
$logfile="/var/www/xlogs/log/" . $key . ".log";
if (($handle = fopen($logfile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        // echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
		if ($c == 0) {
			$show="";
			$time=strtotime($data[0]);
			// print "TIME: $data[0] $time  LIMIT: $limit\n";
			if ($time > $limit) $show="TRUE";
			//echo "$time ";
		}
		if ($show == "TRUE") {
		// 	echo $data[$c] . " ";
		}
        }
	if ($show == "TRUE") {
		$chgs .= implode(' ',$data) . "\n";
		// print $chgs;
	}
    }
    fclose($handle);
}
?>
