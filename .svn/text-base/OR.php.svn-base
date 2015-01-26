<?php
$title="Organised Robbery";
require_once("members/config.php");
include("members/Countdown_he.php");
include("members/countdown_p.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];

$sql = mysql_query("SELECT LSD FROM Robbery WHERE leader='$u' OR driver='$u' OR ee='$u' OR wep='$u' LIMIT 1;");
$row = mysql_fetch_array($sql);
$LSD = $row[0];
if (mysql_num_rows($sql) < 1) {
 	$url .= '/members/OR.php';
	header("Location: $url");
	exit();
} elseif($LSD == 'L') {
	$url .= '/members/OR.php';
	header("Location: $url");
	exit();
} elseif($LSD == 'S') {
	$url .= '/members/SOR.php';
	header("Location: $url");
	exit();
} elseif($LSD == 'D') {
	$url .= '/members/DOR.php';
	header("Location: $url");
	exit();
}
?>