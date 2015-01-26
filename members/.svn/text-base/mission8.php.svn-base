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

if ($h == 0) {
 	$url .= '/dead.html';
	header("Location: $url");
	exit();
	
} else {
if ($l != 'Philippines') {
	echo '<div id="crimestext" align="center">You need to be in the Philippines to attempt/finish this mission!</div>';
	exit();
} else {
if ($m != 8) {
	echo '<div id="crimestext" align="center">You need to already be on this mission to access this page!</div>';
	exit();
} else {
$query = mysql_query("SELECT * FROM mission8 WHERE username = '$u'");
$row = mysql_fetch_array($query);
$dinkg = $row['dingy'];
$accg = $row['acc'];
$desg = $row['des'];
if (mysql_num_rows($query) == 0) {
	if ($_REQUEST['Accept']) {
		$query = mysql_query("INSERT INTO mission8 (username) VALUES ('$u')");
		echo "<div id=\"crimestext\" align=\"center\">You have accepted the mission! Good luck, $u!</div>";
		exit();
	}  
		echo "<div id=\"crimestext\" align=\"center\"><h2>Mission Briefing!</h2><br><br>
		We found him in the USA, so when we hit the convoy we will need a quick means of escaping before he calls in his reinforcements. So $u, we ask you to help us for this last bit of preparation by getting us some boats and dropping them off at the docks.<br><br>

		Vessels needed:<br>
		Dingy - 15<br>
		Air Craft boatrier - 2<br>
		Destroyer - 1<Br><br>
		
		These vessels need to be stolen by you personally, we can’t use vessels that you've been given.<br><br>
		<form action=\"\" method=\"POST\"><input type =\"submit\" value=\"Accept!\" name=\"Accept\"></form></div>";
	} else {
	
	if ($_REQUEST['Donate']) {
		$select = $_POST['select'];
		if ($select == 'None') {
			echo '<div id="crimestext" align="center">Nothing was donated!<br /><a href="missions.php">Go Back</a></div>';
			exit();
		} elseif ($select == 'Dingy') {
			$sql = mysql_query("SELECT * FROM dock WHERE username = '$u' AND percent = 100 AND boat='Dingy' AND own='1'");
			if (mysql_num_rows($sql) == 0) {
				echo '<div id="crimestext" align="center">You don\'t have any Dingys to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($dinkg > 14) {
				echo '<div id="crimestext" align="center">You have donated enough Dingys! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$navg = $dinkg + 1;
				$sql = mysql_query("UPDATE mission8 SET dingy = '$navg' WHERE username = '$u'");
				$sql = mysql_query("DELETE FROM dock WHERE username = '$u' AND percent = 100 AND boat='Dingy' AND own='1' LIMIT 1");
				if ($navg > 14 AND $accg > 1 AND $desg > 0) {
					echo '<div id="crimestext" align="center">You have donated your last Dingy! You can now finish the mission!<br><br>';
					echo '<form action="mission8.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($navg > 14) {
					echo '<div id="crimestext" align="center">You donated your last Dingys! There are still Air Craft Carriers and Destroyers to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($navg < 15) {
					echo '<div id="crimestext" align="center">You donated one of fiveteen Dingys!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'Acc') {
			$sql = mysql_query("SELECT * FROM dock WHERE username = '$u' AND percent = 100 AND boat='Air Craft Carrier' AND own='1'");
			if (mysql_num_rows($sql) == 0) {
				echo '<div id="crimestext" align="center">You don\'t have any Air Craft Carriers to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($accg > 1) {
				echo '<div id="crimestext" align="center">You have donated enough Air Craft Carriers! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$navg = $accg + 1;
				$sql = mysql_query("UPDATE mission8 SET acc = '$navg' WHERE username = '$u'");
				$query = mysql_query("DELETE FROM dock WHERE username = '$u' AND percent = 100 AND boat='Air Craft Carrier' AND own='1' LIMIT 1");
				if ($navg > 1 AND $dinkg > 14 AND $desg > 0) {
					echo '<div id="crimestext" align="center">You have donated your last Air Craft Carrier! You can now finish the mission!<br><br>';
					echo '<form action="mission8.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($navg > 1) {
					echo '<div id="crimestext" align="center">You donated your last Air Craft Carrier! There are still Dingy and Destroyers to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($navg < 2) {
					echo '<div id="crimestext" align="center">You donated one of two Air Craft Carriers!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'Destroyer') {
		$sql = mysql_query("SELECT * FROM dock WHERE username = '$u' AND percent = 100 AND boat='Destroyer' AND own='1'");
			if (mysql_num_rows($sql) == 0) {
				echo '<div id="crimestext" align="center">You don\'t have any Destroyers to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($desg > 0) {
				echo '<div id="crimestext" align="center">You have donated enough Destroyers! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$navg = $desg + 1;
				$sql = mysql_query("UPDATE mission8 SET des = '$navg' WHERE username = '$u'");
				$query = mysql_query("DELETE FROM dock WHERE username = '$u' AND percent = 100 AND boat='Destroyer' AND own='1' LIMIT 1");
				if ($navg > 0 AND $accg > 1 AND $dinkg > 14) {
					echo '<div id="crimestext" align="center">You have donated your last Destroyer! You can now finish the mission!<br><br>';
					echo '<form action="mission8.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($navg > 0) {
					echo '<div id="crimestext" align="center">You donated your last Destroyer! There are still Air Craft Carriers and Dingy to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
		}
		}
	} 
	if ($_REQUEST['Finish']) {
		$tl = 1 - $desg;
		$hul = 2 - $accg;
		$apvl = 15 - $dinkg; 
		if ($tl != 0 OR $hul != 0 OR $apvl != 0) {
			echo '<div id="crimestext" align="center">You have not yet finished this mission!<br><a href="missions.php">Go Back</a></div>';
			exit();
		} else {
			$nmoney = $money + 4000000;
			$nexp = $exp + 550;
			$sql = mysql_query("UPDATE Players SET money='$nmoney', exp='$nexp', mission=9 WHERE id = '{$_COOKIE['id']}'");
			$query = mysql_query("DELETE FROM mission8 WHERE username='$u'");
			$current = time();
		$date = (date("M d Y h:i:s A"));
		mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('4000000', '$date', '$u', 'Gain', '$current', 'Mission 8 Finish')");
			echo ('<script language="javascript">
			window.parent.stats.location.reload();
			</script>');
			echo ('<script language="javascript">
			window.parent.bbar.location.reload();
			</script>');
			echo "<div id=\"crimestext\" align=\"center\">Congratulations, $u, you have helped get the boats needed! For your time and effort, we award you $4,000,000. We have more missions if you need more work!<br><a href=\"missions.php\">Go Back</a></div>";
			exit();
		}
	}
		$tl = 1 - $desg;
		$hul = 2 - $accg;
		$apvl = 15 - $dinkg; 
		$statement = array();
		if ($tl != 0) {
		$sql = mysql_query("SELECT * FROM dock WHERE username = '$u' AND percent = 100 AND boat='Destroyer' AND own='1'");
		if (mysql_num_rows($sql) > 0) {
		$statement[] = "<option value=\"Destroyer\">Destroyer</option>";
		}}
		if ($hul != 0) {
		$sql = mysql_query("SELECT * FROM dock WHERE username = '$u' AND percent = 100 AND boat='Air Craft Carrier' AND own='1'");
		if (mysql_num_rows($sql) > 0) {
		$statement[] = "<option value=\"Acc\">Air Craft Carrier</option>";
		}}
		if ($apvl != 0) {
		$sql = mysql_query("SELECT * FROM dock WHERE username = '$u' AND percent = 100 AND boat='Dingy' AND own='1'");
		if (mysql_num_rows($sql) > 0) {
		$statement[] = "<option value=\"Dingy\">Dingy</option>";
		}}
		echo "<div id=\"inventory\" align=\"center\"><h2>Mission Status!</h2><br><table width=\"30%\"><tr class=\"top\" align=\"center\"><td>Boat</td><td>Amount Left</td></tr>
		<tr align=\"center\"><td>Dingy</td><td>$apvl</td></tr>
		<tr align=\"center\"><td>Air Craft Carrier</td><td>$hul</td></tr>
		<tr align=\"center\"><td>Destroyer</td><td>$tl</td></tr></table><br><br><br>";
		
		if ($tl != 0 OR $hul != 0 OR $apvl != 0) {
		echo "<form action=\"mission8.php\" method=\"POST\"><select name=\"select\">
			<option value=\"None\">No Change!</option>";
		
		foreach ($statement as $msg) {
		 		echo "$msg";
		 }
		echo '</select><br><br>';
		echo "<input type=\"submit\" name=\"Donate\" value=\"Donate!\"></form></div>";
		
		
		} else {
		echo '<form action="mission8.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
		
		}
		
		
		
	}
}
}
}
?>