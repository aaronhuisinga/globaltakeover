<?php
$title="Game Statistics";
include("config.php");
include("header.php");
checks();

echo "<div id=\"crimestext\" align=\"center\"><h1>Game Statistics</h1>
<a href=\"mainstats.php\">Main Statistics</a> - <a href=\"fstats.php\">Forum Statistics</a> - <a href=\"cstats.php\">Corps Statistics</a> - <a href=\"propstats.php\">Property Statistics</a><br /> <a href=\"newest.php\">Newest Players</a> - <a href=\"lkills.php\">Latest Shootings</a> - <a href=\"lsuicides.php\">Latest Suicides</a> - <a href=\"lbans.php\">Latest Bans</a><br /><br />
<a href=\"treferrers.php\">Top Referrers</a><br />";

echo ("<table id=\"usertable\"><tr class=\"top\"><td align=\"center\" colspan=\"2\"><b>Top Alive Players</b></td></tr>
<tr><td align=\"center\"><b>Rank</b></td> <td align=\"center\"><b>Username</b></td></tr>");
$v = 0;
$query= mysql_query("SELECT id, username FROM Players WHERE dead='0' AND health > '0' AND Level = '0' AND banned = '0' ORDER BY exp DESC LIMIT 10;");
while($fetch = mysql_fetch_object($query)) {
$v = ($v + 1);
echo "<tr><td align=\"center\">$v</td><td align=\"center\"><b><a href=\"profile.php?id=$fetch->id\">$fetch->username</a></b></td></tr>";
}
echo "</table>";

echo ("
<table id=\"usertable\"><tr class=\"top\"><td align=\"center\" colspan=\"2\" id=\"needborder\"><b>Top Player Overall</b></td></tr>
<tr><td align=\"center\" id=\"needborder\"><b>Username</b></td></tr>");

$query= mysql_query("SELECT * FROM Players WHERE Level = '0' ORDER BY exp DESC LIMIT 1;");
while($fetch = mysql_fetch_object($query)) {

echo "<tr><td align=\"center\"><b><a href=\"profile.php?id=$fetch->id\">$fetch->username</a></b></td></tr>";
}

echo "</table></div>";
include("footer.php");
?>