<?php
$title="Organized Robbery > Update Vessel";
include("config.php");
include("header.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];

$sql = mysql_query("SELECT id FROM Robbery WHERE driver='$u' LIMIT 1;");
if (mysql_num_rows($sql) != 1) {
echo '<div id="crimestext" align="center">You need to be the Captain in an Organized Robbery to access this page!<br /><a href="SOR.php">Go back.</a></div>';
include("footer.php");
exit();
} else {
if ($_REQUEST['update']) {
	$car = $_POST['radio'];
	if ($car == NULL) {
		echo '<div id="crimestext" align="center">You need to select a vessel first.<br /><a href="SOR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	} else {
		$row=mysql_fetch_array(mysql_query("SELECT boat FROM dock WHERE id='$car' AND username='$u' AND percent=100"));
		$namec = $row[0];
			if (mysql_num_rows($sql) < 1) {
				echo '<div id="crimestext" align="center">The vessel you chose was either not repaired or not yours!<br /><a href="SOR.php">Go back.</a></div>';
				include("footer.php");
				exit();
			} else {
				mysql_query("UPDATE Robbery SET Vehicle='$namec' WHERE driver='$u' LIMIT 1;");
				mysql_query("DELETE FROM dock WHERE id='$car' AND username='$u' AND percent=100 LIMIT 1;");
				echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=SOR.php\"></head>
				      <div align=\"center\" id=\"crimestext\">Successfully added the $namec to the Organized Robbery. Redirecting...</div>";
				include("footer.php");
			}
	}	
} else {
echo '<div id="crimestext" align="center">Please go back and select a vessel to use in the Organized Robbery!<br /><a href="SOR.php">Go back.</a></div>';
include("footer.php");
exit();
}
}
?>