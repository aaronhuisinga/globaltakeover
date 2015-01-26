<?php
$title="Kills";
include("config.php");
include("header.php");
checks();
online();

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
	$row=mysql_fetch_array(mysql_query("SELECT health, username, location, bullets, rank, money, silencer, exp, armor FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
	$uhealth = $row['health'];
	$user = $row['username'];
	$l = $row['location'];
	$ubullets = $row['bullets'];
	$urank = $row['rank'];
	$umoney = $row['money'];
	$silencer = $row['silencer'];
	$exp = $row['exp'];
	$uarmor = $row['armor'];
	
	$row=mysql_fetch_array(mysql_query("SELECT time, number, target, length, id, find, hunter FROM spies WHERE id='$id' LIMIT 1;")); 
	$starttime= $row['time'];
	$spies = $row['number'];
	$target = $row['target'];
	$length = $row['length'];
	$find = $row['find'];
	$hunter = $row['hunter'];
	$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE username = '$target' LIMIT 1"));
	$target=$row[0];

$secondsDiff = $current - $starttime;
$expire = ($length + 14400);
	
if ($secondsDiff <= $length) {
echo ("<div id='crimestext' align='center'>Your hunt hasn't finished yet!<br /><a href=\"/kills.php\">Go Back</a></div>");
include("footer.php");
exit();
} elseif ($secondsDiff >= $expire) {
echo ("<div id='crimestext' align='center'>Your hunt has expired!<br /><a href=\"/kills.php\">Go Back</a></div>");
include("footer.php");
exit();
} else {
if ($find == 'no') {
echo ("<div id='crimestext' align='center'>Your hunt failed!<br /><a href=\"kills.php\">Go Back</a></div>");
include("footer.php");
exit();
}
	
	$row=mysql_fetch_array(mysql_query("SELECT location, health, armor, rank, id, dead FROM Players WHERE username='$target' LIMIT 1;"));
	$tl = $row['location'];
	$thealth = $row['health'];
	$tarmor = $row['armor'];
	$trank = $row['rank'];
	$tid = $row['id'];
	$tstatus = $row['dead'];
		
	if ($_POST['s']) {
	$kill_bullets = intval(strip_tags(abs($_POST['bullets'])));
	if (!preg_match("/[0-9]/",$kill_bullets)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
	}
	if ($kill_bullets == 0) {
	echo ("<div id=\"ltable\"><center>You must shoot at least 1 bullet at your target!<br /><a href=\"shoot.php?id={$id}\">Go back.</a></center></div>");
	include("footer.php");
	exit();
	} elseif ($_POST['weapon'] == 'none') {
	echo ("<div id=\"ltable\"><center>You must choose a weapon to use!<br /><a href=\"shoot.php?id={$id}\">Go back.</a></center></div>");
	include("footer.php");
	exit();
	} elseif ($l != $tl) {
	echo ("<div id=\"ltable\"><center>You must be in the same location as the target to kill them!<br /><a href=\"shoot.php?id={$id}\">Go back.</a></center></div>");
	include("footer.php");
	exit();
	} elseif ($tstatus > 0 OR $thealth <= 0) {
	echo ("<div id=\"ltable\"><center>$target is already dead!<br /><a href=\"shoot.php?id={$id}\">Go back.</a></center></div>");
	include("footer.php");
	exit();
	} else {
	$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");
	if ($user != $hunter) {
	echo ("<div id=\"ltable\"><center>You must be the one who did the hunt to kill the target!<br /><a href=\"/kills.php\">Go back.</a></center></div>");
	include("footer.php");
	exit();
	} elseif ($ubullets < $_POST['bullets']) {
	echo ("<div id=\"ltable\"><center>Please enter an amount of bullets that you actually have!<br /><a href=\"shoot.php?id={$id}\">Go back.</a></center></div>");
	include("footer.php");
	exit();
	} else {
	$weapon = $_POST['weapon'];

	if($weapon == "luger"){ $your_gun_power = "1"; $gunpower = $kill_bullets*.00010; }
	elseif($weapon == "magnum"){ $your_gun_power = "1.5"; $gunpower = $kill_bullets*.00012; }
	elseif($weapon == "uzi"){ $your_gun_power = "2"; $gunpower = $kill_bullets*.00014; }
	elseif($weapon == "steyr"){ $your_gun_power = "2.5"; $gunpower = $kill_bullets*.00016; }
	elseif($weapon == "desert_eagle"){ $your_gun_power = "3"; $gunpower = $kill_bullets*.00018; }
	elseif($weapon == "p90"){ $your_gun_power = "3.5"; $gunpower = $kill_bullets*.00020; }
	elseif($weapon == "g36c"){ $your_gun_power = "4"; $gunpower = $kill_bullets*.00022; }
	elseif($weapon == "rpd"){ $your_gun_power = "4.5"; $gunpower = $kill_bullets*.00024; }
	elseif($weapon == "AK47"){ $your_gun_power = "5"; $gunpower = $kill_bullets*.00026; }
	elseif($weapon == "M4"){ $your_gun_power = "5.5"; $gunpower = $kill_bullets*.00028; }
	elseif($weapon == "stinger"){ $your_gun_power = "6"; $gunpower = $kill_bullets*.00030; }
	elseif($weapon == "saw"){ $your_gun_power = "6.5"; $gunpower = $kill_bullets*.00032; }
	elseif($weapon == "barett"){ $your_gun_power = "7"; $gunpower = $kill_bullets*.00034; }
	
	if($urank == "Wannabe"){ $krank = "517496.732"; }
	elseif($urank == "Recruit"){ $krank = "569307.189"; }
	elseif($urank == "Private"){ $krank = "621333.333"; }
	elseif($urank == "Soldier"){ $krank = "713732.026"; }
	elseif($urank == "Mercenary"){ $krank = "791633.987"; }
	elseif($urank == "Contract Killer"){ $krank = "1016640.523"; }
	elseif($urank == "Corporal"){ $krank = "1137490.196"; }
	elseif($urank == "Sergeant"){ $krank = "1225372.549"; }
	elseif($urank == "Staff Sergeant"){ $krank = "1403607.843"; }
	elseif($urank == "Lieutenant"){ $krank = "1500470.588"; }
	elseif($urank == "Captain"){ $krank = "1531869.291"; }
	elseif($urank == "Major"){ $krank = "1647209.150"; }
	elseif($urank == "Colonel"){ $krank = "1750477.124"; }
	elseif($urank == "Brigadier"){ $krank = "1835163.399"; }
	elseif($urank == "General"){ $krank = "1908294.118"; }
	elseif($urank == "Field Marshall"){ $krank = "1978052.287"; }
	elseif($urank == "Warlord"){ $krank = "2063307.189"; }
	elseif($urank == "Dictator"){ $krank = "2175650"; }
	elseif($urank == "Administrator"){ $krank = "9999999"; } // We have to have fun too, right?

	$powerone = ($your_gun_power*$krank) + ($krank*2);
	$powertwo = ($powerone*$gunpower);
	$power = round($powertwo/2);
	
	if($trank == "Wannabe"){ $rank = "408"; }
	elseif($trank == "Recruit"){ $rank = "659"; }
	elseif($trank == "Private"){ $rank = "910"; }
	elseif($trank == "Soldier"){ $rank = "1161"; }
	elseif($trank == "Mercenary"){ $rank = "1412"; }
	elseif($trank == "Contract Killer"){ $rank = "1663"; }
	elseif($trank == "Corporal"){ $rank = "1914"; }
	elseif($trank == "Sergeant"){ $rank = "2165"; }
	elseif($trank == "Staff Sergeant"){ $rank = "2416"; }
	elseif($trank == "Lieutenant"){ $rank = "2667"; }
	elseif($trank == "Captain"){ $rank = "2918"; }
	elseif($trank == "Major"){ $rank = "3169"; }
	elseif($trank == "Colonel"){ $rank = "3420"; }
	elseif($trank == "Brigadier"){ $rank = "3671"; }
	elseif($trank == "General"){ $rank = "3922"; }
	elseif($trank == "Field Marshall"){ $rank = "4093"; }
	elseif($trank == "Warlord"){ $rank = "4148"; }
	elseif($trank == "Dictator"){ $rank = "4279"; }

	$defense = ($thealth*$rank) + ($tarmor*$rank);
	$defense = $defense*$rank;
	$defense = round($defense/10);

	$new_bullets= ($ubullets - $kill_bullets);
	if($power > $defense ){ 
	$hit_money=mysql_fetch_object(mysql_query("SELECT SUM(price)AS jackpot FROM mw WHERE who='$target'"));
	$your_money=$umoney + $hit_money->jackpot; 
	mysql_query("UPDATE Players SET dead='2', health='0', tdeath='$date', td='$current' WHERE username='$target' LIMIT 1;");
	mysql_query("UPDATE Players SET bullets=(bullets-$kill_bullets), money='$your_money', exp=(exp+250) WHERE username='$user' LIMIT 1;");
	mysql_query("INSERT INTO `kills` ( `id` , `target` , `trank` , `shooter` , `bullets` , `date` ) VALUES ('', '$target', '$trank', '$user', '$kill_bullets', '$date')") or die(mysql_error());
	// Drop Props
	mysql_query("UPDATE airport SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE Bank SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE BF SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE BJT SET owner='None' WHERE Owner='$target' LIMIT 1;");
	mysql_query("UPDATE roulette SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE wf SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE WT SET owner='None' WHERE owner='$target' LIMIT 1;");
	// Clear out other info
	mysql_query("DELETE FROM mw WHERE who='$target'");
	mysql_query("DELETE FROM spies WHERE target='$target' AND hunter='$user'");				
	echo "<div id=\"ltable\"><center>The long hours of planning paid off. <br /> You killed <a href=\"profile.php?id={$tid}\">$target</a>.</center></div>";
	include("footer.php");

	// Send out a few Witness Statements
	if ($silencer == 1) {
	$offline = (time()-300);
	$set=mysql_query("SELECT * FROM Players WHERE username != '$user' AND username != '$target' AND online >= $offline AND Level = '0' ORDER BY id DESC LIMIT 1;");
	while($dns=mysql_fetch_object($set)){
	$subject = htmlspecialchars(addslashes("Witness Statement!"));
	$message = htmlspecialchars(addslashes("You witnessed $user pull the trigger of his weapon, and kill $target!"));
	mysql_query("INSERT INTO `pmessages` ( `id` , `touser` , `from` , `message` , `date` , `unread` , `title` ) VALUES ('', '$dns->username', 'Global Takeover', '$message', '$date', 'unread', '$subject')");
	}
	} else {
	$rand=rand(1,3);
	$i=0;
	while($i < $rand){
	$offline = (time()-300);
	$set= mysql_query("SELECT * FROM Players WHERE username != '$user' AND username != '$target' AND online >= $offline ORDER BY id DESC LIMIT $rand;");
	while($dns=mysql_fetch_object($set)){
	$subject = htmlspecialchars(addslashes("Witness Statement!"));
	$message = htmlspecialchars(addslashes("You witnessed $user pull the trigger of his weapon, and kill $target!"));
	mysql_query("INSERT INTO `pmessages` ( `id` , `touser` , `from` , `message` , `date` , `unread` , `title` ) VALUES ('', '$dns->username', 'Global Takeover', '$message', '$date', 'unread', '$subject')");
	$i++;
	}
	}
	}

	} else { 
	$dmg = ($power / $defense);
	$damage = round($dmg*100);
	$test = ($thealth - $damage);
	if ($test <= 0) {
	$hit_money=mysql_fetch_object(mysql_query("SELECT SUM(price)AS jackpot FROM mw WHERE who='$target'"));
	$your_money=$umoney + $hit_money->jackpot; 
	mysql_query("UPDATE Players SET dead='2', health='0', tdeath='$date', td='$current' WHERE username='$target' LIMIT 1;");
	mysql_query("UPDATE Players SET bullets=(bullets-$kill_bullets), money='$your_money', exp=(exp+250) WHERE username='$user' LIMIT 1;");
	mysql_query("INSERT INTO `kills` ( `id` , `target` , `trank` , `shooter` , `bullets` , `date` ) VALUES ('', '$target', '$trank', '$user', '$kill_bullets', '$date')") or die(mysql_error());
	// Drop Props
	mysql_query("UPDATE airport SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE Bank SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE BF SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE BJT SET owner='None' WHERE Owner='$target' LIMIT 1;");
	mysql_query("UPDATE roulette SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE wf SET owner='None' WHERE owner='$target' LIMIT 1;");
	mysql_query("UPDATE WT SET owner='None' WHERE owner='$target' LIMIT 1;");
	// Clear out other info
	mysql_query("DELETE FROM mw WHERE who='$target'");
	mysql_query("DELETE FROM spies WHERE target='$target' AND hunter='$user'");
	echo "<div id=\"ltable\"><center>The long hours of planning paid off. <br /> You killed <a href=\"profile.php?id={$tid}\">$target</a>.</center></div>";
	include("footer.php");

	// Send out a few Witness Statements
	if ($silencer == 1) {
	$offline = (time()-300);
	$set=mysql_query("SELECT * FROM Players WHERE username != '$user' AND username != '$target' AND online >= $offline AND Level = '0' ORDER BY id DESC LIMIT 1;");
	while($dns=mysql_fetch_object($set)){
	$subject = htmlspecialchars(addslashes("Witness Statement!"));
	$message = htmlspecialchars(addslashes("You witnessed $user pull the trigger of his weapon, and kill $target!"));
	mysql_query("INSERT INTO `pmessages` ( `id` , `touser` , `from` , `message` , `date` , `unread` , `title` ) VALUES ('', '$dns->username', 'Global Takeover', '$message', '$date', 'unread', '$subject')");
	}
	} else {
	$rand=rand(1,3);
	$i=0;
	while($i < $rand){
	$offline = (time()-300);
	$set= mysql_query("SELECT * FROM Players WHERE username != '$user' AND username != '$target' AND online >= $offline ORDER BY id DESC LIMIT $rand;");
	while($dns=mysql_fetch_object($set)){
	$subject = htmlspecialchars(addslashes("Witness Statement!"));
	$message = htmlspecialchars(addslashes("You witnessed $user pull the trigger of his weapon, and kill $target!"));
	mysql_query("INSERT INTO `pmessages` ( `id` , `touser` , `from` , `message` , `date` , `unread` , `title` ) VALUES ('', '$dns->username', 'Global Takeover', '$message', '$date', 'unread', '$subject')");
	$i++;
	}
	}
	}
	} else {
	if ($uarmor == 25) {
	$recoil = rand(70, 80);
	} elseif ($uarmor == 50) {
	$recoil = rand(50, 70);
	} elseif ($uarmor == 75) {
	$recoil = rand(30, 50);
	} elseif ($uarmor == 100) {
	$recoil = rand(10, 30);
	} else {
	$recoil = rand(60, 90);
	}
	$losthealth = ($uhealth - $recoil);
	
	if ($losthealth <= 0) {
	$new_bullets= ($ubullets - $kill_bullets);
	mysql_query("UPDATE Players SET health='$test' WHERE username='$target' LIMIT 1;");
	mysql_query("UPDATE Players SET bullets=(bullets-$kill_bullets), health='0', dead='1', tdeath='$date', td='$current' WHERE username='$user' LIMIT 1;");
	mysql_query("DELETE FROM spies WHERE target='$target' and hunter='$user'");
	// Drop Props
	mysql_query("UPDATE airport SET owner='None' WHERE owner='$user' LIMIT 1;");
	mysql_query("UPDATE Bank SET owner='None' WHERE owner='$user' LIMIT 1;");
	mysql_query("UPDATE BF SET owner='None' WHERE owner='$user' LIMIT 1;");
	mysql_query("UPDATE BJT SET owner='None' WHERE Owner='$user' LIMIT 1;");
	mysql_query("UPDATE roulette SET owner='None' WHERE owner='$user' LIMIT 1;");
	mysql_query("UPDATE wf SET owner='None' WHERE owner='$user' LIMIT 1;");
	mysql_query("UPDATE WT SET owner='None' WHERE owner='$user' LIMIT 1;");
	// Clear out other things.
	mysql_query("DELETE FROM spies WHERE hunter='$user' LIMIT 1;");
	
	$subject = htmlspecialchars(addslashes("Kill Attempt!"));
	$message = htmlspecialchars(addslashes("Out of no where, $user rushed and shot at you, and you lost $damage health! As you fled, you led him right into your ambush, and he was killed!"));
	mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$target', 'Global Takeover', 'unread', '$date')");		
	echo "<div id=\"ltable\"><center>You ambushed <a href=\"profile.php?id={$tid}\">$target</a>, but he was ready for you and fled!<br />You got a few shots off, and the target lost $damage health.<br />$target shot back, and you lost $recoil health. You were killed.</center></div>";
	include("footer.php");
	
	} else {
	$subject = htmlspecialchars(addslashes("Kill Attempt!"));
	$message = htmlspecialchars(addslashes("Out of no where, $user rushed and shot at you, taking $damage health! Luckily, you fled and got some shots off at him. You took $recoil of his health away."));
	mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$target', 'Global Takeover', 'unread', '$date')");					
	mysql_query("UPDATE Players SET health='$test' WHERE username='$target' LIMIT 1;");
	mysql_query("UPDATE Players SET bullets=(bullets-$kill_bullets), health='$losthealth' WHERE username='$user' LIMIT 1;");
	mysql_query("DELETE FROM spies WHERE target='$target' and hunter='$user'");
	echo "<div id=\"ltable\"><center>You ambushed <a href=\"profile.php?id={$tid}\">$target</a>, but he was ready for you and fled!<br />You got a few shots off, and the target lost $damage health.<br />$target shot back, and you lost $recoil health.</center></div>";
	include("footer.php");
	}}}}
	exit();
	}}}
	
	if ($silencer == 1) {
		$silence='(with silencer)';
	} else {
		$silence='';
	}
	
	$row=mysql_fetch_array(mysql_query("SELECT luger, magnum, uzi, steyr, desert_eagle, p90, g36c, rpd, AK47, M4, stinger, saw, barett FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
		$j = $row[0];
		$b = $row[1];
		$r = $row[2];
		$l = $row[3];
		$a = $row[4];
		$hl = $row[5];
		$p = $row[6];
		$bo = $row[7];
		$t = $row[8];
		$h = $row[9];
		$y = $row[10];
		$m = $row[11];
		$e = $row[12];
		$weapons = array();
		if ($j != 0) {
		$weapons[] = "<option value=\"luger\">Luger $silence</option>";
		}
		if ($b != 0) {
		$weapons[] = "<option value=\"magnum\">.44 Caliber Magnum $silence</option>";
		}
		if ($r != 0) {
		$weapons[] = "<option value=\"uzi\">Mini-Uzi $silence</option>";
		}
		if ($l != 0) {
		$weapons[] = "<option value=\"steyr\">Steyr $silence</option>";
		}
		if ($a != 0) {
		$weapons[] = "<option value=\"desert_eagle\">Desert Eagle $silence</option>";
		}
		if ($hl != 0) {
		$weapons[] = "<option value=\"p90\">P90 $silence</option>";
		}
		if ($p != 0) {
		$weapons[] = "<option value=\"g36c\">G36C $silence</option>";
		}
		if ($bo != 0) {
		$weapons[] = "<option value=\"rpd\">RPD $silence</option>";
		}
		if ($t != 0) {
		$weapons[] = "<option value=\"AK47\">AK47 $silence</option>";
		}
		if ($h != 0) {
		$weapons[] = "<option value=\"M4\">M4 $silence</option>";
		}
		if ($y != 0) {
		$weapons[] = "<option value=\"stinger\">Stinger $silence</option>";
		}
		if ($m != 0) {
		$weapons[] = "<option value=\"saw\">M249 SAW $silence</option>";
		}
		if ($e != 0) {
		$weapons[] = "<option value=\"barett\">Barrett .50 Caliber $silence</option>";
		}
	
	echo("<div id=\"ltable\"><center><form name='shoot' action='shoot.php?id={$id}' method='POST'>
	<table id=\"usertable\">
	<tr><td colspan=\"2\" class=\"top\" align=\"center\">Kill Setup</td></tr>
	<tr><td align=\"right\">Target:</td> <td>$target</td></tr>");
	echo ('<tr><td align="right">Weapon:</td> <td><select name="weapon">');
		echo "<option value=\"none\">Select a Weapon</option>";
 		foreach ($weapons as $msg) {
 		echo "$msg";
 		}
	echo ("<tr><td align=\"right\">Bullets:</td> <td><input type='text' name='bullets' value='0'></td></tr>
	</table>
	<center><input type='submit' name='s' value='Pull the trigger.'></center>
	</form></div>");
	include("footer.php");
	}
?>