<?php
ob_start(); 
include("config.php");
checks();

$result = mysql_query("SELECT Level FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$lvl = $row[0];
				
		if ($lvl == 2) {
		if($_POST['s'] && (strlen($_POST['name']) > 0)) {
		$nname = $_POST['name'];
		$c = $_POST['corp'];
		mysql_query("UPDATE `Corps` SET `name`='$nname' WHERE name='$c'");
		mysql_query("UPDATE `Players` SET `corps`='$nname' WHERE corps='$c'");
		mysql_query("UPDATE `Players` SET `money`='$newmoney' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		mysql_query("UPDATE `cthread` SET `corp`='$nname' WHERE corp='$c'");
		mysql_query("UPDATE `cgarage` SET `corp`='$nname' WHERE corp='$c'");
		mysql_query("UPDATE `changer` SET `corp`='$nname' WHERE corp='$c'");
		mysql_query("UPDATE `cdock` SET `corp`='$nname' WHERE corp='$c'");
		mysql_query("UPDATE recruit SET corpname='$nname' WHERE corpname='$c'");
		mysql_query("UPDATE invite SET corp='$nname' WHERE corp='$c'");
		mysql_query("DELETE * FROM `clogs` WHERE corp='$c'");
		echo("<div id=\"gameplay\"><center><b>The corp was renamed to $nname.</b></center></div>");
		exit();
		}
		echo("<center><div id=\"gameplay\"><h1>Change Corp Name</h1>");
		echo("<form name='f' action='corpname.php' method='POST'>
		Corp To Rename: <input type='text' name='corp'><br />
		New Corp Name: <input type='text' name='name'><br />
		<input type='submit' name='s' value='Submit'></form></div>");
} else {
echo ("<div id=\"gameplay\"><center>You do not have sufficient privilages to access this page.</center></div>");
}
?>