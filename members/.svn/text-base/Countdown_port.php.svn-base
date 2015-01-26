<?php
require_once("config.php");

$result = mysql_query("SELECT po_seconds, po_mins, po_hours, po_days, po_months, po_years FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result, MYSQL_NUM);
	$targetYear= $row[5];
	$targetMonth= $row[4];
	$targetDay= $row[3];
	$targetHour= $row[2];
	$targetMinute= $row[1];
	$targetSecond= $row[0];

$dateFormat = "Y-m-d H:i:s";

$targetDate = mktime($targetHour,$targetMinute,$targetSecond,$targetMonth,$targetDay,$targetYear);
$actualDate = time();

$secondsDiff = $actualDate - $targetDate;
$hoursd = $secondsDiff/60;
$ahs = floor($hoursd);
?>