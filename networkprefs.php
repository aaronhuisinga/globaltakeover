<?php
require_once("members/config.php");
checks();
online();
$res=$mysqli->query("SELECT `corps` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$network=$res->fetch_array();
$res=$mysqli->query("SELECT `name` FROM Corps WHERE id='$network[0]' LIMIT 1");
$row=$res->fetch_array();
$netname=$row[0];
$title="$netname > Management";

$res=$mysqli->query("SELECT `owner`, `co`, `leftl`, `rightl`, `leftro`, `rightro` FROM `Corps` WHERE id='$network[0]' LIMIT 1;");
$staffrow=$res->fetch_assoc();
$staff=array($staffrow['owner'],$staffrow['co']);
// Get the usernames of the leaders
$names=array($staffrow['co'],$staffrow['leftl'],$staffrow['rightl'],$staffrow['leftro'],$staffrow['rightro']);
$sname=array();
foreach($names as $x) {
	$res=$mysqli->query("SELECT username FROM Players WHERE `id` = '$x' LIMIT 1");
	$uname=$res->fetch_array();
	array_push($sname, $uname[0]);
}

if (in_array($_COOKIE['id'], $staff)) {
	if(isset($_POST['kick'])) {
		$res=$mysqli->query("SELECT `id` FROM Players WHERE `username`='$_POST[kick]' AND `corps`='$network[0]' LIMIT 1;");
		if($res->num_rows > 0) {
			$row=$res->fetch_array();
			if($staffrow['owner'] == $row[0]) {
				echo '<div class="alert alert-error"><span class="label label-important">Error!</span> You cannot kick the owner of the network.</div>';
				exit();
			} else if($_COOKIE['id'] == $row[0]) {
				echo '<div class="alert alert-error"><span class="label label-important">Error!</span> You cannot kick yourself.</div>';
				exit();
			}
			$mysqli->query("UPDATE `Players` SET `corps` = 'None' WHERE `username`='$_POST[kick]' LIMIT 1;");
			$mysqli->query("UPDATE `Corps` SET `members` = (`members`-1) WHERE `id` = '$network[0]' LIMIT 1");
			if (in_array($row[0], $names)) {
				$mysqli->query("UPDATE `Corps` SET `co` = '0' WHERE `co` = '$row[0]' LIMIT 1;");
				$mysqli->query("UPDATE `Corps` SET `leftl` = '0' WHERE `leftl` = '$row[0]' LIMIT 1;");
				$mysqli->query("UPDATE `Corps` SET `rightl` = '0' WHERE `rightl` = '$row[0]' LIMIT 1;");
				$mysqli->query("UPDATE `Corps` SET `leftro` = '0' WHERE `leftro` = '$row[0]' LIMIT 1;");
				$mysqli->query("UPDATE `Corps` SET `rightro` = '0' WHERE `rightro` = '$row[0]' LIMIT 1;");
			}
			echo '<div class="alert alert-success"><span class="label label-success">Success</span> Successfully kicked '.$_POST['kick'].' from your network.</div>';
		} else {
			echo '<div class="alert alert-error"><span class="label label-important">Error!</span> The player that you entered does not exist, or is not a part of your network.</div>';
		}
		exit();
	} else if(isset($_POST['promote'])) {
		$res=$mysqli->query("SELECT `id` FROM Players WHERE `username`='$_POST[promote]' AND `corps`='$network[0]' LIMIT 1;");
		if($res->num_rows > 0) {
			$user=$res->fetch_array();
			$res2=$mysqli->query("SELECT `$_POST[position]` FROM `Corps` WHERE `id`='$network[0]' LIMIT 1;");
			$pos=$res2->fetch_array();
			// Properly give away the Network
			if($_POST['position'] == 'owner') {
				$check=$mysqli->query("SELECT `id` FROM `Corps` WHERE `owner`='$user[0]' LIMIT 1;");
				if($staffrow['owner'] == $_COOKIE['id'] AND $check->num_rows == 0) {
					$mysqli->query("UPDATE `Corps` SET `owner` = '$user[0]' WHERE `id`='$network[0]' LIMIT 1;");
					echo '<div class="alert alert-success"><span class="label label-success">Success!</span> You successfully gave the network to '.$_POST['promote'].'.</div>';
				} else {
					echo '<div class="alert alert-error"><span class="label label-important">Error!</span> You are unable to give the network to '.$_POST['promote'].'.</div>';
				}
				exit();
			}
			// Promote players to other positions
			if($pos[0] != '0') {
				echo '<div class="alert alert-error"><span class="label label-important">Error!</span> You must demote the current position before promoting another user to it.</div>';
				exit();
			}
			$mysqli->query("UPDATE `Corps` SET `$_POST[position]` = '$user[0]' WHERE `id`='$network[0]' LIMIT 1;");
			echo '<div class="alert alert-success"><span class="label label-success">Success</span> Successfully promoted '.$_POST['promote'].'.</div>';
		} else {
			echo '<div class="alert alert-error"><span class="label label-important">Error!</span> The player that you entered does not exist, or is not a part of your network.</div>';
		}
		exit();
	} else if(isset($_POST['demote'])) {
		$mysqli->query("UPDATE `Corps` SET `$_POST[demote]` = '0' WHERE `id`='$network[0]' LIMIT 1;");
		echo '<div class="alert alert-success"><span class="label label-success">Success</span> Successfully demoted the user.</div>';
		exit();
	}
require_once("members/header.php");
?>
	<div class="page-header"><h1>Network Management</h1></div>
	
	<ul class="nav nav-pills" id="manage">
	  <li class="active">
	    <a href="#kicktab" data-toggle="tab">Kick Member</a>
	  </li>
	  <li><a href="#promotetab" data-toggle="tab">Promote Member</a></li>
	  <li><a href="#demotetab" data-toggle="tab">Demote Member</a></li>
	</ul>
	
	<div class="tab-content">
		<div id="kicktab" class="tab-pane active well">
			<legend>Kick Member</legend>
			<form method="post" action="networkprefs.php">
				<label for="kickp">Username</label>
				<? 
				echo "<input autocomplete=\"off\" type=\"text\" id=\"uname\" name=\"uname\" class=\"span11\" style=\"margin: 0 auto;\" data-provide=\"typeahead\" data-items=\"4\" data-source=\"";
			  $res=$mysqli->query("SELECT username FROM Players WHERE `corps` = '$network[0]' ORDER BY username ASC");
			  $users='[';
			  while($row=$res->fetch_assoc()) {
			  $users.="&quot;".$row['username']."&quot;,";
			  }
			  $users=substr($users,0,-1);
			  $users.="]";
			  echo $users."\">";
		  	?>
		  	<br><br>
				<input class="btn btn-success" id="kick" type="submit" name="submit" value="Kick">
			</form>
		</div>
		
		<div id="promotetab" class="tab-pane well">
			<legend>Promote Member</legend>
			<? if($_COOKIE['id'] == $staffrow['owner']) { ?>
			<div class="alert"><span class="label label-warning">Warning!</span> Promoting a member to Leader will give them the Network!</div>
			<? } ?>
			<form method="post" action="networkprefs.php">
  			<label for="promote">Username</label>
				<? 
				echo "<input autocomplete=\"off\" type=\"text\" id=\"promote\" name=\"promote\" class=\"span11\" style=\"margin: 0 auto;\" data-provide=\"typeahead\" data-items=\"4\" data-source=\"";
			  $res=$mysqli->query("SELECT username FROM Players WHERE `corps` = '$network[0]' ORDER BY username ASC");
			  $users='[';
			  while($row=$res->fetch_assoc()) {
			  $users.="&quot;".$row['username']."&quot;,";
			  }
			  $users=substr($users,0,-1);
			  $users.="]";
			  echo $users."\">";
		  	?>
		  	<label for="pposition">Position</label>
			  <select name="pposition" id="pposition">
  				<option value="rightro">2nd Recruiter</option>
  				<option value="leftro">1st Recruiter</option>
  				<option value="rightl">2nd Officer</option>
  				<option value="lleftl">1st Officer</option>
  				<option value="co">Co-Leader</option>
  				<option value="owner">Leader</option>
				</select>
				<br>
				<input type="submit" id="promotebtn" class="btn btn-success" name="submit" value="Promote">
			</form>
		</div>
		
		<div id="demotetab" class="tab-pane well">
			<legend>Demote Member</legend>
			<form method="post" action="demote.php">
		  	<label for="demote">Position</label>
			  <select name="demote" id="demote">
  				<? if($names[4] != '0') { echo "<option value=\"rightro\">$sname[4] (2nd Recruiter)</option>"; } ?>
  				<? if($names[3] != '0') { echo "<option value=\"leftro\">$sname[3] (1st Recruiter)</option>"; } ?>
  				<? if($names[2] != '0') { echo "<option value=\"rightl\">$sname[2] (2nd Officer)</option>"; } ?>
  				<? if($names[1] != '0') { echo "<option value=\"leftl\">$sname[1] (1st Officer)</option>"; } ?>
  				<? if($names[0] != '0') { echo "<option value=\"co\">$sname[0] (Co-Leader)</option>"; } ?>
				</select>
				<br>
				<input type="submit" id="demotebtn" class="btn btn-success" name="submit" value="Demote">
			</form>
		</div>
	</div>
	
	<script type='text/javascript'>
	$(document).ready(function (){
		$('#kick').click(function () {
			var user = $('#uname').val();
			$.ajax({
	    	url: 'networkprefs.php',
	      data: {'kick':user},
	      type: 'POST',
	      async: false,
	      success:  function(html){
	      	$('.alert').remove();
	      	$('#uname').val('');
	      	$('#manage').before(html);
	      }
	    });
	    return false;
		});
		$('#promotebtn').click(function () {
			var user = $('#promote').val();
					position = $('#pposition').val();
			$.ajax({
	    	url: 'networkprefs.php',
	      data: {'promote':user,'position':position},
	      type: 'POST',
	      async: false,
	      success:  function(html){
	      	$('.alert').remove();
	      	$('#promote').val('');
	      	$('#manage').before(html);
	      }
	    });
	    return false;
		});
		$('#demotebtn').click(function () {
			var position = $('#demote').val();
			$.ajax({
	    	url: 'networkprefs.php',
	      data: {'demote':position},
	      type: 'POST',
	      async: false,
	      success:  function(html){
	      	$('.alert').remove();
	      	$('#manage').before(html);
	      }
	    });
	    return false;
		});
	});
	</script>
	
<? 
} else {
	echo '<div class="alert alert-error">You do not own a Network.</div>';
}
require_once("members/footer.php");
exit();
?>