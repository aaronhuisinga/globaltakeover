<?
$title="Swiss Bank > Recover Account";
include("config.php");
include("header.php");
checks();
online();

$result = mysql_query("SELECT username, money, s_acc FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;");
$row = mysql_fetch_array ($result);
$username = $row[0];
$f_ip = $_SERVER['REMOTE_ADDR'];

if ($_POST['recover']) {
$owner = $_POST['owner'];
$pass = $_POST['password'];

$pcheck = mysql_query("SELECT id FROM Players WHERE username='$owner' AND password=SHA1('$pass') LIMIT 1;");
$row = mysql_fetch_array ($pcheck);
$id = $row[0];

if ($row) {
$sql = mysql_fetch_array(mysql_query("SELECT account, pass FROM swiss WHERE username='$owner'"));
$passcode = $sql['pass'];
$account = $sql['account'];
$subject = htmlspecialchars(addslashes("Swiss Account Details"));
$message = htmlspecialchars(addslashes("The account number is: $account, and the password is: $passcode."));
mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date`, `reply` ) VALUES ('$subject', '$message', '$username', 'Global Takeover', 'unread', '$date', 'no')");
echo "<div id='crimestext' align='center'>The details of the account have been messaged to you.<br /><a href='swiss.php'>Go Back</a></div>";
include("footer.php");
exit();

} else {
echo "<div id='crimestext' align='center'>The account owner username and password that you entered are not correct, or do not exist.<br /><a href='swissrecover.php'>Go Back</a></div>";
include("footer.php");
exit();
}
}

echo "<div id='crimestext' align='center'><h1>Swiss Account Recovery</h1>
Welcome to the recovery process for your swiss bank account.<br />
To recover the information of the account, please type in the username that opened the account, and the password for the <b>player's</b> account.<br />
The swiss account number and password will then be messaged to you.
<br /><br /><form action='' method='POST'>Original owner username: <input type=\"text\" name=\"owner\" /><br>
Original owner password: <input type=\"password\" name=\"password\" /><br>
<input type=\"submit\" name=\"submit\" value=\"Recover!\" />
<input type='hidden' name='recover' value='recover'></form></div>";
include("footer.php");
?>
