<?php
include("config.php");
include("countdown_p.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username, location, money, Btravel FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$l = $row[1];
$m = $row[2];
$travel = $row[3];

$row=mysql_fetch_array(mysql_query("SELECT owner, markup FROM port WHERE location='$l' LIMIT 1;"));
$owner = $row[0];
$markup = $row[1];

$row=mysql_fetch_array(mysql_query("SELECT money FROM Players WHERE username='$owner' LIMIT 1;"));			
$ownercash = $row[0];

if ($travel > $current) {
$sl = $travel - $current;
$ml = floor($sl/60);
if ($sl > 60) {
echo "<div id=\"crimestext\"><center>Not so fast! The next cruise leaves in $ml minutes!</center></div>";
} elseif ($sl < 60) {
echo "<div id=\"crimestext\"><center>Not so fast! The next cruise leaves in $sl seconds!</center></div>";
}
exit();
}
$query=mysql_query("SELECT id FROM Robbery WHERE leader='$u' OR driver='$u' OR wep='$u' OR ee='$u' LIMIT 1;");
$row=mysql_fetch_array($query);
$rid = $row[0];
	
if (mysql_num_rows($query) >= 1) {
echo ("<div id=\"crimestext\"><center>You are currently in an Organised Robbery, and cannot travel until it has been completed or you leave it.<br />
<a href=\"/port.php\">Go back.</a></center></div>");
exit();
}

if (isset($_POST['submit'])) {
		mysql_query("DELETE FROM bboarding WHERE username='$u' LIMIT 1;");
		$sr = $_POST['travel'];
		$plane = $_POST['Plane'];
		if ($plane == 'Airport') {
		$tt = '130 Minutes';
		$air = "Ports Boat";
		$currentr = 130 * 60;
		$add = 150000;
		} elseif ($plane == 'Training') {
		$tt = '115 Minutes';
		$air = 'Dingy';
		$currentr = 115 * 60;
		} elseif ($plane == 'Gilder') {
		$tt = '100 Minutes';
		$air = 'Air Craft Carrier';
		$currentr = 100 * 60;
		} elseif ($plane == 'PP') {
		$tt = '90 Minutes';
		$air = 'Catermaran';
		$currentr = 90 * 60;
		} elseif ($plane == 'JJ') {
		$tt = '80 Minutes';
		$air = 'Submarine';
		$currentr = 80 * 60;
		} elseif ($plane == 'VB') {
		$tt = '75 Minutes';
		$air = 'Battleship';
		$currentr = 75 * 60;
		} elseif ($plane == 'F15') {
		$tt = '65 Minutes';
		$air = 'Army submarine';
		$currentr = 65 * 60;
		} elseif ($plane == 'Eagle') {
		$tt = '60 Minutes';
		$air = 'Destroyer';
		$currentr = 60 * 60;
		} elseif ($plane == 'Stealth') {
		$tt = '50 Minutes';
		$air = 'Cruiser';
		$currentr = 50 * 60;
		} elseif ($plane == 'Euro') {
		$tt = '45 Minutes';
		$air = 'Nuclear Submarine';
		$currentr = 45 * 60;
		}
		if ($sr == Philippines) {
				$tmark = (55201 * $markup);
				$final = (55201 + $tmark + $add);
				mysql_query("INSERT INTO bboarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$currentr')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Boat:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='port.php' method='POST'><input type='submit' name='Fly' value='Sail!'>
							   </form></div>";
				exit();  
		} elseif ($sr == UK) {
				$tmark = (58324 * $markup);
				$final = (58324 + $tmark + $add);
				mysql_query("INSERT INTO bboarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$currentr')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Boat:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='port.php' method='POST'><input type='submit' name='Fly' value='Sail!'>
							   </form></div>";
				exit(); 
					
		} elseif ($sr == Russia) {
				$tmark = (55430 * $markup);
				$final = (55430 + $tmark + $add);
				mysql_query("INSERT INTO bboarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$currentr')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Boat:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='port.php' method='POST'><input type='submit' name='Fly' value='Sail!'>
							   </form></div>";
				exit(); 
		} elseif ($sr == Australia) {
				$tmark = (59144 * $markup);
				$final = (59144 + $tmark + $add);
				mysql_query("INSERT INTO bboarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$currentr')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Boat:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='port.php' method='POST'><input type='submit' name='Fly' value='Sail!'>
							   </form></div>";
				exit();
		} elseif ($sr == Brazil) {
				$tmark = (57692 * $markup);
				$final = (57692 + $tmark + $add);
				mysql_query("INSERT INTO bboarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$currentr')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Boat:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='port.php' method='POST'><input type='submit' name='Fly' value='Sail!'>
							   </form></div>";
				exit(); 
		} elseif ($sr == USA) {
				$tmark = (52598 * $markup);
				$final = (52598 + $tmark + $add);
				mysql_query("INSERT INTO bboarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$currentr')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Boat:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='port.php' method='POST'><input type='submit' name='Fly' value='Sail!'>
							   </form></div>";
				exit(); 
		} else {
echo ("<div id=\"crimestext\"><center>You must choose one of the locations to travel to! <br /> <a href=\"/port.php\">Go back.</a></center></div>");
}
} elseif ($_REQUEST['Fly']) {
$query = mysql_query("SELECT price, locationt, timer, plane FROM bboarding WHERE username='$u'");
$row=mysql_fetch_array($query);
$final = $row[0];
$dest = $row[1];
$currentr = $row[2];
$plane = $row[3];

if ($plane != "Ports Boat") {
$sql1 = mysql_query("SELECT * FROM dock WHERE username='$u' AND percent=100 AND boat='$plane' LIMIT 1");
if (mysql_num_rows($sql1) == 0) {
echo ("<div id=\"crimestext\"><center>You cannot cruise with a boat you do not own! $plane<br /> <a href=\"/port.php\">Go back.</a></center></div>");
mysql_close;
exit();
}}
if ($l == "$dest" && $m >= $final) {
				if ($dest == 'UK' OR $dest == 'USA' OR $dest == 'Philippines') {
				echo ("<div id=\"crimestext\"><center>You're already in the $dest! <br /> <a href=\"/port.php\">Go back.</a></center></div>");
				mysql_close;
				exit();
				} else {
				echo ("<div id=\"crimestext\"><center>You're already in the $dest! <br /> <a href=\"/port.php\">Go back.</a></center></div>");
				mysql_close;
				exit();
				}
			} elseif ($m < $final) {
		
				echo ("<div id=\"crimestext\"><center>You don't have enough money to travel to $dest!<br />
<a href=\"/port.php\">Go back.</a></center></div>");
				mysql_close();
				exit();
			} elseif (mysql_num_rows($query) == 0) {
			echo ("<div id=\"crimestext\"><center>There has been an error in boarding, please try again!<br />
			<a href=\"/port.php\">Go back.</a></center></div>");
				mysql_close();
				exit();
			
			} else {
				if ($dest == 'UK' OR $dest == 'USA' OR $dest == 'Philippines') {
				$the = ' the ';
				} else {
				$the = ' ';
				}
				$money = $m - $final;
				$newmoney = ($ownercash + $final);
				$ntimer = $current + $currentr;
				$result = mysql_query("UPDATE Players SET Btravel='$ntimer', money='$money', location='$dest' WHERE id='{$_COOKIE['id']}' LIMIT 1;");			
				$result = mysql_query("UPDATE Players SET money='$newmoney' WHERE username='$owner' LIMIT 1;");
				mysql_query("DELETE FROM bboarding WHERE username='$u' LIMIT 1;");

				echo ("<div id=\"crimestext\"><center>You've arrived in$the$dest! <br /> The final price was: &#36;".number_format($final).". <br />");
					if ($plane != "Ports Boat") {
					$damage = rand (0, 100);
					if ($damage == 100) {
					echo "You crashed on your way to your destination! Luckly a passing by ship managed to save you.<br>";
					echo "<a href=\"/port.php\">Go back.</a></center></div>";
					mysql_query("DELETE FROM dock WHERE username='$u' AND percent=100 AND boat='$plane' LIMIT 1");
					echo ('<script language="javascript">window.parent.bbar.location.reload();</script>');
	   				echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
					mysql_close();
					exit();
					} elseif ($damage == 0) {
					echo "You managed to perfectly guide your vessel around to seas and into harbor<br>";
					echo "<a href=\"/port.php\">Go back.</a></center></div>";
					echo ('<script language="javascript">window.parent.bbar.location.reload();</script>');
	   				echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
					mysql_close();
					exit();
					} else {
					$per = 100 - $damage;
					mysql_query("UPDATE dock SET percent='$per' WHERE username='$u' AND percent=100 AND boat='$plane' LIMIT 1");
					echo "The boat hit a few rocks, taking $damage damage from the whole trip!<br>";
					echo "<a href=\"/port.php\">Go back.</a></center></div>";
					echo ('<script language="javascript">window.parent.bbar.location.reload();</script>');
	   				echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
					mysql_close();
					exit();
					}
					}
					echo "You had a nice luxery cruise, and it was enjoyable with no worries.<br>";
					echo "<a href=\"/port.php\">Go back.</a></center></div>";					
				echo ('<script language="javascript">window.parent.bbar.location.reload();</script>');
	   			echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
				mysql_close();
				exit();
			}
}
?>	 