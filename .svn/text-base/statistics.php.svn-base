<?php
$title="Statistics";
require_once("members/config.php");
require_once("members/header.php");
?>
<div class="page-header"><h1>Statistics <small>Get the Lastest Numbers for You and the Game</small></h1></div>

<ul class="nav nav-pills">
  <li class="active">
    <a href="#main" data-toggle="tab">Main Stats</a>
  </li>
  <li><a href="#player" data-toggle="tab">Your Stats</a></li>
  <li><a href="#forum" data-toggle="tab">Forum Stats</a></li>
  <li><a href="#network" data-toggle="tab">Network Stats</a></li>
  <li><a href="#property" data-toggle="tab">Property Stats</a></li>
  <li><a href="#newest" data-toggle="tab">Newest Players</a></li>
  <li><a href="#kills" data-toggle="tab">Latest Kills</a></li>
  <li><a href="#suicides" data-toggle="tab">Latest Suicides</a></li>
  <li><a href="#bans" data-toggle="tab">Latest Bans</a></li>
  <li><a href="#referrers" data-toggle="tab">Top Referrers</a></li>
</ul>

<div class="tab-content">
	<div id="main" class="tab-pane active well">
		<h4>Top Alive Players</h4>
		<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Rank</th> <th>Username</th> <th>Total Exp</th>
			</tr>
		</thead>
		<tbody>
		<?
		$v = 0;
		$res=$mysqli->query("SELECT id, username, exp FROM Players WHERE dead='0' AND health > '0' AND Level = '0' AND banned = '0' ORDER BY exp DESC LIMIT 10;");
		while($row=$res->fetch_assoc()) {
			$v++;
			echo "<tr><td>$v</td> <td><a href=\"profile.php?id=$row[id]\">$row[username]</a></td> <td>$row[exp]</td></tr>";
		}
		?>
		</tbody>
		</table>
		<h4>Top Overall Players</h4>
		<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Rank</th> <th>Username</th> <th>Total Exp</th>
			</tr>
		</thead>
		<tbody>
		<?
		$v = 0;
		$res=$mysqli->query("SELECT id, username, exp FROM Players WHERE Level = '0' ORDER BY exp DESC LIMIT 10;");
		while($row=$res->fetch_assoc()) {
			$v++;
			echo "<tr><td>$v</td> <td><a href=\"profile.php?id=$row[id]\">$row[username]</a></td> <td>$row[exp]</td></tr>";
		}
		?>
		</tbody>
		</table>
		<?
		// gather money
		$res=$mysqli->query("SELECT SUM( money ) AS tpmoney FROM Players WHERE Level = '0' AND dead='0' AND banned='0'");
		$row=$res->fetch_array();
		$tpm = $row[0];
		$res=$mysqli->query("SELECT SUM( amount ) AS tbmoney FROM banking");
		$row=$res->fetch_array();
		$tbm = $row[0];
		$res=$mysqli->query("SELECT SUM( Till ) AS tbjmoney FROM BJT");
		$row=$res->fetch_array();
		$tbjm = $row[0];
		$res=$mysqli->query("SELECT SUM( money ) AS tcmoney FROM Corps WHERE id != '1'");
		$row=$res->fetch_array();
		$tcm = $row[0];
		$res=$mysqli->query("SELECT SUM( Till ) AS trlmoney FROM roulette");
		$row=$res->fetch_array();
		$trlm = $row[0];
		$res=$mysqli->query("SELECT SUM( Till ) AS twmoney FROM WT WHERE Playown = '1'");
		$row=$res->fetch_array();
		$twm = $row[0];
		$tm=($tpm + $tbm + $tbjm + $tcm + $trlm + $twm);
		// gather alive/dead accounts
		$res=$mysqli->query("SELECT COUNT(id) as total FROM Players WHERE dead != 0");
		$row=$res->fetch_array();
		$td = $row[0];
		$res=$mysqli->query("SELECT COUNT(id) as total FROM Players");
		$row=$res->fetch_array();
		$ta = $row[0];
		// gather bullets
		$res=$mysqli->query("SELECT SUM( bullets ) AS tbullets FROM Players WHERE Level = '0' AND dead='0' AND banned='0'");
		$row=$res->fetch_array();
		$tpb = $row[0];
		$res=$mysqli->query("SELECT SUM( bullets ) AS tcbullets FROM Corps WHERE id != '1'");
		$row=$res->fetch_array();
		$tcb = $row[0];
		$tb = ($tpb + $tcb);
		// gather tokens
		$res=$mysqli->query("SELECT SUM( tokens ) AS tt FROM Players WHERE Level = '0' AND dead='0' AND banned='0'");
		$row=$res->fetch_array();
		$tpt = $row[0];
		$res=$mysqli->query("SELECT SUM( tokens ) AS tct FROM Corps WHERE id != '1'");
		$row=$res->fetch_array();
		$tct = $row[0];
		$tt = ($tpt + $tct);
		// gather more player info
		$res=$mysqli->query("SELECT COUNT( id ) AS td FROM Players WHERE rank='18'");
		$row=$res->fetch_array();
		$tdd = $row[0];
		$res=$mysqli->query("SELECT COUNT(id) AS tbb FROM Players WHERE banned='1'");
		$row=$res->fetch_array();
		$tbb = $row[0];
		$res=$mysqli->query("SELECT COUNT(id) AS taccounts FROM Players WHERE `active` != NULL");
		$row=$res->fetch_array();
		$tia = $row[0];
		$tl = $ta - ($tbb + $td + $tia);
		// gather player activity stats
		$day=(time()-86400);
		$twodays=(time()-172800);
		$week=(time()-604800);
		$month=(time()-2592000);
		$res=$mysqli->query("SELECT COUNT(*) FROM Players WHERE `online`>=$day");
		$actived=$res->num_rows;
		$res=$mysqli->query("SELECT COUNT(*) FROM Players WHERE `online`>=$twodays");
		$activetd=$res->num_rows;
		$res=$mysqli->query("SELECT id FROM Players WHERE `online`>=$week");
		$activew=$res->num_rows;
		$res=$mysqli->query("SELECT id FROM Players WHERE `online`>=$month");
		$activem=$res->num_rows;
		?>
		<h4>Game Statistics</h4>
		<table class="table table-bordered table-striped">
		<thead>
			<tr><th>Category</th> <th>Value</th></tr>
		</thead>
		<tbody>
			<tr><td>Total Money</td> <td><? echo "$".number_format($tm); ?></td></tr>
			<tr><td>Total Bullets</td> <td><? echo number_format($tb); ?></td></tr>
			<tr><td>Total Tokens</td> <td><? echo number_format($tt); ?></td></tr>
			<tr><td>Total Accounts</td> <td><? echo number_format($ta); ?></td></tr>
			<tr><td>Total Active Accounts</td> <td><? echo number_format($tl); ?></td></tr>
			<tr><td>Total Dead Accounts</td> <td><? echo number_format($td); ?></td></tr>
			<tr><td>Total Banned Accounts</td> <td><? echo number_format($tbb); ?></tr></td>
			<tr><td>Total GOTAs</td> <td><? echo number_format($tdd); ?></td></tr>
		</tbody>
		</table>
		
		<h4>Activity Statistics</h4>
		<table class="table table-bordered table-striped">
		<thead>
			<tr><th>Category</th> <th>Value</th></tr>
		</thead>
		<tbody>
			<tr><td>Players active in last Day</td> <td><? echo number_format($actived); ?></td></tr>
			<tr><td>Players active in last 2 Days</td> <td><? echo number_format($activetd) ?></td></tr>
			<tr><td>Players active in last Week</td> <td><? echo number_format($activew); ?></td></tr>
			<tr><td>Players active in last Month</td> <td><? echo number_format($activem); ?></td></tr>
		</tbody>
		</table>
	</div>
	
	<div id="player" class="tab-pane well">
		<?
		$res=$mysqli->query("SELECT breaks, sbreaks, exp, wins, losses, referrals FROM Players WHERE id='$_COOKIE[id]' LIMIT 1;");
		$row=$res->fetch_assoc();
		$u=$_COOKIE['username'];
		?>
		<h4>Your Statistics</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Category</th> <th>Value</th></tr>
		</thead>
		<tbody>
			<tr><td>Total Exp Earned</td> <td><? echo $row['exp']; ?></td></tr>
			<tr><td>Attempted Breaks</td> <td><? echo $row['breaks']; ?></td></tr>
			<tr><td>Successful Breaks</td> <td><? echo $row['sbreaks']; ?></td></tr>
			<tr><td>Gym Wins</td> <td><? echo $row['wins']; ?></td></tr>
			<tr><td>Gym Losses</td> <td><? echo $row['losses']; ?></td></tr>
			<tr><td>Referrals</td> <td><? echo $row['referrals']; ?></td></tr>
		</tbody>
		</table>
		<h4>Your Kills</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Username</th> <th>Rank</th> <th>Bullets Shot</th> <th>Date of Kill</th></tr>
		</thead>
		<tbody>
			<?
			$gather=$mysqli->query("SELECT target, trank, bullets, date FROM kills WHERE shooter='$u'");
			while ($row=$gather->fetch_assoc()){
				$res=$mysqli->query("SELECT id FROM Players WHERE username='$target' LIMIT 1");
				$row1=$res->fetch_assoc();	
				echo "<tr><td><a href=\"profile.php?id=$row1[tid]\">$row[target]</a></td> <td>$row[trank]</td> <td>".number_format($row['bullets'])."</td> <td>$row[date]</td></tr>";
			}
			?>
		</tbody>
		</table>
	</div>
	
	<div id="forum" class="tab-pane well">
		<?
		$res=$mysqli->query("SELECT COUNT(id), SUM(view) FROM thread");
		$row=$res->fetch_array();
		$threads=$row[0];
		$views=$row[1];
		$res=$mysqli->query("SELECT COUNT(id) FROM reply");
		$row=$res->fetch_array();
		$replies=$row[0];
		$res=$mysqli->query("SELECT COUNT(id) FROM post");
		$row=$res->fetch_array();
		$posts=$row[0];
		$res=$mysqli->query("SELECT SUM(posts) FROM Players WHERE posts!='0'");
		$row=$res->fetch_array();
		$tposts=$row[0];
		?>
		<h4>Forum Statistics</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Category</th> <th>Value</th></tr>
		</thead>
		<tbody>
			<tr><td>Current Threads</td> <td><? echo number_format($threads); ?></td></tr>
			<tr><td>Current Replies</td> <td><? echo number_format($replies); ?></td></tr>
			<tr><td>Current Posts</td> <td><? echo number_format($posts); ?></td></tr>
			<tr><td>Current Thread Views</td> <td><? echo number_format($views); ?></td></tr>
			<tr><td>Total Posts</td> <td><? echo number_format($tposts); ?></td></tr>
		</tbody>
		</table>
		
		<h4>Top Posters</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Rank</th> <th>Username</th> <th>Posts</th></tr>
		</thead>
		<tbody>
			<?
			$v=0;
			$res=$mysqli->query("SELECT id, username, posts FROM Players ORDER BY posts DESC LIMIT 10;");
			while($row=$res->fetch_array()) {
				$v++;
				echo "<tr><td>$v</td><td><a href=\"profile.php?id=$row[0]\">$row[1]</a></td><td>$row[2]</td></tr>";
			}
			?>
		</tbody>
		</table>
	</div>
	
	<div id="network" class="tab-pane well">
		<h4>Network Statistics</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Name</th> <th>Leader</th> <th>Recruiting</th> <th>Members</th></tr>
		</thead>
		<tbody>
			<?
			$res=$mysqli->query("SELECT name, owner, id, recruit FROM Corps ORDER BY id ASC");
			while ($row=$res->fetch_assoc()) {
				$res=$mysqli->query("SELECT COUNT(id) AS taccounts FROM Players WHERE corps='$row[id]'");
				$members=$res->fetch_array();
				$res=$mysqli->query("SELECT username FROM Players WHERE id='$row[owner]' LIMIT 1;");
				$uname=$res->fetch_array();
				$rstatus=($row['recruit'] == 1 ? 'Recruiting' : 'Not Recruiting');
				echo "<tr>
						   <td><a href=\"network.php?id=$row[id]\">$row[name]</a></td>
					       <td><a href=\"profile.php?id=$row[owner]\">$uname[0]</a></td>
					       <td>$rstatus</td>
					       <td>$members[0]</td>
					  </tr>";
			}
			?>
		</tbody>
		</table>
	</div>
	
	<div id="newest" class="tab-pane well">
		<h4>Newest Players</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Username</th> <th>Time Registered</th></tr>
		</thead>
		<tbody>
			<?
			$res=$mysqli->query("SELECT id, username, registration_date FROM Players ORDER BY id DESC LIMIT 10");
			while ($row=$res->fetch_array()){
				echo ("<tr><td><a href=\"profile.php?id=$row[id]\">$row[username]</a></td><td>$row[registration_date]</td></tr>");
			}
			?>
		</tbody>
		</table>
	</div>
	
	<div id="kills" class="tab-pane well">
		<h4>Latest Kills</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Username</th> <th>Rank</th> <th>Time of Death</th></tr>
		</thead>
		<tbody>
			<?
			$res=$mysqli->query("SELECT username, id, tdeath, rank FROM Players WHERE dead='2' ORDER BY td DESC LIMIT 10");
			while($row=$res->fetch_array()){
				echo ("<tr><td><a href=\"profile.php?id=$row[id]\">$row[username]</a></td><td>$row[rank]</td><td>$row[tdeath]</td></tr>");
			}
			?>
		</tbody>
		</table>
	</div>
	
	<div id="suicides" class="tab-pane well">
		<h4>Latest Suicides</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Username</th> <th>Rank</th> <th>Time of Death</th></tr>
		</thead>
		<tbody>
			<?
			$res=$mysqli->query("SELECT username, id, tdeath, rank FROM Players WHERE dead='1' ORDER BY td DESC LIMIT 10");
			while($row=$res->fetch_array()){
				echo ("<tr><td><a href=\"profile.php?id=$row[id]\">$row[username]</a></td><td>$row[rank]</td><td>$row[tdeath]</td></tr>");
			}
			?>
		</tbody>
		</table>
	</div>
	
	<div id="bans" class="tab-pane well">
		<h4>Latest Bans</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Username</th> <th>Rank</th> <th>Time of Ban</th></tr>
		</thead>
		<tbody>
			<?
			$res=$mysqli->query("SELECT username, id, rank, bdate FROM Players WHERE banned='1' ORDER BY bd DESC LIMIT 10");
			while($row=$res->fetch_array()){
				echo ("<tr><td><a href=\"profile.php?id=$row[id]\">$row[username]</a></td><td>$row[rank]</td><td>$row[bdate]</td></tr>");
			}
			?>
		</tbody>
		</table>
	</div>
	
	<div id="referrers" class="tab-pane well">
		<h4>Top Referring Players</h4>
		<table class="table table-striped table-bordered">
		<thead>
			<tr><th>Username</th> <th>Referrals</th></tr>
		</thead>
		<tbody>
			<?
			$res=$mysqli->query("SELECT referrals, id, username FROM Players WHERE referrals > 0 ORDER BY referrals DESC LIMIT 10;");
			while($row=$res->fetch_array()) {
				echo "<tr><td><a href=\"profile.php?id=$row[1]\">$row[2]</a></td><td>$row[0]</td></tr>";
			}
			?>
		</tbody>
		</table>
	</div>
	
	<div id="property" class="tab-pane well">
		<?
		// Get the property owners
		$countries=array('Australia','UK','Russia','USA','Philippines');
		$props=array('airport','port','BF','wf','Bank','BJT','roulette','WT');
		$casinos=array('BJT','roulette','WT');
		foreach($countries as $x) {
			foreach($props as $y) {
				$prop=$x.$y;
				$oid=$x.$y."id";
				$res=$mysqli->query("SELECT `owner` FROM `$y` WHERE `location` = '$x' LIMIT 1");
				$row=$res->fetch_array();
				$$prop=$row[0];
				$res=$mysqli->query("SELECT `id` FROM `Players` WHERE `username` = '${$prop}' LIMIT 1");
				$row=$res->fetch_array();
				$$oid=$row[0];
				// echo "$y $x - ".${$prop}." id =".${$oid}."<br>";
			}
		}
		// Get our Bullet Prices
		foreach($countries as $x) {
			$bprice=$x."bp";
			$res=$mysqli->query("SELECT `Bp` FROM `BF` WHERE `location` = '$x' LIMIT 1");
			$row=$res->fetch_array();
			$$bprice=$row[0];
		}
		// Get min and max bets for casino
		foreach($countries as $x) {
			foreach($casinos as $y) {
				$min=$x.$y.'min';
				$max=$x.$y.'max';
				$res=$mysqli->query("SELECT `Mn_bd`, `Mx_bd` FROM `$y` WHERE `location` = '$x' LIMIT 1");
				$row=$res->fetch_array();
				$$min=$row[0];
				$$max=$row[1];
			}
		}
		?>
		<h4>Property Owners</h4>
		<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr><th>Location</th><th>Airport</th><th>Port</th><th>Bullet Factory</th><th>Weapon Factory</th><th>Bank</th><th>Blackjack</th><th>Roulette</th><th>War</th></tr>
		</thead>
		<tbody>
			<tr><td>Australia</td><? echo "<td><a href=\"profile.php?id=$Australiaairportid\">$Australiaairport</a></td><td><a href=\"profile.php?id=$Australiaportid\">$Australiaport</a></td><td><a href=\"profile.php?id=$AustraliaBFid\">$AustraliaBF</a></td><td><a href=\"profile.php?id=$Australiawfid\">$Australiawf</a></td><td><a href=\"profile.php?id=$AustraliaBankid\">$AustraliaBank</a></td><td><a href=\"profile.php?id=$AustraliaBJTid\">$AustraliaBJT</a></td><td><a href=\"profile.php?id=$Australiarouletteid\">$Australiaroulette</a></td><td><a href=\"profile.php?id=$AustraliaWTid\">$AustraliaWT</a></td>"; ?></tr>
			<tr><td>UK</td><? echo "<td><a href=\"profile.php?id=$UKairportid\">$UKairport</a></td><td><a href=\"profile.php?id=$UKportid\">$UKport</a></td><td><a href=\"profile.php?id=$UKBFid\">$UKBF</a></td><td><a href=\"profile.php?id=$UKwfid\">$UKwf</a></td><td><a href=\"profile.php?id=$UKBankid\">$UKBank</a></td><td><a href=\"profile.php?id=$UKBJTid\">$UKBJT</a></td><td><a href=\"profile.php?id=$UKrouletteid\">$UKroulette</a></td><td><a href=\"profile.php?id=$UKWTid\">$UKWT</a></td>"; ?></tr>
			<tr><td>Russia</td><? echo "<td><a href=\"profile.php?id=$Russiaairportid\">$Russiaairport</a></td><td><a href=\"profile.php?id=$Russiaportid\">$Russiaport</a></td><td><a href=\"profile.php?id=$RussiaBFid\">$RussiaBF</a></td><td><a href=\"profile.php?id=$Russiawfid\">$Russiawf</a></td><td><a href=\"profile.php?id=$RussiaBankid\">$RussiaBank</a></td><td><a href=\"profile.php?id=$RussiaBJTid\">$RussiaBJT</a></td><td><a href=\"profile.php?id=$Russiarouletteid\">$Russiaroulette</a></td><td><a href=\"profile.php?id=$RussiaWTid\">$RussiaWT</a></td>"; ?></tr>
			<tr><td>USA</td><? echo "<td><a href=\"profile.php?id=$USAairportid\">$USAairport</a></td><td><a href=\"profile.php?id=$USAportid\">$USAport</a></td><td><a href=\"profile.php?id=$USABFid\">$USABF</a></td><td><a href=\"profile.php?id=$USAwfid\">$USAwf</a></td><td><a href=\"profile.php?id=$USABankid\">$USABank</a></td><td><a href=\"profile.php?id=$USABJTid\">$USABJT</a></td><td><a href=\"profile.php?id=$USArouletteid\">$USAroulette</a></td><td><a href=\"profile.php?id=$USAWTid\">$USAWT</a></td>"; ?></tr>
			<tr><td>Philippines</td><? echo "<td><a href=\"profile.php?id=$Philippinesairportid\">$Philippinesairport</a></td><td><a href=\"profile.php?id=$Philippinesportid\">$Philippinesport</a></td><td><a href=\"profile.php?id=$PhilippinesBFid\">$PhilippinesBF</a></td><td><a href=\"profile.php?id=$Philippineswfid\">$Philippineswf</a></td><td><a href=\"profile.php?id=$PhilippinesBankid\">$PhilippinesBank</a></td><td><a href=\"profile.php?id=$PhilippinesBJTid\">$PhilippinesBJT</a></td><td><a href=\"profile.php?id=$Philippinesrouletteid\">$Philippinesroulette</a></td><td><a href=\"profile.php?id=$PhilippinesWTid\">$PhilippinesWT</a></td>"; ?></tr>
		</tbody>
		</table>
		<h4>Bullet Prices</h4>
		<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr><th>Location</th><th>Owner</th><th>Bullet Price</th></tr>
		</thead>
		<tbody>
			<tr><td>Australia</td><? echo "<td><a href=\"profile.php?id=$AustraliaBFid\">$AustraliaBF</a></td><td>$".number_format($Australiabp)."</td></tr>"; ?>
			<tr><td>UK</td><? echo "<td><a href=\"profile.php?id=$UKBFid\">$UKBF</a></td><td>$".number_format($UKbp)."</td></tr>"; ?>
			<tr><td>Russia</td><? echo "<td><a href=\"profile.php?id=$RussiaBFid\">$RussiaBF</a></td><td>$".number_format($Russiabp)."</td></tr>"; ?>
			<tr><td>USA</td><? echo "<td><a href=\"profile.php?id=$USABFid\">$USABF</a></td><td>$".number_format($USAbp)."</td></tr>"; ?>
			<tr><td>Philippines</td><? echo "<td><a href=\"profile.php?id=$PhilippinesBFid\">$PhilippinesBF</a></td><td>$".number_format($Philippinesbp)."</td></tr>"; ?>
		</tbody>
		</table>
		<h4>Blackjack Min/Max Bets</h4>
		<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr><th>Location</th><th>Owner</th><th>Min Bet</th><th>Max Bet</th></tr>
		</thead>
		<tbody>
			<tr><td>Australia</td><? echo "<td><a href=\"profile.php?id=$AustraliaBJTid\">$AustraliaBJT</a></td><td>$".number_format($AustraliaBJTmin)."</td><td>$".number_format($AustraliaBJTmax)."</td></tr>"; ?>
			<tr><td>UK</td><? echo "<td><a href=\"profile.php?id=$UKBJTid\">$UKBJT</a></td><td>$".number_format($UKBJTmin)."</td><td>$".number_format($UKBJTmax)."</td></tr>"; ?>
			<tr><td>Russia</td><? echo "<td><a href=\"profile.php?id=$RussiaBJTid\">$RussiaBJT</a></td><td>$".number_format($RussiaBJTmin)."</td><td>$".number_format($RussiaBJTmax)."</td></tr>"; ?>
			<tr><td>USA</td><? echo "<td><a href=\"profile.php?id=$USABJTid\">$USABJT</a></td><td>$".number_format($USABJTmin)."</td><td>$".number_format($USABJTmax)."</td></tr>"; ?>
			<tr><td>Philippines</td><? echo "<td><a href=\"profile.php?id=$PhilippinesBJTid\">$PhilippinesBJT</a></td><td>$".number_format($PhilippinesBJTmin)."</td><td>$".number_format($PhilippinesBJTmax)."</td></tr>"; ?>
		</tbody>
		</table>
		<h4>War Min/Max Bets</h4>
		<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr><th>Location</th><th>Owner</th><th>Min Bet</th><th>Max Bet</th></tr>
		</thead>
		<tbody>
			<tr><td>Australia</td><? echo "<td><a href=\"profile.php?id=$AustraliaWTid\">$AustraliaWT</a></td><td>$".number_format($AustraliaWTmin)."</td><td>$".number_format($AustraliaWTmax)."</td></tr>"; ?>
			<tr><td>UK</td><? echo "<td><a href=\"profile.php?id=$UKWTid\">$UKWT</a></td><td>$".number_format($UKWTmin)."</td><td>$".number_format($UKWTmax)."</td></tr>"; ?>
			<tr><td>Russia</td><? echo "<td><a href=\"profile.php?id=$RussiaWTid\">$RussiaWT</a></td><td>$".number_format($RussiaWTmin)."</td><td>$".number_format($RussiaWTmax)."</td></tr>"; ?>
			<tr><td>USA</td><? echo "<td><a href=\"profile.php?id=$USAWTid\">$USAWT</a></td><td>$".number_format($USAWTmin)."</td><td>$".number_format($USAWTmax)."</td></tr>"; ?>
			<tr><td>Philippines</td><? echo "<td><a href=\"profile.php?id=$PhilippinesWTid\">$PhilippinesWT</a></td><td>$".number_format($PhilippinesWTmin)."</td><td>$".number_format($PhilippinesWTmax)."</td></tr>"; ?>
		</tbody>
		</table>
		<h4>Roulette Min/Max Bets</h4>
		<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr><th>Location</th><th>Owner</th><th>Min Bet</th><th>Max Bet</th></tr>
		</thead>
		<tbody>
			<tr><td>Australia</td><? echo "<td><a href=\"profile.php?id=$Australiarouletteid\">$Australiaroulette</a></td><td>$".number_format($Australiaroulettemin)."</td><td>$".number_format($Australiaroulettemax)."</td></tr>"; ?>
			<tr><td>UK</td><? echo "<td><a href=\"profile.php?id=$UKrouletteid\">$UKroulette</a></td><td>$".number_format($UKroulettemin)."</td><td>$".number_format($UKroulettemax)."</td></tr>"; ?>
			<tr><td>Russia</td><? echo "<td><a href=\"profile.php?id=$Russiarouletteid\">$Russiaroulette</a></td><td>$".number_format($Russiaroulettemin)."</td><td>$".number_format($Russiaroulettemax)."</td></tr>"; ?>
			<tr><td>USA</td><? echo "<td><a href=\"profile.php?id=$USArouletteid\">$USAroulette</a></td><td>$".number_format($USAroulettemin)."</td><td>$".number_format($USAroulettemax)."</td></tr>"; ?>
			<tr><td>Philippines</td><? echo "<td><a href=\"profile.php?id=$Philippinesrouletteid\">$Philippinesroulette</a></td><td>$".number_format($Philippinesroulettemin)."</td><td>$".number_format($Philippinesroulettemax)."</td></tr>"; ?>
		</tbody>
		</table>
	</div>
</div>
<? require_once("members/footer.php"); ?>