<?php
require_once("members/config.php");
checks();
online();
$title="Blackjack";

$res=$mysqli->query("SELECT `location`, `money` FROM Players WHERE `id`='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_array();
$location=$row[0];
$money=$row[1];
$bjcheck=$mysqli->query("SELECT `Till` FROM BJT WHERE `Owner` = '$_COOKIE[username]' LIMIT 1");
$ownTill=$bjcheck->fetch_array();
$res=$mysqli->query("SELECT `Owner`,`Till`,`Mn_bd`,`Mx_bd` FROM BJT WHERE `location` = '$location' LIMIT 1");
$bjt=$res->fetch_assoc();
$res=$mysqli->query("SELECT `id`,`avatar` FROM Players WHERE `username`='$bjt[Owner]' LIMIT 1");
$row=$res->fetch_array();
$oid=$row[0];
$oav=$row[1];

if(isset($_POST['result']) AND isset($_POST['amount'])) {
	$amt=$_POST['amount'];
	if($_POST['result'] == 'PUSH') {
		exit();
	} elseif($amt > $bjt['Mx_bd'] OR $amt < $bjt['Mn_bd'] OR $amt > $money) {
		// Invalid Bet
		exit();
	} elseif($amt > $bjt['Till'] AND $_POST['result'] == 'YOU WIN') {
		// Bankrupted the table
		if($bjcheck->num_rows > 0) {
			$mysqli->query("UPDATE `Players` SET `money`=(money+$bjt[Till]) WHERE `id`='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("UPDATE `BJT` SET `Till`='100',`Mn_bd`='1',`Mx_bd`='1',`Owner`='None',`profit`='0' WHERE `location`='$location' LIMIT 1");
			echo "The owner couldn't afford to pay off the bet, and the table bankrupted! Since you own a table, it is now up for grabs!";
		} else {
			$mysqli->query("UPDATE `Players` SET `money`=(money+$bjt[Till]) WHERE `id`='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("UPDATE `BJT` SET `Till`='100',`Mn_bd`='1',`Mx_bd`='1',`Owner`='$_COOKIE[username]',`profit`='0' WHERE `location`='$location' LIMIT 1");
			echo "The owner couldn't afford to pay off the bet, and the table bankrupted! You are the new owner!";
		}
	} else {
		if($_POST['result'] == 'YOU WIN') {
			$mysqli->query("UPDATE `Players` SET `money`=(money+$amt) WHERE `id`='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("UPDATE `BJT` SET `Till`=(Till-$amt), `profit`=(profit-$amt) WHERE `location`='$location' LIMIT 1");
		} elseif($_POST['result'] == 'BlackJack') {
			$bj=$_POST['amount']*2;
			$mysqli->query("UPDATE `Players` SET `money`=(money+$bj) WHERE `id`='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("UPDATE `BJT` SET `Till`=(Till-$bj), `profit`=(profit-$bj) WHERE `location`='$location' LIMIT 1");
		} else {
			$taxed=$_POST['amount']-($_POST['amount']*.06);
			$mysqli->query("UPDATE `Players` SET `money`=(money-$amt) WHERE `id`='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("UPDATE `BJT` SET `Till`=(Till+$taxed), `profit`=(profit+$taxed) WHERE `location`='$location' LIMIT 1");
		}
	}
	exit();
}
require_once("members/header.php");

if(isset($_POST['addTill']) OR isset($_POST['withdrawTill'])) {
	if($_POST['addTill'] != '') {
		if($_POST['addTill'] > $money) {
			echo '<div class="alert alert-error">You do not have enough money to do this.</div>';
		} else {
			$mysqli->query("UPDATE BJT SET `Till`=(Till+$_POST[addTill]) WHERE `Owner`='$_COOKIE[username]' LIMIT 1");
			$mysqli->query("UPDATE Players SET `money`=(money-$_POST[addTill]) WHERE `id`='$_COOKIE[id]' LIMIT 1");
			echo "<div class=\"alert alert-success\">Successfully added $".number_format($_POST['addTill'])." to your till balance</div>";
		}
	} elseif($_POST['withdrawTill'] != '') {
		if($_POST['withdrawTill'] > ($ownTill[0]+1)) {
			echo '<div class="alert alert-error">There is not enough money in the till for this.</div>';
		} else {
			$mysqli->query("UPDATE BJT SET `Till`=(Till-$_POST[withdrawTill]) WHERE `Owner`='$_COOKIE[username]' LIMIT 1");
			$mysqli->query("UPDATE Players SET `money`=(money+$_POST[withdrawTill]) WHERE `id`='$_COOKIE[id]' LIMIT 1");
			echo "<div class=\"alert alert-success\">Successfully withdrew $".number_format($_POST['withdrawTill'])." from your till balance</div>";
		}
	}
} elseif (isset($_POST['minbet']) OR isset($_POST['maxbet'])) {
	if($_POST['minbet'] != '') {
		if($_POST['minbet'] < 1) {
			echo '<div class="alert alert-error">You must set a minimum bet over $1</div>';
		} else {
			$mysqli->query("UPDATE BJT SET `Mn_bd`='$_POST[minbet]' WHERE `Owner`='$_COOKIE[username]' LIMIT 1");
			echo "<div class=\"alert alert-success\">Successfully changed the minimum bet to $".number_format($_POST['minbet'])."</div>";
		}
	} elseif($_POST['maxbet'] != '') {
		if($_POST['maxbet'] > 1000000000) {
			echo '<div class="alert alert-error">The maximum bet cannot be over $1,000,000,000</div>';
		} else {
			$mysqli->query("UPDATE BJT SET `Mx_bd`='$_POST[maxbet]' WHERE `Owner`='$_COOKIE[username]' LIMIT 1");
			echo "<div class=\"alert alert-success\">Successfully changed the maximum bet to $".number_format($_POST['maxbet'])."</div>";
		}
	}
} elseif(isset($_POST['sendUser'])) {
		$f_ip=$_SERVER['REMOTE_ADDR'];
		$toUser=$_POST['sendUser'];
		if(isset($_POST['money'])) { $escrowM=$_POST['money']; }
		if(isset($_POST['tokens'])) { $escrowT=$_POST['tokens']; }
		if(isset($_POST['bullets'])) { $escrowB=$_POST['bullets']; }
		$res=$mysqli->query("SELECT r_ip, lastip, id FROM Players WHERE username='$toUser' LIMIT 1");
		$row=$res->fetch_assoc();
		$regip=$row['r_ip'];
		$lastip=$row['lastip'];
		$uid=$row['id'];
		$bfl=$mysqli->query("SELECT `location` FROM BJT WHERE `owner` = '$_COOKIE[username]' LIMIT 1");
		$row=$bfl->fetch_array();
		$l=$row[0];
		$own=$mysqli->query("SELECT `id` FROM BJT WHERE owner='$toUser' LIMIT 1");
		if ($res->num_rows == 0) {
			echo "<div class=\"alert alert-error\">$toUser does not exist.</div>";
		} elseif ($own->num_rows > 0) {
			echo "<div class=\"alert alert-error\">$toUser already owns a Blackjack Table.</div>";
		} else {
			// Check if escrow or simple transfer
			if (isset($escrowM) OR isset($escrowT) OR isset($escrowB)) {
				if (($f_ip == $regip) OR ($f_ip == $lastip)) {
					$mysqli->query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$_COOKIE[username]', '$toUser', '$f_ip', 'Blackjack Escrow')");
					echo "<div class=\"alert alert-error\">You cannot send a Blackjack Table to someone on the same IP as you!</div>";
				} else {
					$res=$mysqli->query("SELECT location FROM BJT WHERE owner='$_COOKIE[username]' LIMIT 1");
					$row=$res->fetch_array();
					$l=$row[0];
					$mysqli->query("INSERT INTO escrow (username, other, location, money, bullets, tokens, type) values ('$_COOKIE[username]', '$toUser', '$l', '$escrowM', '$escrowB', '$escrowT', 'BJT')");
					$subject="Escrow Started";
					$message="$_COOKIE[username] has started an escrow for the $l Blackjack Table!";
					$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$uid', 'Global Takeover', 'unread', '$date')");
					echo "<div class=\"alert alert-success\">An Escrow for the Blackjack Table has been started!</div>";
				}
			} else {
				$mysqli->query("UPDATE BJT SET `Owner` = '$toUser' WHERE `Owner` = '$_COOKIE[username]' LIMIT 1");
				$subject="Property Transfer";
				$message="$_COOKIE[username] has given you the $l Blackjack Table!";
				$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$uid', 'Global Takeover', 'unread', '$date')");
				echo "<div class=\"alert alert-success\">The Blackjack Table was sent to $toUser.</div>";
				exit();
			}
		}
	}

if(isset($_GET['page']) AND $_GET['page'] == 'bjpanel') {
	if($bjcheck->num_rows == 0) {
		exit();
	} else {
		$res=$mysqli->query("SELECT * FROM BJT WHERE `Owner`='$_COOKIE[username]' LIMIT 1");
		$row=$res->fetch_assoc();
		$l=$row['location'];
		?>
		<div class="page-header"><h1>Blackjack <small>Owner Panel</small></h1></div>
		<div class="well">
		<legend><? echo "$l Blackjack Table"; ?></legend>
		<p class="lead">Profit: &#36;<? echo number_format($row['profit']); ?> / Till Balance: &#36;<? echo number_format($row['Till']); ?> / Min Bet: &#36;<? echo number_format($row['Mn_bd']); ?> / Max Bet: &#36;<? echo number_format($row['Mx_bd']); ?></p>
		<?	
		$res=$mysqli->query("SELECT * FROM `escrow` WHERE `username` ='$_COOKIE[username]' AND `type` = 'BJT' LIMIT 1");
		$row=$res->fetch_array();
		if ($res->num_rows == 0) {
			echo '
			 <div class="row-fluid">
			 <div class="span3">
			 <form method="post" action="blackjack.php?page=bjpanel">
 			 <h4>Start An Escrow</h4>
  			  <label for="euser">Username</label>
  			  <input type="text" name="sendUser" id="euser">
  			  <label for="emoney">Money</label>
  			  <input type="text" name="money" id="emoney">
  			  <label for="ebullets">Bullets</label>
  			  <input type="text" name="bullets" id="ebullets">
  			  <label for="etokens">Tokens</label>
  			  <input type="text" name="tokens" id="etokens">
  			  <br>
			  <button type="submit" name="submit" value="Send!" class="btn btn-success">Start Escrow</button>
			 </form>
			 </div>';
			} else {
			echo "
			<h4>Pending Escrow</h4>
			<table class=\"table table-striped table-bordered table-condensed\">
			<thead>
			<tr><th>Username</th><th>Money</th><th>Bullets</th><th>Tokens</th><th>Cancel</th></tr>
			</thead><tbody>
			<tr><td>".$row['other']."</td><td>$".number_format($row['money'])."</td><td>".number_format($row['bullets'])."</td><td>".number_format($row['tokens'])."</td><td><a href='bm.php?page=cancelBF'>Cancel</a></td></tr>
			</tbody></table>
			<div class=\"row-fluid\">";
			}
			?>
			<div class="span3">
				<h4>Change Owners</h4>
				<form method="post" action="blackjack.php?page=bjpanel">
  			  		<label for="suser">Username:</label>
  			  		<input type="text" name="sendUser" id="suser">
  			  		<button class="btn btn-success" type="submit" name="submit" value="Send!">Transfer</button>
				</form>
			</div>
			<div class="span3">
				<h4>Min/Max Bet</h4>
				<form method="post" action="blackjack.php?page=bjpanel">
  			  		<label for="insert">Min Bet</label>
  			  		<input type="text" name="minbet" id="insert">
  			  		<label for="insert2">Max Bet</label>
  			  		<input type="text" name="maxbet" id="insert2">
  			  		<button class="btn btn-success" type="submit" name="submit">Submit</button>
				</form>
			</div>
			<div class="span3">
				<h4>Manage Till</h4>
				<form method="post" action="blackjack.php?page=bjpanel">
  			  		<label for="insert">Add Money</label>
  			  		<input type="text" name="addTill" id="insert">
  			  		<label for="insert">Withdraw Money</label>
  			  		<input type="text" name="withdrawTill" id="insert">
  			  		<button class="btn btn-success" type="submit" name="submit">Submit</button>
				</form>
			</div></div>
		<?
	}
	require_once('members/footer.php');
	exit();
}

require_once("scripts/bjinit.php");
?>
<link href="themes/blackjack.css" rel="stylesheet" type="text/css"> 

<div id="wrapper">
	<div id="table">	
		<div id="score" class="well well-small">
			<ul class="unstyled">
				<li id="money"><strong>Money:</strong> $<span><? echo number_format($money); ?></span></li>
				<li id="bet"><strong>Current Bet:</strong> $<span>0</span></li>
				<li id="min"><strong>Minimum Bet:</strong> $<span><? echo number_format($bjt['Mn_bd']); ?></span></li>
				<li id="max"><strong>Maximum Bet:</strong> $<span><? echo number_format($bjt['Mx_bd']); ?></span></li>
				<strong>Dealer:</strong> <a href="profile.php?id=<? echo $oid;?>"><? echo $bjt['Owner']; ?></a>
			</ul>
		</div>
		<div class="pull-right" style="margin-top: 10px; margin-right: 10px;">
        	<img src="<? echo $oav; ?>" class="img-polaroid img-rounded" height="80px" width="80px">
        	<br><p class="lead"><font color="white">Dealer</font>
        	</p>
		</div>
		<div id="shoe"></div>
		<div id="resultMessage"></div>
		<div class="curValue player"></div>
		<div class="curValue dealer"></div>
	
		<div id="rules"><p align="center"><span class="logo"><font color="yellow">globaltakeover</span><br><br>Blackjack Pays 3 to 1<br>Chips are value listed x1000</font></p></div>
		<div id="players"><img src="images/bj/players.png"></div>
		<div id="chips">
			<? if($_COOKIE['username'] != $bjt['Owner']) { ?>
			<ul class="unstyled">
				<li class="chip" amt="5000"><img src="images/bj/chips/c5.png" alt="5chip"/></li>
				<li class="chip" amt="10000"><img src="images/bj/chips/c10.png" alt="10chip"/></li>
				<li class="chip" amt="50000"><img src="images/bj/chips/c50.png" alt="50chip"/></li>
				<li class="chip" amt="100000"><img src="images/bj/chips/c100.png" alt="100chip"/></li>
				<li class="chip" amt="1000000"><img src="images/bj/chips/c1000.png" alt="1000chip"/></li>
				<li class="chip" amt="max"><img src="images/bj/chips/cmax.png" alt="maxchip"/></li>
			</ul>
			<? }
			if ($bjcheck->num_rows > 0) { ?>
			<div class="pull-right" style="margin-right: 10px; margin-top: 5px;">
				<a class="btn btn-primary" href="blackjack.php?page=bjpanel">Manage Your Table</a>
			</div>
			<? } ?>
		</div>
		<div id="gameField"></div>
		<div id="control">
			<div id="hit"><button class="btn btn-primary"><i class="icon-plus-sign icon-white"></i> Hit</button></div>
			<div class="btn-group" id="dealClear">
				<button id="deal" class="btn btn-primary"><i class="icon-ok-sign icon-white"></i> Deal</button>
				<button id="clear" class="btn btn-primary"><i class="icon-remove-sign icon-white"></i> Clear</button>
			</div>
			<div id="stay"><button class="btn btn-warning"><i class="icon-remove-sign icon-white"></i> Stay</button></div>
		</div>
	</div>
</div>

<? require_once("members/footer.php"); ?>