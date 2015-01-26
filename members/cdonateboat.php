<?php
include("config.php");
include('Rank-ups.inc.php');
checks();

$result = mysql_query("SELECT username, corps, theme FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$user = $row[0];
$corp = addslashes($row[1]);
$cname = stripslashes($corp);

$sql = mysql_query("DELETE FROM rvehicles WHERE username = '$user'");
$sql = mysql_query("DELETE FROM svehicles WHERE username = '$user'");

$a = $_POST['checkbox'];
if($a == NULL){
	echo"<div align=\"center\" id='crimestext'>There are no Boats selected! <br /> <a href=\"corpdock.php\">Go back</a></div>";
	exit();
}
if ($_REQUEST['Submit']) {

$vs = 0;
foreach ($a as $caid)
{
$query = mysql_query("SELECT boat, percent FROM dock WHERE id='$caid'");
$row = mysql_fetch_array($query);
$car = $row[0];
$p = $row[1];

if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>There are no Boats selected! <br /> <a href=\"corpdock.php\">Go back</a></div>";
	exit();
}

$sql = mysql_query("INSERT INTO `cdock` (`id`, `corp`, `boat`, `percent`) VALUES ('', '$corp', '$car', '$p')");
$sql = mysql_query("DELETE FROM `dock` WHERE id='$caid'");
}
echo ("<div align=\"center\" id='crimestext'>The boats that you selected were donated to $cname. <br /> <a href=\"corpdock.php\">Go back</a></div>");
exit();
}
?>