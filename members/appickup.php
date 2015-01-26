<?php
$title="Pick Up Airport";
include("config.php");
include("header.php"); 
checks();
online();

$result = mysql_query("SELECT location, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$l = $row[0];
$u = $row[1];

	$result = mysql_query("SELECT Owner, markup FROM airport WHERE location='$l' LIMIT 1;");
	$row = mysql_fetch_array ($result);
	$o = $row[0];
	$markup = $row[1];
	$row=mysql_fetch_array(mysql_query("SELECT health FROM Players WHERE username='$o' LIMIT 1;"));
	$oh=$row[0];
	
	if ($o == 'None' OR $o == NULL OR $oh < 1) {
	$result = mysql_query("SELECT * FROM airport WHERE owner='$u' LIMIT 1;");
	if (mysql_num_rows($result) == 0) {
	$nmarkup = 0.10;
	
	mysql_query("UPDATE airport SET Owner='$u', markup='$nmarkup' WHERE location='$l' LIMIT 1;");
	echo ("<div id=\"crimestext\"><center>You picked up the $l Airport, and now own it! <br /> <a href=\"airporto.php\">Manage your Airport now!</a></center></div>");
	include("footer.php");
	} else {
	echo ("<div id=\"crimestext\"><center>You already own an Airport, and cannot pick up another! <br /> <a href=\"/airport.php\">Go back.</a></center></div>");
	include("footer.php");
	}
	} else {
	echo ("<div id=\"crimestext\"><center>This Airport already has an owner. You can't pick it up! <br /> <a href=\"/airport.php\">Go back.</a></center></div>");
	include("footer.php");
	}
?>