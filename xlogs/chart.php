<?php
	require_once 'include/db.php';

	if (! isset($id)) $id=3;
        $query = "SELECT statdate, cost FROM awsstats where id=$id and region='all'";

        $rc = mysql_query($query);
        if (!$rc) {
                die("Error running $query: " . mysql_error());
        }

	logger("getting chart data for $id");

	$chartdata="/var/www/xlogs/cdata/" . $id;
	file_put_contents($chartdata, "date, cost\n");	// HEADER

        while($row = mysql_fetch_array($rc)) {
		$line=$row['statdate'] . ", " . $row['cost'] . "\n";
	 	file_put_contents($chartdata, "$line", FILE_APPEND);
	}
?>
