<?php
include("config.php");
include("Countdown_he.php");
include("Banned.php");
checks();
online();

$query = "SELECT health, location, mission, username, money, exp FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);
$h = $row[0];
$l = $row[1];
$m = $row[2];
$u = $row[3];
$money = $row[4];
$exp = $row[5];
if ($l != 'Philippines') {
	echo '<div id="crimestext" align="center">You need to be in the Philippines to attempt/finish this mission!</div>';
	exit();
} else {
if ($m != 1) {
	echo '<div id="crimestext" align="center">You need to already be on this mission to access this page!</div>';
	exit();
} else {
$query = mysql_query("SELECT * FROM mission1 WHERE username = '$u'");
$row = mysql_fetch_array($query);
$misss = $row['missionstats'];
$apvg = $row['apv'];
$hummerg = $row['hummer'];
$tankg = $row['tank'];
if (mysql_num_rows($query) == 0) {
	if ($_REQUEST['Accept']) {
		$query = mysql_query("INSERT INTO mission1 (username) VALUES ('$u')");
		echo "<div id=\"crimestext\" align=\"center\">You have accepted the mission! Good luck, $u!</div>";
		exit();
	}  
		echo "<div id=\"crimestext\" align=\"center\"><h2>Mission Briefing!</h2><br><br>
		Ok, $u, we're planning a hijacking operation on a Military Arms Convoy. We need your help to get the vehicles to complete the mission.<br /><br />
		
		Vehicles needed:<br><br>
		
		2 APV's<br>
		2 Hummer H3's<br>
		1 Tank <br><br>
		
		Once you have stolen/bought the vehicles required, drop them off at our garage and you will be paid.<br><br>
		<form action=\"\" method=\"POST\"><input type =\"submit\" value=\"Accept!\" name=\"Accept\"></form></div>";
	} else {
	if ($_REQUEST['Donate']) {
		$select = $_POST['select'];
		if ($select == 'None') {
			echo '<div id="crimestext" align="center">Nothing was donated!<br /><a href="missions.php">Go Back</a></div>';
			exit();
		} elseif ($select == 'APV') {
			$sql = mysql_query("SELECT * FROM garage WHERE username = '$u' AND percent = 100 AND car='APV'");
			if (mysql_num_rows($sql) == 0) {
				echo '<div id="crimestext" align="center">You don\'t have any APVs to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($apvg > 1) {
				echo '<div id="crimestext" align="center">You have donated enough APVs! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$navg = $apvg + 1;
				$sql = mysql_query("UPDATE mission1 SET apv = '$navg' WHERE username = '$u'");
				$query = mysql_query("DELETE FROM garage WHERE username = '$u' AND percent = 100 AND car='APV' LIMIT 1");
				if ($navg > 1 AND $hummerg > 1 AND $tankg > 0) {
					echo '<div id="crimestext" align="center">You have donated your last APV! You can now finish the mission!<br><br>';
					echo '<form action="mission1.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($navg > 1) {
					echo '<div id="crimestext" align="center">You donated your last APV! There are still Tanks and Hummers to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($navg < 2) {
					echo '<div id="crimestext" align="center">You donated one of two APVs!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'Hummer') {
			$sql = mysql_query("SELECT * FROM garage WHERE username = '$u' AND percent = 100 AND car='Hummer H3'");
			if (mysql_num_rows($sql) == 0) {
				echo '<div id="crimestext" align="center">You don\'t have any Hummers to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($hummerg > 1) {
				echo '<div id="crimestext" align="center">You have donated enough Hummers! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$navg = $hummerg + 1;
				$sql = mysql_query("UPDATE mission1 SET hummer = '$navg' WHERE username = '$u'");
				$query = mysql_query("DELETE FROM garage WHERE username = '$u' AND percent = 100 AND car='Hummer H3' LIMIT 1");
				if ($navg > 1 AND $apvg > 1 AND $tankg > 0) {
					echo '<div id="crimestext" align="center">You have donated your last Hummer! You can now finish the mission!<br><br>';
					echo '<form action="mission1.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($navg > 1) {
					echo '<div id="crimestext" align="center">You donated your last Hummer! There are still Tanks and APVs to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($navg < 2) {
					echo '<div id="crimestext" align="center">You donated one of two Hummers!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'Tank') {
		$sql = mysql_query("SELECT * FROM garage WHERE username = '$u' AND percent = 100 AND car='Tank'");
			if (mysql_num_rows($sql) == 0) {
				echo '<div id="crimestext" align="center">You don\'t have any Tanks to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($tankg > 0) {
				echo '<div id="crimestext" align="center">You have donated enough Tanks! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$navg = $tankg + 1;
				$sql = mysql_query("UPDATE mission1 SET tank = '$navg' WHERE username = '$u'");
				$query = mysql_query("DELETE FROM garage WHERE username = '$u' AND percent = 100 AND car='Tank' LIMIT 1");
				if ($navg > 0 AND $hummerg > 1 AND $apvg > 1) {
					echo '<div id="crimestext" align="center">You have donated your last Tank! You can now finish the mission!<br><br>';
					echo '<form action="mission1.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($navg > 0) {
					echo '<div id="crimestext" align="center">You donated your last Tank! There are still APVs and Hummers to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
		}
		}
	} 
	if ($_REQUEST['Finish']) {
		$tl = 1 - $tankg;
		$hul = 2 - $hummerg;
		$apvl = 2 - $apvg; 
		if ($tl != 0 OR $hul != 0 OR $apvl != 0) {
			echo '<div id="crimestext" align="center">You have not yet finished this mission!<br><a href="missions.php">Go Back</a></div>';
			exit();
		} else {
			$nmoney = $money + 500000;
			$nexp = $exp + 400;
			$sql = mysql_query("UPDATE Players SET money='$nmoney', exp='$nexp', mission=2 WHERE id = '{$_COOKIE['id']}'");
			$query = mysql_query("DELETE FROM mission1 WHERE username='$u'");
			$current = time();
		$date = (date("M d Y h:i:s A"));
		mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('500000', '$date', '$u', 'Gain', '$current', 'Mission 1 Finish')");
			echo ('<script language="javascript">
			window.parent.stats.location.reload();
			</script>');
			echo ('<script language="javascript">
			window.parent.bbar.location.reload();
			</script>');
			echo "<div id=\"crimestext\" align=\"center\">Congratulations, $u, You have helped get the Vehicles needed! For your time and effort we award you $500,000. We have more missions if you need more work!<br><a href=\"missions.php\">Go Back</a></div>";
			exit();
		}
	}
		$tl = 1 - $tankg;
		$hul = 2 - $hummerg;
		$apvl = 2 - $apvg; 
		$statement = array();
		if ($tl != 0) {
		$sql = mysql_query("SELECT * FROM garage WHERE username = '$u' AND percent = 100 AND car='Tank'");
		if (mysql_num_rows($sql) > 0) {
		$statement[] = "<option value=\"Tank\">Tank</option>";
		}
		}
		if ($hul != 0) {
		$sql = mysql_query("SELECT * FROM garage WHERE username = '$u' AND percent = 100 AND car='Hummer H3'");
		if (mysql_num_rows($sql) > 0) {
		$statement[] = "<option value=\"Hummer\">Hummer</option>";
		}}
		if ($apvl != 0) {
		$sql = mysql_query("SELECT * FROM garage WHERE username = '$u' AND percent = 100 AND car='APV'");
		if (mysql_num_rows($sql) > 0) {
		$statement[] = "<option value=\"APV\">APV</option>";
		}}
		echo "<div id=\"inventory\" align=\"center\"><h2>Mission Status!</h2><br><table width=\"30%\"><tr class=\"top\" align=\"center\"><td>Vehicle</td><td>Amount Left</td></tr>
		<tr align=\"center\"><td>APV</td><td>$apvl</td></tr>
		<tr align=\"center\"><td>Hummer H3</td><td>$hul</td></tr>
		<tr align=\"center\"><td>Tank</td><td>$tl</td></tr></table><br><br><br>";
		
		if ($tl != 0 OR $hul != 0 OR $apvl != 0) {
		echo "<form action=\"mission1.php\" method=\"POST\"><select name=\"select\">
			<option value=\"None\">No Change!</option>";
		
		foreach ($statement as $msg) {
		 		echo "$msg";
		 }
		echo '</select><br><br>';
		echo "<input type=\"submit\" name=\"Donate\" value=\"Donate!\"></form></div>";
		} else {
		echo '<form action="mission1.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';	
		}	
	}
}
}
?>