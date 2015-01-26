<?php
include ('config.php');
include("Countdown_he.php");
include("Banned.php");
include("countdown_p.php");

$query = "SELECT theme FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$theme = $row[0];

if ($theme != NULL) {

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />");

} else {
$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />");

$theme = 'style';
}

if (!isset($_COOKIE['id'])) {


	$url .= '/login.html';
	header("Location: $url");
	exit();

}

$query = "SELECT health, location, username, money, mission FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$h = $row[0];
$l = $row[1];
$u = $row[2];
$m = $row[3];
$mis = $row[4];

if ($h == 0) {
 	$url .= '/dead.html';
	header("Location: $url");
	exit();
	
} else {
if ($mis != 10) {
	echo '<div id="crimestext" align="center">You need to already be on this mission to access this page!</div>';
	exit();
}
if (isset($_REQUEST['submit'])) {	

		$dd = $_POST['number'];
		
		if ($dd == '1'){
		$current = time();
		$target = 'Oonelth';
		$hunter = $u;
		$price = 50000;
		$newm = ($m - $price);
		$length = rand (3600, 7200);
		
		$query = ("SELECT dead, Level FROM Players WHERE username='$target'");
		$result = @mysql_query ($query);
		$row = mysql_fetch_assoc($result);
	
		$tstatus = $row['dead'];
		$tlevel = $row['Level'];
		
		$search = "SELECT * FROM Players WHERE username='$target'";
		$searched = mysql_query($search);
		
		if ($price > $m) {
		echo ("<div id=\"gameplay\"><center>You do not have enough money to pay the spy!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		
		} elseif ($u == $target) {
		echo ("<div id=\"gameplay\"><center>You can not hunt yourself!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		
		} else {
		$chance = rand (1,100);

		if ($chance >= 1 AND $chance <= 30) {
		$sql=mysql_query("INSERT INTO `mspies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '1', '$current', '$length', '$hunter', 'yes')") 
		or die(mysql_error());
		
		} elseif ($chance >= 30 AND $chance <= 100) {
		$sql=mysql_query("INSERT INTO `mspies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '1', '$current', '$length', '$hunter', 'no')") 
		or die(mysql_error());
		}
		
		$query = "UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}'";
		$result = @mysql_query ($query);
		$sql = mysql_query("UPDATE mission10 SET missionstats = '2' WHERE username = '$u'");
		echo ("<div id=\"gameplay\"><center>You sent a spy to try and locate $target!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		}
		
		} elseif ($dd == '2') {
		$current = time();
		$target = 'Oonelth';
		$hunter = $u;
		$price = 150000;
		$newm = ($m - $price);
		$length = rand (7200, 10800);
		
		if ($price > $m) {
		echo ("<div id=\"gameplay\"><center>You do not have enough money to pay the spy!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		
		} elseif ($u == $target) {
		echo ("<div id=\"gameplay\"><center>You can not hunt yourself!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		
		} else {
		$chance = rand (1,100);
		
		if ($chance >= 1 AND $chance <= 60) {
		$sql=mysql_query("INSERT INTO `mspies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '2', '$current', '$length', '$hunter', 'yes')") 
		or die(mysql_error());
		
		} elseif ($chance >= 60 AND $chance <= 100) {
		$sql=mysql_query("INSERT INTO `mspies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '2', '$current', '$length', '$hunter', 'no')") 
		or die(mysql_error());
		}
		
		$query = "UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}'";
		$result = @mysql_query ($query);
		$sql = mysql_query("UPDATE mission10 SET missionstats = '2' WHERE username = '$u'");
		echo ("<div id=\"gameplay\"><center>You sent 2 spies to try and locate $target!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		}
		
		} elseif ($dd == '3') {
		$current = time();
		$target = 'Oonelth';
		$hunter = $u;
		$price = 250000;
		$newm = ($m - $price);
		$length = rand (10800, 14400);
		
		if ($price > $m) {
		echo ("<div id=\"gameplay\"><center>You do not have enough money to pay the spy!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		
		} elseif ($u == $target) {
		echo ("<div id=\"gameplay\"><center>You can not hunt yourself!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		
		} else {
		$chance = rand (1,100);
		
		if ($chance >= 1 AND $chance <= 85) {
		$sql=mysql_query("INSERT INTO `mspies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '3', '$current', '$length', '$hunter', 'yes')") 
		or die(mysql_error());
		
		} elseif ($chance >= 85 AND $chance <= 100) {
		$sql=mysql_query("INSERT INTO `mspies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '3', '$current', '$length', '$hunter', 'no')") 
		or die(mysql_error());
		
		}
		$query = "UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}'";
		$result = @mysql_query ($query);
		$sql = mysql_query("UPDATE mission10 SET missionstats = '2' WHERE username = '$u'");
		echo ("<div id=\"gameplay\"><center>You sent 3 spies to try and locate $target!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		}
		
		} elseif ($dd == '4') {
		$current = time();
		$target = 'Oonelth';
		$hunter = $u;
		$price = 350000;
		$newm = ($m - $price);
		$length = rand (14400, 18000);
		
		if ($price > $m) {
		echo ("<div id=\"gameplay\"><center>You do not have enough money to pay the spy!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		
		} elseif ($u == $target) {
		echo ("<div id=\"gameplay\"><center>You can not hunt yourself!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		
		} else {
		$chance = rand (1,100);
		
		if ($chance >= 1 AND $chance <= 95) {
		$sql=mysql_query("INSERT INTO `mspies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '4', '$current', '$length', '$hunter', 'yes')") 
		or die(mysql_error());
		
		} elseif ($chance >= 95 AND $chance <= 100) {
		$sql=mysql_query("INSERT INTO `mspies` ( `id` , `target` , `number` , `time` , `length` , `hunter` , `find` ) VALUES ('', '$target', '4', '$current', '$length', '$hunter', 'no')") 
		or die(mysql_error());
		
		}
		$query = "UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}'";
		$result = @mysql_query ($query);
		$sql = mysql_query("UPDATE mission10 SET missionstats = '2' WHERE username = '$u'");
		echo ("<div id=\"gameplay\"><center>You sent 4 spies to try and locate $target!<br />
		<a href=\"/members/missions.php\">Go back.</a></center></div>");
		}
		}
		
$date = (date("M d Y h:i:s A"));
$current = time();
mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$price', '$date', '$u', 'Loss', '$current', 'Hunt')");}
}
?>