<?php
oB_start(); 
// allows you to use cookies. 
require_once("config.php");  

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

$info = mysql_query("SELECT * FROM Players WHERE id='{$_COOKIE['id']}'") or die(mysql_error()); 
$data = mysql_fetch_array($info);
$reason = $data['banreason'];

if($data['banned'] == 1) {
	echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>You have been banned!<br />
If you have any questions, please contact a staff member.<br /><br />
<b>Reason:</b> $reason</center></div>
</body></html>");

mysql_close();
exit();
	 
}
?>