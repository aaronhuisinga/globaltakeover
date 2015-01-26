<?php
$title="Global Market";
include("members/config.php");
checks();
online();
include("members/header.php");
$u=$_COOKIE['username'];
$twoweeks = (time()-604800);
$ip = $_SERVER['REMOTE_ADDR'];

echo '<div class="page-header"><h1>Global Market <small>Buy, Sell, or Trade Items</small></h1></div>';

if(isset($_GET['page'])) {
	if($_GET['page'] == 'recent') {
		?>
		<div class="well">
		<legend>Tokens</legend>
		<table class="table table-striped table-bordered table-condensed">
		  <thead>
		  <tr>
		    <th>Amount</th>
		    <th>Buyer</th>
		    <th>Price</th>
		    <th>Date Purchased</th>
		  </tr>
		  </thead>
		  <tbody>
		<?
		$res=$mysqli->query("SELECT * FROM gmlog WHERE Type='Tokens' AND seller='$_COOKIE[id]' ORDER BY id ASC LIMIT 25"); 
		while ($row=$res->fetch_assoc()){
		$a=$row['amount'];
		$b=$row['buyer'];
		$p=stripslashes($row['price']);
		$date=$row['date'];
		$res=$mysqli->query("SELECT `username` FROM Players WHERE `id`='$b' LIMIT 1");
		$buyer=$res->fetch_assoc();
		?>		
		  <tr>
			<td><? echo "".number_format($a).""; ?></td>
			<td><? echo "<a target=\"main\" href=\"/members/profile.php?id=$b\">$buyer[username]</a>"; ?></td>
			<td><? echo "&#36;".number_format($p).""; ?></td>
			<td><? echo "$date"; ?></td>
		  </tr>	
		<?
		}
		?>
		  </tbody>
		</table>
		
		<legend>Bullets</legend>
		<table class="table table-striped table-bordered table-condensed">
		  <thead>
		  <tr>
		    <th>Amount</th>
		    <th>Buyer</th>
		    <th>Price</th>
		    <th>Date Purchased</th>
		  </tr>
		  </thead>
		  <tbody>
		<?
		$res=$mysqli->query("SELECT * FROM gmlog WHERE Type='Bullets' AND seller='$_COOKIE[id]' ORDER BY id ASC LIMIT 25"); 
		while ($row=$res->fetch_assoc()){
		$a=$row['amount'];
		$b=$row['buyer'];
		$p=stripslashes($row['price']);
		$date=$row['date'];
		$res=$mysqli->query("SELECT `username` FROM Players WHERE `id`='$b' LIMIT 1");
		$buyer=$res->fetch_assoc();
		?>
		  <tr>
			<td><? echo "".number_format($a).""; ?></td>
			<td><? echo "<a target=\"main\" href=\"/members/profile.php?id=$b\">$buyer[username]</a>"; ?></td>
			<td><? echo "&#36;".number_format($p).""; ?></td>
			<td><? echo "$date"; ?></td>
		  </tr>	
		
		<?
		}
		?>
		  </tbody>
		</table>
		
		<legend>Vehicles</legend>
		<table class="table table-striped table-bordered table-condensed">
		  <thead>
		  <tr>
		    <th>Type</th>
		    <th>Buyer</th>
		    <th>Price</th>
		    <th>Date Purchased</th>
		  </tr>
		  </thead>
		  <tbody>
		<?
		$res=$mysqli->query("SELECT * FROM gmlog WHERE Type='Vehicle' AND seller='$_COOKIE[id]' ORDER BY id ASC"); 
		while ($row=$res->fetch_assoc()){
		$t=$row['model'];
		$b=$row['buyer'];
		$p=stripslashes($row['price']);
		$date=$row['date'];
		$res=$mysqli->query("SELECT `username` FROM Players WHERE `id`='$b' LIMIT 1");
		$buyer=$res->fetch_assoc();
		?>		
		  <tr>
			<td><? echo "$t"; ?></td>
			<td><? echo "<a target=\"main\" href=\"/members/profile.php?id=$b\">$buyer[username]</a>"; ?></td>
			<td><? echo "&#36;".number_format($p).""; ?></td>
			<td><? echo "$date"; ?></td>
		  </tr>	
		
		<?
		}
		?>
		  </tbody>
		</table>
		</div>
		<? exit();
	} elseif ($_GET['page'] == 'remove') {
		$id=$_GET['id'];
		$res=$mysqli->query("SELECT * FROM gm WHERE id='$id' LIMIT 1"); 
		$row=$res->fetch_assoc();
		$a=$row['amount'];
		$type=$row['type'];
		$s=$row['seller'];
		$model=$row['model'];
		$vtype=$row['vtype'];
		
		$res=$mysqli->query("SELECT money FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
		$row=$res->fetch_array();
		$money=$row[0];
		
		if (250000 > $money) {
			echo ("<div class=\"alert alert-error\"><span class=\"label label-important\">Error</span> You must have $250,000 to remove your listing!</div>");
		} else {
			if ($type == 'Tokens') {
				$mysqli->query("UPDATE Players SET money=(money-250000), tokens=(tokens+$a) WHERE id ='$_COOKIE[id]' LIMIT 1");	
				echo ("<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You removed the $a Tokens that you had for sale. You were charged $250,000.</div>");
			} elseif ($type == 'Bullets') {
				$mysqli->query("UPDATE Players SET money=(money-250000), bullets=(bullets+$a) WHERE id ='$_COOKIE[id]' LIMIT 1");
				echo ("<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You removed the $a bullets that you had for sale. You were charged $250,000.</div>");
			} elseif ($type == 'Vehicle') {
				$mysqli->query("UPDATE Players SET money=(money-250000) WHERE id ='$_COOKIE[id]' LIMIT 1;");	
				$mysqli->query("INSERT INTO `garage` ( `vehicle` , `username` , `percent`, `type` ) VALUES ('$model', '$_COOKIE[id]', '100', '$vtype')");	
				echo ("<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You removed the $model that you had for sale. You were charged $250,000.</div>");
			}
			$mysqli->query("DELETE FROM gm WHERE id='$id' LIMIT 1");
		}
	} elseif ($_GET['page'] == 'buy') {
		$id=$_GET['id'];
		$res=$mysqli->query("SELECT * FROM gm WHERE id='$id' LIMIT 1"); 
		$row=$res->fetch_assoc();
		$a=$row['amount'];
		$type=$row['type'];
		$s=$row['seller'];
		$p=$row['price'];
		$ip=$row['ip'];
		$model=$row['model'];
		$vtype=$row['vtype'];
		$an = $row['Anomynous'];
		$bip = $_SERVER['REMOTE_ADDR'];
		$subject = "Global Market Sale Confirmation";
		
		$res=$mysqli->query("SELECT money FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
		$row=$res->fetch_array();
		$money=$row[0];
		
		$res=$mysqli->query("SELECT `username` FROM Players WHERE id='$s' LIMIT 1");
		$row=$res->fetch_assoc();
		$seller=$row['username'];
		
		if ($ip == $bip) {
			$mysqli->query("INSERT INTO `ipalert` ( `user` , `ouser` , `ip` , `type` ) VALUES ('$s', '$_COOKIE[id]', '$bip', 'Global Market Purchase')");
			echo ("<div class=\"alert alert-error\"><span class=\"label label-important\">Error</span> You cannot buy something being sold from the same IP.</div>");
		} elseif ($p > $money) {
			echo ("<div class=\"alert alert-error\"><span class=\"label label-important\">Error</span> You cannot afford this.</div>");
		} else {
			if ($type == 'Tokens') {
				$mysqli->query("UPDATE Players SET money=(money-$p), tokens=(tokens+$a) WHERE id ='$_COOKIE[id]' LIMIT 1");
				$fprice = ($p - ($p * .06));
				$mysqli->query("UPDATE Players SET money=(money+$fprice) WHERE id ='$sid' LIMIT 1");		
				$message = "The $a Tokens that you had listed in the Global Market sold for your listed price of $".number_format($p).". 
							The money has been added to your account.";
				$mysqli->query("INSERT INTO `pmessages` (`title` , `message` , `touser` , `from` , `unread` , `date`) VALUES ('$subject', '$message', '$s', 'Global Takeover', 'unread', '$date')");
				echo ("<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You purchased $a Tokens for &#36;".number_format($p).".</div>");
			} elseif ($type == 'Bullets') {		
				$mysqli->query("UPDATE Players SET bullets=(bullets+$a), money=(money-$p) WHERE id ='$_COOKIE[id]' LIMIT 1");
				$fprice = ($p - ($p * .06));
				$mysqli->query("UPDATE Players SET money=(money+$fprice) WHERE id ='$sid' LIMIT 1");
				$message = "The $a bullets that you had listed in the Global Marketplace sold for your listed price of $".number_format($p).". 
							The money has been added to your account.";
				$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$s', 'Global Takeover', 'unread', '$date')");		
				echo ("<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You purchased $a bullets for &#36;".number_format($p).".</div>");
			} elseif ($type == 'Vehicle') {	
				$mysqli->query("UPDATE Players SET money=(money-$p) WHERE id ='$_COOKIE[id]' LIMIT 1");
				$mysqli->query("INSERT INTO `garage` ( `vehicle` , `username` , `percent`, `type` ) VALUES ('$model', '$_COOKIE[id]', '100', '$vtype')");
				$fprice = ($p - ($p * .06));
				$mysqli->query("UPDATE Players SET money=(money+$fprice) WHERE id ='$sid' LIMIT 1");	
				$message = "The $model that you had listed in the Global Marketplace sold for your listed price of $".number_format($p).". 
							The money has been added to your account.";
				$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$s', 'Global Takeover', 'unread', '$date')");
			echo ("<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You purchased the $model for &#36;".number_format($p).".</div>");
			}
			$mysqli->query("DELETE FROM gm WHERE id='$id' LIMIT 1");
			
		}
	}
}

if(isset($_POST['price'])) {
	$res=$mysqli->query("SELECT `money` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
	$row=$res->fetch_array();
	$money=$row[0];
	$numsale=$mysqli->query("SELECT `id` FROM `gm` WHERE `seller`='$_COOKIE[id]' LIMIT 5");
	if(isset($_POST['amount'])) { $amt=intval(abs($_POST['amount'])); };
	$price=intval(abs($_POST['price']));
	if(isset($_POST['type'])) {
		if ($numsale->num_rows >= 5) {
			echo "<div id=\"crimestext\"><center>You already have 5 items for sale! You cannot sell more than 5 at one time!</div>";
		} elseif(!preg_match("/[0-9]/",$amt)) {
			echo "<div id=\"crimestext\"><center>Please enter a real number!</div>";
		} elseif (!preg_match("/[0-9]/",$price)) {
			echo "<div id=\"crimestext\"><center>Please enter a real number!</div>";
		} else {
			$type=$_POST['type'];
			if(isset($_POST['checkbox'])){ $anon=$_POST['checkbox']; }
			if ($type == 'Tokens'){
				$res=$mysqli->query("SELECT `tokens` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
				$row=$res->fetch_array();
				$tokens=$row[0];
				if ($amt > 0 AND $tokens >= $amt) {
					$mysqli->query("UPDATE Players SET tokens=(tokens-$amt) WHERE id='$_COOKIE[id]' LIMIT 1");
					if (isset($anon) AND $money >= '1000000') {
						$mysqli->query("UPDATE Players SET money=(money-1000000) WHERE id='$_COOKIE[id]' LIMIT 1");
						$mysqli->query("INSERT INTO `gm` (`type` , `amount` , `seller` , `price`, `time`, `date`, `ip`, `Anomynous`) VALUES ('Tokens', '$amt', '$_COOKIE[id]', '$price', '".time()."', '$date', '$ip', '1')");
						echo "<div id=\"crimestext\"><center>You have listed ".number_format($amt)." tokens for sale!</div>";
					} elseif(!isset($anon)) {
						$mysqli->query("INSERT INTO `gm` (`type` , `amount` , `seller` , `price`, `time`, `date`, `ip`) VALUES ('Tokens', '$amt', '$_COOKIE[id]', '$price', '".time()."', '$date', '$ip')");
						echo "<div id=\"crimestext\"><center>You have listed ".number_format($amt)." tokens for sale!</div>";
					} else {
						echo "<div id=\"crimestext\"><center>You cannot do this.</div>";
					}
				} else {
					echo "<div id=\"crimestext\"><center>You cannot do this.</div>";
				}
			} elseif ($type == 'Bullets'){
				$res=$mysqli->query("SELECT `bullets` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
				$row=$res->fetch_array();
				$bullets=$row[0];
				if ($amt > 0 AND $bullets >= $amt) {
					$mysqli->query("UPDATE Players SET bullets=(bullets-$amt) WHERE id='$_COOKIE[id]' LIMIT 1");
					if (isset($anon) AND $money >= '1000000') {
						$mysqli->query("UPDATE Players SET money=(money-1000000) WHERE id='$_COOKIE[id]' LIMIT 1");
						$mysqli->query("INSERT INTO `gm` (`type` , `amount` , `seller` , `price`, `time`, `date`, `ip`, `Anomynous`) VALUES ('Bullets', '$amt', '$_COOKIE[id]', '$price', '".time()."', '$date', '$ip', '1')");
						echo "<div id=\"crimestext\"><center>You have listed ".number_format($amt)." bullets for sale!</div>";
					} elseif(!isset($anon)) {
						$mysqli->query("INSERT INTO `gm` (`type` , `amount` , `seller` , `price`, `time`, `date`, `ip`) VALUES ('Bullets', '$amt', '$_COOKIE[id]', '$price', '".time()."', '$date', '$ip')");
						echo "<div id=\"crimestext\"><center>You have listed ".number_format($amt)." bullets for sale!</div>";
					} else {
						echo "<div id=\"crimestext\"><center>You cannot do this.</div>";
					}
				} else {
					echo "<div id=\"crimestext\"><center>You cannot do this.</div>";
				}
			}
		} // </sell bullets and tokens>
	} elseif(isset($_POST['car']) OR isset($_POST['plane']) OR isset($_POST['boat'])) {
		foreach($_POST as $key => $val) {
			if($key == 'car' OR $key == 'plane' OR $key == 'boat') {
				$vtype=$key;
				$vid=$val;
			}
		}
		if(isset($_POST['checkbox'])) { $anon=$_POST['checkbox']; }	
		if (!isset($_POST['car']) AND !isset($_POST['boat']) AND !isset($_POST['plane'])) {
			echo '<div id="crimestext" align="center">You need to select a vehicle to list for sale.</div>';
		} elseif(isset($anon) AND $money < '1000000') {
			echo "<div id=\"crimestext\"><center>You cannot afford this.</div>";
		} elseif($numsale->num_rows >= 5) {
			echo "<div id=\"crimestext\"><center>You already have 5 items for sale! You cannot sell more than 5 at one time!</div>";
		} elseif (!preg_match("/[0-9]/",$price) OR $price == null) {
			echo "<div id=\"crimestext\"><center>Please enter a real number!</div>";
		} else {
			if(isset($anon)) {
				$mysqli->query("UPDATE Players SET money=(money-1000000) WHERE id='$_COOKIE[id]' LIMIT 1");
			}
			$res=$mysqli->query("SELECT vehicle FROM garage WHERE id='$vid' AND username='$_COOKIE[id]' AND percent=100 LIMIT 1");
			$row=$res->fetch_array();
			if ($res->num_rows == 0) {
				echo '<div id="crimestext" align="center">The $vtype you chose is not at 100%.</div>';
			} else {
				if(isset($anon)) {
					$mysqli->query("INSERT INTO `gm` (`type`, `amount`, `seller`, `price`, `time`, `date`, `ip`, `model`, `vtype`, `Anonymous`) VALUES ('Vehicle', '1', '$_COOKIE[id]', '$price', '".time()."', '$date', '$ip', '$row[0]', '$vtype', '1')");
				} else {
					$mysqli->query("INSERT INTO `gm` (`type`, `amount`, `seller`, `price`, `time`, `date`, `ip`, `model`, `vtype`) VALUES ('Vehicle', '1', '$_COOKIE[id]', '$price', '".time()."', '$date', '$ip', '$row[0]', '$vtype')");
				}
				$mysqli->query("DELETE FROM garage WHERE id='$vid' LIMIT 1");
				echo "<div id=\"crimestext\>You listed the $row[0] for sale for $".number_format($price).".</div>";
			}
		}
	}
}
?>

<a class="btn btn-mini" href="gm.php?page=recent">Last 50 Transactions</a><br><br>
<div class="well">
<?
$arr = array('Tokens', 'Bullets');
foreach ($arr as $item) {
echo("
<h4>$item</h4>
<table class=\"table table-bordered table-striped table-condensed\">
<thead><tr>
<th>Amount</th>
<th>Seller</th>
<th>Price</th>
<th>Date Listed</th>
<th>Buy</th>
</tr></thead><tbody>");

$gather=$mysqli->query("SELECT * FROM gm WHERE `Type`='$item' AND `time` >= '$twoweeks' ORDER BY id ASC"); 
while ($row=$gather->fetch_assoc()){
$id=$row['id'];
$a=stripslashes($row['amount']);
$s=$row['seller'];
$p=stripslashes($row['price']);
$date=$row['date'];
$an = $row['Anomynous'];
$res=$mysqli->query("SELECT username FROM Players WHERE id='$s' LIMIT 1;");
$seller=$res->fetch_assoc();
?>		
  <tr>
	<td><? echo "".number_format($a).""; ?></td>
	<td><? if ($an == 0) {echo "<a href=\"profile.php?id=$s\">$seller[username]</a>"; } else { echo 'Anonymous'; } ?></td>
	<td><? echo "&#36;".number_format($p).""; ?></td>
	<td><? echo "$date"; ?></td>
<? if ($s != $_COOKIE['id']) { ?>
	<td><? echo "<a href=\"gm.php?page=buy&id={$id}\">Buy</a>"; ?></td>
<? } else { ?>
	<td><? echo "<a href=\"gm.php?page=remove&id={$id}\">Remove</a>"; ?></td>
<? } ?>
  </tr>
<?
}

$res=$mysqli->query("SELECT * FROM gm WHERE Type='$item' AND time < '$twoweeks' ORDER BY id ASC"); 
while ($row=$res->fetch_assoc()){
$oa=stripslashes($row['amount']);
$os=stripslashes($row['seller']);
$mysqli->query("UPDATE Players SET $item=($item+$oa) WHERE username='$os' LIMIT 1;");
$subject = "Global Market Listing Removed";
$message = "The ".number_format($oa)." $item that you had listed in the Global Marketplace were automatically removed after not selling for a week. $oa $item were refunded to your account.";
$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$os', 'Global Takeover', 'unread', NOW())");
$mysqli->query("DELETE FROM gm WHERE Type='$item' AND time < '$twoweeks'");
}
?>
</tbody>
</table>
<? } ?>
<h4>Vehicles</h4>
<table class="table table-striped table-bordered table-condensed">
<thead><tr>
	<th>Type</th>
	<th>Seller</th>
	<th>Price</th>
	<th>Date Listed</th>
	<th>Buy</th>
</tr></thead><tbody>
<?
$res=$mysqli->query("SELECT * FROM gm WHERE Type='Vehicle' AND time >= '$twoweeks' ORDER BY model ASC"); 
while ($row=$res->fetch_assoc()){
$id=$row['id'];
$a=stripslashes($row['amount']);
$s=$row['seller'];
$p=stripslashes($row['price']);
$date=$row['date'];
$type=$row['model'];
$an=$row['Anomynous'];
$res2=$mysqli->query("SELECT username FROM Players WHERE id='$s' LIMIT 1;");
$seller=$res2->fetch_assoc();
?>		
  <tr>
	<td><? echo "$type"; ?></td>
	<td><? if ($an == 0) { echo "<a href=\"profile.php?id=$s\">$seller[username]</a>"; } else { echo 'Anonymous'; } ?></td>
	<td><? echo "&#36;".number_format($p).""; ?></td>
	<td><? echo "$date"; ?></td>
	<? if ($s != $_COOKIE['id']) { ?>
	<td><? echo "<a href=\"gm.php?page=buy&id={$id}\">Buy</a>"; ?></td>
	<? } else { ?>
	<td><? echo "<a href=\"gm.php?page=remove&id={$id}\">Remove</a>"; ?></td>
	<? } ?>
  </tr>	
<?
}
$res=$mysqli->query("SELECT * FROM gm WHERE Type='Vehicle' AND time < '$twoweeks' ORDER BY model ASC"); 
while ($row=$res->fetch_assoc()){
$model=stripslashes($row['model']);
$os=stripslashes($row['seller']);
$vtype=$row['vtype'];
if ($vtype == 'car') {
	$mysqli->query("INSERT INTO `garage` ( `car` , `username` , `percent` ) VALUES ('$model', '$os', '100')");
} elseif ($vtype == 'plane') {
	$mysqli->query("INSERT INTO `hanger` ( `plane` , `username` , `percent` ) VALUES ('$model', '$os', '100')");
} elseif ($vtype == 'boat') {
	$mysql->query("INSERT INTO `dock` ( `dock` , `username` , `percent` ) VALUES ('$model', '$os', '100')");
}	
$subject = "Global Market Listing Removed";
$message = "The $model that you had listed in the Global Marketplace was automatically removed after not selling for a week. It is now back in your account.";
$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$os', 'Global Takeover', 'unread', NOW())");
$mysqli->query("DELETE FROM gm WHERE Type='Vehicle' AND time < '$twoweeks'");
}
?>
</tbody>
</table>

<legend>Sell Items</legend>

<div class="alert alert-block">
  <span class="label label-warning">Heads Up!</span>
  <ul>
	  <li>All unpurchased items are removed 1 week after being listed.</li>
	  <li>There is a 8% tax on all purchases.</li>
	  <li>There is a $1,000,000 fee to make yourself Anonymous.</li>
  </ul>
</div>

<div class="row-fluid">
	<div class="span6">
	<h4>Sell Tokens/Bullets</h4>
	<form action="gm.php" method="post">
	<label for="type">Type of Sale</label>
	<select name="type" id="type">
  		<option value="Tokens">Tokens</option>
  		<option value="Bullets">Bullets</option>
  	</select>
  	<label for="amount">Amount</label>
  	<input type="text" name="amount" size="20" maxlength="20">
	<label for="price">Price</label>
	<input type="text" name="price" size="20" maxlength="10">
	<label class="checkbox"><input type="checkbox" name="checkbox" value="checkbox">Anonymous </label>
	<button type="submit" name="submit" value="Submit" class="btn btn-success">Submit</button>
	</form>
	</div>
	
	<div class="span6">
	<h4>Sell Vehicles</h4>
  	<form action="gm.php" method="POST">
	<table class="table table-bordered table-striped table-condensed">
		<thead><tr>
		<th>Vehicle</th>
   		<th width="5%">Select</th>
  		</tr></thead>
  		<tbody>
		<?
		$res=$mysqli->query("SELECT id, vehicle, type FROM garage WHERE username='$_COOKIE[id]' AND percent='100'"); 
		while ($row=$res->fetch_assoc()){
  		echo "<tr>
		<td width=\"10%\">$row[vehicle]</td>
		<td width=\"1%\"><input name=\"$row[type]\" type=\"radio\" value=\"$row[id]\"></td>
 		</tr>";
 		}		
		?>
	</table>
	<label for="vprice">Price</label>
	<input type="text" name="price" size="20" maxlength="10">
	<label class="checkbox"><input type="checkbox" name="checkbox" value="checkbox"> Anonymous</label>
	<button name="submit" type="submit" value="Submit" class="btn btn-success">Submit</button>
	</form>
	</div>
</div>
<? include("members/footer.php"); ?>