<?php
$title="Swiss Bank > Manage Finances";
include ("config.php");
include("header.php");
checks();
online();

			$anum = $_POST['anum'];
			$f_ip = $_SERVER['REMOTE_ADDR'];
			$b = intval(strip_tags(abs($_POST['deposit'])));
	
	if (!preg_match("/[0-9]/",$b)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"swiss.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
	}
			$tb = intval(strip_tags(abs($_POST['take'])));
	
	if (!preg_match("/[0-9]/",$tb)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"swiss.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
	}
		if ($b > 0 OR $tb > 0) {
			if (isset($_REQUEST['submit'])) {
				$query = "SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;";
				$result = @mysql_query ($query);
				$row = mysql_fetch_array ($result);
					$u = $row[0];
					$pb = $row[1];
					$npb = $pb - $b;
					if ($pb >= $b) {
				
				
				$result = mysql_query("SELECT bal, username, ip FROM swiss WHERE account='$anum' LIMIT 1");
				$row = mysql_fetch_array ($result);
					$accip = $row[2];
					$owner = $row[1];
					$bb = $row[0];
					
				$result = mysql_query("SELECT * FROM swisslogs WHERE account='$anum' AND ip='$f_ip'");
				$row = mysql_fetch_array ($result);
					$suser = $row['username'];
					
				$result = mysql_query("SELECT lastip, r_ip, dead, banned FROM Players WHERE username='$suser' LIMIT 1");
				$row2 = mysql_fetch_array ($result);
					$slastip = $row2[0];
					$sregip = $row2[1];
					$sdead = $row[2];
					$sbanned = $row[3];
					
				if (($f_ip == $slastip OR $f_ip == $sregip) AND ($sbanned == 1 OR $sdead == 1) AND $u != $owner) {
				echo("<div id=\"crimestext\"><center>You cannot use this account from the same IP of another player!  <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
				include("footer.php");
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$u', '$owner', '$f_ip', 'Swiss Account Deposit same as other user')");
				mysql_close();
				exit();
				}
				
				$result = mysql_query("SELECT lastip, r_ip, dead, banned FROM Players WHERE username='$owner' LIMIT 1");
				$row2 = mysql_fetch_array ($result);
					$lastip = $row2[0];
					$regip = $row2[1];
					$dead = $row[2];
					$banned = $row[3];
				if (($f_ip == $accip OR $f_ip == $lastip OR $f_ip == $regip) AND ($banned == 1 OR $dead == 1) AND $u != $owner) {
				echo("<div id=\"crimestext\"><center>You cannot use this account from the same IP of another player!  <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
				include("footer.php");
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$u', '$owner', '$f_ip', 'Swiss Account Deposit same as owner')");
				mysql_close();
				exit();
				}
					$db = $b*0.94;
					if (($bb + $db) > 600000000) {
					echo("<div id=\"crimestext\"><center>You cannot have more than $600,000,000 in a Swiss Account!  <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
					include("footer.php");
					mysql_close();
					exit();
					}
			 		$nbb = $bb + $db;	
				
				$query = mysql_query("UPDATE swiss SET bal='$nbb' WHERE account='$anum'");
				$query = "UPDATE Players SET money='$npb' WHERE id='{$_COOKIE['id']}'";
				$result = @mysql_query ($query);
				echo("<div id=\"crimestext\"><center>$".number_format($db)." was added to the account, after tax! <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
				include("footer.php");
				mysql_query("INSERT INTO swisslogs (username, account, type, amount, ip) VALUES ('$u', '$anum', 'deposit', '$db', '$f_ip')");
				mysql_close();
				exit();
				} else {
					echo("<div id=\"crimestext\"><center>Please enter an amount of money you actually have! <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
					include("footer.php");
				mysql_close();
				exit();
				}
			} elseif (isset($_REQUEST['submit2'])) {
				$query = "SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;";
				$result = @mysql_query ($query);
				$row = mysql_fetch_array ($result);
					$u = $row[0];
					$pb = $row[1];
					$npb = $pb + $tb;
				
				
				$query = "SELECT bal, username, ip FROM swiss WHERE account='$anum' LIMIT 1";
				$result = @mysql_query ($query);
				$row = mysql_fetch_array ($result);
					$accip = $row[2];
					$owner = $row[1];
					$bb = $row[0];
			 		$nbb = $bb - $tb;
			 	$result = mysql_query("SELECT lastip, r_ip, dead, banned FROM Players WHERE username='$owner' LIMIT 1");
				$row2 = mysql_fetch_array ($result);
					$lastip = $row2[0];
					$regip = $row2[1];
					$dead = $row[2];
					$banned = $row[3];
				if (($f_ip == $accip OR $f_ip == $lastip OR $f_ip == $regip) AND ($banned == 1 OR $dead == 1) AND $u != $owner) {
				echo("<div id=\"crimestext\"><center>You cannot use this account from the same IP of another player!  <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
				include("footer.php");
				$result = mysql_query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$u', '$owner', '$f_ip', 'Swiss Account Withdrawl')");
				mysql_close();
				exit();
				}
				if ($bb >= $tb) {
				$query = "UPDATE Players SET money='$npb' WHERE id='{$_COOKIE['id']}'";
				$result = @mysql_query ($query);
				$query = "UPDATE swiss SET bal='$nbb' WHERE account='$anum'";
				$result = @mysql_query ($query);
				mysql_query("INSERT INTO swisslogs (username, account, type, amount, ip) VALUES ('$u', '$anum', 'withdrawl', '$tb', '$f_ip')");
				echo("<div id=\"crimestext\"><center>$".number_format($tb)." was taken from the account! <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
				include("footer.php");
				mysql_close();
				exit();
				} else {
				echo("<div id=\"crimestext\"><center>Please enter an amount of money that is actually in the account! <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
				include("footer.php");
				mysql_close();
				exit();
				}
			}
			
		} else {
		
			echo ("<div id=\"crimestext\"><center>Please enter a valid amount of money! <br /> <a href=\"swiss.php\">Go back.</a></center></div>");
			include("footer.php");
			mysql_close();
			exit();
		}
		?>