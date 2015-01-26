<?php
require_once("members/config.php");
checks();
online();
if(isset($_POST['applya'])) {
	if($_POST['applya'] == 'Accept') {
		$res=$mysqli->query("SELECT `network` FROM `invite` WHERE `uid`='$_COOKIE[id]' LIMIT 1");
		$row=$res->fetch_array();
		$id=$row[0];
		$mysqli->query("UPDATE `Players` SET `corps`='$id' WHERE `id`='$_COOKIE[id]' LIMIT 1");
		$mysqli->query("UPDATE `Corps` SET `members`=(`members`+1) WHERE `id`='$id' LIMIT 1");
	}
	$mysqli->query("DELETE FROM `invite` WHERE `uid`='$_COOKIE[id]' LIMIT 1");
} else if(isset($_POST['apply'])) {
	if($_POST['apply'] == 'Cancel') {
		$mysqli->query("DELETE FROM `recruit` WHERE `uid`='$_COOKIE[id]' LIMIT 1");
		echo '<div class="alert alert-success"><span class="label label-success">Success!</span> Your application has been withdrawn.</div>';
		exit();
	}
	$res=$mysqli->query("SELECT * FROM `recruit` WHERE `uid`='$_COOKIE[id] LIMIT 1");
	if($res->num_rows > 0) {
		echo '<div class="alert alert-error"><span class="label label-important">Error!</span> You already have an application pending with a network.</div>';
		exit();
	} else {
		$mysqli->query("INSERT INTO `recruit` (`network`,`uid`) VALUES ('$_POST[network]','$_COOKIE[id]')");
		echo '<div class="alert alert-success"><span class="label label-success">Success!</span> Successfully submitted your application.</div>';
	}
	exit();
}
$res=$mysqli->query("SELECT `corps`, `health` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_array();
$netid=$row[0];
$health=$row[1];
$res=$mysqli->query("SELECT * FROM Corps WHERE id='$netid' LIMIT 1");
$row=$res->fetch_assoc();
$network=$row['name'];
$recruit=$row['recruit'];
$owner=$row['owner'];
$staff=array($row['owner'],$row['co'],$row['leftl'],$row['rightl'],$row['leftro'],$row['rightro']);
// Network recruting scripts
if(isset($_POST['rstatus']) AND in_array($_COOKIE['id'], $staff)) {
	$mysqli->query("UPDATE `Corps` SET `recruit` = '$_POST[rstatus]' WHERE `id` = '$netid' LIMIT 1;");
	if($_POST['rstatus'] == '0') { $status = 'disabled'; } else { $status = 'enabled'; }
	echo '<div class="alert alert-success"><span class="label label-success">Success!</span> Successfully '.$status.' recruiting.</div>';
	exit();
} else if(isset($_POST['recruit']) AND in_array($_COOKIE['id'], $staff)) {
	if($_POST['verdict'] == 'accept') {
		$mysqli->query("UPDATE `Players` SET `corps` = '$netid' WHERE `id` = '$_POST[recruit]' LIMIT 1");
		$mysqli->query("UPDATE `Corps` SET `members` = (`members`+1) WHERE `id` = '$netid' LIMIT 1");
		$mysqli->query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('Network Acceptance', 'Congratulations! You have been accepted into $network!', '$_POST[recruit]', 'Global Takeover', 'unread', '$date', 'no')");
		echo 'success';
	} else {
		$mysqli->query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('Network Update', 'Sorry, but at this time $network has denied your application.', '$_POST[recruit]', 'Global Takeover', 'unread', '$date', 'no')");
		echo 'error';
	}
	$mysqli->query("DELETE FROM `recruit` WHERE `uid` = '$_POST[recruit]' LIMIT 1");
	exit();
} else if(isset($_POST['rinvite']) AND in_array($_COOKIE['id'], $staff)) {
	$res=$mysqli->query("SELECT `corps`,`id` FROM `Players` WHERE `username` = '$_POST[rinvite]' LIMIT 1");
	$row2=$res->fetch_array();
	$check=$mysqli->query("SELECT `id` FROM `invite` WHERE `uid` = '$row2[1]' LIMIT 1");
	if($res->num_rows > 0 AND $row2[0] == 'None' AND $check->num_rows == 0) {
		$mysqli->query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('Network Invitation', '$network has invited you to join them. Click <a href=\"network.php\">here</a> to accept or decline.', '$row2[1]', 'Global Takeover', 'unread', '$date', 'no')");
		$mysqli->query("INSERT INTO `invite` (`uid`,`network`) VALUES ('$row2[1]','$netid')");
		echo '<div class="alert alert-success"><span class="label label-success">Success!</span> Successfully sent an invitation to '.$_POST['rinvite'].'.</div>';
	} else {
		echo '<div class="alert alert-error"><span class="label label-important">Error!</span> The user '.$_POST['rinvite'].' does not exist, is already in a network, or has already been invited to a network</div>';
	}
	exit();
} else if(isset($_POST['leave'])) {
	if(in_array($_COOKIE['id'], $staff)) {
		echo '<div class="alert alert-error"><span class="label label-important">Error!</span> You cannot leave the network while in the structure.</div>';
		exit();
	}
	$damage=rand(1, 50);
	if($health - $damage <= 0) {
		$mysqli->query("UPDATE `Players` SET `health`='0', `dead`='1', `tdeath`='$date', `td`='$current', `corps`='None', `scm`='0' WHERE `id`='$_COOKIE[id]' LIMIT 1;");
		echo '<div class="alert alert-error"><span class="label label-important">Dead</span> You were killed while trying to escape the network.</div>';
		$mysqli->query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('Network Abandonment', '$_COOKIE[username] attempted to leave your network, but was killed while doing so.', '$owner', 'Global Takeover', 'unread', '$date', 'no')");
	} else {
		$mysqli->query("UPDATE `Players` SET `health`=(`health`-$damage), `corps`='None', `scm`='0' WHERE `id`='$_COOKIE[id]' LIMIT 1;");
		echo '<div class="alert alert-success"><span class="label label-success">Success!</span> You successfully left the network, but took '.$damage.' damage in doing so.</div>';
		$mysqli->query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('Network Abandonment', '$_COOKIE[username] left your network. He took $damage damage while doing so.', '$owner', 'Global Takeover', 'unread', '$date', 'no')");
	}
	exit();
} else if(isset($_POST['claim'])) {
	$res=$mysqli->query("SELECT `owner` FROM `Corps` WHERE `id`='$netid' LIMIT 1;");
	$row=$res->fetch_array();
	$nowner=$row[0];
	$res=$mysqli->query("SELECT `health` FROM `Players` WHERE `id`='$nowner' LIMIT 1;");
	$row=$res->fetch_array();
	$ohealth=$row[0];
	require_once("members/header.php");
	if ($ohealth < 1) {
		$res=$mysqli->query("SELECT `id` FROM `Corps` WHERE `owner`='$_COOKIE[id]' LIMIT 1;");
		if ($res->num_rows == 0) {
			$mysqli->query("UPDATE `Corps` SET `owner`='$_COOKIE[id]' WHERE `id`='$netid' LIMIT 1;");
			$mysqli->query("UPDATE `Players` SET `corps`='$netid' WHERE `id`='$_COOKIE[id]' LIMIT 1;");
			echo '<div class="alert alert-success"><span class="label label-success">Success!</span> You successfully claimed the network.</div>';
		} else {
			echo '<div class="alert alert-error"><span class="label label-important">Error!</span> You already lead a network.</div>';
		}
	} else {
		echo '<div class="alert alert-error"><span class="label label-important">Error!</span> The leader of this network is not dead.</div>';
	}
	include("members/footer.php");
	exit();
}
if ($network == '') { $title="Network"; } else { $title="$network"; }
require_once("members/header.php");
prisonCheck();
function userBadges($donor, $online) {
	if ($donor == 1) {echo " <span class=\"label label-info\">VIP</span>";}
	if ($online >= (time()-300)) {echo ' <span class="label label-success">Online</span>';}
}
// Show details for selected network
if(isset($_GET['id'])) {
	$res=$mysqli->query("SELECT * FROM Corps WHERE id='$_GET[id]' LIMIT 1");
	$row=$res->fetch_assoc();
	function getProf($position,$spot) {
		$mysqli = new mysqli("gtogame.db.9808275.hostedresource.com", "gtogame", "D7Awthkp2946!", "gtogame", 3306);
		$res=$mysqli->query("SELECT `username`,`avatar`,`donor`,`online` FROM Players WHERE id = '$position' LIMIT 1");
		$row=$res->fetch_array();
		echo "<div class=\"span6 well well-small\">
					<div class=\"row-fluid\">
						<div class=\"span2\"><img class=\"img-rounded\" height=\"70px\" width=\"70px\" src=\"$row[1]\"></div>
						<div class=\"span10\">
							<strong>$spot:</strong><h4 style=\"margin: 0 0 3px 0;\"><a href=\"profile.php?id=$position\">$row[0]</a></h4>";
							userBadges($row['donor'], $row['online']);
						echo "</div>
					</div>
				</div>";
	}
	echo "<div class=\"page-header\"><h1>$row[name] <small>Network information</small></h1></div>";
	?>
	<legend>Network Leaders</legend>
	<div class="row-fluid">
		<? getProf($row['owner'],'Owner'); ?>
		<? getProf($row['co'],'Co Owner'); ?>
	</div>
	<div class="row-fluid">
		<? getProf($row['leftl'],'1st Officer'); ?>
		<? getProf($row['rightl'],'2nd Officer'); ?>
	</div>
	<div class="row-fluid">
		<? getProf($row['leftro'],'1st Recruiter'); ?>
		<? getProf($row['rightro'],'2nd Recruiter'); ?>
	</div>
	<legend>Network Description</legend>
	<div class="well">
	<? echo $row['Profile']; ?>
	</div>
	<?
	exit();
}

echo "<div class=\"page-header\"><h1>Network <small>"; if($network!='None') { echo $network; } echo "</small></h1></div>";

if(isset($_POST['deposit']) AND (isset($_POST['money']) OR isset($_POST['bullets']) OR isset($_POST['tokens']))) {
	$res=$mysqli->query("SELECT `money`,`bullets`,`tokens` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
	$row=$res->fetch_array();
	if($_POST["$_POST[deposit]"] == '') {
		echo '<div class="alert alert-error"><span class="label label-important">Error</span> You must enter a number greater than 0</div>';
	} elseif($row[$_POST['deposit']] < abs(round($_POST["$_POST[deposit]"]))) {
		echo '<div class="alert alert-error"><span class="label label-important">Error</span> You cannot afford this deposit</div>';
	} else {
		$mysqli->query("UPDATE `Corps` SET `$_POST[deposit]`=(`$_POST[deposit]`+".abs(round($_POST["$_POST[deposit]"])).") WHERE name='$network' LIMIT 1");
		$mysqli->query("UPDATE `Players` SET `$_POST[deposit]`=(`$_POST[deposit]`-".abs(round($_POST["$_POST[deposit]"])).") WHERE id='$_COOKIE[id]' LIMIT 1");
		if ($_POST['deposit'] == 'bullets' OR $_POST['deposit'] == 'tokens') {
			echo '<div class="alert alert-success"><span class="label label-success">Success</span> Deposited '.number_format(abs(round($_POST["$_POST[deposit]"]))).' '.$_POST['deposit'].' into the Network bank</div>';
		} else {
			echo '<div class="alert alert-success"><span class="label label-success">Success</span> Deposited $'.number_format(abs(round($_POST["$_POST[deposit]"]))).' into the Network bank</div>';
		}
	}
} elseif(isset($_POST['withdraw']) AND (isset($_POST['money']) OR isset($_POST['bullets']) OR isset($_POST['tokens']))) {
	$res=$mysqli->query("SELECT `money`,`bullets`,`tokens` FROM `Corps` WHERE name='$network' LIMIT 1");
	$row=$res->fetch_array();
	if($_POST["$_POST[withdraw]"] == '') {
		echo '<div class="alert alert-error"><span class="label label-important">Error</span> You must enter a number greater than 0</div>';
	} elseif($row[$_POST['withdraw']] < abs(round($_POST["$_POST[withdraw]"]))) {
		echo '<div class="alert alert-error"><span class="label label-important">Error</span> '.$network.' cannot afford this withdrawl</div>';
	} else {
		$mysqli->query("UPDATE `Corps` SET `$_POST[withdraw]`=(`$_POST[withdraw]`-".abs(round($_POST["$_POST[withdraw]"])).") WHERE name='$network' LIMIT 1");
		$mysqli->query("UPDATE `Players` SET `$_POST[withdraw]`=(`$_POST[withdraw]`+".abs(round($_POST["$_POST[withdraw]"])).") WHERE id='$_COOKIE[id]' LIMIT 1");
		if ($_POST['withdraw'] == 'bullets' OR $_POST['withdraw'] == 'tokens') {
			echo '<div class="alert alert-success"><span class="label label-success">Success</span> Withdrew '.number_format(abs(round($_POST["$_POST[withdraw]"]))).' '.$_POST['withdraw'].' from '.$network.'</div>';
		} else {
			echo '<div class="alert alert-success"><span class="label label-success">Success</span> Withdrew $'.number_format(abs(round($_POST["$_POST[withdraw]"]))).' from '.$network.'</div>';
		}
	}
} elseif(isset($_POST['transfer']) AND (isset($_POST['money']) OR isset($_POST['bullets']) OR isset($_POST['tokens']))) {
	$res=$mysqli->query("SELECT `money`,`bullets`,`tokens` FROM `Corps` WHERE name='$network' LIMIT 1");
	$row=$res->fetch_array();
	if($_POST["$_POST[transfer]"] == '') {
		echo '<div class="alert alert-error"><span class="label label-important">Error</span> You must enter a number greater than 0</div>';
	} elseif($row[$_POST['transfer']] < abs(round($_POST["$_POST[transfer]"]))) {
		echo '<div class="alert alert-error"><span class="label label-important">Error</span> '.$network.' cannot afford this transfer</div>';
	} else {
		$mysqli->query("UPDATE `Corps` SET `$_POST[transfer]`=(`$_POST[transfer]`-".abs(round($_POST["$_POST[transfer]"])).") WHERE name='$network' LIMIT 1");
		$mysqli->query("UPDATE `Players` SET `$_POST[transfer]`=(`$_POST[transfer]`+".abs(round($_POST["$_POST[transfer]"])).") WHERE username='".$_POST["t$_POST[transfer]"]."' LIMIT 1");
		if ($_POST['transfer'] == 'bullets' OR $_POST['transfer'] == 'tokens') {
			echo '<div class="alert alert-success"><span class="label label-success">Success</span> Transferred '.number_format(abs(round($_POST["$_POST[transfer]"]))).' '.$_POST['transfer'].' to '.$_POST["t$_POST[transfer]"].'</div>';
		} else {
			echo '<div class="alert alert-success"><span class="label label-success">Success</span> Transferred $'.number_format(abs(round($_POST["$_POST[transfer]"]))).' to '.$_POST["t$_POST[transfer]"].'</div>';
		}
	}
} elseif(isset($_GET['page']) AND $_GET['page'] == 'edit') {
	$res=$mysqli->query("SELECT * FROM `Corps` WHERE name='$network' LIMIT 1");
	$row=$res->fetch_assoc();
	$staff=array($row['owner'],$row['co'],$row['leftl'],$row['rightl'],$row['leftro'],$row['rightro']);
	if (!in_array($_COOKIE['id'], $staff)) {
		echo "<div class=\"alert alert-error\">You are not authorized to edit this network's profile</div>";
		exit();
	} else {
		if(isset($_POST['netProfile'])) {
			$mysqli->query("UPDATE `Corps` SET `Profile` = '$_POST[netProfile]' WHERE `name`='$network' LIMIT 1");
			echo "<div class=\"alert alert-success\">Successfully updated the Network Profile</div>";
		} else {
			echo '<script type="text/javascript" src="members/nicEdit.js"></script> <script type="text/javascript">
			bkLib.onDomLoaded(
			   function() {
			      var niceditor = new nicEditor();
			      var niceditorpanel = new nicEditor({
			            iconsPath : \'members/nicEditorIcons.gif\',
			            buttonList : [\'bold\',\'italic\',\'underline\',\'strikethrough\',\'removeformat\',\'ol\',\'ul\',\'image\',\'link\',\'unlink\',\'fontSize\',\'forecolor\',\'bgcolor\'],
			            bbCode : false,
			            xhtml : true
			      }).panelInstance(\'area1\');
			                               
			      niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
			    }
			    
			);
			</script>';
			echo "
			<div class=\"well\">
			<legend>Edit Profile</legend>
			<form method=\"post\" action=\"network.php?page=edit\">
			<textarea id=\"area1\" name=\"netProfile\" class=\"span12\" rows=\"25\">$row[Profile]</textarea>
			<br>
			<input class=\"btn btn-success\" type=\"submit\" name=\"submit\" value=\"Submit\">
			</form></div>";	
			exit();
		}
	}
} elseif(isset($_GET['page']) AND $_GET['page'] == 'name') {
	$res=$mysqli->query("SELECT `money` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
	$row=$res->fetch_array();
	$res=$mysqli->query("SELECT owner FROM Corps WHERE id='$netid' LIMIT 1;");
	$own=$res->fetch_array();
	if ($row['money'] < 5000000) {
		echo '<div class="alert alert-error">You do not have $5,000,000 to change the name.</div>';
	} elseif ($_COOKIE['id'] != $own[0]) {
		echo '<div class="alert alert-error">Only the owner can change the name.</div>';
	} else {
		if(isset($_POST['name']) && (strlen($_POST['name']) > 0) && (strlen($_POST['name']) < 15)) {
			$mysqli->query("UPDATE `Corps` SET `name`='$_POST[name]' WHERE id='$netid' LIMIT 1");
			$mysqli->query("UPDATE `Players` SET `money`=(money-5000000) WHERE id='$_COOKIE[id]' LIMIT 1");
			echo "<div class=\"alert alert-success\">Successfully changed the Network name to $_POST[name].</div>";
		}
	}
}

if($netid == 'None'){
	$res=$mysqli->query("SELECT `network` FROM `invite` WHERE `uid`='$_COOKIE[id]' LIMIT 1");
	$row=$res->fetch_array();
	$id=$row[0];
	$res=$mysqli->query("SELECT `name` FROM `Corps` WHERE `id`='$id' LIMIT 1");
	$row2=$res->fetch_array();
	$name=$row2[0];
	if ($id != NULL AND $stats == 0) {
		echo "<form action=\"network.php\" method=\"POST\">
			  <div class=\"well\">
			  <legend>Network Invitation</legend>
			  <p class=\"lead\">$_COOKIE[username], you have been invited to join $name.</p>
			  <input class=\"btn btn-success\" type=\"submit\" name=\"applya\" value=\"Accept\"> <input class=\"btn btn-danger\" type=\"submit\" name=\"applya\" value=\"Decline\">
			  </div>
			  </form>";
	} else {
		$res=$mysqli->query("SELECT `network` FROM `recruit` WHERE `uid`='$_COOKIE[id]' LIMIT 1");
		$row=$res->fetch_array();
		$id=$row[0];
		$res=$mysqli->query("SELECT `name` FROM `Corps` WHERE `id`='$id' LIMIT 1");
		$row2=$res->fetch_array();
		$name=$row2[0];
		if ($id != NULL) {
			echo "<form action=\"network.php\" method=\"POST\">
			      <div class=\"well\">
			      <legend>Current Application</legend>
			      <p class=\"lead\">$_COOKIE[username], you currently have an application submitted to $name.</p>
			      <input type=\"submit\" class=\"btn btn-warning applyBtn\" name=\"applyBtn\" value=\"Cancel\">
			      </div>
			      </form>";
		} else {
			$res=$mysqli->query("SELECT `name`,`id` FROM `Corps` WHERE `recruit`='1'");
			if ($res->num_rows == 0) {
				echo "<div class=\"alert alert-info\">No Networks are currently recruiting. Please try again later.</div>";
			} else {
				echo"<p class=\"lead\">You are not currently in a Network. If you wish to join one, apply below.</p>
					 <form action=\"network.php\" method=\"POST\" class=\"well\">
					 <legend>Currently Recruiting Networks</legend>
					 <table class=\"table table-striped table-condensed table-bordered\">
					 <thead><tr><th>Name</th><th>Apply</th></tr></thead>
					 <tbody>";
			while ($row=$res->fetch_array()){
				echo "<tr><td>$row[0]</td> <td><input type=\"radio\" name=\"network\" value=\"$row[1]\"></td></tr>";
			}
			echo "</tbody></table>
				  <input class=\"btn btn-success applyBtn\" type=\"submit\" name=\"apply\" value=\"Submit Application\">
				  </form>";
			}
		}
		echo "
			<script type='text/javascript'>
				$(document).ready(function (){
					$('.applyBtn').click(function () {
						var apply = $(this).val();
								network = $('input[name=network]:checked').val();
						$.ajax({
				    	url: 'network.php',
				      data: {'apply':apply,'network':network},
				      type: 'POST',
				      async: false,
				      success:  function(html){
				      	$('#gplay').empty();
				      	$('#gplay').append(html);
				      }
				    });
				    return false;
					});
				});
				</script>";
	}
	require_once("members/footer.php");
	exit();
} else {
	$res=$mysqli->query("SELECT * FROM `Corps` WHERE name='$network' LIMIT 1;");
	$row=$res->fetch_assoc();
	$staff=array($row['owner'],$row['co'],$row['leftl'],$row['rightl'],$row['leftro'],$row['rightro']);
	function getProf($position,$spot) {
		$mysqli = new mysqli("gtogame.db.9808275.hostedresource.com", "gtogame", "D7Awthkp2946!", "gtogame", 3306);
		$res=$mysqli->query("SELECT `username`,`avatar`,`donor`,`online` FROM Players WHERE id = '$position' LIMIT 1");
		$row=$res->fetch_array();
		echo "<div class=\"span6 well well-small\">
					<div class=\"row-fluid\">
						<div class=\"span2\"><img class=\"img-rounded\" height=\"70px\" width=\"70px\" src=\"$row[1]\"></div>
						<div class=\"span10\">
							<strong>$spot:</strong><h4 style=\"margin: 0 0 3px 0;\"><a href=\"profile.php?id=$position\">$row[0]</a></h4>";
							userBadges($row['donor'], $row['online']);
						echo "</div>
					</div>
				</div>";
	}
	$owner=$mysqli->query("SELECT health FROM Players WHERE id = '$row[owner]' LIMIT 1");
	$rown=$owner->fetch_array();
	if ($rown[0] < 1 AND in_array($_COOKIE['id'], $staff)) {
		echo "<div class=\"alert alert-info\">The Network leader is dead! Do you want to take it over and become the new leader?</div>
		      <form name=\"pickup\" method=\"post\" action=\"network.php\" class=\"well\">
		        <legend>Claim the Network</legend>
		      	<input type=\"hidden\" name=\"network\" value=\"$netid\">
		      	<input class=\"btn btn-primary btn-large\" type=\"submit\" name=\"claim\" value=\"Claim the Network\">
		      </form>";
	} else {
		echo "
		<div class=\"modal hide\" id=\"leave\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"leaveLabel\" aria-hidden=\"true\">
			<div class=\"modal-header\">
		  	<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
		  	<h3 id=\"leaveLabel\">Leave Network</h3>
		  </div>
		  <div class=\"modal-body\">
		  	Are you sure that you want to leave $network? By leaving, you are risking the network members retaliating and possibly injuring you!
		  </div>
		  <div class=\"modal-footer\">
		  	<input type=\"submit\" class=\"btn btn-danger\" name=\"leave\" id=\"leaveBtn\" value=\"Leave\">
		  	<button class=\"btn btn-warning\" data-dismiss=\"modal\" aria-hidden=\"true\">Cancel</button>
		  </div>
		</div>";
		if (in_array($_COOKIE['id'], $staff)) {
			echo "
			<div class=\"modal hide\" id=\"changeName\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"changeNameLabel\" aria-hidden=\"true\">
				<div class=\"modal-header\">
			  	<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
			  	<h3 id=\"changeNameLabel\">Change Network Name</h3>
			  </div>
			  <div class=\"modal-body\">
			  	<label for=\"cname\">New Name</label>
			  	<form method=\"POST\" action=\"network.php?page=name\">
			  	<input autocomplete=\"off\" type=\"text\" id=\"cname\" name=\"name\" class=\"span12\">
			  	<div class=\"alert\"><span class=\"label label-warning\">Warning</span> Changing the Network name costs $5,000,000</div>
			  </div>
			  <div class=\"modal-footer\">
			  	<input type=\"submit\" class=\"btn btn-success\" name=\"submit\" value=\"Submit\">
			  	<button class=\"btn btn-warning\" data-dismiss=\"modal\" aria-hidden=\"true\">Cancel</button>
			  </div>
			</div>";
			echo "
			<div class=\"modal hide\" id=\"recruiting\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"recruitingLabel\" aria-hidden=\"true\">
				<div class=\"modal-header\">
			  	<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
			  	<h3 id=\"recruitingLabel\">Recruiting Status</h3>
			  </div>
			  <div class=\"modal-body\"><span id=\"statusSpan\">";
			  	if($recruit == '1') {
				  	echo "<label for=\"rStatus\">Currently Recruiting</label> <button class=\"btn btn-primary btn-mini\" id=\"rStatus\" value=\"0\">Disable Recruiting</button>";
			  	} else {
				  	echo "<label for=\"rStatus\">Not Currently Recruiting</label> <button class=\"btn btn-primary btn-mini\" id=\"rStatus\" value=\"1\">Enable Recruiting</button>";
			  	}
			  	echo "</span><hr> <label for=\"applicants\">Current Applicants</label>
			  	<table id=\"applicants\" class=\"table table-striped table-bordered table-condensed\">
			  		<thead>
			  			<tr>
			  				<th>Username</th>
			  				<th>Rank</th>
			  				<th>Action</th>
			  			</tr>
			  		</thead>
			  		<tbody>";
			  		$res1=$mysqli->query("SELECT * FROM `recruit` WHERE `network` = '$netid'");
			  		while($row1=$res1->fetch_assoc()) {
				  		$user=$mysqli->query("SELECT `username`, `rank` FROM `Players` WHERE `id` = '$row1[uid]' LIMIT 1;");
				  		$row2=$user->fetch_array();
				  		$arrank=array('Recruit','Private','Specialist','Sergeant','Staff Sergeant','Master Sergeant','Sergeant Major','Second Lieutenant','First Lieutenant','Captain','Major','Lientenant Colonel','Colonel','Brigadier General','Major General','Lieutenant General','General','General of the Army');
				  		$userRank=$arrank[($row2[1]-1)];
				  		echo "<tr id=\"$row1[uid]\">
				  						<td><a href=\"profile.php?id=$row1[uid]\">$row2[0]</a></td>
				  						<td>$userRank</td>
				  						<td>
				  							<button class=\"btn btn-mini btn-success recruitAccept\" value=\"$row1[uid]\">Accept</button>
				  							<button class=\"btn btn-mini btn-danger recruitDecline\" value=\"$row1[uid]\">Decline</button> 
				  						</td>
				  					</tr>";
			  		}
			  		echo "</tbody>
			  	</table>
			  	<hr>
			  	<label for=\"rInvite\">Invite Player</label>
			  	<div class=\"input-append\" id=\"iAppend\">
			  	<input type=\"text\" placeholder=\"Username\" id=\"rInvite\"><button class=\"btn btn-success\" id=\"inviteBtn\">Invite</button>
			  	</div>
			  </div>
			  <div class=\"modal-footer\">
			  	<button class=\"btn btn-primary\" data-dismiss=\"modal\" aria-hidden=\"true\">Close</button>
			  </div>
			</div>";
		}
		?>
		<div class="btn-toolbar">
			<div class="btn-group">
				<a href="#leave" role="button" class="btn btn-small" data-toggle="modal">Leave Network</a>
				<a class="btn btn-small" href="networkvehicles.php">Network Garage</a>
			</div>
			<? if (in_array($_COOKIE['id'], $staff)) {
				echo '<div class="btn-group">
					      <a class="btn btn-small" href="network.php?page=edit">Edit Profile</a>
					      <a class="btn btn-small" href="networkprefs.php">Network Preferences</a>
					      <a href="#recruiting" role="button" class="btn btn-small" data-toggle="modal">Recruiting</a>';
			    if($_COOKIE['id'] == $row['owner']) {
			    	echo '<a href="#changeName" role="button" class="btn btn-small" data-toggle="modal">Change Name</a>';
			    }
			    echo '</div>';
			} 
			
			function bankType($label,$balance) {
				echo '<div class="span4">
					  <p class="lead">'.$label.' Balance: $'.number_format($balance).'</p>
					  <div class="input-append">
					      <input placeholder="'.$label.'" class="span6" name="'.strtolower($label).'" type="text"><button type="submit" class="btn" value="'.strtolower($label).'" name="deposit">Deposit</button>
				      </div>
				      </div>';
			}
			function sbankType($label,$balance) {
				echo '<div class="span4">
					  <p class="lead">'.$label.' Balance: ';if($label == 'Money') { echo '$'; } echo number_format($balance); echo '</p>
					  <div class="input-append">
					      <input placeholder="'.$label.'" class="span6" name="'.strtolower($label).'" type="text"><button type="submit" class="btn" value="'.strtolower($label).'" name="deposit">Deposit</button><button type="submit" class="btn" value="'.strtolower($label).'" name="withdraw">Withdraw</button>
				      </div>
				      <div class="input-append">
					      <input placeholder="Recipient" class="span6" name="t'.strtolower($label).'" type="text"><button type="submit" class="btn" value="'.strtolower($label).'" name="transfer">Transfer</button>
				      </div>
				      </div>';
			}
			
			?>
		</div>
		
		<script type='text/javascript'>
		$(document).ready(function (){
			$('#rStatus').click(function () {
				var status = $(this).val();
				$.ajax({
		    	url: 'network.php',
		      data: {'rstatus':status},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('#statusSpan').empty();
		      	$('#statusSpan').append(html);
		      }
		    });
		    return false;
			});
			$('.recruitAccept,.recruitDecline').click(function () {
				var uid = $(this).val();
				if($(this).hasClass('recruitAccept')) {
					var verdict = 'accept';
				} else {
					var verdict = 'decline';
				}
				$.ajax({
		    	url: 'network.php',
		      data: {'recruit':uid,'verdict':verdict},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('.recruitAccept,.recruitDecline').addClass('disabled');
		      	$('.recruitAccept').removeClass('recruitAccept');
		      	$('.recruitDecline').removeClass('recruitDecline');
		      	$('#'+uid).addClass(html);
		      }
		    });
		    return false;
			});
			$('#inviteBtn').click(function () {
				var uid = $('#rInvite').val();
				$.ajax({
		    	url: 'network.php',
		      data: {'rinvite':uid},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('#rInvite').val('');
		      	$('.alert').remove();
		      	$('#iAppend').before(html);
		      }
		    });
		    return false;
			});
			$('#leaveBtn').click(function () {
				$.ajax({
		    	url: 'network.php',
		      data: {'leave':'true'},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('#leave').modal('hide');
		      	$('#gplay').empty();
		      	$('#gplay').append(html);
		      }
		    });
		    return false;
			});
		});
		</script>
		
		<legend>Network Banks</legend>
		<form action="network.php" method="POST">
		<div class="row-fluid">
			<? 
			if (in_array($_COOKIE['id'], $staff)) {
			   sbankType('Money',$row['money']);
			   sbankType('Bullets',$row['bullets']);
			   sbankType('Tokens',$row['tokens']);
			} else {
			   bankType('Money',$row['money']);
			   bankType('Bullets',$row['bullets']);
			   bankType('Tokens',$row['tokens']);
			}
			?>
		</div>
		<legend>Network Leaders</legend>
		<div class="row-fluid">
			<? getProf($row['owner'],'Owner'); ?>
			<? getProf($row['co'],'Co Owner'); ?>
		</div>
		<div class="row-fluid">
			<? getProf($row['leftl'],'1st Officer'); ?>
			<? getProf($row['rightl'],'2nd Officer'); ?>
		</div>
		<div class="row-fluid">
			<? getProf($row['leftro'],'1st Recruiter'); ?>
			<? getProf($row['rightro'],'2nd Recruiter'); ?>
		</div>
		<legend>Network Members</legend>
		<div class="row-fluid">
		<?
		$res=$mysqli->query("SELECT `id`,`username`,`online`,`avatar`,`donor` FROM `Players` WHERE `corps`='$netid' ORDER BY username ASC");
		$i=0;
		while ($user=$res->fetch_assoc()) {     
			$i++;
			if($i > 4) { echo "</div><div class=\"row-fluid\">"; $i=1; }
			echo "<div class=\"well well-small span3\"><div class=\"row-fluid\"><div class=\"span3\"><img class=\"img-rounded\" height=\"60px\" width=\"60px\" src=\"$user[avatar]\"></div><div class=\"span9\" style=\"position: relative; height: 60px;\"><span style=\"position: absolute; bottom: 0;\"><a href=\"profile.php?id=$user[id]\"> <h4 style=\"margin-bottom: 2px;\">$user[username]</a></h4>"; userBadges($user['donor'], $user['online']); echo "</span></div></div></div>";
		}
		$members=$res->num_rows;
		echo "</div> <p class=\"lead\">Total Members: $members</p>";
	}
	require_once("members/footer.php");
}
?> 