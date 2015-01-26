<?php
include("config.php");
include("Banned.php");

$query = "SELECT theme, health, username FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$username = $row[2];
$theme = $row[0];
$h = $row[1];
$f_ip = $_SERVER['REMOTE_ADDR'];

if (!isset($_COOKIE['id'])) {
$url .= '/login.php';
header("Location: $url");
exit();
} 
if ($h == 0) {
 	$url .= '/dead.php';
	header("Location: $url");
	exit();	
}

$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

	$pc = intval(strip_tags(abs($_POST['ca'])));
	$un = $_POST['uname'];
	$money = intval(strip_tags(abs($_POST['money'])));
	$bullets = intval(strip_tags(abs($_POST['bullets'])));
	
	if (!preg_match("/[0-9]/",$bullets)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"escrow.php\">Go back.</a></center></div>");
		exit();
	}
	
	if (0 < $pc) {
		$query = mysql_query("SELECT * FROM Players WHERE username='$un'");
		$result = mysql_fetch_array($query);
		$un = $result['username'];
		$regip = $result['r_ip'];
		$lastip = $result['lastip'];
		if (mysql_num_rows($query) == 1) {
		
			if (($f_ip == $regip) OR ($f_ip == $lastip)) {
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$username', '$un', '$f_ip', 'Token Escrow')");
				echo("<div id=\"crimestext\"><center>You cannot send Tokens to someone on the same IP as you!<br /><a href=\"escrow.php\">Go back.</a></center></div>");
				exit();
			}
			
			$query = "SELECT tokens, username FROM Players WHERE id='{$_COOKIE['id']}'";
			$result = @mysql_query ($query);
			$row = mysql_fetch_array ($result);
			
			$c = $row[0];
			$u = $row[1];
			
			$date = (date("M d Y h:i:s A"));
			
			$query = "SELECT tokens, id FROM Players WHERE username='$un'";
				$result = @mysql_query ($query);
				$row = mysql_fetch_array ($result);
				
				$d = $row[0];
				$z = $row[1];
				$n_d = $d + $pc;
				$n_c = $c - $pc;
				
			if ($c >= $pc) {
				$a = md5(uniqid(rand(), true));
				$nc = $c - $pc;
				mysql_query("UPDATE Players SET tokens ='$nc' WHERE id='{$_COOKIE['id']}'");
				mysql_query("INSERT INTO `tescrow` ( `amount` , `money` , `bullets` , `date` , `username` , `other` , `from_ip` , `to_ip`, `finished`, random) VALUES ('$pc', '$money', '$bullets', '$date', '$u', '$un', '$f_ip', '$t_ip', 'Pending', '$a')");
					$subject = htmlspecialchars(addslashes("Token Escrow Received"));
					$message = htmlspecialchars(addslashes("$u has sent you an escrow for ".number_format($pc)." Tokens."));
					$recipient = $un;
					$from = htmlspecialchars(addslashes("Global Takeover"));
					$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , 
					`touser` , `from` , `unread` , 
					`date` ) VALUES ('$subject', '$message', '$recipient', 
					'$from', 'unread', NOW())");
					$result = @mysql_query($send);
				echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>You sent the escrow to $un!<br />
<a href=\"escrow.php\">Go back.</a></center></div>
</body></html>");
echo ('<script language="javascript">
	  				window.parent.stats.location.reload();
	  				</script>');
				mysql_close();
				exit();
			} elseif ($c <= $pc) {
				
				echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>Please enter an amount of Tokens that you actually have.<br />
<a href=\"escrow.php\">Go back.</a></center></div>
</body></html>");
				mysql_close();
				exit();
			} elseif ($f_ip == $t_ip) {
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$u', '$un', '$f_ip', 'Token Transfer')");
				echo ("<div id=\"crimestext\"><center>You cannot send Tokens to a player using the same IP as you. <br /> <a href=\"escrow.php\">Go back.</a></center></div>");
				mysql_close();
				exit();
			}
		} else {
		
			echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>Please enter a valid username!<br />
<a href=\"escrow.php\">Go back.</a></center></div>
</body></html>");
			mysql_close();
			exit();
		}
	} else {
		
		echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>Please enter an amount of Tokens greater than 0!<br />
<a href=\"escrow.php\">Go back.</a></center></div>
</body></html>");
		mysql_close();
		exit();
	}
?>