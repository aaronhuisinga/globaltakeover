<?php 
session_start(); 
include "config.php";
include_once"Online.php";

$query = "SELECT theme FROM Players WHERE id='{$_COOKIE['id']}'";
$result = @mysql_query ($query);
$row = mysql_fetch_array ($result);

$theme = $row[0];

if ($theme != NULL) {

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />");

} else {
$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />";
echo ("<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/style.css\" />");

$theme = 'style';
}

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
$test = mysql_query("SELECT * FROM Players WHERE dead='0' AND banned='0' and Level='0' ORDER BY lastip DESC");
while($fetch = mysql_fetch_object($test)) {

$lol = mysql_query("SELECT * FROM Players WHERE lastip = '$fetch->lastip'");
$rows = mysql_num_rows($lol);

?>


<? 

$lonline = date('Y-m-d h:i:s',$fetch->Online);

if($rows > 1) {

echo "<tr><td><b><a href=\"profile.php?id=$fetch->id\">$fetch->username</a></b></td> <td>$fetch->r_ip</td><td>$lonline</td><td>$fetch->lastip</td> <td><a href='ban.php?id=$fetch->id'>Ban</a></td></tr>";
}else{

echo "<tr><td><b><a href=\"profile.php?id=$fetch->id\">$fetch->username</a></b></td> <td>$fetch->r_ip</td><td>$lonline</td><td>$fetch->lastip</td> <td><a href='ban.php?id=$fetch->id'>Ban</a></td></tr>";
}

}
}
?>
