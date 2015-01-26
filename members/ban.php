<?php
ob_start(); 
include("config.php");
include("Online.php");

$result = mysql_query("SELECT theme, health FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);

$h = $row[1];

$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

$userlevl = mysql_query("SELECT Level FROM Players WHERE id='{$_COOKIE['id']}'");
while($successa = mysql_fetch_row($userlevl))
{$userlevel = $successa[0];}

if ($id != "" && isset($_COOKIE["id"])) {
	$h = $row['health'];
	if ($h == 0) {
	 	$url .= '/dead.html';
		header("Location: $url");
}

elseif ($userlevel < 2){

echo "<div id=\"crimestext\"><center>You do not have sufficient permissions to access this page.</center></div>";

}elseif ($userlevel == 2){

$result = mysql_query("SELECT id, username, corps, banned FROM Players WHERE id='$id' LIMIT 1;");
$user = mysql_fetch_assoc($result);
$uid = $user['id'];
$username = $user['username'];
$ban = $user['banned'];
$d = (date("M d Y h:i:s A"));
		
$result = mysql_query("UPDATE Players SET banned='1', banreason='Duplicate accounts.', bdate='$d' WHERE id ='$uid'");

echo ('<center>
<div id="gameplay">');
echo ("<div id=\"crimestext\"><center>$username has been banned for having duplicate accounts. <br /> <a href=\"dupecheck.php\" target=\"main\">Go back.</a></center></div>");
}
}
?>
