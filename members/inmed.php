<?php
$title="Inventory";
include("config.php");
include("header.php"); 
checks();
online();

if ($_REQUEST['Submit']) {
$submitted = $_REQUEST['Submit'];
		$ban = $_POST['Bandage'];
		$mor = $_POST['Morpene'];
		$kni = $_POST['knife'];
		$skit = $_POST['skit'];
		$lkit = $_POST['lkit'];
		
		if (($ban >= 1 OR $ban == NULL) AND ($mor >= 1 OR $mor  == NULL) AND ($kni >= 1 OR $kni == NULL) AND ($skit >= 1 OR $skit == NULL) AND ($lkit >= 1 OR $lkit == NULL)) {
		
		$row=mysql_fetch_array(mysql_query("SELECT bandage, morphene, skit, knife, lkit, health FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
		$nban = $row[0];
		$nmor = $row[1];
		$nskit = $row[2];
		$nkni = $row[3];
		$nlkit = $row[4]; 
		$health = $row[5];
		 
		if ($ban <= $nban AND $mor <= $nmor AND $kni <= $nkni AND $skit <= $nskit AND $lkit <= $nlkit) {
		$knifeh = rand(5, 15);
		$mban = $ban * 1;
		$mmor = $mor * 5;
		$mkni = $kni * $knifeh;
		$mskit = $skit * 10;
		$mlkit = $lkit * 20;
		$tm = $mban + $mmor + $mkni + $mskit + $mlkit;
		if ($health == 100) {
		echo "<div id=\"crimestext\"><center>You're already have full health!<br /><a href=\"inventory.php\">Go back.</a></center></div>";
		include("footer.php");
		exit();
		}
		echo "<div id=\"crimestext\"><center>You manged to patch yourself up, healing $tm health!<br /><a href=\"inventory.php\">Go back.</a></center></div>";
		include("footer.php");
		$nmoney = $tm + $health; 
		if ($nmoney > 99) {
		$nmoney = 100;
		}
		$sql = mysql_query("UPDATE Players SET health = '$nmoney' WHERE id='{$_COOKIE['id']}'");
		$mban = $nban - $ban;
		$mmor = $nmor - $mor;
		$mkni = $nkni - $kni;
		$mskit = $nskit - $skit;
		$mlkit = $nlkit - $lkit;
		$query = mysql_query("UPDATE Players SET bandage='$mban', morphene='$mmor', skit='$mskit', knife='$mkni', lkit='$mlkit' WHERE id='{$_COOKIE['id']}'") ;
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