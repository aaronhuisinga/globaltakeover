<?php
require_once("config.php");

$sql = mysql_query("SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array($sql);
$u = $row[0];
$money = $row[1];
$query = "SELECT m_seconds, m_mins, m_hours, m_days, m_months, m_years, time FROM banking WHERE username='$u'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result, MYSQL_NUM);
// Define your target date here
	$time = $row[6];
	$targetYear= $row[5];
	$targetMonth= $row[4];
	$targetDay= $row[3];
	$targetHour= $row[2];
	$targetMinute= $row[1];
	$targetSecond= $row[0];
// End target date definition

// Define date format
$dateFormat = "Y-m-d H:i:s";

if ($time != NULL) {

$targetDate = mktime($targetHour,$targetMinute,$targetSecond,$targetMonth,$targetDay,$targetYear);
$actualDate = time();
$htim = $time*3600;

$ms = $actualDate - $targetDate;
$tl = $htim - $ms;
if ($ms != NULL) {
if ($ms < $time) {
} elseif ($tl <= 0) {
$result = mysql_query("SELECT amount, interestp FROM banking WHERE username='$u'");
$row = mysql_fetch_array ($result, MYSQL_NUM);
$am = $row[0];
$inter = $row[1];
$per = ($inter/100);
$percent = $per + 1;
$nam = $am * $percent;
$newm = $money + $nam;
$sql = mysql_query("UPDATE Players SET money='$newm' WHERE id='{$_COOKIE['id']}'");
$date = (date("M d Y h:i:s A"));
$current = time();
mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$nam', '$date', '$u', 'Gain', '$current', 'Bank Interest')");
echo "<div id=\"crimestext\" align=\"center\">You took $".number_format($nam)." out of the bank after interest! You now have $".number_format($newm)."!</div>";
echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
$sqld = mysql_query("DELETE FROM banking WHERE username='$u'");
}
} else {
}
}
?>