<?php
ob_start(); 
include("config.php");
include("Online.php");
include("Banned.php");

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
	$query = "SELECT health, username FROM Players WHERE id='$id'";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$h = $row['health'];
	$username = $row['username'];
	
	if ($h == 0) {
	 	$url .= '/dead.html';
		header("Location: $url");
		
	} else {
	
$query = "SELECT theme FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$theme = $row[0];

if ($theme != NULL) {

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />");

} else {
$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />");

$theme = 'style';
}
	
?>

<html>
<center>
<div id="usertable">
<h1>Last 50 Token Transfers</h1>
<table width=50%><tr>
<tr><td colspan="3" align="center" class="top"><b>Outgoing Transfers</b></tr>
<td align=center width=33%>To</td>
<td align=center width=33%>Amount</td>
<td align=center width=33%>Date</td>
</tr>
<?
	$gather=mysql_query("SELECT * FROM ttransfers WHERE wfrom='$username' ORDER BY date DESC LIMIT 50;"); 
	while ($row=mysql_fetch_array($gather)){
	$id=stripslashes($row['id']);
	$to=stripslashes($row['wto']);
	$outamt=stripslashes($row['amount']);
	$outdate=stripslashes($row['date']);
	
	$query = "SELECT id FROM Players WHERE username='$to' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$toid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$toid}\">$to</a></b></td> <td align=\"center\">".number_format($outamt)."</td> <td align=\"center\">$outdate</td></tr>");
}
echo ("</table>");
?>
<br />
<table width=50%><tr>
<tr><td colspan="3" align="center" class="top"><b>Incoming Transfers</b></tr>
<td align=center width=33%>From</td>
<td align=center width=33%>Amount</td>
<td align=center width=33%>Date</td>
</tr>
<?
$gather=mysql_query("SELECT * FROM ttransfers WHERE wto='$username' ORDER BY date DESC LIMIT 50;"); 
	while ($row=mysql_fetch_array($gather)){
	$id=stripslashes($row['id']);
	$wfrom=stripslashes($row['wfrom']);
	$inamt=stripslashes($row['amount']);
	$indate=stripslashes($row['date']);
	
	$query = "SELECT id FROM Players WHERE username='$wfrom' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$fromid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$fromid}\">$wfrom</a></b></td> <td align=\"center\">".number_format($inamt)."</td> <td align=\"center\">$indate</td></tr>");
}
echo ("</table");
}
}
?>