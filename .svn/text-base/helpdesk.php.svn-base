<?php
$title="Help Desk";
require_once("members/config.php");
checks();
include("members/striphtml.php");

$res=$mysqli->query("SELECT username, hdo FROM Players WHERE id='$_COOKIE[id]' LIMIT 1;");
$row=$res->fetch_array();
$username=$row[0];
$hdo=$row[1];

// Ticket Submitted
if (isset($_POST['Send'])) {
$text=stripHTML(addslashes($_POST['text']));
$topic=strip_tags(addslashes($_POST['topic']));
require_once("members/header.php");
$mysqli->query("INSERT INTO `helpdesk` (`id`, `from`, `topic`, `message`, `date`) VALUES ('', '$_COOKIE[username]', '$topic', '$text', '$date');") or die (mysql_error());
echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> $_COOKIE[username], your request was successfully submitted. A staff member will review your submission as soon as possible.</div>";
require_once("members/footer.php");
exit();
} else if(isset($_GET['page']) AND $_GET['page'] == 'delete') {
	$mysqli->query("DELETE FROM helpdesk WHERE id = '$_GET[id]' LIMIT 1");
	$mysqli->query("UPDATE Players SET tickets=(tickets+1) WHERE id ='$_COOKIE[id]' LIMIT 1");
	echo "<div class=\"alert alert-warning\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
		  <span class=\"label label-warning\">Deleted</span> The selected ticket was deleted.</div>
		  <span class=\"hide\" id=\"deletedID\">$_GET[id]</span>";
	exit();
} else if(isset($_GET['page']) AND $_GET['page'] == 'reply') {
	if (isset($_POST['to'])) {
		$subject = htmlspecialchars(addslashes("$_POST[subject]"));
		$message = "\"$_POST[message]\" <br> <em>-This ticket was replied to by $_COOKIE[username]</em>";
		$mysqli->query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('Help Desk Reply To: $subject', '$message', '$_POST[to]', '$_COOKIE[id]', 'unread', '$date', 'no')");
		echo "<div class=\"alert alert-success\">
			  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
			  <span class=\"label label-success\">Success</span> The reply to the ticket was sent successfully.</div>";
		exit();
	}
} else if(isset($_GET['page']) AND $_GET['page'] == 'tickets') {
	require_once("members/header.php");
	$sql=$mysqli->query("SELECT hdo, username FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
	$row=$sql->fetch_array();
	$lvl=$row[0];
	$user=$row[1];
	if ($lvl == 1) {
		echo '<header><script type="text/javascript" src="members/nicEdit.js"></script>
			<script type="text/javascript">
			$(document).ready(function() {
				$(".deleteTable").click(function () {
					var tID = $(this).attr("tID");
					$.ajax({
			  			url: "helpdesk.php?page=delete&id="+tID,
		  		  		data: {\'id\':tID},
		  		  		type: "POST",
		  		  		async: false,
		  		  		success:  function(html){
		  		  			$("#topHead").after(html);
		  		  			$("#"+$("#deletedID").text()).remove();
		  		  		}
		  		  	});
		  		  	return false;
				});
				$("#replyBtn").click(function () {
					var tID = $("#tID").val();
					$.ajax({
			  			url: "helpdesk.php?page=reply&id="+tID,
		  		  		data: {\'to\':$("#submitter").val(),\'subject\':tID,\'message\':$(".nicEdit-main").text()},
		  		  		type: "POST",
		  		  		async: false,
		  		  		success:  function(html){
		  		  			$("#ticketReply").modal(\'hide\');
		  		  			$("#topHead").after(html);
		  		  		}
		  		  	});
				});
				$(".replyTable").click(function () {
					var tUser = $(this).attr("tUser");
						tID = $(this).attr("tID");
					$("#submitter").val(tUser);
					$("#tID").val(tID);
					$("#ticketReply").modal(\'show\');
					setTimeout(function() {
						 var niceditor = new nicEditor();
						 var niceditorpanel = new nicEditor({
							 iconsPath : \'members/nicEditorIcons.gif\',
							 buttonList : [\'bold\',\'italic\',\'underline\',\'strikethrough\',\'removeformat\',\'image\',\'link\',\'unlink\',\'forecolor\'],
							 bbCode : false,
							 xhtml : true
					  }).panelInstance(\'area1\');
					  niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
					}, 100);
				});
			});
			</script>
		 </header>';
		// Create the reply and delete modals
		?>
		<div class="modal hide" id="ticketReply" tabindex="-1" role="dialog" aria-labelledby="ticketReplyLabel" aria-hidden="true">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			  <h3 id="ticketReplyLabel">Reply To Ticket</h3>
			</div>
			<div class="modal-body">
			  <form method="POST" action="#" style="margin: 0px;">
			  <label for="post">Post Content</label>
			  <textarea rows="10" id="area1" name="message" class="span12"></textarea>
			  <input type="hidden" id="submitter" name="submitter" value="">
			  <input type="hidden" id="tID" name="tID" value="">
			</div>
			<div class="modal-footer">
			  <a class="btn btn-success" href="#" id="replyBtn"><i class="icon-ok icon-white"></i> Post Topic</a>
			  <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Cancel</button>
			</div>
		</div>
		
		<?
		echo '
		<div class="page-header" id="topHead">
			<h1>The Help Desk <small>View and Respond to Tickets</small></h1>
		</div>
		<div class="well">
		<table class="table table-striped table-bordered">
		<thead><tr>
		<th>ID</th>
		<th>From</th>
		<th>Topic</th>
		<th>Message</th>
		<th>Date</th>
		<th>Reply</th>
		<th>Delete</th>
		</tr>
		</thead><tbody>';
		
		$gather=$mysqli->query("SELECT * FROM helpdesk ORDER BY id ASC"); 
		while ($row=$gather->fetch_assoc()){
		$id=stripslashes($row['id']);
		$from=stripslashes($row['from']);
		$topic=stripslashes($row['topic']);
		$message=stripslashes($row['message']);
		$date=stripslashes($row['date']);
		$result=$mysqli->query("SELECT `id` FROM `Players` WHERE `username` = '$from' LIMIT 1");
		$pid=$result->fetch_assoc();
		
		echo ("<tr id=\"$id\"><td>$id</td> <td><a target=\"main\" href=\"profile.php?id={$pid['id']}\">$from</a></td> <td>$topic</td> <td>$message</td> <td>$date</td> <td><a href=\"#\" tID=\"$topic\" tUser=\"$pid[id]\" class=\"replyTable\">Reply</a></td> <td><a class=\"deleteTable\" tID=\"$id\" href=\"#\">Delete</a></td></tr>");
		}
		echo'</tbody></table></div>';
	} else {
	echo("<div id=\"crimestext\" align=\"center\">You do not have sufficient permissions to access this page.</div>");
	}
	require_once("members/footer.php");
	exit();
}
require_once("members/header.php");
echo '<header><script type="text/javascript" src="members/nicEdit.js"></script> <script type="text/javascript">
					bkLib.onDomLoaded(
   					function() {
     					 var niceditor = new nicEditor();
     					 var niceditorpanel = new nicEditor({
           					 iconsPath : \'members/nicEditorIcons.gif\',
          					 buttonList : [\'bold\',\'italic\',\'underline\',\'strikethrough\',\'removeformat\',\'image\',\'link\',\'unlink\',\'forecolor\'],
           					 bbCode : false,
           					 xhtml : true
    					  }).panelInstance(\'area1\');
                               
    					  niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
   					 }
    
					);

					</script>
			       </header>';
echo ("<form action=\"\" method=\"post\">
<div class=\"page-header\">
	<h1>The Help Desk <small>Ask Questions, Get Help!</small></h1>
</div>
	<label for=\"topic\">Topic</label>
	<input type=\"text\" name=\"topic\" class=\"span12\">
    <label for=\"area1\">Question/Request:</label>
    <textarea name='text' id='area1' class=\"span12\" rows=\"10\"></textarea>
    <br>
    <button type=\"submit\" class=\"btn btn-success\" name=\"Send\" value=\"Submit\"><i class=\"icon-arrow-right icon-white\"></i> Submit</button>
</form>");

  echo "<legend>Help Desk Stats "; 
  if ($hdo == 1) { echo("<a class=\"btn btn-mini\" href=\"helpdesk.php?page=tickets\">Check Help Desk Tickets</a>"); }
  echo "</legend><table class=\"table table-condensed table-striped table-bordered\">
  	<thead><tr><th>User</th> <th>Tickets Answered</th></tr></thead><tbody>";
$sql=$mysqli->query("SELECT username, tickets FROM Players WHERE hdo='1' ORDER BY tickets DESC");
while($row=$sql->fetch_array()){
	$usrname=stripslashes($row['username']);
	$tickets=stripslashes($row['tickets']);
  	echo ("<tr><td>$usrname</td> <td>".number_format($tickets)."</td></tr>");
}
echo ("</tbody></table></div></div>");
require_once("members/footer.php");
?>