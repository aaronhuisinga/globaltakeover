<?php
$title="Pick Up Weapon Factory";
include("config.php");
include("header.php"); 
include("Countdown_he.php");

$row=mysql_fetch_array(mysql_query("SELECT location, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$l = $row[0];
$u = $row[1];

	$row=mysql_fetch_array(mysql_query("SELECT owner FROM wf WHERE location='$l' LIMIT 1;"));
	$o = $row[0];
	$row=mysql_fetch_array(mysql_query("SELECT health FROM Players WHERE username='$o' LIMIT 1;"));
	$oh = $row[0];
	
	if ($o == 'None' OR $o == NULL OR $oh == 0) {
	
	$result=mysql_query("SELECT * FROM wf WHERE owner='$u' LIMIT 1;");
	if (mysql_num_rows($result) == 0) {
	mysql_query("UPDATE wf SET owner='$u' WHERE location='$l'");
	echo ("<div id=\"crimestext\"><center>You picked up the $l Weapon Factory, and now own it! <br /> <a href=\"wfo.php\">Manage your Weapon Factory now!</a></center></div>");
	include("footer.php");
	} else {
	echo ("<div id=\"crimestext\"><center>You already own a Weapon Factory, and cannot pick up another! <br /> <a href=\"wf.php\">Go back.</a></center></div>");
	include("footer.php");
	}
	} else {
	echo ("<div id=\"crimestext\"><center>This Weapon Factory already has an owner. You can't pick it up! <br /> <a href=\"wf.php\">Go back.</a></center></div>");
	include("footer.php");
	}
?>