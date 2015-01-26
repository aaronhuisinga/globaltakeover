<?php
$title="Cancel Escrow";
include("config.php");
include("header.php");
checks();
online(); 

$row=mysql_fetch_array(mysql_query("SELECT username, tokens FROM Players WHERE id='{$_COOKIE['id']}' LIMIT 1;"));
$u = $row[0];
$t = $row[1];

$id = $_GET['id'];		
			$sql = mysql_query("SELECT * FROM tescrow WHERE id ='$id'");
			$row = mysql_fetch_array($sql);
			$other = $row['other'];
			$username = $row['username'];
			$amount = $row['amount'];
			$finish = $row['finished'];
			if (mysql_num_rows($sql) == 1) {
			if ($u == $username) {
			if ($finish == 'Pending') {
			$nt = $t + $amount;
			mysql_query("UPDATE Players SET tokens = '$nt' WHERE id='{$_COOKIE['id']}' LIMIT 1;");
			mysql_query("DELETE FROM tescrow WHERE id ='$id' LIMIT 1;");
			echo "<div id='crimestext' align='center'>The escrow was canceled!<br><a href='escrow.php'>Go Back.</a></div>";
			include("footer.php");
			$subject = htmlspecialchars(addslashes("Escrow Canceled"));
			$message = htmlspecialchars(addslashes("$u has canceled the escrow for $amount Tokens"));
			$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('$subject', '$message', '$other', '$u', 'unread', '$date')");
			exit();
			} else {
			echo "<div id='crimestext' align='center'>This escrow has already been finished.<br><a href='escrow.php'>Go Back</a></div>";
			include("footer.php");
			exit();
			}
			} else {
			echo "<div id='crimestext' align='center'>You are not in charge of this escrow!<br><a href='escrow.php'>Go Back</a></div>";
			include("footer.php");
			exit();
			}
			} else {
			echo "<div id='crimestext' align='center'>There is not an escrow open!<br><a href='escrow.php'>Go Back</a></div>";
			include("footer.php");
			exit();
			}
?>