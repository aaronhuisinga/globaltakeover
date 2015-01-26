<?php
require_once("members/config.php");
include("members/countdown_p.php");
checks();

$result = mysql_query("SELECT location, username, Airtravel FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1");
$row = mysql_fetch_array($result);
$l = $row['location'];
$u = $row['username'];
$travel = $row['Airtravel'];
$title="$l Airport";
require_once("members/header.php");
include("members/Countdown_he.php");

$result = mysql_query("SELECT owner FROM airport WHERE location='$l' LIMIT 1");
$row = mysql_fetch_array($result);
$o = $row['owner'];

$sql = mysql_query("SELECT id, health FROM Players WHERE username='$o' LIMIT 1");
$row = mysql_fetch_array($sql);
$ownerid = $row['id'];
$ohealth = $row['health'];
	
if (($o == "None" || $o == NULL) || ($ohealth < 1)) {
	echo "<div id=\"ltable\" align=\"center\">
		<p>This Airport currently has no owner! Would you like to have it?
		<form name=\"pickup\" method=\"post\" action=\"members/appickup.php\">
		<input type=\"hidden\" name=\"location\" value=\"$l\" />
		<input type=\"submit\" name=\"submit\" value=\"Claim it!\" />
		<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
		</form></div>";
	include("members/footer.php");
} else {
		$result = mysql_query("SELECT owner FROM airport WHERE id='1' LIMIT 1");
		$row = mysql_fetch_array($result);
		$oo = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM airport WHERE id='2' LIMIT 1");
		$row = mysql_fetch_array ($result);
		$ot = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM airport WHERE id='3' LIMIT 1");
		$row = mysql_fetch_array($result);
		$oth = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM airport WHERE id='4' LIMIT 1");
		$row = mysql_fetch_array($result);
		$of = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM airport WHERE id='5' LIMIT 1");
		$row = mysql_fetch_array($result);
		$ofi = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM airport WHERE id='6' LIMIT 1");
		$row = mysql_fetch_array ($result);
		$os = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM airport WHERE location='$l' LIMIT 1");
		$row = mysql_fetch_array($result);
		$owner = $row['owner'];
		
		$sql = mysql_query("SELECT * FROM apescrow WHERE other='$u'");
		$row = mysql_fetch_array($sql);
		if (mysql_num_rows($sql) == 1) {
		$own = $row['username'];
		$query = mysql_query("SELECT id, health FROM Players WHERE username='$own' LIMIT 1");
		$row1 = mysql_fetch_array($query);
		$ownerid = $row1['id'];
		$money = $row['money'];
		$taxm = floor($money * 0.09);
		$tmoney = $money + $taxm;
		$bullets = $row['bullets'];
		$tokens = $row['tokens'];
		$location = $row['location'];
		echo "<div id='crimestext' align='center'><table><tr><td><center><a href='members/profile.php?id=$ownerid'>$own</a> has started an escrow for $location Airport</center></td></tr>
		<tr><td><center>Money: $".number_format($tmoney)." ($".number_format($money)." + $".number_format($taxm).")</center></td></tr>
		<tr><td><center>Bullets: ".number_format($bullets)."</center></td></tr>
		<tr><td><center>Tokens: ".number_format($tokens)."</center></td></tr></table><br><br>
		<form action='members/apescrow.php' method='POST'><input type='submit' value='Accept!' name='Accept'><input type='submit' value='Decline!' name='Decline'></form></div>";
		include("members/footer.php");
		exit();
		}
		$now = time();
		if ($now < $travel) {
		$sl = $travel - $now;
		$ml = floor($sl/60);
		if ($sl > 89) {
		if ($u == $o OR $oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
		echo "<div id=\"ltable\" align=\"center\"><h1 align=\"center\"><a href=\"members/airporto.php\">Ownership</a></h1></div>";
		}
		echo "<div id=\"crimestext\"><center>Not so fast! The next flight leaves in $ml minutes!</center></div>";
		include("members/footer.php");
		} elseif ($sl < 90) {
		if ($u == $o OR $oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
		echo "<div id=\"gameplay\"><h1 align=\"center\"><a href=\"members/airporto.php\">Ownership</a></h1><br></div>";
		}
		echo "<div id=\"crimestext\"><center>Not so fast! The next flight leaves in $sl seconds!</center></div>";
		include("members/footer.php");
		}
		exit();
		} else {
			if ($u == $o OR $oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
				echo "<div id=\"ltable\" align=\"center\"><h1 align=\"center\"><a href=\"members/airporto.php\">Ownership</a></h1><br />";
			} else {
				echo "<div id=\"ltable\" align=\"center\">";
			}
			$sql1 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='Training Plane'");
			$sql2 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='Glider'");
			$sql3 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='Passenger Plane'");
			$sql4 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='Jumbo Jet'");
			$sql5 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='Vulcan Bomber'");
			$sql6 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='F15 Fighter'");
			$sql7 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='Eagle Fighter'");
			$sql8 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='Stealth Fighter'");
			$sql9 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='Eurofighter Typhoon'");
			$planes = array();
			if (mysql_num_rows($sql1) >= 1) {
			$planes[] = "<option value='Training'>Training Plane</option>";
			}
			if (mysql_num_rows($sql2) > 0) {
			$planes[] = "<option value='Gilder'>Glider</option>";
			}
			if (mysql_num_rows($sql3) > 0) {
			$planes[] = "<option value='PP'>Passenger Plane</option>";
			}
			if (mysql_num_rows($sql4) > 0) {
			$planes[] = "<option value='JJ'>Jumbo Jet</option>";
			}
			if (mysql_num_rows($sql5) > 0) {
			$planes[] = "<option value='VB'>Vulcan Bomber</option>";
			}
			if (mysql_num_rows($sql6) > 0) {
			$planes[] = "<option value='F15'>F15 Fighter</option>";
			}
			if (mysql_num_rows($sql7) > 0) {
			$planes[] = "<option value='Eagle'>Eagle Fighter</option>";
			}
			if (mysql_num_rows($sql8) > 0) {
			$planes[] = "<option value='Stealth'>Stealth Fighter</option>";
			}
			if (mysql_num_rows($sql9) > 0) {
			$planes[] = "<option value='Euro'>Eurofighter Typhoon</option>";
			}
			
			echo "<h1>Airport</h1>
				<p>Select a location from the list below to travel there.</p>
				<table><tr><td>
				<form action=\"members/airport.php\" method=\"post\">
				<input type=\"radio\" name=\"travel\" value=\"UK\" /> UK
				<br>
				<input type=\"radio\" name=\"travel\" value=\"Russia\" /> Russia
				<br>
				<input type=\"radio\" name=\"travel\" value=\"USA\" /> USA
				<br>
				<input type=\"radio\" name=\"travel\" value=\"Australia\" /> Australia
				<br>
				<input type=\"radio\" name=\"travel\" value=\"Philippines\" /> Philippines
				<br>
				<select name='Plane'><option value='Airport'>Borrow Airport's</option>";
			foreach ($planes as $msg) {
			echo "$msg";
			}
					
			echo "</select><br /><input type=\"submit\" name=\"submit\" value=\"Do It!\" />
				<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />	
				</form>
				</td></tr></table>
				<br />This Airport is owned by <a href=\"members/profile.php?id={$ownerid}\">$owner</a>
				</div>";
				include("members/footer.php");
		}
	}
?>