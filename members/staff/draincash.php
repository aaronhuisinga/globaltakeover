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

$result = mysql_query("SELECT health, theme, level FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array($result);

$theme = $row[1];
$level = $row[2];

if ($row["health"] == 0) {
	header("Location: /dead.html");
	
} else {
$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

	if ($level == 2) {
	
	$d = date('d'); //current day
	$m = date('m'); //current month
	$dd = $d - 5;
	$emailsent = 0;
	$selectdates = mysql_query("SELECT * FROM Players WHERE dead=0 AND banned=0 AND money=5000000");
	while ($row=mysql_fetch_array($selectdates)) {
	$td = $row['Laston'];
	$username = $row['username'];
	$a = $row['active'];
	if (!preg_match("/\bAug\b/i", "$td")) {
		mysql_query("UPDATE Players SET money=50000 WHERE username='$username'");
		$emailsent = $emailsent + 1;		
	}
	
	}
	echo "<div id='crimestext'><center>Emails was sent to $emailsent accounts!</center></div>";
} else {
	echo "<div id='crimestext'><center>You don't have sufficient permissions to access this page. $level $theme $health</center></div>";
}
}
?>
