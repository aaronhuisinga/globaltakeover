<?php
$title="Send Port";
include ("config.php");
include("header.php");

$result = mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
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
			$result = mysql_query("SELECT * FROM port WHERE owner='$un'");
			if (mysql_num_rows($result) == 0) {
			
				if (($f_ip == $regip) OR ($f_ip == $lastip)) {
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$u', '$un', '$f_ip', 'Port Escrow')");
				echo("<div id=\"crimestext\"><center>You cannot send a Port to someone on the same IP as you!<br /><a href=\"porto.php\">Go back.</a></center></div>");
				include("members/footer.php");
				exit();
				}
				
				$result = mysql_query("SELECT location FROM port WHERE owner='$u' LIMIT 1");
				$row = mysql_fetch_array ($result);
				$l = $row[0];
			 				
				$result = mysql_query("INSERT INTO pescrow (username, other, location, money, bullets, tokens) values ('$u', '$un', '$l', '$money', '$bullets', '$tokens')");
				$subject = htmlspecialchars(addslashes("Escrow Started"));
				$message = htmlspecialchars(addslashes("$u has Started an escrow on the $l Port!"));
				$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$un', '$u', 'unread', '$date')");
				echo("<div id=\"crimestext\"><center>An Escrow for the Port has been started!<br /><a href=\"/port.php\">Go back.</a></center></div>");
				include("members/footer.php");
				mysql_close();
				exit();
			
		} else {
			echo ("<div id=\"crimestext\"><center>One person cannot hold two Ports!<br /><a href=\"porto.php\">Go back.</a></center></div>");
			include("members/footer.php");
			mysql_close();
			exit();
		}
		} else {
			echo ("<div id=\"crimestext\"><center>Please enter a valid username!<br /><a href=\"porto.php\">Go back.</a></center></div>");
			include("members/footer.php");
			mysql_close();
			exit();
		}
		} else {
			echo ("<div id=\"crimestext\"><center>Please enter a vaild amount of money to trade for!<br /><a href=\"porto.php\">Go back.</a></center></div>");
			include("members/footer.php");
			mysql_close();
			exit();
		}
?>