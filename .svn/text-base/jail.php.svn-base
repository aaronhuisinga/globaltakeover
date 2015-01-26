<?php
require_once("members/config.php");
checks();
online();
$res=$mysqli->query("SELECT `clicks`, `location`, `money`, `prison_rank`, `rank`, `avatar` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_assoc();
$clicks=$row['clicks'];
$location=$row['location'];
$money=$row['money'];
$prank=$row['prison_rank'];
$rank=$row['rank'];
$avatar=$row['avatar'];
$title="$location Jail";

if(isset($_GET['page']) AND $_GET['page'] == 'break') {
	$sid=$_GET['id'];
	$res=$mysqli->query("SELECT `username` FROM `Players` WHERE `id`='$sid' LIMIT 1");
	$row=$res->fetch_array();
	$sname=$row[0];
	$res=$mysqli->query("SELECT `location` FROM `prison` WHERE `username`='$sid' LIMIT 1");
	$row=$res->fetch_array();
	$slocation=$row[0];
	$mysqli->query("UPDATE Players SET clicks=(clicks+1) WHERE id ='$_COOKIE[id]' LIMIT 1");
	
	if ($clicks >= 25) {
		setcookie ('scheck', $_SERVER["PHP_SELF"], time()+60*60*24*10, '/');
		header("Location: scriptcheck.php");
		exit();
	}
	require_once("members/header.php");
	if(!isset($sid)) {
		echo '<div class="alert alert-error">You must choose someone to break out.</div>';
	} elseif ($res->num_rows == 0) {
		echo '<div class="alert alert-error">This person is not currently in jail.</div>';
	} elseif ($location != $slocation) {
		echo '<div class="alert alert-error">You must be in the same location to break this person out.</div>';
	} elseif ($_COOKIE['id'] == $sid) {
		echo '<div class="alert alert-error">You cannot break yourself out of jail.</div>';
	} else {
		$chance=($prank*6);
		$save=rand(1,100);
		$jtime=time()+($rank*20);
		if ($save > $chance) {
			$mysqli->query("UPDATE Players SET exp=(exp+15), breaks=(breaks+1) WHERE id ='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("INSERT INTO prison (username, location, time) VALUES ('$_COOKIE[id]', '$location', ($jtime))");
			echo "<div class=\"alert alert-warning\">You failed to break out $sname, and are now locked up!</div>";
		} else {
			$mysqli->query("UPDATE Players SET exp=(exp+10), breaks=(breaks+1), sbreaks=(sbreaks+1) WHERE id ='$_COOKIE[id]' LIMIT 1");
			$mysqli->query("DELETE FROM `prison` WHERE `username`='$sid' LIMIT 1");
			echo "<div class=\"alert alert-success\">You successfully broke $sname out of jail!</div>";
		}
	}
} else {
	require_once("members/header.php");	
}
if(isset($_GET['page']) AND $_GET['page'] == 'bail') {
	// Calculate the cost
	$res=$mysqli->query("SELECT `time` FROM `prison` WHERE username = '$_COOKIE[id]' ORDER BY time DESC LIMIT 1");
	$row=$res->fetch_assoc();
	$ps=$row['time']-time();
	$cost=($ps*1000);
	if ($ps <= 0 OR $res->num_rows == 0) {
		echo "<div class=\"alert alert-error\">You are not currently in jail.</div>";
	} elseif ($cost > $money) {
		echo "<div class=\"alert alert-error\">You do not have $".number_format($cost)." to pay your bail.</div>";
	} else {
		$mysqli->query("UPDATE `Players` SET `money`=(money-$cost) WHERE `id`='$_COOKIE[id]' LIMIT 1");
		$mysqli->query("DELETE FROM `prison` WHERE `username`='$_COOKIE[id]' LIMIT 1;");
		echo "<div class=\"alert alert-success\">You paid $".number_format($cost)." and are now free to go.</div>";
	}
}
?>
<script>
$(document).ready(function () {
	setInterval(function() {
		$('.countDown').each(function () {
			var count = $(this).text();
				user = $(this);
		    if (count > 0) {
		    	count--;
		        $(user).text(count);
		    } else {
		        $(user).text('Released');
		    }
	    });
	}, 1000);
});
</script>
<div class="page-header"><h1>Jail <small>Serve time, or rescue others</small></h1></div>
<a class="btn btn-small" href="jail.php">Refresh</a><br><br>
<div class="row-fluid">
<?
$res=$mysqli->query("SELECT * FROM prison WHERE location='$location' ORDER BY time DESC");
while ($row=$res->fetch_assoc()) {
	$ps=$row['time']-time();
	if ($ps <= 0) {
		$mysqli->query("DELETE FROM `prison` WHERE `id` = '$row[id]' LIMIT 1");
	} else {
		$res2=$mysqli->query("SELECT `username`, `avatar` FROM Players WHERE `id`='$row[username]' LIMIT 1");
		$row2=$res2->fetch_assoc();
		
		$i++;
		if($i > 4) { echo "</div><div class=\"row-fluid\">"; $i=1; }
		
		echo "<div class=\"well well-small span3\"><div class=\"row-fluid\"><div class=\"span3\"><img class=\"img-rounded\" height=\"60px\" width=\"60px\" src=\"$row2[avatar]\"></div><div class=\"span9\" style=\"position: relative; height: 60px;\"><span style=\"position: absolute; bottom: 0;\"><a href=\"profile.php?id=$row[username]\"><h5>$row2[username]</a></h5>";
		if ($row['username'] == $_COOKIE['id']) { 
			echo "<a class=\"btn btn-mini\" href=\"jail.php?page=bail\">Bail</a>";
		} else {
			echo "<a class=\"btn btn-mini\" href=\"jail.php?page=break&id=$row[username]\">Break</a>";
		}
		echo " <small><span class=\"countDown\">$ps</span> seconds</small></span></div></div></div>";
	}
}
echo "</div>";
include("members/footer.php");