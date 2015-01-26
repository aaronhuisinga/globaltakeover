<?
//--------------- GTO STAFF CONFIG v1.0 ---------------//
   ob_start(); // allows you to use cookies
   mysql_connect("globaltakeover.db.7028433.hostedresource.com","globaltakeover","D7Awthkp2946");
	mysql_select_db(globaltakeover) or die(mysql_error());
   $logged = MYSQL_QUERY("SELECT * from Players WHERE id='$_COOKIE[id]'");
   $logged = mysql_fetch_array($logged);
   function escape_data($data) {
	if (ini_get('magic_quotes_gpc')){
		$data = stripslashes($data);
	}
	return $data;
}
// Define error output and log
	ini_set('error_reporting', E_ALL ^ E_NOTICE);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', '/home/content/33/7028433/html/error_log');
    
// Define game information
	$version="Global Takeover BETA";
	
// Check to make sure that player is logged in, alive, and not banned
function checks() {
	$result = mysql_query("SELECT username, banned, banreason, dead, health FROM Players WHERE id='{$_COOKIE['id']}'");
	$row = mysql_fetch_array ($result);
	// Check login
	if (!isset($_COOKIE['id'])) {
		header("Location: /login.php");
		exit();
	}
	// Check health
	if ($row['health'] == 0 OR $row['dead'] > 0) {
		header("Location: /dead.php");
		exit();
	}
	// Check ban status
	$reason = $row['banreason'];
	if($row['banned'] == 1) {
		echo("<div id=\"crimestext\"><center>You have been banned!<br />If you have any questions, please contact a staff member.<br /><br /><b>Reason:</b> $reason</center></div>");
		exit();	 
	}
}
// Update online time and check for appearing offline
function online() {
	$o = 300; //How long is considered online?
	$current = time(); //gets the time on the server (unformatted)
	$offline = ($current-$o);
	$sql = mysql_query("SELECT appearo FROM Players WHERE id='{$_COOKIE['id']}'");
	$row = mysql_fetch_array ($sql);
	$appear = $row[0];
	if (isset($_COOKIE['id']) AND $appear != 1) {
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
}
$result = mysql_query("SELECT theme FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);

// Check theme
$theme = ($row['theme']!="") ? $row['theme'] : "style"; 

$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/themes/$theme.css\" />";
echo $css;

// Define standard date and time
$date = (date("M d Y h:i:s A"));
$current = time();
?> 