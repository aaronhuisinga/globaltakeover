<?php 
ob_start(); 
include ("config.php"); 
checks();

$result = mysql_query("SELECT money, username FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$umoney = $row[0];
$username = $row[1];

$lotto_inf=mysql_fetch_object(mysql_query("SELECT * FROM lotto_info WHERE id='1'"));
$lotto = mysql_fetch_object(mysql_query("SELECT * FROM lotto"));
$totalrows=mysql_num_rows(mysql_query("SELECT * FROM lotto"));


if ($lotto_inf->tickets >= 100){
	$winner = rand(1,100);
	$winz=mysql_fetch_object(mysql_query("SELECT * FROM lotto WHERE id='$winner'"));

$tax = ($lotto_inf->jackpot * .06);
$finalwinnings = ($lotto_inf->jackpot - $tax);

		$subject = htmlspecialchars(addslashes("Global Takeover Lottery"));
		$message = htmlspecialchars(addslashes("Congratulations! You won the Global Takeover lottery! You received $".number_format($finalwinnings)."!"));
		$to = $winz->owner;
		$from = htmlspecialchars(addslashes("Global Takeover"));
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$to', '$from', 'unread', '$date')");
		mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$finalwinnings', '$date', '$winz->owner', 'Gain', '$current', 'Lotto Win')");
		mysql_query("UPDATE Players SET money = money+$finalwinnings WHERE username='$winz->owner'");
		mysql_query("DELETE FROM `lotto` WHERE owner='$winz->owner'");
		
$gather = mysql_query("SELECT owner FROM `lotto` WHERE count='1'");
while ($row=mysql_fetch_array($gather)){
$losername = $row[0];
	$sql = mysql_query("SELECT SUM( count ) AS ltickets FROM lotto WHERE owner = '$losername'");
	$row = mysql_fetch_array($sql);
		$ltickets=$row[0];
		if ($ltickets > 1) {
			$deleten=($ltickets - 1);
			mysql_query("DELETE FROM `lotto` WHERE owner='$losername' LIMIT $deleten;");
			echo("Deleted $deleten!");
		}
}
$gather = mysql_query("SELECT owner FROM `lotto` WHERE count='1'");
while ($row=mysql_fetch_array($gather)){
$losername = $row[0];
		$subject = htmlspecialchars(addslashes("Global Takeover Lottery"));
		$message = htmlspecialchars(addslashes("Unfortunately you did not win the Global Takeover lottery. The winner was $winz->owner."));
		$to = $losername;
		$from = htmlspecialchars(addslashes("Global Takeover"));
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$to', '$from', 'unread', '$date')");
}

$time = time() +(86400 * 3);
$new_num =$lotto_inf->lotto_num + 1;
	mysql_query("UPDATE lotto_info SET lotto_num = '$new_num', tickets='0', winning_ticket='$winner', winner='$winz->owner', jackpot='0'");
    mysql_query("TRUNCATE TABLE lotto");
}

if (strip_tags($_POST['amount']) && strip_tags($_POST['Submit'])){
$amount=abs($_POST['amount']);
	if (($amount > 5 OR $amount < 1) || !$amount || ereg('[^0-9]',$amount)){
	echo "<div id=\"crimestext\"><center>Please enter a number 1-5 tickets to purchase. <br /> <a href=\"lottery.php\">Go back.</a></center></div>";
	exit();
} elseif ($amount <= 5 AND $amount > 0 || $amount || !ereg('[^0-9]',$amount)) {
$cost= $lotto_inf->price * $amount;

if ($cost > $umoney){
echo "<div id=\"crimestext\"><center>You don't have enough money to buy these. <br /> <a href=\"lottery.php\">Go back.</a></center></div>";
exit();
} elseif ($cost <= $umoney) {
$number=$amount;

$sql = mysql_query("SELECT SUM( count ) AS ttickets FROM lotto WHERE owner = '$username'");
	$row = mysql_fetch_array ($sql);
	$ttickets = $row[0];
$ntickets = ($ttickets + $amount);
if ($ttickets >= 5) {
echo "<div id=\"crimestext\"><center>You have already purchased 5 tickets for this lottery. <br /> <a href=\"lottery.php\">Go back.</a></center></div>";
exit();

} elseif ($ntickets > 5) {
echo "<div id=\"crimestext\"><center>You cannot buy this many tickets for the lottery. <br /> <a href=\"lottery.php\">Go back.</a></center></div>";
exit();	
} else {
$current = 0;
while ($current < $number) {
mysql_query("INSERT INTO `lotto` (`id`, `owner`) VALUES ('', '$username');");
$current++;
}
mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$cost', '$date', '$username', 'Loss', '$current', 'Lotto Tickets')");
mysql_query("UPDATE lotto_info SET jackpot=jackpot+$cost, tickets=tickets+$amount WHERE id='1'");
mysql_query("UPDATE Players SET money=money-$cost WHERE username='$username'");
echo "<div id=\"crimestext\"><center>You bought $amount tickets. <br /> <a href=\"lottery.php\">Go back.</a></center></div>";
exit();
}
}}
}
?>

<html>
<head>
<title>Lottery</title>
</head>
<body>
<div id="gameplay">
<center>
<form name="form1" method="post" action="">
  <table width="40%" id="usertable">
    <tr class="top"> 
      <td height=20 colspan="2"><center>Lottery</center></td>
    </tr>
    <tr> 
      <td>Price per ticket:</td>
      <td><?php echo "&#36;".number_format($lotto_inf->price).""; ?></td>
    </tr>
    <tr> 
      <td>Current jackpot:</td>
      <td><?php echo "&#36;".number_format($lotto_inf->jackpot).""; ?></td>
    </tr>
    <tr> 
      <td>Tickets sold:</td>
      <td><?php echo "$totalrows"; ?></td>
    </tr>
    <tr> 
      <td>Buy tickets:</td>
      <td><input name="amount" type="text" id="amount" size="15" maxlength="3">
        <input name="Submit" type="submit" id="Submit" value="Buy"></td>
    </tr>
    <tr> 
      <td>Your tickets:</td>
      <td><? $abc=mysql_query("SELECT * FROM lotto WHERE owner='$username'"); $r=mysql_num_rows($abc);
	  if ($r == "0"){
	  echo "None";
	  }
	  while($p=mysql_fetch_object($abc)){
	  echo " $p->id, ";
	  }
	  ?>
	  </td>
    </tr>
  </table>
  </form>
  <p>The Lottery takes place after 100 tickets have been purchased.<br />
  Each player can only buy 5 tickets in each Lottery.<br />
  There is a 6% tax on the prize.</p>
</body>
</html>