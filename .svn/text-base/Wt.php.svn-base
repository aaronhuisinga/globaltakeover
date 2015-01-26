<?php
require_once("members/config.php");
include("members/Rank-ups.inc.php");
checks();
online();

$result = mysql_query("SELECT location FROM Players WHERE id='{$_COOKIE['id']}'");
$row = mysql_fetch_array ($result);
$l = $row[0];

	$result = mysql_query("SELECT Owner, Mx_bd, Mn_bd FROM WT WHERE location='$l'");
	$row = mysql_fetch_array ($result);

	$o = $row[0];
	$mx = $row[1];
	$mn = $row[2];
	
	$sql = mysql_query("SELECT health FROM Players WHERE username='$o'");
	$row = mysql_fetch_array($sql);
	$ohealth = $row[0];
	
	if ($o == 'None' OR $o == NULL) {
	echo ("<div id=\"gameplay\"><center>
	<p>This War Table currently has no owner! Would you like to have it?
	<form name=\"pickup\" method=\"post\" action=\"members/wtpickup.php\">
<input type=\"hidden\" name=\"location\" value=\"$l\" />
<input type=\"submit\" name=\"submit\" value=\"Claim it!\" />
<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
</form>");
	exit();
	} elseif ($ohealth < 1) {
	
	echo ("<div id=\"gameplay\"><center>
	<p>The War Table's owner is dead! Do you want to pick up the ownership?
	<form name=\"pickup\" method=\"post\" action=\"members/wtpickupd.php\">
<input type=\"hidden\" name=\"location\" value=\"$l\" />
<input type=\"submit\" name=\"submit\" value=\"Claim it!\" />
<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" />
</form>");
	
	} else {
	$sql = mysql_query("SELECT * FROM wtescrow WHERE other='$u'");
		$row = mysql_fetch_array($sql);
		if (mysql_num_rows($sql) == 1) {
		$own = $row['username'];
		$query = mysql_query("SELECT id, health FROM Players WHERE username='$own' LIMIT 1");
		$row1 = mysql_fetch_array($query);
		$ownerid = $row1['id'];
		$money = $row['money'];
		$taxm = floor($money * 0.09);
		$tmoney = $money + $taxm;
		$bullets = $row['bullets'];
		$tokens = $row['tokens'];
		$location = $row['location'];
		echo "<div id='crimestext' align='center'><table><tr><td><center><a href='members/profile.php?id=$ownerid'>$own</a> has started an escrow for $location War Table</center></td></tr>
		<tr><td><center>Money: $".number_format($tmoney)." ($".number_format($money)." + $".number_format($taxm).")</center></td></tr>
		<tr><td><center>Bullets: ".number_format($bullets)."</center></td></tr>
		<tr><td><center>Tokens: ".number_format($tokens)."</center></td></tr></table><br><br>
		<form action='members/wtescrow.php' method='POST'><input type='submit' value='Accept!' name='Accept'><input type='submit' value='Decline!' name='Decline'></form></div>";
		exit();
		}
	$result =
	$result = mysql_query("SELECT id FROM Players WHERE username='$o'");
	$row = mysql_fetch_array ($result);

	$ownerid = $row[0];

		$result = mysql_query("SELECT owner FROM WT WHERE id='1'");
		$row = mysql_fetch_array ($result);
		$oo = $row[0];
		
		$result = mysql_query("SELECT owner FROM WT WHERE id='2'");
		$row = mysql_fetch_array ($result);
		$ot = $row[0];

		$result = mysql_query("SELECT owner FROM WT WHERE id='3'");
		$row = mysql_fetch_array ($result);
		$oth = $row[0];

		$result = mysql_query("SELECT owner FROM WT WHERE id='4'");
		$row = mysql_fetch_array ($result);
		$of = $row[0];

		$result = mysql_query("SELECT owner FROM WT WHERE id='5'");
		$row = mysql_fetch_array ($result);
		$ofi = $row[0];

		$result = mysql_query("SELECT owner FROM WT WHERE id='6'");
		$row = mysql_fetch_array ($result);
		$os = $row[0];

		if ($u == $o) {
		echo ("<div id=\"gameplay\"><h1 align=\"center\"><a href=\"members/Wto.php\">Ownership</a></h1> <br />");
		exit();
		} elseif ($oo == $u OR $ot == $u OR $oth == $u OR $of == $u OR $ofi == $u OR $os == $u) {
		echo ("<div id=\"gameplay\"><h1 align=\"center\"><a href=\"members/Wto.php\">Ownership</a></h1> <br />");

		echo('<center><form name="WT" method="post" action="members/WT.php">
		<table> 
		<tr><td align="right">Bet Amount:</td> <td><input type="text" name="bet"></td></tr>
		</table>
		<input type="submit" name="submit" value="Do It!" />
		<input type="hidden" name="submitted" value="TRUE" />
		</form><br />');

		echo("This War Table is owned by <a href=\"members/profile.php?id={$ownerid}\">$o</a><br>
		The max bet is &#36;".number_format($mx)." and the min bet is &#36;".number_format($mn)."</center>");
		} else {
		echo('<div id="gameplay"><center><form name="WT" method="post" action="members/WT.php">
		<table> 
		<tr><td align="right">Bet Amount:</td> <td><input type="text" name="bet"></td></tr>
		</table>
		<input type="submit" name="submit" value="Do It!" />
		<input type="hidden" name="submitted" value="TRUE" />
		</form><br />');

		echo("This War Table is owned by <a href=\"members/profile.php?id={$ownerid}\">$o</a><br>
		The max bet is &#36;".number_format($mx)." and the min bet is &#36;".number_format($mn)."</center>");
		}
	}
?> 