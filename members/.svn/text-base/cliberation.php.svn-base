<?php
$title="Corp Liberation";
include("config.php");
include("header.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT corps, username, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$c = $row[0];
$user = $row[1];
$pb = $row[2];

session_start();
if( isset($_POST['submit'])) {
   if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
	$type = 1;	
	unset($_SESSION['security_code']);
   	} else {
	echo ("<div id='crimestext'><center>The words you entered into the Script Check were incorrect. Please try again. <br /> <a href=\"cliberation.php\">Go back</a></center></div>");
	include("footer.php");
    exit();
   	}
$corpn = $_POST['Corp'];
$newname = $_POST['newname'];
if ($corpn == NULL) {
echo "<div id='crimestext' align='center'>Please select one of the options!<br /><a href='cliberation.php'>Go Back</a></div>";
include("footer.php");
exit();
}
if ($newname == NULL) {
echo "<div id='crimestext' align='center'>Please enter a new Corp name!<br /><a href='cliberation.php'>Go Back</a></div>";
include("footer.php");
exit();
}
$sql = mysql_query("SELECT * FROM Corps WHERE name='$corpn'");
if (mysql_num_rows($sql) == 0) {
echo "<div id='crimestext' align='center'>Please select a correct Corp!<br /><a href='cliberation.php'>Go Back</a></div>";
include("footer.php");
exit();
}
$sql1 = mysql_query("SELECT * FROM Corps WHERE name='$newname'");
if (mysql_num_rows($sql1) > 0) {
echo "<div id='crimestext' align='center'>Please select a Corp name not in use!<br /><a href='cliberation.php'>Go Back</a></div>";
include("footer.php");
exit();
}
if ($pb < 10000000) {
echo "<div id='crimestext' align='center'>You do not have enough money!<br /><a href='cliberation.php'>Go Back</a></div>";
include("footer.php");
exit();
}
$row = mysql_fetch_array($sql);
$lead = $row['owner'];
$co = $row['co'];
$rl = $row['rightl'];
$ll = $rpw['leftl'];
$hlead = mysql_query("SELECT * FROM Players WHERE username='$lead' AND health='0'");
$hco = mysql_query("SELECT * FROM Players WHERE username='$co' AND health='0' OR banned='1'");
$hrl = mysql_query("SELECT * FROM Players WHERE username='$rl' AND health='0' OR banned='1'");
$hll = mysql_query("SELECT * FROM Players WHERE username='$ll' AND health='0' OR banned='1'");
if ((mysql_num_rows($hlead) > 0) AND (mysql_num_rows($hco) > 0) AND (mysql_num_rows($hrl) > 0) AND (mysql_num_rows($hll) > 0)) {
$query = mysql_query("SELECT * FROM Corps WHERE owner='$user' OR co='$user' OR rightl='$user' OR leftl='$user' OR leftro='$user' OR rightro='$user'");
if (mysql_num_rows($query) > 0) {
echo "<div id='crimestext' align='center'>You already are a structure member of a Corp, and cannot abondon them now!<br /><a href='cliberation.php'>Go Back</a></div>";
include("footer.php");
exit();
}
mysql_query("UPDATE `Corps` SET `name`='$newname', owner='$user', co='None', rightl='None', leftl='None', leftro='None', rightro='None' WHERE name='$corpn' LIMIT 1;");
mysql_query("UPDATE `Players` SET `corps`='$newname' WHERE corps='$corpn'");
mysql_query("UPDATE `Players` SET `corps`='$newname' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
mysql_query("UPDATE `cthread` SET `corp`='$newname' WHERE corp='$corpn'");
mysql_query("UPDATE `cgarage` SET `corp`='$newname' WHERE corp='$corpn'");
mysql_query("UPDATE `changer` SET `corp`='$newname' WHERE corp='$corpn'");
mysql_query("UPDATE `cdock` SET `corp`='$newname' WHERE corp='$corpn'");
mysql_query("UPDATE recruit SET corpname='$newname' WHERE corpname='$corpn'");
mysql_query("UPDATE invite SET corp='$newname' WHERE corp='$corpn'");
mysql_query("DELETE * FROM `clogs` WHERE corp='$newname'");
mysql_query("UPDATE Players SET money=(money-10000000) WHERE username='$user' LIMIT 1;");
echo "<div id='crimestext' align='center'>You have manged to take ownership of $corpn!<br /><a href='cliberation.php'>Go Back</a></div>";
include("footer.php");
exit();
} else {
echo "<div id='crimestext' align='center'>One or more structure members are alive!<br /><a href='cliberation.php'>Go Back</a></div>";
include("footer.php");
exit();
}
} else {
echo "<div id='ltable' align='center'>
<h2>Corp Liberation</h2><br />
This is where you hire some thugs to give you a hand in liberating a Corp from your enemies.<br /> Just select the Corp, pay the price ($10,000,000), and consider it yours.<br />
<b>Note: The Top 4 Structure Members Must Be Dead.</b>
<br /><br />";
$sql = mysql_query("SELECT name FROM Corps WHERE id > 1");
echo "<form action='' method='POST'><table>";
while ($row = mysql_fetch_array($sql)) {
$corpn = $row['name'];
echo "<tr><td>$corpn<td></td><td><input name='Corp' type='radio' value='$corpn'></td></td>";
}
echo "</table><br />";
echo '<table><tr><td colspan="2" align="center"><img src="CaptchaSecurityImages.php?width=100&height=40&characters=3" /></td></tr>
	<tr><td align="right"><label for="security_code">Enter the code:</label></td> <td><input id="security_code" name="security_code" type="text" /></td></tr></table>';
echo"<br />Corp Name: <input type='textbox' name='newname'><br /><br /><input type='submit' name='submit' value='Liberate!'></form></div>";
include("footer.php");
}
?>