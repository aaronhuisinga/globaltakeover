<?php
include("config.php");
include("Online.php"); 
include("Rank-ups.inc.php");
include("Countdown_he.php");
include("Banned.php"); 

$query = "SELECT theme FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$theme = $row[0];

if ($theme != NULL) {

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />");

} else {
$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />");

$theme = 'style';
}

	
if (!isset($_COOKIE['id'])) {


$url .= '/login.html';
header("Location: $url");
exit();


} 

$query = "SELECT health FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$h = $row[0];

if ($h == 0) {
 	$url .= '/dead.html';
	header("Location: $url");
	exit();
} else {

	$query = "SELECT location, username FROM Players WHERE id='{$_COOKIE['id']}'";
	$result = @mysql_query ($query);
	$row = mysql_fetch_array ($result);

	$l = $row[0];
	$u = $row[1];

	$query = "SELECT Owner FROM WT WHERE location='$l'";
	$result = @mysql_query ($query);
	$row = mysql_fetch_array ($result);

	$o = $row[0];
	
	if ($o == 'None' OR $o == NULL) {
	
	$query = "SELECT * FROM WT WHERE owner='$u'";
			$result = mysql_query($query);
			if (mysql_num_rows($result) == 0) {
	
	$nt = 1000;
	$mnbet = 1;
	$mxbet = 1;
	
	$query = "UPDATE WT SET Till='$nt', Owner='$u', Mn_bd='$mnbet', Mx_bd='$mxbet' WHERE location='$l'";
	$result = @mysql_query ($query);
	
	echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

</head>
<body>
<div id=\"crimestext\"><center>You picked up the $l War Table, and now own it! You have been given $1,000 for your till!<br />
<a href=\"Wto.php\">Manage your War Table now!</a></center></div>
</body></html>");
	
	} else {
	echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

</head>
<body>
<div id=\"crimestext\"><center>You already own a War Table, and cannot pick up another!<br />
	<a href=\"/Wt.php\">Go back.</a></center></div>
</body></html>");
	}
	
	} else {
	echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

</head>
<body>
<div id=\"crimestext\"><center>This War Table already has an owner. You can't pick it up!<br />
	<a href=\"/Wt.php\">Go back.</a></center></div>
</body></html>");
	}
}
?>