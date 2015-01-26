<?php 
$title="Notepad";
include("members/config.php");
include("members/header.php");
checks();
online();

$res=$mysqli->query("SELECT `notes` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1;");
$row=$res->fetch_array();
$notes=$row[0];

if ((isset($_POST['change_notes'])) AND (isset($_POST['notes']))) {
	$notes=strip_tags($_POST['notes']);
	
	$mysqli->query("UPDATE Players SET notes='$notes' WHERE id='$_COOKIE[id]' LIMIT 1;");
	echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=notepad.php\"></head>
			  <div id=\"crimestext\" align=\"center\">Successfully updated your Notepad. Redirecting...</div>";
	include("members/footer.php");
	exit();
} 
?>
<div class="page-header"><h1>Notepad <small>Manage Your Personal Notes</small></h1></div>
<form action="" method="POST">
<textarea name="notes" class="span12" rows="15" id="notes"><?php echo "$notes"; ?></textarea><br>
<button name="change_notes" type="submit" id="change_notes" class="btn btn-success" value="Submit"><i class="icon-arrow-right icon-white"></i> Submit</button> 
</form>
<? include("members/footer.php"); ?>