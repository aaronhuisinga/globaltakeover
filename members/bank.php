<?php
include("config.php");
include("countdown_p.php");
include("Countdown_m.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username, money, location FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$money = $row[1];
$l = $row[2];
$title="$l Local Bank";
include("header.php");
include("Countdown_he.php");

$row=mysql_fetch_array(mysql_query("SELECT id, amount, time FROM banking WHERE username='$u' LIMIT 1;"));
$cid = $row[0];
$depm = $row[1];
$hour = $row[2];

	$row=mysql_fetch_array(mysql_query("SELECT Owner, taxp FROM Bank WHERE location='$l' LIMIT 1;"));
	$o = $row[0];
	$tax = $row[1];
	
	$row=mysql_fetch_array(mysql_query("SELECT health, id FROM Players WHERE username='$o' LIMIT 1;"));
	$ohealth = $row[0];
	$ownerid = $row[1];
	
	if ($o == 'None' OR $o == NULL OR $ohealth < 1) {
	echo ("<div id=\"ltable\" align=\"center\">
	<p>This Bank currently has no owner! Would you like to have it?
	<form name=\"pickup\" method=\"post\" action=\"bankpickup.php\">
	<input type=\"hidden\" name=\"location\" value=\"$l\" />
	<input type=\"submit\" name=\"submit\" value=\"Claim it!\" />
	<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
	</form></div>");
	include("footer.php");
	exit();

	} else {
	$taxpercent = $tax * 100;
	$sql = mysql_query("SELECT * FROM bpescrow WHERE other='$u'");
		$row = mysql_fetch_array($sql);
		if (mysql_num_rows($sql) == 1) {
		$own = $row['username'];
		$query = mysql_query("SELECT id, health FROM Players WHERE username='$own' LIMIT 1");
		$row1 = mysql_fetch_array($query);
		$ownerid = $row1['id'];
		$money = $row['money'];
		$taxm = floor($money * 0.09);
		$tmoney = $money + $taxm;
		$bullets = $row['bullets'];
		$tokens = $row['tokens'];
		$location = $row['location'];
		echo "<div id='crimestext' align='center'><table><tr><td><center><a href='members/profile.php?id=$ownerid'>$own</a> has started an escrow for $location Bank</center></td></tr>
		<tr><td><center>Money: $".number_format($tmoney)." ($".number_format($money)." + $".number_format($taxm).")</center></td></tr>
		<tr><td><center>Bullets: ".number_format($bullets)."</center></td></tr>
		<tr><td><center>Tokens: ".number_format($tokens)."</center></td></tr></table><br><br>
		<form action='bpescrow.php' method='POST'><input type='submit' value='Accept!' name='Accept'><input type='submit' value='Decline!' name='Decline'></form></div>";
		include("footer.php");
		exit();
		}
	

if ($_POST['submit']){
if ($cid == NULL) {
	$dep = intval(strip_tags(abs($_POST['deposit'])));
	$dep = intval(strip_tags(abs($_POST['deposit'])));
	if (!preg_match("/[0-9]/",$dep)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"escrow.php\">Go back.</a></center></div>");
		include("footer.php");
		exit();
	}
	
	if ($dep != NULL) {
		if ($dep > 0  && $dep < 75000001) {
			$time = $_POST['select'];
			if ($time == 12) {
				$per = 2.5;
			} elseif ($time == 24) {
				$per = 5.5;
			}
			if ($money >= $dep) { 
				$s = date('s');
				$i = date('i');
				$h = date('H');
				$d = date('d');
				$mo = date('m');
				$y = date('Y');
				$ucash = $money - $dep;
				mysql_query("INSERT INTO banking (username, time, amount, interestp, m_seconds, m_mins, m_hours, m_days, m_months, m_years) VALUES ('$u', '$time', '$dep', '$per', '$s', '$i', '$h', '$d', '$mo', '$y')");
				echo "<div id=\"crimestext\"><center>You have deposited &#36;".number_format($dep)." For $time hours!<br /><a href=\"bank.php\">Go back.</a></div></center>";
				include("footer.php");
				mysql_query("UPDATE Players SET money='$ucash' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
			} else {
				echo '<div id="crimestext"><center>Please enter an amount of money that you have!</div></center>';
				include("footer.php");
			}
		} elseif ($dep < 1) {
			echo '<div id="crimestext"><center>Please enter a valid amount of money.</div></center>';
			include("footer.php");
		} elseif ($dep > 75000000) {
			echo '<div id="crimestext"><center>You cannot deposit more than $75,000,000 at one time.</div></center>';
			include("footer.php");
		}
	} else {
		echo '<div id="crimestext"><center>Please enter an amount of money.</div></center>';
		include("footer.php");
	}
} else {
echo "<div id=\"crimestext\"><center>You already have &#36;".number_format($depm)." deposited for $hour hours!</center>";
include("footer.php");
}
} else {
		$result = mysql_query("SELECT owner FROM Bank WHERE id='1'");
		$row = mysql_fetch_array ($result);
		$oo = $row[0];
		
		$result = mysql_query("SELECT owner FROM Bank WHERE id='2'");
		$row = mysql_fetch_array ($result);
		$ot = $row[0];

		$result = mysql_query("SELECT owner FROM Bank WHERE id='3'");
		$row = mysql_fetch_array ($result);
		$oth = $row[0];

		$result = mysql_query("SELECT owner FROM Bank WHERE id='4'");
		$row = mysql_fetch_array ($result);
		$of = $row[0];

		$result = mysql_query("SELECT owner FROM Bank WHERE id='5'");
		$row = mysql_fetch_array ($result);
		$ofi = $row[0];

		$result = mysql_query("SELECT owner FROM Bank WHERE id='6'");
		$row = mysql_fetch_array ($result);
		$os = $row[0];
if ($cid == NULL) {
		if ($u == $o OR $oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
		echo ("<div id=\"ltable\" align=\"center\"><h1><a href=\"banko.php\">Ownership</a></h1>");
			
	echo("<form method=\"post\" action=\"bank.php\"><h2>Local Bank</h2>
	<p>This bank is owned by: <a href=\"profile.php?id={$ownerid}\">$o</a></p>
  	<table>
  	<tr><td align=\"right\">Amount:</td> <td><input type=\"text\" name=\"deposit\"></td></tr>
	<tr><td align=\"right\">Time</td> <td><select name=\"select\">
  	<option value=\"12\">12 Hours (2.5%)</option>
  	<option value=\"24\">24 Hours (5.5%)</option>
	</select></td></tr>
	<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Deposit!\" />
	<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></td></tr>
	</table>
	</form><br /><br />
	<form method=\"post\" action=\"transfer.php\">
	<h2>Transfers</h2>
	<p>Current tax percent: $taxpercent%</p>
	<p><a href=\"transferlog.php?id={$_COOKIE['id']}\">Last 50 Transfers</a></p>
	<table>
	<tr><td align=\"right\">To: <td><input type=\"text\" name=\"to\"></td></tr>
	<tr><td align=\"right\">Amount: <td><input type=\"text\" name=\"amount\"></td></tr>
	<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Transfer!\" />
	<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></td></tr>
	</table>
	</form>
	</div>");
include("footer.php");
} else {
echo("<div id=\"crimestext\"><center><form method=\"post\" action=\"bank.php\"><h2>Local Bank</h2>
	<p>This bank is owned by: <a href=\"profile.php?id={$ownerid}\">$o</a></p>
  	<table>
  	<tr><td align=\"right\">Amount:</td> <td><input type=\"text\" name=\"deposit\"></td></tr>
	<tr><td align=\"right\">Time</td> <td><select name=\"select\">
  	<option value=\"12\">12 Hours (2.5%)</option>
  	<option value=\"24\">24 Hours (5.5%)</option>
	</select></td></tr>
	<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Deposit!\" />
	<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></td></tr>
	</table>
	</form><br /><br />
	<form method=\"post\" action=\"transfer.php\">
	<h2>Transfers</h2>
	<p>Current tax percent: $taxpercent%</p>
	<p><a href=\"transferlog.php?id={$_COOKIE['id']}\">Last 50 Transfers</a></p>
	<table>
	<tr><td align=\"right\">To: <td><input type=\"text\" name=\"to\"></td></tr>
	<tr><td align=\"right\">Amount: <td><input type=\"text\" name=\"amount\"></td></tr>
	<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Transfer!\" />
	<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></td></tr>
	</table>
	</form>
	</div>");
	include("footer.php");
}
} else {	
$result = mysql_query("SELECT m_seconds, m_mins, m_hours, m_days, m_months, m_years, time FROM banking WHERE username='$u' LIMIT 1;");
$row = mysql_fetch_array ($result, MYSQL_NUM);
	$time = $row[6];
	$targetYear= $row[5];
	$targetMonth= $row[4];
	$targetDay= $row[3];
	$targetHour= $row[2];
	$targetMinute= $row[1];
	$targetSecond= $row[0];
$dateFormat = "Y-m-d H:i:s";
$targetDate = mktime($targetHour,$targetMinute,$targetSecond,$targetMonth,$targetDay,$targetYear);
$actualDate = time();
$htim = $time*3600;
$ms = $actualDate - $targetDate;
$tl = $htim - $ms; 
$ml = ($tl / 60);
$hl = ($ml / 60);
if ($u == $o OR $oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
echo ("<div id=\"ltable\" align=\"center\"><h1><a href=\"banko.php\">Ownership</a></h1>");
if ($ml > 90) {
echo "You already have &#36;".number_format($depm)." deposited for $hour hours!<br />
Time Remaining: ".number_format($hl)." hours<br />
<form method=\"post\" action=\"bankremove.php\">
<p>There is a 10% fee on all money removed early.</p>
<input type=\"submit\" name=\"submit\" value=\"Remove\" />
<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></center></form>";
} elseif ($ml < 91) {
echo "<center>You already have &#36;".number_format($depm)." deposited for $hour hours!<br />
Time Remaining: ".number_format($ml)." Minutes<br />
<form method=\"post\" action=\"bankremove.php\">
<p>There is a 10% fee on all money removed early.</p>
<input type=\"submit\" name=\"submit\" value=\"Remove\" />
<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></center></form>";
}
echo("<br /><br />
	<form method=\"post\" action=\"transfer.php\">
	<h2>Transfers</h2>
	<p>Current tax percent: $taxpercent%</p>
	<p><a href=\"transferlog.php?id={$_COOKIE['id']}\">Last 50 Transfers</a></p>
	<table>
	<tr><td align=\"right\">To: <td><input type=\"text\" name=\"to\"></td></tr>
	<tr><td align=\"right\">Amount: <td><input type=\"text\" name=\"amount\"></td></tr>
	<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Transfer!\" />
	<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></td></tr>
	</table>
	</form>
	</div>");
include("footer.php");
exit();

} else {
if ($ml > 90) {
echo "<div id=\"ltable\" align=\"center\">You already have &#36;".number_format($depm)." deposited for $hour hours!<br />
Time Remaining: ".number_format($hl)." hours<br />
<form method=\"post\" action=\"bankremove.php\">
<p>There is a 10% fee on all money removed early.</p>
<input type=\"submit\" name=\"submit\" value=\"Remove\" />
<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></form>";
} elseif ($ml < 91) {
echo "<div id=\"ltable\" align=\"center\">You already have &#36;".number_format($depm)." deposited for $hour hours!<br />
Time Remaining: ".number_format($ml)." Minutes<br />
<form method=\"post\" action=\"bankremove.php\">
<p>There is a 10% fee on all money removed early.</p>
<input type=\"submit\" name=\"submit\" value=\"Remove\" />
<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></form>";
}

echo("<center><br /><br />
	<form method=\"post\" action=\"transfer.php\">
	<h2>Transfers</h2>
	<p>Current tax percent: $taxpercent%</p>
	<p><a href=\"transferlog.php?id={$_COOKIE['id']}\">Last 50 Transfers</a></p>
	<table>
	<tr><td align=\"right\">To: <td><input type=\"text\" name=\"to\"></td></tr>
	<tr><td align=\"right\">Amount: <td><input type=\"text\" name=\"amount\"></td></tr>
	<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Transfer!\" />
	<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></td></tr>
	</table>
	</form>
	</div>");
include("footer.php");
}
}
}
}
?> 