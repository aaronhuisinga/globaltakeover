<?php
$title="Port Escrow";
include("config.php");
include("header.php"); 
checks();
online();

$result = mysql_query("SELECT username, money, bullets, tokens FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$u = $row[0];
$mon = $row[1];
$bullet = $row[2];
$token = $row[3];

		$row=mysql_fetch_array(mysql_query("SELECT id, location FROM port WHERE owner='$u' LIMIT 1;"));
		$aid = $row[0];
		$l = $row[1];
				
		if (mysql_num_rows($result) == 0) {
		if ($_REQUEST['Accept']) {
			$sql = mysql_query("SELECT * FROM pescrow WHERE other ='$u' LIMIT 1;");
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
			echo "<div id='crimestext' align='center'>You do not have enough to accept the escrow!<br><a href='/port.php'>Go Back</a></div>";
			include("footer.php");
			exit();
			}
			$nmoney = $mon - $tmoney;
			$nbullets = $bullet - $bullets;
			$ntoken = $token - $tokens;
			mysql_query("UPDATE Players SET money='$nmoney', bullets='$nbullets', tokens='$ntoken' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
			$sql = mysql_query("SELECT money, bullets, tokens FROM Players WHERE username = '$owner' LIMIT 1;");
			$row = mysql_fetch_array($sql);
			$omoney = $row[0];
			$obullets = $row[1];			
			$otokens = $row[2];
			$nmoney = $omoney + $money;
			$nbullets = $obullets + $bullets;
			$ntokens = $otokens + $tokens;
			mysql_query("UPDATE Players SET money='$nmoney', bullets='$nbullets', tokens='$ntokens' WHERE username='$owner' LIMIT 1;");
			mysql_query("UPDATE port SET owner='$u' WHERE location='$l' LIMIT 1;");
			mysql_query("INSERT INTO Playertoken (amount, date, username, outcome, btime, used) VALUES ('$tokens', '$date', '$u', 'Loss', '$current', 'Port escrow')");
			mysql_query("INSERT INTO Playertoken (amount, date, username, outcome, btime, used) VALUES ('$tokens', '$date', '$owner', 'Gain', '$current', 'Port escrow')");
			$subject = htmlspecialchars(addslashes("Escrow Finished"));
			$message = htmlspecialchars(addslashes("$u has accepted the escrow for the $l Port for $".number_format($money).", ".number_format($bullets)." Bullets and ".number_format($tokens)."Tokens!"));
			mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$owner', 'Global Takeover', 'unread', '$date')");
			mysql_query("DELETE FROM pescrow WHERE other = '$u' LIMIT 1;");
			echo "<div id='crimestext' align='center'>You have accepted and finished the escrow!<br><a href='porto.php'>Manage Port</a></div>";
			include("footer.php");
			exit();
			} else {
			echo "<div id='crimestext' align='center'>There is not an escrow open!<br><a href='/port.php'>Go Back</a></div>";
			include("footer.php");
			exit();
			}
		} elseif ($_REQUEST['Decline']) {
		$sql = mysql_query("SELECT * FROM pescrow WHERE other ='$u'");
			$row = mysql_fetch_array($sql);
			$other = $row['username'];
			if (mysql_num_rows($sql) == 1) {
			mysql_query("DELETE FROM pescrow WHERE other = '$u'");
			echo "<div id='crimestext' align='center'>The escrow was canceled!<br><a href='/port.php'>Go Back</a></div>";
			include("footer.php");
			$subject = htmlspecialchars(addslashes("Escrow Canceled"));
			$message = htmlspecialchars(addslashes("$u has canceled the escrow for the $l Port!"));
			mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$other', 'Global Takeover', 'unread', '$date')");
			exit();
			} else {
			echo "<div id='crimestext' align='center'>There is not an escrow open!<br><a href='/port.php'>Go Back</a></div>";
			include("footer.php");
			exit();
			}
		}
		} else {
		echo "<div id='crimestext' align='center'>You currently own an Airport, you cannot own two!<br><a href='/port.php'>Go Back</a></div>";
		include("footer.php");
		exit();
		}
?>