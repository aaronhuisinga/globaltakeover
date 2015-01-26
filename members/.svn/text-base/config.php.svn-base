<?
//--------------- GTO CONFIG v2 ---------------//
// Setup cookie use, connect to database
	$mysqli=new mysqli("gtogame.db.9808275.hostedresource.com", "gtogame", "D7Awthkp2946!", "gtogame", 3306);
	$pdo=new PDO('mysql:host=gtogame.db.9808275.hostedresource.com;dbname=gtogame', 'gtogame', 'D7Awthkp2946!');
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	
// Define error output and log
	ini_set('error_reporting', E_ALL ^ E_NOTICE);
  ini_set('display_errors', 'On');
    
// Define game information
	$version="globaltakeover 2";
      
// Check to make sure that player is logged in, alive, and not banned
function checks() {
	// Check login
	if (isset($_COOKIE['id']) AND isset($_COOKIE['authkey'])) {
		$pdo=new PDO('mysql:host=gtogame.db.9808275.hostedresource.com;dbname=gtogame', 'gtogame', 'D7Awthkp2946!');
		$stmt=$pdo->prepare('SELECT banned, banreason, dead, health, sessauth FROM Players WHERE id = :id LIMIT 1');
		$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		// Verify player logged in legitimately
		if ($row['sessauth'] != $_COOKIE['authkey']) {
			setcookie ('id', '0', time()-300, '/', '', 0);
			setcookie ('authkey', '0', time()-300, '/', '', 0);
			header("Location: index.php");
			exit();
		}
		// Check health
		if ($row['health'] == 0 OR $row['dead'] > 0) {
			header("Location: dead.php");
			exit();
		}
		// Check ban status
		if($row['banned'] == 1) {
			echo "<h1>You have been banned!</h1>If you have any questions, please contact a staff member.<br><br><strong>Reason:</strong> ".$row['banreason'];
			exit();	 
		}
	} else {
		header("Location: index.php");
		exit();
	}
}
// Update online time and check for appearing offline
function online() {
	$pdo=new PDO('mysql:host=gtogame.db.9808275.hostedresource.com;dbname=gtogame', 'gtogame', 'D7Awthkp2946!');
	// Check login
	if (isset($_COOKIE['id'])) {
		$stmt=$pdo->prepare('SELECT `appearo` FROM Players WHERE id = :id LIMIT 1');
		$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		if (isset($_COOKIE['id']) AND $row['appearo'] != 1) {
			$stmt=$pdo->prepare('UPDATE Players SET online = :time WHERE id = :id LIMIT 1');
			$stmt->bindValue(':time', time(), PDO::PARAM_INT);
			$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
			$stmt->execute();
		}
	} else {
		header("Location: index.php");
		exit();
	}
}
// Check Prison Status
function prisonCheck() {
	$pdo=new PDO('mysql:host=gtogame.db.9808275.hostedresource.com;dbname=gtogame', 'gtogame', 'D7Awthkp2946!');
	$stmt=$pdo->prepare('SELECT `time` FROM `prison` WHERE `username`= :id LIMIT 1');
	$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
	$stmt->execute();
	$jail=$stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0 AND $jail['time'] > time()) {
		$secondsDiff=$jail['time']-time();
		if ($secondsDiff > 60) {
			$secondsDiff= floor($secondsDiff/60);
			echo "<div class=\"alert alert-info\"><span class=\"label label-info\">Locked Up!</span> You are in jail for $secondsDiff more minutes</div>";
		} else {
			echo "<SCRIPT TYPE=\"text/javascript\" LANGUAGE=\"JavaScript\">
		<!-- //start
		var times = new Array(1);
		times[0] = $secondsDiff;
		function Count(){
							if (times[0] > 0) { 
								document.getElementById('0').innerHTML = times[0];
							} else { 
								window.location.reload();
							}
				times[0]--;
			setTimeout(\"Count()\", 1000);
		}
		window.onload=function(){Count();}
		 //-->
		</SCRIPT>
		<div class=\"alert alert-info\"><span class=\"label label-info\">Locked Up!</span> You are in jail for <span id='0'></span> more seconds</div>";
		} 
		require_once("members/footer.php");
		exit();
	}
}

// Define standard date and time
date_default_timezone_set('America/Chicago');
$date = (date("M d Y h:i:s A"));