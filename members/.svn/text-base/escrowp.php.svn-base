<?
$title="Incoming Escrows";
include("config.php");
include("header.php");

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u=$row[0];

echo "<div id=\"ltable\" align=\"center\"><h1>Incoming Escrows</h1>
	  <table id=\"usertable\" width=\"80%\"><tr class=\"top\"><td colspan=\"5\" align=\"center\"><b>Token Escrows</b></td></tr>
	  <tr><td align=\"center\"><b>Username</b></td> <td align=\"center\"><b>Amount</b></td><td align=\"center\"><b>Money</b></td><td align=\"center\"><b>Bullets</b></td><td align=\"center\"><b>Action</b></td></tr>";
$query = mysql_query ("SELECT * FROM tescrow WHERE other='$u' AND finished='Pending'");
	$t = 0;
	while ($row=mysql_fetch_array($query)){
	$id = $row['id'];
	$uname = $row['username'];
	$am = $row['amount'];
	$mon = $row['money'];
	$mone = $mon * 0.09;
	$mon = $mon + $mone;
	$bull = $row['bullets'];
	$sql = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$uname' LIMIT 1;"));
	$uid = $sql[0];
	$t = $t + 1;
	echo "<tr><td align=\"center\"><a href=\"profile.php?id=$uid\">$uname</a></td><td align=\"center\">".number_format($am)."</td><td align=\"center\">$".number_format($mon)."</td><td align=\"center\">".number_format($bul)."</td>
		  <td width=\"10%\" align=\"center\"><form action=\"escrowt.php\" method=\"post\"><input type=\"hidden\" name=\"eid\" value=\"$id\"><select name=\"eaction\"><option value=\"accept\">Accept</option><option value=\"decline\">Decline</option></select><input type=\"submit\" name=\"Submit!\" value=\"Submit\"></form></tr>";
	}
	echo "</table><br />";
	
	
	echo "<table id=\"usertable\" width=\"80%\"><tr class=\"top\"><td colspan=\"5\" align=\"center\"><b>Bullet Escrows</b></td></tr>
		  <tr><td align=\"center\"><b>Username</b></td> <td align=\"center\"><b>Amount</b></td><td align=\"center\"><b>Money</b></td><td align=\"center\"><b>Tokens</b></td><td align=\"center\"><b>Action</b></td></tr>";
$query = mysql_query ("SELECT * FROM bescrow WHERE other='$u' AND finished='Pending'");
	$t = 0;
	while ($row=mysql_fetch_array($query)){
	$id = $row['id'];
	$uname = $row['username'];
	$am = $row['amount'];
	$mon = $row['money'];
	$mone = $mon * 0.09;
	$mon = $mon + $mone;
	$bull = $row['tokens'];
	$sql = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$uname'"));
	$uid = $sql[0];
	$t = $t + 1;
	echo "<tr><td align=\"center\"><a href=\"profile.php?id=$uid\">$uname</a></td> <td align=\"center\">".number_format($am)."</td><td align=\"center\">$".number_format($mon)."</td><td align=\"center\">".number_format($bul)."</td>
		  <td width=\"10%\" align=\"center\"><form action=\"escrowb.php\" method=\"post\"><input type=\"hidden\" name=\"eid\" value=\"$id\"><select name=\"eaction\"><option value=\"accept\">Accept</option><option value=\"decline\">Decline</option></select><input type=\"submit\" name=\"Submit!\" value=\"Submit\"></form></tr>";
	}
	echo "</table></div>";
	include("footer.php");	
?>	