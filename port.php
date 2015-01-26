<?php
require_once("members/config.php");
include("members/countdown_p.php");
checks();

$result = mysql_query("SELECT location, Btravel FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1");
$row = mysql_fetch_array($result);
$l = $row['location'];
$travel = $row['Btravel'];
$title="$l Port";
require_once("members/header.php");
include("members/Countdown_he.php");

$result = mysql_query("SELECT owner FROM port WHERE location='$l' LIMIT 1");
$row = mysql_fetch_array($result);
$o = $row['owner'];

$sql = mysql_query("SELECT id, health FROM Players WHERE username='$o' LIMIT 1");
$row = mysql_fetch_array($sql);
$ownerid = $row['id'];
$ohealth = $row['health'];
	
if (($o == "None" || $o == NULL) || ($ohealth < 1)) {
	echo "<div id=\"ltable\" align=\"center\">
		<p>This Port currently has no owner! Would you like to have it?
		<form name=\"pickup\" method=\"post\" action=\"members/portpickup.php\">
		<input type=\"hidden\" name=\"location\" value=\"$l\" />
		<input type=\"submit\" name=\"submit\" value=\"Claim it!\" />
		<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
		</form></div>";
	include("members/footer.php");
} else {
		$result = mysql_query("SELECT owner FROM port WHERE id='1' LIMIT 1");
		$row = mysql_fetch_array($result);
		$oo = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM port WHERE id='2' LIMIT 1");
		$row = mysql_fetch_array ($result);
		$ot = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM port WHERE id='3' LIMIT 1");
		$row = mysql_fetch_array($result);
		$oth = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM port WHERE id='4' LIMIT 1");
		$row = mysql_fetch_array($result);
		$of = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM port WHERE id='5' LIMIT 1");
		$row = mysql_fetch_array($result);
		$ofi = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM port WHERE id='6' LIMIT 1");
		$row = mysql_fetch_array ($result);
		$os = $row['owner'];
		
		$result = mysql_query("SELECT owner FROM port WHERE location='$l' LIMIT 1");
		$row = mysql_fetch_array($result);
		$owner = $row['owner'];
		
		$sql = mysql_query("SELECT * FROM pescrow WHERE other='$u'");
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
		echo "<div id='crimestext' align='center'><table><tr><td><center><a href='members/profile.php?id=$ownerid'>$own</a> has started an escrow for $location Port</center></td></tr>
		<tr><td><center>Money: $".number_format($tmoney)." ($".number_format($money)." + $".number_format($taxm).")</center></td></tr>
		<tr><td><center>Bullets: ".number_format($bullets)."</center></td></tr>
		<tr><td><center>Tokens: ".number_format($tokens)."</center></td></tr></table><br><br>
		<form action='members/pescrow.php' method='POST'><input type='submit' value='Accept!' name='Accept'><input type='submit' value='Decline!' name='Decline'></form></div>";
		include("members/footer.php");
		exit();
		}
		
		if ($current < $travel) {
		$sl = $travel - $current;
		$ml = floor($sl/60);
		if ($sl > 89) {
		if ($u == $o OR $oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
		echo "<div id=\"ltable\" align=\"center\"><h1><a href=\"members/porto.php\">Ownership</a></h1><br />";
		}
		echo "Not so fast! The next flight leaves in $ml minutes!</div>";
		include("members/footer.php");
		} elseif ($sl < 90) {
		if ($u == $o OR $oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
		echo "<div id=\"ltable\" align=\"center\"><h1><a href=\"members/porto.php\">Ownership</a></h1><br />";
		}
		echo "Not so fast! The next flight leaves in $sl seconds!</div>";
		include("members/footer.php");
		}
		exit();
		} else {
			if ($u == $o OR $oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
				echo "<div id=\"ltable\" align=\"center\"><h1><a href=\"members/porto.php\">Ownership</a></h1><br />";
			} else {
				echo "<div id=\"ltable\" align=\"center\">";
			}
			$sql1 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Dingy'");
			$sql2 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Air Craft Carrier'");
			$sql3 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Catermaran'");
			$sql4 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Submarine'");
			$sql5 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Battleship'");
			$sql6 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Army submarine'");
			$sql7 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Destroyer'");
			$sql8 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Cruiser'");
			$sql9 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='Nuclear Submarine'");
			$planes = array();
			if (mysql_num_rows($sql1) >= 1) {
			$planes[] = "<option value='Training'>Dingy</option>";
			}
			if (mysql_num_rows($sql2) > 0) {
			$planes[] = "<option value='Gilder'>Air Craft Carrier</option>";
			}
			if (mysql_num_rows($sql3) > 0) {
			$planes[] = "<option value='PP'>Catermaran</option>";
			}
			if (mysql_num_rows($sql4) > 0) {
			$planes[] = "<option value='JJ'>Submarine</option>";
			}
			if (mysql_num_rows($sql5) > 0) {
			$planes[] = "<option value='VB'>Battleship</option>";
			}
			if (mysql_num_rows($sql6) > 0) {
			$planes[] = "<option value='F15'>Army submarine</option>";
			}
			if (mysql_num_rows($sql7) > 0) {
			$planes[] = "<option value='Eagle'>Destroyer</option>";
			}
			if (mysql_num_rows($sql8) > 0) {
			$planes[] = "<option value='Stealth'>Cruiser</option>";
			}
			if (mysql_num_rows($sql9) > 0) {
			$planes[] = "<option value='Euro'>Nuclear Submarine</option>";
			}
			echo "<h1>Port</h1>
				<p>Select a location from the list below to travel there.</p>
				<table><tr><td>
				<form action=\"members/port.php\" method=\"post\">
				<input type=\"radio\" name=\"travel\" value=\"UK\" /> UK
				<br>
				<input type=\"radio\" name=\"travel\" value=\"Russia\" /> Russia
				<br>
				<input type=\"radio\" name=\"travel\" value=\"USA\" /> USA
				<br>
				<input type=\"radio\" name=\"travel\" value=\"Australia\" /> Australia
				<br>
				<input type=\"radio\" name=\"travel\" value=\"Philippines\" /> Philippines
				<br><select name='Plane'><option value='Airport'>Borrow Port's</option>";
				
			foreach ($planes as $msg) {
			echo "$msg";
			}
				
				echo "</select><br><input type=\"submit\" name=\"submit\" value=\"Do It!\" />
				<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />	
				</form>
				</td></tr></table>
				<br />This Port is owned by <a href=\"members/profile.php?id={$ownerid}\">$owner</a>
				</div>";
			include("members/footer.php");
		}
	}
?>