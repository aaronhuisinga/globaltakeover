<?php
$title="Pick Up Port";
include("config.php");
include("header.php"); 
checks();
online();

$result = mysql_query("SELECT location, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$l = $row[0];
$u = $row[1];

	$result = mysql_query("SELECT Owner, markup FROM port WHERE location='$l' LIMIT 1;");
	$row = mysql_fetch_array ($result);
	$o = $row[0];
	$markup = $row[1];
	$row=mysql_fetch_array(mysql_query("SELECT health FROM Players WHERE username='$o' LIMIT 1;"));
	$oh=$row[0];
	
	if ($o == 'None' OR $o == NULL OR $oh < 1) {
	$result = mysql_query("SELECT * FROM port WHERE owner='$u' LIMIT 1;");
	if (mysql_num_rows($result) == 0) {
	$nt = 1000;
	$mnbet = 1;
	$mxbet = 1;
	$nmarkup = 0.10;
	
	mysql_query("UPDATE port SET owner='$u', markup='$nmarkup' WHERE location='$l' LIMIT 1;");
	echo ("<div id=\"crimestext\"><center>You picked up the $l Port, and now own it! <br /> <a href=\"porto.php\">Manage your Port now!</a></center></div>");
	include("footer.php");
	} else {
	echo ("<div id=\"crimestext\"><center>You already own a Port, and cannot pick up another! <br /> <a href=\"/port.php\">Go back.</a></center></div>");
	include("footer.php");
	}
	} else {
	echo ("<div id=\"crimestext\"><center>This Port already has an owner. You can't pick it up! <br /> <a href=\"/port.php\">Go back.</a></center></div>");
	include("footer.php");
	}
?>