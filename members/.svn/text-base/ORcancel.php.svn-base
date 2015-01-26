<?php
$title="Organized Robbery";
include("config.php");
include("header.php");
checks();

$row=mysql_fetch_array(mysql_query("SELECT username, money, location FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];
$l = $row[2];

if ($_REQUEST['Cancel']) {
	$row=mysql_fetch_array(mysql_query("SELECT * FROM Robbery WHERE leader='$u' LIMIT 1;"));
	$lead = $row['leader'];
	$driver = $row['driver'];
	$ee = $row['ee'];
	$wep = $row['wep'];
	$rcar = $row['vehicle'];
	$explosive = $row['explosive'];
	$lgun = $row['lwep'];
	$dgun = $row['dwep'];
	$egun = $row['ewep'];
	$wgun = $row['wwep'];

	if ($u != $lead) {
		echo '<div id="crimestext" align="center">You are not the leader of this Organized Robbery, so you cannot cancel it.<br /><a href="OR.php">Go back.</a></div>';
		include("footer.php");
		exit();
	} else {
	
		if ($lead != 'None' AND $driver != 'None' AND $ee != 'None' AND $wep != 'None' AND $rcar != NULL AND $explosive != NULL AND $lgun != NULL AND $dgun != NULL AND $egun != NULL AND $wgun != NULL) {
			echo '<div id="crimestext" align="center">You cannot cancel a full Organized Robbery!</div>';
			include("footer.php");
			exit();
		} else {
			echo '<div id="crimestext" align="center">You have canceled the Organized Robbery. All members will be informed!<br /><a href="OR.php">Go back.</a></div>';
			include("footer.php");
			mysql_query("DELETE FROM Robbery WHERE leader='$u' LIMIT 1;");
			$row=mysql_fetch_array(mysql_query("SELECT id, postid FROM thread WHERE author='$u' AND ads='yes' LIMIT 1;"));
			$id=$row[0];
			$pid=$row[1];
			mysql_query("DELETE FROM post WHERE id='$pid' LIMIT 1;");
			mysql_query("DELETE FROM thread WHERE id='$id' LIMIT 1;");
			$sql=mysql_query("SELECT postid FROM reply WHERE topicid='$id'");
			while ($row=mysql_fetch_array($sql)){
			$rid=$row[0];
			mysql_query("DELETE FROM post WHERE id='$rid'");
			mysql_query("DELETE FROM reply WHERE topicid='$id'");
			}
			$arr= array($driver, $ee, $wep);
			foreach ($arr as $pos) {
				if ($pos != 'None') {
					$subject = htmlspecialchars(addslashes("Organized Robbery Canceled!"));
					$message = htmlspecialchars(addslashes("$lead has canceled the Organized Robbery that you were a part of."));
					mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$pos', 'Global Takeover', 'unread', '$date')");
				}
			}
			exit();
		}
	}
} else {
echo '<div id="crimestext" align="center">Please decide what you are going to do, first!<br /><a href="OR.php">Go back.</a></div>';
include("footer.php");
exit();
}
?>		