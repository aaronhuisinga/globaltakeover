<?php
include ("config.php");

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
		if (!empty($_POST['t'])) {

			$b = intval(strip_tags(abs($_POST['t'])));
	
	if (!preg_match("/[0-9]/",$b)) {
		echo("<div id=\"crimestext\"><center>Please enter a real number!<br /><a href=\"Wto.php\">Go back.</a></center></div>");
		exit();
	}
		if ($b > 0) {
			if (isset($_REQUEST['submit'])) {
				$query = "SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}'";
				$result = @mysql_query ($query);
				$row = mysql_fetch_array ($result);
					$u = $row[0];
					$pb = $row[1];
					$npb = $pb - $b;
					if ($pb >= $b) {
				$query = "UPDATE Players SET money='$npb' WHERE id='{$_COOKIE['id']}'";
				$result = @mysql_query ($query);
				
				$query = "SELECT location, Till FROM WT WHERE owner='$u' LIMIT 1";
				$result = @mysql_query ($query);
				$row = mysql_fetch_array ($result);
					$l = $row[0];
					$bb = $row[1];
			 		$nbb = $bb + $b;	
				
				$query = "UPDATE WT SET Till='$nbb' WHERE location='$l'";
				$result = @mysql_query ($query);
				$current = time();
				$date = (date("M d Y h:i:s A"));
				mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$b', '$date', '$u', 'Loss', '$current', 'WT Till Deposit')");
				echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>$".number_format($b)." was added to the till!<br />
<a href=\"Wto.php\">Go back.</a></center></div>
</body></html>");
				mysql_close();
				exit();
				} else {
					echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>Please enter an amount of money you actually have!<br />
<a href=\"Wto.php\">Go back.</a></center></div>
</body></html>");
				mysql_close();
				exit();
				}
			} elseif (isset($_REQUEST['submit2'])) {
				$query = "SELECT username, money FROM Players WHERE id='{$_COOKIE['id']}'";
				$result = @mysql_query ($query);
				$row = mysql_fetch_array ($result);
					$u = $row[0];
					$pb = $row[1];
					$npb = $pb + $b;
				
				
				$query = "SELECT location, Till FROM WT WHERE owner='$u' LIMIT 1";
				$result = @mysql_query ($query);
				$row = mysql_fetch_array ($result);
					$l = $row[0];
					$bb = $row[1];
			 		$nbb = $bb - $b;	
				if ($bb > $b) {
				$query = "UPDATE Players SET money='$npb' WHERE id='{$_COOKIE['id']}'";
				$result = @mysql_query ($query);
				$query = "UPDATE WT SET Till='$nbb' WHERE location='$l'";
				$result = @mysql_query ($query);
				$current = time();
				$date = (date("M d Y h:i:s A"));
				mysql_query("INSERT INTO Playermoney (amount, date, username, outcome, btime, used) VALUES ('$b', '$date', '$u', 'Gain', '$current', 'WT Till Withdrawl')");
				echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>$".number_format($b)." was taken from the till!<br />
<a href=\"Wto.php\">Go back.</a></center></div>
</body></html>");
				mysql_close();
				exit();
				} else {
				echo("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>Please enter an amount of money that is actually in the till!<br />
<a href=\"Wto.php\">Go back.</a></center></div>
</body></html>");
				mysql_close();
				exit();
				}
			}
			
		} else {
		
			echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>Please enter a valid amount of money!<br />
<a href=\"Wto.php\">Go back.</a></center></div>
</body></html>");
			mysql_close();
			exit();
		}
		} else {
		
			echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div id=\"crimestext\"><center>Please enter an amount of money!<br />
<a href=\"Wto.php\">Go back.</a></center></div>
</body></html>");
			mysql_close();
			exit();
		}