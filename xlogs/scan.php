<?php

// SCAN.php

// SHOULD ONLY WORK IF YOU'RE LOGGED IN
require_once 'include/checksession.php';

$num=$_POST['num'];
$ip=$_POST['ip'];
system("/var/www/xlogs/scan $ip");
?>
