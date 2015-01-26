<?php
require_once("../config.php");
$arr = array('UK', 'USA', 'Australia', 'Philippines', 'Russia');

foreach ($arr as $l) {
	$res=$mysqli->query("SELECT `dtime`, `owner` FROM BF WHERE `location`='$l' LIMIT 1");
	$row=$res->fetch_array();
	$own=$row[1];
	$dtime=$row[0];
	if (time() >= $dtime) {
		$wait=rand (26600, 32400);
		$ndrop=(time() + $wait);
		$bullets=rand(1000, 3000);
		$mysqli->query("UPDATE BF SET Bullets=(Bullets+$bullets), dtime='$ndrop', drops=(drops+1), price='0' WHERE location ='$l' LIMIT 1");
		$mysqli->query("UPDATE Players SET bullets=(bullets+1000) WHERE username='$own' LIMIT 1");
	}
}
?>