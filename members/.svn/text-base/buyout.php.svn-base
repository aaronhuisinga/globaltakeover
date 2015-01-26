<?php
$title="Most Wanted > Buy Out";
include("config.php");
include("header.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT money, tokens, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$m = $row['money'];
$tokens = $row['tokens'];
$u = $row['username'];
	
$row=mysql_fetch_array(mysql_query("SELECT * FROM mw WHERE id='$id' LIMIT 1;")); 
$p=$row['price'];
$w=$row['who'];
$t=$row['tokens'];
$tok = $t/2;
$newmoney = ($m - $p);
$newtoken = $tokens - $tok;
if ($p > $m) {
echo ("<div id=\"crimestext\"><center>You do not have enough money to buy $w off of the Most Wanted list. <br /> <a href=\"mostwanted.php\">Go back.</a></center></div>");
exit();
} else {
if ($tokens < $tok) {
echo ("<div id=\"crimestext\"><center>You do not have enough tokens to buy $w off of the Most Wanted list. <br /> <a href=\"mostwanted.php\">Go back.</a></center></div>");
exit();
}
mysql_query("UPDATE Players SET money='$newmoney', tokens='$newtoken' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
mysql_query("DELETE FROM mw WHERE id='$id' LIMIT 1;");
mysql_query("INSERT INTO Playertoken (amount, date, username, outcome, btime, used) VALUES ('$tok', '$date', '$u', 'Loss', '$current', 'Mw Buyout')");
echo ("<div id=\"crimestext\"><center>You bought $w off of the Most Wanted list for $".number_format($p)." and ".number_format($tok)." Tokens! <br /> <a href=\"mostwanted.php\">Go back.</a></center></div>");
}
?>