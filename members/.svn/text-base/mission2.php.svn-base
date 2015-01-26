<?php
include("config.php");
include("Countdown_he.php");
include("Banned.php");
checks();
online();

$query = "SELECT health, location, mission, username, money, exp, bullets FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$h = $row[0];
$l = $row[1];
$m = $row[2];
$u = $row[3];
$money = $row[4];
$exp = $row[5];
$bullets = $row[6];

if ($h == 0) {
 	$url .= '/dead.html';
	header("Location: $url");
	exit();
	
} else {
if ($l != 'Philippines') {
	echo '<div id="crimestext" align="center">You need to be in the Philippines to attempt/finish this mission!</div>';
	exit();
} else {
if ($m != 2) {
	echo '<div id="crimestext" align="center">You need to already be on this mission to access this page!</div>';
	exit();
} else {
$query = mysql_query("SELECT * FROM mission2 WHERE username = '$u'");
$row = mysql_fetch_array($query);
$Ni = $row['Nikolai'];
$D= $row['Dmitri'];
$Na = $row['Natalya'];
if (mysql_num_rows($query) == 0) {
	if ($_REQUEST['Accept']) {
		$rl = rand (1,5);
		if ($rl == 1) {
		$nil = 'USA';
		$dl = 'UK';
		$nal = 'Russia';
		} elseif ($rl == 2) {
		$nil = 'UK';
		$dl = 'Russia';
		$nal = 'Philippines';
		} elseif ($rl == 3) {
		$nil = 'Russia';
		$dl = 'Philippines';
		$nal = 'Australia';
		} elseif ($rl == 4) {
		$nil = 'Philippines';
		$dl = 'Australia';
		$nal = 'UK';
		} elseif ($rl == 5) {
		$nil = 'Australia';
		$dl = 'UK';
		$nal = 'USA';
		}
		$query = mysql_query("INSERT INTO mission2 (username, nil, dl, nal) VALUES ('$u', '$nil', '$dl', '$nal')");
		echo "<div id=\"crimestext\" align=\"center\">You have accepted the mission! Good luck, $u!</div>";
		exit();
	}  
		echo "<div id=\"crimestext\" align=\"center\"><h2>Mission Briefing!</h2><br><br>
		Those god damned rebels have captured 3 of our men and have flew them over to different countries throughout the world and are holding them in the prisons! $u, we ask you to retrieve these men for us. To do this, you will need to go to the locations that they are being held in, and rescue them from their prisons. <br /><br />

		People Taken:<br>
		The Explosives Expert - Nikolai <Br>
		The Hacker - Dmitri<br>
		The Weapon Expert - Natalya<br><br>
		<form action=\"\" method=\"POST\"><input type =\"submit\" value=\"Accept!\" name=\"Accept\"></form></div>";
	} else {
	if ($_REQUEST['Finish']) {
		if ($Na == 0 AND $D == 0 AND $Ni == 0) {
			echo '<div id="crimestext" align="center">You have not yet finished this mission!<br><a href="missions.php">Go Back</a></div>';
			exit();
		} else {
			$nmoney = $money + 2000000;
			$nbullets = $bullets + 500;
			$nexp = $exp + 500;
			$sql = mysql_query("UPDATE Players SET money='$nmoney', exp='$nexp', mission=3, bullets = '$nbullets' WHERE id = '{$_COOKIE['id']}'");
			$query = mysql_query("DELETE FROM mission2 WHERE username='$u'");
			$current = time();
		$date = (date("M d Y h:i:s A"));
		mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('2000000', '$date', '$u', 'Gain', '$current', 'Mission 2 Finish')");
		mysql_query("INSERT INTO Playerbullets (amount, date, username, outcome, btime, used) VALUES ('500', '$date', '$u', 'Gain', '$current', 'Mission 2 Finish')");
			echo ('<script language="javascript">
			window.parent.stats.location.reload();
			</script>');
			echo ('<script language="javascript">
			window.parent.bbar.location.reload();
			</script>');
			echo "<div id=\"crimestext\" align=\"center\">Congratulations, $u, you have rescused the three members needed! For your help, we award you $2,000,000 and 500 Bullets. We have more missions if you need more work!<br><a href=\"missions.php\">Go Back</a></div>";
			exit();
		}
		}
	if ($Ni == 0) {
	$rni = 'Not Rescued!';
	} else {
	$rni = 'Rescued!';
	}
	if ($D == 0) {
	$rd = 'Not Rescued!';
	} else {
	$rd = 'Rescued!';
	}
	if ($Na == 0) {
	$rna = 'Not Rescued!';
	} else {
	$rna = 'Rescued!';
	}
	echo "<div id=\"inventory\" align=\"center\"><h2>Mission Status!</h2><br><table width=\"30%\"><tr class=\"top\" align=\"center\"><td>Person</td><td>Rescue</td></tr>
		<tr align=\"center\"><td>Nikolai</td><td>$rni</td></tr>
		<tr align=\"center\"><td>Dmitri</td><td>$rd</td></tr>
		<tr align=\"center\"><td>Natalya</td><td>$rna</td></tr></table></div>";
	if ($Na != 0 AND $D != 0 AND $Ni != 0) {
	echo '<br><br><center><form action="mission2.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></center>';
	}
	
	}
}
}
}
?>