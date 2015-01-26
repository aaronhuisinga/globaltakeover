<?
require_once("config.php");

$row=mysql_fetch_array(mysql_query("SELECT rrtime FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$original=$row[0];

$rrs = $current - $original;
$rrm = $rrs/60;
$rrmr = floor($rrm);
$rrh = $rrs/3600;
$rrhr = floor($rrh);
?>