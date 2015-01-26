<?php
$title="Kills";
include("config.php");
include("header.php");
checks();
online();

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
	mysql_query("DELETE FROM spies WHERE id='$id' LIMIT 1;");
	echo ("<div id=\"ltable\"><center>The hunt has been deleted.<br /><a href=\"/kills.php\">Go back.</a></center></div>");
	include("footer.php");
}
?>