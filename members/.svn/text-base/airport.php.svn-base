<?php
$title="Airport";
include("config.php");
include("header.php");
include("countdown_p.php");
checks();

$result = mysql_query("SELECT username, location, money, Airtravel FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);

$u = $row[0];
$l = $row[1];
$m = $row[2];
$travel = $row[3];

$result = mysql_query("SELECT owner, markup FROM airport WHERE location='$l'");
$row2 = mysql_fetch_array ($result);

$owner = $row2[0];
$markup = $row2[1];

$result = mysql_query("SELECT money FROM Players WHERE username='$owner'");
$row3 = mysql_fetch_array ($result);
				
$ownercash = $row3[0];

$s = date('s');
$i = date('i');
$h = date('H');
$d = date('d');
$mo = date('m');
$y = date('Y');
$current = time();

$now = time();
if ($now < $travel) {
$sl = $travel - $now;
$ml = floor($sl/60);
if ($sl > 89) {
echo "<div id=\"crimestext\"><center>Not so fast! The next flight leaves in $ml minutes!</center></div>";
include("footer.php");
} elseif ($sl < 90) {
echo "<div id=\"crimestext\"><center>Not so fast! The next flight leaves in $sl seconds!</center></div>";
include("footer.php");
}
exit();
}
$resulto = mysql_query("SELECT id FROM Robbery WHERE leader='$u' OR driver='$u' OR wep='$u' OR ee='$u'");
	$row = mysql_fetch_array($resulto);
	
	$rid = $row[0];
	
if (mysql_num_rows($resulto) >= 1) {

echo ("<div id=\"crimestext\"><center>You are currently in an Organised Robbery, and cannot travel until it has been completed or you leave it.<br /><a href=\"/airport.php\">Go back.</a></center></div>");
include("footer.php");
exit();
}

if (isset($_POST['submit'])) {
mysql_query("DELETE FROM boarding WHERE username='$u'");
		$sr = $_POST['travel'];
		$plane = $_POST['Plane'];
		if ($plane == 'Airport') {
		$tt = '100 Minutes';
		$air = "Airports Plane";
		$timer = 100 * 60;
		$add = 50000;
		} elseif ($plane == 'Training') {
		$tt = '90 Minutes';
		$air = 'Training Plane';
		$timer = 90 * 60;
		} elseif ($plane == 'Gilder') {
		$tt = '80 Minutes';
		$air = 'Glider';
		$timer = 80 * 60;
		} elseif ($plane == 'PP') {
		$tt = '75 Minutes';
		$air = 'Passenger Plane';
		$timer = 75 * 60;
		} elseif ($plane == 'JJ') {
		$tt = '70 Minutes';
		$air = 'Jumbo Jet';
		$timer = 70 * 60;
		} elseif ($plane == 'VB') {
		$tt = '60 Minutes';
		$air = 'Vulcan Bomber';
		$timer = 60 * 60;
		} elseif ($plane == 'F15') {
		$tt = '50 Minutes';
		$air = 'F15 Fighter';
		$timer = 50 * 60;
		} elseif ($plane == 'Eagle') {
		$tt = '40 Minutes';
		$air = 'Eagle Fighter';
		$timer = 40 * 60;
		} elseif ($plane == 'Stealth') {
		$tt = '35 Minutes';
		$air = 'Stealth Fighter';
		$timer = 35 * 60;
		} elseif ($plane == 'Euro') {
		$tt = '30 Minutes';
		$air = 'Eurofighter Typhoon';
		$timer = 30 * 60;
		}
		if ($sr == Philippines) {
				$tmark = (65201 * $markup);
				$final = (65201 + $tmark + $add);
				$sql = mysql_query("INSERT INTO boarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$timer')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Plane:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='airport.php' method='POST'><input type='submit' name='Fly' value='Fly!'>
							   </form></div>";
							   include("footer.php");
				exit();  
		} elseif ($sr == UK) {
				$tmark = (68324 * $markup);
				$final = (68324 + $tmark + $add);
				$sql = mysql_query("INSERT INTO boarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$timer')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Plane:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='airport.php' method='POST'><input type='submit' name='Fly' value='Fly!'>
							   </form></div>";
							   include("footer.php");
				exit(); 
					
		} elseif ($sr == Russia) {
				$tmark = (65430 * $markup);
				$final = (65430 + $tmark + $add);
				$sql = mysql_query("INSERT INTO boarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$timer')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Plane:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='airport.php' method='POST'><input type='submit' name='Fly' value='Fly!'>
							   </form></div>";
							   include("footer.php");
				exit(); 
		} elseif ($sr == Australia) {
				$tmark = (69144 * $markup);
				$final = (69144 + $tmark + $add);
				$sql = mysql_query("INSERT INTO boarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$timer')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Plane:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='airport.php' method='POST'><input type='submit' name='Fly' value='Fly!'>
							   </form></div>";
							   include("footer.php");
				exit();
		} elseif ($sr == Brazil) {
				$tmark = (67692 * $markup);
				$final = (67692 + $tmark + $add);
				$sql = mysql_query("INSERT INTO boarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$timer')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Plane:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='airport.php' method='POST'><input type='submit' name='Fly' value='Fly!'>
							   </form></div>";
							   include("footer.php");
				exit(); 
		} elseif ($sr == USA) {
				$tmark = (62598 * $markup);
				$final = (62598 + $tmark + $add);
				$sql = mysql_query("INSERT INTO boarding (price, locationt, locationf, username, plane, timer) values ('$final', '$sr', '$l', '$u', '$air', '$timer')");
				echo "<div id='crimestext' align='center'><table><tr><td>Location:</td><td>$sr</td></tr><br>
							   <tr><td>Price:</td><td>&#36;".number_format($final)."</td></tr>
							   <tr><td>Plane:</td><td>$air</td></tr>
							   <tr><td>Time:</td><td>$tt</td></tr></table>
							   <form action='airport.php' method='POST'><input type='submit' name='Fly' value='Fly!'>
							   </form></div>";
							   include("footer.php");
				exit(); 
		} else {
echo ("<div id=\"crimestext\"><center>You must choose one of the locations to travel to! <br /> <a href=\"/airport.php\">Go back.</a></center></div>");
include("footer.php");
}
} elseif ($_REQUEST['Fly']) {
$query = mysql_query("SELECT price, locationt, timer, plane FROM boarding WHERE username='$u'");
$row=mysql_fetch_array($query);
$final = $row[0];
$dest = $row[1];
$timer = $row[2];
$plane = $row[3];
if ($plane != "Airports Plane") {
$sql1 = mysql_query("SELECT * FROM hanger WHERE username='$u' AND percent=100 AND plane='$plane' LIMIT 1");
if (mysql_num_rows($sql1) == 0) {
echo ("<div id=\"crimestext\"><center>You cannot fly with a plane you have not got!<br /> <a href=\"/airport.php\">Go back.</a></center></div>");
include("footer.php");
mysql_close;
exit();
}}
if ($l == "$dest" && $m >= $final) {
				if ($dest == 'UK' OR $dest == 'USA' OR $dest == 'Philippines') {
				echo ("<div id=\"crimestext\"><center>You're already in the $dest! <br /> <a href=\"/airport.php\">Go back.</a></center></div>");
				include("footer.php");
				mysql_close;
				exit();
				} else {
				echo ("<div id=\"crimestext\"><center>You're already in the $dest! <br /> <a href=\"/airport.php\">Go back.</a></center></div>");
				include("footer.php");
				mysql_close;
				exit();
				}
			} elseif ($m < $final) {
		
				echo ("<div id=\"crimestext\"><center>You don't have enough money to travel to the $dest!<br /><a href=\"/airport.php\">Go back.</a></center></div>");
				include("footer.php");
				mysql_close();
				exit();
			} elseif (mysql_num_rows($query) == 0) {
			echo ("<div id=\"crimestext\"><center>There has been an error in boarding, please try again!<br /><a href=\"/airport.php\">Go back.</a></center></div>");
			include("footer.php");
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
				$ntimer = $current + $timer;
				$result = mysql_query("UPDATE Players SET Airtravel='$ntimer', money='$money', location='$dest' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
				$result = mysql_query("UPDATE Players SET money='$newmoney' WHERE username='$owner'");
				mysql_query("DELETE FROM boarding WHERE username='$u'");

				echo ("<div id=\"crimestext\"><center>You've arrived in$the$dest! <br /> The final price was: &#36;".number_format($final).". <br />");
					if ($plane != "Airports Plane") {
					$damage = rand (0, 100);
					if ($damage == 100) {
					echo "You crashed on your way to your destination! The remains of the plane can be seen on the runway.<br>";
					echo "<a href=\"/airport.php\">Go back.</a></center></div>";
					mysql_query("DELETE FROM hanger WHERE username='$u' AND percent=100 AND plane='$plane' LIMIT 1");
					include("footer.php");
					mysql_close();
					exit();
					} elseif ($damage == 0) {
					echo "You perfectly guided your plane to the destiontion, it's safely locked away in the Hanger!<br>";
					echo "<a href=\"/airport.php\">Go back.</a></center></div>";
					include("footer.php");
					mysql_close();
					exit();
					} else {
					$per = 100 - $damage;
					mysql_query("UPDATE hanger SET percent='$per' WHERE username='$u' AND percent=100 AND plane='$plane' LIMIT 1");
					echo "The plane is still in one piece after taking $damage damage from the flight!<br>";
					echo "<a href=\"/airport.php\">Go back.</a></center></div>";
					include("footer.php");
					mysql_close();
					exit();
					}
					}
					echo "You had a nice luxury flight in the plane you borrowed from the airport.<br>";
					echo "<a href=\"/airport.php\">Go back.</a></center></div>";					
				include("footer.php");
				mysql_close();
				exit();
			}
}
?>	 