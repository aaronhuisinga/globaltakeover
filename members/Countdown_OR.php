<?php
require_once("config.php");

$result=mysql_query("SELECT ortime FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		$row = mysql_fetch_array ($result, MYSQL_NUM);
		$ortime=$row[0];
		
		$ORsd = $ortime - $current;

		if ($ORsd > 60 AND $ORsd < 3600) {
		$tml= floor(($ORsd/60)+1);
		echo "<div id=\"crimestext\"><center>You cannot do another Robbery for $tml minutes.</center></div>";
		exit();
		} elseif ($ORsd > 3600) {
		$tml = floor((($ORsd/60)/60)+1);
		echo "<div id=\"crimestext\"><center>You cannot do another Robbery for $tml hours.</center></div>";
		exit();
		}
?>