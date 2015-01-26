<?
$title="Forums";
require_once("members/config.php");
checks();
online();
require_once("members/header.php");
// Check forum ban status
$res=$mysqli->query("SELECT `fbanreason`, `fbantime`, `then`, `fbanned` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1"); 
$data=$res->fetch_array();
$reason=$data['fbanreason'];
$time=($data['then'] + $data['fbantime'])-time();
if($data['fbanned'] == 1) {
	if (($data['then'] + $data['fbantime']) < time() AND $data['fbantime'] != 'perm') {
		$mysqli->query("UPDATE Players SET `fbanned` = '0', `fbdate` = '', `fbanreason` = '', `fbantime` = '', `then` = '' WHERE id='$_COOKIE[id]' LIMIT 1");
		echo "<div class=\"alert alert-warning\">Your forum ban has been lifted. Please behave yourself or you will be permanently banned next time.</div>";
	} else {
		echo "<div class=\"alert alert-error\">You have been banned from the forums.<br>
		      <strong>Reason:</strong> $reason<br>
		      <strong>Duration:</strong> ";
		if ($data['fbantime'] == 'perm') {
			echo "Permanent.</div>";
		} elseif ($time > 86400) {
			$tban=floor(($data['fbantime']/86400));
			echo "$tban days.</div>";
		} elseif ($time > 60 AND $time < 86400) {
			$tban = floor($data['fbantime']/3600);
			echo "$tban hours.</div>";
		} else {
			echo "Less than 1 hour.</div>";
		}
	}
	exit();
}
// Forum ban user
if(isset($_POST['fban'])) {
	$res=$mysqli->query("SELECT `level` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
	$row=$res->fetch_array();
	$lvl=$row[0];
	if ($lvl > 0) {
		$user=$_POST['banUser'];
		$reason=$_POST['reason'];
		if ($_POST['duration'] != NULL) { $duration=$_POST['duration'] * 86400; } else { $duration='perm'; }
		$mysqli->query("UPDATE `Players` SET `fbanned` = '1', `fbdate` = '$date', `fbanreason` = '$reason', `fbantime` = '$duration', `then` = '".time()."' WHERE `username` = '$user' LIMIT 1");
		echo("<div class=\"alert alert-success\">You banned $user from the forums.</div>");
	}
}
// Moderator Controls
if(isset($_POST['delete']) OR isset($_POST['stick']) OR isset($_POST['lock']) OR isset($_POST['move']) OR isset($_POST['clear'])) {
	$res=$mysqli->query("SELECT `level` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
	$row=$res->fetch_array();
	$lvl=$row[0];
	$a=$_POST['checkbox'];
	if ($lvl < 0) {
		exit();
	} elseif ($a == NULL AND !$_REQUEST['clear']) {
		echo "<div class=\"alert alert-error\">No topics were selected!</div>";
	} else {
		if ($_REQUEST['delete']) {
			foreach ($a as $id) {
				$res=$mysqli->query("SELECT postid FROM thread WHERE id='$id' LIMIT 1");
				$row=$res->fetch_array();
				$pid=$row[0];
				$mysqli->query("DELETE FROM post WHERE id='$pid' LIMIT 1");
				$mysqli->query("DELETE FROM thread WHERE id='$id' LIMIT 1");
				$res=$mysqli->query("SELECT postid FROM reply WHERE topicid='$id'");
				while ($row=$res->fetch_array()){
					$rid=$row[0];
					$mysqli->query("DELETE FROM post WHERE id='$rid' LIMIT 1");
					$mysqli->query("DELETE FROM reply WHERE topicid='$id'");
				}
			}
			echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Selected topics were deleted!</div>"; 
		} elseif ($_REQUEST['stick']) {
			foreach ($a as $id) {
				$res=$mysqli->query("SELECT stick FROM thread WHERE id='$id' LIMIT 1");
				$row=$res->fetch_array();
				$s=$row[0];
				if($s == 0) {
					$mysqli->query("UPDATE thread SET stick=1 WHERE id='$id' LIMIT 1");
				} elseif ($s == 1) {
					$mysqli->query("UPDATE thread SET stick=0 WHERE id='$id' LIMIT 1");
				}
			}
			echo"<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Selected topics were stuck/unstuck!</div>";
		} elseif ($_REQUEST['move']) {
			foreach ($a as $id) {
				$res=$mysqli->query("SELECT sales FROM thread WHERE id='$id' LIMIT 1");
				$row=$res->fetch_array();
				$sales=$row[0];
				if ($sales == 'yes') {
					$mysqli->query("UPDATE thread SET sales='' WHERE id='$id' LIMIT 1");
					echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>The selected thread(s) were moved to the General forum.</div>";
				} else {
					$mysqli->query("UPDATE thread SET sales='yes' WHERE id='$id' LIMIT 1");
					echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>The selected thread(s) were moved to the Sales forum.</div>";
				}
			}
		} elseif ($_REQUEST['lock']) {
			foreach ($a as $id) {
				$res=$mysqli->query("SELECT lo FROM thread WHERE id='$id' LIMIT 1");
				$row=$res->fetch_array();
				$s=$row[0];
				if($s == 0) {
					$mysqli->query("UPDATE thread SET lo=1 WHERE id='$id' LIMIT 1");
				} elseif ($s == 1) {
					$mysqli->query("UPDATE thread SET lo=0 WHERE fid='$id' LIMIT 1");
				}
			}
			echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Selected topics were locked/unlocked!</div>";
		} elseif ($_REQUEST['clear']) {
			if(!isset($_POST['board'])) {
				$res=$mysqli->query("SELECT id, postid FROM `thread` WHERE stick='0' AND sales!='yes' AND ads!='yes' AND vip!='yes'");
			} elseif ($_POST['board'] == 'sales') {
				$res=$mysqli->query("SELECT id, postid FROM `thread` WHERE stick='0' AND sales='yes'");
			} elseif ($_POST['board'] == 'vip') {
				$res=$mysqli->query("SELECT id, postid FROM `thread` WHERE stick='0' AND vip='yes'");
			}
			while ($row=$res->fetch_assoc()){
				$topic=$row['id'];
				$tpostid=$row['postid'];
			
				$posts=$mysqli->query("SELECT postid FROM `reply` WHERE topicid='$topic'"); 
				while ($row=$posts->fetch_assoc()){
					$rid=$row['postid'];
					$mysqli->query("DELETE FROM post WHERE id='$rid' LIMIT 1"); 
				}
				$mysqli->query("DELETE FROM post WHERE id='$tpostid' LIMIT 1"); 	
				$mysqli->query("DELETE FROM reply WHERE topicid='$topic'");
				$mysqli->query("DELETE FROM thread WHERE `id` = '$topic' LIMIT 1");
			}			
			echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>The forum was cleared!</div>";
		}
	}
}
?>
<script type="text/javascript" src="members/nicEdit.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".pTopic").click(function() {
		setTimeout(function() {
			 var niceditor = new nicEditor();
			 var niceditorpanel = new nicEditor({
				 iconsPath : 'members/nicEditorIcons.gif',
				 buttonList : ['bold','italic','underline','strikethrough','removeformat','image','link','unlink','forecolor'],
				 bbCode : false,
				 xhtml : true
		  }).panelInstance('area1');
		  niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
		}, 100);
	});
	$("#pTopic").submit(function() {
		if($('#title').val() == '') {
			$(".modal-body").prepend('<div class="alert alert-danger"><span class="label label-important">Error</span> The post title cannot be blank</div>');
			return false;
		} else if ($('#area1').val() == '' || $('. nicEdit-main ').val().length < 5) {
			$(".modal-body").prepend('<div class="alert alert-danger"><span class="label label-important">Error</span> The post content cannot be blank</div>');
			return false;
		}
	});
});
</script>
<?
function lposttime() {
if(!isset($_GET['board'])) {
	$res=$mysqli->query("SELECT * FROM thread WHERE sales !='yes' AND ads !='yes' AND vip != 'yes'");
} else {
	if($_GET['board'] == '1') {
		$res=$mysqli->query("SELECT * FROM thread WHERE sales = 'yes'");
	} elseif($_GET['board'] == '2') {
		$res=$mysqli->query("SELECT * FROM thread WHERE ads = 'yes'");
	} elseif($_GET['board'] == '3') {
		$res=$mysqli->query("SELECT * FROM thread WHERE vip = 'yes'");
	}
}
$post=$res->fetch_assoc();
$timepost = $post['time'];
$timegone = time() - $timepost;
$mingone = floor($timegone/60);
$hgone = floor($mingone/60);
$dgone = floor($hgone/24);
if ($minsgone < 61) {
$lastp = "$minsgone Minutes Ago";
} elseif ($minsgone > 60 AND $minsgone < 1441) {
$lastp = "$hgone Hours Ago";
} elseif ($minsgone > 1440) {
$lastp = "$dgone Days Ago";
}
}

$res=$mysqli->query("SELECT censor, Level, donor FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_array();
$censor = $row[0];
$lvl = $row[1];
$vip=$row[2];
if ($censor == 'yes') { include "bbcensored.php"; } else { include "BBCode.php"; }

$query=$mysqli->query('SELECT *  FROM `thread` ORDER BY `id` DESC LIMIT 0, 1'); 
$row=$query->fetch_assoc();
$f = ($row['id']) + 1;
if(!isset($_GET['board'])) {
	$sql=$mysqli->query("SELECT COUNT(id) AS tc FROM thread WHERE sales !='yes' AND ads !='yes' AND vip != 'yes'");
} else {
	if($_GET['board'] == '1') {
		$sql=$mysqli->query("SELECT COUNT(id) AS tc FROM thread WHERE sales = 'yes'");
	} elseif($_GET['board'] == '2') {
		$sql=$mysqli->query("SELECT COUNT(id) AS tc FROM thread WHERE ads = 'yes'");
	} elseif($_GET['board'] == '3') {
		$sql=$mysqli->query("SELECT COUNT(id) AS tc FROM thread WHERE vip = 'yes'");
	}
}
$row=$sql->fetch_array();
$page=$row[0];
$pages=floor($page/25) + 1;
if(isset($_GET['page'])){ $pp=$_GET['page']; } else { $pp=1; }
$next=($pp+1);
$last=($pp-1);
$limit=($pp * 25) - 25;
?>
<div class="page-header">
	<h1>Forums <small>
	<?
	if(!isset($_GET['board'])) {
		echo "General Discussion";
	} else {
		if($_GET['board'] == '1') {
			echo "Sales Central";
		} elseif($_GET['board'] == '2') {
			echo "Heist Ads";
		} elseif($_GET['board'] == '3') {
			echo "THE VIP CAVE";
		}
	}
	?></small></h1>
</div>
<div class="row-fluid">
	<div class="span4">
		<? if(!isset($_GET['board']) OR (isset($_GET['board']) AND $_GET['board'] != 2)) {
		echo '<a href="#postTopic" role="button" class="btn btn-success pTopic" data-toggle="modal"><i class="icon-plus icon-white"></i> Post Topic</a>';
		} ?>
	</div>
	<div class="span4 offset4">
<?
// Pagination
echo '<div class="pagination" style="float:right !important; margin: 0 0 5px 0;">
        <ul>';
if ($pp != 1) { echo ("<li><a href=\"forum.php?page=1\">«</a></li> <li><a href=\"forum.php?page=$last\">Prev</a></li>"); }
$pless=($pp-4);
$fless=range($pless, $last);
foreach($fless as $pagenum) {
	if ($pagenum > 0) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<li><a href=\"forum.php?page=$pagenum\">$mtopic-$mxtopic</a></li>";
	}
}
$mtopic=(($pp*25)-24);
$mxtopic=($pp*25);
echo "<li class=\"active\"><a href=\"#\">$mtopic-$mxtopic</a></li>";
$pmore=($pp+4);
$fmore=range($next, $pmore);
foreach($fmore as $pagenum) {
	if ($pagenum <= $pages) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<li><a href=\"forum.php?page=$pagenum\">$mtopic-$mxtopic</a></li>";
	}
}
if ($pp != $pages) { echo ("<li><a href=\"forum.php?page=$next\">Next</a></li> <li><a href=\"forum.php?page=$pages\">»</a></li>"); }
?>
</ul>
</div>
</div>
</div>

<div class="well">
<table class="table table-bordered table-striped">
<thead>
<tr><th colspan="5">
<form action="forum.php" method="POST"> 
<div class="btn-toolbar">
<div class="btn-group">
	<?
	if(!isset($_GET['board'])) {
		$dis0="disabled"; 
	} else {
		if($_GET['board'] == '1') {
			$dis1="disabled";  
		} elseif($_GET['board'] == '2') {
			$dis2="disabled"; 
		} elseif($_GET['board'] == '3') {
			$dis3="disabled"; 
		}
	}
	?>
	<a class="btn btn-small <? echo $dis0; ?>" href="forum.php?page=1">General</a>
	<a class="btn btn-small <? echo $dis1; ?>" href="forum.php?board=1&page=1">Sales</a>
	<a class="btn btn-small <? echo $dis2; ?>" href="forum.php?board=2&page=1">Heist Ads</a>
	<? if ($vip==1) { echo "<a class=\"btn btn-small $dis3\" href=\"forum.php?board=3&page=1\">VIP</a>"; } ?>
</div>
<? if ($lvl > 0) { 
echo "<div class=\"btn-group\">
      	<input class=\"btn btn-small\" type=\"submit\" name=\"delete\" value=\"Delete\">
      	<input class=\"btn btn-small\" type=\"submit\" name=\"stick\" value=\"Stick\">
      	<input class=\"btn btn-small\" type=\"submit\" name=\"lock\" value=\"Lock\">
      	<input class=\"btn btn-small\" type=\"submit\" name=\"move\" value=\"Move\">
      </div>
      <div class=\"btn-group\">
      	<input class=\"btn btn-small btn-danger\" type=\"submit\" name=\"clear\" value=\"Clear Forum\">
      </div>";
	  if(isset($_GET['board'])) {
	  	if($_GET['board'] == '1') {
			echo '<input type="hidden" name="board" value="sales">';
		} elseif($_GET['board'] == '3') {
			echo '<input type="hidden" name="board" value="vip">';
		}
	  }
}
?>
</div>
</th></tr>
  <tr>
    <? if ($lvl > 0) { echo'<th width="5%"><b>Select</b></th>'; } ?>
    <th>Topic Title/Author</th>
    <th>Last Post</th>
    <th>Replies</th>
    <th>Views</th>
  </tr>
</thead><tbody>
<?
$stuckT=array('1','0');
foreach($stuckT as $x) {
	if(!isset($_GET['board'])) {
		$query=$mysqli->query("SELECT * FROM `thread` WHERE `stick`='$x' AND `sales`!='yes' AND `ads`!='yes' AND `vip`!='yes' ORDER BY `time` DESC LIMIT $limit, 25"); 
	} else {
		if($_GET['board'] == '1') {
			$query=$mysqli->query("SELECT * FROM thread WHERE `stick`='$x' AND sales = 'yes' ORDER BY time DESC LIMIT $limit, 25"); 
		} elseif($_GET['board'] == '2') {
			$query=$mysqli->query("SELECT * FROM thread WHERE `stick`='$x' AND ads = 'yes' ORDER BY time DESC LIMIT $limit, 25"); 
		} elseif($_GET['board'] == '3') {
			$query=$mysqli->query("SELECT * FROM thread WHERE `stick`='$x' AND vip = 'yes' ORDER BY time DESC LIMIT $limit, 25"); 
		}
	}
	while ($row=$query->fetch_assoc()){ #start while loop
		$tid=$row['id'];
		$views=$row['view'];
		$title=BBCode(stripslashes($row['title']));
		$author=$row['author'];
		$gather=$mysqli->query("SELECT id FROM Players WHERE username='$author' LIMIT 1;");
		$info=$gather->fetch_array();
		$auid=$info[0];
		$res=$mysqli->query("SELECT * FROM `reply` WHERE topicid = '$tid'");
		$reply=$res->num_rows;
		$get=$mysqli->query("SELECT author FROM reply WHERE topicid='$tid' ORDER BY postid DESC LIMIT 1;");
		$lpost=$get->fetch_array();
		$luser=$lpost[0];
		$lgather=$mysqli->query("SELECT id FROM Players WHERE username='$luser' LIMIT 1;");
		$linfo=$lgather->fetch_array();
		$lauid=$linfo[0];  
		//last post
		$res=$mysqli->query("SELECT time FROM thread WHERE id='$tid' LIMIT 1");
		$post=$res->fetch_array();
		$mingone = floor((time()-$post['time'])/60);
		$hgone = floor($mingone/60);
		$dgone = floor($hgone/24);
		if ($mingone < 61) {
			$lastp = "$mingone Minutes Ago";
		} elseif ($mingone > 60 AND $mingone < 1441) {
			$lastp = "$hgone Hours Ago";
		} elseif ($mingone > 1440) {
			$lastp = "$dgone Days Ago";
		}
			
		echo "<tr>";
	  	if ($lvl > 0) { echo "<td><input name=\"checkbox[]\" type=\"checkbox\" value=\"$tid\"></td>"; }
	    echo "<td>";
	    if($x == '1') { echo "<strong>Stuck:</strong> "; }
	    echo "<a href='topic.php?";
	    if(isset($_GET['board'])) {
			if($_GET['board'] == '1') {
				echo"board=1&";
			} elseif($_GET['board'] == '2') {
				echo"board=2&"; 
			} elseif($_GET['board'] == '3') {
				echo"board=3&";
			}
		}
		echo "id=$tid&page=1' >$title</a><br>
	    	<a href=\"profile.php?id={$auid}\"><font size=\"1\">$author</font></a></td>";
	    if ($luser != NULL) {
	    echo "<td align=\"right\">$lastp <br />
	    	By: <a href=\"profile.php?id={$lauid}\">$luser</a></td>";
	    } else {
	    echo "<td align=\"right\">No replies</td>";
	    }
		echo "<td align=\"center\">".number_format($reply)."</td>
		<td align=\"center\">".number_format($views)."</td>
	  </tr>";
	}
}
?>
</tbody>
</table>
</form>
</div>

<div class="modal hide" id="postTopic" tabindex="-1" role="dialog" aria-labelledby="postTopicLabel" aria-hidden="true">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	  <h3 id="postTopicLabel">Post New Topic</h3>
	</div>
	<div class="modal-body">
	  <form method="POST" action="post_topic.php" id="pTopic">
	  <label for="title">Title</label>
	  <input autocomplete="off" type="text" id="title" name="title" class="span12" style="margin: 0 auto;">
	  <label for="post">Post Content</label>
	  <textarea rows="10" id="area1" name="post" class="span12"></textarea>
	  <?
	  if(isset($_GET['board'])) {
	  	if($_GET['board'] == '1') {
			echo '<input type="hidden" name="board" value="sales">';
		} elseif($_GET['board'] == '3') {
			echo '<input type="hidden" name="board" value="vip">';
		}
	  }
	  ?>
	</div>
	<div class="modal-footer">
	  <button type="submit" name="send" class="btn btn-success" value="Submit"><i class="icon-ok icon-white"></i> Post Topic</button>
	  <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Cancel</button>
	  </form>
	</div>
</div>


<div class="row-fluid">
	<div class="span4">
		<? if(!isset($_GET['board']) OR (isset($_GET['board']) AND $_GET['board'] != 2)) {
		echo '<a href="#postTopic" role="button" class="btn btn-success pTopic" data-toggle="modal"><i class="icon-plus icon-white"></i> Post Topic</a>';
		} ?>
	</div>
	<div class="span4 offset4">
<?
// Pagination
echo '<div class="pagination" style="float:right !important; margin: -15px 0 0 0;">
        <ul>';
if ($pp != 1) { echo ("<li><a href=\"forum.php?page=1\">«</a></li> <li><a href=\"forum.php?page=$last\">Prev</a></li>"); }
$pless=($pp-4);
$fless=range($pless, $last);
foreach($fless as $pagenum) {
	if ($pagenum > 0) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<li><a href=\"forum.php?page=$pagenum\">$mtopic-$mxtopic</a></li>";
	}
}
$mtopic=(($pp*25)-24);
$mxtopic=($pp*25);
echo "<li class=\"active\"><a href=\"#\">$mtopic-$mxtopic</a></li>";
$pmore=($pp+4);
$fmore=range($next, $pmore);
foreach($fmore as $pagenum) {
	if ($pagenum <= $pages) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<li><a href=\"forum.php?page=$pagenum\">$mtopic-$mxtopic</a></li>";
	}
}
if ($pp != $pages) { echo ("<li><a href=\"forum.php?page=$next\">Next</a></li> <li><a href=\"forum.php?page=$pages\">»</a></li>"); }
?>
</ul>
</div>
</div>
</div>
<?
require_once("members/footer.php");
exit();
?>