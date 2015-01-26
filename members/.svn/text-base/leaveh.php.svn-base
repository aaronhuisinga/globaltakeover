<?php
$title="Hospital";
require_once('config.php');
require_once("header.php");

$row=mysql_fetch_array(mysql_query("SELECT htime, hospital, health FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
	$h=$row[2];
	$hh=$row[1];
	$original=$row[0];

$hs = $current - $original;
$mindiff = $hs/60;
$hourdiff = $mindiff/60;
$tl = $hh - floor($hourdiff);
$ti = $hh - $tl;
mysql_query("UPDATE Players SET htime = NULL, hospital='$ti' WHERE id ='{$_COOKIE['id']}' LIMIT 1;");
echo ("<div id=\"crimestext\"><center>You left the hospital early!</center></div>");
require_once("footer.php");
?>