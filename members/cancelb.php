<?php
$title="Cancel Escrow";
include("config.php");
include("header.php");
checks();
online(); 

$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];

		$row=mysql_fetch_array(mysql_query("SELECT id, location FROM Bank WHERE owner='$u' LIMIT 1;"));
		$aid = $row[0];
		$l = $row[1];
				
		if (mysql_num_rows($result) >= 1) {
			$sql = mysql_query("SELECT * FROM bpescrow WHERE location ='$l' LIMIT 1;");
			$row = mysql_fetch_array($sql);
			$other = $row['other'];
			if (mysql_num_rows($sql) == 1) {
			mysql_query("DELETE FROM bpescrow WHERE location = '$l' LIMIT 1;");
			echo "<div id='crimestext' align='center'>The escrow was canceled!<br><a href='Banko.php'>Go Back</a></div>";
			include("footer.php");
			$subject = htmlspecialchars(addslashes("Escrow Canceled"));
			$message = htmlspecialchars(addslashes("$u has canceled the escrow for the $l Local Bank!"));
			mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$other', 'Global Takeover', 'unread', '$date')");
			exit();
			} else {
			echo "<div id='crimestext' align='center'>There is not an escrow open!<br><a href='Banko.php'>Go Back</a></div>";
			include("footer.php");
			exit();
			}
		} else {
		echo "<div id='crimestext' align='center'>You do not own a Bank!<br><a href='Banko.php'>Go Back</a></div>";
		include("footer.php");
		exit();
		}
?>