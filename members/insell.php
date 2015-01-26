<?php
$title="Inventory";
include("config.php");
include("header.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT location, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$location = $row[0];
$u = $row[1];

if ($_REQUEST['Submit']) {
$submitted = $_REQUEST['Submit'];

		$j = abs($_POST['luger']);
		$b = abs($_POST['cal']);
		$r = abs($_POST['uzi']);
		$l = abs($_POST['steyr']);
		$a = abs($_POST['DE']);
		$hl = abs($_POST['P90']);
		$p = abs($_POST['G36C']);
		$bo = abs($_POST['RPD']);
		$t = abs($_POST['AK']);
		$h = abs($_POST['M4']);
		$y = abs($_POST['stinger']);
		$m = abs($_POST['SAW']);
		$e = abs($_POST['Barett']);
		$g = abs($_POST['grenade']);
		$ban = abs($_POST['Bandage']);
		$mor = abs($_POST['Morpene']);
		$kni = abs($_POST['knife']);
		$skit = abs($_POST['skit']);
		$lkit = abs($_POST['lkit']);
		
		if (($j >= 1 OR $j == NULL) AND ($b >= 1 OR $b == NULL) AND ($r >= 1 OR $r == NULL) AND ($l >= 1 OR $l == NULL) AND ($a >= 1 OR $a == NULL) AND ($hl >= 1 OR $hl == NULL) AND ($p >= 1 OR $p == NULL) AND ($bo >= 1 OR $bo == NULL) AND ($t >= 1 OR $t == NULL) AND ($h >= 1 OR $h == NULL) AND ($y >= 1 OR $y == NULL) AND ($m >= 1 OR $m == NULL) AND ($e >= 1 OR $e == NULL) AND ($g >= 1 OR $g == NULL) AND ($ban >= 1 OR $ban == NULL) AND ($mor >= 1 OR $mor  == NULL) AND ($kni >= 1 OR $kni == NULL) AND ($skit >= 1 OR $skit == NULL) AND ($lkit >= 1 OR $lkit == NULL)) {
		
		$row=mysql_fetch_array(mysql_query("SELECT luger, magnum, uzi, steyr, desert_eagle, p90, g36c, rpd, AK47, M4, stinger, saw, barett, grenades, bandage, morphene, skit, knife, lkit, money FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
		$nj = $row[0];
		$nb = $row[1];
		$nr = $row[2];
		$nl = $row[3];
		$na = $row[4];
		$nhl = $row[5];
		$np = $row[6];
		$nbo = $row[7];
		$nt = $row[8];
		$nh = $row[9];
		$ny = $row[10];
		$nm = $row[11];
		$ne = $row[12];
		$ng = $row[13];
		$nban = $row[14];
		$nmor = $row[15];
		$nskit = $row[16];
		$nkni = $row[17];
		$nlkit = $row[18]; 
		$money = $row[19];
		 
		if ($j <= $nj AND $b <= $nb AND $r <= $nr AND $l <= $nl AND $a <= $na AND $hl <= $nhl AND $p <= $np AND $bo <= $nbo AND $t <= $nt AND $h <= $nh AND $y <= $ny AND $m <= $nm AND $e <= $ne AND $g <= $ng AND $ban <= $nban AND $mor <= $nmor AND $kni <= $nkni AND $skit <= $nskit AND $lkit <= $nlkit) {

		$mj = $j * 2500;
		$mb = $b * 3000;
		$mr = $r * 5000;
		$ml = $l * 25000;
		$ma = $a * 55000;
		$mhl = $hl * 75000;
		$mp = $p * 150000;
		$mbo = $bo * 250000;
		$mt = $t * 350000;
		$mh = $h * 400000;
		$my = $y * 500000;
		$mm = $m * 750000;
		$me = $e * 1500000;
		$mg = $g * 25000;
		$mban = $ban * 100;
		$mmor = $mor * 5000;
		$mkni = $kni * 5000;
		$mskit = $skit * 15000;
		$mlkit = $lkit * 20000;
		$tm = $mj + $mb + $mr + $ml + $ma + $mhl + $mp + $mbo + $mt + $mh + $my + $mm + $me + $mg + $mban + $mmor + $mkni + $mskit + $mlkit;
		$current = time();
		echo "<div id=\"crimestext\"><center>You sold all weapons for $".number_format($tm)."<br /><a href=\"inventory.php\">Go back.</a></center></div>";
		include("footer.php");
		$nmoney = $tm + $money; 
		mysql_query("UPDATE Players SET money = '$nmoney' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		$mj = $nj - $j;
		$mb = $nb - $b;
		$mr = $nr - $r;
		$ml = $nl - $l;
		$ma = $na - $a;
		$mhl = $nhl - $hl;
		$mp = $np - $p;
		$mbo = $nbo - $bo;
		$mt = $nt - $t;
		$mh = $nh - $h;
		$my = $ny - $y;
		$mm = $nm - $m;
		$me = $ne - $e;
		$mg = $ng - $g;
		$mban = $nban - $ban;
		$mmor = $nmor - $mor;
		$mkni = $nkni - $kni;
		$mskit = $nskit - $skit;
		$mlkit = $nlkit - $lkit;
		mysql_query("UPDATE Players SET luger='$mj', magnum='$mb', uzi='$mr', steyr='$ml', desert_eagle='$ma', p90='$mhl', g36c='$mp', rpd='$mbo', AK47='$mt', M4='$mh', stinger='$my', saw='$mm', barett='$me', grenades='$mg', bandage='$mban', morphene='$mmor', skit='$mskit', knife='$mkni', lkit='$mlkit' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
		exit();
		} else {
		echo ("<div id=\"crimestext\"><center>Please enter amounts that you actually have.<br /><a href=\"inventory.php\">Go back.</a></center></div>");
		include("footer.php");
		}
		} else {
			echo("<div id=\"crimestext\"><center>Please enter amounts that you actually have.<br /><a href=\"inventory.php\">Go back.</a></center></div>");
			include("footer.php");
			exit();
}
}
?>