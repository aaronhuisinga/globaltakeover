<?php
include("config.php");
include("countdown_p.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT location, money, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$l = $row[0];
$money = $row[1];
$u = $row[2];

$title="$l Weapon Factory";
include("header.php");

$row=mysql_fetch_array(mysql_query("SELECT owner FROM wf WHERE location='$l' LIMIT 1;"));
$o = $row[0];
$row=mysql_fetch_array(mysql_query("SELECT health, id, money FROM Players WHERE username='$o' LIMIT 1;"));
$ohealth = $row[0];
$ownerid = $row[1];
$ownercash = $row[2];

if ($o == 'None' OR $o == NULL OR $ohealth < 1) {
echo ("<div id=\"crimestext\"><center>
<p>This Weapon Factory currently has no owner! Would you like to pick it up?
<form name=\"pickup\" method=\"post\" action=\"wfpickup.php\">
<input type=\"hidden\" name=\"location\" value=\"$l\" />
<input type=\"submit\" name=\"submit\" value=\"Claim it!\" />
<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></form></div>");
include("footer.php");
exit();	
} else {
$sql = mysql_query("SELECT * FROM wfescrow WHERE other='$u' LIMIT 1;");
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
		echo "<div id='crimestext' align='center'><table><tr><td><center><a href='members/profile.php?id=$ownerid'>$own</a> has started an escrow for $location Weapon Factory</center></td></tr>
		<tr><td><center>Money: $".number_format($tmoney)." ($".number_format($money)." + $".number_format($taxm).")</center></td></tr>
		<tr><td><center>Bullets: ".number_format($bullets)."</center></td></tr>
		<tr><td><center>Tokens: ".number_format($tokens)."</center></td></tr></table><br><br>
		<form action='wfescrow.php' method='POST'><input type='submit' value='Accept!' name='Accept'><input type='submit' value='Decline!' name='Decline'></form></div>";
		include("footer.php");
		exit();
		}

	if (isset($_POST['submitted'])) {
		$sr = $_POST['buy'];			
		if ($sr == NULL) {
		echo("<div id=\"crimestext\"><center>Please go back and select a weapon to purchase.<br /><a href=\"wf.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		} else {
		if ($sr == 'luger'){
		$price = 5000;
		$name="Luger";
		} elseif ($sr == 'magnum'){
		$price = 6000;
		$name=".44 Caliber Magnum";
		} elseif ($sr == 'uzi'){
		$price = 10000;
		$name="Mini-Uzi";
		} elseif ($sr == 'steyr'){
		$price = 50000;
		$name="Steyr";
		} elseif ($sr == 'desert_eagle'){
		$price = 110000;
		$name="Desert Eagle";
		} elseif ($sr == 'p90'){
		$price = 150000;
		$name="P90";
		} elseif ($sr == 'g36c'){
		$price = 300000;
		$name="G36C";
		} elseif ($sr == 'rpd'){
		$price = 500000;
		$name="RPD";
		} elseif ($sr == 'AK47'){
		$price = 700000;
		$name="AK47";
		} elseif ($sr == 'M4'){
		$price = 800000;
		$name="M4 Carbine Rifle";
		} elseif ($sr == 'stinger'){
		$price = 1000000;
		$name="Stinger";
		} elseif ($sr == 'saw'){
		$price = 1500000;
		$name="M249 SAW";
		}
		
		if ($money >= $price) {
		mysql_query("UPDATE Players SET $sr=($sr+1), money=(money-$price) WHERE id='{$_COOKIE['id']}' LIMIT 1;");	
		$tax = ($price * .35);
		$pfinal = ($price - $tax);
		
		if ($u != $o) {
		mysql_query("UPDATE Players SET money=(money+$pfinal) WHERE username='$o' LIMIT 1;");
		mysql_query("INSERT INTO wfsales (amount, location, btime, username) VALUES ('$pfinal', '$l', '$current', '$u')");
		}
		echo("<div id=\"crimestext\"><center>You purchased a $name.<br /><a href=\"wf.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		echo("<div id=\"crimestext\"><center>You cannot afford a $name.<br /><a href=\"wf.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		}		
			
	} else {
		$uown=0;
		$arr = array('1', '2', '3', '4', '5', '6');
		foreach ($arr as $lt) {
		$row=mysql_fetch_array(mysql_query("SELECT `owner` FROM wf WHERE id='$lt' LIMIT 1;"));
		$oo=$row[0];
		if ($u == $oo) {
		$uown=1;
		}
		}
		
echo("<div id=\"ltable\" align=\"center\"><h1>$l Weapon Factory</h1><br />");
	if ($uown==1) {
		echo ("<h1><a href=\"wfo.php\">Ownership</a></h1>");
	}
echo('<form action="wf.php" method="post">
<table>
<tr><td><input type="radio" name="buy" value="luger" /></td><td>Luger</td><td>$5,000</td></tr>
<tr><td><input type="radio" name="buy" value="magnum" /></td><td>.44 Caliber Magnum</td><td>$6,000</td></tr>
<tr><td><input type="radio" name="buy" value="uzi" /></td><td>Mini-Uzi</td><td>$10,000</td></tr>
<tr><td><input type="radio" name="buy" value="steyr" /></td><td>Steyr</td><td>$50,000</td></tr>
<tr><td><input type="radio" name="buy" value="desert_eagle" /></td><td>Desert Eagle</td><td>$110,000</td></tr>
<tr><td><input type="radio" name="buy" value="p90" /></td><td>P90</td><td>$150,000</td></tr>
<tr><td><input type="radio" name="buy" value="g36c" /></td><td>G36C</td><td>$300,000</td></tr>
<tr><td><input type="radio" name="buy" value="rpd" /></td><td>RPD</td><td>$500,000</td></tr>
<tr><td><input type="radio" name="buy" value="AK47" /></td><td>AK47</td><td>$700,000</td></tr>
<tr><td><input type="radio" name="buy" value="M4" /></td><td>M4 Carbine Rifle</td><td>$800,000</td></tr>
<tr><td><input type="radio" name="buy" value="stinger" /></td><td>Stinger</td><td>$1,000,000</td></tr>
<tr><td><input type="radio" name="buy" value="saw" /></td><td>M249 SAW</td><td>$1,500,000</td></tr>
<tr><td colspan="3" align="center"><input type="submit" value="Buy!"><input type="hidden" name="submitted" value="TRUE"></td></tr>
</table></form>');

echo"This Weapon Factory is owned by <a href=\"profile.php?id={$ownerid}\">$o</a></div>";
include("footer.php");
}
}
?>	