<?php
$title="Black Market";
require_once("members/config.php");
checks();
online();
require_once("members/header.php");
?>

<div class="page-header"><h1>Black Market <small>Buy and sell in the underground</small></h1></div>

<ul class="nav nav-pills">
  <li class="active">
    <a href="#bf" data-toggle="tab">Bullet Factory</a>
  </li>
  <li><a href="#wf" data-toggle="tab">Weapon Factory</a></li>
  <li><a href="#armor" data-toggle="tab">Armor Store</a></li>
  <li><a href="#escrow" data-toggle="tab">Escrows</a></li>
  <li><a href="#liberation" data-toggle="tab">Network Liberation</a></li>
</ul>

<div class="tab-content">
	<div id="bf" class="tab-pane active well">
	<?
	$stmt=$pdo->prepare('SELECT location, money, btime FROM Players WHERE id = :id LIMIT 1');
	$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$l=$row['location'];
	$money=$row['money'];
	$original=$row['btime'];
	$secondsDiff=time()-$original;

	$res=$mysqli->query("SELECT Bullets, Bp, owner FROM BF WHERE location='$l' LIMIT 1");
	$row=$res->fetch_array();
	$b=$row[0];
	$bp=$row[1];
	$o=$row[2];
	
	$res=$mysqli->query("SELECT id, health FROM Players WHERE username='$o' LIMIT 1");
	$row=$res->fetch_array();
	$ownerid=$row[0];
	$ohealth=$row[1];
	
	// Bullet price change
	if (isset($_POST['bulletprice'])) {
		$pb=intval(abs($_POST['bulletprice']));
		$res=$mysqli->query("SELECT price FROM BF WHERE owner='$_COOKIE[username]' LIMIT 1");
		$row=$res->fetch_array();
		$price=$row[0];
		if (!is_int($pb)) {
			echo "<div class=\"alert alert-error\">The number you entered is not valid.</div>";
		} elseif ($pb <= 0 OR $pb > 5000) {
			echo "<div class=\"alert alert-error\">The price must be between $0 and $5000.</div>";
		} elseif ($price == 1) {
			echo "<div class=\"alert alert-error\">You can only change the price once per release cycle.</div>";
		} else {
			$mysqli->query("UPDATE BF SET Bp='$pb', price='1' WHERE owner='$_COOKIE[username]' LIMIT 1");
			echo "<div class=\"alert alert-success\">Bullet prices were changed to $$pb per bullet!</div>";
		}
	}
	// Insert bullets
	if (isset($_POST['bulletinsert'])) {
		$b = intval(abs($_POST['bulletinsert']));
		$res=$mysqli->query("SELECT bullets FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
		$row=$res->fetch_array();
		$pb=$row[0];
		if (!is_int($b)) {
			echo "<div class=\"alert alert-error\">The number you entered is not valid.</div>";
		} elseif ($b <= 0) {
			echo "<div class=\"alert alert-error\">You must insert at least 1 bullet.</div>";
		} elseif ($pb < $b) {
			echo "<div class=\"alert alert-error\">You do not have enough bullets for this.</div>";
		} else {
			$mysqli->query("UPDATE Players SET bullets=(bullets-$b) WHERE id='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("UPDATE BF SET Bullets=(Bullets+$b) WHERE owner='$_COOKIE[username]' LIMIT 1");
			echo("<div class=\"alert alert-success\">$b bullets were added and stocked.</div>");
		}
	}
	// Transfer the property
	if (isset($_POST['sendUser'])) {
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
		$bfl=$mysqli->query("SELECT `location` FROM BF WHERE `owner` = '$_COOKIE[username]' LIMIT 1");
		$row=$bfl->fetch_array();
		$l=$row[0];
		$own=$mysqli->query("SELECT `id` FROM BF WHERE owner='$toUser' LIMIT 1");
		if ($res->num_rows == 0) {
			echo "<div class=\"alert alert-error\">$toUser does not exist.</div>";
		} elseif ($own->num_rows > 0) {
			echo "<div class=\"alert alert-error\">$toUser already owns a Bullet Factory.</div>";
		} else {
			// Check if escrow or simple transfer
			if (isset($escrowM) OR isset($escrowT) OR isset($escrowB)) {
				if (($f_ip == $regip) OR ($f_ip == $lastip)) {
					$mysqli->query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$_COOKIE[username]', '$toUser', '$f_ip', 'Bullet Factory Escrow')");
					echo "<div class=\"alert alert-error\">You cannot send a Bullet Factory to someone on the same IP as you!</div>";
				} else {
					$res=$mysqli->query("SELECT location FROM BF WHERE owner='$_COOKIE[username]' LIMIT 1");
					$row=$res->fetch_array();
					$l=$row[0];
					$mysqli->query("INSERT INTO escrow (username, other, location, money, bullets, tokens, type) values ('$_COOKIE[username]', '$toUser', '$l', '$escrowM', '$escrowB', '$escrowT', 'BF')");
					$subject="Escrow Started";
					$message="$_COOKIE[username] has started an escrow for the $l Bullet Factory!";
					$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$uid', 'Global Takeover', 'unread', '$date')");
					echo "<div class=\"alert alert-success\">An Escrow for the Bullet Factory has been started!</div>";
				}
			} else {
				$mysqli->query("UPDATE BF SET `owner` = '$toUser' WHERE `owner` = '$_COOKIE[username]' LIMIT 1");
				$subject="Property Transfer";
				$message="$_COOKIE[username] has given you the $l Bullet Factory!";
				$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$uid', 'Global Takeover', 'unread', '$date')");
				echo "<div class=\"alert alert-success\">The Bullet Factory was sent to $toUser.</div>";
				exit();
			}
		}
	}
	// Claim open BF
	if(isset($_GET['page']) AND $_GET['page'] == 'claimBF') {
		$res=$mysqli->query("SELECT `id` FROM BF WHERE owner='$_COOKIE[username]' LIMIT 1");
		if (($o != 'None' OR $o != NULL) AND $ohealth != 0) {
			echo "<div class=\"alert alert-error\">This property has an owner.</div>";
		} elseif ($res->num_rows > 0) {
			echo "<div class=\"alert alert-error\">You already own a Bullet Factory, and cannot claim another.</div>";
		} elseif ($money < 5000000) {
			echo "<div class=\"alert alert-error\">You cannot afford to claim this Bullet Factory.</div>";
		} else {
			$mysqli->query("UPDATE `BF` SET `owner`='$_COOKIE[username]' WHERE `location` = '$_POST[location]' LIMIT 1");
			$mysqli->query("UPDATE Players SET money=(money-5000000) WHERE id = '$_COOKIE[id]' LIMIT 1");
			echo "<div class=\"alert alert-success\">You successfully claimed the $_POST[location] Bullet Factory!</div>";
			exit();
		}
	}
	// Cancel Escrow
	if(isset($_GET['page']) AND $_GET['page'] == 'cancelBF') {
		$res=$mysqli->query("SELECT location FROM BF WHERE owner='$_COOKIE[username]' LIMIT 1");
		$row=$res->fetch_array();
		$l=$row[0];	
		$escrow=$mysqli->query("SELECT * FROM escrow WHERE username='$_COOKIE[username]' AND `type`='BF' LIMIT 1");
		$row=$escrow->fetch_assoc();	
		$toUser=$row['other'];
		$res=$mysqli->query("SELECT id FROM Players WHERE username='$toUser' LIMIT 1");
		$row=$res->fetch_assoc();
		$oid=$row['id'];
		if ($res->num_rows == 0) {
			echo "<div class=\"alert alert-error\">You do not own a Bullet Factory.</div>";
		} elseif ($escrow->num_rows == 0) {
			echo "<div class=\"alert alert-error\">You don't have an active escrow open to cancel.</div>";
		} else {
			$mysqli->query("DELETE FROM escrow WHERE username = '$_COOKIE[username]' AND `type`='BF' LIMIT 1");
			echo "<div class=\"alert alert-success\">The escrow was successfully cancelled.</div>";
			$subject="Escrow Cancelled";
			$message="$_COOKIE[username] has canceled the escrow for the $l Bullet Factory!";
			$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$oid', '$_COOKIE[id]', 'unread', '$date')");
			exit();
		}
	}
	// Owner panel
	if(isset($_GET['page']) AND $_GET['page'] == 'bfpanel') {
		$res=$mysqli->query("SELECT `location`, `bullets`, `Bp` FROM BF WHERE owner='$_COOKIE[username]' LIMIT 1");
		$row=$res->fetch_array();
		if ($res->num_rows > 0) {
			$l=$row[0];
			echo "<legend>$l Bullet Factory</legend>";
			$day=(time()-86400);
			$res=$mysqli->query("SELECT SUM( amount ) AS profit FROM bfsales WHERE location='$l' AND btime >= '$day'");
			$row2=$res->fetch_array();
			$profit = $row2[0];	
			$mysqli->query("DELETE FROM bfsales WHERE btime < '$day'");
			echo "<p class=\"lead\">Daily Profit: &#36;".number_format($profit)." / Current Bullets: ".number_format($row[1])." / Current Price: &#36;".number_format($row[2])."</p>";	
			$res=$mysqli->query("SELECT * FROM `escrow` WHERE `username` ='$_COOKIE[username]' AND `type` = 'BF' LIMIT 1");
			$row=$res->fetch_array();
			if ($res->num_rows == 0) {
			echo '
			 <div class="row-fluid">
			 <div class="span3">
			 <form method="post" action="bm.php?page=bfpanel">
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
			echo '<div class="span3">
					<h4>Change Owners</h4>
					<form method="post" action="bm.php?page=bfpanel">
  			  			<label for="suser">Username:</label>
  			  			<input type="text" name="sendUser" id="suser">
  			  			<button class="btn btn-success" type="submit" name="submit" value="Send!">Transfer</button>
					</form>
				  </div>';
			echo "<div class=\"span3\">
					<h4>Insert Bullets</h4>
					<form method=\"post\" action=\"bm.php?page=bfpanel\">
  			  			<label for=\"insert\">Bullets</label>
  			  			<input type=\"text\" name=\"bulletinsert\" id=\"insert\">
  			  			<button class=\"btn btn-success\" type=\"submit\" name=\"submit\" value=\"Insert!\">Insert</button>
					</form>
					</div>
					<div class=\"span3\">
					<h4>Change Bullet Prices</h4>
					<form method=\"post\" action=\"bm.php?page=bfpanel\">
  			  			<label for=\"price\">Price Per Bullet</label>
  			  			<input type=\"text\" name=\"bulletprice\" id=\"price\">
  			  			<button class=\"btn btn-success\" type=\"submit\" name=\"submit\" value=\"Change!\">Update Price</button>
					</form>
					</div></div>";
		} else {
			echo '<div class="alert alert-error">You do not own a Bullet Factory! Please come back when you do.</div>';
		}
		require_once('members/footer.php');
		exit();
	}
	
	echo "<legend>$l Bullet Factory</legend>";
	
	// Bullet purchasing
	if (isset($_POST['bb'])) {
		$bb = intval(strip_tags(abs($_POST['bb'])));
		if ($_POST['bb'] == '' OR $_POST['bb'] == 0) {
			echo "<div class=\"alert alert-error\">You must enter a number larger than 0.</div>";
		} elseif (!preg_match("/[0-9]/",$bb)) {
			echo "<div class=\"alert alert-error\">You must enter an actual number.</div>";
		} elseif ($bb > $b) {
			echo "<div class=\"alert alert-error\">There aren't $bb bullets available in the factory.</div>";
		} elseif ($bb > 150) {
			echo "<div class=\"alert alert-error\">You cannot buy more then 150 Bullets at one time!</div>";		
		} else {
			$c=$bb*$bp;
			if ($c > $money) {
				echo "<div class=\"alert alert-error\">Please enter an amount of bullets you can afford.</div>";
			} elseif ($c <= $money) {
				$mysqli->query("UPDATE BF SET Bullets=(Bullets-$bb) WHERE location='$l' LIMIT 1");
				$nc=($c-($c*.30));
				$mysqli->query("UPDATE Players SET money=(money+$nc) WHERE username='$o' LIMIT 1");
				$mysqli->query("UPDATE Players SET money=(money-$c), bullets=(bullets+$bb), btime='".time()."' WHERE id='$_COOKIE[id]' LIMIT 1");
				echo "<div class=\"alert alert-success\">You bought ".number_format($bb)." bullet(s) for &#36;".number_format($c)."!</div>";
				exit();
			}
		}
	}		
	// Display the factory
	if ($secondsDiff < 15) {
		$tl = 15 - $secondsDiff;
		echo "
			<script>
			<!-- //start
			var times = new Array(1);
			times[0] = $tl;
			function Count(){
				if (times[0] > 0) { 
					document.getElementById('0').innerHTML = times[0];
				} else { 
					window.location.reload();
				}
				times[0]--;
				setTimeout(\"Count()\", 1000);
			}
			window.onload=function(){Count();}
			 //-->
			</script>
			<div class=\"alert alert-info\">You can only buy bullets every 15 seconds! Come back in <span id='0'></span> seconds!</div>";
	} elseif ($o == 'None' OR $o == NULL OR $ohealth < 1) {
		echo "<p>This Bullet Factory currently has no owner! Would you like to claim it?<br>You will need to pay $5,000,000 to start it back up.</p>
				<form name=\"pickup\" method=\"post\" action=\"bm.php?page=claimBF\">
					<input type=\"hidden\" name=\"location\" value=\"$l\" />
					<button class=\"btn btn-success\" type=\"submit\" name=\"submit\" />Purchase</button>
				</form>";
	} else {
		$res=$mysqli->query("SELECT id FROM BF WHERE owner='$_COOKIE[username]' AND location != '$l' LIMIT 1");
		if ($_COOKIE['username'] == $o) {
			echo "<a class=\"btn btn-primary\" href=\"bm.php?page=bfpanel\">Manage your Bullet Factory</a>";
		} else {
			if($res->num_rows != 0) {
				echo ("<a class=\"btn btn-primary btn-small\" href=\"bm.php?page=bfpanel\">Manage your Bullet Factory</a><br><br>");
			}
			echo "<p class=\"lead\">Current Bullets: ".number_format($b)." /
				  Current Price: &#36;".number_format($bp)."</p>";
			?>
			<hr>
			<form action="bm.php" method="post">
				<label for="amount">Bullets to Purchase</label>
				<input name="bb" type="text" class="span3">
				<br>
				<button class="btn btn-success" type="submit" name="submit" value="Buy!">Purchase</button>
				<input type="hidden" name="submitted" value="TRUE">
			</form>
			<p>A maximum of 150 bullets can be bought at one time.
			<?
			echo "<br />This Bullet Factory is owned by <a href=\"profile.php?id={$ownerid}\">$o</a></p>";	
		}
	}
	?>
	</div>
	<div id="wf" class="tab-pane well">
	
	</div>
</div>

<?
require_once("members/footer.php");
?>