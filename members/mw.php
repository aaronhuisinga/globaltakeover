<?php
$title="Most Wanted";
include("config.php");
include("header.php");
include("Countdown_he.php");
checks();
online();

	if (isset($_REQUEST['submit'])) {
		$who=mysql_fetch_array(mysql_query("SELECT username, money, tokens FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
		$u = $who[0];
		$m = $who[1];
		$token = $who[2];
		$a = $_POST['checkbox'];
		$w = $_POST['tu'];
		$row=mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$w' LIMIT 1;"));
		$cid = $row[0];
		if ($cid == NULL) {
			echo "<div align=\"center\" id=\"crimestext\">Please enter a valid username!<br /><a href=\"mostwanted.php\">Go back.</a></div>";
			include("footer.php");
			exit(); 
		} else {
		$p = intval(strip_tags(abs($_POST['b'])));
	
	if (!preg_match("/[0-9]/",$p)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
	}
		$r = addslashes($_POST['r']);
		$t = intval(strip_tags(abs($_POST['t'])));
	
	if (!preg_match("/[0-9]/",$t)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
	}

		if ($w == NULL OR $u == NULL OR $p == NULL OR $r == NULL) {
			echo ("<div id=\"crimestext\"><center>You left a field blank, please go back and change it!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>");
			include("footer.php");
			exit();
		} elseif (($p > 0 AND $p <= 19000000000000000) OR ($t > 0 AND $t <= 19000000000000000)) {
			if ($w == $u) {
				echo("<div id=\"crimestext\"><center>You cannot put yourself on this list!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>");
				include("footer.php");
			} else {
				if ($m >= $p){
				if ($token >= $t) {
					$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE username = '$w' LIMIT 1"));
					$w = $row[0];
					if ($w == NULL){
					echo("<div id=\"crimestext\"><center>No Such Username!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>");
					include("footer.php");
					exit();
					}
					if ($a == NULL) {
					if ($m >= ($p + 100000)){
					$nm = $m - ($p + 100000);
					$nt = $token - $t;
					$np = $p + 100000;
					mysql_query("INSERT INTO mw (who, user, price, tokens, reason) VALUES ('$w', '$u', '$p', '$t', '$r')");
					mysql_query("UPDATE Players SET money='$nm', tokens='$nt' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
					echo ("<div id=\"crimestext\"><center>You have added $w to the list!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>");
					include("footer.php");
					exit();
					} else {
						echo "<div id=\"crimestext\"><center>Please enter an amount of money that you have!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>";
						include("footer.php");
					}
					} else {
					if ($m >= ($p + 150000)){
					$nm = $m - ($p + 150000);
					$nt = $token - $t;
					$np = $p + 150000;
					mysql_query("INSERT INTO mw (who, user, price, tokens, reason) VALUES ('$w', 'Anonymous', '$p', '$t', '$r')");
					mysql_query("UPDATE Players SET money='$nm', tokens='$nt' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
					echo ("<div id=\"crimestext\"><center>You have added $w to the list!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>");
					include("footer.php");
					exit();
					} else {
						echo"<div id=\"crimestext\"><center>Please enter an amount of money that you have!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>"; 
						include("footer.php");
					}
					
} 
}else {
	echo"<div id=\"crimestext\"><center>Please enter an amount of tokens that you have!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>";
	include("footer.php");
}
}else {
	echo"<div id=\"crimestext\"><center>Please enter an amount of money that you have!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>";
	include("footer.php");
}
}
} else {
	echo("<div id=\"crimestext\"><center>Please enter a real amount of money/tokens!<br /><a href=\"mostwanted.php\">Go back.</a></center></div>");
	include("footer.php");
	exit();
}
}
}
?>