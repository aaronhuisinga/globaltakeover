<?php
$title="Profile Editor";
require_once("members/config.php");
checks();
online();

if (isset($_POST['theme'])) {
	if ($_POST['theme'] == NULL) {
		echo '<div class="alert alert-error">You must select a theme.</div>';
	} else {
		setcookie ('theme', $_POST['theme'], time()+60*60*24*10, '/');
		$mysqli->query("UPDATE `Players` SET `theme`='$_POST[theme]' WHERE `id`='$_COOKIE[id]' LIMIT 1");
		echo '<div class="alert alert-success">Successfully changed your theme!</div>';
	}
	exit();
} else {
	require_once("members/header.php");
}

if(isset($_POST['avatar'])) {
	function getExtension($str) {
		$i=strrpos($str,".");
		if (!$i) { return ""; }
		$l=strlen($str) - $i;
		$ext=substr($str,$i+1,$l);
		return $ext;
	}
	$image=$_POST['avatar'];
	$extension=strtolower(getExtension($image));
	
	if (!isset($image)) {
		echo '<div class="alert alert-error">You must choose an image for your avatar.</div>';
	} elseif (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
		echo '<div class="alert alert-error">You type of image you chose is not supported.</div>';
	} else {
		$mysqli->query("UPDATE `Players` SET `avatar`='$image' WHERE id='$_COOKIE[id]' LIMIT 1");
		echo '<div class="alert alert-success">Successfully changed your avatar.</div>';
	}
} elseif (isset($_POST['profile'])) {
	require_once("members/striphtml.php");
	$pro=stripHTML($_POST['profile']);
	$mysqli->query("UPDATE Players SET Profile='$pro' WHERE id='$_COOKIE[id]' LIMIT 1");
	echo '<div class="alert alert-success">Successfully changed your profile.</div>';
} elseif (isset($_POST['filter'])) {
	if ($_POST['filter'] == NULL) {
		echo '<div class="alert alert-error">You must select an option.</div>';
	} else {
		if ($_POST['filter'] == 'on') {
			$mysqli->query("UPDATE Players SET censor='yes' WHERE id ='$_COOKIE[id]' LIMIT 1");
			echo '<div class="alert alert-success">The language filter is now active.</div>';
		} else {
			$mysqli->query("UPDATE Players SET censor='' WHERE id ='$_COOKIE[id]' LIMIT 1");
			echo '<div class="alert">The language filter is no longer active.</div>';
		}
	}
} elseif (isset($_POST['password1'])) {
	$res=$mysqli->query("SELECT `id`, `email` FROM Players WHERE id='$_COOKIE[id]' AND password=SHA1('$_POST[current]') LIMIT 1");
	$row=$res->fetch_assoc();
	if (!isset($_POST['current']) OR !isset($_POST['password1']) OR !isset($_POST['password2'])) {
		echo '<div class="alert alert-error">You must fill in all the required fields.</div>';
	} elseif ($_POST['password1'] != $_POST['password2']) {
		echo '<div class="alert alert-error">You new passwords you entered do not match.</div>';
	} elseif ($res->num_rows == 0) {
		echo '<div class="alert alert-error">The current password you entered is incorrect.</div>';
	} else {
		$mysqli->query("UPDATE Players SET password=SHA('$_POST[password1]') WHERE id='$_COOKIE[id]' LIMIT 1");
		echo '<div class="alert alert-success">Your password was changed successfully!</div>';
		// Set headers (Specify HTML email, From address)
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Global Takeover <support@globaltakeover.net>' . "\r\n";
		// Set subject
		$subject = 'Global Takeover Password Change';
		$body = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
					<html>
					<head>
  						<title>Global Takeover Password Change</title>
  						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
					</head>
					<body>
  						<p>Hey $_COOKIE[username],<br> 
  						We are sending you this email to let you know that your password was recently changed at Global Takeover.<br>
  						If you were not responsible for this change, please contact us immediately to regain access to your account.<br>
  						Otherwise, feel free to delete this email.<br><br>
  						Sincerely,<br>
  						- The GTO Staff.
					</body>
					</html>";
		// Mail it
		mail ($row['email'], $subject, $body, $headers);
	}
}

$res=$mysqli->query("SELECT Profile, avatar FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_array();
$pro=stripslashes($row[0]);
$id=$_COOKIE['id'];
$avatar=$row[1];
?>

<script type="text/javascript" src="members/nicEdit.js"></script> <script type="text/javascript">
bkLib.onDomLoaded(
   function() {
      var niceditor = new nicEditor();
      var niceditorpanel = new nicEditor({
            iconsPath : 'members/nicEditorIcons.gif',
            buttonList : ['bold','italic','underline','strikethrough','removeformat','ol','ul','image','link','unlink','fontSize','forecolor','bgcolor'],
            bbCode : false,
            xhtml : true
      }).panelInstance('area1');
                               
      niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
    }
)
</script>

<div id="content-header"><h1>Preferences</h1></div>
<div id="breadcrumb">
	<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
	<a href="#" class="current">Preferences</a>
</div>
<br>
<div class="container-fluid gplay">
<ul class="nav nav-pills">
  <li class="active">
    <a href="#avatar" data-toggle="tab">Change Your Avatar</a>
  </li>
  <li><a href="#censor" data-toggle="tab">Language Censor</a></li>
  <li><a href="#theme" data-toggle="tab">Change Theme</a></li>
  <li><a href="#password" data-toggle="tab">Change Password</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active well" id="avatar">
	<legend>Current Avatar</legend>
	<img src="<? echo $avatar; ?>" height="80px" width="80px" class="img-rounded">
	<p><strong>Avatar source:</strong> <? echo $avatar; ?></p>
	<legend>Change Your Avatar</legend>
    <p>Image types allowed: .jpg, .jpeg, .gif, .png<br />
	<strong>Note: As of now, all avatars are automatically resized to 80x80 in forums and profile! 
	For your avatar to be clear, make sure it is very close to that size!</strong>
    <form name="newad" method="post" action="prefs.php">
    	<label for="avatar">Image URL</label>
	    <input type="text" name="avatar" id="avatar">
	    <br>
	    <input class="btn btn-success" name="Submit" type="submit" value="Submit">
    </form>
  </div>
  <div class="tab-pane well" id="censor">
  	<legend>Language Censor</legend>
  	<form method="post" action="prefs.php">
		<label class="checkbox">On <input type="radio" name="filter" value="on" /></label>
		<label class="checkbox">Off <input type="radio" name="filter" value="off" /></label>
		<br>
		<input class="btn btn-success" type="submit" name="submit" value="Submit">
	</form>
  </div>
  <div class="tab-pane well" id="theme">
  	<legend>Theme Change</legend>
	<form method="post" action="prefs.php">
		<select name="theme" id="themeSel">
		  <option value="grey">Grey (default)</option>
		  <option value="red">Red</option>
		  <option value="blue">Blue</option>
		</select>
		<br>
		<input class="btn btn-success" id="themeBtn" type="submit" name="submit" value="Submit">
	</form>
  </div>
  <div class="tab-pane well" id="password">
	<legend>Change Password</legend>
	<form method="post" action="prefs.php">
		<label for="current">Current Password</label>
		<input type="password" name="current" maxlength="40">
		<label for="new">New Password</label>
		<input type="password" name="password1" maxlength="40">
		<label for="confirm">Confirm password</label>
		<input type="password" name="password2" maxlength="40">
		<br>
		<input class="btn btn-success" type="submit" name="submit" value="Change">
	</form>
  </div>
</div>

<legend>Edit Your Profile</legend>
<p><a href="/Faq.php#A45">Learn Profile BBCode</a></p>
<form method="post" action="prefs.php">
	<textarea id="area1" name="profile" class="span12" rows="15"><? echo $pro; ?></textarea>
	<br>
	<input class="btn btn-success" type="submit" name="submit" value="Submit">
</form>

<script>
	$(document).ready(function() {
		$('#themeBtn').click(function() {
			var style = $("#themeSel").val();
			$.ajax({
	  		url: "prefs.php",
	  		data: {'theme':style},
	  		type: "POST",
	  		async: false,
	  		success:  function(html){
	  			$("#content-header").before(html);
	  			$('.skin-color').attr('href','themes/css/unicorn.'+style+'.css');
	  		}
	  	});
	  	return false;
		});
	});
</script>
<? include("members/footer.php"); ?>