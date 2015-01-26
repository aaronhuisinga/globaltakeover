<?php
$title="Organized Robbery > Update Artillery";
include("config.php");
include("header.php");
checks();
 
$row=mysql_fetch_array(mysql_query("SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];

$sql = mysql_query("SELECT id FROM Robbery WHERE ee='$u' LIMIT 1;");
if (mysql_num_rows($sql) != 1) {
echo '<div id="crimestext" align="center">You need to be the Artillery in an Organized Robbery to access this page!<br /><a href="OR.php">Go back.</a></div>';
include("footer.php");
exit();
} else {
if ($_REQUEST['update']) {
	$explode = $_POST['radio'];
	if ($explode == NULL) {
		echo '<div id="crimestext" align="center">You need to select a type of artillery!<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	} else {
		if ($explode == 'RH-202 Anti-Aircraft Gun') {
			if ($money < 250000) {
				$result=1;
			} else {
				$nm= $money - 250000;
			}
		} elseif ($explode == 'MLRS M270 12x227mm Multiple Rocket Launcher') {
			if ($money < 200000) {
				$result=1;
			} else { 
				$nm = $money - 200000;
			}
		} elseif ($explode == 'M53/59 Self-Propelled Twin 30mm Cannon') {
			if ($money < 150000) {
				$result=1;
			} else { 
				$nm = $money - 150000;
			}
		} elseif ($explode == 'PLZ-45 Self-Propelled 155mm Howitzer') {
			if ($money < 100000) {
				$result=1;
			} else { 
				$nm = $money - 100000;
			}
		}
	if ($result == 1) {
		echo '<div id="crimestext" align="center">You don\'t have enough money for this artillery!<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	}
		mysql_query("UPDATE Robbery SET explosive='$explode' WHERE ee='$u' LIMIT 1;");
		mysql_query("UPDATE Players SET money='$nm' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=OR.php\"></head>
			  <div align=\"center\" id=\"crimestext\">Successfully bought an $explode for the Robbery. Redirecting...</div>";
		include("footer.php");
	}
} else {
echo '<div id="crimestext" align="center">Please go back and select a type of artillery to use in the Organized Robbery!<br /><a href="OR.php">Go back.</a></div>';
include("footer.php");
}
}
?>