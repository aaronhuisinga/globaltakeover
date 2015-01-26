<?php
$title="Forum Management";
include("../config.php");
include("../header.php");
checks();

$result = mysql_query("SELECT level FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$lvl = $row[0];

if ($lvl < 0) {
$url .= '/members/forums/vforum.php?page=1';
header("Location: $url");
exit();
} else {

$a = $_POST['checkbox'];
if ($a == NULL) {
echo "<div align=\"center\" id='crimestext'>No topics were selected!<br /><a href=\"javascript: history.go(-1)\">Go back.</a></div>";
include("../footer.php");
exit();
}

if ($_REQUEST['delete']) {
foreach ($a as $id)
{
$row=mysql_fetch_array(mysql_query("SELECT id, postid FROM thread WHERE fid='$id' LIMIT 1;"));
$car = $row[0];
$pid=$row[1];
if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please select At least one topic!<br /><a href=\"javascript: history.go(-1)\">Go back.</a></div>";
	include("../footer.php");
	exit();
}
mysql_query("DELETE FROM post WHERE id='$pid' LIMIT 1;");
mysql_query("DELETE FROM thread WHERE fid='$id' LIMIT 1;");
$sql=mysql_query("SELECT postid FROM reply WHERE topicid='$id'");
while ($row=mysql_fetch_array($sql)){
$rid=$row[0];
mysql_query("DELETE FROM post WHERE id='$rid'");
mysql_query("DELETE FROM reply WHERE topicid='$id'");
}
}
echo "<div align=\"center\" id='crimestext'>Selected topics were deleted!<br /><a href=\"vforum.php?page=1\">Go back.</a></div>"; 
include("../footer.php");
exit();
} elseif ($_REQUEST['stick']) {
foreach ($a as $id)
{
$query = mysql_query("SELECT id, stick FROM thread WHERE fid='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$s = $row[1];
if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please select At least one topic!<br /><a href=\"javascript: history.go(-1)\">Go back.</a></div>";
	include("../footer.php");
	exit();
}

if($s == 0) {
$sql = mysql_query("UPDATE thread SET stick=1 WHERE fid='$id' LIMIT 1");
} elseif ($s == 1) {
$sql = mysql_query("UPDATE thread SET stick=0 WHERE fid='$id' LIMIT 1");
}
}
echo"<div align=\"center\" id='crimestext'>Selected topics were stuck/unstuck!<br /><a href=\"vforum.php?page=1\">Go back.</a></div>";
include("../footer.php");
} elseif ($_REQUEST['move']) {
foreach ($a as $id)
{
$query = mysql_query("SELECT id, sales FROM thread WHERE fid='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$sales = $row[1];
if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please select At least one topic!<br /><a href=\"javascript: history.go(-1)\">Go back.</a></div>";
	include("../footer.php");
	exit();
}
if ($sales == 'yes') {
	mysql_query("UPDATE thread SET sales='' WHERE fid='$id'");
	echo "<div align=\"center\" id='crimestext'>The selected thread(s) were moved to the General forum.<br /><a href=\"vforum.php?page=1\">Go back.</a></div>";
	include("../footer.php");
	exit();
} else {
	mysql_query("UPDATE thread SET sales='yes' WHERE fid='$id'");
	echo "<div align=\"center\" id='crimestext'>The selected thread(s) were moved to the Sales forum.<br /><a href=\"sforum.php?page=1\">Go back.</a></div>";
	include("../footer.php");
	exit();
}
}
} elseif ($_REQUEST['lock']) {
foreach ($a as $id)
{
$query = mysql_query("SELECT id, lo FROM thread WHERE fid='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$s = $row[1];
if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please select at least one topic!<br /><a href=\"javascript: history.go(-1)\">Go back.</a></div>";
	include("../footer.php");
	exit();
}
if($s == 0) {
$sql = mysql_query("UPDATE thread SET lo=1 WHERE fid='$id' LIMIT 1");
} elseif ($s == 1) {
$sql = mysql_query("UPDATE thread SET lo=0 WHERE fid='$id' LIMIT 1");
}
}
echo "<div align=\"center\" id=\"crimestext\">Selected topics were locked/unlocked!<br /><a href=\"vforum.php?page=1\">Go back.</a></div>";
include("../footer.php");
}
}
?>