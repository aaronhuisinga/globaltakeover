<?php
$title="Register";
include ("members/config.php");
require_once("members/header.php");

define('globaltakeover', '149728418418719');
define('secretcode', '7d1ad06c104a624f4a146be116d221ef');

function get_facebook_cookie($app_id, $app_secret) {
  $args = array();
  parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
  ksort($args);
  $payload = '';
  foreach ($args as $key => $value) {
    if ($key != 'sig') {
      $payload .= $key . '=' . $value;
    }
  }
  if (md5($payload . $app_secret) != $args['sig']) {
    return null;
  }
  return $args;
}
$cookie = get_facebook_cookie(globaltakeover, secretcode);
$user = json_decode(file_get_contents(
    'https://graph.facebook.com/me?access_token=' .
    $cookie['access_token']));
?>
<script type="text/javascript" src="members/liveval.js"></script>
<script type="text/javascript" src="members/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#usernameLoading').hide();
	$('#username').keyup(function(){
	  $('#usernameLoading').show();
      $.post("check.php", {
        username: $('#username').val()
      }, function(response){
        $('#usernameResult').fadeOut();
        setTimeout("finishAjax('usernameResult', '"+escape(response)+"')", 400);
      });
    	return false;
	});
});

function finishAjax(id, response) {
  $('#usernameLoading').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} //finishAjax
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#referLoading').hide();
	$('#refer').keyup(function(){
	  $('#referLoading').show();
      $.post("refcheck.php", {
        refer: $('#refer').val()
      }, function(response){
        $('#referResult').fadeOut();
        setTimeout("finishAjax2('referResult', '"+escape(response)+"')", 400);
      });
    	return false;
	});
});

function finishAjax2(id, response) {
  $('#referLoading').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} //finishAjax
</script>
<div id="gtinfo" align="center">
<h2 align="center">Complete Facebook Registration</h2>
<form action="members/register.php" method="post">
<b>You currently must have a valid invitation code to register!</b><br />
<b>You're almost done registering! Just choose a username and a password to finish.</b>
<noscript><b>You currently have Javascript turned off! You must enable it to register and use Global Takeover!</b></noscript>
<table>
	<tr><td align="right">Username:</td> <td><input type="text" name="username" id="username" size="30" maxlength="20" value="" />
					<script type="text/javascript">var username = new LiveValidation('username');username.add(Validate.Length, { minimum: 3 }, Validate.Presence );username.add( Validate.Presence );</script>
					<br /> <span id="usernameLoading"><img src="images/spinner.gif" /></span>
					<span id="usernameResult"></span></td></tr>
	<tr><td align="right">Password:</td> <td><input type="password" name="password1" id="password1"  size="30" maxlength="40" />
					<script type="text/javascript">var password1 = new LiveValidation('password1');password1.add(Validate.Length, { minimum: 6 } );password1.add( Validate.Presence );</script></td></tr>
	<tr><td align="right">Confirm password:</td> <td><input type="password" name="password2" id="password2" size="30" maxlength="40" />
					<script type="text/javascript">var password2 = new LiveValidation('password2');password2.add(Validate.Confirmation, { match: 'password1'} );password2.add( Validate.Presence );</script></td></tr>
	<tr><td align="right">Invitation Code:</td> <td><input type="text" name="refer" id="refer" size="30" maxlength="20" />
					<br /> <span id="referLoading"><img src="images/spinner.gif" /></span>
					<span id="referResult"></span></td></tr>
</table>
<p><input name="Submit" type="submit" class="submit" id="submit" value="Register!" /></p>
<input type="hidden" name="email" id="email" value="<?= $user->email ?>" />
<input type="hidden" name="facebook" id="facebook" value="<?= $user->id ?>" />
<input type="hidden" name="submitted" id="submitted" value="TRUE" />
</form><br />
<? /*If this form does not work for you, go <a href="registerie.php">here</a> to register.<br />*/ ?>
By registering, you agree that you have read and agreed to the <a href="tos.php">Terms of Service</a>.
</div>
<? include("members/footer.php"); ?>