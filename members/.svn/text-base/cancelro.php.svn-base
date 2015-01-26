<?php
$title="Cancel Invitation";
include("config.php");
include("header.php");
checks();
online(); 

$row=mysql_fetch_array(mysql_query("SELECT corps FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$c = $row[0];

$id = $_GET['id'];
$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id ='$id' LIMIT 1;"));
$iname=$row['username'];
if ($id != NULL) {
		$sql=mysql_query("SELECT * FROM invite WHERE username='$iname' AND corp = '$c' LIMIT 1;");
		if (mysql_num_rows($sql) > 0) {
		$row = mysql_fetch_array($sql);
		$stats = $row['stats'];
		mysql_query("DELETE FROM invite WHERE username='$iname' AND corp = '$c' LIMIT 1;");
		echo "<div id=\"crimestext\" align=\"center\">You have canceled $iname's invite from $c! <br /> <a href=\"Corps.php\">Go back.</a></div>";
		include("footer.php");
		if ($stats == 0) {
		$subject = htmlspecialchars(addslashes("$c Invitation Canceled"));
		$message = htmlspecialchars(addslashes("$c has canceled your invite!"));
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$iname', 'Global Takeover', 'unread', '$date'");
		}
		exit();
} else {
echo "<div id=\"crimestext\" align=\"center\">You cannot cancel $iname's invite to another Corp!<br><a href=\"Corps.php\">Go Back</a></div>";
include("footer.php");
exit();
}
} else {
echo "<div id=\"crimestext\" align=\"center\">Please select a vaild invite to cancel!<br><a href=\"Corps.php\">Go Back</a></div>";
include("footer.php");
exit();
}
?>