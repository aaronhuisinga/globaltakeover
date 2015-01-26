<?php
$title="Organized Robbery";
include("config.php");
include("header.php");
include("Countdown_OR.php");
include("countdown_p.php");
include("Countdown_he.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username, money, location FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];
$l = $row[2];
$yourip = $_SERVER['REMOTE_ADDR'];

if ($_REQUEST['Yes']) {
	$row=mysql_fetch_array(mysql_query("SELECT * FROM Robbery WHERE invited='$u' OR inviteee='$u' OR invitew='$u' LIMIT 1;"));
	$idri = $row['invited'];
	$iee = $row['inviteee'];
	$iwep = $row['invitew'];
	$id = $row['id'];
	$lead = $row['leader'];
	$orl = $row['location'];
	if ($l == $orl) {
		if ($u == $idri) {
			mysql_query("UPDATE Robbery SET driver='$u', invited='None' WHERE id='$id' LIMIT 1;");
			echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=DOR.php\"></head>
				  <div align=\"center\" id=\"crimestext\">You have joined the Organized Robbery as the Pilot. Redirecting...</div>";
			include("footer.php");
			exit();
		} elseif ($u == $iee) {
			mysql_query("UPDATE Robbery SET ee='$u', inviteee='None' WHERE id='$id' LIMIT 1;");
			echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=DOR.php\"></head>
				  <div align=\"center\" id=\"crimestext\">You have joined the Organized Robbery as the Grenadier. Redirecting...</div>";
			include("footer.php");
			exit();
		} elseif ($u == $iwep) {
			mysql_query("UPDATE Robbery SET wep='$u', invitew='None' WHERE id='$id' LIMIT 1;");
			echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=DOR.php\"></head>
				  <div align=\"center\" id=\"crimestext\">You have joined the Organized Robbery as the Weapons Expert. Redirecting...</div>";
			include("footer.php");
			exit();
		} else {
			echo "<div id=\"crimestext\" align=\"center\">You have not been invited to participate in an Organized Robbery!</div>";
			include("footer.php");
			exit();
		}
	} else {
		echo "<div id=\"crimestext\" align=\"center\">You must be in the same location as the Organized Robbery to join!<br /><a href=\"/airport.php\">Go to the Airport.</a></div>";
		include("footer.php");
	}
} elseif ($_REQUEST['No']) {
	$row=mysql_fetch_array(mysql_query("SELECT * FROM Robbery WHERE invited='$u' OR inviteee='$u' OR invitew='$u' LIMIT 1;"));
	$idri = $row['invited'];
	$iee = $row['inviteee'];
	$iwep = $row['invitew'];
	$id = $row['id'];
	$lead = $row['leader'];
	
	if ($u == $idri OR $u == $iee OR $u == $iwep) {
		echo "<div id=\"crimestext\" align=\"center\">You have declined the Organized Robbery invitation.</div>";
		include("footer.php");
		$subject = htmlspecialchars(addslashes("Organized Robbery Invitation"));
		$message = htmlspecialchars(addslashes("$u has declined your invitation to join the Organized Robbery."));
		mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$lead', 'Global Takeover', 'unread', '$date')");
		if ($u == $idri) {
			mysql_query("UPDATE Robbery SET invited='None' WHERE id='$id' LIMIT 1;");
		} elseif ($u == $iee) { 
			mysql_query("UPDATE Robbery SET inviteee='None' WHERE id='$id' LIMIT 1;");
		} elseif ($u == $iwep) {
			mysql_query("UPDATE Robbery SET invited='None' WHERE id='$id' LIMIT 1;");
		}
		exit();
	}
} else {
if ($_REQUEST['submit']) {
	$row=mysql_fetch_array(mysql_query("SELECT * FROM Robbery WHERE leader='$u' LIMIT 1;"));
	$lead = $row['leader'];
	$driver = $row['driver'];
	$ee = $row['ee'];
	$wep = $row['wep'];
	$idri = $row['invited'];
	$iee = $row['inviteee'];
	$iwep = $row['invitew'];
	$dp = $_POST['Dpercent'];
	$ep = $_POST['Epercent'];
	$wp = $_POST['Wpercent'];
	$tp = $dp + $wp + $ep;
	if ($tp > 100) {
	echo "<div id=\"crimestext\" align=\"center\">You cannot pay out over 100% of the shares!<br /><a href=\"DOR.php\">Go back.</a></div>";
	include("footer.php");
	exit();
	}
	$dri=$_POST['d'];
	if ($dri == NULL OR $dri == '') {
			$dri='None';
		}
	$eee=$_POST['ee'];
	if ($eee == NULL OR $eee == '') {
			$eee='None';
		}
	$weep=$_POST['wep'];
	if ($weep == NULL OR $weep == '') {
			$weep='None';
		}
	if ($dri!=NULL AND $eee!=NULL AND $dri!='None' AND $eee!='None') {
		if ($dri == $eee) {
			$duplicates=1;
		}
	} elseif ($eee!=NULL AND $weep!=NULL AND $eee!='None' AND $weep!='None') {
		if ($eee == $weep) {
			$duplicates=1;
		}
	} elseif ($dri!=NULL AND $weep!=NULL AND $dri!='None' AND $weep!='None') {
		if ($weep == $dri) {
			$duplicates=1;
		}
	}
	if ($duplicates==1) {
		echo "<div id=\"crimestext\" align=\"center\">You cannot invite the same person multiple times.<br /><a href=\"DOR.php\">Go back.</a></div>";
		include("footer.php");
		exit();
	}
	if ($u == $lead) {
	$arr = array($dri, $eee, $weep);
	foreach ($arr as $pos) {
		if ($pos != NULL AND $pos != '' AND $pos != 'None') {
		$sql=mysql_query("SELECT dead, banned, username, lastip, r_ip FROM Players WHERE username='$pos' LIMIT 1;");
		$row=mysql_fetch_array($sql);
		$dead=$row[0];
		$banned=$row[1];
		$username=$row[2];
		$lastip=$row[3];
		$regip=$row[4];
		if ($username != $idri AND $username != $iee AND $username != $iwep) {
			if (mysql_num_rows($sql) != 1) {
				echo "<div id=\"crimestext\" align=\"center\">$pos is not a valid username!<br /><a href=\"DOR.php\">Go back.</a></div>";
				include("footer.php");
				exit();
			}else{
				if ($yourip == $lastip OR $yourip == $regip) {
					echo "<div id=\"crimestext\" align=\"center\">You cannot invite a player that has used the same IP as you!<br /><a href=\"DOR.php\">Go back.</a></div>";
					include("footer.php");
					exit();
				}
				if ($dead == 1 OR $banned == 1) {
					echo "<div id=\"crimestext\" align=\"center\">$username is either dead or banned!<br /><a href=\"DOR.php\">Go back.</a></div>";
					include("footer.php");
					exit();
				} else {
					$sql=mysql_query("SELECT * FROM Robbery WHERE leader='$username' OR driver='$username' OR ee='$username' OR wep='$username' LIMIT 1;");
					if (mysql_num_rows($sql) != 0) {
						echo "<div id=\"crimestext\" align=\"center\">$username is already in an Organized Robbery!<br /><a href=\"DOR.php\">Go back.</a></div>";
						include("footer.php");
						exit();
					} else {
						mysql_query("SELECT * FROM Robbery WHERE invited='$username' OR invitew='$username' OR inviteee='$username' LIMIT 1;");
						if (mysql_num_rows($sql) != 0) {
							echo "<div id=\"crimestext\" align=\"center\">$username has already been invited to another Organized Robbery.<br /><a href=\"DOR.php\">Go back.</a></div>";
							include("footer.php");
							exit();
						} else {
							$row=mysql_fetch_array(mysql_query("SELECT ortime FROM Players WHERE username='$username' LIMIT 1;"));
							$ortime=$row[0];
							$ORsd = $ortime - $current;
							if ($ORsd > 0) {
								echo "<div id=\"crimestext\" align=\"center\">$username has already done a Robbery in the last 8 hours!<br /><a href=\"DOR.php\">Go back.</a></div>";
								include("footer.php");
								exit();
							} else {
							if ($pos == $dri) { $posi='Pilot'; $percent=$dp; $dri=$username; } elseif ($pos == $eee) { $posi='Grenadier'; $percent=$ep; $eee=$username; } elseif ($pos == $weep) { $posi='Weapons Expert'; $percent=$wp; $weep=$username; }
							$subject = htmlspecialchars(addslashes("Organized Robbery Invitation"));
							$message = htmlspecialchars(addslashes("You have been invited to be the $posi in $lead's Organized Robbery! Share: $percent%"));
							mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$username', 'Global Takeover', 'unread', '$date')");
							}
						}
					}
				}
			}
		}
		}
		}
		if ($dri != NULL AND $dri != '' AND $dri != 'None'){mysql_query("UPDATE Robbery SET invited='$dri', dp='$dp' WHERE leader='$lead' LIMIT 1;");}
		if ($eee != NULL AND $eee != '' AND $eee != 'None'){mysql_query("UPDATE Robbery SET inviteee='$eee', ep='$ep' WHERE leader='$lead' LIMIT 1;");}
		if ($weep != NULL AND $weep != '' AND $weep != 'None'){mysql_query("UPDATE Robbery SET invitew='$weep', wp='$wp' WHERE leader='$lead' LIMIT 1;");}
		echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=DOR.php\"></head>
			  <div align=\"center\" id=\"crimestext\">The invitations were sent. Redirecting...</div>";
		include("footer.php");
		exit();
	} else {
		echo "<div id=\"crimestext\" align=\"center\">You cannot invite people to the Organized Robbery, because you are not the Hacker.<br /><a href=\"DOR.php\">Go back.</a></div>";
		include("footer.php");
		exit();
	}
} else {
if ($_REQUEST['SAR'] OR $_REQUEST['SOR'] OR $_REQUEST['DOR']) {
$row=mysql_fetch_array(mysql_query("SELECT * FROM Robbery WHERE leader='$u' LIMIT 1;"));
$cid=$row['id'];
if ($cid == NULL) {
	if ($money < 300000) {
	echo "<div id=\"crimestext\"><center>You don't have enough money to start an Organized Robbery!<br /><a href=\"DOR.php\">Go back.</a></div></center>";
	include("footer.php");
	exit();
	} elseif ($money >= 300000) {
			$nm=$money-300000;
			if ($_REQUEST['SAR']) { $type='Land'; $t="L"; $link="OR"; } elseif ($_REQUEST['SOR']) { $type='Sea'; $t="S"; $link="SOR"; } elseif ($_REQUEST['DOR']) { $type='Air'; $t="D"; $link="DOR"; }
			$row=mysql_fetch_array(mysql_query('SELECT *  FROM `thread` ORDER BY `fid` DESC LIMIT 0, 1')); 
			$f = ($row['fid']) + 1;
			
			if ($l == 'UK' or $l == 'USA' or $l == 'Philippines') {
			$title=addslashes("Auto: $u started an OR by $type in the $l");
			} else {
			$title=addslashes("Auto: $u started an OR by $type in $l");
			}
			if ($l == 'UK' or $l == 'USA' or $l == 'Philippines') {
			$post=addslashes("$u started an Organized Robbery by $type in the $l. Message them to join!");
			} else {
			$post=addslashes("$u started an Organized Robbery by $type in $l. Message them to join!");
			}
			$author=mysql_fetch_array(mysql_query("SELECT * FROM Players WHERE id = '{$_COOKIE['id']}' LIMIT 1"));
			$author=stripslashes($author['username']);

			mysql_query("INSERT INTO post (id , post) VALUES ('', '$post')");
			$pid=mysql_fetch_array(mysql_query("SELECT * FROM post ORDER BY id DESC LIMIT 1"));
			$pid=$pid['id'];
			$id = $f; 
			$result=mysql_query("SELECT * FROM thread WHERE fid = '$id'");
			if (mysql_num_rows($result) == 1) {
			$id = $id + 1;
			}
			mysql_query("INSERT INTO `thread` ( `id` , `title` , `postid` , `view` , `author` , `time` , `fid`, `count`, `date`, `ads` ) VALUES ('', '$title', '$pid', '0', '$author', '$current', '$id', '1', '$date', 'yes')"); 
			mysql_query("UPDATE Players SET money = '$nm' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
			echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=$link.php\"></head>
				  <div align=\"center\" id=\"crimestext\">You started an Organized Robbery by $type. Redirecting...</div>";
			include("footer.php");
			mysql_query("INSERT INTO Robbery (leader, driver, ee, wep, invited, invitew, inviteee, location, LSD) VALUES ('$u', 'None', 'None', 'None', 'None', 'None', 'None', '$l', '$t')");
			exit();
	}
} else {
	echo "<div id=\"crimestext\"><center>You are already in an Organized Robbery! You cannot start another!<br /><a href=\"OR.php\">Go back.</a></div></center>";
	include("footer.php");
	exit();
}
} else {
	$row=mysql_fetch_array(mysql_query("SELECT * FROM Robbery WHERE leader='$u' OR driver='$u' OR ee='$u' OR wep='$u' LIMIT 1;"));
	$cid = $row['id'];
	if ($cid == NULL) {
		$sqlq=mysql_query("SELECT * FROM Robbery WHERE invited='$u' OR invitew='$u' OR inviteee='$u' LIMIT 1;");
		if (mysql_num_rows($sqlq) == 0) {
			echo "<div id=\"crimestext\"><center><h2>Organized Robbery</h2><br />
			You are not currently in an Organized Robbery. To start one, it costs $300,000<br />";
			echo '<form action="DOR.php" method="POST"><input type="submit" name="SOR" Value="Attack By Sea!">
			<input type="submit" name="SAR" Value="Attack By Land!">
			<input type="submit" name="DOR" Value="Attack By Air!"></form></div></center>';
			include("footer.php");
			exit();
		} elseif (mysql_num_rows($sqlq) != 0) {
			$row = mysql_fetch_array($sqlq);
			$idri = $row['invited'];
			$iwep = $row['invitew'];
			$iee = $row['inviteee'];
			$lead = $row['leader'];
			$loc = $row['location'];
			$dp = $row['dp'];
			$ep = $row['ep'];
			$wp = $row['wp'];
			$lsd = $row['LSD'];
			$row=mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$lead' LIMIT 1;"));
			$lid = $row[0];
			if ($lsd == 'L') {
				$url .= '/members/OR.php';
				header("Location: $url");
				exit();
			} elseif ($lsd == 'D') {
			if ($idri == $u) {
				echo "<div id=\"crimestext\"><center><h2>Organized Robbery Invitation</h2><br>
				You have been invited to join <a href=\"profile.php?id=$lid\">$lead</a>'s Organized Robbery.<br />
				Position: Pilot<br />
				Location: $loc<br />
				Percentage: $dp%<br />
				<form action=\"DOR.php\" method=\"POST\"><input type=\"submit\" Value=\"Accept\" Name=\"Yes\"> or <input type=\"submit\" Value=\"Decline\" Name=\"No\">
				</form></div>";
				include("footer.php");
				exit();
			} elseif ($iwep == $u) {
				echo "<div id=\"crimestext\"><center><h2>Organized Robbery Invitation</h2><br>
				You have been invited to join <a href=\"profile.php?id=$lid\">$lead</a>'s Organized Robbery.<br />
				Position: Weapons Expert<br />
				Location: $loc<br />
				Percentage: $wp%<br />
				<form action=\"DOR.php\" method=\"POST\"><input type=\"submit\" Value=\"Accept\" Name=\"Yes\"> or <input type=\"submit\" Value=\"Decline\" Name=\"No\">
				</form></div>";
				include("footer.php");
				exit();
			} elseif ($iee == $u) {
				echo "<div id=\"crimestext\"><center><h2>Organized Robbery Invitation</h2><br>
				You have been invited to join <a href=\"profile.php?id=$lid\">$lead</a>'s Organized Robbery.<br />
				Position: Grenadier<br />
				Location: $loc<br />
				Percentage: $ep%<br />
				<form action=\"DOR.php\" method=\"POST\"><input type=\"submit\" Value=\"Accept\" Name=\"Yes\"> or <input type=\"submit\" Value=\"Decline!\" Name=\"No\">
				</form></div>";
				include("footer.php");
				exit();
			}
			} elseif ($lsd == 'S') {
				$url .= '/members/SOR.php';
				header("Location: $url");
				exit();
			}
		}
	} else {
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
		$hack = $row['hack'];
		$dp = $row['dp'];
		$ep = $row['ep'];
		$wp = $row['wp'];
		$LSD = $row['LSD'];
		if($LSD == 'L') {
			$url .= '/members/OR.php';
			header("Location: $url");
			exit();
		} elseif($LSD == 'S') {
			$url .= '/members/SOR.php';
			header("Location: $url");
			exit();
		}
		$idriver = $row['invited'];
		$irow = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$idriver' LIMIT 1;"));
		$idid = $irow[0];
		$iee = $row['inviteee'];
		$irow = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$iee' LIMIT 1;"));
		$ieid = $irow[0];
		$iwep = $row['invitew'];
		$irow = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$iwep' LIMIT 1;"));
		$iwid = $irow[0];
		$irow = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$lead' LIMIT 1;"));
		$lid = $irow[0];
		$irow = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$driver' LIMIT 1;"));
		$did = $irow[0];	
		$irow = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$wep' LIMIT 1;"));
		$wid = $irow[0];	
		$irow = mysql_fetch_array(mysql_query("SELECT id FROM Players WHERE username='$ee' LIMIT 1;"));
		$eid = $irow[0];		
		echo "<div id=\"ltable\" align=\"center\">
		<h1>Organized Robbery</h1>
		<a href=\"DOR.php\">Refresh</a>";
		if ($lead != 'None' AND $driver != 'None' AND $ee != 'None' AND $wep != 'None' AND $rcar != NULL AND $explosive != NULL AND $lgun != NULL AND $dgun != NULL AND $egun != NULL AND $wgun != NULL AND $hack != NULL AND $lead == $u) {
		echo "<form action=\"DORdo.php\" method=\"POST\"><input name=\"Commit\" type=\"submit\" value=\"Commit\"></form>";
		} elseif ($lead == $u) {
		echo "<br /><form action=\"ORcancel.php\" method=\"POST\"><input name=\"Cancel\" type=\"submit\" value=\"Cancel\"></form>
		<a href=\"ORad.php\">Edit Advertisement</a>";
		} else {
		echo ("<form action=\"ORleave.php\" method=\"POST\"><input name=\"Leave\" type=\"submit\" value=\"Leave\"></form>");
		}
		echo "<table id=\"usertable\" width=\"40%\">
		<tr class=\"top\"><td align=\"center\">Position</td> <td align=\"center\">Structure</td> <td align=\"center\">Weapons</td> <td align=\"center\">Aircraft</td> <td align=\"center\">Explosives</td> <td align=\"center\">Hacking</td> <tr>
		<tr><td class=\"top\" align=\"center\">Hacker</td> <td align=\"center\"><a href=\"profile.php?id=$lid\">$lead</a></td> <td align=\"center\">"; if ($lgun == NULL) { echo "---"; } else { echo "$lgun"; } echo "</td> <td rowspan=\"4\" align=\"center\">"; if ($rcar == NULL) { echo "---"; } else { echo "$rcar"; } echo "</td> <td rowspan=\"4\" align=\"center\">"; if ($explosive == NULL) { echo "---"; } else { echo "$explosive"; } echo " </td> <td rowspan=\"4\" align=\"center\">"; if ($hack == NULL) { echo "---"; } else { echo "$hack"; } echo " </td></tr>
		<tr><td class=\"top\" align=\"center\">Pilot</td> <td align=\"center\">";if($did != NULL) {echo"<a href=\"profile.php?id=$did\">$driver</a>";} else { echo"$driver"; } echo"</td> <td align=\"center\">"; if ($dgun == NULL) { echo "---"; } else { echo "$dgun"; } echo "</td></tr>
		<tr><td class=\"top\" align=\"center\">Grenadier</td> <td align=\"center\">";if($eid != NULL) {echo"<a href=\"profile.php?id=$eid\">$ee</a>";} else { echo"$ee"; } echo"</td> <td align=\"center\">"; if ($egun == NULL) { echo "---"; } else { echo "$egun"; } echo "</td></tr>
		<tr><td class=\"top\" align=\"center\">Weapons Expert</td> <td align=\"center\">";if($wid != NULL) {echo"<a href=\"profile.php?id=$wid\">$wep</a>";} else { echo"$wep"; } echo"</td> <td align=\"center\">"; if ($wgun == NULL) { echo "---"; } else { echo "$wgun"; } echo "</td></tr>
		</table>";
		
		if ($u == $lead) {
		echo "<form action=\"DOR.php\" method=\"POST\"><br /><h1 align=\"center\">Invitations</h1><table>";
		if ($driver == 'None') {	
			if ($idriver == 'None') {		
				echo "<tr><td>Pilot:</td> <td><input type=\"text\" name=\"d\"></td><td>Share: <select name='Dpercent'> 
<option value='0'>0%<option value='1'>1%<option value='2'>2%<option value='3'>3%<option value='4'>4%<option value='5'>5%<option value='6'>6%<option value='7'>7%<option value='8'>8%<option value='9'>9%<option value='10'>10%<option value='11'>11%<option value='12'>12%<option value='13'>13%<option value='14'>14%<option value='15'>15%<option value='16'>16%<option value='17'>17%<option value='18'>18%<option value='19'>19%<option value='20'>20%<option value='21'>21%<option value='22'>22%<option value='23'>23%<option value='24'>24%<option value='25'>25%<option value='26'>26%<option value='27'>27%<option value='28'>28%<option value='29'>29%<option value='30'>30%<option value='31'>31%<option value='32'>32%<option value='33'>33%<option value='34'>34%<option value='35'>35%<option value='36'>36%<option value='37'>37%<option value='38'>38%<option value='39'>39%<option value='40'>40%<option value='41'>41%<option value='42'>42%<option value='43'>43%<option value='44'>44%<option value='45'>45%<option value='46'>46%<option value='47'>47%<option value='48'>48%<option value='49'>49%<option value='50'>50%<option value='51'>51%<option value='52'>52%<option value='53'>53%<option value='54'>54%<option value='55'>55%<option value='56'>56%<option value='57'>57%<option value='58'>58%<option value='59'>59%<option value='60'>60%<option value='61'>61%<option value='62'>62%<option value='63'>63%<option value='64'>64%<option value='65'>65%<option value='66'>66%<option value='67'>67%<option value='68'>68%<option value='69'>69%<option value='70'>70%<option value='71'>71%<option value='72'>72%<option value='73'>73%<option value='74'>74%<option value='75'>75%<option value='76'>76%<option value='77'>77%<option value='78'>78%<option value='79'>79%<option value='80'>80%<option value='81'>81%<option value='82'>82%<option value='83'>83%<option value='84'>84%<option value='85'>85%<option value='86'>86%<option value='87'>87%<option value='88'>88%<option value='89'>89%<option value='90'>90%<option value='91'>91%<option value='92'>92%<option value='93'>93%<option value='94'>94%<option value='95'>95%<option value='96'>96%<option value='97'>97%<option value='98'>98%<option value='99'>99%<option value='100'>100%
</select></td></tr>";
			} elseif ($idriver != 'None') {
				echo "<tr><td>Pilot:</td> <td><a href=\"profile.php?id=$idid\">$idriver</a> - Invite sent, pending a response - <a href=\"ORkick.php?t=idri\">Cancel</a></td></tr>";
			}
		} elseif ($driver != 'None') {
		echo "<tr><td align=\"right\">Pilot:</td> <td><a href=\"profile.php?id=$did\">$driver</a> ($dp%)</td> <td><a href=\"ORkick.php?t=dri\">Kick</a></td></tr>";
		}
		if ($ee == 'None') {	
			if ($iee == 'None') {		
				echo "<tr><td>Grenadier:</td> <td><input type=\"text\" name=\"ee\"></td><td>Share: <select name='Epercent'> 
<option value='0'>0%<option value='1'>1%<option value='2'>2%<option value='3'>3%<option value='4'>4%<option value='5'>5%<option value='6'>6%<option value='7'>7%<option value='8'>8%<option value='9'>9%<option value='10'>10%<option value='11'>11%<option value='12'>12%<option value='13'>13%<option value='14'>14%<option value='15'>15%<option value='16'>16%<option value='17'>17%<option value='18'>18%<option value='19'>19%<option value='20'>20%<option value='21'>21%<option value='22'>22%<option value='23'>23%<option value='24'>24%<option value='25'>25%<option value='26'>26%<option value='27'>27%<option value='28'>28%<option value='29'>29%<option value='30'>30%<option value='31'>31%<option value='32'>32%<option value='33'>33%<option value='34'>34%<option value='35'>35%<option value='36'>36%<option value='37'>37%<option value='38'>38%<option value='39'>39%<option value='40'>40%<option value='41'>41%<option value='42'>42%<option value='43'>43%<option value='44'>44%<option value='45'>45%<option value='46'>46%<option value='47'>47%<option value='48'>48%<option value='49'>49%<option value='50'>50%<option value='51'>51%<option value='52'>52%<option value='53'>53%<option value='54'>54%<option value='55'>55%<option value='56'>56%<option value='57'>57%<option value='58'>58%<option value='59'>59%<option value='60'>60%<option value='61'>61%<option value='62'>62%<option value='63'>63%<option value='64'>64%<option value='65'>65%<option value='66'>66%<option value='67'>67%<option value='68'>68%<option value='69'>69%<option value='70'>70%<option value='71'>71%<option value='72'>72%<option value='73'>73%<option value='74'>74%<option value='75'>75%<option value='76'>76%<option value='77'>77%<option value='78'>78%<option value='79'>79%<option value='80'>80%<option value='81'>81%<option value='82'>82%<option value='83'>83%<option value='84'>84%<option value='85'>85%<option value='86'>86%<option value='87'>87%<option value='88'>88%<option value='89'>89%<option value='90'>90%<option value='91'>91%<option value='92'>92%<option value='93'>93%<option value='94'>94%<option value='95'>95%<option value='96'>96%<option value='97'>97%<option value='98'>98%<option value='99'>99%<option value='100'>100%
</select></td></tr><br>";
			} elseif ($iee != 'None') {
				echo "<tr><td>Grenadier:</td> <td><a href=\"profile.php?id=$ieid\">$iee</a> - Invite sent, pending a response - <a href=\"ORkick.php?t=iee\">Cancel</a></td></tr>";
			}
		} elseif ($ee != 'None') {
				echo "<tr><td align=\"right\">Grenadier:</td> <td><a href=\"profile.php?id=$eid\">$ee</a> ($ep%)</td> <td><a href=\"ORkick.php?t=ee\">Kick</a></td></tr>";
		}
		if ($wep == 'None') {	
			if ($iwep == 'None') {	
				echo "<tr><td>Weapons Expert:</td> <td><input type=\"text\" name=\"wep\"></td><td>Share: <select name='Wpercent'> 
<option value='0'>0%<option value='1'>1%<option value='2'>2%<option value='3'>3%<option value='4'>4%<option value='5'>5%<option value='6'>6%<option value='7'>7%<option value='8'>8%<option value='9'>9%<option value='10'>10%<option value='11'>11%<option value='12'>12%<option value='13'>13%<option value='14'>14%<option value='15'>15%<option value='16'>16%<option value='17'>17%<option value='18'>18%<option value='19'>19%<option value='20'>20%<option value='21'>21%<option value='22'>22%<option value='23'>23%<option value='24'>24%<option value='25'>25%<option value='26'>26%<option value='27'>27%<option value='28'>28%<option value='29'>29%<option value='30'>30%<option value='31'>31%<option value='32'>32%<option value='33'>33%<option value='34'>34%<option value='35'>35%<option value='36'>36%<option value='37'>37%<option value='38'>38%<option value='39'>39%<option value='40'>40%<option value='41'>41%<option value='42'>42%<option value='43'>43%<option value='44'>44%<option value='45'>45%<option value='46'>46%<option value='47'>47%<option value='48'>48%<option value='49'>49%<option value='50'>50%<option value='51'>51%<option value='52'>52%<option value='53'>53%<option value='54'>54%<option value='55'>55%<option value='56'>56%<option value='57'>57%<option value='58'>58%<option value='59'>59%<option value='60'>60%<option value='61'>61%<option value='62'>62%<option value='63'>63%<option value='64'>64%<option value='65'>65%<option value='66'>66%<option value='67'>67%<option value='68'>68%<option value='69'>69%<option value='70'>70%<option value='71'>71%<option value='72'>72%<option value='73'>73%<option value='74'>74%<option value='75'>75%<option value='76'>76%<option value='77'>77%<option value='78'>78%<option value='79'>79%<option value='80'>80%<option value='81'>81%<option value='82'>82%<option value='83'>83%<option value='84'>84%<option value='85'>85%<option value='86'>86%<option value='87'>87%<option value='88'>88%<option value='89'>89%<option value='90'>90%<option value='91'>91%<option value='92'>92%<option value='93'>93%<option value='94'>94%<option value='95'>95%<option value='96'>96%<option value='97'>97%<option value='98'>98%<option value='99'>99%<option value='100'>100%
</select></td></tr><br>";
			} elseif ($iwep != 'None') {
				echo "<tr><td>Weapons Expert:</td> <td><a href=\"profile.php?id=$iwid\">$iwep</a> - Invite sent, pending a response - <a href=\"ORkick.php?t=iwep\">Cancel</a></td></tr>";
			}
		} elseif ($wep != 'None') {
		echo "<tr><td>Weapons Expert:</td> <td><a href=\"profile.php?id=$wid\">$wep</a> ($wp%)</td> <td><a href=\"ORkick.php?t=wep\">Kick</a></td></tr>";
		}
		if ($wep == 'None' OR $ee == 'None' OR $driver == 'None') {
		echo "</table><input type=\"submit\" name=\"submit\" value=\"Send\" /></form>";
		} else {
		echo "</table></form>";
		}
		?>
		<form action="ORhack.php" method="POST">
		<table id="usertable" width="40%">
		<tr class="top"><td width="10%"><b>Hackers Equipment</b></td><td width="1%"><b>Select</b></td></tr>
   		<tr><td>Micro-cameras ($125,000)</td><td><input name="radio" type="radio" value="Micro-cameras"></td></tr>
   		<tr><td>Proximity Detectors ($75,000)</td><td><input name="radio" type="radio" value="Proximity Detectors"></td></tr>
   		<tr><td>Drones ($35,000)</td><td><input name="radio" type="radio" value="Drones"></td></tr>
   		<tr><td>Laptop ($15,000)</td><td><input name="radio" type="radio" value="Laptop"></td></tr>
   		</table>
   		<input name="update" type="submit" value="Update!">
		</form>
		<?		
		} elseif ($u == $driver) {
		echo "<br />Welcome $u<br /> You are the current Pilot!</div>";
		?>
		<form action="DORdriver.php" method="POST">
		<table id="usertable" width="40%">
		<tr class="top">
		<td width="10%"><b>Vehicle</b></td>
   		<td width="1%"><b>Select</b></td>
  		</tr>
		<?
		$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;")); 
		$u = $row[0];
		$query=mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 ORDER BY plane ASC"); 
		while ($row=mysql_fetch_array($query)){
		$car=$row['plane'];
		$caid = $row['id'];
		?>		
  		<tr>
		<td width="10%"><? echo "$car"; ?></td>
		<td width="1%"><input name="radio" type="radio" value="<? echo "$caid"; ?>"></td>
 		</tr>
		<?
		}
		?>
		</table>
		<input name="update" type="submit" value="Update!">
		</form>
		<?
		} elseif ($u == $ee ) {
		echo "<br />Welcome $u<br /> You are the current Grenadier!</div>";
		?><form action="DOReee.php" method="POST">
		<table id="usertable" width="40%">
		<tr class="top"><td width="10%"><b>Explosive</b></td><td width="1%"><b>Select</b></td></tr>
   		<tr><td>Incendiary Grenades ($250,000)</td><td><input name="radio" type="radio" value="Incendiary Grenades"></td></tr>
   		<tr><td>Sting Grenades ($200,000)</td><td><input name="radio" type="radio" value="Sting Grenades"></td></tr>
   		<tr><td>Stun Grenades ($150,000)</td><td><input name="radio" type="radio" value="Stun Grenades"></td></tr>
   		<tr><td>Smoke Grenades ($100,000)</td><td><input name="radio" type="radio" value="Smoke Grenades"></td></tr>
   		</table>
   		<input name="update" type="submit" value="Update!">
		</form>
		<?
		} elseif($u == $wep) {
		echo ("<table>");
		echo "<br />Welcome $u<br /> You are the current Weapons Expert!</div>";
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
		$weapons[] = "<option value=\"luger\">Luger ($j)</option>";
		}
		if ($b != 0) {
		$weapons[] = "<option value=\"magnum\">.44 Caliber Magnum ($b)</option>";
		}
		if ($r != 0) {
		$weapons[] = "<option value=\"uzi\">Mini-Uzi ($r)</option>";
		}
		if ($l != 0) {
		$weapons[] = "<option value=\"steyr\">Steyr ($l)</option>";
		}
		if ($a != 0) {
		$weapons[] = "<option value=\"desert_eagle\">Desert Eagle ($a)</option>";
		}
		if ($hl != 0) {
		$weapons[] = "<option value=\"p90\">P90 ($hl)</option>";
		}
		if ($p != 0) {
		$weapons[] = "<option value=\"g36c\">G36C ($p)</option>";
		}
		if ($bo != 0) {
		$weapons[] = "<option value=\"rpd\">RPD ($bo)</option>";
		}
		if ($t != 0) {
		$weapons[] = "<option value=\"AK47\">AK47 ($t)</option>";
		}
		if ($h != 0) {
		$weapons[] = "<option value=\"M4\">M4 ($h)</option>";
		}
		if ($y != 0) {
		$weapons[] = "<option value=\"stinger\">Stinger ($y)</option>";
		}
		if ($m != 0) {
		$weapons[] = "<option value=\"saw\">M249 SAW ($m)</option>";
		}
		if ($e != 0) {
		$weapons[] = "<option value=\"barett\">Barett .50 Caliber ($e)</option>";
		}
		echo '<form action="DORweep.php" method="POST"><tr><td align="right">Leader:</td> <td><select name="lselect">';
		echo "<option value=\"none\">No Change!</option>";
 		foreach ($weapons as $msg) {
 		echo "$msg";
 		}
 		echo '</select></td></tr>';
 		echo '<tr><td align="right">Pilot:</td> <td><select name="dselect">';
 		echo "<option value=\"none\">No Change!</option>";
 		foreach ($weapons as $msg) {
 		echo "$msg";
 		}
 		echo '</select></td></tr>';
 		echo '<tr><td align="right">Grenadier:</td> <td><select name="eeselect">';
 		echo "<option value=\"none\">No Change!</option>";
 		foreach ($weapons as $msg) {
 		echo "$msg";
 		}
 		echo '</select></td></tr>';
 		echo '<tr><td align="right">Weapon Expert:</td> <td><select name="weselect">';
 		echo "<option value=\"none\">No Change!</option>";
 		foreach ($weapons as $msg) {
 		echo "$msg";
 		}
 		echo '</select></td></tr></table><input name="update" type="submit" value="Update!"><br /><br /><br /><br />';
		}
		echo'</div>';
		include("footer.php");
}
}
}
}
?>