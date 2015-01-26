<?php 
session_start();
$title="Script Check";
require_once("members/config.php");
checks();
online();

if( isset($_POST['submit'])) {
   if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) { 
		$mysqli->query("UPDATE Players SET clicks = '0' WHERE id ='$_COOKIE[id]' LIMIT 1;");
		header("Location: $_COOKIE[scheck]");
		setcookie ('scheck', null, time()-3600, '/');
		unset($_SESSION['security_code']);
   } else {
   		require_once("members/header.php");
		echo '<div id="crimestext"><center>The verification code that you typed was incorrect.<br /><a href="scriptcheck.php">Try again.</a></center></div>';
		require_once("members/footer.php");
   }
} else {
require_once("members/header.php");
?>
<div class="page-header">
<h1>Captcha <small>You are a human, right?</small></h1>
</div>
<form action="scriptcheck.php" class="form-inline" method="post">
    <div class="controls">
      <img src="members/CaptchaSecurityImages.php?width=100&height=40&characters=3" />
    <div class="input-append">
      <input id="security_code" name="security_code" type="text" placeholder="Enter the Code" maxlength="3"><button class="btn" type="submit" name="submit" value="submit">Verify</button>
    </div></div>
    </form>
   </center></div>
<?php
require_once("members/footer.php");
}
?>