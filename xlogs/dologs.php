<?php
require_once 'include/db.php';

	$query = "SELECT id, sec1, key1 FROM users"; 

	$rc = mysql_query($query);
	if (!$rc) {
		die("Error running $query: " . mysql_error());
	}

	while($row = mysql_fetch_array($rc)) {
		$id=$row['id'];
		$key=$row['key1'];
		$sec=$row['sec1'];
    		# echo "==> $sec $key\n";
		if ($key) {
			logger("dologs calling dyn for $key");
			include "dyn.php";
			logger("dologs calling awsstats for $key");
			include "awsstats.php";
		}
	}
?>
