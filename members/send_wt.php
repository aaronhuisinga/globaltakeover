<?php
$title="Send Bank";
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
			$result = mysql_query("SELECT * FROM WT WHERE Owner='$un'");
			if (mysql_num_rows($result) == 0) {
			
				if (($f_ip == $regip) OR ($f_ip == $lastip)) {
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$u', '$un', '$f_ip', 'War Table Escrow')");
				echo("<div id=\"crimestext\"><center>You cannot send a War Table to someone on the same IP as you!<br /><a href=\"wto.php\">Go back.</a></center></div>");
				include("members/footer.php");
				exit();
				}
				
				$result = mysql_query("SELECT location FROM WT WHERE Owner='$u' LIMIT 1");
				$row = mysql_fetch_array ($result);
				$l = $row[0];
			 				
				$result = mysql_query("INSERT INTO wtescrow (username, other, location, money, bullets, tokens) values ('$u', '$un', '$l', '$money', '$bullets', '$tokens')");
				$subject = htmlspecialchars(addslashes("Escrow Started"));
				$message = htmlspecialchars(addslashes("$u has Started an escrow for the $l War Table!"));
				$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$un', '$u', 'unread', '$date')");
				echo("<div id=\"crimestext\"><center>An Escrow for the War Table has been started!<br /><a href=\"/wt.php\">Go back.</a></center></div>");
				include("members/footer.php");
				mysql_close();
				exit();
			
		} else {
			echo ("<div id=\"crimestext\"><center>One person cannot hold two War Tables!<br /><a href=\"wto.php\">Go back.</a></center></div>");
			include("members/footer.php");
			mysql_close();
			exit();
		}
		} else {
			echo ("<div id=\"crimestext\"><center>Please enter a valid username!<br /><a href=\"wto.php\">Go back.</a></center></div>");
			include("members/footer.php");
			mysql_close();
			exit();
		}
		} else {
			echo ("<div id=\"crimestext\"><center>Please enter a valid amount of money to trade for!<br /><a href=\"wto.php\">Go back.</a></center></div>");
			include("members/footer.php");
			mysql_close();
			exit();
		}
?>