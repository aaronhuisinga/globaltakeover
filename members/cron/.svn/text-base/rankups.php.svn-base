<?php
require_once('../config.php');
$stmt=$pdo->prepare('SELECT exp, rank, refplayer, breaks, prison_rank, id FROM Players WHERE `Online` > :time AND `rank` != 18 AND Level = 0');
$stmt->bindValue(':time', time()-3600, PDO::PARAM_INT);
$stmt->execute();

while($row=$stmt->fetch(PDO::FETCH_NUM)) {
	$exp=$row[0];
	$urank=($row[1])-1;
	$ref=$row[2];
	$breaks=$row[3];
	$prank=($row[4])-1;
	$id=$row[5];
	$ranks=array(150,650,2650,10150,22650,50150,85150,137150,214650,309650,430150,585150,780150,1005650,1300650,1675650,2200000);
	$need=$ranks[$urank];
	if($exp > $need) {
		$mysqli->query("UPDATE `Players` SET rank=(rank+1) WHERE id='$id' LIMIT 1");
		$mysqli->query("INSERT INTO `pmessages` (`title`,`message`,`touser`,`from`,`unread`,`date`) VALUES ('Promotion', 'Congratulations! You have been promoted! Keep up the good work!', '$id', 'Global Takeover', 'unread', '$date')");
		if($ref != '') {
			$newRank=($row[1])+1;
			if($newRank == '6') {
				$mysqli->query("UPDATE Players SET money=(money+1000000) WHERE username='$ref' LIMIT 1");
			} elseif ($newRank == '8') {
				$mysqli->query("UPDATE Players SET money=(money+10000000) WHERE username='$ref' LIMIT 1");
			} elseif ($newRank == '11') {
				$mysqli->query("UPDATE Players SET bullets=(bullets+5000) WHERE username='$ref' LIMIT 1");
			} elseif ($newRank == '15') {
				$mysqli->query("UPDATE Players SET bullets=(bullets+10000) WHERE username='$ref' LIMIT 1");
			} elseif ($newRank == '18') {
				$mysqli->query("UPDATE Players SET tokens=(tokens+75) WHERE username='$ref' LIMIT 1");
			}
		}
	}
	$pranks=array(10,30,60,120,240,400,600,850,1000,1200,1400,1600,1800,3000,5000);
	$pneed=$pranks[$prank];
	if($breaks > $pneed) {
		$mysqli->query("UPDATE Players SET `prison_rank`=(prison_rank+1) WHERE id='$id' LIMIT 1");
		$mysqli->query("INSERT INTO `pmessages` (`title`,`message`,`touser`,`from`,`unread`,`date`) VALUES ('Breaking Promotion', 'Congratulations! Your prison rank has increased! Keep up the good work!', '$id', 'Global Takeover', 'unread', '$date')");
	}
}
// Check and update online record
	$stmt=$pdo->prepare('SELECT id FROM Players WHERE online >= :time');
	$stmt->bindValue(':time', time()-300, PDO::PARAM_INT);
	$stmt->execute();
	$res=$mysqli->query("SELECT record FROM orecord LIMIT 1");
	$row=$res->fetch_array();
	if ($stmt->rowCount() > $row[0]) {
		$upd=$pdo->prepare('UPDATE orecord SET record = :totalon, date = :date LIMIT 1');
		$upd->bindParam(':totalon', $stmt->rowCount(), PDO::PARAM_INT);
		$upd->bindParam(':date', date("M d Y h:i:s A"), PDO::PARAM_STR);
		$upd->execute();
	}
?>	