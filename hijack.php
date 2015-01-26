<?php
$title="Hijack an Aircraft";
require_once("members/config.php");
checks();
online();

$res=$mysqli->query("SELECT `clicks`,`haatime`,`rank` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_assoc();
$clicks=$row['clicks'];
$urank=$row['rank'];
$secondsDiff=$row['haatime']-time();

$mysqli->query("UPDATE Players SET clicks=(clicks+1) WHERE id ='$_COOKIE[id]' LIMIT 1");
if ($clicks >= 25) {
	setcookie ('scheck', $_SERVER["PHP_SELF"], time()+60*60*24*10, '/');
	header("Location: scriptcheck.php");
	exit();
}

require_once("members/header.php");
echo '<div class="page-header"><h1>Hijack an Aircraft <small>Find yourself a new airplane</small></h1></div>';
prisonCheck();

if (isset($_POST['haa'])) {
	$r=rand(1,100);
	$rv=rand(1,100);
	$rd=rand(10,100);
	if(isset($_POST['local'])) {
		if ($r >= 1 AND $r <= 30) {
			$fail = 1;
		} elseif ($r > 30 AND $r <= 70) {
			$jail = 1;	
		} elseif ($r > 70 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 33) {
				$c='Training Plane';
			} elseif ($rv > 33 AND $rv <= 60) {
				$c='Glider';
			} elseif ($rv > 60 AND $rv <= 85) {
				$c='Passenger Plane';
			} elseif ($rv > 85) {
				$c='Jumbo Jet';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent, type) VALUES ('$_COOKIE[id]', '$c', '$rd', 'plane')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You broke into the showroom and got away with a $c at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+25), haatime='".(time()+480)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	} elseif(isset($_POST['airforce'])) {
		if ($r >= 1 AND $r <= 30) {
			$fail = 1;
		} elseif ($r > 30 AND $r <= 70) {
			$jail = 1;	
		} elseif ($r > 70 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 33) {
				$c='Training Plane';
			} elseif ($rv > 33 AND $rv <= 60) {
				$c='Vulcan Bomber';
			} elseif ($rv > 60 AND $rv <= 85) {
				$c='F15 Fighter';
			} elseif ($rv > 85) {
				$c='Eagle Fighter';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent, type) VALUES ('$_COOKIE[id]', '$c', '$rd', 'plane')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You stole a $c from the impound lot at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+25), haatime='".(time()+480)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	} elseif(isset($_POST['international'])) {
		if ($r >= 1 AND $r <= 40) {
			$fail = 1;
		} elseif ($r > 40 AND $r <= 77) {
			$jail = 1;	
		} elseif ($r > 77 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 10) {
				$c='Passenger Plane';
			} elseif ($rv > 10 AND $rv <= 40) {
				$c='Jumbo Jet';
			} elseif ($rv > 40 AND $rv <= 80) {
				$c='Eagle Fighter';
			} elseif ($rv > 80) {
				$c='Stealth Fighter F117';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent, type) VALUES ('$_COOKIE[id]', '$c', '$rd', 'plane')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You were able to get away from the plant with a $c at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+30), haatime='".(time()+720)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	} elseif(isset($_POST['storage'])) {
		if ($r >= 1 AND $r <= 40) {
			$fail = 1;
		} elseif ($r > 40 AND $r <= 77) {
			$jail = 1;	
		} elseif ($r > 77 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 10) {
				$c='Vulcan Bomber';
			} elseif ($rv > 10 AND $rv <= 50) {
				$c='Eagle Fighter';
			} elseif ($rv > 50 AND $rv <= 85) {
				$c='Stealth Fighter F117';
			} elseif ($rv > 85) {
				$c='Eurofighter Typhoon';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent, type) VALUES ('$_COOKIE[id]', '$c', '$rd', 'plane')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You got away from the base with a $c at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+35), haatime='".(time()+900)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	}
	
	if($fail == 1) {
		echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> You were unable to successfully steal an aircraft</div>";
	} elseif($jail == 1) {
		echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Busted!</span> The cops came as you were making your escape, and you were sent to jail</div>";
		$jtime=time()+($urank*20);
		$mysqli->query("INSERT INTO prison (username, location, time) VALUES ('$_COOKIE[id]', '$location', ($jtime))");
	}
	exit();
}

if ($secondsDiff > 0) {
	if ($secondsDiff > 60) {
		$secondsDiff= floor($secondsDiff/60);
		echo "<div class=\"alert alert-info\"><span class=\"label label-info\">Relax!</span> You need to wait $secondsDiff minutes before your next attempt!</div>";
	} else {
		echo "<SCRIPT TYPE=\"text/javascript\" LANGUAGE=\"JavaScript\">
	<!-- //start
	var times = new Array(1);
	times[0] = $secondsDiff;
	function Count(){
						if (times[0] > 0) { 
							document.getElementById('0').innerHTML = times[0];
						} else { 
							window.location.reload();
						}
			times[0]--;
		setTimeout(\"Count()\", 1000);
	}
	window.onload=function(){Count();}
	 //-->
	</SCRIPT>
	<div class=\"alert alert-info\"><span class=\"label label-info\">Relax!</span> You need to wait <span id='0'></span> seconds before your next attempt!</div>";
	} 
	require_once("members/footer.php");
	exit();
} else {
?>

<form action="hijack.php" method="post">
<input type="hidden" name="haa" value="go">
<table class="table table-bordered table-striped">
<thead>
<tr><th>Description</th><th>Action</th></tr>
</thead>
<tbody>
<tr><td><strong>Steal from local airport</strong><br>Type: Smaller Planes<br>Experience: +25<br>Wait Time: 8 minutes</td><td><input class="btn" type="submit" name="local" value="Steal It"></td></tr>
<? if($urank > 1) { ?>
<tr><td><strong>Steal from local air force</strong><br>Type: Larger planes<br>Experience: +25<br>Wait Time: 8 minutes</td><td><input class="btn" type="submit" name="airforce" value="Steal It"></td></tr>
<? } if($urank > 3) { ?>
<tr><td><strong>Steal from international airport</strong><br>Type: Sports or Luxury cars<br>Experience: +30<br>Wait Time: 12 minutes</td><td><input class="btn" type="submit" name="international" value="Steal It"></td></tr>
<? } if($urank > 7) { ?>
<tr><td><strong>Steal from an air force storage facility</strong><br>Type: Armored vehicles<br>Experience: +35<br>Wait Time: 15 minutes</td><td><input class="btn" type="submit" name="storage" value="Steal It"></td></tr>
<? } ?>
</tbody>
</table>
</form>
<?
if($urank < 8) {
	echo "<div class=\"alert alert-info\"><span class=\"label label-info\">Info</span> Keep ranking up to unlock more types!</div>";
}

require_once("members/footer.php");
}
?>