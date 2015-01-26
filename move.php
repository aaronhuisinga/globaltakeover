<?php
$title="Move Topics";
include("../config.php");
include("../header.php");
checks();

if ($lvl < 0) {
$url .= '/members/forums/vforum.php?page=1';
header("Location: $url");
exit();
} else {

$a = $_POST['checkbox'];
if ($a == NULL) {
echo "<div id=\"crimestext\" align=\"center\">No topics were selected!<br /><a href=\"vforum.php?page=1\">Go back.</a></div>";
include("../footer.php");
exit();
}

if ($_REQUEST['move']) {
foreach ($a as $id)
{
$query = mysql_query("SELECT id, sales FROM thread WHERE fid='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$sales = $row[1];
if ($car == NULL) {
	echo "<div id=\"crimestext\" align=\"center\">No topics were selected!<br /><a href=\"vforum.php?page=1\">Go back.</a></div>";
	include("../footer.php");
	exit();
}
if ($sales == 'yes') {
	mysql_query("UPDATE thread SET sales='' WHERE fid='$id'");
	echo "<div align=\"center\" id='crimestext'>The selected thread(s) were moved to the General forum.<br /><a href=\"sforum.php?page=1\">Go back.</a></div>";
	include("../footer.php");
	exit();
} else {
	mysql_query("UPDATE thread SET sales='yes' WHERE fid='$id'");
	echo "<div align=\"center\" id='crimestext'>The selected thread(s) were moved to the Sales forum.<br /><a href=\"vforum.php?page=1\">Go back.</a></div>";
	include("../footer.php");
	exit();
}
}
}
}
?>