<?
$title="Token Store";
require_once("members/config.php");
require_once("members/header.php");
checks();
?>
<script>
	$(document).ready(function() {
		$('#changeName').hide();
		$('input[type=radio]').click(function() {
			if($(this).val() == 'username') {
				$('#changeName').show();
			} else {
				$('#changeName').hide();
			}
		});
	});
</script>

<div class="page-header"><h1>Token Store <small>Manage or Acquire Tokens</small></h1></div>

<?
if(isset($_GET['page']) AND $_GET['page'] == 'purchase') {
	$user = $_COOKIE['username'];
	
	?>
	<script type="text/javascript">
	
	function UpdateForm (obj1) { 
	 obj1.os1.value = obj1.os0.value
	 
	 if (obj1.os0.value == "50 Tokens")
	 {
	 obj1.amount.value = 5.00;
	 obj1.item_name.value = "50";
	 }
	 
	 if (obj1.os0.value == "100 Tokens")
	 {
	  obj1.amount.value = 10.00;
	  obj1.item_name.value = "100";
	 }
	 
	 if (obj1.os0.value == "200 Tokens")
	 {
	  obj1.amount.value = 15.00;
	  obj1.item_name.value = "200";
	 }
	 
	 if (obj1.os0.value == "270 Tokens")
	 {
	  obj1.amount.value = 20.00;
	  obj1.item_name.value = "270";
	 }
	 
	 if (obj1.os0.value == "500 Tokens")
	 {
	  obj1.amount.value = 30.00;
	  obj1.item_name.value = "500";
	 }
	 
	 if (obj1.os0.value == "1000 Tokens")
	 {
	  obj1.amount.value = 50.00;
	  obj1.item_name.value = "1000";
	 }
	}
	</script>
	<div class="well">
	<h3>Why purchase Tokens?</h3>
	<p>By purchasing Tokens, you are thanking the creators and staff for the hard work and long periods of time that they have put in, and continue to put into Global Takeover.<br /> This was a very large project to create, and continues to be a rough task to maintain. The site itself has many different fees to keep running, and it also requires a lot of time to keep everything running smoothly. <br /><br />
	Posessing Tokens will give you the edge you need to surpass the competition of the game. There are many things that can already be purchased using Tokens, and we are always open to new ideas and suggestions for new things that can be offered to purchase with Tokens. From extra bullets or money, to even a new username, Tokens unlock an entire new chapter of the game for all users.</p>
	
	<h3>Terms Of Agreement</h3>
	<ol>
		<li>Money transferred/paid to Global Takeover is classified as a free will donation.</li>
		<li>Source of payment to Global Takeover must be property of payee, or with consent from holder of funds.</li>
		<li>Tokens will be rewarded in amount specified in chart below based on amount of donation given.</li>
		<li>Donations given will not be refunded. There are no exceptions to this.</li>
		<li>Tokens can not be redeemed or traded for any type of currency not part of Global Takeover in any way.</li>
	</ol>
	
	<h3>What is VIP Status? <span class="label label-info">VIP</span></h3>
	<p>VIP Status is something new that we're trying here at Global Takeover. For all purchases of Tokens $15 and over, the user will be automatically given VIP status. All Global Takeover VIP's will have an assortment of new features given to their account, including:</p>
	<ol>
		<li>New crime type, that opens the possibility to gain greater amounts of money faster, and to steal both Tokens and Bullets!</li>
		<li>All timers for crimes are reduced by 10%!</li>
		<li>Captchas appear less, giving you more time to rank!</li>
		<li>Special VIP forum, that gives direct access to staff attention.</li>
		<li>Access to the newest features, and BETA testing.</li>
		<li>Contests, giveaways, and other fun things!</li>
	</ol>
	<p>When more features are added, all VIP's will automatically get access to them. The account that donates will be given VIP until it is killed or banned. After that the VIP access has expired. So what have you got to lose? VIP comes free with a purchase of $15+ of Tokens!</p>
	
	<h3>Pricing</h3>
	<table class="table table-bordered table-striped table-condensed">
	<thead><tr>
	<th>Benefits</th><th>Price</th>
	</tr></thead>
	<tbody>
	<tr><td>50 tokens</td> <td>$5</td></tr>
	<tr><td>100 tokens</td> <td>$10</td></tr>
	<tr><td>200 tokens + VIP Status</td> <td>$15</td></tr>
	<tr><td>270 tokens + VIP Status</td> <td>$20</td></tr>
	<tr><td>500 tokens + VIP Status</td> <td>$30</td></tr>
	<tr><td>1000 tokens + VIP Status</td> <td>$50</td></tr>
	</tbody>
	</table>
	
	<div class="alert">By clicking the link below and purchasing Tokens, you are agreeing to the Terms of Agreement stated above.</div>
	<div class="alert alert-info">Paypal is our preferred payment option. You will receive Tokens immediately this way, as they are instantly awarded to your account!</div>

	<table class="table table-bordered table-striped table-condensed">
	<thead>
	<tr>
	<th>Paypal</th>
	<th>Google Wallet</th>
	</tr>
	</thead><tbody>
	<tr><td>
	<label for="os0">Number of Tokens</label>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" onsubmit="this.target='paypal'; return UpdateForm(this);">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="add" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="quantity" value="1">
	<input type="hidden" name="business" value="support@globaltakeover.net">
	<input type="hidden" name="page_style" value="GlobalTakeover">
	<input type="hidden" name="return" value="http://www.globaltakeover.net/tokens.php?page=completed">
	<input type="hidden" name="notify_url" value="http://www.globaltakeover.net/verify.php">
	<input type="hidden" name="item_name" value="Tokens">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="os1" value=" ">
	<input type="hidden" name="amount" value="1.00">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="custom" value="<? echo $_COOKIE['username']; ?>">
	<input type="hidden" name="on0" id="on0" value="Option">
	<select name="os0">
		<option value="50 Tokens">50 Tokens</option>
		<option value="100 Tokens">100 Tokens</option>
		<option value="200 Tokens">200 Tokens</option>
		<option value="270 Tokens">270 Tokens</option>
		<option value="500 Tokens">500 Tokens</option>
		<option value="1000 Tokens">1000 Tokens</option>
	</select>
	<br>
	<button type="submit" name="submit" class="btn btn-success"><i class="icon-shopping-cart icon-white"></i> Buy with Paypal</button>
	</form>
	</td><td>
	<label for="gwTokens">Number of Tokens</label>
	<select name="gwTokens">
		<option value="50 Tokens">50 Tokens</option>
		<option value="100 Tokens">100 Tokens</option>
		<option value="200 Tokens">200 Tokens</option>
		<option value="270 Tokens">270 Tokens</option>
		<option value="500 Tokens">500 Tokens</option>
		<option value="1000 Tokens">1000 Tokens</option>
	</select>
	<br>
	<button type="submit" name="submit" class="btn btn-success"><i class="icon-shopping-cart icon-white"></i> Buy with Google</button>
	</td></tr>
	</tbody>
	</table>
	</div>
</div>
<? 
require_once("members/footer.php");
exit();
} elseif(isset($_POST['submit'])) {
	$u = $_COOKIE['username'];
	$res=$mysqli->query("SELECT `tokens`, `health` FROM `Players` WHERE `id` = '$_COOKIE[id]' LIMIT 1");
	$row=$res->fetch_assoc();
	$c=$row['tokens'];
	$h=$row['health'];
	
	$sr = $_POST['item'];
	if ($sr == 'nuclearsub'){
		if ($c < 20) {
			$type = 1;
		} elseif ($c >= 20) {
			$mysqli->query("INSERT INTO dock (username, boat, percent) VALUES ('$_COOKIE[id]', 'Nuclear Submarine', '100')");
			$mysqli->query("UPDATE Players SET tokens=(tokens-20) WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have bought a Nuclear Submarine!</div>";
		}
	} elseif ($sr == 'alltimer') {
		if ($c < 60) {
			$type = 1;
		} elseif ($c >= 60) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-60), crimetime='', gtatime='', haatime='', savtime='', ortime='', Airtravel='', Btravel='', btime=''  WHERE id='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("DELETE FROM prison WHERE username='$_COOKIE[id]' LIMIT 1");
			echo ("<div id=\"crimestext\" align=\"center\">You have reset all of your timers!</div>");
		}
	 } elseif ($sr == "tank") {
		if ($c < 15) {
			$type = 1;
		} elseif ($c >= 15) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-15) WHERE id='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("INSERT INTO garage (username, car, percent) VALUES ('$_COOKIE[id]', 'Tank', '100')");
			echo "<div id=\"crimestext\" align=\"center\">You have bought a Tank!</div>";
		}
	 } elseif ($sr == "everyoneprison") {
		if ($c < 5) {
			$type = 1;
		} elseif ($c >= 5) {
			$mysqli->query("TRUNCATE TABLE `prison`");
			$mysqli->query("UPDATE Players SET tokens=(tokens-5) WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have rescued everyone from Prison!</div>";
		}
	 } elseif ($sr == "fighter") {
		if ($c < 25) {
			$type = 1;
		} elseif ($c >= 25) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-25) WHERE id='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("INSERT INTO hanger (username, plane, percent) VALUES ('$_COOKIE[id]', 'Eurofighter Typhoon', '100')");
			echo "<div id=\"crimestext\" align=\"center\">You have bought a Eurofighter Typhoon!</div>";
		}
	 } elseif ($sr == "traveltimer") {
		if ($c < 5) {
			$type = 1;
		} elseif ($c >= 5) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-5), Airtravel='', Btravel='' WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You are now able to use the local Port and Airport early!</div>";
		}
	 } elseif ($sr == "Crimes") {
		if ($c < 5) {
			$type = 1;
		} elseif ($c >= 5) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-5), crimetime='' WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have reset your Crimes timer!</div>";
		}
	 } elseif ($sr == "GTA") {
		if ($c < 5) {
			$type = 1;
		} elseif ($c >= 5) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-5), gtatime='' WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have reset your GTA timer!</div>";
		}
	 } elseif ($sr == "HAA") {
		if ($c < 5) {
			$type = 1;
		} elseif ($c >= 5) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-5), haatime='' WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have reset your Hijack timer!</div>";
		}
	 } elseif ($sr == "SAV") {
		if ($c < 5) {
			$type = 1;
		} elseif ($c >= 5) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-5), savtime='' WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have reset your Pirate timer!</div>";
		}
	 } elseif ($sr == "OR") {
		if ($c < 40) {
			$type = 1;
		} elseif ($c >= 40) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-40), ortime='' WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have reset your Organised Robbery timer!</div>";
		}
	 } elseif ($sr == "bullets") {
		if ($c < 25) {
			$type = 1;
		} elseif ($c >= 25) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-25), bullets=(bullets+3000) WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have bought 3000 bullets!</div>";
		}
	 } elseif ($sr == "grenades") {
		if ($c < 10) {
			$type = 1;
		} elseif ($c >= 10) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-10), grenades=(grenades+20) WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have bought 15 grenades!</div>";
		}
	 } elseif ($sr == "health") {
		if ($c < 15) {
			$type = 1;
		} elseif ($c >= 15) {
			if ($h == 100) {
				echo "<div id=\"crimestext\" align=\"center\">You already have full health!</div>";
			} else if ($h < 75) {
				$mysqli->query("UPDATE Players SET tokens=(tokens-15), health=(health+25) WHERE id='$_COOKIE[id]' LIMIT 1");
				echo "<div id=\"crimestext\" align=\"center\">You gained back 25 health!</div>";
			} else {
				$mysqli->query("UPDATE Players SET tokens=(tokens-15), health='100' WHERE id='$_COOKIE[id]' LIMIT 1");
				echo "<div id=\"crimestext\" align=\"center\">You gained back 25 health!</div>";
			}	
		}
	 } elseif ($sr == "rankbar") {
		if ($c < 25) {
			$type = 1;
		} elseif ($c >= 25) {
			$res=$mysqli->query("SELECT rankbar FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
			$row=$res->fetch_array();
			$r=$row[0];
			if ($r == 1) {
				echo "<div id=\"crimestext\" align=\"center\">You already have a Rankbar! Go to the Rankbar page to view it.</div>";
			} elseif ($r == 0) {
				$mysqli->query("UPDATE Players SET tokens=(tokens-20), rankbar=1 WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have bought a Rankbar!</div>";
			}
		}
	 } elseif ($sr == "sniper") {
		if ($c < 45) {
			$type = 1;
		} elseif ($c >= 45) {
			$mysqli->query("UPDATE Players SET tokens=(tokens-45), barett=(barett+1) WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div id=\"crimestext\" align=\"center\">You have bought a Barrett .50 Caliber!</div>";
		}
	 } elseif ($sr == "username") {
		if ($c < 250) {
			$type = 1;
		} elseif ($c >= 250) {
			$cu = htmlspecialchars(addslashes(($_POST['cname'])));
			$res=$mysqli->query("SELECT `id` FROM Players WHERE `username`='$cu' LIMIT 1");
			if (empty($_POST['cname'])) {
				echo "<div id=\"crimestext\" align=\"center\">Please enter a new username so we can change it!</div>";
			} elseif (!eregi ('^[[:alnum:]0-9_\. \-]{1,50}$', stripslashes(trim($cu)))) {
				echo "<div id=\"crimestext\" align=\"center\">You may only use letters, numbers, and a select few symbols (-, _).</div>";
			} elseif ($res->num_rows > 0) {
				echo "<div id=\"crimestext\" align=\"center\">That username is already taken!</div>";
			} else {
				$mysqli->query("UPDATE Players SET tokens=(tokens-250), username='$cu' WHERE id='$_COOKIE[id]' LIMIT 1");
				$mysqli->query("UPDATE cthread SET author='$cu' WHERE author='$u'");
				$mysqli->query("UPDATE creply SET author='$cu' WHERE author='$u'");
				$mysqli->query("UPDATE thread SET author='$cu' WHERE author='$u'");
				$mysqli->query("UPDATE reply SET author='$cu' WHERE author='$u'");
				$mysqli->query("UPDATE wtbets SET username='$cu' WHERE username='$u'");
				$mysqli->query("UPDATE banking SET username='$cu' WHERE username='$u'");
				$mysqli->query("UPDATE roulette SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE WT SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE wf SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE BJT SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE BF SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE Bank SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE port SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE airport SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE Corps SET owner='$cu' WHERE owner='$u'");
				$mysqli->query("UPDATE Corps SET co='$cu' WHERE co='$u'");
				$mysqli->query("UPDATE Corps SET leftl='$cu' WHERE leftl='$u'");
				$mysqli->query("UPDATE Corps SET rightl='$cu' WHERE rightl='$u'");
				$mysqli->query("UPDATE Corps SET leftro='$cu' WHERE leftro='$u'");
				$mysqli->query("UPDATE Corps SET rightro='$cu' WHERE rightro='$u'");
				$mysqli->query("UPDATE gm SET seller='$cu' WHERE seller='$u'");
				$mysqli->query("UPDATE gm SET buyer='$cu' WHERE buyer='$u'");
				$mysqli->query("UPDATE mw SET who='$cu' WHERE who='$u'");
				$mysqli->query("UPDATE mw SET user='$cu' WHERE user='$u'");
				$mysqli->query("UPDATE prison SET username='$cu' WHERE username='$u'");
				$mysqli->query("UPDATE transfers SET wto='$cu' WHERE wto='$u'");
				$mysqli->query("UPDATE transfers SET wfrom='$cu' WHERE wfrom='$u'");
				$mysqli->query("UPDATE ttransfers SET wto='$cu' WHERE wto='$u'");
				$mysqli->query("UPDATE ttransfers SET wfrom='$cu' WHERE wfrom='$u'");
				echo "<div id=\"crimestext\" align=\"center\">Your username has been changed to $cu!</div>";
			}
		}
	} elseif ($sr == "silencer") {
		if ($c < 50) {
			$type = 1;
		} elseif ($c >= 50) {
			$res=$mysqli->query("SELECT `id` FROM `Players` WHERE `username` = '$_COOKIE[username]' AND `silencer` = '1' LIMIT 1");
			if ($res->num_rows > 0) {
				echo "<div id=\"crimestext\" align=\"center\">You already own a silencer!</div>";
			} else {
				$mysqli->query("UPDATE Players SET tokens=(tokens-50), silencer='1' WHERE id='$_COOKIE[id]' LIMIT 1");
				echo "<div id=\"crimestext\" align=\"center\">You successfully bought a silencer!</div>";
			}
		}
	} else {
		echo "<div id=\"crimestext\" align=\"center\">Please select an option!</div>";
	}
	if ($type == 1) {
		echo ("<div id=\"crimestext\" align=\"center\">You do not have enough Tokens to buy this!</div>");
	}
	require_once("members/footer.php");
	exit();
}
?>
<div class="well well-small">
	<legend>Purchase Tokens</legend>
	<a class="btn btn-primary" href="tokens.php?page=purchase"><i class="icon-shopping-cart icon-white"></i> Buy Tokens</a>
</div>

<div class="well">
<form method="post" action="tokens.php">
  <table class="table">
   <thead><tr><th>Select</th><th>Item</th><th>Price</th></tr></thead>
   <tbody>
   <tr>
     <td width="5%"><input type=radio name="item" value="Crimes"></td>
     <td>Reset Crimes timer</td> 
     <td>5 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="GTA"></td>
     <td>Reset GTA timer</td> 
     <td>5 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="HAA"></td> 
     <td>Reset Hijack timer</td> 
     <td>5 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="SAV"></td>
     <td>Reset Pirate timer</td> 
     <td>5 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="traveltimer"></td>
     <td>Reset Travel timer</td> 
     <td>5 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="everyoneprison"></td>
     <td>Bust everyone from Prison</td>
     <td>5 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="grenades"></td>
     <td>Buy 20 Grenades</td> 
     <td>10 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="health"></td>
     <td>Recover 25 health</td>
     <td>15 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="tank"></td>
     <td>Buy a Tank</td>
     <td>15 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="nuclearsub"></td> 
     <td>Buy a Nuclear Submarine</td>
     <td>20 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="bullets"></td>
     <td>Buy 3,000 bullets</td>
     <td>25 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="rankbar">
     <td>Buy a Rankbar</td>
     <td>25 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="fighter"></td> 
     <td>Buy a Eurofighter Typhoon</td>
     <td>25 Tokens</td>
   </tr>
     <td><input type=radio name="item" value="OR"></td>
     <td>Reset Heist timer</td>
     <td>40 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="sniper"></td> 
     <td>Buy a Barrett .50 Caliber</td>
     <td>45 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="silencer"></td>
     <td>Buy a Silencer</td>
     <td>50 Tokens</td>
   </tr>
   <tr>
     <td><input type=radio name="item" value="alltimer"></td> 
     <td>Reset ALL timers</td>
     <td>80 Tokens</td>
   </tr>
     <td><input type=radio name="item" value="username"></td>
     <td>Change your username</td>
     <td>250 Tokens</td>
   </tr>
</table>
   <span id="changeName">
     <label for="cname">Enter New Username</label> 
     <input type="text" name="cname" id="cname" />
     <br>
   </span>
   <button class="btn btn-success" name="submit" type="submit" value="Buy!"><i class="icon-shopping-cart icon-white"></i> Purchase</button>
</form>
</div>
<?
include("members/footer.php");
?>