<?php
$title="Organized Robbery > Update Explosives";
include("config.php");
include("header.php");
checks();
 
$row=mysql_fetch_array(mysql_query("SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];

$sql = mysql_query("SELECT id FROM Robbery WHERE ee='$u' LIMIT 1;");
if (mysql_num_rows($sql) != 1) {
echo '<div id="crimestext" align="center">You need to be the Explosives Expert in an Organized Robbery to access this page!<br /><a href="SOR.php">Go back.</a></div>';
include("footer.php");
exit();
} else {
if ($_REQUEST['update']) {
	$explode = $_POST['radio'];
	if ($explode == NULL) {
		echo '<div id="crimestext" align="center">You need to select an explosive!<br /><a href="SOR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	} else {
		if ($explode == 'Symtex') {
			if ($money < 250000) {
				$result=1;
			} else {
				$nm= $money - 250000;
			}
		} elseif ($explode == 'C4') {
			if ($money < 200000) {
				$result=1;
			} else { 
				$nm = $money - 200000;
			}
		} elseif ($explode == 'Claymore Mines') {
			if ($money < 150000) {
				$result=1;
			} else { 
				$nm = $money - 150000;
			}
		} elseif ($explode == 'Plastic Explosives') {
			if ($money < 100000) {
				$result=1;
			} else { 
				$nm = $money - 100000;
			}
		}
	if ($result == 1) {
		echo '<div id="crimestext" align="center">You don\'t have enough money for this Explosive!<br /><a href="SOR.php">Go back.</a></div>';
		exit();
	}
		mysql_query("UPDATE Robbery SET explosive='$explode' WHERE ee='$u' LIMIT 1;");
		mysql_query("UPDATE Players SET money='$nm' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=SOR.php\"></head>
			  <div align=\"center\" id=\"crimestext\">Successfully bought enough $explode for the Robbery. Redirecting...</div>";
		include("footer.php");
	}
} else {
echo '<div id="crimestext" align="center">Please go back and select an Explosive to use in the Organized Robbery!<br /><a href="SOR.php">Go back.</a></div>';
include("footer.php");
}
}
?>