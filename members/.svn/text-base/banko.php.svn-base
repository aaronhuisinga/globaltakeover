<?php
include("config.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];

 
		$result = mysql_query("SELECT id, taxp, location FROM Bank WHERE owner='$u' LIMIT 1;");
		$row = mysql_fetch_array($result);
		$tax = $row[1];
		$l = $row[2];
		$title="Manage The $l Bank";
		include("header.php");
		
		$taxpercent = $tax * 100;
		$day = (time()-86400);
		$month = (time()-2592000);
		
		$sql = mysql_query("SELECT SUM( tax ) AS profit FROM transfers WHERE location='$l' AND ttime >= '$day'");
		$row = mysql_fetch_array ($sql);
		$profit = $row[0];
				
		if (mysql_num_rows($result) >= 1) {
		$query = mysql_query("DELETE FROM transfers WHERE btime < '$month'");
			$sql = mysql_query("SELECT * FROM bpescrow WHERE location ='$l' LIMIT 1;");
			$row = mysql_fetch_array($sql);
			echo '<div id="ltable" align="center">';echo "<h1>$l Bank Management</h1>"; echo'<table align="center" width="80%"><tr><td align="center">';
			if (mysql_num_rows($sql) == 0) {
			echo '<center><form method="post" action="send_bank.php">
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
			echo "<table id=\"usertable\"><tr class='top'><td>Username</td><td>Money</td><td>Bullets</td><td>Tokens</td><td>Cancel</td></tr>
			<tr><td>$other</td><td>$".number_format($money)."</td><td>".number_format($bullets)."</td><td>".number_format($tokens)."</td><td><a href='cancelb.php'>Cancel</a></td></tr></table>";
			}

			echo "<p>Last 24 hours profit: $".number_format($profit)."<br />";
			
			echo("<form method=\"post\" action=\"changetax.php\">
 			 <h1>Change Transfer Tax Percentage</h1>
 			 <p>Current Transfer Tax: $taxpercent%</p>
  			 <p>Percent: <select name=\"select\">
  			 <option value=\"one\">1%</option>
  			 <option value=\"two\">2%</option>
  			 <option value=\"three\">3%</option>
  			 <option value=\"four\">4%</option>
  			 <option value=\"five\">5%</option>
  			 <option value=\"six\">6%</option>
  			 <option value=\"seven\">7%</option>
  			 </select</p>
			<input type=\"submit\" name=\"submit\" value=\"Update!\" />
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></p>
			</form></table></div>");
			include("footer.php");
			exit();
		} else {
			echo "<div id=\"crimestext\" align=\"center\">You do not own a Bank. Come back when you do!</div>";
			include("footer.php");
			exit();
		}
?>