<?php
include("config.php");
include("countdown_p.php");

$row=mysql_fetch_array(mysql_query("SELECT location, money, username, armor, a1, a2, a3, a4 FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$l = $row[0];
$money = $row[1];
$u = $row[2];
$armor = $row[3];
$a1 = $row[4];
$a2 = $row[5];
$a3 = $row[6];
$a4 = $row[7];

$title="$l Armor Store";
include("header.php");

$price = 5000000;
$newmoney = ($money - $price);
$newarmor = ($armor + 25);

	if (isset($_POST['submitted'])) {
		$sr = $_POST['buy'];		
		if ($sr == NULL) {
		echo("<div id=\"crimestext\"><center>Please go back and select an item to purchase.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		} else {
		if ($armor == 100) {
		echo("<div id=\"crimestext\"><center><h1>Armor Store</h1><br />You already own all of the available armor.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		
		if ($sr == 'a1'){
		if ($a1 != 'yes'){
		if ($money >= $price) {
		mysql_query("UPDATE Players SET a1='yes', money='$newmoney', armor='$newarmor' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		echo("<div id=\"crimestext\"><center>You purchased a German Shepherd.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		echo("<div id=\"crimestext\"><center>You cannot afford a German Shepherd.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		} else {
		echo("<div id=\"crimestext\"><center>You already own a German Shepherd.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		
		} elseif ($sr == 'a2'){
		if ($a2 != 'yes'){
		if ($money >= $price) {
		mysql_query("UPDATE Players SET a2='yes', money='$newmoney', armor='$newarmor' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		echo("<div id=\"crimestext\"><center>You purchased a Stab Vest.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		echo("<div id=\"crimestext\"><center>You cannot afford a Stab Vest.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		} else {
		echo("<div id=\"crimestext\"><center>You already own a Stab Vest.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		
		} elseif ($sr == 'a3'){
		if ($a3 != 'yes'){
		if ($money >= $price) {
		mysql_query("UPDATE Players SET a3='yes', money='$newmoney', armor='$newarmor' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		echo("<div id=\"crimestext\"><center>You purchased an Advanced Combat Helmet (ACH).<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		echo("<div id=\"crimestext\"><center>You cannot afford an Advanced Combat Helmet (ACH).<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		} else {
		echo("<div id=\"crimestext\"><center>You already own an Advanced Combat Helmet (ACH).<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		
		} elseif ($sr == 'a4'){
		if ($a4 != 'yes'){
		if ($money >= $price) {
		mysql_query("UPDATE Players SET a4='yes', money='$newmoney', armor='$newarmor' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		echo("<div id=\"crimestext\"><center>You purchased a Ballistic Vest.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		} else {
		echo("<div id=\"crimestext\"><center>You cannot afford a Ballistic Vest.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		} else {
		echo("<div id=\"crimestext\"><center>You already own a Ballistic Vest.<br /><a href=\"armorstore.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		}
		}		
	} else {
			
if ($armor == 100) {
		echo("<div id=\"crimestext\"><center><h1>Armor Store</h1><br />You already own all of the available armor.</center></div>");
		include("footer.php");
		exit();
		}
		
echo('<div id="ltable" align="center">
<h1>Armor Store</h1>
<form action="armorstore.php" method="post">
<table>
<tr><td><input type="radio" name="buy" value="a1" /></td><td>German Shepherd</td><td>$5,000,000</td></tr>
<tr><td><input type="radio" name="buy" value="a2" /></td><td>Stab Vest</td><td>$5,000,000</td></tr>
<tr><td><input type="radio" name="buy" value="a3" /></td><td>Advanced Combat Helmet (ACH)</td><td>$5,000,000</td></tr>
<td><input type="radio" name="buy" value="a4" /></td><td>Ballistic Vest</td><td>$5,000,000</td></tr>
<tr><td colspan="3" align="center"><input type="submit" value="Buy!"><br /><input type="hidden" name="submitted" value="TRUE">
</form>
</td></tr></table>
</div>');
include("footer.php");
}
?>	