<?php 
include("config.php");
include("rrt.php");
checks();
online();

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
	$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
	$username = $row['username'];
	
$fetch= mysql_fetch_object(mysql_query("SELECT * FROM Players WHERE username='$username'"));
if ($fetch->rank == "Wannabe" || $fetch->rank == "Recruit" || $fetch->rank == "Private" || $fetch->rank == "Soldier" || $fetch->rank == "Mercenary"){
echo "<div id=\"crimestext\"><center>You need to be at least a Contract Killer to play Russian Roulette.</center></div>";
exit();
}

if (strip_tags(!$_POST['go']) && $_POST['bet'] == ""){

$ticked="0";

}elseif (strip_tags($_POST['go']) && $_POST['bet'] != ""){

	$bet=intval(strip_tags(abs($_POST['bet'])));

		if ($bet > "0"){

		if ($bet == 0 || !$bet || ereg('[^0-9]',$bet)){

	print "<div id=\"crimestext\"><center>Please enter a valid number!</center></div>";

	$ticked="0";

}elseif ($bet != 0 && $bet <= 60000000 && $bet && !ereg('[^0-9]',$bet)){

if ($bet > $fetch->money){

echo "<div id=\"crimestext\"><center>Please enter an amount of money that you have.</center></div>";

$ticked="0";

} elseif ($bet <= $fetch->money){

$bulletshoot = rand(1,7);

if ($bulletshoot <= "5"){

$outcome="1";}

else ($outcome="2");

if($outcome == "1"){

$output = "<div id=\"crimestext\"><center>The gun fires, and you are immediately killed.</center></div>";

$win="0";

} elseif($outcome == "2") {

$output = "<div id=\"crimestext\"><center>The gun clicks, and does not fire. You have won!</center></div>";

$win="1";

}

if ($win == "1"){

$new_money = $bet * 2;
$n_money = $fetch->money + $new_money;

echo "<div id=\"crimestext\"><center>The gun clicks, and does not fire. You have won!<br />Money Won: &#36;".number_format($new_money)."</center></div>";

mysql_query("UPDATE Players SET money='$n_money' WHERE username='$username' LIMIT 1;");
mysql_query("UPDATE Players SET rrtime='$current' WHERE id ='{$_COOKIE['id']}' LIMIT 1;");
echo ('<script language="javascript">window.parent.stats.location.reload();</script>');
mysql_close();
exit();

} elseif ($win == "0"){

	mysql_query("UPDATE Players SET health='0', dead='1', tdeath='$date', td='$current' WHERE username='$username' LIMIT 1;");
	// Drop Props
	mysql_query("UPDATE airport SET owner='None' WHERE owner='$username'");
	mysql_query("UPDATE Bank SET owner='None' WHERE owner='$username'");
	mysql_query("UPDATE BF SET owner='None' WHERE owner='$username'");
	mysql_query("UPDATE BJT SET owner='None' WHERE Owner='$username'");
	mysql_query("UPDATE roulette SET owner='None' WHERE owner='$username'");
	mysql_query("UPDATE wf SET owner='None' WHERE owner='$username'");
	mysql_query("UPDATE WT SET owner='None' WHERE owner='$username'");
 
echo "$output";
mysql_query("UPDATE Players SET rrtime='$current' WHERE id ='{$_COOKIE['id']}' LIMIT 1;");
mysql_close();
exit();

}

$ticked="1";

}

} else {
echo '<div align="center" id="crimestext">Please make a bet between $1 and $60,000,000<br /><a href="/members/rr.php">Go back.</a></div>';
mysql_close();
exit();
}} else {
echo '<div align="center" id="crimestext">Please make a vaild bet.<br /><a href="/members/rr.php">Go back.</a></div>';
mysql_close();
exit();
}} else {
echo '<div align="center" id="crimestext">Please make a vaild bet.<br /><a href="/members/rr.php">Go back.</a></div>';
mysql_close();
exit();
}


?>

<script language=JavaScript>
function so(dis)
{
for (i=0;i<dis.elements.length;i++){ 
	if (dis.elements[i].type=='submit')
	   dis.elements[i].style.visibility='hidden';
	}
	if(fs==false){
		 fs=true;
		 return true;
	}else
 		return false;
	}
	function goaway()
{
for(i=0;i<document.forms.length;i++)
 document.forms[i].onsubmit = function() {return so(this);};
}
</script>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body OnLoad="goaway()">
<form action="" method=POST>
<br />
<?php if ($ticked == "0"){ ?>
<div id="gameplay">
<center>
  <h1>Russian Roulette</h1>
  <p>Welcome to Russian Roulette.<br /> You have a 50/50 chance of winning. You make a bet, and if you win your prize is tripled.<br /> If you lose, you die. Are you ready?<br />
  The current maxbet is $60,000,000.</p>
  <table align="center">
  <tr><td align="right">Bet Amount:</td> <td><input name="bet" type="text" id="bet"></td></tr>
  <tr><td colspan="2"> <div align="center"><input name="go" type="submit" id="go" value="Do it."></td></tr>
</table>
</form>
</center>
</div>

<?php }elseif ($ticked =="1"){ ?>
<p>&nbsp;</p>
<form action="" method=POST>
<table width="56%" align="center" cellpadding="0" cellspacing="0">
  <tr class="top">
    <td colspan="2" class=header><center>
    <b>Russian Roulette</b>
    </center></td>

  </tr>
   <tr><td height=1 colspan=3></td></tr>
  <tr> 
    <td width="53%">Bet Amount: </td>

    <td width="47%"><input name="bet" type="text" id="bet" value="<?php echo "$_POST[bet]"; ?>"></td>

  </tr>

  <tr> 

    <td height="25" colspan="2"> <div align="center"> 

        <input name="go" type="submit" id="go" value="Do it.">

      </div></td>
  </tr>
</table>
<p><br></form>
</p>
<?php }} ?>