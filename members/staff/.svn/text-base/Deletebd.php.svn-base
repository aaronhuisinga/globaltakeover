<?
include ("config.php");
checks();

$result = mysql_query("SELECT level FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$level = $row[0];

	if ($level == 2) {
	if ($_POST['destoryearth']) {
	$select = mysql_query("SELECT * FROM Players WHERE dead = 1 OR dead = 2 OR banned = 1");
	while ($row = mysql_fetch_array($select)) {
	$user = $row['username'];
	$car = mysql_query("SELECT * FROM garage WHERE username='$user'");
	$card = mysql_query("DELETE FROM garage WHERE username='$user'");
	$tcd = mysql_num_rows($car);
	$plane = mysql_query("SELECT * FROM hanger WHERE username='$user'");
	$planed = mysql_query("DELETE FROM hanger WHERE username='$user'");
	$tpd = mysql_num_rows($plane);
	$boat = mysql_query("SELECT * FROM dock WHERE username='$user'");
	$boatd = mysql_query("DELETE FROM dock WHERE username='$user'");
	$tdd = mysql_num_rows($boat);
	$pm = mysql_query("SELECT * FROM pmessages WHERE touser='$user'");
	$pmd = mysql_query("DELETE FROM pmessages WHERE touser='$user'");
	$tpmd = mysql_num_rows($pm);
	$om = mysql_query("SELECT * FROM outbox WHERE `from`='$user'");
	$omd = mysql_query("DELETE FROM outbox WHERE `from`='$user'");
	$tomd = mysql_num_rows($om);
	$friend = mysql_query("SELECT * FROM friendslist WHERE `username`='$user' OR `friend`='$user'");
	$friendd = mysql_query("DELETE FROM friendslist WHERE `username`='$user' OR `friend`='$user'");
	$frd = mysql_num_rows($friend);
	$enemy = mysql_query("SELECT * FROM enemyslist WHERE `username`='$user' OR `enemy`='$user'");
	$enemyd = mysql_query("DELETE FROM enemyslist WHERE `username`='$user' OR `enemy`='$user'");
	$enm = mysql_num_rows($enemy);
	$block = mysql_query("SELECT * FROM blocklist WHERE `username`='$user' OR `block`='$user'");
	$blockd = mysql_query("DELETE FROM blocklist WHERE `username`='$user' OR `block`='$user'");
	$blk = mysql_num_rows($block);
	$tmd = $tpmd + $tomd;
	$tc = $tc + $tcd;
	$tp = $tp + $tpd;
	$td = $td + $tdd;
	$tm = $tm + $tmd;
	$fr = $fr + $frd;
	$en = $en + $enm;
	$bk = $bk + $blk;
	}	
	echo "<div id='crimestext'><center>You have sucessfully destroyed the earth!<br>$tc Cars were destoryed
	<br>$tp Planes were destoryed<br>$td Boats were destoryed<br>$tm Messages were destoryed<br>$fr Friendships were destroyed<br>$en Enemies were destroyed!<br>$bk Blocks were destroyed!</div></center>";
	} else {
	echo "<div id='crimestext'><center>Do you want to destroy the earth?<br><form action=''method='POST'><input type='submit' name='destoryearth' value='Boom'></center></form></div>";
	}
} else {
echo "You have not got the powers to access this!";
exit();
}
?>