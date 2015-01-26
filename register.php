<?php
$title="Register";
include ("members/config.php");
// Username validator
if(isset($_POST['unValidate'])) {
	$res=$mysqli->query("SELECT `id` FROM `Players` WHERE `username` = '$_POST[unValidate]' LIMIT 1");
	if($res->num_rows == 0) { echo "success"; } else { echo "error"; }
	exit();
}
function headers() {
	?>
	<!DOCTYPE html>
  <html lang="en">
    <head>
      <title>globaltakeover &middot; Register</title>
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
      <div id="loginbox" style="height: 370px;">            
	      	<p>
	<?
}
// Activation portal
if(isset($_GET['page']) AND $_GET['page'] == 'activate') {
	headers();
	if (isset($_GET['x'])) { $x = (int) $_GET['x']; }
	if (isset($_GET['y'])) { $y = $_GET['y']; }
	if (isset($x) AND (strlen($y) == 32)) {
		$res=$mysqli->query("SELECT refplayer, active, username FROM Players WHERE id='$x' LIMIT 1");
		$row=$res->fetch_array();
		$referrer=$row[0];
		$activate=$row[1];
		$username=$row[2];
	
		if ($activate == NULL) {
			echo "This account has already been activated.</p></div>";
		} else {
			if ($referrer != NULL) {
				// Credit Referrer
				$mysqli->query("UPDATE Players SET referrals=(referrals+1), money=(money+100000) WHERE username='$referrer' LIMIT 1");
				// Message Referrer
				$message = "Thank you for referring $username to Global Takeover! Your account has been credited with $100,000, and will continue to receive benefits as the referred player ranks!";
				$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('Player Referred', '$message', '$referrer', 'Global Takeover', 'unread', '$date')");
			}
			// Activate
			$mysqli->query("UPDATE Players SET active=NULL WHERE (id=$x AND active='" . $y . "') LIMIT 1");
			echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=index.php\"></head>
				  Your account was successfully activated! Redirecting...</p></div>";
		}
	}
	exit();
}

if(isset($_POST['Submit'])) {
	$emailQuery=$mysqli->query("SELECT `id` FROM Players WHERE email='$_POST[email]' AND dead='0' AND banned='0' LIMIT 1");
	$nameQuery=$mysqli->query("SELECT `id` FROM Players WHERE username='$_POST[username]' LIMIT 1");
	
	if (empty($_POST['username']) OR (strcasecmp($_POST['username'], 'none') == 0) OR (strcasecmp($_POST['username'], 'Anonymous') == 0) OR (strcasecmp($_POST['username'], 'Global Takeover') == 0) OR (strcasecmp($_POST['username'], 'Administrator') == 0) OR (strcasecmp($_POST['username'], 'Admin') == 0)) {
		echo "<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> The username that you entered is invalid.</div>";
	} elseif (empty($_POST['email']) OR !preg_match("/([\w\.\-]+)(\@[\w\.\-]+)(\.[a-z]{2,4})+/i", $_POST['email'])) {
		echo "<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> The email that you entered is invalid</div>";
	} elseif ($emailQuery->num_rows != 0) {
		echo "<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> The email that you entered is already in use. Please choose another.</div>";
	} elseif (empty($_POST['password1'])) {
		echo "<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> You must enter a password.</div>";
	} elseif ($_POST['password1'] != $_POST['password2']) {
		echo"<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> The passwords that you entered did not match. Please try again.</div>";
	} elseif ($nameQuery->num_rows != 0) {
		echo "<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> The username that you entered is already in use. Please choose another.</div>";
	} elseif ($_POST['refer'] == NULL OR $_POST['refer'] != "gt0b3ta2012") {
		echo "<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> The referral code that you entered is not valid.</div>";
	} else {
		$user=$_POST['username'];
		$email=$_POST['email'];
		$p=$_POST['password1'];
		$referrer=$_POST['refer'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$a=md5(uniqid(rand(), true));
		$ln = rand (2, 6);
		if ($ln == 2) {
			$l = 'Australia';
		} elseif ($ln == 3) {
			$l = 'Russia';
		} elseif ($ln == 4) {
			$l = 'UK';
		} elseif ($ln == 5) {
			$l = 'Philippines';
		} elseif ($ln == 6) {
			$l = 'USA';
		}
		if (isset($_POST['facebook'])) { $facebook= $_POST['facebook']; }
		// Set headers (Specify HTML email, From address)
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Global Takeover <registration@globaltakeover.net>' . "\r\n";
		// Set subject
		$subject = 'Global Takeover Registration';
		
		if (!isset($facebook)) {
			$mysqli->query("INSERT INTO Players (username, email, active, password, registration_date, location, r_ip, refplayer, money) VALUES ('$user', '$email', '$a', SHA('$p'), '$date', '$l', '$ip', 'invited', '100000')");
			// Code the body in HTML
			$body = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
					<html>
					<head>
  						<title>Global Takeover Registration</title>
  						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
					</head>
					<body>
  						<p>Hey $user,<br> 
  						Thank you for your registration at Global Takeover.<br> 
  						Before you can use your account, you must activate it using the link below.<br>
  						<a href=\"http://www.globaltakeover.net/register.php?page=activate&x=" . $mysqli->insert_id . "&y=$a\">www.globaltakeover.net/register.php?page=activate&x=" . $mysqli->insert_id . "&y=$a</a><br>
  						Once you have activated your account, you will be able to login and use it.<br><br>
  						<b>After registering, please take the time to read both the <a href=\"http://www.globaltakeover.net/TOS.php\">TOS</a> and the <a href=\"http://www.globaltakeover.net/Faq.php\">FAQ</a>. They are important to know if you wish to succeed in the game.</b><br>
  						We have you enjoy Global Takeover!<br>
  						Sincerely,<br>
  						- The GTO Staff.
					</body>
					</html>";
			// Mail it
			mail ($_POST['email'], $subject, $body, $headers);
			echo "success";
			exit();
		} else {
			$mysqli->query("INSERT INTO Players (username, email, password, registration_date, location, r_ip, refplayer, money, facebook) VALUES ('$user', '$email', SHA('$p'), '$date', '$l', '$ip', 'invited', '100000', '$facebook')");
			// Code the body in HTML
			$body = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
					<html>
					<head>
						<title>Global Takeover Registration</title>
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
					</head>
					<body>
						Hey $user,<br /> Thank you for your registration at Global Takeover.<br />
						You're all set to play! Thanks for using Facebook to register your account! <br /><br />
						<b>Please take the time to read both the <a href=\"http://www.globaltakeover.net/TOS.php\">TOS</a> and the <a href=\"http://www.globaltakeover.net/Faq.php\">FAQ</a>. They are important to know if you wish to succeed in the game.</b><br />
						We have you enjoy Global Takeover!<br />
						Sincerely,<br />
						- The GTO Staff.
					</body>
					</html>";
					// Mail it
					mail ($_POST['email'], $subject, $body, $headers);
					header("Location: index.php");
					exit();
		}
	}
	exit();
}
?>
<!DOCTYPE html>
  <html lang="en">
    <head>
      <title>globaltakeover &middot; Register</title>
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
      <div id="loginbox" style="height: 370px;">            
      	<form id="loginform" class="form-vertical" action="register.php" method="POST">
	      	<p id="regtext">
		      	<div class="alert alert-info">You currently must have a valid invitation code to register!</div>
		      	<noscript>
		      		<div class="alert alert-error">You currently have Javascript turned off! You must enable it to register and use Global Takeover!</div>
		      	</noscript>
	      	</p>
	      	<div class="control-group" id="usernameGroup">
	      		<div class="controls">
		      		<div class="input-prepend" id="ugroup">
			      		<span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Username" name="username" id="username" maxlength="20">
			      	</div>
	      		</div>
	      	</div>
	      	<div class="control-group" id="emailGroup">
	      		<div class="controls">
		      		<div class="input-prepend" id="egroup">
			      		<span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="Email" name="email" id="email" maxlength="50">
			      	</div>
			      </div>
	      	</div>
	      	<div class="control-group passwordGroup">
	      		<div class="controls">
		      		<div class="input-prepend">
			      		<span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="Enter Password" name="password1" id="password1" maxlength="40">
			      	</div>
	      		</div>
	      	</div>
	      	<div class="control-group passwordGroup">
	      		<div class="controls">
		      		<div class="input-prepend" id="pgroup">
			      		<span class="add-on"><i class="icon-lock"></i></span><input placeholder="Confirm Password" type="password" name="password2" id="password2" maxlength="40">
			      	</div>
	      		</div>
	      	</div>
	      	<div class="control-group">
	      		<div class="controls">
		      		<div class="input-prepend">
			      		<span class="add-on"><i class="icon-certificate"></i></span><input placeholder="Invitation Code" type="text" name="refer" id="refer" maxlength="20">
			      	</div>
	      		</div>
	      	</div>
	      	<div class="form-actions">
	      		<span class="pull-left"><a href="tos.php" target="_blank">Terms of Service</a></span>
		      	<span class="pull-right">
		      		<button name="Submit" type="submit" class="btn btn-inverse" id="submit" value="Register">Register</button>
		      	</span>
	      	</div>
	      </form>
      </div>
	
	<script src="themes/js/jquery.min.js"></script>  
  <script src="themes/js/unicorn.login.js"></script> 
  <script>
$(document).ready(function() {
	$('#submit').click(function () {
		var username = $("#username").val();
				email = $("#email").val();
				pass = $("#password1").val();
				cpass = $("#password2").val();
				code = $("#refer").val();
		$.ajax({
			type: "POST",
			url: "register.php",
			data: { 'Submit': true, 'username':username, 'email':email, 'password1':pass, 'password2':cpass, 'refer':code },
			success: function(data) {
				$('.alert').remove();
				if(data == 'success') {
					window.location.replace("http://www.globaltakeover.net/index.php?reg=true");
				} else {
					$('#regtext').append(data);
				}
			}
		});
		return false;
	});
	$('#username').change(function () {
		$.ajax({
			type: "POST",
			url: "register.php",
			data: { unValidate: $('#username').val() },
			success: function(data) {
				$('#usernameHelp').remove();
				if(data == 'success') {
					$('#usernameGroup').removeClass('error');
				} else {
					$('#ugroup').after('<span class="help-inline" id="usernameHelp">Username is already in use.</span>');
					$('#usernameGroup').removeClass('success');
				}
				$('#usernameGroup').addClass(data);
			}
		});
	});
	$('#email').change(function () {
		$('#emailHelp').remove();
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		if(pattern.test($('#email').val())) {
			$('#emailGroup').removeClass('error');
			$('#emailGroup').addClass('success');
		} else {
			$('#egroup').after('<span class="help-inline" id="emailHelp">Email is invalid.</span>');
			$('#emailGroup').removeClass('success');
			$('#emailGroup').addClass('error');
		}
	});
	$('#password1,#password2').change(function () {
		$('#passwordHelp').remove();
		if($('#password1').val() == $('#password2').val()) {
			$('.passwordGroup').removeClass('error');
			$('.passwordGroup').addClass('success');
		} else {
			$('#pgroup').after('<span class="help-inline" id="passwordHelp">Passwords do not match.</span>');
			$('.passwordGroup').removeClass('success');
			$('.passwordGroup').addClass('error');
		}
	});
});
</script>
</body>
</html>