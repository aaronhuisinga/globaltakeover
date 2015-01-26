<?php
$title="Rank Bar";
include("members/config.php");
checks();
online();
include("members/header.php");

$res=$mysqli->query("SELECT exp, rankbar, rank, prison_rank, breaks, money FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_array();
$exp = $row[0];
$rankbar = $row[1];
$rank = $row[2];
$prank = $row[3];
$breaks = $row[4];
$money = $row[5];

$arrank=array('Recruit','Private','Specialist','Sergeant','Staff Sergeant','Master Sergeant','Sergeant Major','Second Lieutenant','First Lieutenant','Captain','Major','Lientenant Colonel','Colonel','Brigadier General','Major General','Lieutenant General','General','General of the Army');
$pTitle=$arrank[($rank-1)];
	
$authenticated=0;
if ($_REQUEST['buy']) {
	if ($money > 2499999) {
		$mysqli->query("UPDATE Players SET money=(money-2500000) WHERE id='$_COOKIE[id]' LIMIT 1");
		$authenticated=1;
	} else {
		echo "<div id=\"ltable\" align=\"center\">You do not have enough money to view your Rank Bar! You must have $2,500,000!<br />
			  Alternatively, you can buy a Rank Bar for 20 Tokens from <a href=\"tokens.php\">here.</a></div>";
		include("members/footer.php");
		exit();
	}
}
	
if ($rankbar == '0' AND $rank != 'Wannabe' AND $rank != 'Recruit' AND $rank != 'Private' AND $rank != 'Soldier' AND $rank != 'Mercenary' AND $authenticated != 1) {
	?>
	<div class="page-header"><h1>Rankbar <small>Track your progress</small></h1></div>
	<p>You have not yet purchased a rank bar. If you have 20 Tokens to purchase one with, or wish to find out how to get Tokens, please go to the <a href="tokens.php">Tokens page.</a><br />
	View your Rank Bar once for $2,500,000! <form action="rankbar.php" method="POST"><input type="submit" name="buy" value="Check Your Rank"></form></div>
	<?
	include("members/footer.php");
	exit;
}
	if($rank != 18) {
		$ranks=array(150,650,2650,10150,22650,50150,85150,137150,214650,309650,430150,585150,780150,1005650,1300650,1675650,2200000);
		$last=$ranks[($rank-2)];
		$next=$ranks[($rank-1)];
		$rp=round(100*($exp-$last)/$next, 2);
	} else {
		$dic=1;
	}
	if($prank != 15) {
		$ranks=array(10,30,60,120,240,400,600,850,1000,1200,1400,1600,1800,3000,5000);
		$last=$ranks[($prank-2)];
		$next=$ranks[($prank-1)];
		$prp=round(100*($breaks-$last)/$next, 2);
	} else {
		$finprison=1;
	}
	?>
	<div class="page-header"><h1>Rankbar <small>Track your progress</small></h1></div>
		<div class="well">
			<h4>Rank Progress</h4>
			<? if($dic != 1) { ?>
			<p>Your current rank is <? echo $pTitle; ?>, and you are <? echo $rp; ?>% towards your next rank. Work hard and the next rank will be yours.</p>
			<div class="progress progress-striped">
				<div class="bar" style="width: <? echo $rp; ?>%;"></div>
			</div>
			<? } else { ?>
			<p>Congratulations! You have reached the final rank of General of the Army. Now try and stay here.</p>
			<? } ?>
		</div>
		<div class="well">
			<h4>Jail Rank Progress</h4>
			<? if ($finprison != 1) { ?>
			<p>You're currently at rank <? echo $prank; ?>, and you are <? echo $prp; ?>% towards the next. Keep breaking and the next rank will be yours.</p>
			<div class="progress progress-striped">
				<div class="bar" style="width: <? echo $prp; ?>%;"></div>
			</div>
			<? } else { ?>
			<p>Congratulations! You have reached the final Jail breaking rank!</p>
			<? } ?>
		</div> 
	<? include("members/footer.php"); ?>