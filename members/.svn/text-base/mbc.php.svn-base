<?php
include("config.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username, corps FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$c = addslashes($row[1]); $ecorp=$row[1];
$title="$ecorp > Money/Bullets/Tokens Management";
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

echo"<div id=\"crimestext\">
<table width=\"100%\">
<tr align=\"center\">
<td>
<form action=\"corpmoney.php\" method=\"post\"><table>
<tr align=\"center\"><td>Corp Money: $".number_format($money)."</td></tr>
<tr align=\"center\"><td>Insert/Take Money: <input name=\"money\" type=\"text\"></td></tr>
<tr align=\"center\"><td><input name=\"Moneys\" type=\"submit\" value=\"Deposit\"><input name=\"submit2\" type=\"submit\" value=\"Take\"></td></tr>
<tr align=\"center\"><td>Username: <input name=\"username\" type=\"text\"></td></tr>
<tr align=\"center\"><td><input name=\"submit3\" type=\"submit\" value=\"Transfer\"></td></tr>
<a href=\"cmlog.php\">Last 50 Transfers</a>
</table></form>
</td>
<td>
<form action=\"corpbullets.php\" method=\"post\"><table>
<tr align=\"center\"><td>Corp Bullets: ".number_format($b)."</td></tr>
<tr align=\"center\"><td>Insert/Take Bullets: <input name=\"bullets\" type=\"text\"></td></tr>
<tr align=\"center\"><td><input name=\"bulletss\" type=\"submit\" value=\"Deposit\"><input name=\"submit2\" type=\"submit\" value=\"Take\"></td></tr>
<tr align=\"center\"><td>Username: <input name=\"username\" type=\"text\"></td></tr>
<tr align=\"center\"><td><input name=\"submit3\" type=\"submit\" value=\"Transfer\"></td></tr>
<a href=\"cblog.php\">Last 50 Transfers</a>
</table></form>
</td>
<td>
<form action=\"corptokens.php\" method=\"post\"><table>
<tr align=\"center\"><td>Corp Tokens: ".number_format($t)."</td></tr>
<tr align=\"center\"><td>Insert/Take Tokens: <input name=\"tokens\" type=\"text\"></td></tr>
<tr align=\"center\"><td><input name=\"tokenss\" type=\"submit\" value=\"Deposit\"><input name=\"submit2\" type=\"submit\" value=\"Take\"></td></tr>
<tr align=\"center\"><td>Username: <input name=\"username\" type=\"text\"></td></tr>
<tr align=\"center\"><td><input name=\"submit3\" type=\"submit\" value=\"Transfer\"></td></tr>
<a href=\"ctlog.php\">Last 50 Transfers</a>
</table>
</form>
</td>
</tr>
</table></div>";
include("footer.php");
}
?>