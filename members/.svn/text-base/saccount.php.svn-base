<?php
$title="Swiss Bank > Open Account";
include_once("config.php");
include_once("header.php");
include_once("Countdown_he.php");
include_once("countdown_p.php");

$query = mysql_query("SELECT username, money, s_acc FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($query);
$username = $row[0];
$money = $row[1];
$sacc = $row[2];
$f_ip = $_SERVER['REMOTE_ADDR'];

if ($_REQUEST['Buy']) {
if ($money < 2000000) {
echo '<div id="crimestext" align="center">You have not got enough money to open an account!<br><a href="swiss.php">Go Back</a><div>';
include("footer.php");
exit();
}
if ($sacc == 1) {
echo '<div id="crimestext" align="center">You have already made a Swiss Account. You can\'t own two!<br><a href="swiss.php">Go Back</a><div>';
include("footer.php");
exit();
}
$nmoney = $money - 2000000;
$a = rand(1000000, 9999999);
$query = mysql_fetch_array(mysql_query("SELECT account FROM swiss ORDER BY account DESC LIMIT 1;"));
$accn = $query[0];
$nacc = $accn + 1;
$sql = mysql_query("SELECT * FROM swiss WHERE account='$nacc'");
while (mysql_num_rows($sql) == 1) {
$nacc = $nacc + 1;
$sql = mysql_query("SELECT * FROM swiss WHERE account='$nacc'");
}
$query = mysql_query("UPDATE Players SET s_acc = 1, money = '$nmoney' WHERE username ='$username' LIMIT 1");
$sql = mysql_query("INSERT INTO swiss (username, account, pass, ip) VALUES ('$username', '$nacc', '$a', '$f_ip')");
echo "<div id='crimestext' align='center'>You have opened a Swiss Banking account. Your account number is: $nacc<br> Your passcode is: $a<br><a href=\"swiss.php\">Go Back</a></div>";
include("footer.php");
} elseif($_REQUEST['Recover']) {
echo "<div id=\"crimestext\" align=\"center\">Welcome $u<br><Br>";
echo '<table><tr><td><form action="swissacc.php" method="POST">Account Number:</td><td><input type="text" name="Anum"></td></tr><tr><td>Passcode: </td><td><input type="text" name="Pass"></td></tr></table><br><input type="submit" name="submit" value="Submit!"></form></div>';
include("footer.php");	
}
?>