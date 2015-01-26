<?
ob_start(); 
include ("config.php");
include ("Online.php");
//the above line needs to be above ALL HTML and PHP (except for <?).
//gets the config page, which connects to the database and gets the user's information

if (!isset($_COOKIE['id'])) {
	header("Location: /login.html");
	exit();
}

$query = "SELECT health FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;";
$result = @mysql_query($query);
$row = mysql_fetch_assoc($result);

if ($row["health"] == 0) {
	header("Location: /dead.html");
	
} else {

$query = "SELECT theme, level FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$theme = $row[0];
$level = $row[1];

if ($theme != NULL) {

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />");

} else {
$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />");

$theme = 'style';
}

	if ($level == 2) {
		//checks to see if they are logged in
		
		if (!$_POST[send]) {
			$recipient = isset($_GET["recipient"]) ? trim($_GET["recipient"]) : "";
			$subject = isset($_GET["subject"]) ? trim($_GET["subject"]) : "";
			$message = isset($_GET["message"]) ? trim($_GET["message"]) : "";
			//the form hasnt been submitted yet....
			echo "<div id=\"inbox\">
				<center><form method=\"POST\" style=\"margin: 0px;\">
    			<h1>New Message</h1>
    			<dl style=\"margin: 0px;\">";
			
			//the above line gets all the members names and puts them in a drop down box
			echo "</select>
				</dd>
				<dd>
				<dt><b>Subject</b></dt>
				<dd><input type=\"text\" name=\"subject\" size=\"20\" value=\"$subject\"></dd>
				<br />
				<dt><b>Message</b></dt>
				<dd><textarea rows=\"7\" name=\"message\" cols=\"35\" value=\"$message\"></textarea>
				</dd><dt> </dt>
				<dd><input type=\"submit\" value=\"Submit\" name=\"send\"></dd>
				</dl>
				</form>
				</center>
				</div>";
		}
		if ($_POST[send]) {
			//the form has been submitted.  Now we have to make it secure and insert it into the database
			$subject = htmlspecialchars(addslashes("$_POST[subject]"));
			$message = htmlspecialchars(addslashes("$_POST[message]"));
			$sql = mysql_query("SELECT username FROM Players WHERE dead = 0 AND banned = 0");
			while ($rows = mysql_fetch_array($sql)) {
			//the above lines remove html and add \ before all "
			$date = (date("M d Y h:i:s A"));
			$to = $rows['username'];
			$sql1 = mysql_query("INSERT INTO `pmessages` (`id`, `title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES (NULL, '$subject', '$message', '$to', '$logged[username]', 'unread', '$date', 'no')");
			}
			echo "<div id=\"crimestext\"><center>Your message has been sent.<br />
			<a href=\"javascript: history.go(-2)\">Go back.</a></center></div>";
		}
}
}
?>