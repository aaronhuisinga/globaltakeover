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
	$query = "SELECT health, username, location, bullets, rank, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$uhealth = $row['health'];
	$user = $row['username'];
	$l = $row['location'];
	$ubullets = $row['bullets'];
	$urank = $row['rank'];
	$umoney = $row['money'];
	
	if ($uhealth == 0) {
	 	$url .= '/dead.html';
		header("Location: $url");
			
	} else {
	
	$gather=mysql_query("SELECT time, number, target, length, id, find, hunter FROM mspies WHERE id='$id'"); 
	$row = mysql_fetch_assoc($gather);

	$starttime= $row['time'];
	$spies = $row['number'];
	$target = $row['target'];
	$length = $row['length'];
	$find = $row['find'];
	$hunter = $row['hunter'];
	$actualDate = time();
$secondsDiff = $actualDate - $starttime;
$expire = ($length + 14400);
	
if ($secondsDiff <= $length) {
echo ("<div id='crimestext' align='center'>Your hunt hasn't finished yet!<br><a href=\"missions.php\">Go Back</a></div>");
exit();
} elseif ($secondsDiff >= $expire) {
echo ("<div id='crimestext' align='center'>Your hunt has expired!<br><a href=\"missions.php\">Go Back</a></div>");
exit();
} else {

if ($find == 'yes') {


} elseif ($find == 'no') {
echo ("<div id='crimestext' align='center'>Your hunt has failed!<br><a href=\"missions.php\">Go Back</a></div>");
exit();
}
	if ($user != $hunter) {
	echo ("<div id=\"gameplay\"><center>You must be the one who did the hunt to complete the mission!<br />
	<a href=\"/members/missions.php\">Go back.</a></center></div>");
	exit();
	} else {
	$sql = mysql_query("DELETE FROM mspies WHERE id='$id'");
	$sql = mysql_query("UPDATE mission7 SET missionstats = '3' WHERE username = '$user'");
	echo "<div id=\"crimestext\" align=\"center\">Thank you, $user! We will now finish our plans before attempting the Robbery!<br>
	<form action=\"mission7.php\" method= \"POST\"><input type=\"submit\" name=\"Finish\" value=\"Finish Mission!\"></form></div>";
	exit();
	}
	}
	}}
	?>