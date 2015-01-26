<?php
$title="Hospital";
require_once('config.php');
require_once('header.php');

$res=$mysqli->query("SELECT htime, hospital, health FROM Players WHERE id='$_COOKIE[id]' LIMIT 1;");
$row=$res->fetch_array();
$h=$row[2];
$hh=$row[1];
$original=$row[0];

$hs = $current - $original;
$sd = $hh * 3600;
$md = $hh * 60;
	if ($hs >= $sd AND $hh != 0) {
		$gh = $hh * 10;
		$nh = $h + $gh;
		if ($nh > 100) {
		$nh = 100;
		}
		$mysqli->query("UPDATE Players SET health='$nh', hospital='0' WHERE id ='$_COOKIE[id]' LIMIT 1;");
		echo "<div id=\"crimestext\"><center>You left the hospital! Your health is now $nh.</center></div>";
		require_once("footer.php");
		exit();
} elseif ($hs <= $sd) {
$mindiff = $hs/60;
$hourdiff = $mindiff/60;
$mde = $md - 60;

	if ($mindiff >= $mde) {
		$tl = $md - floor($mindiff);
		echo ("<div id=\"crimestext\"><center>You are in the hospital for another $tl mins!<br />
			   <form method=\"post\" action=\"/members/leaveh.php\">
			   <input type=\"submit\" name=\"submit\" value=\"Leave Early\" />
			   <input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></center></div>");
		require_once("footer.php");
		exit();
	} else {
	$tl = $hh - floor($hourdiff);
	echo ("<div id=\"crimestext\"><center>You are in the hospital for another $tl hours!<br />
		   <form method=\"post\" action=\"/members/leaveh.php\">
		   <input type=\"submit\" name=\"submit\" value=\"Leave Early\" />
		   <input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></center></div>");
	require_once("footer.php");
	exit();
	}
}
?>