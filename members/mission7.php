<?php
include("config.php");
include("Countdown_he.php");
include("Banned.php");
checks();
online();
$query = "SELECT health, location, mission, username, money, exp, bullets FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$h = $row[0];
$l = $row[1];
$m = $row[2];
$u = $row[3];
$money = $row[4];
$exp = $row[5];
$bullets = $row[6];

if ($h == 0) {
 	$url .= '/dead.html';
	header("Location: $url");
	exit();
	
} else {
if ($l != 'Philippines') {
	echo '<div id="crimestext" align="center">You need to be in the Philippines to attempt/finish this mission!</div>';
	exit();
} else {
if ($m != 7) {
	echo '<div id="crimestext" align="center">You need to already be on this mission to access this page!</div>';
	exit();
} else {
$query = mysql_query("SELECT * FROM mission7 WHERE username = '$u'");
$row = mysql_fetch_array($query);
$misstats = $row['missionstats'];
if (mysql_num_rows($query) == 0) {
	if ($_REQUEST['Accept']) {
	$rl = rand (1,5);
		if ($rl == 1) {
		$J = 'USA';
		} elseif ($rl == 2) {
		$J = 'UK';
		} elseif ($rl == 3) {
		$J = 'Russia';
		} elseif ($rl == 4) {
		$J = 'Brazil';
		} elseif ($rl == 5) {
		$J = 'Australia';
		} 
		$query = mysql_query("INSERT INTO mission7 (username, Oonelth) VALUES ('$u', 'USA')");
		echo "<div id=\"crimestext\" align=\"center\">You have accepted the mission! Good luck, $u!</div>";
		exit();
	exit();
	}
	echo "<div id=\"crimestext\" align=\"center\"><h2>Mission Briefing!</h2><br><br>
		Shit! They’ve caught wind of our plans, and changed the location of the convoy! To our knowledge, everything else is the same. We need you to hunt their leader Oonelth. We need to know what location he is in, because there is no way that they would do the operation without him being in the same country.
		<form action=\"\" method=\"POST\"><input type =\"submit\" value=\"Accept!\" name=\"Accept\"></form></div>";
	} else {
	
	if ($_REQUEST['Finish']) {
		
		if ($misstats != 3) {
			echo '<div id="crimestext" align="center">You have not yet finished this mission!<br><a href="missions.php">Go Back</a></div>';
			exit();
		} else {
			$nbullets = $bullets;
			$nexp = $exp + 550;
			$nmoney = $money + 500000;
			$sql = mysql_query("UPDATE Players SET money = '$nmoney', exp='$nexp', mission=8 WHERE id = '{$_COOKIE['id']}'");
			$query = mysql_query("DELETE FROM mission7 WHERE username='$u'");
			$current = time();
		$date = (date("M d Y h:i:s A"));
		mysql_query("INSERT INTO Playerbullets (amount, date, username, outcome, btime, used) VALUES ('550', '$date', '$u', 'Gain', '$current', 'Mission 7 finish')");
		mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('500000', '$date', '$u', 'Gain', '$current', 'Mission 7 Finish')");
			echo ('<script language="javascript">
			window.parent.stats.location.reload();
			</script>');
			echo ('<script language="javascript">
			window.parent.bbar.location.reload();
			</script>');
			echo "<div id=\"crimestext\" align=\"center\">Congratulations, $u, you have helped plan the Robbery! For your time and effort we award you $500,000. We have more missions if you need more work!<br><a href=\"missions.php\">Go Back</a></div>";
			exit();
		}
	}
	if ($misstats == 1) {
	echo "<div id=\"crimestext\" align=\"center\"><h2>Mission Status!</h2><br><br><table>
<tr>
<td>
<form action=\"huntO.php\" method=\"post\">
Username: 
Oonelth <br />
Number of spies:  <select name=\"number\">
  <option value=\"1\">1 Spy($50,000)</option>
  <option value=\"2\">2 Spies($150,000)</option>
  <option value=\"3\">3 Spies($250,000)</option>
  <option value=\"4\">4 Spies($350,000)</option>
</select><br />
<center><input type=\"submit\" name=\"submit\" value=\"Hunt Them!\" /></center>
<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
</form>
</td>
</tr>
</table>
</center></div>";
	exit();
	} elseif ($misstats == 2) {
	echo ("<div id=\"gameplay\" align=\"center\"><h2>Mission Status</h2><br><table id=\"usertable\">
<tr><td class=\"top\" colspan=\"2\" align=\"center\">Current Hunts</td></tr>
<tr><td align=\"center\"><b>Target</b></td><td align=\"center\"><b>Status</b></td></tr>");

$gather=mysql_query("SELECT time, number, target, length, id, find FROM mspies WHERE hunter='$u'"); 
while ($row=mysql_fetch_array($gather)){

$starttime=$row['time'];
$spies = $row['number'];
$target = $row['target'];
$length = $row['length'];
$id = $row['id'];
$find = $row['find'];

$query = "SELECT id FROM Players WHERE username='$target'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$tid = $row[0];

if ($spies == '1') {
$actualDate = time();

$secondsDiff = $actualDate - $starttime;
$expire = ($length + 14400);

if ($secondsDiff <= $length) {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">Hunting... <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");

} elseif ($secondsDiff >= $expire) {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">You left the search too long, and it expired. <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");

} else {

if ($find == 'yes') {
$query = "SELECT Oonelth FROM mission7 WHERE username='$u'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$tlocation = $row[0];

echo ("<tr><td align=\"center\">$target</td><td align=\"center\"><a href=\"shootO.php?id={$id}\">Found in $tlocation</a></td></tr>");

} elseif ($find == 'no') {

echo ("<tr><td align=\"center\">$target</td><td align=\"center\">The Hunt Failed. <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");
}
}

} elseif ($spies == '2') {
$actualDate = time();

$secondsDiff = $actualDate - $starttime;
$expire = ($length + 14400);

if ($secondsDiff <= $length) {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">Hunting... <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");

} elseif ($secondsDiff >= $expire) {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">You left the search too long, and it expired. <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");

} else {

if ($find == 'yes') {
$query = "SELECT Oonelth FROM mission7 WHERE username='$u'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$tlocation = $row[0];

echo ("<tr><td align=\"center\">$target</td><td align=\"center\"><a href=\"shootO.php?id={$id}\">Found in $tlocation</a></td></tr>");

} elseif ($find == 'no') {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">The Hunt Failed. <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");
}
}

} elseif ($spies == '3') {
$actualDate = time();

$secondsDiff = $actualDate - $starttime;
$expire = ($length + 14400);

if ($secondsDiff <= $length) {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">Hunting... <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");

} elseif ($secondsDiff >= $expire) {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">You left the search too long, and it expired. <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");

} else {

if ($find == 'yes') {
$query = "SELECT Oonelth FROM mission7 WHERE username='$u'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$tlocation = $row[0];

echo ("<tr><td align=\"center\">$target</td><td align=\"center\"><a href=\"shootO.php?id={$id}\">Found in $tlocation</a></td></tr>");

} elseif ($find == 'no') {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">The Hunt Failed. <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");
}
}

} elseif ($spies == '4') {
$actualDate = time();

$secondsDiff = $actualDate - $starttime;
$expire = ($length + 14400);

if ($secondsDiff <= $length) {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">Hunting... <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");

} elseif ($secondsDiff >= $expire) {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">You left the search too long, and it expired. <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");

} else {

if ($find == 'yes') {
$query = "SELECT Oonelth FROM mission7 WHERE username='$u'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$tlocation = $row[0];

echo ("<tr><td align=\"center\">$target</td><td align=\"center\"><a href=\"shootO.php?id={$id}\">Found in $tlocation</a></td></tr>");

} elseif ($find == 'no') {
echo ("<tr><td align=\"center\">$target</td><td align=\"center\">The Hunt Failed. <a href=\"mremove.php?id={$id}\">Remove</a></td></tr>");
}
}
}
}
} elseif ($misstats == 3) {
echo "<div align=\"center\" id=\"crimestext\"><h2>Mission Stats</h2><br> Well Done, $u!<br>
<form action=\"mission7.php\" method= \"POST\"><input type=\"submit\" name=\"Finish\" value=\"Finish Mission!\"></form>";
}
}
}
}
}
?>