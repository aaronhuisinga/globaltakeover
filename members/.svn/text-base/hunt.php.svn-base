<?php
$title="Kills";
include ('config.php');
include("header.php");
include("Countdown_he.php");
include("countdown_p.php");

$result = mysql_query("SELECT location, username, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$l = $row[0];
$u = $row[1];
$m = $row[2];

if (isset($_REQUEST['submit'])) {	

		$dd = $_POST['number'];
		$target = $_POST['target'];
		$query = ("SELECT dead, Level FROM Players WHERE username='$target' LIMIT 1;");
		$result = @mysql_query ($query);
		$row = mysql_fetch_assoc($result);
		
		$tstatus = $row['dead'];
		$tlevel = $row['Level'];
		if (mysql_num_rows($result) < 1) {
		echo ("<div id=\"ltable\"><center>No such target! For mission hunts please use the built in hunt provided.<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		if ($tlevel != 0) {
		echo ("<div id=\"ltable\"><center>You don't hunt $target, $target hunts you.<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		if ($tstatus == 1) {
		echo ("<div id=\"ltable\"><center>$target is already dead!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		if ($dd == '1'){
		$current = time();
		$target = $_POST['target'];
		$hunter = $u;
		$price = 50000;
		$newm = ($m - $price);
		$length = rand (3600, 7200);
		
		$query = ("SELECT dead, Level FROM Players WHERE username='$target' LIMIT 1;");
		$result = @mysql_query ($query);
		$row = mysql_fetch_assoc($result);
	
		$tstatus = $row['dead'];
		$tlevel = $row['Level'];

		$search = "SELECT * FROM Players WHERE username='$target' LIMIT 1;";
		$searched = mysql_query($search);
		
		if ($price > $m) {
		echo ("<div id=\"ltable\"><center>You do not have enough money to pay the spy!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} elseif ($u == $target) {
		echo ("<div id=\"ltable\"><center>You can not hunt yourself!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} elseif ($tstatus == 1) {
		echo ("<div id=\"ltable\"><center>$target is already dead!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} elseif (mysql_num_rows($searched) != 1) {
		echo ("<div id=\"ltable\"><center>Please enter a valid username!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} elseif ($tlevel != 0) {
		echo ("<div id=\"ltable\"><center>You don't hunt $target, $target hunts you.<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		$chance = rand (1,100);

		if ($chance >= 1 AND $chance <= 30) {
		$sql=mysql_query("INSERT INTO `spies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '1', '$current', '$length', '$hunter', 'yes')") 
		or die(mysql_error());
		
		} elseif ($chance >= 30 AND $chance <= 100) {
		$sql=mysql_query("INSERT INTO `spies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '1', '$current', '$length', '$hunter', 'no')") 
		or die(mysql_error());
		}
		
		$query = "UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}' LIMIT 1;";
		$result = @mysql_query ($query);
		
		echo ("<div id=\"ltable\"><center>You sent a spy to try and locate $target!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		
		} elseif ($dd == '2') {
		$current = time();
		$target = $_POST['target'];
		$hunter = $u;
		$price = 150000;
		$newm = ($m - $price);
		$length = rand (7200, 10800);
		
		if ($price > $m) {
		echo ("<div id=\"ltable\"><center>You do not have enough money to pay the spy!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} elseif ($u == $target) {
		echo ("<div id=\"ltable\"><center>You can not hunt yourself!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		$chance = rand (1,100);
		
		if ($chance >= 1 AND $chance <= 60) {
		$sql=mysql_query("INSERT INTO `spies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '2', '$current', '$length', '$hunter', 'yes')") 
		or die(mysql_error());
		
		} elseif ($chance >= 60 AND $chance <= 100) {
		$sql=mysql_query("INSERT INTO `spies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '2', '$current', '$length', '$hunter', 'no')") 
		or die(mysql_error());
		}
		
		$query = "UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}' LIMIT 1;";
		$result = @mysql_query ($query);
		
		echo ("<div id=\"ltable\"><center>You sent 2 spies to try and locate $target!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		
		} elseif ($dd == '3') {
		$current = time();
		$target = $_POST['target'];
		$hunter = $u;
		$price = 250000;
		$newm = ($m - $price);
		$length = rand (10800, 14400);
		
		if ($price > $m) {
		echo ("<div id=\"ltable\"><center>You do not have enough money to pay the spy!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} elseif ($u == $target) {
		echo ("<div id=\"ltable\"><center>You can not hunt yourself!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		$chance = rand (1,100);
		
		if ($chance >= 1 AND $chance <= 85) {
		$sql=mysql_query("INSERT INTO `spies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '3', '$current', '$length', '$hunter', 'yes')") 
		or die(mysql_error());
		
		} elseif ($chance >= 85 AND $chance <= 100) {
		$sql=mysql_query("INSERT INTO `spies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '3', '$current', '$length', '$hunter', 'no')") 
		or die(mysql_error());
		
		}
		$query = "UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}' LIMIT 1;";
		$result = @mysql_query ($query);
		
		echo ("<div id=\"ltable\"><center>You sent 3 spies to try and locate $target!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		
		} elseif ($dd == '4') {
		$current = time();
		$target = $_POST['target'];
		$hunter = $u;
		$price = 350000;
		$newm = ($m - $price);
		$length = rand (14400, 18000);
		
		if ($price > $m) {
		echo ("<div id=\"ltable\"><center>You do not have enough money to pay the spy!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} elseif ($u == $target) {
		echo ("<div id=\"ltable\"><center>You can not hunt yourself!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		$chance = rand (1,100);
		
		if ($chance >= 1 AND $chance <= 95) {
		$sql=mysql_query("INSERT INTO `spies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '4', '$current', '$length', '$hunter', 'yes')") 
		or die(mysql_error());
		
		} elseif ($chance >= 95 AND $chance <= 100) {
		$sql=mysql_query("INSERT INTO `spies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '4', '$current', '$length', '$hunter', 'no')") 
		or die(mysql_error());
		
		}
		$query = "UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}' LIMIT 1;";
		$result = @mysql_query ($query);
		
		echo ("<div id=\"ltable\"><center>You sent 4 spies to try and locate $target!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		}
}
?>