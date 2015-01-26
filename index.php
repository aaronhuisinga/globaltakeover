<?php 
if (!isset($_COOKIE['id'])) {$title="Login";} else {$title="Home";}
require_once("members/config.php");

define('globaltakeover', '149728418418719');
define('secretcode', '7d1ad06c104a624f4a146be116d221ef');

if (!isset($_COOKIE['id'])) {
function headers() {
	?>
	<!DOCTYPE html>
  <html lang="en">
    <head>
      <title>globaltakeover &middot; Login</title>
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
    	<? if(isset($_GET['reg'])) {
	    	echo "<div id=\"regtext\" class=\"alert alert-success\">
	    				<h4 class=\"alert-heading\">Successfully registered!</h4>
	    				Check the email you entered for your validation link to complete the process.</div>";
    	}
    	?>
      <div id="loginbox">            
      	<form id="loginform" class="form-vertical" action="index.php" method="POST">
	<?
	}
	if(isset($_POST['submit'])) {
		$sessauth=rand(100000000, 999999999);
		if(isset($_POST['stay'])) { $stay=$_POST['stay']; }
		$stmt=$pdo->prepare('SELECT `id`,`theme`,`corps` FROM `Players` WHERE `username`= :user AND `password`=SHA(:pass) AND `active` IS NULL LIMIT 1');
		$stmt->bindParam(':user', $_POST['uname'], PDO::PARAM_STR);
		$stmt->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$id=$row['id'];
		$res=$mysqli->query("SELECT `name` FROM `Corps` WHERE `id`='$row[corps]' LIMIT 1");
		$network=$res->fetch_array();
		if($row['theme'] == null) { $row['theme']='bootstrap'; }
		if(empty($_POST['uname'])) {
			headers();
			echo "<div class=\"alert alert-error\">You must enter a valid username.</div>";
		} elseif (empty($_POST['password'])) {
			headers();
			echo "<div class=\"alert alert-error\">You must enter a valid password.</div>";
		} elseif ($stmt->rowCount() == 0) {
			headers();
			echo "<div class=\"alert alert-error\">The username or password that you entered was incorrect.</div>";
		} else {
			$stmt=$pdo->prepare('UPDATE Players SET Laston = :date, sessauth = :auth WHERE id = :id LIMIT 1');
			$stmt->bindParam(':date', $date, PDO::PARAM_STR);
			$stmt->bindParam(':auth', $sessauth, PDO::PARAM_INT);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			if(isset($stay)) { 
				setcookie ('id', $row['id'], time()+60*60*24*10, '/');
				setcookie ('authkey', $sessauth, time()+60*60*24*10, '/');
				setcookie ('username', $_POST['uname'], time()+60*60*24*10, '/');
				setcookie ('theme', $row['theme'], time()+60*60*24*10, '/');
				setcookie ('network', $network[0], time()+60*60*24*10, '/');
			} else {
				setcookie ('id', $row['id'], time()+60*60*24, '/');
				setcookie ('authkey', $sessauth, time()+60*60*24, '/');
				setcookie ('username', $_POST['uname'], time()+60*60*24, '/');
				setcookie ('theme', $row['theme'], time()+60*60*24, '/');
				setcookie ('network', $network[0], time()+60*60*24, '/');
			}
			header("Location: index.php");
			exit();
		}
	} else {
		headers();
	}
	?>
					<p class="text-error"><strong>Registration is currently closed.</strong></p>
          <div class="control-group">
          	<div class="controls">
            	<div class="input-prepend">
              	<span class="add-on"><i class="icon-user"></i></span><input type="text" name="uname" id="uname" placeholder="Username" />
              </div>
            </div>
          </div>
          <div class="control-group">
          	<div class="controls">
            	<div class="input-prepend">
              	<span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password" id="password" placeholder="Password" />
              </div>
            </div>
          </div>
          <div class="form-actions">
          	<span class="pull-left"><a href="#" class="flip-link" id="to-recover">Lost password?</a></span>
            <span class="pull-right"><input type="submit" class="btn btn-inverse" name="submit" value="Login" /></span>
          </div>
        </form>
        
        <form id="recoverform" action="lostpass.php" method="post" class="form-vertical">
          <p id="recovertext">Enter your information below and we will send you instructions for recovering your password.</p>
          <div class="control-group">
          	<div class="controls">
            	<div class="input-prepend">
              	<span class="add-on"><i class="icon-user"></i></span><input type="text" name="username" id="username" placeholder="Username" />
              </div>
            </div>
          </div>
          <div class="control-group">
          	<div class="controls">
            	<div class="input-prepend">
              	<span class="add-on"><i class="icon-envelope"></i></span><input type="text" name="email" id="email" placeholder="Email address" />
              </div>
            </div>
          </div>
          <span class="form-inline" id="security">
	        <img src="members/CaptchaSecurityImages.php?width=100&height=40&characters=4" alt="captcha" style="margin-top: -14px; margin-bottom: 8px;">
	        <br>
	        <div class="input-prepend">
	        	<span class="add-on"><i class="icon-lock"></i></span><input placeholder="Security Code" id="code" name="security_code" type="text" maxlength="4" />
	        </div>
          <div class="form-actions">
          	<span class="pull-left"><a href="#" class="flip-link" id="to-login">&lt; Back to login</a></span>
            <span class="pull-right"><input type="submit" id="recover" name="recover" class="btn btn-inverse" value="Recover" /></span>
          </div>
        </form>
      </div>
      
      <div id="loginfoot">
      	<div class="btn-group pull-right">
      		<a class="btn btn-small" href="register.php">Register</a><a class="btn btn-small" href="mailto:support@globaltakeover.net">Contact Us</a>
      	</div>
      </div>
        
      <script src="themes/js/jquery.min.js"></script>  
      <script src="themes/js/unicorn.login.js"></script> 
      <script>
      	$(document).ready(function (){
      		$('#recover').click(function () {
						var user = $('#username').val();
								email = $("#email").val();
								captcha = $("#code").val();
						$.ajax({
				    	url: 'lostpass.php',
				      data: {'username':user,'email':email,'security_code':captcha,'recover':true},
				      type: 'POST',
				      async: false,
				      success:  function(html){
				      	$('#recovertext').empty();
				      	$('#recovertext').append(html);
				      	$("#username").val('');
				      	$("#email").val('');
				      	$("#code").val('');
				      },
				      error:  function(html){
				    		alert("Failed to pull up address.");
				      }
				    });
				    return false;
					});
      	});
      </script>
    </body>
</html>
<?
} else {
checks();
online();
require_once("members/header.php");
$title="Home";
$stmt=$pdo->prepare('UPDATE Players SET lastip = :lip WHERE id = :id LIMIT 1');
$stmt->bindParam(':lip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
$stmt->execute();
$res=$mysqli->query("SELECT SUM(`money`), COUNT(`id`), SUM(`exp`) FROM `Players` WHERE `health` > 0 AND `Level` = '0'");
$gstats=$res->fetch_array();
$res=$mysqli->query("SELECT COUNT(`id`) FROM `Players` WHERE `Level` = '0'");
$tplayers=$res->fetch_array();
?>	   	 
<div id="content-header"><h1>Home</h1></div>
<div id="breadcrumb">
	<a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
	<a href="#" class="current">Dashboard</a>
</div>
<div class="container-fluid gplay">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box widget-plain">
				<div class="widget-content center">
					<ul class="stats-plain">
						<li>										
							<h4><? echo number_format($tplayers[0]); ?></h4>
							<span>Total Users</span>
						</li>
						<li>										
							<h4><? echo number_format($gstats[1]); ?></h4>
							<span>Alive Users</span>
						</li>
						<li>										
							<h4>$<? echo number_format($gstats[0]); ?></h4>
							<span>Total Money</span>
						</li>
						<li>										
							<h4><? echo number_format($gstats[2]); ?></h4>
							<span>Exp Earned</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<br>
	<table class="table table-striped table-bordered">
	<thead><tr><th>Global Takeover Relaunch CLOSED BETA - August 10, 2012</th></tr></thead>
	<tbody><tr><td>Let me be the first to welcome everyone back!<br />
	I've somehow managed to find time to get the game back up, and will be slaving away over the next month or so coding in ridiculous amounts to get GTO back up and running.<br />
	We're currently in a closed beta period, dedicated to all my old friends (and their friends) that are willing to help test the game, make suggestions, and really have a voice in shaping this game.<br />
	Everyone reading this is able to invite their own friends that wish to help, but PLEASE only invite people that wish to help get the site running!<br />
	Invite your friends with the following code: gt0b3ta2012<br /><br />
	We're glad to have you all here, and welcome back!</td>
	</tr></tbody></table>
	
	<table class="table table-striped table-bordered">
	<thead><tr><th>Global Takeover 1.3 is LIVE! - April 18, 2009</th></tr></thead>
	<tbody><tr><td align="center">Well, I've just completed the biggest changes made to the game to date!<br />
	With this new version of the game comes a loooooong list of new features and bug fixes!<br/>
	- Completely re-designed layout. We have now ditched frames completely, making so many more themes and ideas possible!<br />
	- Brand new notifications system: You can now close notifications by clicking on them, and can now be notified about multiple events and one time!<br />
	- All pages now have their own titles, and every page can now be linked to directly.<br />
	- Fixed numerous bugs throughout different areas of the site.<br /><br />
	I apologize for how long the site was down for, but during the extra time I was able to complete many things that needed to be done!<br />
	I'm sure that quite a few bugs still exist, so if you come across any please inform me so that I can get them fixed up.</td>
	</tr></tbody></table>
</div>
<?
}
require_once("members/footer.php");
?>