<?php
$title="Kills";
include('members/config.php');
require_once("members/header.php");
include("members/Countdown_he.php");
include("members/countdown_p.php");
checks();
online();

$result = mysql_query("SELECT location, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$l = $row[0];
$u = $row[1];

$gather = mysql_query("SELECT * FROM spies WHERE hunter='$u'");
$row = mysql_fetch_array ($gather);

if (mysql_num_rows($gather) == 0) {
?>
<div id="ltable" align="center">
<h1>Kills</h1>
<p>Hunt your target down, get your gun, and take the shot.</p>
<table><tr><td>
<form action="members/hunt.php" method="post">
Username: 
<input type="text" name="target" value="" /> <br />
Number of spies:  <select name="number">
  <option value="1">1 Spy($50,000)</option>
  <option value="2">2 Spies($150,000)</option>
  <option value="3">3 Spies($250,000)</option>
  <option value="4">4 Spies($350,000)</option>
</select><br />
<center><input type="submit" name="submit" value="Hunt Them!" /></center>
<input type="hidden" name="submitted" value="TRUE" />
</form>
</td></tr>
</table>
</div>
<?
include("members/footer.php");
} elseif (mysql_num_rows($gather) >= 1) {
echo ("<div id=\"ltable\" align=\"center\">
<h1>Kills</h1>
<table id=\"usertable\">
<tr><td class=\"top\" colspan=\"2\" align=\"center\">Current Hunts</td></tr>
<tr><td align=\"center\"><b>Target</b></td><td align=\"center\"><b>Status</b></td></tr>");

$gather = mysql_query("SELECT * FROM spies WHERE hunter='$u'");
while ($row=mysql_fetch_array($gather)){
$starttime = $row['time'];
$spies = $row['number'];
$target = $row['target'];
$length = $row['length'];
$id = $row['id'];
$find = $row['find'];

$query = "SELECT id, location FROM Players WHERE username='$target' LIMIT 1;";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);
$tid = $row[0];
$tlocation = $row[1];
$actualDate = time();
$secondsDiff = $actualDate - $starttime;
$expire = ($length + 14400);
if ($secondsDiff <= $length) {
echo ("<tr><td align=\"center\"><a href=\"members/profile.php?id={$tid}\">$target</a></td><td align=\"center\">Hunting... <a href=\"members/hremove.php?id={$id}\">Remove</a></td></tr>");
} elseif ($secondsDiff >= $expire) {
echo ("<tr><td align=\"center\"><a href=\"members/profile.php?id={$tid}\">$target</a></td><td align=\"center\">You left the search too long, and it expired. <a href=\"members/hremove.php?id={$id}\">Remove</a></td></tr>");
} else {
if ($find == 'yes') {
echo ("<tr><td align=\"center\"><a href=\"members/profile.php?id={$tid}\">$target</a></td><td align=\"center\"><a href=\"members/shoot.php?id={$id}\">Found in $tlocation</a></td></tr>");
} elseif ($find == 'no') {
echo ("<tr><td align=\"center\"><a href=\"members/profile.php?id={$tid}\">$target</a></td><td align=\"center\">The Hunt Failed. <a href=\"members/hremove.php?id={$id}\">Remove</a></td></tr>");
}
}
}
echo ("
</table>
<br />
<table>
<tr>
<td>
<form action=\"members/hunt.php\" method=\"post\">
Username: 
<input type=\"text\" name=\"target\" value=\"\" /> <br />
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
</div>");
include("members/footer.php");
}
?>