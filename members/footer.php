<?php
if (isset($_COOKIE['id']) AND isset($_COOKIE['username'])) {
require_once('config.php');

$stmt=$pdo->prepare('SELECT Level, exp, rank, Airtravel FROM Players WHERE id= :id LIMIT 1');
$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_NUM);
$lvl = $row[0]; $exp = $row[1]; $rank = $row[2]; $travel = $row[3];

if (isset($_COOKIE['id'])) {
// Crimes
$stmt=$pdo->prepare('SELECT crimetime, haatime, savtime, gtatime, ortime, notes FROM Players WHERE id= :id LIMIT 1');
$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_NUM);
$ctl = $row[0] - time();
$notepad=$row[5];
if ($ctl > 60) {
$ctl=floor($ctl/60);
$ct="$ctl Minutes";
} else {
$ct = "$ctl Seconds";
}
$atl = $travel - time();
$ml = floor($atl/60);
if ($atl > 89) {
$at = "$ml Minutes Left";
} elseif ($atl < 90) {
$at = "$atl Seconds Left";
}
// Hijack
$htl = $row[1]-time();
$ht = "$htl Seconds";
// Pirate
$stl = $row[2]-time();
$st = "$stl Seconds";
// GTA
$vtl = $row[3]-time();
$vt = "$vtl Seconds";
// Heist
$ORsd = $row[4]-time();
if ($ORsd > 60 AND $ORsd < 3600) {
$tml= floor(($ORsd/60)+1);
$ort="$tml Minutes Left";
} elseif ($ORsd > 3600) {
$tml = floor((($ORsd/60)/60)+1);
$ort="$tml Hours Left";
}
// Prison
$stmt=$pdo->prepare('SELECT time FROM prison WHERE username= :id ORDER BY time DESC LIMIT 1');
$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_NUM);
$pl=$row[0] - time();
if ($pl > 0) { $ptl = "$pl Seconds"; } else { $ptl = "Free"; }
if ($pl > 0) { $prt = "$pl Seconds"; } else { $prt = "Free"; }
if ($ctl <= 0) { $ct = "Now"; }
if ($atl <= 0) { $at = "Now"; }
if ($htl <= 0) { $ht = "Now"; }
if ($stl <= 0) { $st = "Now"; }
if ($vtl <= 0) { $vt = "Now"; }
if ($ORsd <= 0) { $ort = "Now"; }

// Mini Notepad Modal
echo "
<div class=\"modal hide\" id=\"notepad\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"notepadLabel\" aria-hidden=\"true\">
<div class=\"modal-header\">
  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">x</button>
  <h3 id=\"notepadLabel\">Notepad</h3>
</div>
<div class=\"modal-body\">
  <label for=\"area1\">Notepad</label>
  <textarea rows=\"20\" id=\"area1\" name=\"notepadText\" class=\"span12\">$notepad</textarea>
</div>
<div class=\"modal-footer\">
  <a id=\"updateNotes\" class=\"btn btn-success\" href=\"#\"><i class=\"icon-ok icon-white\"></i> Submit</a>
  <button class=\"btn btn-warning\" data-dismiss=\"modal\" aria-hidden=\"true\">Cancel</button>
</div>
</div>
</div>";
?>

<div class="navbar navbar-fixed-bottom navbar-inverse" id="gfooter">
  <div class="navbar-inner">
    <div class="container-fluid">
    	<div id="bbar">
       <ul class="nav">
				<?
				echo "
				<li><a href=\"#\"><i class=\"icon-refresh icon-white\" onclick=\"reload_bbar()\"></i></a></li>
				<li><a href=\"#\">Time <span class=\"label\">$date</span> </a></li>
				<li><a href=\"#\">Crime <span class=\"label\">$ct</span> </a></li>
				<li><a href=\"#\">GTA <span class=\"label\">$vt</span> </a></li>
				<li><a href=\"#\">Hijack <span class=\"label\">$ht</span> </a></li>
				<li><a href=\"#\">Pirate <span class=\"label\">$st</span> </a></li>
				<li><a href=\"#\">Jail <span class=\"label\">$prt</span> </a></li>
				<li><a href=\"#\">Travel <span class=\"label\">$at</span> </a></li>
				<li><a href=\"#\">Heist <span class=\"label\">$ort</span> </a></li>
				<li><a href=\"#notepad\" class=\"notepad\" data-toggle=\"modal\"> Notepad</a></li>
			  </ul>";
				}
				?>
		  </div>
	  </div>
  </div>
</div>
<? } ?>