<?php 
include("config.php");
include("countdown_p.php");
include("Countdown_m.php");

$row=mysql_fetch_array(mysql_query("SELECT username, money, location FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];
$l=$row[2];
$title="$l Bank > Withdraw Money";
include("header.php");
include("Countdown_he.php");
	
if ($_POST['submit']){
$row=mysql_fetch_array(mysql_query("SELECT amount FROM banking WHERE username='$u' LIMIT 1;"));
$amount = $row[0];
$percent = ($amount * .10);
$namount = ($amount - $percent);
$upmoney = ($money + $namount);
mysql_query("UPDATE Players SET money = $upmoney WHERE id='{$_COOKIE['id']}' LIMIT 1;");
mysql_query("DELETE FROM banking WHERE username='$u' LIMIT 1;");

echo ("<div id=\"crimestext\" align=\"center\">You removed &#36;".number_format($amount)." from the bank early. There was a &#36;".number_format($percent)." fee.<br />
&#36;".number_format($namount)." has been added to your account.<br />
<a href=\"bank.php\">Go back.</a></div>");
include("footer.php");
}
?>