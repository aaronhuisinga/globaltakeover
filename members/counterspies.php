<?php
$title="Counterspies";
include('config.php');
include("header.php");
include("Countdown_he.php");
include("countdown_p.php");
checks();

$result = mysql_query("SELECT money, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$m = $row[0];
$u = $row[1];

if (isset($_REQUEST['submit'])) {	
		$dd = $_POST['number'];
		if ($dd == '1'){
		$searched = mysql_query("SELECT * FROM spies WHERE target='$u' LIMIT 1");
		$row = mysql_fetch_array ($searched);
		$hunter = $row['hunter'];
		$price = 4000000;
		
		if ($price > $m) {
		echo ("<div id=\"ltable\"><center>You do not have enough money to pay the Counterspy. <br /> <a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		$newcash = ($m - $price);
		
		$result = mysql_query("UPDATE Players SET money='$newcash' WHERE id='{$_COOKIE['id']}'");
		
		if (mysql_num_rows($searched) == 0) {
		echo ("<div id=\"ltable\"><center>Your spy went out and searched, but found no other spies currently that were hunting for you.<br />
		Try and be more sure next time you hire someone. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} else {
		$chance = rand(1,100);
		if ($chance >= 1 AND $chance <= 10) {
		$query = mysql_query("DELETE FROM spies WHERE target='$u' AND hunter='$hunter'");
		
		echo ("<div id=\"ltable\"><center>Your spy was able to infiltrate the agency, and killed the spy who was assigned to kill you.<br />
		He was also able to find that $hunter had been the one to assign the spies to kill you. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} elseif ($chance > 10 AND $chance <= 100) {
		echo ("<div id=\"ltable\"><center>Your spy attempted to kill the spies currently tracking you, but they were able to track and kill him first.<br />
		The enemy spies remain hot on your trail. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		}
		
		} elseif ($dd == '2'){
		$searched = mysql_query("SELECT * FROM spies WHERE target='$u' LIMIT 1");
		$row = mysql_fetch_array ($searched);
		$hunter = $row['hunter'];
		$price = 8000000;
		
		if ($price > $m) {
		echo ("<div id=\"ltable\"><center>You do not have enough money to pay the Counterspies. <br /> <a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		$newcash = ($m - $price);
		
		$result = mysql_query("UPDATE Players SET money='$newcash' WHERE id='{$_COOKIE['id']}'");
		
		if (mysql_num_rows($searched) == 0) {
		echo ("<div id=\"ltable\"><center>Your spies went out and searched, but found no other spies currently that were hunting for you.<br />
		Try and be more sure next time you hire someone. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} else {
		$chance = rand(1,100);
		if ($chance >= 1 AND $chance <= 20) {
		$query = mysql_query("DELETE FROM spies WHERE target='$u' AND hunter='$hunter'");
		
		echo ("<div id=\"ltable\"><center>Your spies were able to infiltrate the agency, and killed the spy who was assigned to kill you.<br />
		He was also able to find that $hunter had been the one to assign the spies to kill you. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} elseif ($chance > 20 AND $chance <= 100) {
		echo ("<div id=\"ltable\"><center>Your spies attempted to kill the spies currently tracking you, but they were able to track and kill him first.<br />
		The enemy spies remain hot on your trail. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		}
		
		} elseif ($dd == '3'){
		$searched = mysql_query("SELECT * FROM spies WHERE target='$u' LIMIT 1");
		$row = mysql_fetch_array ($searched);
		$hunter = $row['hunter'];
		$price = 16000000;
		
		if ($price > $m) {
		echo ("<div id=\"ltable\"><center>You do not have enough money to pay the Counterspies. <br /> <a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		$newcash = ($m - $price);
		$result = mysql_query("UPDATE Players SET money='$newcash' WHERE id='{$_COOKIE['id']}'");
		
		if (mysql_num_rows($searched) == 0) {
		echo ("<div id=\"ltable\"><center>Your spies went out and searched, but found no other spies currently that were hunting for you.<br />
		Try and be more sure next time you hire someone. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} else {
		$chance = rand(1,100);
		if ($chance >= 1 AND $chance <= 30) {
		$query = mysql_query("DELETE FROM spies WHERE target='$u' AND hunter='$hunter'");
		
		echo ("<div id=\"ltable\"><center>Your spies were able to infiltrate the agency, and killed the spy who was assigned to kill you.<br />
		He was also able to find that $hunter had been the one to assign the spies to kill you. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} elseif ($chance > 30 AND $chance <= 100) {
		echo ("<div id=\"ltable\"><center>Your spies attempted to kill the spies currently tracking you, but they were able to track and kill him first.<br />
		The enemy spies remain hot on your trail. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		}
		
		} elseif ($dd == '4'){
		$searched = mysql_query("SELECT * FROM spies WHERE target='$u' LIMIT 1");
		$row = mysql_fetch_array ($searched);
		$hunter = $row['hunter'];
		$price = 32000000;
		
		if ($price > $m) {
		echo ("<div id=\"ltable\"><center>You do not have enough money to pay the Counterspies. <br /> <a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
		}
		$newcash = ($m - $price);
		$result = mysql_query("UPDATE Players SET money='$newcash' WHERE id='{$_COOKIE['id']}'");
		
		if (mysql_num_rows($searched) == 0) {
		echo ("<div id=\"ltable\"><center>Your spies went out and searched, but found no other spies currently that were hunting for you.<br />
		Try and be more sure next time you hire someone. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} else {
		$chance = rand(1,100);
		if ($chance >= 1 AND $chance <= 50) {
		$query = mysql_query("DELETE FROM spies WHERE target='$u' AND hunter='$hunter'");
		
		echo ("<div id=\"ltable\"><center>Your spies were able to infiltrate the agency, and killed the spy who was assigned to kill you.<br />
		He was also able to find that $hunter had been the one to assign the spies to kill you. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		
		} elseif ($chance > 50 AND $chance <= 100) {
		echo ("<div id=\"ltable\"><center>Your spies attempted to kill the spies currently tracking you, but they were able to track and kill him first.<br />
		The enemy spies remain hot on your trail. You were charged &#36;".number_format($price).".<br />
		<a href=\"/counterspies.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		}
		}
		} else {
		echo ("<div id=\"ltable\"><center>There has been one or more errors!</center></div>");
		include("footer.php");
		}
?>