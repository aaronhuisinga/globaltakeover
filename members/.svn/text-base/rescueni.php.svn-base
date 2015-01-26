<?php
include("config.php");
include("Countdown_he.php");
include("countdown_p.php");
checks(); 

$row=mysql_fetch_array(mysql_query("SELECT username, id, exp, location, prison_rank FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$username = $row[0];
$id = $row[1];
$exp = $row[2];
$location = $row[3];
$prank = $row[4];
$row=mysql_fetch_array(mysql_query("SELECT * FROM mission2 WHERE username = '$username' LIMIT 1;"));
$Ni = $row['Nikolai'];
$D= $row['Dmitri'];
$Na = $row['Natalya'];
$nil = $row['nil'];
$di = $row['dl'];
$nal = $row['nal'];

$save = rand(1, 100);
if ($location != $nil) {
echo '<div id="crimestext" align="center">You are not in the same location as Nikolai!</div>';
exit();
}
if ($Ni != 0) {
echo '<div id="crimestext" align="center">You have already saved Nikolai!</div>';
exit();
}
$save = rand (1, 100);
if ($save >= 1 AND $save <= 85) {
		mysql_query("UPDATE Players SET exp=(exp+10), breaks=(breaks+1) WHERE id ='{$_COOKIE['id']}' LIMIT 1;");	
		
		if ($rank == 'Wannabe') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 16))");
				} elseif ($rank == 'Recruit') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 32))");
				} elseif ($rank == 'Private') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 48))");
				} elseif ($rank == 'Soldier') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 64))");
				} elseif ($rank == 'Mercenary') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 80))");
				} elseif ($rank == 'Hired Killer') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 96))");
				} elseif ($rank == 'Contract Killer') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 112))");
				} elseif ($rank == 'Corporal') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 128))");
				} elseif ($rank == 'Sergeant') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 144))");
				} elseif ($rank == 'Staff Sergeant') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 160))");
				} elseif ($rank == 'Lieutenant') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 176))");
				} elseif ($rank == 'Captain') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 192))");
				} elseif ($rank == 'Major') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 208))");
				} elseif ($rank == 'Colonel') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 224))");
				} elseif ($rank == 'Brigadier') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 240))");
				} elseif ($rank == 'General') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 256))");
				} elseif ($rank == 'Warlord') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 272))");
				} elseif ($rank == 'Field Marshall') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 288))");
				} elseif ($rank == 'Dictator') {
					mysql_query("INSERT INTO prison (username, location, date, time) VALUES ('$username', '$location', '$date', ($current + 300))");
				}
			
			echo "<div id=\"crimestext\"><center>You failed to save Nikolai! Hope you like being locked up!<br /><a href=\"prison.php\">Go back.</center></div>";
			
			} elseif($save > 85 AND $save <= 100) {
		mysql_query("UPDATE Players SET exp=(exp+10), breaks=(breaks+1), sbreaks=(sbreaks+1) WHERE id ='{$_COOKIE['id']}' LIMIT 1;");	
		mysql_query("UPDATE mission2 SET Nikolai = 1 WHERE username = '$username' LIMIT 1;");
		if ($D == 0 OR $Na == 0) {
			echo "<div id=\"crimestext\"><center>You saved Nikolai! There is still members missing!<br /><a href=\"prison.php\">Go back.</center></div>";
			} else {
			echo '<div id="crimestext"><center>You saved Nikolai! You succesfully saved everyone!<br />
			<form action="mission2.php" method= "POST"><input type="submit" name="Finish" value="Finish Mission!"></form></center></div>';
			}
		}
		?>