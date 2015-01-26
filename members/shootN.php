<?php
ob_start(); 
include("config.php");
include("Online.php");
include ("profilecode.php");
include("Banned.php");

$query = "SELECT theme FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$theme = $row[0];

if ($theme != NULL) {

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />");

} else {
$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />");

$theme = 'style';
}

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
	$query = "SELECT health, username, location, bullets, rank, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;";
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);

	$uhealth = $row['health'];
	$user = $row['username'];
	$l = $row['location'];
	$ubullets = $row['bullets'];
	$urank = $row['rank'];
	$umoney = $row['money'];
	
	if ($uhealth == 0) {
	 	$url .= '/dead.html';
		header("Location: $url");
			
	} else {
	
	$gather=mysql_query("SELECT time, number, target, length, id, find, hunter FROM mspies WHERE id='$id'"); 
	$row = mysql_fetch_assoc($gather);

	$starttime= $row['time'];
	$spies = $row['number'];
	$target = $row['target'];
	$length = $row['length'];
	$find = $row['find'];
	$hunter = $row['hunter'];
	$actualDate = time();
$secondsDiff = $actualDate - $starttime;
$expire = ($length + 14400);
	
if ($secondsDiff <= $length) {
echo ("<div id='crimestext' align='center'>Your hunt hasn't finished yet!<br><a href=\"missions.php\">Go Back</a></div>");
exit();
} elseif ($secondsDiff >= $expire) {
echo ("<div id='crimestext' align='center'>Your hunt has expired!<br><a href=\"missions.php\">Go Back</a></div>");
exit();
} else {

if ($find == 'yes') {


} elseif ($find == 'no') {
echo ("<div id='crimestext' align='center'>Your hunt has failed!<br><a href=\"missions.php\">Go Back</a></div>");
exit();
}
	$query = ("SELECT location, health, armor, rank, id, dead FROM Players WHERE username='$target'");
	$result = @mysql_query ($query);
	$row = mysql_fetch_assoc($result);
	
	
	$thealth = 100;
	$tarmor = 0;
	$trank = 'Soldier';
	$tid = $row['id'];
	$tstatus = $row['dead'];
	
	$tl = 'Philippines';
	if ($_POST['s']) {
	$kill_bullets = intval(strip_tags(abs($_POST['bullets'])));
	if ($kill_bullets == 0) {
	echo ("<div id=\"gameplay\"><center>You must shoot at least 1 bullet at your target!<br />
	<a href=\"shootN.php?id={$id}\">Go back.</a></center></div>");
	exit();
	} elseif ($_POST['weapon'] == 'none') {
	echo ("<div id=\"gameplay\"><center>You must choose a weapon to use!<br />
	<a href=\"shootN.php?id={$id}\">Go back.</a></center></div>");
	exit();
	} elseif ($l != $tl) {
	echo ("<div id=\"gameplay\"><center>You must be in the same location as the target to kill them!<br />
	<a href=\"shootN.php?id={$id}\">Go back.</a></center></div>");
	exit();
	} else {
	$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

	if ($user != $hunter) {
	echo ("<div id=\"gameplay\"><center>You must be the one who did the hunt to kill the target!<br />
	<a href=\"/members/missions.php\">Go back.</a></center></div>");
	exit();
	} elseif ($ubullets < $_POST['bullets']) {
	echo ("<div id=\"gameplay\"><center>Please enter an amount of bullets that you actually have!<br />
	<a href=\"shootN.php?id={$id}\">Go back.</a></center></div>");
	exit();
	} else {
	$weapon = $_POST['weapon'];
	// Time to kill them! Now comes the excitement (and probably a really long script.)

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
	
	/*  Wannabe 2102/461337               1 bullet = 791.77           517,496.732
        Recruit 1911/420415               1 bullet = 871.04           569,307.189
		Private 1751/385211               1 bullet = 950.64           621,333.333
		Soldier 1524/335342               1 bullet = 1092.01          713,732.026
		Mercenary 1374/302343             1 bullet = 1211.20          791,633.987
		Contract killer 1070/235426       1 bullet = 1555.46          1,016,640.523
		Corporal 957/210414               1 bullet = 1740.36          1,137,490.196
		Sergeant 888/195324               1 bullet = 1874.82          1,225,372.549
		Staff sergeant 775/170521         1 bullet = 2147.52          1,403,607.843
		Lieutenant 725/159513             1 bullet = 2295.72          1,500,470.588
		Captain 710/156243                1 bullet = 2343.76          1,531,869.291
		Major 661/145303                  1 bullet = 2520.23          1,647,209.150
		Colonel 622/136731                1 bullet =  2678.23         1,750,477.124      
		Brigadier 593/130421              1 bullet =  2807.80         1,835,163.399
		General 570/125423                1 bullet = 2919.69          1,908,294.118
		Field Marshall  550/121000        1 bullet = 3026.42          1,978,052.287
		`Warlord 527/116000               1 bullet = 3156.86          2,063,307.189
		`Dictator 505/111002              1 bullet = 3299.00          2,175,650.000
		110500 range needed?
		max = 366,196,820
		min = 1,664,640
		1 = .00153
	*/
	
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
	$time = (date("M d Y h:i:s A")); 
	$new_bullets= ($ubullets - $kill_bullets);
	if($power > $defense ){ 
	$hit_money=mysql_fetch_object(mysql_query("SELECT SUM(price)AS jackpot FROM mw WHERE who='$target'"));
	$your_money=$umoney + $hit_money->jackpot; 
	mysql_query("UPDATE Players SET dead='1', health='0', tdeath='$time', money='0', bullets='0' WHERE username='$target'");
	mysql_query("UPDATE Players SET bullets='$new_bullets', money='$your_money' WHERE username='$user'");
	$sql = mysql_query("UPDATE mission10 SET missionstats = '5' WHERE username = '$user'");
	// Drop Props
	
	mysql_query("DELETE FROM mspies WHERE target='$target' and hunter='$user'");
	$current = time();
	$date = (date("M d Y h:i:s A"));					
	mysql_query("INSERT INTO Playerbullets (amount, date, username, outcome, btime, used) VALUES ('$kill_bullets', '$date', '$user', 'Loss', '$current', 'Shooting')");
	echo "<div id=\"gameplay\"><center>The long hours of planning paid off.<br />
	You killed $target.<br>
	<form action=\"mission10.php\" method= \"POST\"><input type=\"submit\" name=\"Finish\" value=\"Finish Mission!\"></form></center></div>";

	// Send out a few Witness Statements :)
	$rand=0;
	$i=1;

	while($i < $rand){
	$offline = (time()-300);
	$date = (date("M d Y h:i:s A"));
	$set= mysql_query("SELECT * FROM Players WHERE username != '$user' AND username != '$target' AND online >= $offline ORDER BY id DESC LIMIT 3");
	while($dns=mysql_fetch_object($set)){
	$subject = htmlspecialchars(addslashes("Witness Statement!"));
	$message = htmlspecialchars(addslashes("You witnessed $user pull the trigger of his weapon, and kill $target!"));
	mysql_query("INSERT INTO `pmessages` ( `id` , `touser` , `from` , `message` , `date` , `unread` , `title` ) 
	VALUES ('', '$dns->username', 'Global Takeover', '$message', '$date', 'unread', '$subject')");
	$i++;
	}
	}

	} else { 
	$dmg = ($power / $defense);
	$damage = round($dmg*100);
	$test = ($thealth - $damage);
	
	$recoil = rand(30, 90);
	
	$losthealth = ($uhealth - $recoil);
	if ($losthealth <= 0) {
	$new_bullets= ($ubullets - $kill_bullets);
	mysql_query("UPDATE Players SET bullets='$new_bullets', health='0', dead='1', tdeath='$time', td='$now' WHERE username='$user'");
	mysql_query("DELETE FROM spies WHERE target='$target' and hunter='$user'");
	// Drop Props
	mysql_query("UPDATE airport SET owner='None' WHERE owner='$user'");
	mysql_query("UPDATE Bank SET owner='None' WHERE owner='$user'");
	mysql_query("UPDATE BF SET owner='None' WHERE owner='$user'");
	mysql_query("UPDATE BJT SET owner='None' WHERE Owner='$user'");
	mysql_query("UPDATE roulette SET owner='None' WHERE owner='$user'");
	mysql_query("UPDATE wf SET owner='None' WHERE owner='$user'");
	mysql_query("UPDATE WT SET owner='None' WHERE owner='$user'");
	// Clear out other things.
	mysql_query("DELETE FROM spies WHERE hunter='$user'");
	mysql_query("DELETE FROM garage WHERE username='$user'");
	mysql_query("DELETE FROM hanger WHERE username='$user'");
	mysql_query("DELETE FROM dock WHERE username='$user'");
	mysql_query("DELETE FROM outbox WHERE from='$user'");
	mysql_query("DELETE FROM pmessages WHERE touser='$user'");
	mysql_query("DELETE FROM gm WHERE seller='$user'");
	
	$subject = htmlspecialchars(addslashes("Kill Attempt!"));
				$message = htmlspecialchars(addslashes("Out of no where, $user rushed and shot at you, taking $damage health! Luckily, you fled and got some shots off at him. You took $recoil of his health away."));
				$to = $target;
				$from = htmlspecialchars(addslashes("Global Takeover"));
				$date = (date("M d Y h:i:s A"));
				$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , 
				`touser` , `from` , `unread` , 
				`date` ) VALUES ('$subject', '$message', '$to', 
				'$from', 'unread', '$date')");
	$current = time();
	$date = (date("M d Y h:i:s A"));					
	mysql_query("INSERT INTO Playerbullets (amount, date, username, outcome, btime, used) VALUES ('$kill_bullets', '$date', '$user', 'Loss', '$current', 'Shooting')");			
	echo "<div id=\"gameplay\"><center>You ambushed <a href=\"profile.php?id={$tid}\">$target</a>, but she was ready for you and fled!<br />
	You got a few shots off, and the target lost $damage health.<br />
	$target shot back, and you lost $recoil health. You were killed.</center></div>"; 
	
	} else {
	$subject = htmlspecialchars(addslashes("Kill Attempt!"));
				$message = htmlspecialchars(addslashes("Out of no where, $user rushed and shot at you, taking $damage health! Luckily, you fled and got some shots off at him. You took $recoil of his health away."));
				$to = $target;
				$from = htmlspecialchars(addslashes("Global Takeover"));
				$date = (date("M d Y h:i:s A"));
				
				
	$current = time();
	$date = (date("M d Y h:i:s A"));					
	mysql_query("INSERT INTO Playerbullets (amount, date, username, outcome, btime, used) VALUES ('$kill_bullets', '$date', '$user', 'Loss', '$current', 'Shooting')");
	$new_bullets= ($ubullets - $kill_bullets);
	mysql_query("UPDATE Players SET health='$test' WHERE username='$target'");
	mysql_query("UPDATE Players SET bullets='$new_bullets', health='$losthealth' WHERE username='$user'");
	mysql_query("DELETE FROM mspies WHERE target='$target' and hunter='$user'");
	$sql = mysql_query("UPDATE mission10 SET missionstats = '3' WHERE username = '$user'");
	echo "<div id=\"gameplay\"><center>You ambushed $target, but he was ready for you and fled!<br />
	You got a few shots off, and the target lost $damage health.<br />
	$target shot back, and you lost $recoil health.</center></div>"; 
	}
	}}
	exit();
	}
	}
	}
	
	$query = "SELECT luger, magnum, uzi, steyr, desert_eagle, p90, g36c, rpd, AK47, M4, stinger, saw, barett FROM Players WHERE id='{$_COOKIE['id']}'" ;
		$result = @mysql_query ($query);
		$row = mysql_fetch_array ($result);
		
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
		$weapons[] = "<option value=\"luger\">Luger</option>";
		}
		if ($b != 0) {
		$weapons[] = "<option value=\"magnum\">.44 Caliber Magnum</option>";
		}
		if ($r != 0) {
		$weapons[] = "<option value=\"uzi\">Mini-Uzi</option>";
		}
		if ($l != 0) {
		$weapons[] = "<option value=\"steyr\">Steyr</option>";
		}
		if ($a != 0) {
		$weapons[] = "<option value=\"desert_eagle\">Desert Eagle</option>";
		}
		if ($hl != 0) {
		$weapons[] = "<option value=\"p90\">P90</option>";
		}
		if ($p != 0) {
		$weapons[] = "<option value=\"g36c\">G36C</option>";
		}
		if ($bo != 0) {
		$weapons[] = "<option value=\"rpd\">RPD</option>";
		}
		if ($t != 0) {
		$weapons[] = "<option value=\"AK47\">AK47</option>";
		}
		if ($h != 0) {
		$weapons[] = "<option value=\"M4\">M4</option>";
		}
		if ($y != 0) {
		$weapons[] = "<option value=\"stinger\">Stinger</option>";
		}
		if ($m != 0) {
		$weapons[] = "<option value=\"saw\">M249 SAW</option>";
		}
		if ($e != 0) {
		$weapons[] = "<option value=\"barett\">Barett .50 Caliber</option>";
		}
	
	echo("<div id=\"gameplay\"><center><form name='shoot' action='shootN.php?id={$id}' method='POST'>
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
	</form>");
	
	
	}}
?>