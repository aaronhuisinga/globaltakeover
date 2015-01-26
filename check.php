<?
include_once("members/config.php");
$username = $_POST['username']; // get the username
$username = trim(htmlentities($username)); // strip some crap out of it

	$result = mysql_query("SELECT id FROM Players WHERE username='$username'");
		$get = mysql_num_rows($result);
		if (mysql_num_rows($result) > 0) {
			echo '<span style="color:#f00">Username Unavailable</span>';
		} else {
			echo '<span style="color:#0c0">Username Available</span> <script language="javascript">submit.disabled=false;</script>';
		}
?>
