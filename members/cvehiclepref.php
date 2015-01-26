<?php
include("config.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username, corps FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$c = $row[1];
$title="$c > Manage Vehicle Preferences";
include("header.php");

$sql = mysql_query("SELECT owner, co, money, bullets, tokens FROM Corps WHERE name='$c' LIMIT 1;");
$row = mysql_fetch_array($sql);
$own = $row[0];
$co = $row[1];
$money = $row[2];
$b = $row[3];
$t = $row[4];

if ($u != $own AND $u != $co) {
	echo "<div align=\"center\" id=\"crimestext\">You are not in charge of controlling this Corp!</div>";
	include("footer.php");
	exit();
} else {

if ($_REQUEST['Submit']) {

$a = $_POST['option'];
if($a == NULL){
	echo"<div align=\"center\" id='crimestext'>You must select an option!<br /><a href=\"corps.php\">Go back</a></div>";
	include("footer.php");
	exit();
}

if ($a == 0) {
$query = mysql_query("UPDATE Corps SET vehicles='0' WHERE name='$c' LIMIT 1;");

echo ("<div id=\"crimestext\"><center>Only Leader/Coleader can now remove vehicles from the Corp.<br />
<a href=\"corps.php\">Go back.</a></center></div>");
include("footer.php");
exit();

} elseif ($a == 1) {
$query = mysql_query("UPDATE Corps SET vehicles='1' WHERE name='$c' LIMIT 1;");

echo ("<div id=\"crimestext\"><center>Full structure can now remove vehicles from the Corp.<br />
<a href=\"corps.php\">Go back.</a></center></div>");
include("footer.php");
exit();

} elseif ($a == 2) {
$query = mysql_query("UPDATE Corps SET vehicles='2' WHERE name='$c' LIMIT 1;");

echo ("<div id=\"crimestext\"><center>All Corp members can now remove vehicles from the Corp.<br />
<a href=\"corps.php\">Go back.</a></center></div>");
include("footer.php");
exit();
}
} else {
?>
<div id="ltable" align="center">
<table>
<tr>
<td>
<h2 align="center">Corp Vehicle Preferences</h2>
<form action="" method="post">
<input type="radio" name="option" value="0" /> Only Leader/Coleader can remove vehicles from Corp.
<br />
<input type="radio" name="option" value="1" /> Full structure can remove vehicles from Corp.
<br />
<input type="radio" name="option" value="2" /> All Corp members can remove vehicles from Corp.
<br />
<center><input type="submit" name="Submit" value="Do It!" />
<input type="hidden" name="Submitted" value="TRUE" />
</form>
</td>
</tr>
</table>
</div>
<?
include("footer.php");
}
}
?>