<?php
ob_start();
include_once("config.php");
include_once("Online.php");

$query = "SELECT theme FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$theme = $row[0];

if ($theme != NULL) {

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />");

} else {
$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />");

$theme = 'style';
}

$sql = mysql_query("SELECT Level FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array($sql);
$lvl = $row[0];
if ($lvl == 1 OR $lvl == 2) {

$sql = mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array($sql);
$user = $row[0];


echo('<div id="gameplay"><center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$d = (date("M d Y h:i:s A"));
$dur = $_POST['duration'];
$dure = $dur * 60;
$then = time();
$query = "UPDATE `Players` SET `fbdate` = '$d' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;";
$result = @mysql_query ($query);
mysql_query("UPDATE `Players` SET `fbanned` = '" . $_POST['l'] . "' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `fbanreason` = '" . $_POST['reason'] . "' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `fbantime` = '$dure' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `then` = '$then' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
echo("<b>The player was forum banned/unbanned.</b><br /><br />");
}
echo("<form name='f' action='fbans.php' method='POST'>
Username: <input type='text' name='u'><br>
Ban/Unban: <input type='radio' name='l' value='0' checked>Forum Unban
<input type='radio' name='l' value='1'>Forum Ban<br />
Reason: <input type='text' name='reason'><br />
Duration: <input type='text' name='duration'><br />
<input type='submit' name='s' value='Do it'></form><br><br>
<p>Duration is to be in Minutes!</p></div></center>");

} else {
echo('<div id=\"gameplay\"><center>');
echo("You do not have sufficient permissions to access this page.");
echo('</center></div>');
}
?>