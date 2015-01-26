<?php
$title="Organized Robbery > Update Hacking Tools";
include("config.php");
include("header.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];

$sql = mysql_query("SELECT id FROM Robbery WHERE leader='$u' LIMIT 1;");
if (mysql_num_rows($sql) != 1) {
echo '<div id="crimestext" align="center">You need to be the Hacker in an Organized Robbery to access this page!<br /><a href="OR.php">Go back.</a></div>';
include("footer.php");
exit();
} else {
if ($_REQUEST['update']) {
	$explode = $_POST['radio'];
	if ($explode == NULL) {
		echo '<div id="crimestext" align="center">You need to select a piece of equipment!<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	} else {
		if ($explode == 'Micro-cameras') {
			if ($money < 125000) {
				$result=1;
			} else { 
				$nm = $money - 125000;
			}
		} elseif ($explode == 'Proximity Detectors') {
			if ($money < 75000) {
				$result=1;
			} else { 
				$nm = $money - 75000;
			}
		} elseif ($explode == 'Drones') {
			if ($money < 35000) {
				$result=1;
			} else { 
				$nm = $money - 35000;
			}
		} elseif ($explode == 'Laptop') {
			if ($money < 15000) {
				$result=1;
			} else { 
				$nm = $money - 15000;
			}
			}
		if ($result == 1) {
			echo '<div id="crimestext" align="center">You don\'t have enough money for the equipment!<br /><a href="OR.php">Go back.</a></div>';
			include("footer.php");
			exit();
		}
		mysql_query("UPDATE Robbery SET hack='$explode' WHERE leader='$u' LIMIT 1;");
		mysql_query("UPDATE Players SET money='$nm' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=OR.php\"></head>
			  <div align=\"center\" id=\"crimestext\">Successfully bought enough $explode for the Robbery. Redirecting...</div>";
		include("footer.php");
	}
		
		
} else {
echo '<div id="crimestext" align="center">Please go back and select a piece of equipment to use in the Organized Robbery!<br /><a href="OR.php">Go back.</a></div>';
include("footer.php");
exit();
}
}
?>