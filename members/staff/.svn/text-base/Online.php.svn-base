<?
$o = 300; //How long is considered online?
$current = time(); //gets the time on the server (unformatted)
$offline = ($current-$o);

$sql = mysql_query("SELECT appearo FROM Players WHERE id='{$_COOKIE['id']}'");
	$row = mysql_fetch_array ($sql);
	$appear = $row[0];
	
if (isset($_COOKIE['id']) AND $appear != 1)
{
$update = mysql_query("UPDATE Players SET online = '$current' WHERE id = '{$_COOKIE['id']}'");
//the above line sets the time the user was online to the current time
}

$offline = (time()-300);
	
	$sql = mysql_query("SELECT SUM( count ) AS tonline FROM Players WHERE online >= '$offline'");
	$row = mysql_fetch_array ($sql);
	$tonline = $row[0];
	
	$sql = mysql_query("SELECT record, date FROM orecord WHERE id = '1'");
	$row = mysql_fetch_array ($sql);
	$monline = $row[0];
	$mdate = $row[1];
	
	$date = (date("M d Y h:i:s A"));
	
	if ($tonline > $monline) {
	$sql = mysql_query("UPDATE orecord SET record = '$tonline', date = '$date'");
	}
?> 