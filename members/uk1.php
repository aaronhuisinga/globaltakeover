<?php
include("config.php");
include("Countdown_he.php");
include("Banned.php");
checks();
online();

$query = "SELECT health, location, uk, username, money, exp FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);
$h = $row[0];
$l = $row[1];
$m = $row[2];
$u = $row[3];
$money = $row[4];
$exp = $row[5];
if ($l != 'UK') {
	echo '<div id="crimestext" align="center">You need to be in the UK to attempt/finish this mission!</div>';
	exit();
} else {
if ($m != 1) {
	echo '<div id="crimestext" align="center">You need to already be on this mission to access this page!</div>';
	exit();
} else {
$query = mysql_query("SELECT * FROM uk1 WHERE username = '$u'");
$row = mysql_fetch_array($query);
$jeep = $row['jeep'];
if (mysql_num_rows($query) == 0) {
	if ($_REQUEST['Accept']) {
		$query = mysql_query("INSERT INTO uk1 (username) VALUES ('$u')");
		echo "<div id=\"crimestext\" align=\"center\">You have accepted the mission! Good luck, $u!</div>";
		exit();
	}  
		echo "<div id=\"crimestext\" align=\"center\"><h2>Mission Briefing!</h2><br><br>
		Welcome $u; we come to you for a little help. One of our other members seems to have lost something very important to me in a different mission. Please steal our Jeep back and return it to us. Then we can talk business.<br><br>

		Once you have stolen our Jeep back, drop it off in our garage.<br><br>
		<form action=\"\" method=\"POST\"><input type =\"submit\" value=\"Accept!\" name=\"Accept\"></form></div>";
	} else {
	
	if ($_REQUEST['Finish']) {
		if ($jeep == 0) {
		echo "<div id=\"crimestext\" align=\"center\">You have yet to steal our Jeep back, come here when you are ready to drop it off to us!</div>";
		} elseif ($jeep == 1) {
			$nmoney = $money + 300000;
			$nexp = $exp + 450;
			$sql = mysql_query("UPDATE Players SET money='$nmoney', exp='$nexp', uk=2 WHERE id = '{$_COOKIE['id']}'");
			$query = mysql_query("DELETE FROM uk1 WHERE username='$u'");
			$query1 = mysql_query("INSERT INTO garage (username, car, percent) VALUES ('$u', 'Tank', '100')");
			mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('500000', '$date', '$u', 'Gain', '$current', 'Mission 1 (UK) Finish')");
			echo ('<script language="javascript">
			window.parent.stats.location.reload();
			</script>');
			echo ('<script language="javascript">
			window.parent.bbar.location.reload();
			</script>');
			echo "<div id=\"crimestext\" align=\"center\">Congratulations, $u, You have got our Jeep back! Our boss was happy enough to reward you with $300,000 and a Tank. We have more missions if you need more work!<br><a href=\"missions.php\">Go Back</a></div>";
			exit();
		}
	}
	if ($jeep == 0) {
	echo "<div id=\"crimestext\" align=\"center\">You have yet to steal our Jeep back, come here when you are ready to drop it off to us!</div>";
	} elseif ($jeep == 1) {
	echo "<div id=\"crimestext\" align=\"center\">Thats our Jeep, drive her on through and talk to the boss about your pay and other important things!<br>";
	echo '<form action="" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';	
	}
}
}}
?>