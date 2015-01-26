<?php
$title="Organized Robbery > Update Aircraft";
include("config.php");
include("header.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];

$sql = mysql_query("SELECT id FROM Robbery WHERE driver='$u' LIMIT 1;");
if (mysql_num_rows($sql) != 1) {
echo '<div id="crimestext" align="center">You need to be the Pilot in an Organized Robbery to access this page!<br /><a href="DOR.php">Go back.</a></div>';
include("footer.php");
exit();
} else {
if ($_REQUEST['update']) {
	$car = $_POST['radio'];
	if ($car == NULL) {
		echo '<div id="crimestext" align="center">You need to select an aircraft first.<br /><a href="DOR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	} else {
		$row=mysql_fetch_array(mysql_query("SELECT plane FROM hanger WHERE id='$car' AND username='$u' AND percent=100"));
		$namec = $row[0];
			if (mysql_num_rows($sql) < 1) {
				echo '<div id="crimestext" align="center">The aircraft that you chose was either not repaired or not yours!<br /><a href="DOR.php">Go back.</a></div>';
				include("footer.php");
				exit();
			} else {
				mysql_query("UPDATE Robbery SET Vehicle='$namec' WHERE driver='$u' LIMIT 1;");
				mysql_query("DELETE FROM hanger WHERE id='$car' AND username='$u' AND percent=100 LIMIT 1;");
				echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=DOR.php\"></head>
				      <div align=\"center\" id=\"crimestext\">Successfully added the $namec to the Organized Robbery. Redirecting...</div>";
				include("footer.php");
			}
	}	
} else {
echo '<div id="crimestext" align="center">Please go back and select an aircraft to use in the Organized Robbery!<br /><a href="DOR.php">Go back.</a></div>';
include("footer.php");
exit();
}
}
?>