<?
$title="Password Recovery";
require_once("members/config.php");
session_start();

function headers() {
	?>
	<!DOCTYPE html>
		  <html lang="en">
		    <head>
		      <title>globaltakeover &middot; Recover Password</title>
					<meta charset="UTF-8" />
			    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
					<link rel="stylesheet" href="themes/css/bootstrap.min.css" />
					<link rel="stylesheet" href="themes/css/bootstrap-responsive.min.css" />
			    <link rel="stylesheet" href="themes/css/unicorn.login.css" />
		    </head>
		    <body>
		    	<div id="logo" class="brand">
		    		<img src="images/default/logo.png" alt="globaltakeover" />
		    	</div>
		      <div id="loginbox">
						<form method="post" action="lostpass.php" id="loginform" class="form-vertical">
							<p>
	<?
}

if (isset($_POST['password1']) AND isset($_POST['password2'])) {
	headers();
	if (!empty($_POST['password1'])) {
		if ($_POST['password1'] != $_POST['password2']) {
			echo '<div class="alert alert-error">The passwords that you entered did not match</div></p>';
		} else {
			$p=$_POST['password1'];
			$uid=$_POST['playerid'];
			$mysqli->query("UPDATE Players SET password=SHA('$p') WHERE id='$uid' LIMIT 1");
			$mysqli->query("DELETE FROM passreset WHERE user='$uid'");
			echo "<div class=\"alert alert-success\">Your password was changed. You can now login with your new password.</div>";
			exit();
		}
	} else {
		echo '<div class="alert alert-error">You forgot to enter a password.</div></p>';
	}
}
if ((isset($_GET['x']) AND isset($_GET['y'])) OR (isset($_POST['password1']) AND isset($_POST['password2']))) {
	if (($_GET['x'] > 0) AND (strlen($_GET['y']) == 32)) {
		$res=$mysqli->query("SELECT `rkey` FROM `passreset` WHERE `user`='$_GET[x]' LIMIT 1");
		$row=$res->fetch_array();
		$rkey=$row[0];
	
		if ($_GET['y'] == $rkey) {
			?>
			<!DOCTYPE html>
		  <html lang="en">
		    <head>
		      <title>globaltakeover &middot; Recover Password</title>
					<meta charset="UTF-8" />
			    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
					<link rel="stylesheet" href="themes/css/bootstrap.min.css" />
					<link rel="stylesheet" href="themes/css/bootstrap-responsive.min.css" />
			    <link rel="stylesheet" href="themes/css/unicorn.login.css" />
		    </head>
		    <body>
		    	<div id="logo" class="brand">
		    		<img src="images/default/logo.png" alt="globaltakeover" />
		    	</div>
		      <div id="loginbox">
						<form method="post" action="lostpass.php" id="loginform" class="form-vertical">
							<p>Enter a new password</p>
							<div class="control-group">
		          	<div class="controls">
		            	<div class="input-prepend">
		              	<span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password1" placeholder="New Password" />
		              </div>
		            </div>
		          </div>
		          <div class="control-group">
		          	<div class="controls">
		            	<div class="input-prepend">
		              	<span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password2" placeholder="Confirm Password" />
		              </div>
		            </div>
		          </div>
		          <div class="form-actions">
		          	<input type="hidden" name="playerid" value="<? echo $_GET['x']; ?>">
			          <span class="pull-right"><input type="submit" class="btn btn-inverse" name="submit" value="Change Password" /></span>
			        </div>
					  </form>
		      </div>
		      
		      <script src="themes/js/jquery.min.js"></script>  
		      <script src="themes/js/unicorn.login.js"></script> 
		    </body>
		  <?
		} else {
			headers();
			echo "<div class=\"alert alert-error\">The password recover code that you entered is incorrect.</div>";
		}
	}
	exit();
}
if (isset($_POST['recover'])) {
	if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
		$res=$mysqli->query("SELECT id FROM Players WHERE username='$_POST[username]' AND email='$_POST[email]' LIMIT 1");
		$row=$res->fetch_array();
		$test=$mysqli->query("SELECT id FROM passreset WHERE user='$row[0]' LIMIT 1");
		$uip=$_SERVER['REMOTE_ADDR'];
		if ($_POST['username'] == NULL) {
			echo "<div class=\"alert alert-error\">You must enter a valid username</div>";
		} elseif ($res->num_rows < 1) {
			echo "<div class=\"alert alert-error\">This username/email combination is not valid</div>";
		} elseif ($test->num_rows > 0) {
			echo "<div class=\"alert alert-error\">This user already has a password reset pending</div>"; 
		} else {
			$p = md5(uniqid(rand(), true));
			$mysqli->query("INSERT INTO passreset (user, rkey, ip) VALUES ('$row[0]', '$p', '$uip')");
			$body = "A person (hopefully you) using the IP address of $uip submitted a request to change the password of the account $_POST[username]. \r\n 
			If you are the owner of this account and would like to reset your password, follow the link below to continue. \r\n
			Reset Password: www.globaltakeover.net/lostpass.php?x=$row[0]&y=$p \r\n
			If you did not request this password change, please send a message to a Global Takeover staff member with the IP included in the email. Thank you.";
			mail ($_POST['email'], 'Password Reset Request', $body, 'From: Global Takeover <lostpassword@globaltakeover.net>');
			echo "<div class=\"alert alert-success\">An email with instructions for resetting your password has been sent to $_POST[email]</div>";
			require_once("members/footer.php");
			exit();
		}
		unset($_SESSION['security_code']);
   } else {
		echo "<div class=\"alert alert-error\">This security code that you entered was incorrect</div>";
   }
}
require_once("members/footer.php");
?>