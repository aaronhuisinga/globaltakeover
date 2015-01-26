<?php
include("config.php");
include('Rank-ups.inc.php');
checks();

$result = mysql_query("SELECT username, corps FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$user = $row[0];
$corp = addslashes($row[1]);

$a = $_POST['checkbox'];
if($a == NULL){
	echo"<div align=\"center\" id='crimestext'>There are no Planes selected!<br /><a href=\"corphanger.php\">Go back</a></div>";
	exit();
}
if ($_REQUEST['Submit']) {

$vs = 0;
foreach ($a as $id)
{
$query = mysql_query("SELECT plane, percent FROM changer WHERE id='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$p = $row[1];
$np = $p/100;
if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please Select At Least One Plane<br /><a href=\"corphanger.php\">Go back</a></div>";
	exit;
}
if ($car == 'Training Plane') {
$mv = 10000 * $np;
} elseif ($car == 'Glider') {
$mv = 67500 * $np;
} elseif ($car == 'Passenger Plane') {
$mv = 90000 * $np;
} elseif ($car == 'Jumbo Jet') {
$mv = 135000 * $np;
} elseif ($car == 'Vulcan Bomber') {
$mv = 175000 * $np;
} elseif ($car == 'F15 Fighter') {
$mv = 250000 * $np;
} elseif ($car == 'Eagle Fighter') {
$mv = 350000 * $np;
} elseif ($car == 'Stealth Fighter') {
$mv = 475000 * $np;
} elseif ($car == 'Eurofighter Typhoon') {
$mv = 600000 * $np;
}
$vs = $vs + 1;
$tv = $tv + $mv;
$sql = mysql_query("INSERT INTO `csvehicles` (`corp`, `carid`, `price`, `type`) VALUES ('$corp', '$id', '$mv', 'h')");
}

echo "<div align=\"center\" id='crimestext'>Do you want to sell $vs Planes for $".number_format($tv)."?";
echo "<form action=\"chsell.php\" method=\"POST\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /><input type=\"submit\" name=\"submit2\" value=\"No\" /></form></div>";
exit();

} elseif ($_REQUEST['Submit2']) {


foreach ($a as $id)
{
$query = mysql_query("SELECT plane, percent FROM changer WHERE id='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$p = $row[1];
$np = 100 - $p;
$nnp = $np/100;
if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please Select At Least One Plane<br /><a href=\"corphanger.php\">Go back</a></div>";
	exit();
}
if ($car == 'Training Plane') {
$mv = 10000 * $np;
} elseif ($car == 'Glider') {
$mv = 67500 * $np;
} elseif ($car == 'Passenger Plane') {
$mv = 90000 * $np;
} elseif ($car == 'Jumbo Jet') {
$mv = 135000 * $np;
} elseif ($car == 'Vulcan Bomber') {
$mv = 175000 * $np;
} elseif ($car == 'F15 Fighter') {
$mv = 250000 * $np;
} elseif ($car == 'Eagle Fighter') {
$mv = 350000 * $np;
} elseif ($car == 'Stealth Fighter') {
$mv = 475000 * $np;
} elseif ($car == 'Eurofighter Typhoon') {
$mv = 600000 * $np;
}
$vs = $vs + 1;
$t = 150 + $mv;
$tv = $tv + $t;
$sql = mysql_query("INSERT INTO `crvehicles` (`corp`, `carid`, `price`, `type`) VALUES ('$corp', '$id', '$t', 'h')");
}

echo "<div align=\"center\" id='crimestext'>Do you want to repair $vs Planes for $".number_format($tv)."?";
echo "<form action=\"chrepair.php\" method=\"POST\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /><input type=\"submit\" name=\"submit2\" value=\"No\" /></form></div>";
exit();
		   
		   
} elseif ($_REQUEST['Submit3']) {
$query = mysql_query("SELECT money FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array($query);
$m = $row[0];
if($m <= 5000) {
	echo("<div align=\"center\" id='crimestext'>You do not have enough money!<br /><a href=\"corphanger.php\">Go back</a></div>");
	exit();
}
$vs = 0;	
foreach ($a as $id)
{
$query = mysql_query("SELECT plane, corp, percent FROM changer WHERE id='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$oldowner = $row[1];
$corpcarp = $row[2];

$newowner = escape_data($_POST['to']);
$query  = mysql_query("SELECT username FROM Players WHERE username = '$newowner' LIMIT 1");
					$row = mysql_fetch_array($query);
					$tuser = $row[0];
					if ($tuser == NULL){
					echo("<div id=\"crimestext\"><center>The user you are trying to send money to does not exist!<br /><a href=\"bank.php\">Go back.</a></center></div>");
					exit();
					}

if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please Select At Least One Plane.<br /><a href=\"corphanger.php\">Go back</a></div>";
	exit();
}
$query = mysql_query("INSERT INTO `hanger` (`id` , `username` , `plane` , `percent` ) VALUES ('', '$tuser', '$car', '$corpcarp')");
$query = mysql_query("DELETE FROM `changer` WHERE id='$id'");
$vs = $vs + 1;
}
}

if ($price > $m) {
echo ("<div align=\"center\" id='crimestext'>You do not have enough money!<br /><a href=\"corphanger.php\">Go back</a></div>");
} else {	   
$query = mysql_query("UPDATE Players SET money='$m' WHERE id='{$_COOKIE['id']}'");
mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('5000', '$date', '$user', 'Loss', '$current', 'Corp Send Plane')");
if ($vs == 1) {

$subject = htmlspecialchars(addslashes("Vehicle Transfer Received"));
					$message = htmlspecialchars(addslashes("$corp has sent you $vs plane. It was added to your Hanger."));
					$recipient = $tuser;
					$from = htmlspecialchars(addslashes("Global Takeover"));
					$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , '$from', 'unread', NOW())");
					
echo ("<div align=\"center\" id='crimestext'>You transferred $vs plane to $tuser.<br /><a href=\"corphanger.php\">Go back</a></div>");
exit();
} else {

$subject = htmlspecialchars(addslashes("Vehicle Transfer Received"));
					$message = htmlspecialchars(addslashes("$corp has sent you $vs planes. They have been added to your Hanger."));
					$recipient = $tuser;
					$from = htmlspecialchars(addslashes("Global Takeover"));
					$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$recipient', '$from', 'unread', NOW())");
					
echo ("<div align=\"center\" id='crimestext'>You transferred $vs planes to $tuser.<br /><a href=\"corphanger.php\">Go back</a></div>");
exit();
}
}
?>