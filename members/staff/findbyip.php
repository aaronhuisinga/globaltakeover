<?
include("../config.php");

$sql = mysql_query("SELECT Level FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array($sql);
$lvl = $row[0];
if ($lvl == 2) {

echo('<div id="usertable"><center><h1>Find Player by IP</h1><br />');

if (!isset($_POST['submit'])) {
	if (empty($_POST['ip'])) {
		echo("Please enter an IP address.");
		exit();
	} else {
	$f = $_POST['ip'];
	$getusers = mysql_query("SELECT * FROM Players WHERE lastip RLIKE '$f' OR r_ip RLIKE '$f'");
	//gets searched username
	echo ("<table width=\"20%\">
	<tr class=\"top\"><td colspan=\"3\" align=\"center\">Results</td</tr>
	<tr><td align=\"center\"><b>Username</td> <td align=\"center\">Registration IP</td> <td align=\"center\">Last IP</td></tr>");
	
	while ($users = mysql_fetch_array($getusers))
	{
	echo ("<tr align=\"center\"><td align=\"center\"><a href=\"../profile.php?id={$users['id']}\">$users[username]</a></td> <td align=\"center\">$users[r_ip]</td> <td align=\"center\">$users[lastip]</td></tr>");	
	//displays found users with link to profile
	}
	echo ("</table>");
	
	$sql = mysql_query("SELECT COUNT( id ) AS tfound FROM Players WHERE lastip RLIKE '$f' OR r_ip RLIKE '$f'");
	$row = mysql_fetch_array ($sql);
	$tfound = $row[0];
	
	echo ("<br />Total Players Found: $tfound </center></div>");
}
} else {
echo ("You do not have sufficient permissions to access this area.");
}
}
?> 