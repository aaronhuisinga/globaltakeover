<?php
require_once("config.php");
$query = "SELECT health, location, mission, username FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$h = $row[0];
$l = $row[1];
$m = $row[2];
$u = $row[3];
$arr = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);

foreach ($arr as $mn) {
if ($l == 'Philippines') {
if ($m == 11) {
echo '<div id="crimestext" align="center">You have successfully completed all the missions in the Philippines. Well Done!</div>';
exit();
} elseif ($mn == $m) {
$url .= "/members/mission$mn.php";
	header("Location: $url");
	exit();
}
} elseif ($l != 'Philippines') {
if ($mn == $m) {
$query = mysql_query("SELECT * FROM mission$mn WHERE username = '$u'");
$row = mysql_fetch_array($query);
$misstats = $row['missionstats'];
if ($misstats == 2 OR $misstats == 1 OR $misstats == 3 OR $misstats == 4) {
$url .= "/members/mission$mn.php";
	header("Location: $url");
	exit();
}
}
}
}
?>