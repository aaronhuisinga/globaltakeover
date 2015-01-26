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
	echo"<div align=\"center\" id='crimestext'>There are no Vehicles selected!<br /><a href=\"corpgarage.php\">Go back</a></div>";
	exit();
}
if ($_REQUEST['Submit']) {

$vs = 0;
foreach ($a as $id)
{
$query = mysql_query("SELECT car, percent FROM cgarage WHERE id='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$p = $row[1];
$np = $p/100;
if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please Select At Least One Vehicle<br /><a href=\"corpgarage.php\">Go back</a></div>";
	exit();
}
if ($car == 'Jeep') {
$mv = 10000 * $np;
} elseif ($car == 'Buggy') {
$mv = 25000 * $np;
} elseif ($car == 'Range Rover') {
$mv = 55000 * $np;
} elseif ($car == 'Lorry') {
$mv = 75000 * $np;
} elseif ($car == 'APV') {
$mv = 125000 * $np;
} elseif ($car == 'Hummer H3') {
$mv = 200000 * $np;
} elseif ($car == 'Patrol Car') {
$mv = 350000 * $np;
} elseif ($car == 'Barracks OL') {
$mv = 450000 * $np;
} elseif ($car == 'Tank') {
$mv = 600000 * $np;
}
$vs = $vs + 1;
$tv = $tv + $mv;
$sql = mysql_query("INSERT INTO `csvehicles` (`corp`, `carid`, `price`, `type`) VALUES ('$corp', '$id', '$mv', 'g')");
}

echo "<div align=\"center\" id='crimestext'>Do you want to sell $vs Vehicles for $".number_format($tv)."?";
echo "<form action=\"cgsell.php\" method=\"POST\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /><input type=\"submit\" name=\"submit2\" value=\"No\" /></form></div>";
exit();

} elseif ($_REQUEST['Submit2']) {


foreach ($a as $id)
{
$query = mysql_query("SELECT car, percent FROM cgarage WHERE id='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$p = $row[1];
$np = 100 - $p;
$nnp = $np/100;
if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please Select At Least One Vehicle<br /><a href=\"corpgarage.php\">Go back</a></div>";
	exit();
}
if ($car == 'Jeep') {
$mv = 10000 * $nnp;
} elseif ($car == 'Buggy') {
$mv = 25000 * $nnp;
} elseif ($car == 'Range Rover') {
$mv = 55000 * $nnp;
} elseif ($car == 'Lorry') {
$mv = 75000 * $nnp;
} elseif ($car == 'APV') {
$mv = 125000 * $nnp;
} elseif ($car == 'Hummer H3') {
$mv = 200000 * $nnp;
} elseif ($car == 'Patrol Car') {
$mv = 350000 * $nnp;
} elseif ($car == 'Barracks OL') {
$mv = 450000 * $nnp;
} elseif ($car == 'Tank') {
$mv = 600000 * $nnp;
}
$vs = $vs + 1;
$t = 150 + $mv;
$tv = $tv + $t;
$sql = mysql_query("INSERT INTO `crvehicles` (`corp`, `carid`, `price`, `type`) VALUES ('$corp', '$id', '$t', 'g')");
}

echo "<div align=\"center\" id='crimestext'>Do you want to repair $vs Vehicles for $".number_format($tv)."?";
echo "<form action=\"cgrepair.php\" method=\"POST\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /><input type=\"submit\" name=\"submit2\" value=\"No\" /></form></div>";
exit();
		   
		   
} elseif ($_REQUEST['Submit3']) {
$query = mysql_query("SELECT money FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array($query);
$m = $row[0];
if($m <= 5000) {
	echo("<div align=\"center\" id='crimestext'>You do not have enough money!<br /><a href=\"corpgarage.php\">Go back</a></div>");
	exit();
}
$vs = 0;	
foreach ($a as $id)
{
$query = mysql_query("SELECT car, corp, percent FROM cgarage WHERE id='$id'");
$row = mysql_fetch_array($query);
$car = $row[0];
$oldowner = $row[1];
$corpcarp = $row[2];

$newowner = escape_data($_POST['to']);
$query  = mysql_query("SELECT username FROM Players WHERE username = '$newowner' LIMIT 1");
					$row = mysql_fetch_array($query);
					$tuser = $row[0];
					if ($tuser == NULL){
					echo("<div id=\"crimestext\"><center>The user you are trying to send money to does not exist!<br />
					<a href=\"bank.php\">Go back.</a></center></div>");
					exit();
					}

if ($car == NULL) {
	echo "<div align=\"center\" id='crimestext'>Please Select At Least One vehicle.<br /><a href=\"corpgarage.php\">Go back</a></div>";
	exit();
}
$query = mysql_query("INSERT INTO `garage` (`id` , `username` , `car` , `percent` ) VALUES ('', '$tuser', '$car', '$corpcarp')");
$query = mysql_query("DELETE FROM `cgarage` WHERE id='$id'");
$vs = $vs + 1;
}
}

if ($price > $m) {
echo ("<div align=\"center\" id='crimestext'>You do not have enough money!<br />
<a href=\"corpgarage.php\">Go back</a></div>");
} else {	   
$query = mysql_query("UPDATE Players SET money='$m' WHERE id='{$_COOKIE['id']}'");
mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('5000', '$date', '$user', 'Loss', '$current', 'Corp Send Car')");
if ($vs == 1) {

$subject = htmlspecialchars(addslashes("Vehicle Transfer Received"));
					$message = htmlspecialchars(addslashes("$corp has sent you $vs vehicle. It was added to your Garage."));
					$recipient = $tuser;
					$from = htmlspecialchars(addslashes("Global Takeover"));
					$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$recipient', '$from', 'unread', NOW())");
					
echo ("<div align=\"center\" id='crimestext'>You transferred $vs vehicle to $tuser.<br /><a href=\"corpgarage.php\">Go back</a></div>");
exit();
} else {

$subject = htmlspecialchars(addslashes("Vehicle Transfer Received"));
					$message = htmlspecialchars(addslashes("$corp has sent you $vs vehicles. They have been added to your Garage."));
					$recipient = $tuser;
					$from = htmlspecialchars(addslashes("Global Takeover"));
					$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$recipient', '$from', 'unread', NOW())"); 
					
echo ("<div align=\"center\" id='crimestext'>You transferred $vs vehicles to $tuser.<br /><a href=\"corpgarage.php\">Go back</a></div>");
exit();
}
}
?>