<?php 
$title="Gym";
include ("config.php");
include("header.php");
include("maketime.php");
include("Countdown_he.php");
checks();
online();

$row=mysql_fetch_array(mysql_query("SELECT clicks, money, username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$clicks = $row[0];
$umoney = $row[1];
$username = $row[2];

mysql_query("UPDATE Players SET clicks=(clicks+1) WHERE id ='{$_COOKIE['id']}' LIMIT 1;");
if ($clicks >= 25) {
	$url .= '/members/gscriptcheck.php';
	header("Location: $url");
	exit();
} else {

$page="train.php";
echo " <form method=post action=''>";
$fetch=mysql_fetch_object(mysql_query("SELECT * FROM Players WHERE username='$username'"));
$wins= $fetch->wins;
$losses= $fetch->losses;

if ($fetch->mem_gym == "0"){
if (strip_tags($_GET['member']) == "yes"){
if ($fetch->money < "10000"){
echo "<div id=\"crimestext\"><center>You don't have enough money to buy a gym membership.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}elseif ($fetch->money >= "10000"){
$new_money=$fetch->money - 10000;
mysql_query("UPDATE Players SET money='$new_money', mem_gym='1' WHERE username='$username'");
echo "<div id=\"crimestext\"><center>You purchased a Gym Membership.<br /><a href=\"gym.php\">Click here to continue.</a></center></div>";
include("footer.php");
exit();
}}

?>
<div id="ltable" align="center">
<table width="70%" align="center" id="usertable">
  <tr class="top"> <td align="center"><b>Gym Status</b></td></tr>
  <tr>
     <td align="center">You currently do not own a Gym Pass.<br />
     To purchase one, <a href="?member=yes">click here.</a> It costs $10,000.</td>
  </tr>
</table>
</div>
<? 
include("footer.php");
}else{
if (strip_tags($_POST['train']) && strip_tags($_POST['choice'])){
if ($fetch->last_train > time()){
echo "<div id=\"crimestext\"><center>You have already trained recently, and must wait for ".maketime($fetch->last_train).".<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}else{

$choice=strip_tags($_POST['choice']);
if ($choice == "1" || $choice == "2" || $choice == "3"){
if ($choice == "1"){
$plus="5";
$wait="1";
}elseif ($choice == "2"){
$plus="10";
$wait="5";
}elseif ($choice == "3"){
$plus="15";
$wait="10";
}
$new_exp=$fetch->g_exp + $plus;
$now=time()+ (60*$wait);
if ($new_exp >= "100"){
$new_lvl=$fetch->g_level+1;
$left=$new_exp-100;
mysql_query("UPDATE Players SET g_exp='$left', g_level='$new_lvl', last_train='$now' WHERE username='$username'");
echo "<div id=\"crimestext\"><center>You trained, and went up a level! You are now level $new_lvl.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}else{
mysql_query("UPDATE Players SET g_exp='$new_exp', last_train='$now' WHERE username='$username'");
echo "<div id=\"crimestext\"><center>You stayed in the gym for hours, and trained successfully.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}
}}}

if (strip_tags($_POST['create_button']) && strip_tags($_POST['create_bet'])){
$create_bet=intval(strip_tags(abs($_POST['create_bet'])));
if ($create_bet == 0 || !$create_bet || ereg('[^0-9]',$create_bet)){
echo "<div id=\"crimestext\"><center>Please enter a valid amount to bet.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
	
}elseif ($create_bet != 0 && $create_bet && !ereg('[^0-9]',$create_bet)){
if ($create_bet > $fetch->money){
echo "<div id=\"crimestext\"><center>You don't have enough money to create this match.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}elseif ($create_bet <= $fetch->money){
$already=mysql_num_rows(mysql_query("SELECT * FROM matches WHERE username='$username'"));
if ($already != "0"){
echo "<div id=\"crimestext\"><center>You are already hosting a match, and cannot start another.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}elseif ($already == "0"){

mysql_query("INSERT INTO `matches` ( `id` , `username` , `bet` ) VALUES ('', '$username', '$create_bet')");
$new_money=$fetch->money - $create_bet;
mysql_query("UPDATE Players SET money='$new_money' WHERE username='$username'");
echo "<div id=\"crimestext\"><center>You started a new match.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}}}}

if (strip_tags($_POST['play_id']) && strip_tags($_POST['Submit'])){
$play_id=strip_tags($_POST['play_id']);
$match_info=mysql_query("SELECT * FROM matches WHERE id='$play_id'");
$num = mysql_num_rows($match_info);
$match_fetch=mysql_fetch_object($match_info);
if ($num == "0"){
echo "<div id=\"crimestext\"><center>The match you selected does not exist.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}elseif ($num != "0"){
if ($match_fetch->bet > $fetch->money){
echo "<div id=\"crimestext\"><center>You do not have enough money to compete in this match.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}elseif($match_fetch->bet <= $fetch->money){
if (strtolower($match_fetch->username) == strtolower($username)){
echo "<div id=\"crimestext\"><center>You cannot compete against yourself!<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}elseif ($match_fetch != $username){
$oppon = mysql_fetch_object(mysql_query("SELECT * FROM Players WHERE username='$match_fetch->username'"));
$oppwins = $oppon->wins;
$opplosses = $oppon->losses;

$oppon_user = mysql_fetch_object(mysql_query("SELECT * FROM Players WHERE username='$match_fetch->username'"));

if ($oppon->g_level == $fetch->g_level && $oppon->g_exp == $fetch->g_exp){
$new_money=$oppon_user->money + $match_fetch->bet;
mysql_query("UPDATE Players SET money='$new_money' WHERE username='$match_fetch->username' LIMIT 1;");
$subject = htmlspecialchars(addslashes("Gym Match Results"));
$message = htmlspecialchars(addslashes("You were challenged to a match in the Gym, and it ended in a draw!"));
mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$match_fetch->username', 'Global Takeover', 'unread', '$date')");
echo "<div id=\"crimestext\"><center>You and your opponent both went at each other with all of the force you had, but neither of you was able to overcome the other. It was a draw!<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();

}elseif ($oppon->g_level > $fetch->g_level){
$tax = (($match_fetch->bet * 2) *.06);
$winnings = (($match_fetch->bet * 2) - $tax);

$new_money=$oppon_user->money + $winnings;
mysql_query("UPDATE Players SET money='$new_money' WHERE username='$match_fetch->username' LIMIT 1;");
$your_money=$fetch->money - $match_fetch->bet;
mysql_query("UPDATE Players SET money='$your_money' WHERE username='$username' LIMIT 1;");
$new_stats = $oppwins +1;
mysql_query("UPDATE Players SET wins='$new_stats' WHERE username='$oppon->username' LIMIT 1;");
$new_ekk = $losses +1;
mysql_query("UPDATE Players SET losses='$new_ekk' WHERE username='$username' LIMIT 1;");

$subject = htmlspecialchars(addslashes("Gym Match Results"));
$message = htmlspecialchars(addslashes("You were challenged to a match in the Gym, and you easily won. You came away with $".number_format(($match_fetch->bet * 2)).""));
mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$match_fetch->username', 'Global Takeover', 'unread', '$date')");
mysql_query("DELETE FROM matches WHERE id='$play_id' LIMIT 1;");
echo "<div id=\"crimestext\"><center>You attempted to take him out right away, but you were overpowered. You lost!<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();

}elseif ($oppon->g_level == $fetch->g_level && $oppon->g_exp > $fetch->g_exp){
$tax = (($match_fetch->bet * 2) *.06);
$winnings = (($match_fetch->bet * 2) - $tax);

$new_money=$oppon_user->money + $winnings;
mysql_query("UPDATE Players SET money='$new_money' WHERE username='$match_fetch->username' LIMIT 1;");
$your_money=$fetch->money - $match_fetch->bet;
mysql_query("UPDATE Players SET money='$your_money' WHERE username='$username' LIMIT 1;");
$new_stats = $oppwins +1;
mysql_query("UPDATE Players SET wins='$new_stats' WHERE username='$oppon->username' LIMIT 1;");
$new_ekk = $losses +1;
mysql_query("UPDATE Players SET losses='$new_ekk' WHERE username='$username' LIMIT 1;");

$subject = htmlspecialchars(addslashes("Gym Match Results"));
$message = htmlspecialchars(addslashes("You were challenged to a match in the Gym, and you easily won. You came away with $".number_format(($match_fetch->bet * 2)).""));
mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$match_fetch->username', 'Global Takeover', 'unread', '$date')");
mysql_query("DELETE FROM matches WHERE id='$play_id' LIMIT 1;");		
echo "<div id=\"crimestext\"><center>You attempted to take him out right away, but you were overpowered. You lost!<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();

}elseif ($oppon->g_level < $fetch->g_level){
$tax = (($match_fetch->bet) *.06);
$winnings = (($match_fetch->bet) - $tax);

$new_money=$fetch->money + $winnings;
mysql_query("UPDATE Players SET money='$new_money' WHERE username='$username' LIMIT 1;");
$new_stats = $wins +1;
mysql_query("UPDATE Players SET wins='$new_stats' WHERE username='$username' LIMIT 1;");
$new_ekk = $opplosses +1;
mysql_query("UPDATE Players SET losses='$new_ekk' WHERE username='$oppon->username' LIMIT 1;");
$subject = htmlspecialchars(addslashes("Gym Match Results"));
$message = htmlspecialchars(addslashes("You were challenged to a match in the Gym, and were badly beaten. You had better start training more!"));
mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$match_fetch->username', 'Global Takeover', 'unread', '$date')");
mysql_query("DELETE FROM matches WHERE id='$play_id' LIMIT 1;");		
echo "<div id=\"crimestext\"><center>You quickly overpowered your opponent, and won with ease.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();

}elseif ($oppon->g_level == $fetch->g_level && $oppon->g_exp < $fetch->g_exp){
$tax = (($match_fetch->bet) *.06);
$winnings = (($match_fetch->bet) - $tax);

$new_money=$fetch->money + $winnings;
mysql_query("UPDATE Players SET money='$new_money' WHERE username='$username' LIMIT 1;");
$new_stats = $wins +1;
mysql_query("UPDATE Players SET wins='$new_stats' WHERE username='$username' LIMIT 1;");
$new_ekk = $opplosses +1;
mysql_query("UPDATE Players SET losses='$new_ekk' WHERE username='$oppon->username' LIMIT 1;");

$subject = htmlspecialchars(addslashes("Gym Match Results"));
$message = htmlspecialchars(addslashes("You were challenged to a match in the Gym, and were badly beaten. You had better start training more!"));
mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$match_fetch->username', 'Global Takeover', 'unread', '$date')");
mysql_query("DELETE FROM matches WHERE id='$play_id'");
echo "<div id=\"crimestext\"><center>You quickly overpowered your opponent, and won with ease.<br /><a href=\"gym.php\">Go back.</a></center></div>";
include("footer.php");
exit();
}
mysql_query("DELETE FROM matches WHERE id='$play_id' LIMIT 1;");
}}}}
?>
<div id="ltable" align="center">
<h1>Gym</h1>
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr> 
    <td width="100%"> 
        <table width="100%" id="usertable">
          <tr> 
            <td class="top" align="center">Training</td>
          </tr>
		   <tr><td height=1 colspan=3></td></tr>
          <tr> 
            <td><table width="100%">
              <tr> 
                <td width="5%"><input name="choice" type="radio" value="1" checked></td>
                <td width="47%">Run a mile</td>
                <td width="48%">+5</td>
              </tr>
              <tr> 
                <td><input type="radio" name="choice" value="2"></td>
                <td>Use the punching bag</td>
                <td>+10</td>
              </tr>
              <tr> 
                <td><input type="radio" name="choice" value="3"></td>
                <td>Challenge instructor</td>
                <td>+15</td>
              </tr>
              <tr> 
                <td colspan="3" align="center"><input name="train" type="submit" id="train2" value="Train"></td>
              </tr>
            </table></td>
          </tr>
        </table>
  </td>
  </tr>
  <tr> 
    <td width="100%"><table width="100%" id="usertable">
        <tr> 
          <td class="top" align="center">Current Statistics</td>
        </tr>
		 <tr><td height=1 colspan=3></td></tr>
        <tr> 
          <td><table width="100%">
              <tr> 
                <td>Current Level:</td>
                <td><?php echo "$fetch->g_level"; ?></td>
              </tr>
              <tr> 
                <td>Current Level Progress:</td>
                <td><table width="<?php echo "$fetch->g_exp"; ?>%" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td id="rankbar"><font color="#000000"><?php echo "$fetch->g_exp%"; ?></font></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td width="49%">Your wins:</td>
                <td width="51%"><?php echo "$wins"; ?></td>
              </tr>
              <tr> 
                <td>Your losses:</td>
                <td><?php echo "$losses"; ?></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" id="usertable">
        <tr> 
          <td colspan="3" class="top" align="center">Current Matches</td>
        </tr>
        <tr> 
          <td width="32%">Username</td>
          <td width="21%">Bet</td>
          <td width="47%">Wins/Losses</td>
        </tr>
 <tr><td height=1 colspan=3></td></tr>
        <?php $select=mysql_query("SELECT * FROM matches ORDER by bet DESC");
	   while($dada = mysql_fetch_object($select)){
	   $ls =mysql_fetch_object(mysql_query("SELECT * FROM Players WHERE username='$dada->username'"));
	  $owins= $ls->wins;
	  $olosses= $ls->losses;
	  
	   echo "
	    <tr> 
          <td><input type=radio name=play_id value=$dada->id>$dada->username</td>
          <td>&#36;".number_format($dada->bet)."</td>
          <td>$owins/$olosses</td>
        </tr>";
		}
		?>
        <tr> 
          <td colspan="3" align="center"><input type="submit" name="Submit" value="Challenge"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" id="usertable">
        <tr> 
          <td width="100%" class="top" align="center">Start a Match</td>
        </tr>
        <tr> 
            <td> 
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr> 
                <td width="50%">Bet Amount:</td>
                <td width="50%"><input name="create_bet" type="text" id="create_bet2"></td>
              </tr>
              <tr> 
                <td colspan="2" align="center"><input name="create_button" type="submit" id="create_button2" value="Create"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<p>There is a 6% tax on all winnings.</p>
</div>
<?php include("footer.php"); }} ?>