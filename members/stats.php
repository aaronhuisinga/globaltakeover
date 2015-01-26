<?php
require_once('config.php');

if (isset($_COOKIE['id'])) {
	$stmt=$pdo->prepare('SELECT money, location, bullets, health, armor, rank, tokens FROM Players WHERE id= :id LIMIT 1');
	$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_NUM);
	$location=$row[1];
	
	$arrank=array('Recruit','Private','Specialist','Sergeant','Staff Sergeant','Master Sergeant','Sergeant Major','Second Lieutenant','First Lieutenant','Captain','Major','Lientenant Colonel','Colonel','Brigadier General','Major General','Lieutenant General','General','General of the Army');
	$rank=$arrank[($row[5]-1)];
		
	echo "<i class=\"icon-refresh icon-white\" onclick=\"reload_stats()\"></i> Health <span class=\"label\">$row[3]</span> Armor <span class=\"label\">$row[4]</span> Money <span class=\"label\">&#36;".number_format($row[0])."</span> Bullets <span class=\"label\">".number_format($row[2])."</span> Tokens <span class=\"label\">".number_format($row[6])."</span> Rank <span class=\"label\">$rank</span> Network <span class=\"label\">$_COOKIE[network]</span> Location <span class=\"label\">$row[1]</span>";
}
?>