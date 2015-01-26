<?php
$title="Most Wanted";
include("config.php");
include("header.php");
include("Countdown_he.php");
checks();
online();

?>
<div id="ltable" align="center">
<h1 align="center">Most Wanted</h1>
<table id="usertable">
  <tr class="top">
    <td><b>Target</b></td>
    <td><b>Rewarder</b></td>
    <td><b>Price</b></td>
    <td><b>Tokens</b></td>
    <td><b>Reason</b></td>
    <td><b>Buy Out</b></td> 
  </tr>
<?
$gather=mysql_query("SELECT * FROM mw ORDER BY id ASC"); 
while ($row=mysql_fetch_array($gather)){
$w=$row['who'];
$u=stripslashes($row['user']);
$p=stripslashes($row['price']);
$r=stripslashes($row['reason']);
$t = $row['tokens'];
$wid=$row['id'];
$who=mysql_fetch_assoc(mysql_query("SELECT id FROM Players WHERE username='$w' LIMIT 1;"));
$by=mysql_fetch_assoc(mysql_query("SELECT id FROM Players WHERE username='$u' LIMIT 1;"));
?>		
  <tr>
	<td><? echo "<a target=\"main\" href=\"/members/profile.php?id={$who['id']}\">$w</a>"; ?></td>
	<td><? if ($u != 'Anonymous') {
echo "<a target=\"main\" href=\"/members/profile.php?id={$by['id']}\">$u</a>";
} elseif ($u == Anonymous){
	echo"$u";
} ?></td>
	<td><? echo "&#36;".number_format($p).""; ?></td>
	<td><? echo "".number_format($t).""; ?></td>
	<td><? echo "$r"; ?></td>
	<td><? echo "<a target=\"main\" href=\"/members/buyout.php?id={$wid}\">Buy Out</a>"; ?>
  </tr>	
<?
}
?>
</table>
<br />
<p>There is a $100,000 fee to add a user to the Most Wanted list.<br />
There is a $50,000 fee to make yourself Anonymous.</p>
<form action="mw.php" method="post">
<table>
	<tr><td align="right">Their Username: </td><td><input type="text" name="tu" size="23" maxlength="20"></td></tr>
	<tr><td align="right">Anonymous: </td><td><input type="checkbox" name="checkbox" value="checkbox"></td></tr>
	<tr><td align="right">Money Bounty: </td><td><input type="text" name="b" size="23" maxlength="200"></td></tr>
	<tr><td align="right">Token Bounty: </td><td><input type="text" name="t" size="23" maxlength="200"></td></tr>
	<tr><td align="right">Reason: </td><td><textarea name="r" size="25" rows="2"></textarea></td></tr>
	<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Add!"></td></tr>
</table>
<input type="hidden" name="submitted" value="TRUE" />
</form></div>
<? include("footer.php"); ?>