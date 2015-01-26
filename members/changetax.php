<?php
$title="Bank Management > Change Tax";
include("config.php");
include("header.php"); 

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];

echo("<div id=\"crimestext\" align=\"center\">");

		$result=mysql_query("SELECT id, taxp FROM Bank WHERE owner='$u' LIMIT 1;");
		$row=mysql_fetch_array($result);
		$tax = $row[1];
				
		if (mysql_num_rows($result) >= 1) {
		if (isset($_REQUEST['submit'])) {	
		$dd = $_POST['select'];
		
		if ($dd == 'one'){
		mysql_query("UPDATE Bank SET taxp='.01' WHERE owner='$u' LIMIT 1;");
		echo ("The tax percentage was changed to 1%! <br /> <a href=\"banko.php\">Go back.</a></div>");
		include("footer.php");
		} elseif ($dd == 'two') {
		mysql_query("UPDATE Bank SET taxp='.02' WHERE owner='$u' LIMIT 1;");
		echo ("The tax percentage was changed to 2%! <br /> <a href=\"banko.php\">Go back.</a></div>");
		include("footer.php");
		} elseif ($dd == 'three') {
		mysql_query("UPDATE Bank SET taxp='.03' WHERE owner='$u' LIMIT 1;");
		echo ("The tax percentage was changed to 3%! <br /> <a href=\"banko.php\">Go back.</a></div>");
		include("footer.php");
		} elseif ($dd == 'four') {
		mysql_query("UPDATE Bank SET taxp='.04' WHERE owner='$u' LIMIT 1;");
		echo ("The tax percentage was changed to 4%! <br /> <a href=\"banko.php\">Go back.</a></div>");
		include("footer.php");
		} elseif ($dd == 'five') {
		mysql_query("UPDATE Bank SET taxp='.05' WHERE owner='$u' LIMIT 1;");
		echo ("The tax percentage was changed to 5%! <br /> <a href=\"banko.php\">Go back.</a></div>");
		include("footer.php");
		} elseif ($dd == 'six') {
		mysql_query("UPDATE Bank SET taxp='.06' WHERE owner='$u' LIMIT 1;");
		echo ("The tax percentage was changed to 6%! <br /> <a href=\"banko.php\">Go back.</a></div>");
		} elseif ($dd == 'seven') {
		mysql_query("UPDATE Bank SET taxp='.07' WHERE owner='$u' LIMIT 1;");
		echo ("The tax percentage was changed to 7%! <br /> <a href=\"banko.php\">Go back.</a></div>");
		include("footer.php");
		}
		}
	    } else {
		echo ("You do not own a bank! Come back when you do!</div>");
		include("footer.php");
		}
?>