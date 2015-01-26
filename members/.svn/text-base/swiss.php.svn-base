<?
$title="Swiss Bank";
include("config.php");
include("header.php");
include("Countdown_he.php");
include("countdown_p.php");
include("Countdown_m.php");
checks();
online();

$result = mysql_query("SELECT username, money, location, id, s_acc FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$u = $row[0];
$money = $row[1];
$l = $row[2];
$uid = $row[3];
$s_acc = $row[4];

if ($s_acc == 0) {
echo "<div id=\"crimestext\" align=\"center\"> You do not currently own a swiss bank account. You can either buy one ($2,000,000) or recover an old one using a swiss password.";
echo '<br><form action="saccount.php" method="POST"><input type="submit" value="Buy!" name="Buy"><input type="submit" value="Recover!" name="Recover"></form></div>';
include("footer.php");
} elseif($s_acc == 1) {
echo "<div id=\"crimestext\" align=\"center\">Welcome $u<br />";
echo '<table><tr><td><form action="swissacc.php" method="POST">Account Number:</td><td><input type="text" name="Anum"></td></tr><tr><td>Passcode: </td><td><input type="text" name="Pass"></td></tr></table><br><input type="submit" name="submit" value="Submit!"></form>
<center><a href="swissrecover.php">Forgot your account information?</a></div>';
include("footer.php");	
}
?>