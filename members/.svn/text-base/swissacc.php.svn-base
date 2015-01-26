<?php
$title="Swiss Bank > Your Account";
include_once("config.php");
include_once("header.php");
include_once("Countdown_he.php");
include_once("countdown_p.php");
checks();

$result = mysql_query("SELECT username, money, s_acc FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$username = $row[0];
$money = $row[1];
$sacc = $row[2];

if ($_POST['Anum']) {
$anum = $_POST['Anum'];
$pass = $_POST['Pass'];
$sql = mysql_query("SELECT * FROM swiss WHERE account='$anum'");
if (mysql_num_rows($sql) < 1) {
echo "<div id='crimestext' align='center'>The account number you gave does not exist, or the passcode is not correct!<br><a href='swiss.php'>Go Back</a></div>";
include("footer.php");
exit();
}
$sql=mysql_fetch_array($sql);
$passcode = $sql['pass'];
$bal = $sql['bal'];
$owner = $sql['username'];
if ($pass != $passcode) {
echo "<div id='crimestext' align='center'>The account number you gave does not exist, or the passcode is not correct!<br><a href='swiss.php'>Go Back</a></div>";
include("footer.php");
exit();
}
$sql = mysql_fetch_array(mysql_query("SELECT banned FROM Players WHERE username='$owner' LIMIT 1;"));
if ($sql['banned'] == 1) {
echo "<div id='crimestext' align='center'>The creator of this account was banned, and so the account was closed. The account will now delete itself.<br /><a href='swiss.php'>Go Back</a></div>";
include("footer.php");
mysql_query("DELETE * FROM `swiss` WHERE `username` = '$owner' LIMIT 1;");
exit();
}
echo "<div id='ltable' align='center'>Welcome $u, The balance in this account is $".number_format($bal)."<br>
<br><form action='inserts.php' method='POST'>Deposit: <input type=\"text\" name=\"deposit\" /><br>
<input type=\"submit\" name=\"submit\" value=\"Deposit!\" /><Br><br>
Take: <input type=\"text\" name=\"take\" /><br>
<input type=\"submit\" name=\"submit2\" value=\"Take!\" />
<input type='hidden' name='anum' value='$anum'></form></div>";
include("footer.php");
} else {
echo "<div id='crimestext' align='center'>You did not enter an account number!<a href='swiss.php'>Go Back</a></div>";
include("footer.php");
exit();
}
?>