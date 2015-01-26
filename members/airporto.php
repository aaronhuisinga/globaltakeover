<?php
include("config.php");
checks();
online();

$result = mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$u = $row[0];

		$query = "SELECT id, location FROM airport WHERE owner='$u'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$aid = $row[0];
		$l = $row[1];
		$title="Manage The $l Airport";
		include("header.php");
				
		if (mysql_num_rows($result) >= 1) {
			$sql = mysql_query("SELECT * FROM apescrow WHERE location ='$l'");
			$row = mysql_fetch_array($sql);
			echo '<div id="ltable"><center><table align="center" width="80%"><tr><td align="center">';
			if (mysql_num_rows($sql) == 0) {
			echo '<center><form method="post" action="send_ap.php">
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
			<tr><td>$other</td><td>$".number_format($money)."</td><td>".number_format($bullets)."</td><td>".number_format($tokens)."</td><td><a href='cancelap.php'>Cancel</a></td></tr></table>";
			}
			echo '</td></tr><tr><td align="center">';
			echo ('<h1>Daily Statistics</h1>');
			$day = (time()-86400);
			$result = mysql_query("SELECT SUM( price ) AS profits FROM flights WHERE location='$l' AND ftime >= '$day'");
			$row = mysql_fetch_array($result);
			$profits = $row[0];	
			
			echo "<p>Last 24 Hours Profit: &#36;".number_format($profits)."<br />";
			$result = mysql_query("SELECT markup FROM airport WHERE location='$l' LIMIT 1;");
			$row = mysql_fetch_array($result);
			$markup = $row[0];
			$mpercent = ($markup * 100);
			$brazilfinal = (67692 + (67692 * $markup));
			$australiafinal = (69144 + (69144 * $markup));
			$ukfinal = (68324 + (68324 * $markup));
			$Russiafinal = (65430 + (65430 * $markup));
			$usafinal = (62598 + (62598 * $markup));
			$philippinesfinal = (65201 + (65201 * $markup));
				
			echo "Current Markup: $mpercent%</p>";
			echo ('<table width="80%" id="usertable"><tr>
				<tr><td colspan="4" align="center" class="top"><b>Current Flight Prices</b></tr>
				<tr><td align=center width=25%>Destination</td>
				<td align=center width=25%>List Price</td>');
			echo "<td align=center width=25%>Markup ($mpercent%)</td>";
			echo '<td align=center width=25%>Final Price</td>
				</tr>';
				
			echo "
			<tr><td align=\"center\">Australia</td> <td align=\"center\">&#36;".number_format(69144)."</td> <td align=\"center\">&#36;".number_format((69144 * $markup))."</td> <td align=\"center\">&#36;".number_format($australiafinal)."</td></tr>
			<tr><td align=\"center\">UK</td> <td align=\"center\">&#36;".number_format(68324)."</td> <td align=\"center\">&#36;".number_format((68324 * $markup))."</td> <td align=\"center\">&#36;".number_format($ukfinal)."</td></tr>
			<tr><td align=\"center\">Russia</td> <td align=\"center\">&#36;".number_format(65430)."</td> <td align=\"center\">&#36;".number_format((65430 * $markup))."</td> <td align=\"center\">&#36;".number_format($Russiafinal)."</td></tr>
			<tr><td align=\"center\">USA</td> <td align=\"center\">&#36;".number_format(62598)."</td> <td align=\"center\">&#36;".number_format((62598 * $markup))."</td> <td align=\"center\">&#36;".number_format($usafinal)."</td></tr>
			<tr><td align=\"center\">Philippines</td> <td align=\"center\">&#36;".number_format(65201)."</td> <td align=\"center\">&#36;".number_format((65201 * $markup))."</td> <td align=\"center\">&#36;".number_format($philippinesfinal)."</td></tr>";
			
			echo "</td></tr></table></td></tr>
			<tr><td><center><br /><form method=\"post\" action=\"changemarkup.php\">
 			 <h1>Change Flight Price Markup</h1>
  			 <p>Percent: <select name=\"select\">
  			 <option value=\"one\">10%</option>
  			 <option value=\"two\">20%</option>
  			 <option value=\"three\">30%</option>
  			 <option value=\"four\">40%</option>
  			 </select></p>
			<input type=\"submit\" name=\"submit\" value=\"Update!\" />
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></p>
			</form></table></div>";
			include("footer.php");
			exit();
		} else {
			echo '<div id="crimestext"><center>You do not own an Airport, please come back when you do!</center></div>';
			include("footer.php");
			exit();
		}
?>