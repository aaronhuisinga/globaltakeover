<?php 
session_start(); 
include "config.php";
checks();

$userlevl = mysql_query("SELECT Level FROM Players WHERE id='{$_COOKIE['id']}'");
while($successa = mysql_fetch_row($userlevl)){
	$userlevel = $successa[0];
	
}
if ($userlevel < 2){

echo "You do not have sufficient permissions to access this page.";

}elseif ($userlevel == 2){


?>

<html>
<center>
<div id="usertable">
<table width=50%><tr>
<td colspan="5" align="center" class="top"><b>User IP List</b></td></tr>
<div>
<td align=center width=33%>Username</td>
<td align=center width=33%>Registration IP</td>
<td align=center width=33%>Last online</td>
<td align=center width=33%>Last IP</td>
<td align=center width=33%>Ban</td>
</tr>	
<?
$test = mysql_query("SELECT * FROM Players WHERE dead='0' AND banned='0' AND active is NULL ORDER BY lastip DESC");
while($fetch = mysql_fetch_object($test)) {
$lol = mysql_query("SELECT * FROM Players WHERE lastip = '$fetch->lastip'");
$rows = mysql_num_rows($lol);

if ($rows > 2) {
$fetch1 = mysql_fetch_object($lol);
$lonline = date('Y-m-d h:i:s',$fetch->Online);
echo "<tr><td><b><a href=\"profile.php?id=$fetch1->id\">$fetch1->username</a></b></td> <td>$fetch1->r_ip</td><td>$lonline</td><td>$fetch1->lastip</td> <td><a href='ban.php?id=$fetch1->id'>Ban</a></td></tr>";
} else {
}
}
exit();
}
?>