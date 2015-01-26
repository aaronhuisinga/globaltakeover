<?
$title="Private Messages";
include ("members/config.php");
checks();
online();
include ("BBCode.php");
include ("members/striphtml.php");

$res=$mysqli->query("SELECT lmessage, username, avatar FROM Players WHERE id='$_COOKIE[id]' LIMIT 1;");
$row=$res->fetch_array();
$lastmessage = $row[0];
$nmessage = (time() + 30);
$countdown = ($lastmessage - time());
$user = $row[1];

require_once("members/header.php");

// If the user is sending a message...
if (isset($_POST['to'])) {
	$subject = htmlspecialchars(addslashes("$_POST[subject]"));
	if ($subject == NULL) {
		$subject = 'No Subject';
	}
	if (strlen(stripslashes(trim($subject))) < 1) {
		echo "<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> You must have at least one character in the title of your message, other than a space.</div>";
		exit();
	}
	$message = stripHTML(addslashes($_POST['message']));
	if ($message == NULL) {
		echo "<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> You must enter a message.</div>";
		echo var_dump($_POST);
		exit();
	}
		$to = htmlspecialchars(addslashes("$_POST[to]"));
	    $query=$mysqli->query("SELECT id FROM Players WHERE username = '$to' LIMIT 1");
	    $row=$query->fetch_array();
	    $to = $row[0];
		if ($to == NULL){
			echo("<div class=\"alert alert-danger\"><span class=\"label label-important\">Error</span> You left the username field blank!</div>");
			exit();
		}
	$block=$mysqli->query("SELECT * FROM blocklist WHERE block='$user' AND username='$to' LIMIT 1;");
	if ($block->num_rows > 0) {
	echo "<div class=\"alert alert-danger\"><span class=\"label label-danger\">Error</span> $to has you on their block list, so you are unable to send them a message.</div>";
	exit();
	}
	if (time() <= $lastmessage) {
	echo "<div class=\"alert alert-danger\"><span class=\"label label-danger\">Error</span> You have already sent a message in the last 30 seconds! Try again in $countdown seconds!</div>";
	exit();
	}
	$mysqli->query("UPDATE Players SET lmessage='$nmessage' WHERE id='$_COOKIE[id]' LIMIT 1;");
	$mysqli->query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('$subject', '$message', '$to', '$_COOKIE[id]', 'unread', '$date', 'no')");
	echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your message has been sent.</div>";
}

$res=$mysqli->query("SELECT lmessage, username, avatar FROM Players WHERE id='$_COOKIE[id]' LIMIT 1;");
$row=$res->fetch_array();
$lastmessage = $row[0];
$nmessage = (time() + 30);
$countdown = ($lastmessage - time());
$user = $row[1];

	switch($_GET['page']) {
		default:
		if(isset($_GET['outbox'])) { 
			$get=$mysqli->query("SELECT * from pmessages where `from` = $_COOKIE[id] AND `cleared` IS NULL order by id desc");
			$nummessages = $get->num_rows;
		} else {
			$get=$mysqli->query("SELECT * from pmessages where `touser` = $_COOKIE[id] order by id desc");
			$nummessages = $get->num_rows;
		}
		$deletingrows = ($nummessages - 30);
		?>
		<header>
		<?
		echo '
			  <script type="text/javascript">
			  		$(document).ready(function() {
			  		  $("#sendBtn").click(function() {
			  		  	setTimeout(function() {
			  		  	if($(\'#recipient\').val() == \'\' || $(\'#subject\').val() == \'\') {
			  		  		$(".modal-body").prepend(\'<div class="alert alert-danger"><span class="label label-important">Error</span> You must enter a recipient and a subject</div>\');
			  		  		return false;
			  		  	} else if ($(\'#area1\').val() == \'\' || $(\'#area1\').val() == \'<br />\') {
			  		  		$(".modal-body").prepend(\'<div class="alert alert-danger"><span class="label label-important">Error</span> The message content cannot be blank</div>\');
			  		  		return false;
			  		  	}
			  		  	$("#sendMsgForm").submit();
			  		  	$.ajax({
			  		  		url: "messaging.php",
			  		  		data: {\'to\':$("#recipient").val(),\'subject\':$("#subject").val(),\'message\':$("$area1").val()},
			  		  		type: "POST",
			  		  		async: false,
			  		  		success:  function(html){
			  		  			$(".modal").modal("hide");
			  		  			$(".page-header").after(html);
			  		  		}
			  		  	});
			  		  	}, 100);
			  		  });
			  		  $("#checkAll").click(function () {
			  		    $(".well input:checkbox").attr(\'checked\', \'checked\');
			  		  });
			  		  $("#removeAll").click(function () {
			  		    $(".well input:checkbox").removeAttr(\'checked\');
			  		  });
   					 });
					</script>';
		echo "<div class=\"page-header\" id=\"messageHead\">
			  <h1>Messaging <small>"; if(isset($_GET['outbox'])) { echo "Outbox"; } else { echo "Inbox"; } echo "</small></h1>
			  </div>
			  <form id='form_id' name='myform' action=\"messaging.php?page=deletemultiple\" method=\"post\">
			<div class=\"btn-toolbar\">
				<div class=\"btn-group\">";
					if(isset($_GET['outbox'])) {
						echo "<a class=\"btn\" href=\"messaging.php\"><i class=\"icon-inbox\"></i> Inbox</a>";
					} else {
						echo "<a class=\"btn\" href=\"messaging.php?outbox=true\"><i class=\"icon-inbox\"></i> Outbox</a>";
					}
					echo "<a href=\"#sendMessage\" role=\"button\" class=\"btn sendMsg\" data-toggle=\"modal\"><i class=\"icon-envelope\"></i> New Message</a>
				</div>
				<div class=\"btn-group\">
					<button type=\"button\" name=\"Submit\" id=\"checkAll\" class=\"btn\"\"><i class=\"icon-plus\"></i> Check All</button>
					<button type=\"button\" name=\"Submit\" id=\"removeAll\" class=\"btn\"\"><i class=\"icon-minus\"></i> Uncheck All</button>
					<button type=\"submit\" name=\"deletem\" class=\"btn\" value=\"Delete Selected\"><i class=\"icon-trash\"></i> Delete Selected</button>
				</div>
			</div>
			<div class=\"well\">
			<table class=\"table table-striped table-bordered\">
				<thead><tr>
					<th width=\"5\">Select</th>
					<th>Subject</b></th>
					<th>From</b></th>
					<th>Date</th>
					<th>Delete</th>
				</tr></thead><tbody>";
		if ($nummessages == 0) {
			echo ("<tr><td colspan=\"5\"><strong>You have no messages.</strong></td></tr></tbody></table></div>");
		} else {
			while ($messages = $get->fetch_array()) {
				if ($messages['unread'] == 'unread'){
				echo "<tr class=\"info\">
				<td><input name=\"checkbox[]\" type=\"checkbox\" value=\"$messages[id]\"></td>
				<td><a href=\"messaging.php?page=view&msgid=$messages[id]\"><i class=\"icon-asterisk\"></i> ";
				} else {
				echo "<tr>
				<td><input name=\"checkbox[]\" type=\"checkbox\" value=\"$messages[id]\"></td>
				<td><a href=\"messaging.php?page=view&msgid=$messages[id]\">";
				}
				if ($messages['reply'] == 'yes') {
					echo "<i class=\"icon-share-alt\"></i>";
				}
				echo ("$messages[title]</a></td></font>");
				$result=$mysqli->query("SELECT `username` FROM Players WHERE id ='$messages[from]' LIMIT 1;");
				$usern = $result->fetch_assoc();
				if (($result->num_rows > 0) AND $messages['from'] != 'Global Takeover') {
					echo "<td><a href=\"profile.php?id=$messages[from]\">$usern[username]</a></td>";
				} elseif (($result->num_rows== 0) OR $usern['username'] == 'Global Takeover') {
					echo "<td>$messages[from]</td>";
				}
				if(!isset($_GET['outbox'])) {
					echo "<td>$messages[date]</td><td><a href=\"messaging.php?page=delete&msgid=$messages[id]\">Delete</a></td></tr>";
				} else {
					echo "<td>$messages[date]</td><td><a href=\"messaging.php?page=delete&msgid=$messages[id]&outbox=true\">Delete</a></td></tr>";
				}
			}
			echo "</table></div></form><h5>$nummessages of 30 messages in your ";
			if(!isset($_GET['outbox'])) { echo "inbox"; } else { echo "outbox"; } echo "</h5>";
			if ($nummessages > 30 AND !isset($_GET['outbox'])) {
				$mysqli->query("DELETE FROM pmessages WHERE touser = '$user' ORDER BY id ASC LIMIT $deletingrows;");
			}
		}
		if (!isset($_POST['send'])) {
			$recipient = isset($_GET["recipient"]) ? trim($_GET["recipient"]) : "";
			echo "
				<div class=\"modal hide\" id=\"sendMessage\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"sendMessageLabel\" aria-hidden=\"true\">
				<div class=\"modal-header\">
				  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
				  <h3 id=\"sendMessageLabel\">Send New Message</h3>
				</div>
				<div class=\"modal-body\">
				  <label for=\"recipient\">Recipient</label>
				  <form method=\"POST\" id=\"sendMsgForm\">
            	  <input autocomplete=\"off\" type=\"text\" id=\"recipient\" name=\"to\" class=\"span12\" style=\"margin: 0 auto;\" data-provide=\"typeahead\" data-items=\"4\" data-source=\"";
            	  $res=$mysqli->query("SELECT username FROM Players WHERE `dead` = '0' AND `banned` = '0' ORDER BY username ASC");
            	  $users='[';
            	  while($row=$res->fetch_assoc()) {
	            	$users.="&quot;".$row['username']."&quot;,";
            	  }
            	  $users=substr($users,0,-1);
            	  $users.="]";
            	  echo $users."\">
				  <label for=\"subject\">Subject</label>
				  <script>$(document).ready(function() { $('.typeahead').typeahead(); });</script>
				  <input type=\"text\" id=\"subject\" name=\"subject\" class=\"span12\">
				  <label for=\"message\">Message</label>
				  <textarea rows=\"10\" id=\"area1\" name=\"message\" class=\"span12\"></textarea>
				</div>
				<div class=\"modal-footer\">
				  <a id=\"sendBtn\" class=\"btn btn-success\" href=\"#\"><i class=\"icon-ok icon-white\"></i> Send</a>
				  <button class=\"btn btn-warning\" data-dismiss=\"modal\" aria-hidden=\"true\">Cancel</button>
				</div>
				</div>
				</div>";
			require_once("members/footer.php");
		}
		break;
		case 'delete':
		if (!$_GET['msgid']) {
			echo "<div id=\"crimestext\" align=\"center\">Sorry, but this message is invalid.<br /><a href=\"messaging.php\">Go back.</a></div>";
			require_once("members/footer.php");
			exit();
		} else {
			$getmsg=$mysqli->query("SELECT * from pmessages where id = '$_GET[msgid]' LIMIT 1;");
			$msg=$getmsg->fetch_assoc();
			if ($msg['touser'] != $_COOKIE['id']) {
				echo "<div id=\"crimestext\" align=\"center\">This message was not sent to you, so you cannot delete it.<br /><a href=\"messaging.php\">Go back.</a></div>";
				require_once("members/footer.php");
				exit();
			} else {
				if(!isset($_GET['outbox'])) {
					$mysqli->query("DELETE FROM pmessages WHERE id = '$_GET[msgid]' LIMIT 1");
				} else {
					$mysqli->query("UPDATE `pmessages` SET `cleared` = 1 WHERE id = '$_GET[msgid]' LIMIT 1");
				}
				echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=messaging.php\"></head>
					  <div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> The message has been deleted. Redirecting...</div>";
				require_once("members/footer.php");
				exit();
			}
		}
		break;
		case 'deletemultiple':
		$a = $_POST['checkbox'];
		if($a == NULL){
			echo"<div align=\"center\" id='crimestext'>You didn't select any messages!<br /><a href=\"messaging.php\">Go back</a></div>";
			require_once("members/footer.php");
			exit();
		}
		if ($_REQUEST['deletem']) {
		$vs = 0;
		foreach ($a as $id) {
			$getmsg=$mysqli->query("SELECT * from pmessages where id='$id' LIMIT 1;");
			$msg=$getmsg->fetch_assoc();;
			if ($msg['touser'] != $_COOKIE['id']) {
				echo "<div id=\"crimestext\" align=\"center\">This message was not sent to you, so you cannot delete it.<br /><a href=\"messaging.php\">Go back.</a></div>";
				require_once("members/footer.php");
				exit();
			} else {
				if(isset($_GET['outbox'])) {
					$mysqli->query("UPDATE `pmessages` SET `cleared` = 1 where id='$id' LIMIT 1;");
				} else {
					$mysqli->query("DELETE FROM pmessages where id='$id' LIMIT 1;");
				}
				$vs=($vs+1);
			}	
			}
			echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=messaging.php\"></head>
					  <div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Successfully deleted $vs messages. Redirecting...</div>";
			require_once("members/footer.php");
			exit();
		}
		break;
		case 'view':
		if (!$_GET['msgid']) {
			echo "<div id=\"crimestext\" align=\"center\">Invalid message!<br /><a href=\"messaging.php\">Go back.</a></div>";
			require_once("members/footer.php");
			exit();
		} else {
			$getmsg=$mysqli->query("SELECT * FROM pmessages WHERE id = '$_GET[msgid]' LIMIT 1;");
			$msg=$getmsg->fetch_assoc();
			if ($msg['touser'] == $_COOKIE['id']) {
				if (!$_POST['message']) {
					$markread=$mysqli->query("UPDATE pmessages SET unread = 'read' WHERE id = '$_GET[msgid]' LIMIT 1;");
					$Text=(stripslashes("$msg[message]"));
					$message=BBcode($Text);
					$result=$mysqli->query("SELECT username, avatar FROM Players WHERE id='$msg[from]' LIMIT 1;");
					$user=$result->fetch_assoc();
					$avatar=$user['avatar'];
					if ($avatar != NULL AND $result->num_rows > 0) {
					$av = "<img src=\"$avatar\" height=\"80px\ width=\"80px\" />";
					} else {
					$av = "<img src=\"images/noavatar.png\" height=\"80px\ width=\"80px\" />";
					}
					echo '<script type="text/javascript" src="members/nicEdit.js"></script>
						  <script type="text/javascript">
						$(document).ready(function() {
						$(".replyMsg").click(function() {
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
					</script>';
					echo "<div class=\"page-header\">
							<h1>Messages <small>$msg[title]</small></h1>
						  </div>
						  <ul class=\"breadcrumb\">
						  	<li>
						  	  <a href=\"messaging.php\">Messaging</a> <span class=\"divider\">/</span>
						  	</li>
						  	<li class=\"active\">$msg[title]</li>
						  </ul>
						<div class=\"well\">";
						?>
						<table class="table table-bordered table-striped">
						<tr>
						<td rowspan="2" align="center" width="10%"><? echo("$av"); ?>
						<br><strong>
						<? 
						if ($msg['from'] != 'Global Takeover' AND $msg['from'] != 'Help Desk') { 
								echo "<a href=\"profile.php?id=$msg[from]\"> $user[username]</a>"; 
						} else { 
							echo $msg['from']; 
						} 
						?>
						</strong></td>
						<td width="90%" height="1%"><span style="float:left;">Sent: <? echo "$msg[date]"; ?></span>
						<span style="float:right;">
						<div class="btn-group">
						<a href="#replyMessage" role="button" class="btn btn-small replyMsg" data-toggle="modal"><i class="icon-share-alt"></i> Reply</a>
						<a class="btn btn-small" href="<? echo "messaging.php?page=delete&msgid=$_GET[msgid]"; ?>"><i class="icon-trash"></i> Delete</a>
						</div>
						</span></td> 
						</tr>
						<tr>
							<td><? echo "$message"; ?></td>
						</tr>
						</table>
						</form></div>
						<?
						echo "
						<div class=\"modal hide\" id=\"replyMessage\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"replyMessageLabel\" aria-hidden=\"true\">
						<div class=\"modal-header\">
						  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
						  <h3 id=\"replyMessageLabel\">Reply To Message</h3>
						</div>
						<div class=\"modal-body\">
						  <form method=\"POST\" style=\"margin: 0px;\">
						  <textarea rows=\"10\" id=\"area1\" name=\"message\" class=\"span12\"></textarea>
						  <input type=\"hidden\" name=\"quote\" value=\"$_GET[msgid]\">
						</div>
						<div class=\"modal-footer\">
						  <button type=\"submit\" class=\"btn btn-success\" name=\"send\" value=\"Submit\"><i class=\"icon-share-alt icon-white\"></i> Send</button>
						  <button class=\"btn btn-warning\" data-dismiss=\"modal\" aria-hidden=\"true\">Cancel</button>
						</div>
						</div>
						</form>";
					require_once("members/footer.php");
					exit();
				}
				if ($_POST['message']) {
					if (isset($_POST['quote'])) {
					$res=$mysqli->query("SELECT message, `from` FROM pmessages WHERE id='$_POST[quote]' LIMIT 1;");
					$row=$res->fetch_array();
					$quote=$row[0];
					//Get rid of previous quotes
					function killquote($quote) {
   						$quote = preg_replace("(\[quote=(.+?)\](.+?)\[\/quote\])is",'',$quote);
   						return $quote;
					}
					$quote=killquote($quote);
					$from=$row[1];
					$res=$mysqli->query("SELECT `username` FROM `Players` WHERE id='$msg[from]' LIMIT 1;");
					$username=$res->fetch_array();
					$message="[quote=$username[0]]$quote\[/quote]
					$_POST[message]";
					} else {
					$message=$_POST['message'];
					}
					$message = stripHTML(addslashes("$message"));
					$block=$mysqli->query("SELECT * FROM blocklist WHERE block='$_COOKIE[id]' AND username='$msg[from]' LIMIT 1");
					if ($block->num_rows > 0) {
					echo "<div id=\"crimestext\" align=\"center\">$msg[from] has you on their block list, so you are unable to send them a message.<br /><a href=\"messaging.php\">Go back.</a></div>";
					exit();
					}
					$mysqli->query("INSERT INTO `pmessages` (`title`, `message`, `touser`, `from`, `unread`, `date`, `reply`) VALUES ('$msg[title]', '$message', '$msg[from]', '$_COOKIE[id]', 'unread', '$date', 'yes')");
					echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=messaging.php\"></head>
						  <div class=\"page-header\"><h1>Messaging <small>Sent</small></h1></div>
				  		  <div class=\"alert alert-success\"><span class=\"label label-success\">Success</span> Your message has been sent. Redirecting...</div>";
				  	require_once("members/footer.php");
				  	exit();
				}
			} else {
				echo "<h1>Error</h1><br />";
				echo "<div id=\"crimestext\" align=\"center\">This message was not sent to you, so you cannot open it.<br /><a href=\"messaging.php\">Go back.</a></div>";
				require_once("members/footer.php");
				exit();
			}
		}
		break;
		}
?> 