<?php
ob_start();
include("config.php");
include("Rank-ups.inc.php");
checks();
online();

$result = mysql_query("SELECT corps, username, health FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$corp = addslashes($row[0]);
$cname = stripslashes($corp);
$username = $row[1];
$h = $row[2];

$query = mysql_query("SELECT owner, co, leftl, rightl, leftro, rightro, vehicles FROM Corps WHERE name='$corp'");
$row = mysql_fetch_array($query);
$o = $row[0];
$c = $row[1];
$ll = $row[2];
$rl = $row[3];
$lro = $row[4];
$rro = $row[5];
$vs = $row[6];

if (($username == $o OR $username == $c) AND ($vs == 0 OR $vs == 1 OR $vs == 2)) {
?>
<br /><br />
<form action="cselld.php" method="post"><div align="center" id="garage">
<h1 align="center"><? echo("$cname"); ?> Dock</h1>
<table>
  <tr class="top">
    <td><b>Boat</b></td>
    <td width="11%"><b>Percent</b></td>
    <td width="11%"><b>Select</b></td>
  </tr>
<?	 
$query=mysql_query("SELECT * FROM cdock WHERE corp='$corp' ORDER BY boat ASC"); 
while ($row=mysql_fetch_array($query)){
$car=$row['boat'];
$percent=stripslashes($row['percent']);
$cid = $row['id'];

?>		
  <tr>
	<td><? echo "$car"; ?></td>
	<td width="11%"><? echo "$percent"; ?>%</td>
	<td width="11%"><input name="checkbox[]" type="checkbox" value="<? echo "$cid"; ?>"></td>
  </tr>	
<?
}
?>
</table>
<input name="Submit" type="submit" value="Sell">
<input name="Submit2" type="submit" value="Repair"><br /><br />
Username: <input type="text" name="to" size="23" maxlength="20"><br />
<input name="Submit3" type="submit" value="Transfer">
</form><br /><br />
<table width="50%" align="center">
	<tr><td align="center" colspan="2"><b>Your Dock</b><br /></td></tr>
	</div>
  	<form action="cdonateboat.php" method="POST">
		<div align="center">
		<table width="50%" id="gmtable">
		<tr class="top">
    	<td><b>Vehicle</b></td>
    	<td width="11%"><b>Percent</b></td>
    	<td width="11%"><b>Select</b></td>
  		</tr>
		<?
		$query=mysql_query("SELECT id, boat, percent FROM dock WHERE username='$username'"); 
		while ($row=mysql_fetch_array($query)){
		$ucar=$row['boat'];
		$ucaid = $row['id'];
		$ucapercent = $row['percent'];
			
  		echo "<tr>
		<td>$ucar</td>
		<td width=\"11%\">$ucapercent%</td>
		<td width=\"11%\"><input name=\"checkbox[]\" type=\"checkbox\" value=\"$ucaid\"></td>
 		</tr>";
 		}
		?>
		</table>
<input name="Submit" type="submit" value="Donate">
</form>
</div>
<?
} else {
if ($vs == 0) {
?>
<br /><br />
<div align="center" id="garage">
<h1 align="center"><? echo("$corp"); ?> Dock</h1>
<table>
  <tr class="top">
    <td><b>Boat</b></td>
    <td width="11%"><b>Percent</b></td>
  </tr>
<?	 
$query=mysql_query("SELECT * FROM cdock WHERE corp='$corp' ORDER BY boat ASC"); 
while ($row=mysql_fetch_array($query)){
$car=$row['boat'];
$percent=stripslashes($row['percent']);

?>		

  <tr>
	<td><? echo "$car"; ?></td>
	<td width="11%"><? echo "$percent"; ?>%</td>
  </tr>	

<?
}
?>
</table>
<br /><br />
<table width="50%" align="center">
	<tr><td align="center" colspan="2"><b>Your Dock</b><br /></td></tr>
	</div>
  	<form action="cdonateboat.php" method="POST">
		<div align="center">
		<table width="50%" id="gmtable">
		<tr class="top">
    	<td><b>Boat</b></td>
    	<td width="11%"><b>Percent</b></td>
    	<td width="11%"><b>Select</b></td>
  		</tr>
		<?
		$query=mysql_query("SELECT id, boat, percent FROM dock WHERE username='$username'"); 
		while ($row=mysql_fetch_array($query)){
		$ucar=$row['boat'];
		$ucaid = $row['id'];
		$ucapercent = $row['percent'];
			
  		echo "<tr>
		<td>$ucar</td>
		<td width=\"11%\">$ucapercent%</td>
		<td width=\"11%\"><input name=\"checkbox[]\" type=\"checkbox\" value=\"$ucaid\"></td>
 		</tr>";
 		}
		?>
		</table>
<input name="Submit" type="submit" value="Donate">
</form>
</div>
<?
} elseif ($vs == 1) {
if ($username == $rl OR $username == $ll OR $username == $lro OR $username == $rro) {
?>
<br /><br />
<form action="cselld.php" method="post"><div align="center" id="garage">
<h1 align="center"><? echo("$corp"); ?> Dock</h1>
<table>
  <tr class="top">
    <td><b>Boat</b></td>
    <td width="11%"><b>Percent</b></td>
    <td width="11%"><b>Select</b></td>
  </tr>
<?	 
$query=mysql_query("SELECT * FROM cdock WHERE corp='$corp' ORDER BY boat ASC"); 
while ($row=mysql_fetch_array($query)){
$car=$row['boat'];
$percent=stripslashes($row['percent']);
$cid = $row['id'];

?>		

  <tr>
	<td><? echo "$car"; ?></td>
	<td width="11%"><? echo "$percent"; ?>%</td>
	<td width="11%"><input name="checkbox[]" type="checkbox" value="<? echo "$cid"; ?>"></td>
  </tr>	

<?
}
?>
</table>
<input name="Submit2" type="submit" value="Repair"><br /><br />
Username: <input type="text" name="to" size="23" maxlength="20"><br />
<input name="Submit3" type="submit" value="Transfer">
</form><br /><br />
<table width="50%" align="center">
	<tr><td align="center" colspan="2"><b>Your Dock</b><br /></td></tr>
	</div>
  	<form action="cdonateboat.php" method="POST">
		<div align="center">
		<table width="50%" id="gmtable">
		<tr class="top">
    	<td><b>Boat</b></td>
    	<td width="11%"><b>Percent</b></td>
    	<td width="11%"><b>Select</b></td>
  		</tr>
		<?
		$query=mysql_query("SELECT id, boat, percent FROM dock WHERE username='$username'"); 
		while ($row=mysql_fetch_array($query)){
		$ucar=$row['boat'];
		$ucaid = $row['id'];
		$ucapercent = $row['percent'];
			
  		echo "<tr>
		<td>$ucar</td>
		<td width=\"11%\">$ucapercent%</td>
		<td width=\"11%\"><input name=\"checkbox[]\" type=\"checkbox\" value=\"$ucaid\"></td>
 		</tr>";
 		}
		?>
		</table>
<input name="Submit" type="submit" value="Donate">
</form>
</div>
<?
} else {
?>
<br /><br />
<div align="center" id="garage">
<h1 align="center"><? echo("$corp"); ?> Dock</h1>
<table>
  <tr class="top">
    <td><b>Boat</b></td>
    <td width="11%"><b>Percent</b></td>
  </tr>
<?	 
$query=mysql_query("SELECT * FROM cdock WHERE corp='$corp' ORDER BY boat ASC"); 
while ($row=mysql_fetch_array($query)){
$car=$row['boat'];
$percent=stripslashes($row['percent']);

?>		

  <tr>
	<td><? echo "$car"; ?></td>
	<td width="11%"><? echo "$percent"; ?>%</td>
  </tr>	

<?
}
?>
</table>
<br /><br />
<table width="50%" align="center">
	<tr><td align="center" colspan="2"><b>Your Dock</b><br /></td></tr>
	</div>
  	<form action="cdonateboat.php" method="POST">
		<div align="center">
		<table width="50%" id="gmtable">
		<tr class="top">
    	<td><b>Boat</b></td>
    	<td width="11%"><b>Percent</b></td>
    	<td width="11%"><b>Select</b></td>
  		</tr>
		<?
		$query=mysql_query("SELECT id, boat, percent FROM dock WHERE username='$username'"); 
		while ($row=mysql_fetch_array($query)){
		$ucar=$row['boat'];
		$ucaid = $row['id'];
		$ucapercent = $row['percent'];
			
  		echo "<tr>
		<td>$ucar</td>
		<td width=\"11%\">$ucapercent%</td>
		<td width=\"11%\"><input name=\"checkbox[]\" type=\"checkbox\" value=\"$ucaid\"></td>
 		</tr>";
 		}
		?>
		</table>
<input name="Submit" type="submit" value="Donate">
</form>
</div>
<?
}
} elseif ($vs == 2) {
?>
<br /><br />
<form action="cselld.php" method="post"><div align="center" id="garage">
<h1 align="center"><? echo("$cname"); ?> Dock</h1>
<table>
  <tr class="top">
    <td><b>Boat</b></td>
    <td width="11%"><b>Percent</b></td>
    <td width="11%"><b>Select</b></td>
  </tr>
<?	 
$query=mysql_query("SELECT * FROM cdock WHERE corp='$corp' ORDER BY boat ASC"); 
while ($row=mysql_fetch_array($query)){
$car=$row['boat'];
$percent=stripslashes($row['percent']);
$cid = $row['id'];

?>		

  <tr>
	<td><? echo "$car"; ?></td>
	<td width="11%"><? echo "$percent"; ?>%</td>
	<td width="11%"><input name="checkbox[]" type="checkbox" value="<? echo "$cid"; ?>"></td>
  </tr>	

<?
}
?>
</table>
<input name="Submit2" type="submit" value="Repair"><br /><br />
Username: <input type="text" name="to" size="23" maxlength="20"><br />
<input name="Submit3" type="submit" value="Transfer">
</form><br /><br />
<table width="50%" align="center">
	<tr><td align="center" colspan="2"><b>Your Dock</b><br /></td></tr>
	</div>
  	<form action="cdonateboat.php" method="POST">
		<div align="center">
		<table width="50%" id="gmtable">
		<tr class="top">
    	<td><b>Boat</b></td>
    	<td width="11%"><b>Percent</b></td>
    	<td width="11%"><b>Select</b></td>
  		</tr>
		<?
		$query=mysql_query("SELECT id, boat, percent FROM dock WHERE username='$username'"); 
		while ($row=mysql_fetch_array($query)){
		$ucar=$row['boat'];
		$ucaid = $row['id'];
		$ucapercent = $row['percent'];
			
  		echo "<tr>
		<td>$ucar</td>
		<td width=\"11%\">$ucapercent%</td>
		<td width=\"11%\"><input name=\"checkbox[]\" type=\"checkbox\" value=\"$ucaid\"></td>
 		</tr>";
 		}
		?>
		</table>
<input name="Submit" type="submit" value="Donate">
</form>
</div>
<?
} else {
echo ("There has been an error. Message an Admin immediately. (Code= cdock vs status)");
}
}
?>