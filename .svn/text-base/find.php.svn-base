<?php 
$title="Find A Player";
require_once("members/config.php");
checks();
online();

function userBadges($donor, $level) {
	if ($donor == 1) {echo " <span class=\"label label-info\">VIP</span>";}
  	if ($level > 0) {echo " <span class=\"label label-inverse\">Staff</span>";}
}

if(isset($_POST['find'])) {
	$res=$mysqli->query("SELECT `id`, `donor`, `Level`, `avatar`, `username` FROM `Players` WHERE `username` LIKE '%$_POST[username]%'");
	$i=0;
	while($user=$res->fetch_array()) {
		if($i > 4) { echo "<br>"; $i=0; }
		echo "<div class=\"well well-small span3\"><div class=\"row-fluid\"><div class=\"span3\"><img class=\"img-rounded\" height=\"60px\" width=\"60px\" src=\"$user[avatar]\"></div><div class=\"span9\" style=\"position: relative; height: 60px;\"><span style=\"position: absolute; bottom: 0;\"><a href=\"profile.php?id=$user[id]\"><h4>$user[username]</a></h4>"; userBadges($user['donor'], $user['Level']); echo "</span></div></div></div>";
		$i++;
	}
	exit();
}

require_once("members/header.php");
?>
<script>
	$(document).ready(function() {
		$('.search-query').change(function () {
			if($('#findPlayer').is(":visible") == true) { var findP = $('#findPlayer').val(); } else { var findP = $('#findPlayer2').val(); }
			if(findP != '') {
				$.ajax({
				    url: "find.php",
				    data: {'find':'true','username':findP},
				    type: "POST",
				    async: false,
				    success:  function(html){
				    	$('#findResults').show();
				    	$('#findResults').empty();
				    	$("#findResults").append(html);
				    }
				});
			} else {
				$('#findResults').hide();
			}
			return false;
		});
		$('#completeToggle').click(function () {
			if($(this).text() == 'Autocomplete On') {
				$(this).text('Autocomplete Off');
				$('#findPlayer').hide();
				$('#findPlayer2').show();
				$('#findPlayer').val('');
				$('#findPlayer2').val('');
			} else {
				$(this).text('Autocomplete On');
				$('#findPlayer2').hide();
				$('#findPlayer').show();
				$('#findPlayer').val('');
				$('#findPlayer2').val('');
			}
		});
	});
</script>
<div class="page-header"><h1>Find A Player <small>Find any player in the game</small></h1></div>

<div class="navbar">
	<div class="navbar-inner">
	<form class="navbar-search span9" id="findForm">
		<input type="text" autocomplete="off" class="search-query span12 autoOn" id="findPlayer" placeholder="Search" data-provide="typeahead" data-items="4" 
		<?
		echo "data-source=\"";
		$res=$mysqli->query("SELECT username FROM Players WHERE `dead` = '0' AND `banned` = '0' ORDER BY username ASC");
        $users='[';
        while($row=$res->fetch_assoc()) {
	    	$users.="&quot;".$row['username']."&quot;,";
        }
        $users=substr($users,0,-1);
        $users.="]";
        echo $users."\">";
		?>
		<input type="text" autocomplete="off" class="search-query span12 hide autoOff" id="findPlayer2" placeholder="Search">
	</form>
	<ul class="span2 nav">
		<li class="dropdown">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
            <ul class="dropdown-menu">
            	<li><a href="#" id="completeToggle">Autocomplete On</a></li>
            </ul>
        </li>
	</ul>
	</div>
</div>

<div id="findResults"></div>
<? include("members/footer.php"); ?>