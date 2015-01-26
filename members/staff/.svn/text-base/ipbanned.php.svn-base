<?php
oB_start(); 

$result = mysql_query("SELECT theme, r_ip, lastip FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);

$r_ip = $row[1];
$lastip=$row[2];

$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

$query = mysql_query("SELECT * FROM ipban");
while($row=mysql_fetch_array($query)) {
$bip = $row['ip'];
$reason = $row['Reason'];
if ($r_ip == $bip OR $lastip == $bip) {
$bdate = time();

echo("<div id=\"crimestext\"><center>You have been banned! <br /> If you have any questions, please contact a staff member.<br /><br />
<b>Reason:</b> $reason</center></div>");
mysql_close();
exit();
}

}
?>