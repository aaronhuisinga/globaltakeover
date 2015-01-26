<?php 
include("config.php");
include("Countdown_he.php");
include("countdown_p.php");
include("Countdown_m.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username, money, location FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];
$l = $row[2];

$row=mysql_fetch_array(mysql_query("SELECT owner, taxp FROM Bank WHERE location='$l' LIMIT 1;"));
$o = $row[0];
$ftx = $row[1];

if ($_POST['submit']){
$to = htmlspecialchars(addslashes("$_POST[to]"));
	$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE username = '$to' LIMIT 1"));
	$to = $row[0];
$amt = intval(strip_tags(abs($_POST['amount'])));
	if (!preg_match("/[0-9]/",$amt)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"bank.php\">Go back.</a></center></div>");
		exit();
	}
$f_ip = $_SERVER['REMOTE_ADDR'];

$rowd=mysql_fetch_array(mysql_query("SELECT money, lastip, m_n FROM Players WHERE username='$to' LIMIT 1;"));
	$bmoney = $rowd[0];
	$t_ip = $rowd[1];
	$mn = $rowd[2];
	
	if ($to == NULL) {
	echo ("<div id=\"crimestext\"><center>Please submit a vaild username. <br /> <a href=\"bank.php\">Go back.</a></center></div>");
	exit();
	}
$rowd=mysql_fetch_array(mysql_query("SELECT money FROM Players WHERE username='$o' LIMIT 1;"));
$omoney = $rowd[0];

if ($to == NULL OR $amt == NULL) {
			echo ("<div id=\"crimestext\"><center>You left a field blank, please go back and fix it! <br /> <a href=\"bank.php\">Go back.</a></center></div>");
			exit();
		} elseif ($amt > 0) {
			if ($to == $u) {
				echo("<div id=\"crimestext\"><center>You cannot send money to yourself! <br /> <a href=\"bank.php\">Go back.</a></center></div>");
		} elseif ($f_ip == $t_ip) {
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$u', '$to', '$f_ip', 'Money Transfer')");
				echo("<div id=\"crimestext\"><center>You cannot send money to someone on the same IP as you!<br /><a href=\"bank.php\">Go back.</a></center></div>");
				exit();
			} else {
				if ($money >= $amt){
					$sql = mysql_query("SELECT * FROM Players WHERE username='$to'");
					if (mysql_num_rows($sql) < 1 OR $to == NULL) {
					echo("<div id=\"crimestext\"><center>The user you are trying to send money to does not exist! <br /> <a href=\"bank.php\">Go back.</a></center></div>");
					exit();
					}
					$rower = mysql_fetch_array($sql);
					$dead = $rower['dead'];
					$banned = $rower['banned'];
					if ($dead != 0 OR $banned != 0) {
					echo("<div id=\"crimestext\"><center>The user you are trying to send money to is either dead or banned! <br /> <a href=\"bank.php\">Go back.</a></center></div>");
					exit();
					}
					$tm = $amt - ($amt * $ftx);
					$tax = $amt * $ftx;
					$om = $omoney + $tax;
					$otransfer = ($omoney + $amt);	
					mysql_query("INSERT INTO `transfers` ( `amount` , `date` , `wto` , `wfrom` , `from_ip` , `to_ip` , `location`, `tax`, `ttime` ) VALUES ('$amt', '$date', '$to', '$u', '$f_ip', '$t_ip', '$locationd', '$tax', '$current')");
					mysql_query("UPDATE Players SET money=(money-$amt) WHERE id='{$_COOKIE['id']}' LIMIT 1;");
					if ($to != $o) {
					mysql_query("UPDATE Players SET money=(money+$tm) WHERE username='$to' LIMIT 1;");
					} else {
					mysql_query("UPDATE Players SET money=(money+$amt) WHERE username='$to' LIMIT 1;");
					}
					if ($u != $o AND $to != $o) {
					mysql_query("UPDATE Players SET money=(money+$tax) WHERE username='$o' LIMIT 1;");
					}
					if ($mn == 1) {
					$subject = htmlspecialchars(addslashes("Money Tranfer Received"));
					$message = htmlspecialchars(addslashes("$u has sent you $".number_format($tm).". The money has been added to your account."));
					mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$to', 'Global Takeover', 'unread', NOW())");
					}
					echo ("<div id=\"crimestext\"><center>You sent $".number_format($amt)." to $to. There was $".number_format($tax)." tax on the tranfer. <br /> $to will receive $".number_format($tm).". <br /> <a href=\"bank.php\">Go back.</a></center></div>");
					echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
					exit();

} else {
	echo"<div id=\"crimestext\"><center>Please enter an amount of money that you have! <br /> <a href=\"bank.php\">Go back.</a></center></div>";
}
}
} else {
	echo("<div id=\"crimestext\"><center>Please enter a real amount of money! <br /> <a href=\"bank.php\">Go back.</a></center></div>");
	exit();
}
}
?>