<?php
ob_start(); 
include("config.php");
include("Online.php");
include ("profilecode.php");
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

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
	$query = "SELECT health, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$h = $row['health'];
	$u = $row['username'];
	if ($h == 0) {
	 	$url .= '/dead.html';
		header("Location: $url");
		
	} else {
	$query = mysql_query("SELECT target FROM mspies WHERE hunter = '$u'");
	$row = mysql_fetch_array($query);
	$target = $row[0];
	if ($target == 'Jonah' OR $target == 'Oonelth') {
	$ms = 1;
	} elseif ($target == 'Carmine' OR $target == 'Natalya') {
	$ms = 3;
	}
	$sql = mysql_query("DELETE FROM mspies WHERE id='$id'");
	$sql = mysql_query("UPDATE mission3 SET missionstats = '$ms' WHERE username = '$u'");
	$sql = mysql_query("UPDATE mission4 SET missionstats = '1' WHERE username = '$u'");
	$sql = mysql_query("UPDATE mission6 SET missionstats = '1' WHERE username = '$u'");
	$sql = mysql_query("UPDATE mission7 SET missionstats = '1' WHERE username = '$u'");
	$sql = mysql_query("UPDATE mission9 SET missionstats = '1' WHERE username = '$u'");
	$sql = mysql_query("UPDATE mission10 SET missionstats = '$ms' WHERE username = '$u'");
	echo ("<div id=\"gameplay\"><center>The hunt has been deleted.<br />
	<a href=\"/members/missions.php\">Go back.</a></center></div>");
}
}
?>