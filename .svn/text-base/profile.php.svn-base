<?php
require_once("members/config.php");
include("BBCode.php");
checks();
online();

$id = isset($_GET["id"]) ? trim($_GET["id"]) : (isset($_COOKIE["id"]) ? trim($_COOKIE["id"]) : "");

if ($id != "" && isset($_COOKIE["id"])) {
	$res=$mysqli->query("SELECT username, Level FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
	$row = $res->fetch_array();
	$u = $row[0];
	$level = $row[1];

	$res=$mysqli->query("SELECT * FROM Players WHERE id='$id' LIMIT 1");
	$puser=$res->fetch_assoc();
	$pro=BBCode($puser['Profile']);
	$ortime=$puser['ortime'];
	$profuser=$puser['username'];
	$avatar=$puser['avatar'];
	$lvl=$puser['Level'];
	$donor=$puser['donor'];
	$ban=$puser['banned'];
	$laston=$puser['Laston'];
	$corp=$puser['corps'];
	$health=$puser['health'];
	$posts=$puser['posts'];
	
	function getWealth($sal){
    	$classes=array(10000=>"Broke",100000=>"Beggar",500000=>"Lower Class",1000000=>"Middle Class",10000000=>"Upper Class",25000000=>"Rich",100000000=>"Extremely Rich",1000000000=>"Hundred Millionaire");
    	foreach ($classes as $key => $value) {
        	if($sal < $key){
            	return $value;
            }
        }
        return "Billionaire";
    }

    $wealth = getWealth($puser['money']);
		
	$title="$profuser's Profile";
	require_once("members/header.php");

if(isset($_GET['page'])) {
	$id = $_GET['id'];
	
	if($_GET['page'] == 'friend') {
		$sql=$mysqli->query("SELECT username FROM Players WHERE id='$id'");
		if ($sql->num_rows < 1) {
			echo "<div class=\"alert alert-error\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				  <span class=\"label label-important\">Error</span> The ID that you tried to add doesn't exist.
				  </div>";
		} else {
			$row=$sql->fetch_assoc();
			$friuser = $row['username'];
			$res=$mysqli->query("SELECT `id` FROM friendslist WHERE friend='$friuser' AND username='$_COOKIE[username]' LIMIT 1");
			if ($res->num_rows == 0) {
				$mysqli->query("INSERT INTO friendslist (username, friend, friendid) VALUES ('$_COOKIE[username]', '$friuser', '$id')");
				echo "<div class=\"alert alert-success\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				  <span class=\"label label-success\">Success</span> You added $friuser to your friend list
				  </div>";
			} else {
				$mysqli->query("DELETE FROM friendslist WHERE friend='$friuser' AND username='$_COOKIE[username]' LIMIT 1");
				echo "<div class=\"alert alert-success\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				  <span class=\"label label-success\">Success</span> You removed $friuser from your friend list
				  </div>";
			}
		}
	} elseif($_GET['page'] == 'enemy') {
		$sql=$mysqli->query("SELECT username FROM Players WHERE id='$id'");
		if ($sql->num_rows < 1) {
			echo "<div class=\"alert alert-error\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				  <span class=\"label label-important\">Error</span> The ID that you tried to add doesn't exist.
				  </div>";
		} else {
			$row=$sql->fetch_assoc();
			$friuser = $row['username'];
			$res=$mysqli->query("SELECT `id` FROM enemyslist WHERE enemy='$friuser' AND username='$_COOKIE[username]' LIMIT 1");
			if ($res->num_rows == 0) {
				$mysqli->query("INSERT INTO enemyslist (username, enemy, enemyid) VALUES ('$_COOKIE[username]', '$friuser', '$id')");
				echo "<div class=\"alert alert-success\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				  <span class=\"label label-success\">Success</span> You added $friuser to your enemy list
				  </div>";
			} else {
				$mysqli->query("DELETE FROM enemyslist WHERE enemy='$friuser' AND username='$_COOKIE[username]' LIMIT 1");
				echo "<div class=\"alert alert-success\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				  <span class=\"label label-success\">Success</span> You removed $friuser from your enemy list
				  </div>";
			}
		}
	} elseif($_GET['page'] == 'block') {
		$sql=$mysqli->query("SELECT username, Level FROM Players WHERE id='$id'");
		if ($sql->num_rows < 1) {
			echo "<div class=\"alert alert-error\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				  <span class=\"label label-important\">Error</span> The ID that you tried to add doesn't exist.
				  </div>";
		} else {
			$row=$sql->fetch_assoc();
			if($row['Level'] > 0) {
				echo "<div class=\"alert alert-error\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				  <span class=\"label label-important\">Error</span> The cannot block staff members.
				  </div>";
			} else {
			$friuser = $row['username'];
				$res=$mysqli->query("SELECT `id` FROM blocklist WHERE enemy='$friuser' AND username='$_COOKIE[username]' LIMIT 1");
				if ($res->num_rows == 0) {
					$mysqli->query("INSERT INTO blocklist (username, block, blockid) VALUES ('$_COOKIE[username]', '$friuser', '$id')");
					echo "<div class=\"alert alert-success\">
					  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
					  <span class=\"label label-success\">Success</span> You added $friuser to your block list
					  </div>";
				} else {
					$mysqli->query("DELETE FROM blocklist WHERE block='$friuser' AND username='$_COOKIE[username]' LIMIT 1");
					echo "<div class=\"alert alert-success\">
					  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
					  <span class=\"label label-success\">Success</span> You removed $friuser from your block list
					  </div>";
				}
			}
		}
	}
}
		
		if ($pro == NULL OR $pro == '') {
			$pro="This profile is currently empty.";
		}
		
		if ($avatar != NULL) {
		$av = "<img class=\"img-polaroid img-rounded\" src=\"$avatar\" width=\"150px\" title=\"$profuser's avatar\" style=\"margin-top: -100px !important;\" />";
		} else {
		$av = "<img class=\"img-polaroid\" width=\"150px\" src=\"members/avatars/noavatar.png\" title=\"This user has no avatar\" />";
		}
		$ORsd = $ortime - time();
		if ($lvl > 0) {
		$tm = "Never";
		} else {
		$tm = "Available";
		}
		if ($ORsd > 60 AND $ORsd < 3600) {
		$tml= floor(($ORsd/60)+1);
		$tm = "$tml Minutes Left";
		} elseif ($ORsd > 3600) {
		$tml = floor((($ORsd/60)/60)+1);
		$tm = "$tml Hours Left";
		}
		
		$res=$mysqli->query("SELECT leader FROM Robbery WHERE leader = '$profuser' OR driver = '$profuser' OR wep = '$profuser' OR ee = '$profuser'");
		$row = $res->fetch_array();
		$lead = $row['leader'];
		if ($res->num_rows > 0) {
		$tm = "In a Heist";
		}
		if ($profuser == $lead) {
		$tm = "Leading a Heist";
		}
		
		$res=$mysqli->query("SELECT name FROM Corps WHERE id='$corp' LIMIT 1;");
		$corpr = $res->fetch_assoc();
		$network = $corpr['name'];
		
		$friend=$mysqli->query("SELECT * FROM friendslist WHERE username='$u' AND friend='$profuser' LIMIT 1;");
		if ($friend->num_rows > 0) {
		$fritext = "Friends";
		} else {
		$fritext = "Add as Friend";
		}
		
		$enemy=$mysqli->query("SELECT * FROM enemyslist WHERE username='$u' AND enemy='$profuser' LIMIT 1;");
		if ($enemy->num_rows > 0) {
		$etext = "Enemies";
		} else {
		$etext = "Add as Enemy";
		}
		
		$block=$mysqli->query("SELECT * FROM blocklist WHERE username='$u' AND block='$profuser' LIMIT 1;");
		if ($block->num_rows > 0) {
		$btext = "Blocked";
		} else {
		$btext = "Add to Blocklist";
		}
		
		if ($health < 1) {
		$state = 'Dead';
		} else {
		$state = 'Alive';
		}
		
		if ($puser['Online'] >= (time()-300) AND $ban == 0) {
		$status = '<span class="label label-success">Online</span>';
		} elseif ($puser['Online'] < (time()-300) AND $ban == 0) {
		$status = 'Offline';
		} elseif (($puser['Online'] >= (time()-300) OR $puser['Online'] < (time()-300)) AND $ban == 1) {
		$status = '<span class="label label-important">Banned</span>';
		}
		
		$arrank=array('Recruit','Private','Specialist','Sergeant','Staff Sergeant','Master Sergeant','Sergeant Major','Second Lieutenant','First Lieutenant','Captain','Major','Lientenant Colonel','Colonel','Brigadier General','Major General','Lieutenant General','General','General of the Army');
		$userRank=$arrank[($puser['rank']-1)];
		
		echo "
			<div class=\"modal hide\" id=\"sendMessage\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"sendMessageLabel\" aria-hidden=\"true\">
				<div class=\"modal-header\">
			  	<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
			  	<h3 id=\"sendMessageLabel\">Send Message to $puser[username]</h3>
			  </div>
			  <div class=\"modal-body\">
			  	<label for=\"title\">Subject</label>
			  	<form method=\"POST\" action=\"messaging.php\">
			  	<input autocomplete=\"off\" type=\"text\" id=\"title\" name=\"subject\">
			  	<label for=\"message\">Message</label>
			  	<textarea rows=\"10\" id=\"message\" name=\"message\"></textarea>
			  </div>
			  <div class=\"modal-footer\">
			  	<input type=\"hidden\" name=\"to\" value=\"$puser[username]\">
			  	<input type=\"submit\" class=\"btn btn-success\" name=\"submit\" value=\"Submit\">
			  	<button class=\"btn btn-warning\" data-dismiss=\"modal\" aria-hidden=\"true\">Cancel</button>
			  </div>
			</div>";
		?>
		<div id="content-header"><h1><? echo $puser['username']; ?>'s Profile</h1></div>
		<div id="breadcrumb">
			<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
			<a href="#" class="current"><? echo $puser['username']; ?>'s Profile</a>
		</div>
		<div class="container-fluid gplay">
		<?
		echo "<div class=\"well\" style=\"margin-top: 100px;\">
				<div class=\"row-fluid\">
					<div class=\"span2\">$av</div> <div class=\"span4\" style=\"margin-left: 5px !important;\"><h3>$puser[username]";
	  			if ($donor == 1) {echo " <span class=\"label label-info\">VIP</span>";}
	  			if ($ban != 0) {echo " <span class=\"label label-important\">Banned</span>";}
	  			if ($lvl > 0) {echo " <span class=\"label label-inverse\">Staff</span>";}
	  			echo "</h3></div>
	  				<div class=\"span5 offset1 pull-right\">
		  			<div class=\"btn-group\" style=\"margin-bottom:11px;\">
			          <a class=\"btn btn-small\" href=\"#sendMessage\" data-toggle=\"modal\"><i class=\"icon-envelope\"></i> Send Message</a>
			          <a class=\"btn btn-small\" href=\"profile.php?page=friend&id=$id\"><i class=\"icon-star\"></i> $fritext</a>
			          <a class=\"btn btn-small\" href=\"profile.php?page=enemy&id=$id\"><i class=\"icon-star-empty\"></i> $etext</a>
			          <a class=\"btn btn-small\" href=\"profile.php?page=block&id=$id\"><i class=\"icon-ban-circle\"></i> $btext</a>
			        </div>
			        </div>
			        </div>
			        <br>
			        <table class=\"table table-condensed table-striped table-bordered\" style=\"margin-bottom: 0px;\">
			          <tr><td><strong>Rank:</strong> $userRank  /  <strong>Prison Rank:</strong> $puser[prison_rank]  /  <strong>Wealth:</strong> $wealth</td></tr>
			          <tr><td><strong>Status:</strong> $status / <strong>State:</strong> $state / <strong>Joined:</strong> $puser[registration_date] / <strong>Last Seen:</strong> $laston</td></tr>
					  <tr><td><strong>Network:</strong> "; if ($puser['corps'] != '') {
				echo "<a href=\"network.php?id=$puser[corps]\">$network</a>";
				} else {
				echo "None";} echo " / <strong>Heist Status:</strong> $tm / <strong>Prison Breaks:</strong> $puser[sbreaks] / <strong>Forum Posts:</strong> $posts / <strong>Referrals:</strong> $puser[referrals]</td></tr></table>
		        </div>
	  			<div class=\"well\">$pro</div>
			  </div>";
		include("members/footer.php");	
	}
?>