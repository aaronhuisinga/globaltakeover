<?
$title="Outgoing Escrows";
include("config.php");
include("header.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u=$row[0];

echo "<div id=\"ltable\" align=\"center\"><h1>Outgoing Escrows</h1><br />";
$sql1=mysql_query("SELECT * FROM tescrow WHERE finished ='Pending' AND username='$u'");
$sql2=mysql_query("SELECT * FROM bescrow WHERE finished ='Pending' AND username='$u'");
if (mysql_num_rows($sql1) > 0) {
echo "<h1>Pending Token Transfers</h1><table id=\"usertable\"><tr class='top'><td>Username</td><td>Amount</td><td>Money</td><td>Bullets</td><td>Cancel</td></tr>";
while ($row = mysql_fetch_array($sql1)) {
$id = $row['id']; $other = $row['other']; $money = $row['money']; $bullets = $row['bullets']; $tokens = $row['amount'];
echo "<tr><td>$other</td><td>".number_format($tokens)."</td><td>$".number_format($money)."</td><td>".number_format($bullets)."</td><td><a href='cancelt.php?id=$id'>Cancel</a></td></tr>";
}
echo "</table><br />";
}
if (mysql_num_rows($sql2) > 0) {
echo "<h1>Pending Bullet Transfers</h1><table id=\"usertable\"><tr class='top'><td>Username</td><td>Amount</td><td>Money</td><td>Tokens</td><td>Cancel</td></tr>";
while ($row = mysql_fetch_array($sql2)) {
$id = $row['id']; $other = $row['other']; $money = $row['money']; $tokens = $row['tokens']; $bullets = $row['amount'];
echo "<tr><td>$other</td><td>".number_format($bullets)."</td><td>$".number_format($money)."</td><td>".number_format($tokens)."</td><td><a href='cancelbu.php?id=$id'>Cancel</a></td></tr>";
}
echo "</table><br />";
}

echo '<form method="post" action="send_tokens.php">
  <h1>Send Tokens</h1>
  <table>
    <tr><td align="right">Username:</td> <td><input type="text" name="uname" /></td></tr>
	<tr><td align="right">Amount:</td> <td><input type="text" name="ca" /></td></tr>
	<tr><td align="right">Money:</td> <td><input type="text" name="money" /></td></tr>
	<tr><td align="right">Bullets:</td> <td><input type="text" name="bullets" /></td></tr>
  </table>
	<p><input type="submit" name="submit" value="Send!" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>';

echo '<form method="post" action="send_bullets.php">
  <h1>Send Bullets</h1>
  <table>
    <tr><td align="right">Username:</td> <td><input type="text" name="uname" /></td></tr>
	<tr><td align="right">Amount:</td> <td><input type="text" name="ca" /></td></tr>
	<tr><td align="right">Money:</td> <td><input type="text" name="money" /></td></tr>
	<tr><td align="right">Tokens:</td> <td><input type="text" name="tokens" /></td></tr>
  </table>
	<p><input type="submit" name="submit" value="Send!" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>';
echo "</div>";
include("footer.php");
?>