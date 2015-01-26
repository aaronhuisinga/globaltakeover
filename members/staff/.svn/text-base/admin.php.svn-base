<?php
$title="Administrator Panel";
include_once("config.php");
include("../header.php");

$result = mysql_query("SELECT Level, username FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$lvl = $row[0];
$user = $row[1];
$ip = $_SERVER['REMOTE_ADDR'];

if ($lvl == 2) {
$act = $_GET['act'];
$u = $_POST['u'];
echo('<div id="gtinfo"><center>');

echo('<h1>Admin Panel</h1>');
echo("<br /><br /><b>Hello, $user.</b><br /> <a href='admin.php?act=money'>Money</a> | <a href='admin.php?act=tokens'>Tokens</a> | <a href='admin.php?act=prom'>Promote/Demote</a> | <a href='admin.php?act=ban'>Bans</a> | <a href='admin.php?act=status'>User Status</a> | <a href='admin.php?act=bullets'>Bullets</a> | <a href='admin.php?act=health'>Health</a> |<a href='admin.php?act=password'> Password</a> |<br />  <a href='dupecheck.php' target='main'>Dupe Check</a> | <a href='admin.php?act=hdo'>Help Desk Operator</a> | <a href='admin.php?act=msg'>View Messages</a> | <a href='admin.php?act=cmsg'>Clear Messages</a> | <a href='admin.php?act=trans'>Money Transfers</a> |<br />
<a href='admin.php?act=ttrans'>Token Transfers</a> | <a href='admin.php?act=gmtrans'>Global Market Transfers</a> | <a href='admin.php?act=findip'>Find by IP</a> | <a href='admin.php?act=appear'>Appear Offline</a> | <a href='admin.php?act=mtlogs'>Token Gain/Loss</a><br /><br />");
echo('</center>');
switch ($act) {

case "money":
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$give = $_POST['give'];
$take = $_POST['take'];
$total = ($give + $take);
$tacc = $_POST['u'];
mysql_query("UPDATE `Players` SET `money` = money+" . $_POST['give'] . " WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `money` = money-" . $_POST['take'] . " WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Money Addition', '$total', '$tacc')");
echo("<b>The player's money was updated.</b><br />");
}
echo("<form name='f' action='admin.php?act=money' method='POST'>
Username: &nbsp;&nbsp;&nbsp;<input type='text' name='u'><br>
Give money: <input type='text' name='give' value='0'><br>
Take money: <input type='text' name='take' value='0'><br><br>
<input type='submit' name='s' value='Do it'></form>");

   break;
case "tokens":
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$give = $_POST['give'];
$take = $_POST['take'];
$total = ($give + $take);
$tacc = $_POST['u'];
mysql_query("UPDATE `Players` SET `tokens` = tokens+" . $_POST['give'] . " WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `tokens` = tokens-" . $_POST['take'] . " WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Token Addition', '$total', '$tacc')");
echo("<b>The player's tokens were updated.</b><br><br>");
}
echo("<form name='f' action='admin.php?act=tokens' method='POST'>
Username: &nbsp;&nbsp;&nbsp;<input type='text' name='u'><br>
Give Tokens: <input type='text' name='give' value='0'><br>
Take Tokens: <input type='text' name='take' value='0'><br><br>
<input type='submit' name='s' value='Do it'></form>");

   break;

case "prom": // promote/demote
echo('<center>');
if ($_POST['l'] == 1) {
$pro = "Forum Promtion";
} elseif ($_POST['l'] == 2) {
$pro = "Admin Promtion";
} elseif ($_POST['l'] == 0) {
$pro = "Power Demotion";
}
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$tacc = $_POST['u'];
mysql_query("UPDATE `Players` SET `level` = '" . $_POST['l'] . "' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', '$pro', '', '$tacc')");
echo("<b>The player's account level was changed.</b><br><br>");
}
echo("<form name='f' action='admin.php?act=prom' method='POST'>
Username: <input type='text' name='u'><br>
User level: <input type='radio' name='l' value='0' checked>User 
<input type='radio' name='l' value='1'>Forum Mod 
<input type='radio' name='l' value='2'>Admin
<br><br><input type='submit' name='s' value='Do it'></form>");

   break;

case "ban":
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$tacc = $_POST['u'];
$bd = time();
$query = "UPDATE `Players` SET `bdate` = '$d' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;";
$result = @mysql_query ($query);
mysql_query("UPDATE `Players` SET `banned` = '" . $_POST['l'] . "' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `banreason` = '" . $_POST['reason'] . "' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `bd` = '$bd' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Ban', '', '$tacc')");
echo("<b>The player was banned/unbanned.</b><br /><br />");
}
echo("<form name='f' action='admin.php?act=ban' method='POST'>
Username: <input type='text' name='u'><br>
Ban/Unban: <input type='radio' name='l' value='0' checked>Unban 
<input type='radio' name='l' value='1'>Ban<br />
Reason: <input type='text' name='reason'><br />
<input type='submit' name='s' value='Do it'></form>");

break;

case "status": // alive/dead
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$acc = $_POST['u'];
$stats = $_POST['l'];
mysql_query("UPDATE `Players` SET `dead` = '" . $_POST['l'] . "' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', '$stats', '', '$tacc')");
echo("<b>The player's status was changed.</b><br><br>");
}
echo("<form name='f' action='admin.php?act=status' method='POST'>
Username: <input type='text' name='u'><br>
User Status:  
<input type='radio' name='l' value='0'>Alive 
<input type='radio' name='l' value='1'>Dead
<br><br><input type='submit' name='s' value='Do it'></form>");

break;

case "bullets":
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$give = $_POST['give'];
$take = $_POST['take'];
$total = ($give + $take);
$tacc = $_POST['u'];
mysql_query("UPDATE `Players` SET `bullets` = bullets+" . $_POST['give'] . " WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `bullets` = bullets-" . $_POST['take'] . " WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Bullet Addition', '$total', '$tacc')");
echo("<b>The player's bullet amount was updated.</b><br><br>");
}
echo("<form name='f' action='admin.php?act=bullets' method='POST'>
Username: &nbsp;&nbsp;&nbsp;<input type='text' name='u'><br>
Give bullets: <input type='text' name='give' value='0'><br>
Take bullets: <input type='text' name='take' value='0'><br><br>
<input type='submit' name='s' value='Do it'></form>");

break;

case "password": // alive/dead
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$tacc = $_POST['u'];
mysql_query("UPDATE `Players` SET `password` = '" . $_POST['l'] . "' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Password Change', '', '$tacc')");
echo("<b>The player's password was changed.</b><br><br>");
}
echo("<form name='f' action='admin.php?act=password' method='POST'>
Username: <input type='text' name='u'><br>
Change password to:  
<input type='radio' name='l' value=''>Make Blank
<input type='radio' name='l' value='12345'>Change to 12345
<br><br><input type='submit' name='s' value='Do it'></form>");

break;

case "health":
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$give = $_POST['give'];
$take = $_POST['take'];
$total = ($give + $take);
$tacc = $_POST['u'];
mysql_query("UPDATE `Players` SET `health` = health+" . $_POST['give'] . " WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("UPDATE `Players` SET `health` = health-" . $_POST['take'] . " WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Bullet Addition', '$total', '$tacc')");
echo("<b>The player's health was changed.</b><br><br>");
}
echo("<form name='f' action='admin.php?act=health' method='POST'>
<table>
<tr><td align=\"right\">Username:</td> <td><input type='text' name='u'></td></tr>
<tr><td align=\"right\">Increase Health:</td> <td><input type='text' name='give' value='0'></td></tr>
<tr><td align=\"right\">Decrease Health:</td> <td><input type='text' name='take' value='0'></td></tr>
</table>
<input type='submit' name='s' value='Do it'></form>");

break;
   
case "hdo": // Promotions to Help Desk Operators
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$tacc = $_POST['u'];
mysql_query("UPDATE `Players` SET `hdo` = '" . $_POST['l'] . "' WHERE `username` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'HDO Power', '', '$tacc')");
echo("<b>The player's account level was changed.</b><br><br>");
}
echo("<form name='f' action='admin.php?act=hdo' method='POST'>
Username: <input type='text' name='u'><br>
User level:
<input type='radio' name='l' value='0'>Demote 
<input type='radio' name='l' value='1'>Promote
<br><br><input type='submit' name='s' value='Do it'></form>");

	break;
	
case "cmsg": // Delete Messages
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$tacc = $_POST['u'];
mysql_query("DELETE FROM pmessages WHERE `touser` = '" . $_POST['u'] . "' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Clear Messages', '', '$tacc')");
echo("<b>The player's messages were cleared.</b><br><br>");
}

echo("<form name='f' action='admin.php?act=cmsg' method='POST'>
Username: <input type='text' name='u'>
<br><br><input type='submit' name='s' value='Do it'></form>");

break;

case "msg": // View Messages
echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$tacc = $_POST['u'];
$get = mysql_query("Select * FROM pmessages WHERE `touser` = '" . $_POST['u'] . "' ORDER BY id desc");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'View Messages', '', '$tacc')");
echo "<div id=\"adinbox\">
			<center><h1>Inbox</h1>
			<table>
				<tr class=\"top\">
					<td align=\"center\"><b>Subject</b></td>
					<td align=\"center\" width=\"125\"><b>From</b></td>
					<td align=\"center\" width=\"97\"><b>Date</b></td>
					<td width=\"25\">Delete</td>
				</tr>";
$nummessages = mysql_num_rows($get);
		if ($nummessages == 0) {
			echo ("<center>" . $_POST['u'] . " has no messages.</center>");

		} else {
			while ($messages = mysql_fetch_array($get)) {
				//the above lines gets all the messages sent to you, and displays them with the newest ones on top
				if ($messages[unread] == 'unread'){
				echo "<tr bgcolor=\"#000055\">
					<td><font color=\"#FF0000\"><a href=\"adminpm.php?page=view&msgid=$messages[id]\"><b>NEW: </b> ";
				} else {
				echo "<tr>
					<td><a href=\"adminpm.php?page=view&msgid=$messages[id]\">";
				}
				if ($messages[reply] == yes) {
					echo "<b>Reply to:</b> ";
				}
				echo ("$messages[title]</a></td></font>");
				$query = "SELECT id FROM Players WHERE username='$messages[from]' LIMIT 1;";
				$result = @mysql_query ($query);
				$user = mysql_fetch_assoc($result);
				if ($messages[from] != 'Global Takeover' AND $messages[from] != 'Help Desk') {
				echo ("<td align=\"center\" width=\"125\"><a href=\"profile.php?id={$user['id']}\">$messages[from]</a></td>");
				} elseif ($messages[from] == 'Global Takeover'){
				echo ("<td align=\"center\" width=\"125\">$messages[from]</td>");
				} elseif ($messages[from] == 'Help Desk'){
				echo ("<td align=\"center\" width=\"125\">$messages[from]</td>");}
				echo ("<td align=\"center\" width=\"97\">$messages[date]</td>
					<td align=\"center\" width=\"25\"><a href=\"adminpm.php?page=delete&msgid=$messages[id]\">Delete</a></td>
				</tr>");
				}}}

echo("<form name='f' action='admin.php?act=msg' method='POST'>
Username: <input type='text' name='u'>
<br><br><input type='submit' name='s' value='Do it'></form>");
break;

case "mtlogs": // View Token Gain/Loss
echo "<center>";
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$day = (time()-86400);
$monitaruser = $_POST['u'];
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Token Gain', '', '')");			
			$query = "SELECT SUM( amount ) AS loss FROM Playertoken WHERE username='$monitaruser' AND outcome='Loss' AND btime >= '$day'";
			$result = mysql_query($query);
			$row2 = mysql_fetch_array($result);
			
			$loss = $row2[0];
			
			$query = "SELECT SUM( amount ) AS profit FROM Playertoken WHERE username='$monitaruser' AND outcome='Gain' AND btime >= '$day'";
			$result = mysql_query($query);
			$row3 = mysql_fetch_array($result);
			
			$profit = $row3[0];
			
			$tprofit = ($profit - $loss);
			
			echo "<p>Last 24 Hours Gain: ".number_format($tprofit)."</p>";
}
echo("<form name='f' action='admin.php?act=mtlogs' method='POST'>
Username: <input type='text' name='u'>
<br><br><input type='submit' name='s' value='Do it'></form>");
break;

case "trans": // View Money Transfers
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Money Transfers', '', '')");
?>
<center>
<div id="usertable">
<table width=80%><tr>
<tr><td colspan="6" align="center" class="top"><b>Player Money Transfers</b></tr>
<td align=center width=16%>To</td>
<td align=center width=16%>From</td>
<td align=center width=16%>Amount</td>
<td align=center width=16%>Date</td>
<td align=center width=16%>From IP</td>
<td align=center width=16%>To IP</td>
</tr>
<?
	$gather=mysql_query("SELECT * FROM transfers ORDER BY date ASC"); 
	while ($row=mysql_fetch_array($gather)){
	$from=stripslashes($row['wfrom']);
	$to=stripslashes($row['wto']);
	$outamt=stripslashes($row['amount']);
	$outdate=stripslashes($row['date']);
	$f_ip=stripslashes($row['from_ip']);
	$t_ip=stripslashes($row['to_ip']);
	
	$query = "SELECT id FROM Players WHERE username='$to' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$toid = $row['id'];
	
	$query = "SELECT id FROM Players WHERE username='$from' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$fromid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$toid}\">$to</a></b></td> <td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$fromid}\">$from</a></b></td> <td align=\"center\">&#36;".number_format($outamt)."</td> <td align=\"center\">$outdate</td> <td align=\"center\">$f_ip</td> <td align=\"center\">$t_ip</td></tr>");
}
echo ("</table>");
break;

case "findip": // Find a player by their IP address

include ("Online.php");


echo('<center><h1>Find Players by IP</h1><form action="findbyip.php" method="post">	
 	<p>IP: 
	<input type="text" name="ip" size="20" maxlength="20" value="" /></p>
	<p><input name="Submit" type="submit" value="Find!" /></p>
	<input type="hidden" name="submitted" value="TRUE" /></center>');

break;

case "ttrans": // View Token Transfers
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Token Transfers', '', '')");
?>
<center>
<div id="usertable">
<table width=80%><tr>
<tr><td colspan="6" align="center" class="top"><b>Player Token Transfers</b></tr>
<td align=center width=16%>To</td>
<td align=center width=16%>From</td>
<td align=center width=16%>Amount</td>
<td align=center width=16%>Date</td>
<td align=center width=16%>From IP</td>
<td align=center width=16%>To IP</td>
</tr>
<?
	$gather=mysql_query("SELECT * FROM Playertoken ORDER BY date ASC"); 
	while ($row=mysql_fetch_array($gather)){
	$from=stripslashes($row['wfrom']);
	$to=stripslashes($row['wto']);
	$outamt=stripslashes($row['amount']);
	$outdate=stripslashes($row['date']);
	$f_ip=stripslashes($row['from_ip']);
	$t_ip=stripslashes($row['to_ip']);
	
	$query = "SELECT id FROM Players WHERE username='$to' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$toid = $row['id'];
	
	$query = "SELECT id FROM Players WHERE username='$from' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$fromid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$toid}\">$to</a></b></td> <td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$fromid}\">$from</a></b></td> <td align=\"center\">".number_format($outamt)."</td> <td align=\"center\">$outdate</td> <td align=\"center\">$f_ip</td> <td align=\"center\">$t_ip</td></tr>");
}
echo ("</table>");
break;

case "gmtrans": // View Global Market Transfers
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'GM Transfers', '', '')");
?>
<center>
<div id="usertable">
<table width=80%><tr>
<tr><td colspan="9" align="center" class="top"><b>Global Market Transfers</b></tr>
<td align=center width=11%>To</td>
<td align=center width=11%>From</td>
<td align=center width=11%>Amount</td>
<td align=center width=11%>Price</td>
<td align=center width=11%>Type</td>
<td align=center width=11%>Vehicle</td>
<td align=center width=11%>Date</td>
<td align=center width=11%>From IP</td>
<td align=center width=11%>To IP</td>
</tr>
<?
	$gather=mysql_query("SELECT * FROM gmlog ORDER BY date ASC"); 
	while ($row=mysql_fetch_array($gather)){
	$from=stripslashes($row['seller']);
	$to=stripslashes($row['buyer']);
	$price=stripslashes($row['price']);
	$outamt=stripslashes($row['amount']);
	$outdate=stripslashes($row['date']);
	$f_ip=stripslashes($row['sellerip']);
	$t_ip=stripslashes($row['buyerip']);
	$type=stripslashes($row['type']);
	$vehicle=stripslashes($row['model']);
	
	$query = "SELECT id FROM Players WHERE username='$to' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$toid = $row['id'];
	
	$query = "SELECT id FROM Players WHERE username='$from' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$fromid = $row['id'];
	
echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$toid}\">$to</a></b></td> <td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$fromid}\">$from</a></b></td> <td align=\"center\">".number_format($outamt)."</td> <td align=\"center\">&#36;".number_format($price)."</td> <td align=\"center\">$type</td> <td align=\"center\">$vehicle</td> <td align=\"center\">$outdate</td> <td align=\"center\">$f_ip</td> <td align=\"center\">$t_ip</td></tr>");
}
echo ("</table>");
break;

case "appear": // appear offline

echo('<center>');
if($_POST['s']) {
mysql_query("UPDATE `Players` SET `appearo` = '" . $_POST['l'] . "' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Appear Offline', '', '')");
echo("<b>Your status was changed.</b><br><br>");
}
echo("<form name='f' action='admin.php?act=appear' method='POST'>
Status:  
<input type='radio' name='l' value='0'>Online 
<input type='radio' name='l' value='1'>Appear Offline
<br><br><input type='submit' name='s' value='Do it'></form>");

break;


}} else {
echo('<div id=\"gameplay\"><center>');
mysql_query("INSERT INTO adminlogs (username, ip, type, amount, toaccount) VALUES ('$user', '$ip', 'Tresspasser', '', '')");
echo("You do not have sufficient permissions to access this page.");
echo('</center></div>');
}
echo('</div>');
include("../footer.php");
exit();
?>