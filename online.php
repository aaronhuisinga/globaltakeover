<?
$title="Online Players";
include("members/config.php");
include("members/header.php");
checks();
online();

$res=$mysqli->query("SELECT Level FROM Players WHERE id='$_COOKIE[id]' LIMIT 1;");
$row=$res->fetch_array();
$lvl=$row[0];
function userBadges($donor, $level) {
	if ($donor == 1) {echo " <span class=\"label label-info\">VIP</span>";}
  	if ($level > 0) {echo " <span class=\"label label-inverse\">Staff</span>";}
}
	?>
	<div class="page-header"><h1>Online Players <small>See who's online</small></h1></div>
	<ul class="nav nav-pills">
	  <li class="active"><a href="#main" data-toggle="tab">All</a></li>
	  <li><a href="#friends" data-toggle="tab">Friends</a></li>
	  <li><a href="#heist" data-toggle="tab">Available for Heist</a></li>
	  <li><a href="#staff" data-toggle="tab">Staff</a></li>
	</ul>
	
	<div class="tab-content">
		<div id="main" class="tab-pane active">
		<div class="row-fluid">
	<?
	$offline=(time()-300);
	$users=$mysqli->query("SELECT username, id, lastip, avatar, donor, Level FROM Players WHERE online >= '$offline' ORDER BY username ASC");
	// All users page
	$i=0;
	while ($user=$users->fetch_assoc())
	{
		$id = $user['id'];
		$i++;
		if($i > 4) { echo "</div><div class=\"row-fluid\">"; $i=1; }
		echo "<div class=\"well well-small span3\"><div class=\"row-fluid\"><div class=\"span3\"><img class=\"img-rounded\" height=\"60px\" width=\"60px\" src=\"$user[avatar]\"></div><div class=\"span9\" style=\"position: relative; height: 60px;\"><span style=\"position: absolute; bottom: 0;\"><a href=\"profile.php?id=$user[id]\">"; if($lvl == 2) { echo "<strong>$user[username]</a></strong><br>$user[lastip]<br>"; } else { echo "<h4>$user[username]</a></h4>"; } userBadges($user['donor'], $user['Level']); echo "</span></div></div></div>";
	}
	?> </div></div><div id="friends" class="tab-pane"><div class="row-fluid"> <?
	$users=$mysqli->query("SELECT username, id, lastip, avatar, donor, Level FROM Players WHERE online >= '$offline' ORDER BY username ASC");
	// Friends page
	$i=0;
	while ($user=$users->fetch_assoc())
	{
		$id = $user['id'];
		$sql=$mysqli->query("SELECT * FROM friendslist WHERE username='$u' AND friend='$user[username]' LIMIT 1");
		if($sql->num_rows > 0) {
			$i++;
			if($i > 4) { echo "</div><div class=\"row-fluid\">"; $i=1; }
			echo "<div class=\"well well-small span3\"><div class=\"row-fluid\"><div class=\"span3\"><img class=\"img-rounded\" height=\"60px\" width=\"60px\" src=\"$user[avatar]\"></div><div class=\"span9\" style=\"position: relative; height: 60px;\"><span style=\"position: absolute; bottom: 0;\"><a href=\"profile.php?id=$user[id]\">"; if($lvl == 2) { echo "<strong>$user[username]</a></strong><br>$user[lastip]<br>"; } else { echo "<h4>$user[username]</a></h4>"; } userBadges($user['donor'], $user['Level']); echo "</span></div></div></div>";
		}	
	}
	?> </div></div><div id="heist" class="tab-pane"><div class="row-fluid"> <?
	$users=$mysqli->query("SELECT username, id, lastip, ortime, avatar, donor, Level FROM Players WHERE online >= '$offline' ORDER BY username ASC");
	// Available for Heist page
	$i=0;
	while ($user=$users->fetch_assoc())
	{
		$id = $user['id'];
		$ORsd=$user['ortime']-time();
		if($ORsd > 0) {
			$i++;
			if($i > 4) { echo "</div><div class=\"row-fluid\">"; $i=1; }
			echo "<div class=\"well well-small span3\"><div class=\"row-fluid\"><div class=\"span3\"><img class=\"img-rounded\" height=\"60px\" width=\"60px\" src=\"$user[avatar]\"></div><div class=\"span9\" style=\"position: relative; height: 60px;\"><span style=\"position: absolute; bottom: 0;\"><a href=\"profile.php?id=$user[id]\">"; if($lvl == 2) { echo "<strong>$user[username]</a></strong><br>$user[lastip]<br>"; } else { echo "<h4>$user[username]</a></h4>"; } userBadges($user['donor'], $user['Level']); echo "</span></div></div></div>";
		}
	}
	?> </div></div><div id="staff" class="tab-pane"> <?
	$users=$mysqli->query("SELECT username, id, lastip, Level, avatar, donor, Level FROM Players WHERE online >= '$offline' ORDER BY username ASC");
	// Staff page
	$i=0;
	while ($user=$users->fetch_assoc())
	{
		$id = $user['id'];
		$i++;
		if($i > 4) { echo "</div><div class=\"row-fluid\">"; $i=1; }
		echo "<div class=\"well well-small span3\"><div class=\"row-fluid\"><div class=\"span3\"><img class=\"img-rounded\" height=\"60px\" width=\"60px\" src=\"$user[avatar]\"></div><div class=\"span9\" style=\"position: relative; height: 60px;\"><span style=\"position: absolute; bottom: 0;\"><a href=\"profile.php?id=$user[id]\">"; if($lvl == 2) { echo "<strong>$user[username]</a></strong><br>$user[lastip]<br>"; } else { echo "<h4>$user[username]</a></h4>"; } userBadges($user['donor'], $user['Level']); echo "</span></div></div></div>";
	}
	echo "</div></div>";
	// Update the online record
	$tonline=$users->num_rows;
	$res=$mysqli->query("SELECT record, date FROM orecord WHERE id = '1' LIMIT 1");
	$row=$res->fetch_array();
	$monline = $row[0];
	$mdate = $row[1];
	if ($tonline > $monline) {
		$mysqli->query("UPDATE orecord SET record = '$tonline', date = '$date' LIMIT 1");
	}
	echo "
	Total users online: $tonline<br />
	Most ever online: $monline Players at $mdate</div>";
include("members/footer.php");
?>