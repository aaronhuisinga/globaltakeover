<?php
$title="Transfer Weapon Factory";
include ("config.php");
include("header.php");

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$f_ip = $_SERVER['REMOTE_ADDR'];

	$un = $_POST['uname'];
	$money = $_POST['money'];
	$tokens = $_POST['tokens'];
	$bullets = $_POST['bullets'];
	if ($money != NULL OR $tokens != NULL OR $bullets != NULL) {
		$query = mysql_query("SELECT * FROM Players WHERE username='$un'");
		$result = mysql_fetch_array($query);
		$un = $result['username'];
		$regip = $result['r_ip'];
		$lastip = $result['lastip'];
		if (mysql_num_rows($query) == 1) {
			$result = mysql_query("SELECT * FROM wf WHERE owner='$un'");
			if (mysql_num_rows($result) == 0) {
			
				if (($f_ip == $regip) OR ($f_ip == $lastip)) {
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$u', '$un', '$f_ip', 'Weapon Factory Escrow')");
				echo("<div id=\"crimestext\"><center>You cannot send a Weapon Factory to someone on the same IP as you!<br /><a href=\"wfo.php\">Go back.</a></center></div>");
				include("footer.php");
				exit();
				}
				$result = mysql_query("SELECT location FROM wf WHERE owner='$u' LIMIT 1");
				$row = mysql_fetch_array ($result);
				$l = $row[0];
			
				mysql_query("INSERT INTO wfescrow (username, other, location, money, bullets, tokens) values ('$u', '$un', '$l', '$money', '$bullets', '$tokens')");
				$subject = htmlspecialchars(addslashes("Escrow Started"));
				$message = htmlspecialchars(addslashes("$u has Started an escrow on the $l Weapon Factory!"));
				mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$un', '$u', 'unread', '$date')");
				echo("<div id=\"crimestext\"><center>An Escrow for the Weapon Factory has been started!<br /><a href=\"wf.php\">Go back.</a></center></div>");
				include("footer.php");
				exit();
		} else {
			echo ("<div id=\"crimestext\"><center>One person cannot hold two Weapon Factories!<br /><a href=\"wfo.php\">Go back.</a></center></div>");
			include("footer.php");
			exit();
		}
		} else {
			echo ("<div id=\"crimestext\"><center>Please enter a valid username!<br /><a href=\"wfo.php\">Go back.</a></center></div>");
			include("footer.php");
			exit();
		}
		} else {
			echo ("<div id=\"crimestext\"><center>Please enter a vaild amount of money to trade for!<br /><a href=\"wfo.php\">Go back.</a></center></div>");
			include("footer.php");
			exit();
		}
?>