<?php
ob_start(); 
include("config.php");
include("Online.php");
include("Banned.php");

$result = mysql_query("SELECT health, username, corps, theme FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);

$h = $row['health'];
$username = $row['username'];
$c = $row['corps'];

$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;
	
$sql = mysql_query("SELECT owner, co FROM Corps WHERE name='$c'");
$row = mysql_fetch_array($sql);
$own = $row[0];
$co = $row[1];

if ($username != $own AND $username != $co) {
	echo "<div align=\"center\" id=\"crimestext\">You are not in charge of controlling this Corp!</div>";
	exit();
} else {
	
?>
<center>
<div id="usertable">
<h1>Recent Bullet Transactions</h1>
<table width=50%><tr>
<tr><td colspan="3" align="center" class="top"><b>Outgoing Transfers</b></tr>
<td align=center width=33%>To</td>
<td align=center width=33%>Amount</td>
<td align=center width=33%>Date</td>
</tr>
<?
	$gather=mysql_query("SELECT * FROM clogs WHERE corp='$c' AND type='bullet' AND outin='out' ORDER BY date DESC LIMIT 50;"); 
	while ($row=mysql_fetch_array($gather)){
	$id=stripslashes($row['id']);
	$to=stripslashes($row['tofrom']);
	$outamt=stripslashes($row['amount']);
	$outdate=stripslashes($row['date']);
	
	$result = mysql_query("SELECT id FROM Players WHERE username='$to' LIMIT 1;");
	$row = mysql_fetch_assoc($result);

	$toid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$toid}\">$to</a></b></td> <td align=\"center\">".number_format($outamt)."</td> <td align=\"center\">$outdate</td></tr>");
}
echo ("</table>");
?>
<br />
<table width=50%><tr>
<tr><td colspan="3" align="center" class="top"><b>Incoming Donations</b></tr>
<td align=center width=33%>From</td>
<td align=center width=33%>Amount</td>
<td align=center width=33%>Date</td>
</tr>
<?
$gather=mysql_query("SELECT * FROM clogs WHERE corp='$c' AND type='bullet' AND outin='in' ORDER BY date DESC LIMIT 50;"); 
	while ($row=mysql_fetch_array($gather)){
	$id=stripslashes($row['id']);
	$wfrom=stripslashes($row['tofrom']);
	$inamt=stripslashes($row['amount']);
	$indate=stripslashes($row['date']);
	
	$result = mysql_query("SELECT id FROM Players WHERE username='$wfrom' LIMIT 1;");
	$row = mysql_fetch_assoc($result);

	$fromid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$fromid}\">$wfrom</a></b></td> <td align=\"center\">".number_format($inamt)."</td> <td align=\"center\">$indate</td></tr>");
}
echo ("</table");
}
?>