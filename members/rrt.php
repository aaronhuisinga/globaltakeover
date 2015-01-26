<?
require_once ("config.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT rrtime FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$original=$row[0];

$rrs = $current - $original;
$rrm = $rrs/60;
$rrmr = floor($rrm);
$rrh = $rrs/3600;
$rrhr = floor($rrh);

	if ($rrmr < 1380) {
		$hl = 24 - $rrhr;
		echo "<div id=\"crimestext\"><center>You can only do an Russian Roulette every 24 hours! You have to wait another $hl hours.</center></div>";
		exit();
	} elseif ($rrmr > 1379 AND $rrmr < 1441) {
		$hl = 1440 - $rrmr;
		echo "<div id=\"crimestext\"><center>You can only do an Russian Roulette every 24 hours! You have to wait another $hl minutes.</center></div>";
		exit();
	}	
?>