<?php
$title="Money Transfer Log";
include("config.php");
include("header.php");
checks();
online();

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
	$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='$id' LIMIT 1;"));
	$username = $row['username'];

if ($_COOKIE['id'] != $id) {
echo "<div id='crimestext' align='center'>You can only view your own transfer logs!<br /><a href='bank.php'>Go Back</a></div>";
include("footer.php");
exit();
}
?>
<div id="ltable" align="center">
<h1>Last 50 Transfers</h1>
<table width=50% id="usertable"><tr>
<tr><td colspan="3" align="center" class="top"><b>Outgoing Transfers</b></tr>
<td align=center width=33%>To</td>
<td align=center width=33%>Amount</td>
<td align=center width=33%>Date</td>
</tr>
<?
	$gather=mysql_query("SELECT * FROM transfers WHERE wfrom='$username' ORDER BY date DESC LIMIT 50;"); 
	while ($row=mysql_fetch_array($gather)){
	$id=stripslashes($row['id']);
	$to=stripslashes($row['wto']);
	$outamt=stripslashes($row['amount']);
	$outdate=stripslashes($row['date']);
	
	$query = "SELECT id FROM Players WHERE username='$to' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$toid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$toid}\">$to</a></b></td> <td align=\"center\">&#36;".number_format($outamt)."</td> <td align=\"center\">$outdate</td></tr>");
}
echo ("</table>");
?>
<br />
<table width=50% id="usertable"><tr>
<tr><td colspan="3" align="center" class="top"><b>Incoming Transfers</b></tr>
<td align=center width=33%>From</td>
<td align=center width=33%>Amount</td>
<td align=center width=33%>Date</td>
</tr>
<?
$gather=mysql_query("SELECT * FROM transfers WHERE wto='$username' ORDER BY date DESC LIMIT 50;"); 
	while ($row=mysql_fetch_array($gather)){
	$id=stripslashes($row['id']);
	$wfrom=stripslashes($row['wfrom']);
	$inamt=stripslashes($row['amount']);
	$indate=stripslashes($row['date']);
	
	$query = "SELECT id FROM Players WHERE username='$wfrom' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$fromid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$fromid}\">$wfrom</a></b></td> <td align=\"center\">&#36;".number_format($inamt)."</td> <td align=\"center\">$indate</td></tr>");
}
echo ("</table></div>");
include("footer.php");
}
?>