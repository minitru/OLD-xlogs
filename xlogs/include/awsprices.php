<?php

// AWS PRICE LISTS, REGION TYPES 
// THROW ALL THESE INTO USABLE ARRAYS

$string = 'm1.small	m1.medium	m3.medium	m1.large	m3.large	c3.large	m1.xlarge	m3.xlarge	m2.2xlarge	t1.micro	m2.xlarge	m2.2xlarge	m2.4xlarge	c1.medium	c1.xlarge	cc1.4xlarge	cc2.8xlarge	cg1.4xlarge	h1.4xlarge';

$prices = '0.065	0.13	0.13	0.26	0.26	0.26	0.52	0.58	1.16	0.02	0.45	0.9	1.8	0.17	0.66	1.3	2.4	2.1	3.1';

$res = "0.038260274	0.076520548	0.076520548	0.153041096	0.153041096	0.153041096	0.306082192	0.335890411	0.673780822	0.012077626	0.205579909	0.411159817	0.822319635	0.097077626	0.388310502	0.76047032	0.931776256	1.273680365	1.452050228";

$res3 ="0.024415525	0.04883105	0.04883105	0.0976621	0.0976621	0.0976621	0.195324201	0.215456621	0.430913242	0.007359209	0.128980213	0.257960426	0.515920852	0.064490107	0.257960426	0.536726027	0.652856925	0.893162861	0.899047184";

$result = array();
$price = array();
$reserved = array();		// RESERVED ARRAY PRICES
$reserved3 = array();		// RESERVED ARRAY PRICES

$price = $result;		// ASSIGN THE LEFT SIDE

$reslist = explode('	', $res);
$reslist3 = explode('	', $res3);
$pricelist = explode('	', $prices);
$array = explode('	', $string);

$n=0;

foreach ($array as $chunk) {
  	$result[$chunk] = 0;
  	$price[$chunk] = $pricelist[$n];
  	$reslist[$chunk] = $reslist[$n];
  	$reslist3[$chunk] = $reslist3[$n];
	$n++;
}
?>
