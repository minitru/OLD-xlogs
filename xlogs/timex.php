<?php

$timestr=" 2011-05-17T15:46:53.000Z";
$offset = round((time() - strtotime($timestr))/3600);	// IN HOURS
print "TIME: $offset\n";
?>
