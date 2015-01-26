<?php
ob_start(); 
include("config.php");
include("Online.php");
include ("profilecode.php");

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
$query = "SELECT theme, username, health FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$u = $row[1];
$h = $row[2];
$donor = $row[3];

if ($h == 0) {
	 	$url .= '/dead.html';
		header("Location: $url");
		
	} else {

$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

		$result=mysql_query("SELECT R_seconds, R_mins, R_hours, R_days, R_months, R_years, username, avatar, Level, donor FROM Players WHERE id='$id'");
		$row = mysql_fetch_array ($result);
		// Define your target date here
		$donor = $row[9];
		$lvl = $row[8];
		$avatar = $row[7];
		$profuser = $row[6];
		$profuser = addslashes($profuser);
		$targetYear= $row[5];
		$targetMonth= $row[4];
		$targetDay= $row[3];
		$targetHour= $row[2];
		$targetMinute= $row[1];
		$targetSecond= $row[0];
		// End target date definition
		// Define date format
		$dateFormat = "Y-m-d H:i:s";
		
		if ($avatar != NULL) {
		$av = "<img src=\"$avatar\" height=\"80px\ width=\"80px\" />";
		}
		
		$targetDate = mktime($targetHour,$targetMinute,$targetSecond,$targetMonth,$targetDay,$targetYear);
		$actualDate = time();
		
		$ORsd = $actualDate - $targetDate;
		$ORmd = floor($ORsd/60);
		$ORhd = floor($ORmd/60);
		
		if ($lvl > 0) {
		$tm = "Never Available";
		} else {
		$tm = "Available";
		}
		if ($ORmd < 480 && $ORmd > 404) {
		$tml = 480 - $ORmd;
		$tm = "$tml Minutes Left";
		} elseif ($ORmd >= 0 && $ORmd < 405) {
		$tml = 8 - $ORhd;
		$tm = "$tml Hours Left";
		}
		
		$sql = mysql_query("SELECT leader FROM Robbery WHERE leader = '$profuser' OR driver = '$profuser' OR wep = '$profuser' OR ee = '$profuser'");
		$row = mysql_fetch_array($sql);
		$lead = $row['leader'];
		if (mysql_num_rows($sql) > 0) {
		$tm = "In an Organised Robbery";
		}
		if ($profuser == $lead) {
		$tm = "Leading an Organised Robbery";
		}
		$query = "SELECT banned, registration_date, Laston, username, corps, rank, money_rank, Profile, health, Online FROM Players WHERE id='$id' LIMIT 1;";
		$result = @mysql_query ($query);
		$user = mysql_fetch_assoc($result);
		$ban = $user['banned'];
		$bgcolor = $user['Profile'];
		$bgimage = $user['Profile'];
		$Text = $user['Profile'];
		$pro = BBcode($Text);
		$bgimg = ImageBackground($bgimage);
		$bgclr = ColorBackground($bgcolor);
		$offline = (time()-300);
		$health = $user['health'];
		$corp = $user['corps'];
		$laston = $user['Laston'];
		
		$query = "SELECT id FROM Corps WHERE name='$corp' LIMIT 1;";
		$result = @mysql_query ($query);
		$corpr = mysql_fetch_assoc($result);
		$cid = $corpr['id'];
		
		$sql = mysql_query("SELECT * FROM friendslist WHERE username='$u' AND friend='$profuser'");
		if (mysql_num_rows($sql) > 0) {
		$fritext = "<a href=\"addfriend.php?id=$id\">Remove Friend</a>";
		} else {
		$fritext = "<a href=\"addfriend.php?id=$id\">Add Friend</a>";
		}
		
		$sql = mysql_query("SELECT * FROM enemyslist WHERE username='$u' AND enemy='$profuser'");
		if (mysql_num_rows($sql) > 0) {
		$etext = "<a href=\"addenemy.php?id=$id\">Remove Enemy</a>";
		} else {
		$etext = "<a href=\"addenemy.php?id=$id\">Add Enemy</a>";
		}
		
		$sql = mysql_query("SELECT * FROM blocklist WHERE username='$u' AND block='$profuser'");
		if (mysql_num_rows($sql) > 0) {
		$btext = "<a href=\"addblock.php?id=$id\">Remove Block</a>";
		} else {
		$btext = "<a href=\"addblock.php?id=$id\">Add Block</a>";
		}
		
		if ($health == 0) {
		$state = 'Dead';
		} else {
		$state = 'Alive';
		}
		
		if ($user['Online'] >= $offline AND $ban == 0) {
		$status = '<font color="green">Online</font>';
		} elseif ($user['Online'] < $offline AND $ban == 0) {
		$status = 'Offline';
		} elseif (($user['Online'] >= $offline OR $user['Online'] < $offline) AND $ban == 1) {
		$status = '<font color="red">Banned</font>';
		}
		
		echo "<div id=\"profile\">
			<center>
			$av<h1><a href=\"newmessage.php?page=write&recipient=".urlencode($user['username'])."\">{$user['username']}</a>";
			if ($donor == 1) {
			echo ("&nbsp;<img src=\"images/donor.png\" alt=\"This user donated to Global Takeover!\" />");
			}
		echo "</h1>
			<table>
			<tr>
			<td width=\"50%\"><b>Rank: {$user['rank']}</b></td>
			<td><b>Signed up: {$user['registration_date']}</b></td>
	  		</tr>
	  		<tr>
	  		<td><b>State: $state</b></td>
	  		<td><b>Status: $status</b></td>
	  		</tr>
	  		<tr>
			<td><b>Money: {$user['money_rank']}</b></td>";
			if ($user['corps'] != 'None') {
			echo "<td><b>Corp: <a href=\"cprofile.php?id={$cid}\">{$user['corps']}</a></b></td>";
			} elseif ($user['corps'] == 'None'){
			echo "<td><b>Corp: {$user['corps']}</b></td>";}
			echo "</tr><tr><td><b>OR Timer: $tm</b></td><td><b>Last Online: $laston</b></td>
	  		</tr></table><table>
			<tr>
			<td $bgimg $bgclr align=\"center\"><div align=\"left\">$fritext | $etext | $btext</div></div><br />$pro</td>
			</tr>
			</table>
			</center>
			</div>";
			
	}
}
?>