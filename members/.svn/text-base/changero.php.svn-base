<?php
include("config.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT corps, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$c = $row[0];
$u=$row[1];
$title="$c > Change Invitation Message";
include("header.php");

$sql = mysql_query("SELECT recruit, owner, co, rightro, leftro, romsg FROM Corps WHERE name='$c' LIMIT 1;");
$row = mysql_fetch_array($sql);
$recruit = $row[0];
$own = $row[1];
$co = $row[2];
$rro = $row[3];
$lro = $row[4];
$romsg = $row[5];

if ($u != $own AND $u != $co AND $u != $rro AND $u != $lro) {
	echo "<div align=\"center\" id=\"crimestext\">You are not in charge of recruiting!</div>";
	include("footer.php");
	exit();
} else {

$p = $_POST['profile'];
$pro = addslashes($p);
$sql = mysql_query ("UPDATE Corps SET romsg='$pro' WHERE name='$c' LIMIT 1;");
echo "<div id=\"crimestext\"><center>Your invite message has been changed! <br /> <a href=\"Corps.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}
?>