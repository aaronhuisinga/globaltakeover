<?php
$title="Manage Bullet Escrows";
include("config.php");
include("header.php");
checks();
online();	

$row=mysql_fetch_array(mysql_query("SELECT username, corps, money, bullets, tokens FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$c = $row[1];
$m = $row[2];
$b = $row[3];
$t = $row[4];

$currente=$_POST['eaction'];
if ($currente == NULL OR $currente=='') {
echo "<div id=\"crimestext\" align=\"center\">You must select at least one escrow to manage!<br /><a href='escrowp.php'>Go Back.</a></div>";
include("footer.php");
exit();
}
$acc=0; $dec=0; $nsnt=0; $done=0; $nmoney=0; $dbanned=0;
$id=$_POST['eid'];
if ($currente == 'accept') {
	$row=mysql_fetch_array(mysql_query("SELECT * FROM bescrow WHERE id='$id' LIMIT 1;"));
	$test=$row['other'];
	$finish=$row['finished'];
	$user=$row['username'];
	$mon=$row['money'];
	$mone=floor($mon * 0.09);
	$mone=$mon + $mone;
	$tok=$row['tokens'];
	$am=$row['amount'];
	$row=mysql_fetch_array(mysql_query("SELECT health, banned, dead FROM Players WHERE username='$user' LIMIT 1;"));
	$uh=$row[0]; $ubanned=$row[1]; $udead=$row[2];
	if ($u != $test) {
	$nsnt=1;
	} elseif ($finish != 'Pending') {
	$done=1;
	} elseif ($m < $mone OR $t < $tok) {
	$nmoney=1;
	} elseif ($uh <= 0 OR $ubanned != 0 OR $udead != 0) {
	$dbanned=1;
	} else {
	mysql_query("UPDATE Players SET money=(money-$mone), tokens=(tokens-$tok), bullets=(bullets+$am) WHERE id='{$_COOKIE['id']}' LIMIT 1;");
	mysql_query("UPDATE Players SET money=(money+$mon), tokens=(tokens+$tok) WHERE username='$user' LIMIT 1;");
	mysql_query("INSERT INTO Playertoken (amount, date, username, outcome, btime, used) VALUES ('$am', '$date', '$user', 'Gain', '$current', 'Token Escrow')");
	mysql_query("INSERT INTO Playertoken (amount, date, username, outcome, btime, used) VALUES ('$am', '$date', '$u', 'Loss', '$current', 'Token Escrow')");
	mysql_query("UPDATE bescrow SET finished = 'Accepted' WHERE id='$id' LIMIT 1;");
	$acc=1;
	$subject = htmlspecialchars(addslashes("Escrow Finished"));
	$message = htmlspecialchars(addslashes("The escrow to $u for ".number_format($am)." bullets was accepted for $".number_format($mon)." and ".number_format($tok)." Tokens"));
	mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$user', 'Global Takeover', 'unread', '$date')");
	}
} elseif ($currente == 'decline') {
	$row=mysql_fetch_array(mysql_query("SELECT * FROM bescrow WHERE id='$id' LIMIT 1;"));
	$test=$row['other'];
	$finish = $row['finished'];
	if ($u != $test) {
	$nsnt=1;
	} elseif ($finish != 'Pending') {
	$done=1;
	} else {
	$user = $row['username'];
	$am = $row['amount'];
	mysql_query("UPDATE Players SET bullets=(bullets+$am) WHERE username='$user' LIMIT 1;");
	mysql_query("DELETE FROM bescrow WHERE id='$id' LIMIT 1;");
	$dec=1;
	$subject = htmlspecialchars(addslashes("Escrow Declined"));
	$message = htmlspecialchars(addslashes("The escrow to $u for ".number_format($am)." bullets was declined"));
	mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$user', 'Global Takeover', 'unread', '$date')");
	}
} else {
}
echo "<div id=\"crimestext\" align=\"center\">";
if ($nsnt != 0) { echo "The escrow could not be accepted because it was not sent to you.<br />"; }
if ($done != 0) { echo "The escrow could not be accepted because it had already accepted or canceled.<br />"; }
if ($nmoney != 0) { echo "The escrow was not accepted because you didn't have enough money to afford it.<br />"; }
if ($dbanned != 0) { echo "The escrow was not accepted because the starter of it is either dead or banned. It will now be automatically declined.<br />";
					 mysql_query("DELETE FROM bescrow WHERE id='$id' LIMIT 1;"); }
if ($acc != 0) { echo "The escrow was accepted. You gained ".number_format($am)." bullets, and spent $".number_format($mone)." and ".number_format($tok)." Tokens.<br />"; }
if ($dec != 0) { echo "The escrow was declined. $user was notified.<br />"; }
echo "<a href='escrowp.php'>Go Back.</a></div>";
include("footer.php");
?>