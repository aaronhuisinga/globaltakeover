<?php
include("config.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT username, corps FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$c = addslashes($row[1]); $ecorp=$row[1];
$title="$ecorp > Corp Meeting Management";
include("header.php");

$row=mysql_fetch_array(mysql_query("SELECT owner, co FROM Corps WHERE name='$c' LIMIT 1;"));
$o = $row[0];
$co = $row[1];
				
if ($u == $o) {
			
			echo '<div id="ltable" align="center"><h2>Corp Meeting Management</h2><br />';
			
			echo("<form method=\"post\" action=\"promotescm.php\">
 			 <h1>Promote</h1>
  			  <p>Username <input type=\"text\" name=\"uname\" /></p>
			<input type=\"submit\" name=\"submit\" value=\"Promote!\" />
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></p>
			</form><br />
			<form method=\"post\" action=\"demotescm.php\">
 			 <h1>Demote</h1>
  			  <p>Username <input type=\"text\" name=\"uname\" /></p>
			<input type=\"submit\" name=\"submit\" value=\"Demote!\" />
			<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></p>
			</form></div>");
			include("footer.php");
			} else {
			echo '<div id="crimestext"><center>You are not in charge of a Corp.</center></div>';
			include("footer.php");
			exit();
		}
?>