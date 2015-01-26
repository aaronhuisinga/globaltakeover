<?php
include ("config.php");
$row=mysql_fetch_array(mysql_query("SELECT corps, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$c = $row[0];
$u = $row[1];
$title="$c > Invitation Management";
include("header.php");

$sql = mysql_query("SELECT owner, co, rightro, leftro FROM Corps WHERE name='$c'");
$row = mysql_fetch_array($sql);
$own = $row[0];
$co = $row[1];
$rro = $row[2];
$lro = $row[3];

if ($u != $own AND $u != $co AND $u != $rro AND $u != $lro) {
	echo "<div align=\"center\" id=\"crimestext\">You are not in charge of recruiting!</div>";
	include("footer.php");
	exit();
} else {

$iname = $_POST['iname'];
$sql = mysql_query("SELECT * FROM Players WHERE username ='$iname'");
$row = mysql_fetch_array($sql);
$iname = $row['username'];
if (mysql_num_rows($sql) > 0) {
$iid = $row['id'];
$icorp= $row['corps'];
if ($icorp == 'None') {
$sqlr = mysql_query("SELECT * FROM recruit WHERE username='$iname'");
if (mysql_num_rows($sqlr) == 0) {
$sqli = mysql_query("SELECT * FROM invite WHERE username='$iname'");
if (mysql_num_rows($sqli) == 0) {
$query = mysql_query("INSERT INTO invite (username, corp) VALUES ('$iname', '$c')");

$sql = mysql_query("SELECT romsg FROM Corps WHERE name='$c'");
$row = mysql_fetch_array($sql);
$message = $row[0];
if ($message == NULL) {
$message=addslashes("You have been invited to join $c!");
}
		$subject=htmlspecialchars(addslashes("Invite from $c"));
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$iname', 'Global Takeover', 'unread', '$date')");
echo "<div id=\"crimestext\" align=\"center\">$iname has been sent an invite to the Corp!<br><a href=\"ro.php\">Go Back</a></div>";
} else {
echo "<div id=\"crimestext\" align=\"center\">$iname has already been sent an invite by a Corp!<br><a href=\"ro.php\">Go Back</a></div>";
}
} else {
echo "<div id=\"crimestext\" align=\"center\">$iname has already applied for a Corp!<br><a href=\"ro.php\">Go Back</a></div>";
}
} else {
echo "<div id=\"crimestext\" align=\"center\">$iname is already in a Corp!<br><a href=\"ro.php\">Go Back</a></div>";
}
} else {
echo "<div id=\"crimestext\" align=\"center\">Please enter a valid username!<br><a href=\"ro.php\">Go Back</a></div>";
}
include("footer.php");
}
?>