<?
include ("../config.php");
$twoweeks=(time()-1209600);

$res=$mysqli->query("SELECT `id`,`username` FROM Players WHERE `td`!='' AND ((`dead` > 0 AND `td` >= '$twoweeks') OR (`banned` = 1 AND `bd` >= '$twoweeks'))");
while($row=$res->fetch_assoc()) {
	$user=$row['username'];
	$pid=$row['id'];
	$mysqli->query("DELETE FROM garage WHERE username='$pid'");
	$mysqli->query("DELETE FROM hanger WHERE username='$pid'");
	$mysqli->query("DELETE FROM dock WHERE username='$pid'");
	$mysqli->query("DELETE FROM pmessages WHERE touser='$pid'");
	$mysqli->query("DELETE FROM outbox WHERE `from`='$pid'");
	$mysqli->query("DELETE FROM friendslist WHERE `username`='$user' OR `friend`='$user'");
	$mysqli->query("DELETE FROM enemyslist WHERE `username`='$user' OR `enemy`='$user'");
	$mysqli->query("DELETE FROM blocklist WHERE `username`='$user' OR `block`='$user'");
	$mysqli->query("DELETE FROM banking WHERE `username`='$user'");
	$mysqli->query("DELETE FROM kills WHERE `shooter`='$user'");
	$mysqli->query("UPDATE Players SET Profile='', corps='None', notes='', avatar='', td='' WHERE `id` = '$pid' LIMIT 1");
}
?>