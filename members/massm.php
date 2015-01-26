<?php
include("config.php");
include("forums/BBCode.php");
include("striphtml.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT username, corps FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$c = addslashes($row[1]); $ecorp=$row[1];
$title="$ecorp > Mass Messaging";
include("header.php");
include("Countdown_he.php");

$row=mysql_fetch_array(mysql_query("SELECT owner, co FROM Corps WHERE name='$c' LIMIT 1;"));
$o = $row[0];
$co = $row[1];
				
if ($u == $o OR $u == $co) {
if (!$_POST['submit']) {
echo '<script type="text/javascript" src="nicEdit.js"></script> <script type="text/javascript">
					bkLib.onDomLoaded(
   					function() {
     					 var niceditor = new nicEditor();
     					 var niceditorpanel = new nicEditor({
           					 iconsPath : \'nicEditorIcons.gif\',
          					 buttonList : [\'bold\',\'italic\',\'underline\',\'strikethrough\',\'removeformat\',\'image\',\'link\',\'unlink\',\'forecolor\'],
           					 bbCode : false,
           					 xhtml : true
    					  }).panelInstance(\'area1\');
                               
    					  niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
   					 }
    
					);

					</script>';
		echo "<div id=\"ltable\" align=\"center\">
				<form method=\"POST\" style=\"margin: 0px;\">
				<br />
    			<h1>New Message</h1>
    			<table>
            	<tr><td align=\"center\"><b>Recipient</b></td></tr>
            	<tr><td align=\"center\"><select name=\"who\">
				<option value='All'>All Corp Members</option>
  				<option value='online'>Online Corp Members</option>
  				<option value='Struc'>Structure Members</option>
  				</select></td></tr>
				<tr><td align=\"center\"><b>Subject</b></td></tr>
				<tr><td align=\"center\"><input type=\"text\" name=\"subject\" size=\"20\"></td></tr>
				<tr><td align=\"center\"><b>Message</b></td></tr>
				<tr><td><textarea rows=\"10\" id=\"area1\" name=\"message\" cols=\"40\"></textarea></td></tr>
				<tr><td align=\"center\"><input type=\"submit\" value=\"submit\" name=\"submit\"></td></tr>
				</table>
				</form>
				</div>";
include("footer.php");
} else {
			$message = stripHTML(addslashes($_POST['message']));
			if ($message == NULL) {
				echo "<div id=\"crimestext\" align=\"center\">You must enter a message.<br /><a href=\"javascript:history.go(-1)\">Go back.</a></div>";
				include("footer.php");
				exit();
			}
			$subject = htmlspecialchars(addslashes("$_POST[subject]"));
			if ($subject == NULL) {
				$subject = 'No Subject';
			}
			if (!eregi ('^[[:alnum:]][a-z0-9_\. \-]{1,50}$', stripslashes(trim($subject)))) {
				echo "<div id=\"crimestext\"><center>You must have at least one character in the title of your message, other than a space and some symbols.</div></center>";
				include("footer.php");
				exit();
			}
			$to = htmlspecialchars(addslashes("$_POST[who]"));
			if ($to == 'All') {
			$sql = mysql_query("SELECT * FROM Players WHERE corps='$c'");
			while ($row=mysql_fetch_array($sql)) {
			$to = $row['username'];
			$from = "$c($u)";
			
			mysql_query("INSERT INTO `pmessages` (`id`, `title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES (NULL, '$subject', '$message', '$to', '$from', 'unread', '$date', 'no')");
			}
			echo "<div id=\"crimestext\"><center>Your messages have been sent.<br /><a href=\"javascript: history.go(-2)\">Go back.</a></center></div>";
			include("footer.php");
			exit();
			} elseif ($to == 'online') {
			$users = mysql_query("SELECT id, username, online FROM Players WHERE corps = '$c' ORDER BY username ASC");
			while ($user = mysql_fetch_assoc($users))
			{       
			$online = $user['online'];
			$offline = (time()-300);
			$to = $user['username'];
			$from = "$c($u)";
			if ($online >= $offline) {
			$sql = mysql_query("INSERT INTO `pmessages` (`id`, `title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES (NULL, '$subject', '$message', '$to', '$from', 'unread', '$date', 'no')");
			}
			}
			echo "<div id=\"crimestext\"><center>Your messages have been sent.<br /><a href=\"javascript: history.go(-2)\">Go back.</a></center></div>";
			include("footer.php");
			} elseif ($to == 'Struc') {
			$query = mysql_query("SELECT owner, co, leftl, rightl, leftro, rightro FROM Corps WHERE name='$c'");
			$row = mysql_fetch_array($query);
			$o = $row[0];
			$co = $row[1];
			$ll = $row[2];
			$rl = $row[3];
			$lro = $row[4];
			$rro = $row[5];
			$from = "$c($u)";
			$arr = array("$o", "$co", "$ll", "$rl", "$lro", "$rro");
			foreach ($arr as $to) {
			if ($to != 'None') {
			$sql = mysql_query("INSERT INTO `pmessages` (`id`, `title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES (NULL, '$subject', '$message', '$to', '$from', 'unread', '$date', 'no')");
			}
			}
			echo "<div id=\"crimestext\"><center>Your messages have been sent.<br /><a href=\"javascript: history.go(-2)\">Go back.</a></center></div>";
			include("footer.php");
			}
}
} else {
echo "<div id='crimestext' align='center'>You do not have sufficient privileges to access this page.</div>";
include("footer.php");
exit();
}
?>