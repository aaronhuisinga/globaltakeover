<?
ob_start(); 
include ("config.php");
include ("Online.php");
include ("BBCode.php");

$result = mysql_query("SELECT theme, health, Level FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);

$lvl = $row[2];

$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

if (!isset($_COOKIE['id'])) {
	header("Location: /login.html");
	exit();
}

if ($row["health"] == 0) {
	header("Location: /dead.html");
	
} else {
if ($lvl == 2) {
	if ($logged[username]) {
		switch($_GET[page]) {
		default:
		$get = mysql_query("SELECT * from pmessages where touser = '$logged[username]' order by id desc");
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
			echo ("<center>You have no messages.</center></table>");

		} else {
			while ($messages = mysql_fetch_array($get)) {
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
				$result = mysql_query("SELECT id FROM Players WHERE username='$messages[from]' LIMIT 1;");
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
			}
			echo "</table></div>";
		}
		if (!$_POST[send]) {
			$recipient = isset($_GET["recipient"]) ? trim($_GET["recipient"]) : "";
			//the form hasnt been submitted yet....
			echo "<div id=\"inbox\">
				<center><form method=\"POST\" style=\"margin: 0px;\">
    			<h1>New Message</h1>
    			<dl style=\"margin: 0px;\">
            	<dt><b>Recipient</b></dt>
            	<dd><input type=\"text\" name=\"to\" size=\"20\" value=\"$recipient\"></dd>";
			
			//the above line gets all the members names and puts them in a drop down box
			echo "</select>
				</dd>
				<dd>
				<dt><b>Subject</b></dt>
				<dd><input type=\"text\" name=\"subject\" size=\"20\"></dd>
				<br />
				<dt><b>Message</b></dt>
				<dd><textarea rows=\"7\" name=\"message\" cols=\"35\"></textarea>
				</dd><dt> </dt>
				<dd><input type=\"submit\" value=\"Submit\" name=\"send\"></dd>
				</dl>
				</form>
				</center>
				</div>";
		}
		if ($_POST[to]) {
			//the form has been submitted.  Now we have to make it secure and insert it into the database
			$subject = htmlspecialchars(addslashes("$_POST[subject]"));
			if ($subject == NULL) {
				$subject = 'No Subject';
			}
			$message = htmlspecialchars(addslashes("$_POST[message]"));
			$to = htmlspecialchars(addslashes("$_POST[to]"));
			    $query = mysql_query("SELECT username FROM Players WHERE username = '$to' LIMIT 1");
			    $row = mysql_fetch_array($query);
			    $to = $row[0];
				if ($to == NULL){
					echo("No Such Username!");
					exit();
				}
			//the above lines remove html and add \ before all "
			$date = (date("M d Y h:i:s A"));
			$sql = mysql_query("INSERT INTO `pmessages` (`id`, `title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES (NULL, '$subject', '$message', '$to', '$logged[username]', 'unread', '$date', 'no')");
			echo "<div id=\"crimestext\"><center>Your message has been sent. <br />
			<a href=\"adminpm.php\">Go back.</a></center></div>";
		}
		break;
		case 'delete':
		if (!$_GET[msgid]) {
			echo "<div id=\"crimestext\"><center>Sorry, but this message is invalid.</center></div>";
		} else {
			$getmsg = mysql_query("SELECT * from pmessages where id = '$_GET[msgid]'");
			$msg = mysql_fetch_array($getmsg);
				$delete  = mysql_query("delete from pmessages where id = '$_GET[msgid]'");
				echo "<div id=\"crimestext\"><center>The message has been deleted.<br />
				<a href=\"adminpm.php\">Go Back</a></center></div>";
				echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
			
		}
		break;
		case 'view':
		//the url now should look like ?page=view&msgid=#
		if (!$_GET[msgid]) {
			//there isnt a &msgid=# in the url
			echo "<div id=\"crimestext\"><center>Invalid message!</center></div>";
		} else {
			//the url is fine..so we continue...
			$getmsg= mysql_query("SELECT * from pmessages where id = '$_GET[msgid]'");
			$msg = mysql_fetch_array($getmsg);
			//the above lines get the message, and put the details into an array.
				
					//the form has not been submitted, so we display the message and the form
					$markread = mysql_query("Update pmessages set unread = 'read' where id = '$_GET[msgid]'");
					//this line marks the message as read.
					$Text = (stripslashes("$msg[message]"));
					$message = BBcode($Text);
					//removes slashes and converts new lines into line breaks.
					$result = mysql_query("SELECT id FROM Players WHERE username='$msg[from]' LIMIT 1;");
					$user = mysql_fetch_assoc($result);
					echo "<div id=\"inbox\">
						<center><h1>$msg[title]</h1>
						<br />
						<a href=\"adminpm.php?page=delete&msgid=$_GET[msgid]\">Delete</a>
						<form method=\"POST\" style=\"margin: 0px;\">
						<dl style=\"margin: 0px;\">
						<table>
							<tr class=\"top\"><td width=\"50%\"><dt><b>From: <a href=\"profile.php?id={$user['id']}\">$msg[from]</a></b></dt></td><td align=\"right\"><b>At: $msg[date]</b></td></tr>
							<tr><td colspan=\"2\"><b>$message</b></td></tr>
						</table>
						<br />
						<dt><b>Reply</b></dt>
						<dd><textarea rows=\"6\" name=\"message\" cols=\"45\"></textarea></dd>
						<dt> </dt>
						<dd><input type=\"submit\" value=\"Submit\" name=\"send\"></dd>
						</dl></form></center></div>";
						echo ('<script language="javascript">
		   				window.parent.stats.location.reload();
		   				</script>');
				if ($_POST[message]) {
					//the form HAS been submitted, now we insert it into the database
					$date = (date("M d Y h:i:s A"));
					$message = htmlspecialchars(addslashes("$_POST[message]"));
					$do = mysql_query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('$msg[title]', '$message', '$msg[from]', '$logged[username]', 'unread', '$date', 'yes')");
					echo "<div id=\"crimestext\"><center>Your message has been sent. <br />
					<a href=\"adminpm.php\">Go back.</a></center></div>";
				}
			
		}
		break;
		}
	}
} else {
echo('<div id=\"gameplay\"><center>');
echo("You do not have sufficient permissions to access this page.");
echo('</center></div>');
}}
?> 