<?php
$title="Inventory";
include("config.php");
include("header.php");
include("Countdown_he.php");
include("countdown_p.php");
checks();
online();

		$row=mysql_fetch_array(mysql_query("SELECT luger, magnum, uzi, steyr, desert_eagle, p90, g36c, rpd, AK47, M4, stinger, saw, barett, grenades, bandage, morphene, skit, knife, lkit FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
		$j = $row[0];
		$b = $row[1];
		$r = $row[2];
		$l = $row[3];
		$a = $row[4];
		$hl = $row[5];
		$p = $row[6];
		$bo = $row[7];
		$t = $row[8];
		$h = $row[9];
		$y = $row[10];
		$m = $row[11];
		$e = $row[12];
		$g = $row[13];
		$ban = $row[14];
		$mor = $row[15];
		$skit = $row[16];
		$kni = $row[17];
		$lkit = $row[18];
		
		$weapons = array();
		$med = array();
		if ($j != 0) {
		$weapons[] = "<tr>
<td>$j</td>
<td>Luger</td>
<td>$2,500</td>
<td><input name=\"luger\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($b != 0) {
		$weapons[] = "<tr>
<td>$b</td>
<td>.44 Caliber Magnum</td>
<td>$3,000</td>
<td><input name=\"cal\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($r != 0) {
		$weapons[] = "<tr>
<td>$r</td>
<td>Mini-Uzi</td>
<td>$5,000</td>
<td><input name=\"uzi\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($l != 0) {
		$weapons[] = "<tr>
<td>$l</td>
<td>Steyr</td>
<td>$25,000</td>
<td><input name=\"steyr\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($a != 0) {
		$weapons[] = "<tr>
<td>$a</td>
<td>Desert Eagle</td>
<td>$55,000</td>
<td><input name=\"DE\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($hl != 0) {
		$weapons[] = "<tr>
<td>$hl</td>
<td>P90</td>
<td>$75,000</td>
<td><input name=\"P90\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($p != 0) {
		$weapons[] = "<tr>
<td>$p</td>
<td>G36C</td>
<td>$150,000</td>
<td><input name=\"G36C\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($bo != 0) {
		$weapons[] = "<tr>
<td>$bo</td>
<td>RPD</td>
<td>$250,000</td>
<td><input name=\"RPD\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($t != 0) {
		$weapons[] = "<tr>
<td>$t</td>
<td>AK47</td>
<td>$350,000</td>
<td><input name=\"AK\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($h != 0) {
		$weapons[] = "<tr>
<td>$h</td>
<td>M4 Carbine Rifle</td>
<td>$400,000</td>
<td><input name=\"M4\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($y != 0) {
		$weapons[] = "<tr>
<td>$y</td>
<td>Stinger</td>
<td>$500,000</td>
<td><input name=\"stinger\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($m != 0) {
		$weapons[] = "<tr>
<td>$m</td>
<td>M249 SAW</td>
<td>$750,000</td>
<td><input name=\"SAW\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($e != 0) {
		$weapons[] = "<tr>
<td>$e</td>
<td>Barrett .50 Caliber</td>
<td>$1,500,000</td>
<td><input name=\"Barett\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($g != 0) {
		$weapons[] = "<tr>
<td>$g</td>
<td>Frag Grenades</td>
<td>$25,000</td>
<td><input name=\"grenade\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($ban != 0) {
		$weapons[] = "<tr>
<td>$ban</td>
<td>Bandage</td>
<td>$100</td>
<td><input name=\"Bandage\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($mor != 0) {
		$weapons[] = "<tr>
<td>$mor</td>
<td>Syringe of Morphine</td>
<td>$5,000</td>
<td><input name=\"Morpene\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($kni != 0) {
		$weapons[] = "<tr>
<td>$kni</td>
<td>Medical Knife</td>
<td>$5,000</td>
<td><input name=\"knife\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($skit != 0) {
		$weapons[] = "<tr>
<td>$skit</td>
<td>Small First Aid Kit</td>
<td>$15,000</td>
<td><input name=\"skit\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		
		if ($lkit != 0) {
		$weapons[] = "<tr>
<td>$lkit</td>
<td>Large First Aid Kit</td>
<td>$20,000</td>
<td><input name=\"lkit\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($ban != 0) {
		$med[] = "<tr>
<td>$ban</td>
<td>Bandage</td>
<td>1%</td>
<td><input name=\"Bandage\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($mor != 0) {
		$med[] = "<tr>
<td>$mor</td>
<td>Syringe of Morphine</td>
<td>5%</td>
<td><input name=\"Morpene\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($kni != 0) {
		$med[] = "<tr>
<td>$kni</td>
<td>Medical Knife</td>
<td>5-15%</td>
<td><input name=\"knife\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		if ($skit != 0) {
		$med[] = "<tr>
<td>$skit</td>
<td>Small First Aid Kit</td>
<td>10%</td>
<td><input name=\"skit\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		
		if ($lkit != 0) {
		$med[] = "<tr>
<td>$lkit</td>
<td>Large First Aid Kit</td>
<td>20%</td>
<td><input name=\"lkit\" type=\"text\" size=\"2\"></td>
</tr>";
		}
		
echo("<form name=\"insell\" method=\"post\" action=\"insell.php\">
<div id=\"ltable\" align=\"center\">
<h1>Inventory</h1>
<table width=\"30%\" id=\"usertable\">
<tr class=\"top\">
<td><b>Amount</b></td>
<td><b>Item</b></td>
<td><b>Selling price (each)</b></td>
<td><b>Amount</b></td>
</tr>");
 		foreach ($weapons as $msg) {
 		echo "$msg";
 		}
 		
echo "</table>
<input type=\"submit\" name=\"Submit\" value=\"Sell\">
</form><br /><br />
<form name=\"insell\" method=\"post\" action=\"inmed.php\"><center>
<h1>Medical</h1>
<table width=\"30%\" id=\"usertable\">
<tr class=\"top\">
<td><b>Amount</b></td>
<td><b>Item</b></td>
<td><b>Percent Heal (each)</b></td>
<td><b>Amount</b></td>
</tr>";

foreach ($med as $msg) {
 		echo "$msg";
 		}

echo "</table><input type=\"submit\" name=\"Submit\" value=\"Heal\"></form></div>";  
include("footer.php");
exit();
?>