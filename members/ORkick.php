<?php
$title="Organized Robbery";
include("config.php");
include("header.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT username, money, location FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];
$l = $row[2];

$t = $_GET['t'];
$row=mysql_fetch_array(mysql_query("SELECT * FROM Robbery WHERE leader='$u' LIMIT 1;"));
$cid = $row['id'];
$lname = $row['leader'];
$subject = htmlspecialchars(addslashes("Organized Robbery Update"));
$message = htmlspecialchars(addslashes("$lname has kicked you from his Organized Robbery!"));
$message2 = htmlspecialchars(addslashes("$lname canceled your invitation to his Organized Robbery!"));
if ($cid != NULL) {
	if ($t == 'dri') {
		$dname = $row['driver'];
		$query = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$dname' LIMIT 1;"));
		$id = $query['id'];
		$sql = mysql_query("UPDATE Robbery SET driver='None' WHERE id='$cid' LIMIT 1;");
		echo "<div id=\"crimestext\" align=\"center\">You have kicked the Driver, <a href=\"profile.php?id=$id\">$dname</a>, from the Robbery!<br /><a href=\"OR.php\">Go back.</a></div>";
		include("footer.php");
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$dname', 'Global Takeover', 'unread', NOW())");
		exit();
	} elseif ($t == 'ee') {
		$ename = $row['ee'];
		$query = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$ename' LIMIT 1;"));
		$id = $query['id'];
		$sql = mysql_query("UPDATE Robbery SET ee='None' WHERE id='$cid' LIMIT 1;");
		echo "<div id=\"crimestext\" align=\"center\">You have kicked the Explosives Expert, <a href=\"profile.php?id=$id\">$ename</a>, from the Robbery!<br /><a href=\"OR.php\">Go back.</a></div>";
		include("footer.php");
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$ename', 'Global Takeover', 'unread', NOW())");
		exit();
	} elseif ($t == 'wep') {
		$wname = $row['wep'];
		$query = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$wname' LIMIT 1;"));
		$id = $query['id'];
		$sql = mysql_query("UPDATE Robbery SET wep='None' WHERE id='$cid' LIMIT 1;");
		echo "<div id=\"crimestext\" align=\"center\">You have kicked the Weapons Expert (<a href=\"profile.php?id=$id\">$wname</a>) from the Robbery!<br /><a href=\"OR.php\">Go back.</a></div>";
		include("footer.php");
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$wname', 'Global Takeover', 'unread', NOW())");
		exit();
	} elseif ($t == 'idri') {
		$dname = $row['invited'];
		$query = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$dname' LIMIT 1;"));
		$id = $query['id'];
		$sql = mysql_query("UPDATE Robbery SET invited='None' WHERE id='$cid' LIMIT 1;");
		echo "<div id=\"crimestext\" align=\"center\">You canceled the invitation to the Driver, <a href=\"profile.php?id=$id\">$dname</a>, for the Robbery!<br /><a href=\"OR.php\">Go back.</a></div>";
		include("footer.php");
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message2', '$dname', 'Global Takeover', 'unread', NOW())");
		exit();
	} elseif ($t == 'iee') {
		$ename = $row['inviteee'];
		$query = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$ename' LIMIT 1;"));
		$id = $query['id'];
		$sql = mysql_query("UPDATE Robbery SET inviteee='None' WHERE id='$cid' LIMIT 1;");
		echo "<div id=\"crimestext\" align=\"center\">You canceled the invitation to the Explosives Expert, <a href=\"profile.php?id=$id\">$ename</a>, for the Robbery!<br /><a href=\"OR.php\">Go back.</a></div>";
		include("footer.php");
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message2', '$ename', 'Global Takeover', 'unread', NOW())");
		exit();
	} elseif ($t == 'iwep') {
		$wname = $row['invitew'];
		$query = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$wname' LIMIT 1;"));
		$id = $query['id'];
		$sql = mysql_query("UPDATE Robbery SET invitew='None' WHERE id='$cid' LIMIT 1;");
		echo "<div id=\"crimestext\" align=\"center\">You canceled the invitation to the Weapons Expert, <a href=\"profile.php?id=$id\">$wname</a>, for the Robbery!<br /><a href=\"OR.php\">Go back.</a></div>";
		include("footer.php");
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message2', '$wname', 'Global Takeover', 'unread', NOW())");
		exit();
	}
} else {
	echo "<div id=\"crimestext\" align=\"center\">You are not the leader of an Organized Robbery!<br /><a href=\"OR.php\">Go back.</a></div>";
	include("footer.php");
}
?>