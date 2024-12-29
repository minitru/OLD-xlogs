<?php
session_start();
if(isset($_SESSION['fname'])) include "view.php";
else include"index2.php";
?>
