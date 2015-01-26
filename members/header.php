<!DOCTYPE html>
<html lang="en">
	<head>
		<title><? echo "$version · $title"; ?></title>
		<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Global Takeover, a free online role playing massive multiplayer game. Outplay and outsmart your opponents.">
    <meta name="author" content="Global Takeover Staff">
    <meta name="Keywords" content="free, game, multiplayer, online, massive multiplayer, MMORPG, RPG, Global Takeover, GT, GTO">
		<link rel="stylesheet" href="../themes/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../themes/css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="../themes/css/unicorn.main.css" />
		<? echo '<link href="../themes/css/unicorn.'.$_COOKIE['theme'].'.css" rel="stylesheet" class="skin-color">'; ?>
		<!-- Analytics -->
    <script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-34447116-1']);
			_gaq.push(['_setDomainName', 'globaltakeover.net']);
			_gaq.push(['_setAllowLinker', true]);
			_gaq.push(['_trackPageview']);
			
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
    <!-- Icons -->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Scripts
    ================================================== -->
    <script src="../themes/js/jquery.min.js"></script>
    <script src="../themes/js/jquery.ui.custom.js"></script>
    <script src="../themes/js/bootstrap.min.js"></script>
    <script src="../themes/js/unicorn.js"></script>
    <script src="scripts/stats.js"></script>
    <script>
    	$(document).ready(function() {
    		$('#updateNotes').click(function() {
	    		$.ajax({
	  		  		url: "notepad.php",
	  		  		data: {'notes':$("#area1").val(),'change_notes':'true'},
	  		  		type: "POST",
	  		  		async: false,
	  		  		success:  function(html){
	  		  			$(".modal").modal("hide");
	  		  		}
	  		  	});
    		});
		    // Get the current page and make it active in nav
		    var fileName = location.href.substr(location.href.lastIndexOf("/")+1,location.href.length);
		    if (fileName.indexOf('?') != -1) {
		    	var fileName = fileName.substring(0, fileName.indexOf('?'));
		    } else if (fileName.indexOf('#') != -1) {
		    	var fileName = fileName.substring(0, fileName.indexOf('#'));
		    }
	    	$('#sidebar a[href*="'+fileName+'"]').each(function () {
	    		if ($(this).attr('href').indexOf('?') != -1) {
		    		var thisFile = $(this).attr('href').substring(0, $(this).attr('href').indexOf('?'));
		    	} else if ($(this).attr('href').indexOf('#') != -1) {
		    		var thisFile = $(this).attr('href').substring(0, $(this).attr('href').indexOf('#'));
		    	} else {
			    	var thisFile = $(this).attr('href');
		    	}
		    	var thisName = $(this).text();
		    	if(fileName == thisFile) {
		    		$(".active").removeClass('active');
		    		$(this).parent().addClass('active');
		    		$("#phonePage").empty();
		    		$("#phonePage").text(thisName);
		    		if($(this).parents(':eq(2)').hasClass('submenu')) {
			    		//$(this).parents(':eq(2)').addClass('open');
			    		$(this).parents(':eq(2)').addClass('active');
		    		}
		    	}
	    	});
	    	
			// Update the message count for the player every 30 seconds
		    setInterval(function() {
			    $.ajax({
			    	url: 'scripts/messaging.inc.php',
			    	data: {'pID':'<? echo $_COOKIE['id']; ?>'},
			    	type: 'POST',
			    	async: false,
			    	success:  function (mCount){
			    		$('#mCount').fadeOut("fast").text(mCount).fadeIn("fast");
			    	}
			    });
		    }, 30000);
    	});
    </script>
	</head>
	<body>
		<div id="header">
			<h1><a href="index.php">globaltakeover</a></h1>		
		</div>
		
		<div class="hstats" id="hstats">
			<? require("members/stats.php"); ?>
		</div>
		<div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav btn-group">
        		<? // Get the players message count
          	 $stmt=$pdo->prepare("SELECT COUNT(*) FROM `pmessages` WHERE `touser` = :id AND `unread` = 'unread'");
             $stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
             $stmt->execute();
             $row=$stmt->fetch(PDO::FETCH_NUM);
          	?>
            <li class="btn btn-inverse">
            	<a href="messaging.php"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important" id="mCount"><? echo $row[0]; ?></span>
            	</a>
            </li>
            
            <li class="btn btn-inverse dropdown" id="menu-user"><a href="#" data-toggle="dropdown" data-target="#menu-user" class="dropdown-toggle"><i class="icon icon-user"></i> <? echo $_COOKIE['username']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="profile.php?id=<? echo $_COOKIE['id']; ?>"><i class="icon-user"></i> Profile</a></li>
			              <li><a href="prefs.php"><i class="icon-cog"></i> Settings</a></li>
			              <? 
			              $stmt=$pdo->prepare('SELECT Level FROM Players WHERE id = :id LIMIT 1');
			              $stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
			              $stmt->execute();
			              $row=$stmt->fetch(PDO::FETCH_ASSOC);
			              if ($row['Level'] == 2) { 
				          	  echo '<li><a href="members/staff/admin.php"><i class="icon-glass"></i>  Admin Panel</a></li>
				          	  		<li><a target="_blank" href="https://p3nlmysqladm001.secureserver.net/grid50/2505?uniqueDnsEntry=gtogame.db.9808275.hostedresource.com"><i class="icon-hdd"></i> Database</a></li>'; 
				          }
				          ?>
			              <li class="divider"></li>
			              <li><a href="logout.php"><i class="icon-off"></i> Sign Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    
    <div id="style-switcher">
			<i class="icon-arrow-left icon-white slide"></i>
			<span class="move" style="color: #ffffff;">Stats</span>
			<span class="hstats move"><? require("members/stats.php"); ?></span>
		</div>

    <div id="sidebar">
    	<!-- will have to become dynamic for mobile stuff -->
			<a href="#" class="visible-phone"><i class="icon icon-file"></i> <span id="phonePage">Home</span></a>
			<ul>
				<li class="active"><a href="index.php"><i class="icon icon-home"></i> <span>Home</span></a></li>
				<li class="submenu">
					<a href="#"><i class="icon icon-th-list"></i> <span>Main</span> <span class="label">7</span></a>
					<ul>
						<li><a href="faq.php">FAQ</a></li>
            <li><a href="wiki.php?action=article&id=1">Wiki</a></li>
            <li><a href="tos.php">TOS</a></li>
            <li><a href="helpdesk.php">Help Desk</a></li>
            <li><a href="development.php">Changelog</a></li>
            <li><a href="tokens.php">Tokens</a></li>
            <li><a href="statistics.php">Stats</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i class="icon icon-play-circle"></i> <span>Actions</span> <span class="label">11</span></a>
					<ul>
						<li><a href="crimes.php">Crimes</a></li>
            <li><a href="gta.php">GTA</a></li>
            <li><a href="hijack.php">Hijack</a></li>
            <li><a href="pirate.php">Pirate</a></li>
            <li><a href="jail.php">Jail</a></li>
            <li><a href="heists.php">Heists</a></li>
            <li><a href="missions.php">Missions</a></li>
            <li><a href="gym.php">Gym</a></li>
            <li><a href="kills.php">Kill</a></li>
            <li><a href="counterspies.php">Counter Spies</a></li>
            <li><a href="travel.php">Travel</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i class="icon icon-comment"></i> <span>Community</span> <span class="label">8</span></a>
					<ul>
						<li><a href="notepad.php">Notepad</a></li>
            <li><a href="messaging.php">Messaging</a></li>
            <li><a href="forum.php?page=1">Main Forum</a></li>
            <li><a href="nforum.php?page=1">Network Forum</a></li>
            <li><a href="online.php">Currently Online</a></li>
            <li><a href="find.php">Search</a></li>
            <li><a href="gm.php">Global Market</a></li>
            <li><a href="bm.php">Black Market</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i class="icon icon-folder-open"></i> <span>Management</span> <span class="label">7</span></a>
					<ul>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="garage.php">Garage</a></li>
            <li><a href="rankbar.php">Rank Bar</a></li>
            <li><a href="network.php">Network</a></li>
            <li><a href="hospital.php">Hospital</a></li>
            <li><a href="banking.php">Banking</a></li>
            <li><a href="mostwanted.php">Most Wanted</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i class="icon icon-star-empty"></i> <span>Casino</span> <span class="label">5</span></a>
					<ul>
						<li><a href="roulette.php">Roulette</a></li>
            <li><a href="blackjack.php">Blackjack</a></li>
            <li><a href="war.php">War</a></li>
            <li><a href="rr.php">Russian Roulette</a></li>
            <li><a href="lottery.php">Lottery</a></li>
					</ul>
				</li>
			</ul>
		</div>
		
		<div id="content">