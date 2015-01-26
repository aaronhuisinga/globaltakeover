<?php
include("config.php");
checks();
online(); 

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];

echo("<div id=\"crimestext\" align=\"center\">");
		$result = mysql_query("SELECT markup, location FROM port WHERE owner='$u' LIMIT 1;");
		$row = mysql_fetch_array($result);
		$tax = $row[0];
		$loc=$row[1];
		$title="$loc Port > Manage Markup";
		include("header.php");
				
		if (mysql_num_rows($result) >= 1) {
		if (isset($_REQUEST['submit'])) {	
		$dd = $_POST['select'];
		if ($dd == 'one'){
		$one = .10;
		mysql_query("UPDATE port SET markup='$one' WHERE owner='$u' LIMIT 1;");
		echo ("The price markup was changed to 10%! <br /> <a href=\"porto.php\">Go back.</a></div>");
		include("footer.php");
		} elseif ($dd == 'two') {
		$two = .20;
		mysql_query("UPDATE port SET markup='$two' WHERE owner='$u' LIMIT 1;");
		echo ("The price markup was changed to 20%! <br /> <a href=\"porto.php\">Go back.</a></div>");
		include("footer.php");
		} elseif ($dd == 'three') {
		$three = .30;
		mysql_query("UPDATE port SET markup='$three' WHERE owner='$u' LIMIT 1;");
		echo ("The price markup was changed to 30%! <br /> <a href=\"porto.php\">Go back.</a></div>");
		include("footer.php");
		} elseif ($dd == 'four') {
		$four = .40;
		mysql_query("UPDATE port SET markup='$four' WHERE owner='$u' LIMIT 1;");
		echo ("The price markup was changed to 40%! <br /> <a href=\"porto.php\">Go back.</a></div>");
		include("footer.php");
		} else {
		echo ("There was an error! Please go back and try again! <br /> <a href=\"porto.php\">Go back.</a></div>");
		include("footer.php");
		}
		} else {
		echo ("There was an error! Please go back and try again! <br /> <a href=\"porto.php\">Go back.</a></div>");
		include("footer.php");
		}
	    } else {
		echo ("You do not own a port! Come back when you do! <br /> <a href=\"porto.php\">Go back.</a></div>");
		include("footer.php");
		}
?>