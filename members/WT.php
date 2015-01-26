<?php 
ob_start();
include("config.php");
include("Banned.php");
include("Online.php"); 
include("Rank-ups.inc.php");

$result = mysql_query("SELECT theme, health, location, username, cclicks, money FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);

$h = $row[1];
$l = $row[2];
$u = $row[3];
$clicks = $row[4];
$m = $row[5];

$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

	if (isset($_POST['submit'])) {
		if ($clicks >= 4) {
		$url .= '/members/warscriptcheck.php';
		header("Location: $url");
		exit();
		}
		
		$newclicks = ($clicks + 1);

		$query = "SELECT Mx_bd, Mn_bd FROM WT WHERE location='$l'";
		$result = @mysql_query ($query);
		$row = mysql_fetch_array ($result);
		
		$mx = $row[0];
		$mn = $row[1];		
		
		if (empty($_POST['bet'])) {
			echo '<div align="center" id="crimestext">Please enter a number.</div>';
			mysql_close();
			exit();
		} else {
			$bet = intval(strip_tags(abs($_POST['bet'])));
	
	if (!preg_match("/[0-9]/",$bet)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"/WT.php\">Go back.</a></center></div>");
		exit();
	}
		}

		if ($mn <= $bet AND $bet <= $mx) {
			
			if ($m >= $bet) {
				
				$rd = rand(4, 15);
				
					if ($rd == 4) {
						$img = '<img src="cards/4.jpg" />';
					} elseif ($rd == 5) {
						$img = '<img src="cards/5.jpg" />';
					} elseif ($rd == 6) {
						$img = '<img src="cards/6.jpg" />';
					} elseif ($rd == 7) {
						$img = '<img src="cards/7.jpg" />';
					} elseif ($rd == 8) {
						$img = '<img src="cards/8.jpg" />';
					} elseif ($rd == 9) {
						$img = '<img src="cards/9.jpg" />';
					} elseif ($rd == 10) {
						$img = '<img src="cards/10.jpg" />';
					} elseif ($rd == 11) {
						$img = '<img src="cards/jack.jpg" />';
					} elseif ($rd == 12) {
						$img = '<img src="cards/queen.jpg" />';
					} elseif ($rd == 13) {
						$img = '<img src="cards/king.jpg" />';
					} elseif ($rd == 14) {
						$img = '<img src="cards/king.jpg" />';
					} elseif ($rd == 15) {
						$img = '<img src="cards/king.jpg" />';
					}
				$rp = rand(2, 13);
				
					if ($rp == 2) {
						$pimg = '<img src="cards/2.jpg" />';
					} elseif ($rp == 3) {
						$pimg = '<img src="cards/3.jpg" />';
					} elseif ($rp == 4) {
						$pimg = '<img src="cards/4.jpg" />';
					} elseif ($rp == 5) {
						$pimg = '<img src="cards/5.jpg" />';
					} elseif ($rp == 6) {
						$pimg = '<img src="cards/6.jpg" />';
					} elseif ($rp == 7) {
						$pimg = '<img src="cards/7.jpg" />';
					} elseif ($rp == 8) {
						$pimg = '<img src="cards/8.jpg" />';
					} elseif ($rp == 9) {
						$pimg = '<img src="cards/9.jpg" />';
					} elseif ($rp == 10) {
						$pimg = '<img src="cards/10.jpg" />';
					} elseif ($rp == 11) {
						$pimg = '<img src="cards/jack.jpg" />';
					} elseif ($rp == 12) {
						$pimg = '<img src="cards/queen.jpg" />';
					} elseif ($rp == 13) {
						$pimg = '<img src="cards/king.jpg" />';
					}
				
				if ($rd > $rp) {
					
					echo "<div align=\"center\" id=\"crimestext\">
					<table>
					<tr><td align=\"center\">$pimg</td> <td align=\"center\">$img</td></tr>
					<tr><td align=\"center\">Your Card</td> <td align=\"center\">Dealer's Card</td></tr>
					<tr><td colspan=\"2\" align=\"center\">The dealer won! You lost &#36;".number_format($bet)."!<br />
					<a href=\"/Wt.php\">Go back.</a></td></tr>
					</table></div>";
					
					echo ('<script language="javascript">
	  				window.parent.stats.location.reload();
	   				</script>');
	   				
	   				$date = (date("M d Y h:i:s A"));
					$current = time();
					mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$bet', '$date', '$u', 'Loss', '$current', 'Wt Bet')");	
					$query = "INSERT INTO `wtbets` ( `amount` , `date` , `username` , `location` , `outcome` , `btime` ) VALUES ('$bet', '$date', '$u', '$l', 'Loss', '$current')";
					$result = @mysql_query ($query);
					
					$query = "SELECT Till FROM WT WHERE location='$l'";
					$result = @mysql_query ($query);
					$row = mysql_fetch_array ($result);

					$t = $row[0];
					$nt = $t + $bet;
					$nm = $m - $bet;

					$query = "UPDATE WT SET Till='$nt' WHERE location='$l'";
					$result = @mysql_query ($query);

					$query = "UPDATE Players SET money='$nm', cclicks='$newclicks' WHERE id='{$_COOKIE['id']}'";
					$result = @mysql_query ($query);
					mysql_close();
					exit();

				} elseif ($rp > $rd) {
														
					$query = "SELECT Till FROM WT WHERE location='$l'";
					$result = @mysql_query ($query);
					$row = mysql_fetch_array ($result);

					$t = $row[0];
					$nt = $t - $bet;
					$nm = $m + $bet;
					if ($nt <= 0) {
						echo"<div id=\"crimestext\"><center><table>
					<tr><td align=\"center\">$pimg</td> <td align=\"center\">$img</td></tr>
					<tr><td align=\"center\">Your Card</td> <td align=\"center\">Dealer's Card</td></tr>
					<tr><td colspan=\"2\" align=\"center\">You Bankrupted The Table! You Have Become The New Owner With $1,000 To Start With!<br />
				<a href=\"/Wt.php\">Go back.</a></td></tr>
					</table></center></div>";
					
					$query = mysql_query("DELETE FROM wtbets WHERE location='$l'");
					
					echo ('<script language="javascript">
	  				window.parent.stats.location.reload();
	   				</script>');
	   				
					$query = "UPDATE WT SET owner='$u', Till='1000', Mx_bd='1', Mn_bd='1' WHERE location='$l'";
					$result = @mysql_query ($query);
					exit();
					} else {
					echo "<div align=\"center\" id=\"crimestext\"><table>
					<tr><td align=\"center\">$pimg</td> <td align=\"center\">$img</td></tr>
					<tr><td align=\"center\">Your Card</td> <td align=\"center\">Dealer's Card</td></tr>
					<tr><td colspan=\"2\" align=\"center\">You won the bet and came away with &#36;".number_format($bet)."!<br />
				<a href=\"/Wt.php\">Go back.</a></td></tr>
					</table></div>";
					
					$date = (date("M d Y h:i:s A"));
					$current = time();
					mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$bet', '$date', '$u', 'Gain', '$current', 'Wt Bet')");
					$query = "INSERT INTO `wtbets` ( `amount` , `date` , `username` , `location` , `outcome` , `btime` ) VALUES ('$bet', '$date', '$u', '$l', 'Win', '$current')";
					$result = @mysql_query ($query);
					
					echo ('<script language="javascript">
	  				window.parent.stats.location.reload();
	   				</script>');
	   				
					$query = "UPDATE WT SET Till='$nt' WHERE location='$l'";
					$result = @mysql_query ($query);

					$query = "UPDATE Players SET money='$nm', cclicks='$newclicks' WHERE id='{$_COOKIE['id']}'";
					$result = @mysql_query ($query);
					mysql_close();
					exit();
					}
				} elseif ($rp = $rd) {
					
					echo "<div align=\"center\" id=\"crimestext\"><table>
					<tr><td align=\"center\">$pimg</td> <td align=\"center\">$img</td></tr>
					<tr><td align=\"center\">Your Card</td> <td align=\"center\">Dealer's Card</td></tr>
					<tr><td colspan=\"2\" align=\"center\">You got the same card as the dealer!<br />
				<a href=\"/Wt.php\">Go back.</a></td></tr>
					</table></div>";
					mysql_close();
					exit();
				} else {
				}
			} else { 
				echo '<div align="center" id="crimestext">Please bet an amount of money that you have.<br />
				<a href="/Wt.php">Go back.</a></div>';
				mysql_close();
				exit();
			}
		} else {
			echo '<div align="center" id="crimestext">Please make a bet between the minimum and the maximum bet, or an actual number.<br />
				<a href="/Wt.php">Go back.</a></div>';
			mysql_close();
			exit();
		}
	} else {
		mysql_close();
		exit();
	}


?>