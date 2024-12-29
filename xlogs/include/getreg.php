<?php
/* 
 * WHAT REGIONS ARE WE TESTING FOR A GIVEN CLIENT?
 */
function getregname($cli)
{
	$getreg=TRUE;
	$array = array(
    		"use1" => "US East - N. Virginia",
    		"usw1" => "US West - Northern California",
    		"usw2" => "US West - Oregon",
		"euw1" => "EU - Ireland",
    		"apse1" => "Asia Pacific - Singapore",
    		"apne1" => "Asia Pacific - Tokyo",
		"apse2" => "Asia Pacific - Sydney",
		"sae1" => "South America - Sao Paulo"
	);
	return($array);
}

function getregions($cli)
{
	$getreg=TRUE;
	$array = array(
    		"use1" => "us-east-1",
    		"usw1" => "us-west-1",
    		"usw2" => "us-west-2",
		"euw1" => "eu-west-1",
    		"apse1" => "ap-southeast-1",
    		"apne1" => "ap-northeast-1",
    		"apse2" => "ap-southeast-2",
		"sae1" => "sa-east-1"
	);
	return($array);
}

// AMAZON SETTINGS TO OUR SETTINGS
function setregions($cli)
{
	$setreg=TRUE;
	$array = array(
		"us-east-1" => "use1",
		"us-west-1" => "usw1",
		"us-west-2" => "usw2",
		"eu-west-1" => "euw1",
		"ap-southeast-1" => "apse1",
		"ap-northeast-1" => "apne1",
		"ap-southeast-2" => "apse2",
		"sa-east-1" => "sae1" 
	);
	return($array);
}
?>
