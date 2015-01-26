<?php
ob_start();
include("config.php");
include("Online.php"); 
include("Rank-ups.inc.php");

$result = mysql_query("SELECT theme, username, money, bullets, tokens FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);

$u = $row[1];
$mon = $row[2];
$bullet = $row[3];
$token = $row[4];

$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

		$query = "SELECT id, location FROM WT WHERE owner='$u'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		$aid = $row[0];
		$l = $row[1];
				
		if (mysql_num_rows($result) == 0) {
		if ($_REQUEST['Accept']) {
			$sql = mysql_query("SELECT * FROM wtescrow WHERE other ='$u'");
			$row = mysql_fetch_array($sql);
			if (mysql_num_rows($sql) == 1) {
			$money = $row['money'];
			$bullets = $row['bullets'];
			$tokens = $row['tokens'];
			$owner = $row['username'];
			$l = $row['location'];
			$taxm = floor($money * 0.09);
			$tmoney = $money + $taxm;
			if ($tmoney > $mon OR $bullets > $bullet OR $tokens > $token) {
			echo "<div id='crimestext' align='center'>You do not have enough to accept the escrow!<br><a href='/Wt.php'>Go Back</a></div>";
			exit();
			}
			$nmoney = $mon - $tmoney;
			$nbullets = $bullet - $bullets;
			$ntoken = $token - $tokens;
			mysql_query("UPDATE Players SET money='$nmoney', bullets='$nbullets', tokens='$ntoken' WHERE id='{$_COOKIE['id']}'");
			$sql = mysql_query("SELECT money, bullets, tokens FROM Players WHERE username = '$owner' LIMIT 1");
			$row = mysql_fetch_array($sql);
			$omoney = $row[0];
			$obullets = $row[1];			
			$otokens = $row[2];
			$nmoney = $omoney + $money;
			$nbullets = $obullets + $bullets;
			$ntokens = $otokens + $tokens;
			mysql_query("UPDATE Players SET money='$nmoney', bullets='$nbullets', tokens='$ntokens' WHERE username='$owner' LIMIT 1");
			mysql_query("UPDATE WT SET owner='$u' WHERE location='$l'");
			$date = (date("M d Y h:i:s A"));
			$current = time();
			mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$tmoney', '$date', '$u', 'Loss', '$current', 'WT escrow')");
			mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$money', '$date', '$owner', 'Gain', '$current', 'WT escrow')");
			mysql_query("INSERT INTO Playertoken (amount, date, username, outcome, btime, used) VALUES ('$tokens', '$date', '$u', 'Loss', '$current', 'WT escrow')");
			mysql_query("INSERT INTO Playerbullets (amount, date, username, outcome, btime, used) VALUES ('$bullets', '$date', '$u', 'Loss', '$current', 'WT escrow')");
			mysql_query("INSERT INTO Playerbullets (amount, date, username, outcome, btime, used) VALUES ('$bullets', '$date', '$owner', 'Gain', '$current', 'WT escrow')");
			mysql_query("INSERT INTO Playertoken (amount, date, username, outcome, btime, used) VALUES ('$tokens', '$date', '$owner', 'Gain', '$current', 'WT escrow')");
			$subject = htmlspecialchars(addslashes("Escrow Finished"));
			$message = htmlspecialchars(addslashes("$u has accepted the escrow on $l War Table for $".number_format($money).", ".number_format($bullets)." Bullets and ".number_format($tokens)."Tokens!"));
			$to = $owner;
			$from = htmlspecialchars(addslashes("$u"));
			$date = (date("M d Y h:i:s A"));
			$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , 
			`touser` , `from` , `unread` , 
			`date` ) VALUES ('$subject', '$message', '$to', 
			'$from', 'unread', '$date')");
			mysql_query("DELETE FROM wtescrow WHERE other = '$u'");
			echo "<div id='crimestext' align='center'>You have accepted and finished the escrow!<br><a href='Wto.php'>Manage War</a></div>";
			exit();
			} else {
			echo "<div id='crimestext' align='center'>There is not an escrow open!<br><a href='/Wt.php'>Go Back</a></div>";
			exit();
			}
		} elseif ($_REQUEST['Decline']) {
		$sql = mysql_query("SELECT * FROM wtescrow WHERE other ='$u'");
			$row = mysql_fetch_array($sql);
			$other = $row['username'];
			if (mysql_num_rows($sql) == 1) {
			mysql_query("DELETE FROM wtescrow WHERE other = '$u'");
			echo "<div id='crimestext' align='center'>The escrow was cancelled!<br><a href='/Wt.php'>Go Back</a></div>";
			$subject = htmlspecialchars(addslashes("Escrow Canceled"));
			$message = htmlspecialchars(addslashes("$u has cancelled the escrow on $l War Table!"));
			$to = $other;
			$from = htmlspecialchars(addslashes("$u"));
			$date = (date("M d Y h:i:s A"));
			$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , 
			`touser` , `from` , `unread` , 
			`date` ) VALUES ('$subject', '$message', '$to', 
			'$from', 'unread', '$date')");
			exit();
			} else {
			echo "<div id='crimestext' align='center'>There is not an escrow open!<br><a href='/Wt.php'>Go Back</a></div>";
			exit();
			}
		}
		} else {
		echo "<div id='crimestext' align='center'>You currently own a War Table, you cannot own two!<br><a href='/Wt.php'>Go Back</a></div>";
		exit();
		}
?>