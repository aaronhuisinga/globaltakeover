<?php
include("config.php");
checks();
online();

	$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
	$u = $row[0];

		$result=mysql_query("SELECT id, location FROM wf WHERE owner='$u' LIMIT 1;");
		$row=mysql_fetch_array($result);
		$l = $row[1];
		
		$title="$l Weapon Factory Owner Panel";
		include("header.php");
				
		if (mysql_num_rows($result) >= 1) {
			$sql=mysql_query("SELECT * FROM wfescrow WHERE location='$l' LIMIT 1;");
			$row=mysql_fetch_array($sql);
			echo '<div id="ltable" align="center">'; echo "<h1>$l Weapon Factory Owner Panel</h1><br />"; echo '<table align="center" width="80%"><tr><td align="center">';
			if (mysql_num_rows($sql) == 0) {
			echo '<form method="post" action="send_wf.php">
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
			echo "<center><table id=\"usertable\"><tr class='top'><td>Username</td><td>Money</td><td>Bullets</td><td>Tokens</td><td>Cancel</td></tr>
			<tr><td>$other</td><td>$".number_format($money)."</td><td>".number_format($bullets)."</td><td>".number_format($tokens)."</td><td><a href='cancelwf.php'>Cancel</a></td></tr></table></center>";
			}
			
			echo ('<h1>Daily Statistics</h1>');
			$day = (time()-86400);
			$row=mysql_fetch_array(mysql_query("SELECT SUM( amount ) AS profit FROM wfsales WHERE location='$l' AND btime >= '$day'"));
			$profit=$row[0];	
			mysql_query("DELETE FROM wfsales WHERE btime < '$day'");
			echo "<p>Last 24 Hours Profit: &#36;".number_format($profit)."</p>";
			echo '</td></tr></table></div>';
			include("footer.php");
			exit();
		} else {
			echo '<center>You do not own a Weapon Factory, please come back when you do!</center>';
			include("footer.php");
			exit();
		}

?>