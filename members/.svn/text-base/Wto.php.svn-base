<?php
ob_start();
include("config.php");
include("Online.php"); 
include("Rank-ups.inc.php");
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

	$query = "SELECT username FROM Players WHERE id='{$_COOKIE['id']}'";
	$result = @mysql_query($query);
	$row = mysql_fetch_array($result);

	$u = $row[0];

		$query = "SELECT id, till, Mn_bd, Mx_bd, location FROM WT WHERE owner='$u'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$t = $row[1];
		$min = $row[2];
		$max = $row[3];
		$l = $row[4];
				
			
		if (mysql_num_rows($result) >= 1) {
			
			$sql = mysql_query("SELECT * FROM wtescrow WHERE location ='$l'");
			$row = mysql_fetch_array($sql);
			echo '<div id="gameplay"><center><table align="center" width="80%"><tr><td align="center">';
			echo '<center>What would you like to do?<br /><br />';
			if (mysql_num_rows($sql) == 0) {
			echo '<center><form method="post" action="send_wt.php">
 			 <h1>Change Owners</h1>
  			  <p><table><tr><td>Username:</td><td> <input type="text" name="uname" /></td></tr>
  			  <tr><td>Money:</td><td> <input type="text" name="money" /></td></tr>
  			  <tr><td>Bullets:</td><td> <input type="text" name="bullets" /></td></tr>
  			 <tr><td> Tokens:</td><td> <input type="text" name="tokens" /></td></tr></table></p>
			<input type="submit" name="submit" value="Send!" />
			<input type="hidden" name="submitted" value="TRUE" /></p>
			</form>';
			} else {
			$other = $row['other']; $money = $row['money']; $bullets = $row['bullets']; $tokens = $row['tokens'];
			echo "<div id='garage'><table><tr class='top'><td>Username</td><td>Money</td><td>Bullets</td><td>Tokens</td><td>Cancel</td></tr>
			<tr><td>$other</td><td>$".number_format($money)."</td><td>".number_format($bullets)."</td><td>".number_format($tokens)."</td><td><a href='cancelwt.php'>Cancel</a></td></tr></table></div>";
			}

			echo("<center><form method=\"post\" action=\"insertwt.php\">
 			 <h1>Insert/Take Till</h1>
 			 <p>Current Till Balance: $".number_format($t)."</p>
  			  <p>Money: <input type=\"text\" name=\"t\" /></p>
			<input type=\"submit\" name=\"submit\" value=\"Insert!\" /><input type=\"submit\" name=\"submit2\" value=\"Take!\" />
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></p>
			</form><br /><br />");

			echo("<center><form method=\"post\" action=\"mxbwt.php\">
 			 <h1>Change Max Bet</h1>
 			 <p>Current Max Bet: $".number_format($max)."</p>
  			  <p>Max Bet: <input type=\"text\" name=\"mx\" /></p>
			<input type=\"submit\" name=\"submit\" value=\"Change!\" />
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></p>
			</form><br /><br />");
			
			echo("<center><form method=\"post\" action=\"mnbwt.php\">
 			 <h1>Change Min Bet</h1>
 			 <p>Current Min Bet: $".number_format($min)."</p>
  			  <p>Min Bet: <input type=\"text\" name=\"mn\" /></p>
			<input type=\"submit\" name=\"submit\" value=\"Change!\" />
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></p>
			</form><br /><br />");

			echo '</td><td width="5%"></td><td width="50%" align="center" valign="top">';
			
			echo ('<div id="usertable">
				<h1>Daily Statistics</h1>');
				
			$day = (time()-86400);
				
			$query = "SELECT SUM( amount ) AS profit FROM wtbets WHERE location='$l' AND outcome='Loss' AND btime >= '$day'";
			$result = mysql_query($query);
			$row2 = mysql_fetch_array($result);
			
			$profit = $row2[0];
			
			$query = "SELECT SUM( amount ) AS loss FROM wtbets WHERE location='$l' AND outcome='Win' AND btime >= '$day'";
			$result = mysql_query($query);
			$row3 = mysql_fetch_array($result);
			
			$loss = $row3[0];
			
			$tprofit = ($profit - $loss);	
			
			$query = mysql_query("DELETE FROM wtbets WHERE btime < '$day'");
				
			echo "<p>Last 24 Hours Profit: &#36;".number_format($tprofit)."</p>";
			echo ('<table width=100%><tr>
				<tr><td colspan="4" align="center" class="top"><b>Last 25 Bets</b></tr>
				<td align=center width=20%>Player</td>
				<td align=center width=10%>Result</td>
				<td align=center width=20%>Amount</td>
				<td align=center width=50%>Date</td>
				</tr>');
				
			$gather=mysql_query("SELECT * FROM wtbets WHERE location='$l' ORDER BY btime DESC LIMIT 25;"); 
			while ($row=mysql_fetch_array($gather)){
			$id=stripslashes($row['id']);
			$amount=stripslashes($row['amount']);
			$outcome=stripslashes($row['outcome']);
			$date=stripslashes($row['date']);
			$username=stripslashes($row['username']);
	
			$query = "SELECT id FROM Players WHERE username='$username' LIMIT 1;";
			$result = @mysql_query ($query);
			$row = mysql_fetch_assoc($result);

			$toid = $row['id'];
	
			echo ("<tr><td align=\"center\"><b><a target=\"main\" href=\"/members/profile.php?id={$toid}\">$username</a></b></td> <td align=\"center\">$outcome</td> <td align=\"center\">&#36;".number_format($amount)."</td> <td align=\"center\">$date</td></tr>");
			
			}
			
			echo '</td></tr></table></center>';

			exit();
		} else {
		
			echo '<center>You do not own a War Table, please come back when you do!</center>';
			
			exit();
		}

?>