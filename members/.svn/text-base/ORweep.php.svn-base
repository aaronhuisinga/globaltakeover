<?php
$title="Organized Robbery > Update Weapons";
include("config.php");
include("header.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];

$sql = mysql_query("SELECT id FROM Robbery WHERE wep='$u' LIMIT 1;");
if (mysql_num_rows($sql) != 1) {
echo '<div id="crimestext" align="center">You need to be the Weapons Expert in an Organized Robbery first!<br /><a href="OR.php">Go back.</a></div>';
include("footer.php");
exit();
} else {
if ($_REQUEST['update']) {
	$lweap = $_POST['lselect'];
	$dweap = $_POST['dselect'];
	$eweap = $_POST['eeselect'];
	$wweap = $_POST['weselect'];
	if ($lweap == 'none') {
	} else {
	$sql = mysql_fetch_array(mysql_query("SELECT $lweap FROM Players WHERE id='{$_COOKIE['id']}'"));
	$amlweap = $sql[0];
	$newlwep = $amlweap - 1;
	if ($newlwep < 0) {
		echo '<div id="crimestext" align="center">You need to own the weapons before using them!<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	}
	
	$sql = mysql_query("UPDATE Players SET $lweap = '$newlwep' WHERE id='{$_COOKIE['id']}'");
	}
	if ($dweap == 'none') {
	} else {
	$sql = mysql_fetch_array(mysql_query("SELECT $dweap FROM Players WHERE id='{$_COOKIE['id']}'"));
	$amdweap = $sql[0];
	$newdwep = $amdweap - 1;
	if ($newdwep < 0) {
		echo '<div id="crimestext" align="center">You need to own the weapons before using them!<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		$sql = mysql_query("UPDATE Players SET $lweap = '$amlweap' WHERE id='{$_COOKIE['id']}'");
		exit();
	}
	$sql = mysql_query("UPDATE Players SET $dweap = '$newdwep' WHERE id='{$_COOKIE['id']}'");
	}
	if ($eweap == 'none') {
	} else {
	$sql = mysql_fetch_array(mysql_query("SELECT $eweap FROM Players WHERE id='{$_COOKIE['id']}'"));
	$ameweap = $sql[0];
	$newewep = $ameweap - 1;
	if ($newewep < 0) {
		echo '<div id="crimestext" align="center">You need to own the weapons before using them!<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		$sql = mysql_query("UPDATE Players SET $dweap = '$amdweap' WHERE id='{$_COOKIE['id']}'");
		$sql = mysql_query("UPDATE Players SET $lweap = '$amlweap' WHERE id='{$_COOKIE['id']}'");
		exit();
	}
	$sql = mysql_query("UPDATE Players SET $eweap = '$newewep' WHERE id='{$_COOKIE['id']}'");
	}
	if ($wweap == 'none') {
	} else {
	$sql = mysql_fetch_array(mysql_query("SELECT $wweap FROM Players WHERE id='{$_COOKIE['id']}'"));
	$amwweap = $sql[0];
	$newwwep = $amwweap - 1;
	if ($newwwep < 0) {
		echo '<div id="crimestext" align="center">You need to own the weapons before using them!<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		$sql = mysql_query("UPDATE Players SET $eweap = '$ameweap' WHERE id='{$_COOKIE['id']}'");
		$sql = mysql_query("UPDATE Players SET $dweap = '$amdweap' WHERE id='{$_COOKIE['id']}'");
		$sql = mysql_query("UPDATE Players SET $lweap = '$amlweap' WHERE id='{$_COOKIE['id']}'");
		exit();
	}
	$sql = mysql_query("UPDATE Players SET $wweap = '$newwwep' WHERE id='{$_COOKIE['id']}'");
	}
	if ($lweap == 'luger') {
	$lweap = 'Luger';
	} elseif ($lweap == 'magnum') {
	$lweap = '.44 Caliber Magnum';
	} elseif ($lweap == 'uzi') {
	$lweap = 'Mini-Uzi';
	} elseif ($lweap == 'steyr') {
	$lweap = 'Steyr';
	} elseif ($lweap == 'desert_eagle') {
	$lweap = 'Desert Eagle';
	} elseif ($lweap == 'p90') {
	$lweap = 'P90';
	} elseif ($lweap == 'g36c') {
	$lweap = 'G36C';
	} elseif ($lweap == 'rpd') {
	$lweap = 'RPD';
	} elseif ($lweap == 'AK47') {
	$lweap = 'AK47';
	} elseif ($lweap == 'M4') {
	$lweap = 'M4 Carbine Rifle';
	} elseif ($lweap == 'stinger') {
	$lweap = 'Stinger';
	} elseif ($lweap == 'saw') {
	$lweap = 'M249 SAW';
	} elseif ($lweap == 'barett') {
	$lweap = 'Barrett .50 Caliber';
	}
	
	if ($dweap == 'luger') {
	$dweap = 'Luger';
	} elseif ($dweap == 'magnum') {
	$dweap = '.44 Caliber Magnum';
	} elseif ($dweap == 'uzi') {
	$dweap = 'Mini-Uzi';
	} elseif ($dweap == 'steyr') {
	$dweap = 'Steyr';
	} elseif ($dweap == 'desert_eagle') {
	$dweap = 'Desert Eagle';
	} elseif ($dweap == 'p90') {
	$dweap = 'P90';
	} elseif ($dweap == 'g36c') {
	$dweap = 'G36C';
	} elseif ($dweap == 'rpd') {
	$dweap = 'RPD';
	} elseif ($dweap == 'AK47') {
	$dweap = 'AK47';
	} elseif ($dweap == 'M4') {
	$dweap = 'M4 Carbine Rifle';
	} elseif ($dweap == 'stinger') {
	$dweap = 'Stinger';
	} elseif ($dweap == 'saw') {
	$dweap = 'M249 SAW';
	} elseif ($dweap == 'barett') {
	$dweap = 'Barrett .50 Caliber';
	}
	
	if ($eweap == 'luger') {
	$eweap = 'Luger';
	} elseif ($eweap == 'magnum') {
	$eweap = '.44 Caliber Magnum';
	} elseif ($eweap == 'uzi') {
	$eweap = 'Mini-Uzi';
	} elseif ($eweap == 'steyr') {
	$eweap = 'Steyr';
	} elseif ($eweap == 'desert_eagle') {
	$eweap = 'Desert Eagle';
	} elseif ($eweap == 'p90') {
	$eweap = 'P90';
	} elseif ($eweap == 'g36c') {
	$eweap = 'G36C';
	} elseif ($eweap == 'rpd') {
	$eweap = 'RPD';
	} elseif ($eweap == 'AK47') {
	$eweap = 'AK47';
	} elseif ($eweap == 'M4') {
	$eweap = 'M4 Carbine Rifle';
	} elseif ($eweap == 'stinger') {
	$eweap = 'Stinger';
	} elseif ($eweap == 'saw') {
	$eweap = 'M249 SAW';
	} elseif ($eweap == 'barett') {
	$eweap = 'Barrett .50 Caliber';
	}
	
	if ($wweap == 'luger') {
	$wweap = 'Luger';
	} elseif ($wweap == 'magnum') {
	$wweap = '.44 Caliber Magnum';
	} elseif ($wweap == 'uzi') {
	$wweap = 'Mini-Uzi';
	} elseif ($wweap == 'steyr') {
	$wweap = 'Steyr';
	} elseif ($wweap == 'desert_eagle') {
	$wweap = 'Desert Eagle';
	} elseif ($wweap == 'p90') {
	$wweap = 'P90';
	} elseif ($wweap == 'g36c') {
	$wweap = 'G36C';
	} elseif ($wweap == 'rpd') {
	$wweap = 'RPD';
	} elseif ($wweap == 'AK47') {
	$wweap = 'AK47';
	} elseif ($wweap == 'M4') {
	$wweap = 'M4 Carbine Rifle';
	} elseif ($wweap == 'stinger') {
	$wweap = 'Stinger';
	} elseif ($wweap == 'saw') {
	$wweap = 'M249 SAW';
	} elseif ($wweap == 'barett') {
	$wweap = 'Barrett .50 Caliber';
	}
	
	if ($lweap != 'none') {
	$query = mysql_query("UPDATE Robbery SET lwep = '$lweap' WHERE wep = '$u'");
	}
	if ($dweap != 'none') {
	$query = mysql_query("UPDATE Robbery SET dwep = '$dweap' WHERE wep = '$u'");
	}
	if ($eweap != 'none') {
	$query = mysql_query("UPDATE Robbery SET ewep = '$eweap' WHERE wep = '$u'");
	}
	if ($wweap != 'none') {
	$query = mysql_query("UPDATE Robbery SET wwep = '$wweap' WHERE wep = '$u'");
	}
		echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=OR.php\"></head>
			  <div align=\"center\" id=\"crimestext\">Successfully updated the weapons arrangement. Redirecting...</div>";
		include("footer.php");
} else {
echo '<div id="crimestext" align="center">Please go back and select weapons to use in the Organized Robbery!<br /><a href="OR.php">Go back.</a></div>';
include("footer.php");
exit();
}
}
?>