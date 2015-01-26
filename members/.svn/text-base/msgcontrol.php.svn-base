<?php
ob_start();
include_once("config.php");
include_once("Online.php");

$sql = mysql_query("SELECT Level FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array($sql);
$lvl = $row[0];
if ($lvl == 2) {

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

echo('<center>');
if($_POST['s'] && (strlen($_POST['u']) > 0)) {
$get = mysql_query("Select * FROM pmessages WHERE `touser` = '" . $_POST['u'] . "' ORDER BY id desc");
echo "<div id=\"inbox\">
			<center><h1>Inbox</h1>
			<a href=\"clearpm.php\">Delete all messages</a>
			<table>
				<tr class=\"top\">
					<td align=\"center\">Subject</td>
					<td align=\"center\" width=\"125\">From</td>
					<td align=\"center\" width=\"97\">Date</td>
					<td width=\"25\">Delete</td>
				</tr>";
$nummessages = mysql_num_rows($get);
		if ($nummessages == 0) {
			echo ("<center>You have no messages.</center>");

		} else {
			while ($messages = mysql_fetch_array($get)) {
				//the above lines gets all the messages sent to you, and displays them with the newest ones on top
				if ($messages[unread] == 'unread'){
				echo "<tr bgcolor=\"#000055\">
					<td><font color=\"#FF0000\"><a href=\"PM.php?page=view&msgid=$messages[id]\"><b>NEW: </b> ";
				} else {
				echo "<tr>
					<td><a href=\"PM.php?page=view&msgid=$messages[id]\">";
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
					<td align=\"center\" width=\"25\"><a href=\"PM.php?page=delete&msgid=$messages[id]\">Delete</a></td>
				</tr>");
				}
echo("<h1>View Messages</h1>");
echo("<form name='f' action='admin.php?act=msg' method='POST'>
Username: <input type='text' name='u'>
<br><br><input type='submit' name='s' value='Do it'></form>");


}
}
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
echo('<div id=\"gameplay\"><center>');
echo("You do not have sufficient permissions to access this page.");
echo('</center></div>');
}
?>