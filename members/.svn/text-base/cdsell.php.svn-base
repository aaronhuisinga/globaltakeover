<?php
include("config.php");
include('Rank-ups.inc.php');
checks();

$result = mysql_query("SELECT health, username, corps FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$health = $row[0];
$user = $row[1];
$corp = addslashes($row[2]);

if ($_REQUEST['submit']) {
$sql = mysql_query("SELECT * FROM csvehicles WHERE corp = '$corp' AND type = 'd'");
$vs = 0;
while ($row = mysql_fetch_array($sql)) {
$mv = $row['price'];
$id = $row['carid'];
$tv = $tv + $mv;
$query = mysql_query("DELETE FROM cdock WHERE id = $id");
$vs = $vs + 1;
}
$query = mysql_query("SELECT money FROM Corps WHERE name='$corp'");
$row = mysql_fetch_array($query);
$m = $row[0];
$nm = $m + $tv;
$query = mysql_query("UPDATE Corps SET money='$nm' WHERE name='$corp'"); 
$date = (date("M d Y h:i:s A"));
$current = time();
mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$tv', '$date', '$user', 'Gain', '$current', 'Corp Boats S')");
$sql = mysql_query("DELETE FROM csvehicles WHERE corp = '$corp'");
echo "<div id = \"crimestext\" align=\"center\">You sold $vs Boats for a price of $".number_format($tv)."! <br /> $".number_format($nm)." was added to the Corp bank. <br /> <a href=\"corpdock.php\">Go Back</a></div>"; 
echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
exit();

} elseif ($_REQUEST['submit2']) {
$sql = mysql_query("DELETE FROM csvehicles WHERE corp = '$corp'");
echo "<div id = \"crimestext\" align=\"center\">No Boats were sold! <br /> <a href=\"corpdock.php\">Go Back</a></div>";
exit();
}