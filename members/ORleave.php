<?php
$title="Organized Robbery";
include("config.php");
include("header.php"); 
checks();
 
$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];

if ($_REQUEST['Leave']) {
	mysql_query("UPDATE Robbery SET driver = 'None' WHERE driver='$u' LIMIT 1;");
	mysql_query("UPDATE Robbery SET ee = 'None' WHERE ee='$u' LIMIT 1;");
	mysql_query("UPDATE Robbery SET wep = 'None' WHERE wep='$u' LIMIT 1;");
echo ("<div id=\"crimestext\" align=\"center\">You left the Organized Robbery.<br /><a href=\"OR.php\">Go back.</a></div>");
include("footer.php");
}
?>