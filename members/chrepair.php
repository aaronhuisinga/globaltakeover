<?php
include("config.php");
include('Rank-ups.inc.php');
include("Bf release.php");
checks();

$result = mysql_query("SELECT username, corps, money FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$user = $row[0];
$corp = addslashes($row[1]);
$m = $row[2];

if ($_REQUEST['submit']) {
$sql = mysql_query("SELECT SUM( price ) AS tpm FROM crvehicles WHERE corp = '$corp' AND type = 'h'");
$row = mysql_fetch_array ($sql);
$tpm = $row[0];
if ($m < $tpm) {
$sql = mysql_query("DELETE FROM crvehicles WHERE corp = '$corp'");
echo "<div id = \"crimestext\" align=\"center\">You do not have enough money for all repairs! <br /> <a href=\"corphanger.php\">Go Back.</a></div>";
exit();
}

$sql = mysql_query("SELECT * FROM crvehicles WHERE corp = '$corp' AND type = 'h'");
$vs = 0;
while ($row = mysql_fetch_array($sql)) {
$mv = $row['price'];
$id = $row['carid'];
$tv = $tv + $mv;
$query = mysql_query("UPDATE changer SET percent = 100 WHERE id = '$id'");
$vs = $vs + 1;
}
$query = mysql_query("SELECT money FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array($query);
$m = $row[0];
$nm = $m - $tv;
$query = mysql_query("UPDATE Players SET money='$nm' WHERE id='{$_COOKIE['id']}'"); 
$date = (date("M d Y h:i:s A"));
$current = time();
mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$tv', '$date', '$user', 'Loss', '$current', 'Corp Planes R')");
$sql = mysql_query("DELETE FROM crvehicles WHERE corp = '$corp'");
echo "<div id = \"crimestext\" align=\"center\">You repaired $vs Planes for a price of $".number_format($tv)."! <br /> You now have $".number_format($nm)."<br><a href=\"corphanger.php\">Go Back.</a></div>"; 
echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
exit();

} elseif ($_REQUEST['submit2']) {
$sql = mysql_query("DELETE FROM crvehicles WHERE corp = '$corp'");
echo "<div id = \"crimestext\" align=\"center\">No Planes were repaired!<br /><a href=\"corphanger.php\">Go Back.</a></div>";
exit();
}
?>