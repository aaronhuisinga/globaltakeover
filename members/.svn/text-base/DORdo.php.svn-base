<?php
$title="Organized Robbery";
include("config.php"); 
include("header.php");
include("Rank-ups.inc.php");
include("Countdown_OR.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username, money, location FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];
$l = $row[2];

if ($_REQUEST['Commit']) {
	$row=mysql_fetch_array(mysql_query("SELECT * FROM Robbery WHERE leader='$u' LIMIT 1;"));
	$lead = $row['leader'];
	$driver = $row['driver'];
	$ee = $row['ee'];
	$wep = $row['wep'];
	$rcar = $row['vehicle'];
	$explosive = $row['explosive'];
	$lgun = $row['lwep'];
	$dgun = $row['dwep'];
	$egun = $row['ewep'];
	$wgun = $row['wwep'];
	$hack = $row['hack'];
	$dp = $row['dp'];
	$ep = $row['ep'];
	$wp = $row['wp'];
	$tp = $dp + $ep + $wp;
	$lp = 100 - $tp;
	$dper = $dp/100;
	$eper = $ep/100;
	$wper = $wp/100;
	$lper = $lp/100;
	if ($u != $lead) {
		echo '<div id="crimestext" align="center">You cannot commit the robbery if you are not the Hacker!<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	} else {
		if ($lead != 'None' AND $driver != 'None' AND $ee != 'None' AND $wep != 'None' AND $rcar != NULL AND $explosive != NULL AND $lgun != NULL AND $dgun != NULL AND $egun != NULL AND $wgun != NULL AND $hack != NULL) {
			
			if ($rcar == 'Eurofighter Typhoon') {
			$carn = 9;
			} elseif ($rcar == 'Stealth Fighter'){
			$carn = 8;
			} elseif ($rcar == 'Eagle Fighter') {
			$carn = 7;
			} elseif ($rcar == 'F15 Fighter') {
			$carn = 6;
			} elseif ($rcar == 'Vulcan Bomber') {
			$carn = 5;
			} elseif ($rcar == 'Jumbo Jet') {
			$carn = 4;
			} elseif ($rcar == 'Passenger Plane') {
			$carn = 3;
			} elseif ($rcar == 'Glider') {
			$carn = 2;
			} elseif ($rcar == 'Training Plane') {
			$carn = 1;
			}
			
			if ($explosive == 'Incendiary Grenades') {
			$exn = 5;
			} elseif ($explosive == 'Sting Grenades') {
			$exn = 4;
			} elseif ($explosive == 'Stun Grenades') {
			$exn = 3;
			} elseif ($explosive == 'Smoke Grenades') {
			$exn = 2;
			} elseif ($explosive == 'Gun Powder') {
			$exn = 1;
			}
			
			$arr = array($lgun, $dgun, $egun, $wgun);
			$wpn=0;
			foreach ($arr as $position) {
			
			if ($position == 'Barrett .50 Caliber') {
			$lwn = 14;
			} elseif ($position == 'M249 SAW'){
			$lwn = 13;
			} elseif ($position == 'Stinger') {
			$lwn = 11;
			} elseif ($position == 'M4 Carbine Rifle') {
			$lwn = 10;
			} elseif ($position == 'AK47') {
			$lwn = 9;
			} elseif ($position == 'RPD'){
			$lwn = 8;
			} elseif ($position == 'G36C') {
			$lwn = 7;
			} elseif ($position == 'P90') {
			$lwn = 6;
			} elseif ($position == 'Desert Eagle') {
			$lwn = 5;
			} elseif ($position == 'Steyr') {
			$lwn = 4;
			} elseif ($position == 'Mini-Uzi') {
			$lwn = 3;
			} elseif ($position == '.44 Caliber Magnum') {
			$lwn = 2;
			} elseif ($position == 'Luger') {
			$lwn = 1;
			}
			
			$wpn=($wpn+$lwn);
			}
			
			if ($hack == 'Micro-cameras') {
			$exh = 4;
			} elseif ($hack == 'Proximity Detectors') {
			$exh = 3;
			} elseif ($hack == 'Drones') {
			$exh = 2;
			} elseif ($hack == 'Laptop') {
			$exh = 1;
			}
			
			$mn = $wpn + $exn + $carn + $exh;
			if ($mn > 73) {
			$ormon = rand (9500000, 13000000);
			} elseif ($mn > 63) {
			$ormon = rand (7000000, 9000000);
			} elseif ($mn > 49 AND $mn < 64) {
			$ormon = rand (6000000, 7500000);
			} elseif ($mn > 39 AND $mn < 50) {
			$ormon = rand (5000000, 6500000);
			} elseif ($mn > 29 AND $mn < 40) {	
			$ormon = rand (4000000, 5500000);
			} elseif ($mn > 19 AND $mn < 30) {
			$ormon = rand (3000000, 4500000);	
			} elseif ($mn > 9 AND $mn < 20) {
			$ormon = rand (2000000, 3500000);	
			} elseif ($mn > 0 AND $mn < 10) {			
			$ormon = rand (1000000, 2500000);
			}
			$dm = floor($ormon*$dper);
			$em = floor($ormon*$eper);
			$wm = floor($ormon*$wper);
			$lm = floor($ormon*$lper);
			
			$arr = array($lead, $driver, $ee, $wep);
			$texp=0;
			foreach ($arr as $position) {
			$row=mysql_fetch_array(mysql_query("SELECT `rank` FROM Players WHERE username='$position' LIMIT 1;"));
			$lrank = $row[0];
			
			if ($lrank == 'Wannabe') {
			$lore = rand(20, 30);
			} elseif ($lrank == 'Recruit') {
			$lore = rand(30, 40);
			} elseif ($lrank == 'Private') {
			$lore = rand(40, 50);
			} elseif ($lrank == 'Soldier') {
			$lore = rand(50, 60);
			} elseif ($lrank == 'Mercenary') {
			$lore = rand(60, 70);
			} elseif ($lrank == 'Hired Killer') {
			$lore = rand(70, 80);
			} elseif ($lrank == 'Contract Killer') {
			$lore = rand(80, 90);
			} elseif ($lrank == 'Corporal') {
			$lore = rand(100, 110);
			} elseif ($lrank == 'Sergeant') {
			$lore = rand(120, 130);
			} elseif ($lrank == 'Staff Sergeant') {
			$lore = rand(130, 140);
			} elseif ($lrank == 'Lieutenant') {
			$lore = rand(140, 150);			
			} elseif ($lrank == 'Captain') {
			$lore = rand(160, 170);
			} elseif ($lrank == 'Major') {
			$lore = rand(180, 190);
			} elseif ($lrank == 'Colonel') {
			$lore = rand(190, 200);
			} elseif ($lrank == 'Brigadier') {
			$lore = rand(200, 210);
			} elseif ($lrank  == 'General') {
			$lore  = rand(210, 220);
			} elseif ($lrank == 'Warlord') {
			$lore = rand(220, 230);
			} elseif ($lrank == 'Field Marshall') {
			$lore = rand(230, 240);
			} elseif ($lrank == 'Dictator') {
			$lore = rand(240, 250);
			} else {
			$lore = rand(240, 250);
			}
			
			$texp=($texp+$lore);
			}

			mysql_query("UPDATE Players SET money=(money+$lm), exp=(exp+$texp), `ortime` = ($current+28800) WHERE username = '$lead'");
			mysql_query("UPDATE Players SET money=(money+$dm), exp=(exp+$texp), `ortime` = ($current+28800) WHERE username = '$driver'");
			mysql_query("UPDATE Players SET money=(money+$em), exp=(exp+$texp), `ortime` = ($current+28800) WHERE username = '$ee'");
			mysql_query("UPDATE Players SET money=(money+$wm), exp=(exp+$texp), `ortime` = ($current+28800) WHERE username = '$wep'");
			
				$subject = htmlspecialchars(addslashes("Organized Robbery Completed"));
				$message = htmlspecialchars(addslashes("$lead has completed the Organized Robbery! It was successful, and you received $".number_format($dm).""));
				mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$driver', 'Global Takeover', 'unread', '$date')");

				$subject = htmlspecialchars(addslashes("Organized Robbery Completed"));
				$message = htmlspecialchars(addslashes("$lead has completed the Organized Robbery! It was successful, and you received $".number_format($em).""));
				mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$ee', 'Global Takeover', 'unread', '$date')");

				$subject = htmlspecialchars(addslashes("Organized Robbery Completed"));
				$message = htmlspecialchars(addslashes("$lead has completed the Organized Robbery! It was successful, and you received $".number_format($wm).""));
				mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$wep', 'Global Takeover', 'unread', '$date')");

				$subject = htmlspecialchars(addslashes("Organized Robbery Completed"));
				$message = htmlspecialchars(addslashes("$lead has completed the Organized Robbery! It was successful, and you received $".number_format($lm).""));
				mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$lead', 'Global Takeover', 'unread', '$date')");

			echo "<div id=\"crimestext\" align=\"center\">You completed the robbery and got away with $".number_format($ormon)."!</div>";
			include("footer.php");
			mysql_query("DELETE FROM Robbery WHERE leader='$u' LIMIT 1;");
			
			$row=mysql_fetch_array(mysql_query("SELECT id, postid FROM thread WHERE author='$u' AND ads='yes' LIMIT 1;"));
			$id=$row[0];
			$pid=$row[1];
			mysql_query("DELETE FROM post WHERE id='$pid' LIMIT 1;");
			mysql_query("DELETE FROM thread WHERE id='$id' LIMIT 1;");
			$sql=mysql_query("SELECT postid FROM reply WHERE topicid='$id'");
			while ($row=mysql_fetch_array($sql)){
			$rid=$row[0];
			mysql_query("DELETE FROM post WHERE id='$rid'");
			mysql_query("DELETE FROM reply WHERE topicid='$id'");
			}
			exit();
	}}
} else {
echo '<div id="crimestext" align="center">Please decide what you are going to do, first!<br /><a href="OR.php">Go back.</a></div>';
include("footer.php");
exit();
}
?>	