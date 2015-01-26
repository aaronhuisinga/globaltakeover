<?php
$title="Crimes";
include_once("members/config.php");

$res=$mysqli->query("SELECT * FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_assoc();
$clicks = $row['clicks'];
$urank = $row['rank'];
$username = $row['username'];
$location = $row['location'];
$secondsDiff = $row['crimetime'] - time();
$cargo=$row['cargo'];
$dmaps=$row['dmaps'];
$hlocations=$row['hlocation'];
$donor=$row['donor'];

$mysqli->query("UPDATE Players SET clicks=(clicks+1) WHERE id ='$_COOKIE[id]' LIMIT 1");
if ($clicks >= 25) {
	setcookie ('scheck', $_SERVER["PHP_SELF"], time()+60*60*24*10, '/');
	header("Location: scriptcheck.php");
	exit();
}
checks();
online();
include_once("members/header.php");
echo '<div class="page-header">
	<h1>Crimes <small>Easy to Commit... Harder to Get Away With.</small></h1>
</div>';
prisonCheck();

if ($secondsDiff > 0) {
if ($secondsDiff > 60) {
$secondsDiff= floor($secondsDiff/60);
echo ("<div class=\"alert alert-info\"><span class=\"label label-info\">Relax!</span> You just did a crime, you need to wait $secondsDiff minutes before you can attempt another one!</div>");
require_once("members/footer.php");
exit();
} else {
	echo ("<SCRIPT TYPE=\"text/javascript\" LANGUAGE=\"JavaScript\">
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
<div class=\"alert alert-info\"><span class=\"label label-info\">Relax!</span> You just did a crime, you need to wait <span id='0'></span> seconds before you can attempt another one!</div>");
require_once("members/footer.php");
exit();
}
} else {
	if ($_POST['submitted'] == 'TRUE') {
		$death=0;
		$jail=0;
		if (isset($_POST['stranger'])) {
			$payout=rand(500, 1000);
			$gun=rand(1, 100);
			$next=(time()+60);
			$chance=rand(1, 100);
			if ($chance > 0 AND $chance <= 20) {
			$jail=1; $ex=1;
			} elseif ($chance > 20 AND $chance <= 40) {
			$mysqli->query("UPDATE Players SET exp=(exp+1), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> As you tried to reach into the man's pocket, he noticed you. You were forced to flee!</div>";
			} else {
			if ($gun >= 1 AND $gun <= 50) {
			$mysqli->query("UPDATE Players SET money=(money+$payout), luger=(luger+1), exp=(exp+1), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You snuck up and successfully pickpocketed a stranger. You got away with $".number_format($payout)." and a Luger.</div>";
			} elseif ($gun > 50 AND $gun <= 70) {
			$mysqli->query("UPDATE Players SET money=(money+$payout), magnum=(magnum+1), exp=(exp+1), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You snuck up and successfully pickpocketed a stranger. You got away with $".number_format($payout)." and a .44 Caliber Magnum.</div>";
			} else {
			$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+1), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You snuck up and successfully pickpocketed a stranger. You managed to grab $".number_format($payout).".</div>";
			}
			}
		} elseif (isset($_POST['house'])) {
			$payout=rand(2000, 8000);
			$gun=rand(1, 100);
			$next=(time()+120);
			$chance=rand(1, 100);
			if ($chance > 0 AND $chance <= 20) {
			$jail=1; $ex=2;
			} elseif ($chance > 20 AND $chance <= 40) {
			$mysqli->query("UPDATE Players SET exp=(exp+2), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> An alarm went off as soon as you broke in! You left empty handed!</div>";
			} else {
			if ($gun >= 1 AND $gun <= 60) {
			$mysqli->query("UPDATE Players SET money=(money+$payout), magnum=(magnum+1), exp=(exp+2), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You broke into the house, and found a full safe! You got away with $".number_format($payout)." and a .44 Caliber Magnum.</div>";
			} elseif ($gun > 60 AND $gun <= 100) {
			$mysqli->query("UPDATE Players SET money=(money+$payout), uzi=(uzi+1), exp=(exp+1), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You broke into the house, and found a full safe! You got away with $".number_format($payout)." and a Mini-Uzi.</div>";
			} else {
			$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+2), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You broke into the house, and found a full safe! You managed to grab $".number_format($payout).".</div>";
			}
			}
		} elseif (isset($_POST['gasstation'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Buggy' AND percent='100' AND username='$username' LIMIT 1;");
			if ($row['uzi'] == 0) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 1 Mini-Uzi before you can do this crime!</div>";
			} elseif ($garage->num_rows < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 1 Buggy with no damage before you can do this crime!</div>";
			} else {
				$payout=rand(10000, 15000);
				$gun=rand(1, 100);
				$next=(time()+180);
				$chance=rand(1, 100);
				if ($chance > 0 AND $chance <= 20) {
				$jail=1; $ex=3;
				} elseif ($chance > 20 AND $chance <= 40) {
				$mysqli->query("UPDATE Players SET exp=(exp+3), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> The gas station worker quickly pulled a pistol on you, and you were forced to run!</div>";
				} else {
				if ($gun >= 1 AND $gun <= 40) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), steyr=(steyr+1), exp=(exp+3), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You held up the gas station, and the attendant quickly emptied the register. You got away with $".number_format($payout)." and a Steyr.</div>";
				} else {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+3), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You held up the gas station, and the attendant quickly emptied the register. You managed to grab $".number_format($payout).".</div>";
				}
				}
			}
		} elseif (isset($_POST['drugs'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Range Rover' AND percent='100' AND username='$username' LIMIT 1;");
			if ($row['steyr'] < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 Steyrs before you can do this crime!<br /><a href=\"crimes.php\">Go back.</a></div>";
			exit();
			} elseif ($garage->num_rows < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 1 Range Rover with no damage before you can do this crime!<br /><a href=\"crimes.php\">Go back.</a></div>";
			exit();
			}
			$payout=rand(30000, 50000);
			$next=(time()+300);
			$chance=rand(1, 100);
			$success=rand(1, 100);
			if ($success > 0 AND $success <= 20) {
			$jail=1; $ex=4;
			} elseif ($chance > 20 AND $chance <= 40) {
			$mysqli->query("UPDATE Players SET exp=(exp+4), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> The customer was an undercover cop! You were able to get away, but lost the drugs.</div>";
			} else {
			if ($chance > 0 AND $chance < 20) {
			$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+4), crimetime='$next', steyr=(steyr-3) WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You met up with the client and made the sale. You gained $".number_format($payout).".<br />
				  The cops came during the sale, and you were forced to flee. In the chaos, you lost 3 Steyrs!</div>";
			exit();
			} elseif ($chance > 20 AND $chance <= 40) {
			$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+4), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			$mysqli->query("DELETE FROM garage WHERE car='Range Rover' AND percent='100' AND username='$username' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You met up with the client and made the sale. You gained $".number_format($payout).".<br />
				  On the drive home, the cops started to chase you! You crashed your Range Rover into a tree, but were able to flee on foot!</div>";
			exit();
			}
			$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+4), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You met up with the client and made the sale. You gained $".number_format($payout).".</div>";
			}
		} elseif (isset($_POST['jewelry'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Hummer H3' AND percent='100' AND username='$username' LIMIT 5;");
			if ($row['g36c'] < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 G36Cs before you can do this crime!</div>";
			} elseif ($garage->num_rows < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 Hummer H3s with no damage before you can do this crime!</div>";
			} else {
				$payout=rand(80000, 100000);
				$next=(time()+360);
				$chance=rand(1, 100);
				$success=rand(1, 100);
				if ($success > 0 AND $success <= 20) {
				$jail=1; $ex=5;
				} elseif ($chance > 20 AND $chance <= 40) {
				$mysqli->query("UPDATE Players SET exp=(exp+5), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> There was still an employee in the store, and he called the police before you could take anything!</div>";
				} else {
				if ($chance > 0 AND $chance < 20) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+5), crimetime='$next', g36c=(g36c-2), health=(health-$chance) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You broke through the back door after the store was closed, and robbed it clean. You gained $".number_format($payout).".<br />
					  There was a silent alarm, and the cops showed up as you were leaving. In the chaos, you lost 2 G36Cs and $chance health!</div>";
				exit();
				} elseif ($chance > 20 AND $chance <= 40) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+5), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				$mysqli->query("DELETE FROM garage WHERE car='Hummer H3' AND percent='100' AND username='$username' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You broke through the back door after the store was closed, and robbed it clean. You gained $".number_format($payout).".<br />
					  The cops showed up just as you finished loading the diamonds, and seized 1 of your Hummer H3s.</div>";
				exit();
				}
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+5), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You broke through the back door after the store was closed, and robbed it clean. You gained $".number_format($payout).".</div>";
				}
			}
		} elseif (isset($_POST['gunshop'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Hummer H3' AND percent='100' AND username='$username' LIMIT 1;");
			if ($row['stinger'] < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 1 Stinger before you can do this crime!</div>";
			} elseif ($garage->num_rows < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 1 Hummer H3 with no damage before you can do this crime!</div>";
			} else {
				$payout=rand(15000, 30000);
				$next=(time()+360);
				$chance=rand(1, 100);
				$gun=rand(1, 100);
				$success=rand(1, 100);
				if ($success > 0 AND $success <= 20) {
				$jail=1; $ex=5;
				} elseif ($chance > 20 AND $chance <= 40) {
				$mysqli->query("UPDATE Players SET exp=(exp+5), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> A few of the customers fought back, and you were forced to flee empty handed!</div>";
				} else {
				if ($gun > 0 AND $gun <= 60) {
				$gun='G36C'; $gund='g36c';
				} else {
				$gun='P90'; $gund='p90';
				}
				if ($chance > 0 AND $chance < 10) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+5), crimetime='$next', $gun=($gun+2), health=(health-$chance) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You and three others stormed in and took control of the store, then filled your bags with whatever you wanted. You gained $".number_format($payout)." and two $gun's.<br />
					  When you turned around, the owner took his pistol and shot you. You lost $chance health!</div>";
				exit();
				} elseif ($chance > 10 AND $chance <= 30) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+5), crimetime='$next', $gun=($gun+2) WHERE id='$_COOKIE[id]' LIMIT 1;");
				$mysqli->query("DELETE FROM garage WHERE car='Hummer H3' AND percent='100' AND username='$username' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You and three others stormed in and took control of the store, then filled your bags with whatever you wanted. You gained $".number_format($payout)." and two $gun's.<br />
					  On the way out, one of the tires was shot out on your Hummer H3, and you were forced to ditch it!</div>";
				exit();
				}
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+5), crimetime='$next', $gun=($gun+2) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You and three others stormed in and took control of the store, then filled your bags with whatever you wanted. You gained $".number_format($payout)." and two $gun's.</div>";
				}
			}
		} elseif (isset($_POST['bank'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Barracks OL' AND percent='100' AND username='$username' LIMIT 5;");
			if ($row['saw'] < 15) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 15 M249 SAWs before you can do this crime!</div>";
			} elseif ($garage->num_rows < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 Barracks OLs with no damage before you can do this crime!</div>";
			} elseif ($row['armor'] < 100) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 100 Armor before you can do this crime!</div>";
			} elseif ($row['grenades'] < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 Grenades before you can do this crime!</div>";
			} else {
				$payout=rand(300000, 500000);
				$next=(time()+480);
				$chance=rand(1, 100);
				$success=rand(1, 100);
				if ($success > 0 AND $success <= 10) {
				$jail=1; $ex=7;
				} elseif ($chance > 10 AND $chance <= 20) {
				$mysqli->query("UPDATE Players SET exp=(exp+7), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> The bank vault was too difficult to cut through, and you were forced to leave with no cash!</div>";
				} else {
				if ($chance > 0 AND $chance < 10) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+7), crimetime='$next', health=(health-$chance) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team easily held the people in the bank down as you opened the safe and cleared it out. You gained $".number_format($payout).".<br />
					  The police were waiting outside of the building for you, and you lost $chance health during your escape!</div>";
				exit();
				} elseif ($chance > 10 AND $chance <= 30) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+7), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				$mysqli->query("DELETE FROM garage WHERE car='Barracks OL' AND percent='100' AND username='$username' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team easily held the people in the bank down as you opened the safe and cleared it out. You gained $".number_format($payout).".<br />
					  Before you could even leave the building, the police seized one of your Barracks OLs!</div>";
				exit();
				}
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+7), crimetime='$next', M4=(M4+1) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team easily held the people in the bank down as you opened the safe and cleared it out. You gained $".number_format($payout)." and an M4 Carbine Rifle.</div>";
				}
			}
		} elseif (isset($_POST['internationaldrug'])) {
			if ($row['saw'] < 10) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 10 M249 SAWs before you can do this crime!</div>";
			} elseif ($row['cargoplane'] < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have a Cargo Plane before you can do this crime!</div>";
			} elseif ($row['dmap'] < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have a Destination Map before you can do this crime!</div>";
			} elseif ($row['grenades'] < 2) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 2 Grenades before you can do this crime!</div>";
			} else {
				$payout=rand(800000, 1000000);
				$next=(time()+600);
				$chance=rand(1, 100);
				$success=rand(1, 100);
				$gun=rand(1, 2);
				if ($success > 0 AND $success <= 10) {
				$jail=1; $ex=10;
				} elseif ($success > 10 AND $success <= 20) {
				$mysqli->query("UPDATE Players SET exp=(exp+10), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> The police blocked the runway as the plane was about to take off, you were forced to flee the scene!</div>";
				} else {
				if ($chance > 0 AND $chance < 20) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+10), crimetime='$next', health=(health-$chance), cargoplane=(cargoplane-1), dmap=(dmap-1) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> The loaded plane landed and the drugs were successfully delivered. You gained $".number_format($payout).".<br />
					  One of your clients tried to shoot you and get his money back, but you were able to get away. You lost $chance health.</div>";
				exit();
				} elseif ($chance > 20 AND $chance <= 100) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+10), crimetime='$next', cargoplane=(cargoplane-1), dmap=(dmap-1) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> The loaded plane landed and the drugs were successfully delivered. You gained $".number_format($payout).".<br />
					  The police were waiting for you on your return, and seized your Cargo Plane! You were still able to escape!";
				if ($gun == 1) {
				$mysqli->query("UPDATE Players SET saw=(saw+1) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<br />You also acquired 1 M249 SAW.</div>";
				}
				}
				}
			}
		} elseif (isset($_POST['convoy'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Barracks OL' AND percent='100' AND username='$username' LIMIT 5;");
			$garage2=$mysqli->query("SELECT id FROM garage WHERE car='Tank' AND percent='100' AND username='$username' LIMIT 2;");
			if ($row['saw'] < 20) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 20 M249 SAWs before you can do this crime!</div>";
			} elseif ($garage->num_rows < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 Barracks OLs at 100% before you can do this crime!</div>";
			} elseif ($garage2->num_rows < 2) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 2 Tanks at 100% before you can do this crime!</div>";
			} elseif ($row['grenades'] < 10) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 10 Grenades before you can do this crime!</div>";
			} else {
				$payout=rand(2000000, 5000000);
				$next=(time()+900);
				$chance=rand(1, 100);
				$success=rand(1, 100);
				$gun=rand(1, 4);
				if ($success > 0 AND $success <= 10) {
				$jail=1; $ex=15;
				} elseif ($success > 10 AND $success <= 15) {
				$mysqli->query("UPDATE Players SET exp=(exp+15), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> The convoy lead you right into an ambush, and you were forced to flee empty handed!</div>";
				} else {
				if ($chance > 0 AND $chance <= 15) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+15), crimetime='$next', health=(health-$chance), saw=(saw+$gun) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your group quickly drove in and overtook the convoy. You gained $".number_format($payout)." and $gun M249 SAW(s).<br />
					  While driving away, the police showed up and got a few shots off at you. You lost $chance health.</div>";
				} elseif ($chance > 15 AND $chance <= 100) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+15), crimetime='$next', saw=(saw+$gun) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your group quickly drove in and overtook the convoy. You gained $".number_format($payout)." and $gun M249 SAW(s).<br /></div>";
				}
				}
			}
		} elseif (isset($_POST['assassinate'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Tank' AND percent='100' AND username='$username' LIMIT 1;");
			$kills=$mysqli->query("SELECT id FROM kills WHERE shooter='$username' LIMIT 5;");
			if ($row['barett'] < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 1 Barrett .50 Caliber before you can do this crime!</div>";
			exit();
			} elseif ($garage->num_rows < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 1 Tank at 100% before you can do this crime!</div>";
			} elseif ($kills->num_rows < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 previous kills before you can do this crime!</div>";
			} elseif ($row['hlocation'] < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have a hit location before you can do this crime!</div>";
			} else {
				$payout=rand(7000000, 10000000);
				$next=(time()+1200);
				$chance=rand(1, 100);
				$success=rand(1, 100);
				$gun=rand(1, 8);
				$gren=rand(2, 5);
				if ($success > 0 AND $success <= 5) {
				$jail=1; $ex=25;
				} elseif ($success > 5 AND $success <= 10) {
				$mysqli->query("UPDATE Players SET exp=(exp+25), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> You lined the target up in your scope, but his guards managed to stop you before you could shoot!</div>";
				} else {
				if ($chance > 0 AND $chance <= 15) {
				if ($gun <= 2) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+25), crimetime='$next', health=(health-$chance), grenades=(grenades+$gren) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You lined up the target in your scope, and made a clean shot. You gained $".number_format($payout)." and $gren Grenades.<br />
					  After taking the shot, the target's guards got a few shots off at you. You lost $chance health.</div>";
				} else {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+25), crimetime='$next', health=(health-$chance) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You lined up the target in your scope, and made a clean shot. You gained $".number_format($payout).".<br />
					  After taking the shot, the target's guards got a few shots off at you. You lost $chance health.</div>";
				}
				} elseif ($chance > 15 AND $chance <= 100) {
				if ($gun <= 2) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+25), crimetime='$next', grenades=(grenades+$gren) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div id=\"crimestext\" align=\"center\">You lined up the target in your scope, and made a clean shot. You gained $".number_format($payout)." and $gren Grenades.<br /></div>";
				} else {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+25), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You lined up the target in your scope, and made a clean shot. You gained $".number_format($payout).".<br /></div>";
				}
				}
				}
			}
		} elseif (isset($_POST['bulletfactory'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Tank' AND percent='100' AND username='$username' LIMIT 3;");
			$kills=$mysqli->query("SELECT id FROM kills WHERE shooter='$username' LIMIT 10;");
			if ($row['barett'] < 2) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 2 Barrett .50 Calibers before you can do this crime!</div>";
			exit();
			} elseif ($garage->num_rows < 3) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 3 Tanks at 100% before you can do this crime!</div>";
			} elseif ($kills->num_rows < 10) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 10 previous kills before you can do this crime!</div>";
			} elseif ($row['grenades'] < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 Grenades before you can do this crime!</div>";
			} else {
				$payout=rand(1000, 1500);
				$next=(time()+1800);
				$chance=rand(1, 100);
				$success=rand(1, 100);
				if ($success > 0 AND $success <= 5) {
				$jail=1; $ex=30;
				} elseif ($success > 5 AND $success <= 10) {
				$mysqli->query("UPDATE Players SET exp=(exp+30), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> The police were already waiting at the factory, and you were unable to enter.</div>";
				} else {
				if ($chance > 0 AND $chance <= 15) {
				$mysqli->query("UPDATE Players SET bullets=(bullets+$payout), exp=(exp+30), crimetime='$next', health=(health-$chance) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team easily broke into the factory, and were able to get away with ".number_format($payout)." bullets.<br />
					  On the way out, your gun misfired and shot you in the leg! You lost $chance health.</div>";
				} elseif ($chance > 15 AND $chance <= 100) {
				$mysqli->query("UPDATE Players SET bullets=(bullets+$payout), exp=(exp+30), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team easily broke into the factory, and were able to get away with ".number_format($payout)." bullets.<br /></div>";
				}
				}
			}
		} elseif (isset($_POST['robmint'])) {
			$garage=$mysqli->query("SELECT id FROM garage WHERE car='Tank' AND percent='100' AND username='$username' LIMIT 1;");
			if ($row['saw'] < 3) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 2 M249 SAWs before you can do this crime!</div>";
			} elseif ($garage->num_rows < 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 1 Tank at 100% before you can do this crime!</div>";
			} elseif ($row['donor'] != 1) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to be a Global Takeover VIP to do this crime!</div>";
			} elseif ($row['grenades'] < 5) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have 5 Grenades before you can do this crime!</div>";
			} else {
				$payout=rand(3000000, 6000000);
				$next=(time()+1800);
				$success=rand(1, 100);
				$tokens=rand(1,10);
				$bullets=rand(1,100);
				if ($success > 0 AND $success <= 5) {
				$jail=1; $ex=15;
				} elseif ($success > 5 AND $success <= 10) {
				$mysqli->query("UPDATE Players SET exp=(exp+15), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Failure</span> The mint was sealed from the inside, and you were unable to enter!</div>";
				} else {
				if ($tokens <= 1 AND $bullets <= 70) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+15), crimetime='$next', tokens=(tokens+1), bullets=(bullets+$bullets) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team painstakingly cut through the safe, and got away with $".number_format($payout).", 1 Token, and ".number_format($bullets)." bullets!</div>";
				} elseif ($tokens <= 1 AND $bullets > 70) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+15), crimetime='$next', tokens=(tokens+1) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team painstakingly cut through the safe, and got away with $".number_format($payout)." and 1 Token!</div>";
				} elseif ($tokens > 1 AND $bullets <= 70) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+15), crimetime='$next', bullets=(bullets+$bullets) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team painstakingly cut through the safe, and got away with $".number_format($payout)." and ".number_format($bullets)." bullets!</div>";
				} elseif ($tokens > 1 AND $bullets > 70) {
				$mysqli->query("UPDATE Players SET money=(money+$payout), exp=(exp+15), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your team painstakingly cut through the safe, and got away with $".number_format($payout)."!</div>";
				}
				}
			}
		} elseif (isset($_POST['destination'])) {
			$next=(time()+300);
			$mysqli->query("UPDATE Players SET exp=(exp+2), crimetime='$next', dmap=(dmap+1) WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You talked with your clients, and acquired a destination map.</div>";
		} elseif (isset($_POST['cargoplane'])) {
			if ($row['money'] < 150000) {
			echo "<div class=\"alert\"><span class=\"label label-warning\">Warning</span> You need to have $150,000 to buy a Cargo Plane!</div>";
			} else {
				$next=(time()+300);
				$mysqli->query("UPDATE Players SET exp=(exp+2), crimetime='$next', money=(money-150000), cargoplane=(cargoplane+1) WHERE id='$_COOKIE[id]' LIMIT 1;");
				echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You purchased a Cargo Plane for $150,000.</div>";
			}
		} elseif (isset($_POST['hlocation'])) {
			$next=(time()+360);
			$mysqli->query("UPDATE Players SET exp=(exp+4), crimetime='$next', hlocation=(hlocation+1) WHERE id='$_COOKIE[id]' LIMIT 1;");
			echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> You met up with your boss, and organized the location for your next target.</div>";
		}
		if ($jail == 1) {
			$mysqli->query("UPDATE Players SET exp=(exp+$ex), crimetime='$next' WHERE id='$_COOKIE[id]' LIMIT 1");
			$jtime=time()+($urank*20);
			$mysqli->query("INSERT INTO prison (username, location, time) VALUES ('$_COOKIE[id]', '$location', ($jtime))");
			echo "<div class=\"alert alert-error\"><span class=\"label label-important\">Busted!</span> The police were on the scene minutes after you attempted the crime. You were caught and placed in jail!</div>";
		}
		require_once("members/footer.php");
		exit();
	}
}
// END

if ($clicks < 25) {
echo ('
<form action="crimes.php" method="post">
<input type="hidden" name="submitted" value="TRUE">
<table class="table table-bordered table-striped">
<thead>
<tr><th>Description</th> <th>Requirements</th> <th>Action</th></tr>
</thead><tbody>');
if ($donor==1) {
echo '<tr><td><span class="label label-info">VIP</span> <strong>Rob National Mint</strong><br /> Payout: $3,000,000-$6,000,000<br /> Tokens (Chance): 30% <br /> Bullets (Chance): 70%<br /> Experience: +15<br /> Wait Time: 30 minutes</td> <td><b>Requires:</b><br />3 M249 SAWs<br /> 5 Grenades<br /> 1 Tank</td> <td align="center"><button type="submit" class="btn" name="robmint" value="Do Crime">Commit</button></td></tr>'; 
}
echo '<tr><td><b>Rob A Stranger</b><br /> Cash Payout: $500-$1,000<br /> Weapon (Chance): Luger (50%), .44 Caliber Magnum (20%)<br /> Experience: +1<br /> Wait Time: 1 minute</td> <td><b>Requires:</b><br />Nothing</td> <td align="center"><button type="submit" class="btn" name="stranger" value="Do Crime">Commit</button></td></tr>';
if ($urank > 1) {
echo '<tr><td><b>Break Into A House</b><br /> Cash Payout: $2,000-$8,000<br /> Weapon (Chance): .44 Caliber Magnum (60%), Mini-Uzi (40%)<br /> Experience: +2<br /> Wait Time: 2 minutes</td> <td><b>Requires:</b><br />Nothing</td> <td align="center"><button type="submit" class="btn" name="house" value="Do Crime">Commit</button></td></tr>'; 
}
if ($urank > 2) {
echo ('<tr><td><b>Burglarize a Gas Station</b><br /> Cash Payout: $10,000-$15,000<br /> Weapon (Chance): Steyr (40%) <br /> Experience: +3<br /> Wait Time: 3 minutes</td> <td><b>Requires:</b><br />1 Mini-Uzi<br /> 1 Buggy (100%)</td> <td align="center"><button type="submit" class="btn" name="gasstation" value="Do Crime">Commit</button></td></tr>');
}
if ($urank > 3) {
echo ('<tr><td><b>Deal Drugs</b><br /> Cash Payout: $30,000-$50,000<br /> Weapon (Chance): None <br /> Experience: +4<br /> Wait Time: 5 minutes</td> <td><b>Requires:</b><br />5 Steyrs<br /> 1 Range Rover (100%)</td> <td align="center"><button type="submit" class="btn" name="drugs" value="Do Crime">Commit</button></td></tr>');
}
if ($urank > 4) {
echo ('<tr><td><b>Burglarize a Jewelry Store</b><br /> Cash Payout: $80,000-$100,000<br /> Weapon (Chance): None <br /> Experience: +5<br /> Wait Time: 6 minutes</td> <td><b>Requires:</b><br />5 G36Cs<br /> 5 Hummer H3s (100%)</td> <td align="center"><button type="submit" class="btn" name="jewelry" value="Do Crime">Commit</button></td></tr>');
}
if ($urank > 5) {
echo ('<tr><td><b>Burglarize a Gun Shop</b><br /> Cash Payout: $15,000-$30,000<br /> Weapon (Chance): P90 (60%), G36C (40%) <br /> Experience: +5<br /> Wait Time: 6 minutes</td> <td><b>Requires:</b><br />1 Stinger<br /> 1 Hummer H3 (100%)</td> <td align="center"><button type="submit" class="btn" name="gunshop" value="Do Crime">Commit</button></td></tr>');
}
if ($urank > 6) { 
echo ('<tr><td><b>Rob A Bank</b><br /> Cash Payout: $300,000-$500,000<br /> Weapon (Chance): M4 Carbine Rifle (100%) <br /> Experience: +7<br /> Wait Time: 8 minutes</td> <td><b>Requires:</b><br />15 M249 SAWs<br /> 5 Grenades<br /> 5 Barracks OLs (100%)<br /> 100 Armor</td> <td align="center"><button type="submit" class="btn" name="bank" value="Do Crime">Commit</button></td></tr>');
}
if ($urank > 7) {
echo ('<tr><td><b>International Drug Smuggling</b><br /> Cash Payout: $800,000-$1,000,000<br /> Weapon (Chance): M249 SAW (50%) <br /> Experience: +10<br /> Wait Time: 10 minutes</td> <td><b>Requires:</b><br />10 M249 SAWs<br /> 2 Grenades<br /> 1 Cargo Plane<br /> 1 Destination Map</td> <td align="center"><button type="submit" class="btn" name="internationaldrug" value="Do Crime">Commit</button></td></tr>');
}
if ($urank >= 10) {
echo ('<tr><td><b>Intercept Army Convoy</b><br /> Cash Payout: $2,000,000-$5,000,000<br /> Weapon (Chance): Multiple M249 SAWs (100%) <br /> Experience: +15<br /> Wait Time: 15 minutes</td> <td><b>Requires:</b><br />20 M249 SAWs<br /> 10 Grenades<br /> 2 Tanks<br /> 5 Barracks OLs</td> <td align="center"><button type="submit" class="btn" name="convoy" value="Do Crime">Commit</button></td></tr>');
}
if ($urank >= 13) {
echo ('<tr><td><b>Assassinate Paid Target</b><br /> Cash Payout: $7,000,000-$10,000,000<br /> Weapon (Chance): Multiple Grenades (40%) <br /> Experience: +25<br /> Wait Time: 20 minutes</td> <td><b>Requires:</b><br />1 Barrett .50 Caliber<br /> 1 Tanks<br /> 5 Kills<br /> 1 Hit Location</td> <td align="center"><button type="submit" class="btn" name="assassinate" value="Do Crime">Commit</button></td></tr>');
}
if ($urank >= 16) {
echo ('<tr><td><b>Rob Bullet Factory</b><br /> Bullet Payout: 1,000-1,500<br /> Weapon (Chance): None <br /> Experience: +30<br /> Wait Time: 30 minutes</td> <td><b>Requires:</b><br />2 Barrett .50 Calibers<br /> 5 Grenades<br /> 3 Tanks<br /> 10 Kills</td> <td align="center"><button type="submit" class="btn" name="bulletfactory" value="Do Crime">Commit</button></td></tr></table>');
}
if ($urank < 7) {
	echo '</tbody></table></form>';
}
if ($urank > 7) {
echo('
<div class="page-header">
	<h1>Crime Preparation <small>Hard to Do Something You\'re Not Ready For.</small></h1>
</div>
<table class="table table-striped table-bordered">
<thead>
<tr><th>Prep Description</th> <th>Action</th></tr>
</thead><tbody>
<tr><td><b>Acquire Destination Map</b> (You have'); echo " $dmaps)"; echo('<br /> Experience: +2<br /> Wait Time: 5 minutes</td> <td align="center"><button type="submit" class="btn" name="destination" value="Aquire Map">Aquire Map</button></td></tr>
<tr><td><b>Purchase Cargo Plane</b> (You have'); echo " $cargo)"; echo('<br /> Cost: $150,000<br /> Experience: +2<br /> Wait Time: 5 minutes</td> <td align="center"><button type="submit" class="btn" name="cargoplane" value="Purchase Plane">Purchase Plane</button></td></tr>'); 
}
if ($urank > 7 AND $urank <= 13) {
	echo '</tbody></table></form>';
}
if ($urank > 13) {
echo '<tr><td><b>Acquire Hit Location</b> (You have'; echo " $hlocations)"; echo'<br /> Experience: +4<br /> Wait Time: 6 minutes</td> <td align="center"><button type="submit" class="btn" name="hlocation" value="Acquire Hit Location">Acquire Hit Location</button></td></tr></tbody></table></form>';
}
if ($urank < 13) {
	echo "<div class=\"alert alert-info\"><span class=\"label label-info\">Info</span> Keep ranking up to unlock more crimes!</div>";
}
require_once("members/footer.php");
} else {
session_start();
if( isset($_POST['submit'])) {
   if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
		$mysqli->query("UPDATE Players SET clicks = '0' WHERE id ='$_COOKIE[id]' LIMIT 1");
		$url .= 'crimes.php';
		header("Location: $url");
		exit();
		unset($_SESSION['security_code']);
   } else {
		echo '<div id="crimestext"><center>The verification code that you typed was incorrect.<br /><a href="crimes.php">Try again.</a></center></div>';
		require_once("members/footer.php");
   }
} else {
?>
<div id="ltable"><center>
<h1>Script Check</h1>
<form action="crimes.php" method="post">
    <img src="members/CaptchaSecurityImages.php?width=100&height=40&characters=3" /><br />
	<label for="security_code">Enter the code: </label><input id="security_code" name="security_code" type="text" size="3" maxlength="3" /><br />
    <input type="submit" name="submit" value="Submit" />
</form>
</center></div>
<?
require_once("members/footer.php");
}}
?>