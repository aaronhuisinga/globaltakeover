<?php
$title="Hospital";
include("config.php");
include("header.php");
include("Countdown_he.php");
include("countdown_p.php");
checks();

$row = mysql_fetch_array(mysql_query("SELECT money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$m = $row[0];

if (isset($_REQUEST['submit'])) {
	$hours = intval(strip_tags(abs($_POST['h'])));
	if (!preg_match("/[0-9]/",$hours)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"escrow.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
	}
	$mn = $hours * 10000;
	
	if ($hours == NULL) {
		echo("<div id=\"crimestext\"><center>Please select an amount of hours to stay at the hospital for!</center></div>");
		include("footer.php");
		exit();
	} elseif ($hours > 10) {
	echo("<div id=\"crimestext\"><center>You cannot stay for longer then 10 hours!</center></div>");
	include("footer.php");
	exit();
	} 

	if ($hours > 0 AND $hours < 11){
	if ($h == 100) {
		echo("<div id=\"crimestext\"><center>You are already at full health!</center></div>");
		include("footer.php");
		exit();
	} else {
	
		if($mn > $m) {
			echo("<div id=\"crimestext\"><center>You do not have enough money for this!</center></div>");
			include("footer.php");
		} else {
			mysql_query("UPDATE Players SET money=(money-$mn), hospital='$hours', htime='$current' WHERE id ='{$_COOKIE['id']}' LIMIT 1;");
		echo "<div id=\"crimestext\"><center>You have been admitted to the hospital for $hours hour(s)!</center></div>";
		include("footer.php");
		exit();
}
}
} else {
	echo("<div id=\"crimestext\"><center>Please select a number of hours to stay at the hospital for!</center></div>");
	include("footer.php");
exit();
}
}
?>