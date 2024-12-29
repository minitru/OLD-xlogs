<?php
//
// SEAN'S QUICK HACK TO DISPLAY 911 ERROR MESSAGES IN A BROWSER
// m.php?m=1388902116

// GET THE MESSAGE NUMBER
$msg=$_GET["m"];

// OK THIS IS SUPER INSECURE m=../../../etc/passwd DISPLAYS THE PASSWD FILE
// SO JUST MAKE SURE WE'RE A NUMBER BY CONVERTING WHAT WE GET INTO A NUMBER
// $msg="1388902116";
$msg=intval($msg);

$loc="/home/sean/msgs/" . $msg;
//echo $loc;

// READ IN THE FILE
$f = file_get_contents($loc);

echo "<PRE>$f</PRE>";
?>
