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
if ($m != 5) {
	echo '<div id="crimestext" align="center">You need to already be on this mission to access this page!</div>';
	exit();
} else {
$query = mysql_query("SELECT * FROM mission5 WHERE username = '$u'");
$row = mysql_fetch_array($query);
$RPDG = $row['RPD'];
$Stingerg = $row['Stinger'];
$M4g = $row['M4'];
$GrenadeG = $row['grenades'];
$SAWg = $row['SAW'];
$AK47g = $row['AK47'];
if (mysql_num_rows($query) == 0) {
	if ($_REQUEST['Accept']) {
		$query = mysql_query("INSERT INTO mission5 (username) VALUES ('$u')");
		echo "<div id=\"crimestext\" align=\"center\">You have accepted the mission! Good luck, $u!</div>";
		exit();
	}  
		echo "<div id=\"crimestext\" align=\"center\"><h2>Mission Briefing!</h2><br><br>
		We need some weapons for our operation, $u. We’re counting on you to steal or buy the weapons we need and drop them off at off at our ammunition dump.<br /><br />
		
Weapons Needed:<br>
RPD - 4<br>
Stinger - 1<br>
M4 Carbine – 2<br>
AK47 - 2<br>
M249 Saw – 4<br>
Frag Grenade - 5<br>

		<form action=\"\" method=\"POST\"><input type =\"submit\" value=\"Accept!\" name=\"Accept\"></form></div>";
	} else {
	
	if ($_REQUEST['Donate']) {
		$rpl = 4 - $RPDG;
		$sl = 1 - $Stingerg;
		$ml = 2 - $M4g;
		$gl = 5 - $GrenadeG;
		$sal = 4 - $SAWg;
		$al = 2 - $AK47g;
		$select = $_POST['select'];
		if ($select == 'None') {
			echo '<div id="crimestext" align="center">Nothing was donated!<br /><a href="missions.php">Go Back</a></div>';
			exit();
		} elseif ($select == 'rpd') {
			$sql = mysql_fetch_array(mysql_query("SELECT rpd FROM Players WHERE username = '$u'"));
			$rpd = $sql[0];
			if ($rpd < 1) {
				echo '<div id="crimestext" align="center">You don\'t have any RPDs to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($RPDG > 3) {
				echo '<div id="crimestext" align="center">You have donated enough RPDs! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$nrpdg = $RPDG + 1;
				$sql = mysql_query("UPDATE mission5 SET RPD = '$nrpdg' WHERE username = '$u'");
				$nrpg = $rpd - 1;
				$sql = mysql_query("UPDATE Players SET rpd = '$nrpg' WHERE username = '$u'");
				$rpl = 4 - $nrpdg;
				if ($rpl == 0 AND $sl == 0 AND $ml == 0 AND $al == 0 AND $sal == 0 AND $gl == 0) {
					echo '<div id="crimestext" align="center">You have donated your last RPD! You can now finish the mission!<br><br>';
					echo '<form action="mission5.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($rpl == 0) {
					echo '<div id="crimestext" align="center">You donated your last RPD! There are still many weapons to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($rpl > 0) {
					echo '<div id="crimestext" align="center">You donated one of four RPDs!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'stinger') {
			$sql = mysql_fetch_array(mysql_query("SELECT stinger FROM Players WHERE username = '$u'"));
			$s = $sql[0];
			if ($s < 1) {
				echo '<div id="crimestext" align="center">You don\'t have any Stingers to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($Stingerg > 0) {
				echo '<div id="crimestext" align="center">You have donated enough Stingers! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$nrpdg = $Stingerg + 1;
				$sql = mysql_query("UPDATE mission5 SET Stinger = '$nrpdg' WHERE username = '$u'");
				$nrpg = $s - 1;
				$sql = mysql_query("UPDATE Players SET stinger = '$nrpg' WHERE username = '$u'");
				$sl = 1 - $nrpdg;
				if ($rpl == 0 AND $sl == 0 AND $ml == 0 AND $al == 0 AND $sal == 0 AND $gl == 0) {
					echo '<div id="crimestext" align="center">You have donated your last Stinger! You can now finish the mission!<br><br>';
					echo '<form action="mission5.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($sl == 0) {
					echo '<div id="crimestext" align="center">You donated your last Stinger! There are still many weapons to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($sl > 0) {
					echo '<div id="crimestext" align="center">You donated one of one Stingers!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'M4') {
			$sql = mysql_fetch_array(mysql_query("SELECT M4 FROM Players WHERE username = '$u'"));
			$m = $sql[0];
			if ($m < 1) {
				echo '<div id="crimestext" align="center">You don\'t have any M4s to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($M4g > 1) {
				echo '<div id="crimestext" align="center">You have donated enough M4s! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$nrpdg = $M4g + 1;
				$sql = mysql_query("UPDATE mission5 SET M4 = '$nrpdg' WHERE username = '$u'");
				$nrpg = $m - 1;
				$sql = mysql_query("UPDATE Players SET M4 = '$nrpg' WHERE username = '$u'");
				$ml = 2 - $nrpdg;
				if ($rpl == 0 AND $sl == 0 AND $ml == 0 AND $al == 0 AND $sal == 0 AND $gl == 0) {
					echo '<div id="crimestext" align="center">You have donated your last M4! You can now finish the mission!<br><br>';
					echo '<form action="mission5.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($ml == 0) {
					echo '<div id="crimestext" align="center">You donated your last M4! There are still many weapons to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($ml > 0) {
					echo '<div id="crimestext" align="center">You donated one of two M4s!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'grenade') {
			$sql = mysql_fetch_array(mysql_query("SELECT grenades FROM Players WHERE username = '$u'"));
			$g = $sql[0];
			if ($g < 1) {
				echo '<div id="crimestext" align="center">You don\'t have any Grenades to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($GrenadeG > 4) {
				echo '<div id="crimestext" align="center">You have donated enough Grenades! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$nrpdg = $GrenadeG + 1;
				$sql = mysql_query("UPDATE mission5 SET grenades = '$nrpdg' WHERE username = '$u'");
				$nrpg = $g - 1;
				$sql = mysql_query("UPDATE Players SET grenades = '$nrpg' WHERE username = '$u'");
				$gl = 5 - $nrpdg;
				if ($rpl == 0 AND $sl == 0 AND $ml == 0 AND $al == 0 AND $sal == 0 AND $gl == 0) {
					echo '<div id="crimestext" align="center">You have donated your last Grenade! You can now finish the mission!<br><br>';
					echo '<form action="mission5.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($gl == 0) {
					echo '<div id="crimestext" align="center">You donated your last Grenade! There are still many weapons to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($gl > 0) {
					echo '<div id="crimestext" align="center">You donated one of five Grenades!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'AK47') {
			$sql = mysql_fetch_array(mysql_query("SELECT AK47 FROM Players WHERE username = '$u'"));
			$ak = $sql[0];
			if ($ak < 1) {
				echo '<div id="crimestext" align="center">You don\'t have any AK47s to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($AK47g > 1) {
				echo '<div id="crimestext" align="center">You have donated enough AK47s! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$nrpdg = $AK47g + 1;
				$sql = mysql_query("UPDATE mission5 SET AK47 = '$nrpdg' WHERE username = '$u'");
				$nrpg = $ak - 1;
				$sql = mysql_query("UPDATE Players SET AK47 = '$nrpg' WHERE username = '$u'");
				$al = 2 - $nrpdg;
				if ($rpl == 0 AND $sl == 0 AND $ml == 0 AND $al == 0 AND $sal == 0 AND $gl == 0) {
					echo '<div id="crimestext" align="center">You have donated your last AK47! You can now finish the mission!<br><br>';
					echo '<form action="mission5.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($al == 0) {
					echo '<div id="crimestext" align="center">You donated your last AK47! There are still many weapons to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($al > 0) {
					echo '<div id="crimestext" align="center">You donated one of two AK47s!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		} elseif ($select == 'saw') {
			$sql = mysql_fetch_array(mysql_query("SELECT saw FROM Players WHERE username = '$u'"));
			$saw = $sql[0];
			if ($saw < 1) {
				echo '<div id="crimestext" align="center">You don\'t have any M249 SAWs to donate!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
			if ($SAWg > 3) {
				echo '<div id="crimestext" align="center">You have donated enough M249 SAWs! Nothing was donated!<br><a href="missions.php">Go Back</a></div>';
				exit();
			} else {
				$nrpdg = $SAWg + 1;
				$sql = mysql_query("UPDATE mission5 SET SAW = '$nrpdg' WHERE username = '$u'");
				$nrpg = $saw- 1;
				$sql = mysql_query("UPDATE Players SET saw = '$nrpg' WHERE username = '$u'");
				$sal = 4 - $nrpdg;
				if ($rpl == 0 AND $sl == 0 AND $ml == 0 AND $al == 0 AND $sal == 0 AND $gl == 0) {
					echo '<div id="crimestext" align="center">You have donated your last M249 SAW! You can now finish the mission!<br><br>';
					echo '<form action="mission5.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
					exit();
				} else {
				if ($sal == 0) {
					echo '<div id="crimestext" align="center">You donated your last M249 SAW! There are still many weapons to go!<br><a href="missions.php">Go Back</a></div>';
					exit();
				} elseif ($sal > 0) {
					echo '<div id="crimestext" align="center">You donated one of four M249 SAWs!<br><a href="missions.php">Go Back</a></div>';
					exit();
				}
				}
			}
			}
		}
		 
	} 
	if ($_REQUEST['Finish']) {
		$rpl = 4 - $RPDG;
		$sl = 1 - $Stingerg;
		$ml = 2 - $M4g;
		$gl = 5 - $GrenadeG;
		$sal = 4 - $SAWg;
		$al = 2 - $AK47g;
		if ($rpl != 0 OR $sl != 0 OR $ml != 0 OR $al != 0 OR $sal != 0 OR $gl != 0) {
			echo '<div id="crimestext" align="center">You have not yet finished this mission!<br><a href="missions.php">Go Back</a></div>';
			exit();
		} else {
			$nmoney = $money + 5000000;
			$nexp = $exp + 750;
			$nbullets = $bullets + 5000;
			$sql = mysql_query("UPDATE Players SET money='$nmoney', exp='$nexp', mission=6, bullets = $nbullets WHERE id = '{$_COOKIE['id']}'");
			$query = mysql_query("DELETE FROM mission5 WHERE username='$u'");
			$query = "INSERT INTO garage (username, car, percent) VALUES ('$u', 'Tank', '100')";
			$result = @mysql_query ($query);
			$current = time();
		$date = (date("M d Y h:i:s A"));
		mysql_query("INSERT INTO Playerbullets (amount, date, username, outcome, btime, used) VALUES ('750', '$date', '$u', 'Gain', '$current', 'Mission 5 Finish')");
		mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('5000000', '$date', '$u', 'Gain', '$current', 'Mission 5 Finish')");
			echo ('<script language="javascript">
			window.parent.stats.location.reload();
			</script>');
			echo ('<script language="javascript">
			window.parent.bbar.location.reload();
			</script>');
			echo "<div id=\"crimestext\" align=\"center\">Congratulations, $u, You have helped get the weapons that we needed! For your time and effort, we award you 5,000 bullets, a tank, and $5,000,000. We have more missions if you need more work!<br><a href=\"missions.php\">Go Back</a></div>";
			exit();
		}
	}
		$rpl = 4 - $RPDG;
		$sl = 1 - $Stingerg;
		$ml = 2 - $M4g;
		$gl = 5 - $GrenadeG;
		$sal = 4 - $SAWg;
		$al = 2 - $AK47g;
		$statement = array();
		if ($rpl != 0) {
		$sql = mysql_fetch_array(mysql_query("SELECT rpd FROM Players WHERE username = '$u'"));
		$rpd = $sql[0];
		if ($rpd > 0) {
		$statement[] = "<option value=\"rpd\">RPD</option>";
		}
		}
		if ($sl != 0) {
		$sql = mysql_fetch_array(mysql_query("SELECT stinger FROM Players WHERE username = '$u'"));
		$s = $sql[0];
		if ($s > 0) {
		$statement[] = "<option value=\"stinger\">Stinger</option>";
		}
		}
		if ($ml != 0) {
		$sql = mysql_fetch_array(mysql_query("SELECT M4 FROM Players WHERE username = '$u'"));
		$m = $sql[0];
		if ($m > 0) {
		$statement[] = "<option value=\"M4\">M4 Carbine</option>";
		}
		}
		if ($gl != 0) {
		$sql = mysql_fetch_array(mysql_query("SELECT grenades FROM Players WHERE username = '$u'"));
		$g = $sql[0];
		if ($g > 0) {
		$statement[] = "<option value=\"grenade\">Grenade</option>";
		}
		}
		if ($al != 0) {
		$sql = mysql_fetch_array(mysql_query("SELECT AK47 FROM Players WHERE username = '$u'"));
		$ak = $sql[0];
		if ($ak > 0) {
		$statement[] = "<option value=\"AK47\">AK47</option>";
		}
		}
		if ($sal != 0) {
		$sql = mysql_fetch_array(mysql_query("SELECT saw FROM Players WHERE username = '$u'"));
		$saw = $sql[0];
		if ($saw > 0) {
		$statement[] = "<option value=\"saw\">M249 Saw</option>";
		}
		}
		echo "<div id=\"inventory\" align=\"center\"><h2>Mission Status!</h2><br><table width=\"30%\"><tr class=\"top\" align=\"center\"><td>Weapon</td><td>Amount Left</td></tr>
		<tr align=\"center\"><td>RPD</td><td>$rpl</td></tr>
		<tr align=\"center\"><td>Stinger</td><td>$sl</td></tr>
		<tr align=\"center\"><td>M4 Carbine</td><td>$ml</td></tr>
		<tr align=\"center\"><td>AK47</td><td>$al</td></tr>
		<tr align=\"center\"><td>M249 SAW</td><td>$sal</td></tr>
		<tr align=\"center\"><td>Frag Grenades</td><td>$gl</td></tr></table><br><br><br>";
		if ($rpl != 0 OR $sl != 0 OR $ml != 0 OR $al != 0 OR $sal != 0 OR $gl != 0) {
		echo "<form action=\"mission5.php\" method=\"POST\"><select name=\"select\">
			<option value=\"None\">No Change!</option>";
		
		foreach ($statement as $msg) {
		 		echo "$msg";
		 }
		echo '</select><br><br>';
		echo "<input type=\"submit\" name=\"Donate\" value=\"Donate!\"></form></div>";	
		} else {
		echo '<form action="mission5.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></div>';
		}		
	}
}
}
}
?>