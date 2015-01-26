<?php
$title="Grand Theft Auto";
require_once("members/config.php");
checks();
online();

$res=$mysqli->query("SELECT `clicks`,`gtatime`,`rank` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_assoc();
$clicks=$row['clicks'];
$urank=$row['rank'];
$secondsDiff=$row['gtatime']-time();

$mysqli->query("UPDATE Players SET clicks=(clicks+1) WHERE id ='$_COOKIE[id]' LIMIT 1");
if ($clicks >= 25) {
	setcookie ('scheck', $_SERVER["PHP_SELF"], time()+60*60*24*10, '/');
	header("Location: scriptcheck.php");
	exit();
}

require_once("members/header.php");
echo '<div class="page-header"><h1>Grand Theft Auto <small>Rob cars, trucks, or even tanks</small></h1></div>';

$res=$mysqli->query("SELECT `time` FROM `prison` WHERE `username`='$_COOKIE[id]' LIMIT 1");
$jail=$res->fetch_array();
if($res->num_rows > 0 AND $jail[0] > time()) {
	$secondsDiff=$jail[0]-time();
	if ($secondsDiff > 60) {
		$secondsDiff= floor($secondsDiff/60);
		echo "<div class=\"alert alert-info\"><span class=\"label label-info\">Locked Up!</span> You are in jail for $secondsDiff more minutes</div>";
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
	<div class=\"alert alert-info\"><span class=\"label label-info\">Locked Up!</span> You are in jail for <span id='0'></span> more seconds</div>";
	} 
	require_once("members/footer.php");
	exit();
}

if (isset($_POST['gta'])) {
	$r=rand(1,100);
	$rv=rand(1,100);
	$rd=rand(10,100);
	if(isset($_POST['showroom'])) {
		if ($r >= 1 AND $r <= 30) {
			$fail = 1;
		} elseif ($r > 30 AND $r <= 70) {
			$jail = 1;	
		} elseif ($r > 70 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 33) {
				$c='Jeep';
			} elseif ($rv > 33 AND $rv <= 60) {
				$c='Lamborghini Gallardo';
			} elseif ($rv > 60 AND $rv <= 85) {
				$c='Ferrari 458';
			} elseif ($rv > 85) {
				$c='Bugatti Veyron';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent, type) VALUES ('$_COOKIE[id]', '$c', '$rd', 'car')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You broke into the showroom and got away with a $c at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+25), gtatime='".(time()+480)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	} elseif(isset($_POST['police'])) {
		if ($r >= 1 AND $r <= 30) {
			$fail = 1;
		} elseif ($r > 30 AND $r <= 70) {
			$jail = 1;	
		} elseif ($r > 70 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 33) {
				$c='Hummer H3';
			} elseif ($rv > 33 AND $rv <= 60) {
				$c='Range Rover';
			} elseif ($rv > 60 AND $rv <= 85) {
				$c='Ferrari 458';
			} elseif ($rv > 85) {
				$c='Patrol Car';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent, type) VALUES ('$_COOKIE[id]', '$c', '$rd', 'car')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You stole a $c from the impound lot at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+25), gtatime='".(time()+480)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	} elseif(isset($_POST['plant'])) {
		if ($r >= 1 AND $r <= 40) {
			$fail = 1;
		} elseif ($r > 40 AND $r <= 77) {
			$jail = 1;	
		} elseif ($r > 77 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 10) {
				$c='Jeep';
			} elseif ($rv > 10 AND $rv <= 40) {
				$c='Lamborghini Gallardo';
			} elseif ($rv > 40 AND $rv <= 80) {
				$c='Ferrari 458';
			} elseif ($rv > 80) {
				$c='Bugatti Veyron';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent, type) VALUES ('$_COOKIE[id]', '$c', '$rd', 'car')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You were able to get away from the plant with a $c at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+30), gtatime='".(time()+720)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	} elseif(isset($_POST['army'])) {
		if ($r >= 1 AND $r <= 40) {
			$fail = 1;
		} elseif ($r > 40 AND $r <= 77) {
			$jail = 1;	
		} elseif ($r > 77 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 10) {
				$c='Hummer H3';
			} elseif ($rv > 10 AND $rv <= 50) {
				$c='Range Rover';
			} elseif ($rv > 50 AND $rv <= 85) {
				$c='Patrol Car';
			} elseif ($rv > 85) {
				$c='Tank';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent, type) VALUES ('$_COOKIE[id]', '$c', '$rd', 'car')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You got away from the base with a $c at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+35), gtatime='".(time()+900)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	} elseif(isset($_POST['storage'])) {
		if ($r >= 1 AND $r <= 30) {
			$fail = 1;
		} elseif ($r > 30 AND $r <= 65) {
			$jail = 1;	
		} elseif ($r > 65 AND $r <= 100) {
			if ($rv >= 1 AND $rv <= 40) {
				$c='Ferrari 458';
			} elseif ($rv > 40 AND $rv <= 60) {
				$c='Patrol Car';
			} elseif ($rv > 60 AND $rv <= 80) {
				$c='Bugatti Veyron';
			} elseif ($rv > 85) {
				$c='Tank';
			}
			$mysqli->query("INSERT INTO garage (username, vehicle, percent) VALUES ('$_COOKIE[id]', '$c', '$rd', 'car')");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> You managed to cruise away in a $c at $rd%</div>";
		}
		$mysqli->query("UPDATE Players SET exp=(exp+40), gtatime='".(time()+1200)."' WHERE id='$_COOKIE[id]' LIMIT 1");
	}
	
	if($fail == 1) {
		echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> You were unable to successfully steal a vehicle</div>";
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

<form action="gta.php" method="post">
<input type="hidden" name="gta" value="go">
<table class="table table-bordered table-striped">
<thead>
<tr><th>Description</th><th>Action</th></tr>
</thead>
<tbody>
<tr><td><strong>Steal from local car show room</strong><br>Type: Regular or Sports cars<br>Experience: +25<br>Wait Time: 8 minutes</td><td><input class="btn" type="submit" name="showroom" value="Steal It"></td></tr>
<? if($urank > 1) { ?>
<tr><td><strong>Steal from local police station</strong><br>Type: Regular or Armored cars<br>Experience: +25<br>Wait Time: 8 minutes</td><td><input class="btn" type="submit" name="police" value="Steal It"></td></tr>
<? } if($urank > 3) { ?>
<tr><td><strong>Steal from car production plant</strong><br>Type: Sports or Luxury cars<br>Experience: +30<br>Wait Time: 12 minutes</td><td><input class="btn" type="submit" name="plant" value="Steal It"></td></tr>
<? } if($urank > 5) { ?>
<tr><td><strong>Steal from nearest army base</strong><br>Type: Armored vehicles<br>Experience: +35<br>Wait Time: 15 minutes</td><td><input class="btn" type="submit" name="army" value="Steal It"></td></tr>
<? } if($urank > 9) { ?>
<tr><td><strong>Steal from government storage facility</strong><br>Type: High-end vehicles<br>Experience: +40<br>Wait Time: 20 minutes</td><td><input class="btn" type="submit" name="storage" value="Steal It"></td></tr>
<? } ?>
</tbody>
</table>
</form>
<?
if($urank < 10) {
	echo "<div class=\"alert alert-info\"><span class=\"label label-info\">Info</span> Keep ranking up to unlock more types!</div>";
}

require_once("members/footer.php");
}
?>