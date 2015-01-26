<?
$title="Network Forums";
require_once("members/config.php");
checks();
online();
require_once("members/header.php");
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
$res=$mysqli->query("SELECT `censor`,`Corps` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_array();
$censor=$row[0];
$netid=$row[1];
$network=$_COOKIE['network'];
$res=$mysqli->query("SELECT * FROM `Corps` WHERE name='$network' LIMIT 1");
$row=$res->fetch_assoc();
$staff=array($row['owner'],$row['co'],$row['leftl'],$row['rightl'],$row['leftro'],$row['rightro']);

function lposttime($netid) {
	if(!isset($_GET['board'])) {
		$res=$mysqli->query("SELECT * FROM `cthread` WHERE `corp`='$netid'");
	} else {
		$res=$mysqli->query("SELECT * FROM `cthread` WHERE `corp`='$netid' AND secret='1'");
	}
	$post=$res->fetch_assoc();
	$timepost = $post['time'];
	$timegone = time()-$timepost;
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

if ($censor == 'yes') { include "bbcensored.php"; } else { include "BBCode.php"; }

$query=$mysqli->query("SELECT *  FROM `cthread` WHERE `corp`='$netid' ORDER BY `id` DESC LIMIT 0, 1"); 
$row=$query->fetch_assoc();
$f = ($row['id']) + 1;
if(!isset($_GET['board'])) {
	$sql=$mysqli->query("SELECT COUNT(id) AS tc FROM cthread WHERE corp='$network'");
} else {
	$sql=$mysqli->query("SELECT COUNT(id) AS tc FROM cthread WHERE corp='$network' AND secret='1'");
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
	<h1>Forums <small><? echo $network; ?></small></h1>
</div>
<div class="row-fluid">
	<div class="span4">
		<a href="#postTopic" role="button" class="btn btn-success pTopic" data-toggle="modal"><i class="icon-plus icon-white"></i> Post Topic</a>
	</div>
	<div class="span4 offset4">
<?
// Pagination
echo '<div class="pagination" style="float:right !important; margin: 0 0 5px 0;">
        <ul>';
if ($pp != 1) { echo ("<li><a href=\"nforum.php?page=1\">«</a></li> <li><a href=\"nforum.php?page=$last\">Prev</a></li>"); }
$pless=($pp-4);
$fless=range($pless, $last);
foreach($fless as $pagenum) {
	if ($pagenum > 0) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<li><a href=\"nforum.php?page=$pagenum\">$mtopic-$mxtopic</a></li>";
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
		echo "<li><a href=\"nforum.php?page=$pagenum\">$mtopic-$mxtopic</a></li>";
	}
}
if ($pp != $pages) { echo ("<li><a href=\"nforum.php?page=$next\">Next</a></li> <li><a href=\"nforum.php?page=$pages\">»</a></li>"); }
?>
</ul>
</div>
</div>
</div>

<div class="well">
<table class="table table-bordered table-striped">
<thead>
<tr><th colspan="5">
<form action="nforum.php" method="POST"> 
<div class="btn-toolbar">
<div class="btn-group">
	<?
	if(!isset($_GET['board'])) {
		$dis0="disabled"; 
	} else {
		$dis1="disabled";  
	}
	?>
	<a class="btn btn-small <? echo $dis0; ?>" href="forum.php?page=1">General</a>
</div>
<? if (in_array($_COOKIE['id'], $staff)) { 
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
	    echo '<input type="hidden" name="board" value="secret">';
	  }
}
?>
</div>
</th></tr>
  <tr>
    <? if (in_array($_COOKIE['id'], $staff)) { echo'<th width="5%"><b>Select</b></th>'; } ?>
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
		$query=$mysqli->query("SELECT * FROM `cthread` WHERE `stick`='$x' AND `corp`='$netid' AND `secret`='0' ORDER BY `time` DESC LIMIT $limit, 25"); 
	} else {
		$query=$mysqli->query("SELECT * FROM thread WHERE `stick`='$x' AND `corp`='$netid' AND `secret`='1' ORDER BY time DESC LIMIT $limit, 25"); 
	}
	while ($row=$query->fetch_assoc()){ #start while loop
		$tid=$row['id'];
		$views=$row['view'];
		$title=BBCode(stripslashes($row['title']));
		$author=$row['author'];
		$gather=$mysqli->query("SELECT id FROM Players WHERE username='$author' LIMIT 1;");
		$info=$gather->fetch_array();
		$auid=$info[0];
		$res=$mysqli->query("SELECT * FROM `creply` WHERE topicid = '$tid'");
		$reply=$res->num_rows;
		$get=$mysqli->query("SELECT author FROM creply WHERE topicid='$tid' ORDER BY postid DESC LIMIT 1;");
		$lpost=$get->fetch_array();
		$luser=$lpost[0];
		$lgather=$mysqli->query("SELECT id FROM Players WHERE username='$luser' LIMIT 1;");
		$linfo=$lgather->fetch_array();
		$lauid=$linfo[0];  
		//last post
		$res=$mysqli->query("SELECT time FROM cthread WHERE id='$tid' LIMIT 1");
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
	  	if (in_array($_COOKIE['id'], $staff)) { echo "<td><input name=\"checkbox[]\" type=\"checkbox\" value=\"$tid\"></td>"; }
	    echo "<td>";
	    if($x == '1') { echo "<strong>Stuck:</strong> "; }
	    echo "<a href='ntopic.php?";
	    if(isset($_GET['board'])) {
			echo"board=1&";
		}
		echo "id=$tid&page=1'>$title</a><br>
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
	      echo '<input type="hidden" name="board" value="secret">';
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
		<a href="#postTopic" role="button" class="btn btn-success pTopic" data-toggle="modal"><i class="icon-plus icon-white"></i> Post Topic</a>
	</div>
	<div class="span4 offset4">
<?
// Pagination
echo '<div class="pagination" style="float:right !important; margin: -15px 0 0 0;">
        <ul>';
if ($pp != 1) { echo ("<li><a href=\"nforum.php?page=1\">«</a></li> <li><a href=\"nforum.php?page=$last\">Prev</a></li>"); }
$pless=($pp-4);
$fless=range($pless, $last);
foreach($fless as $pagenum) {
	if ($pagenum > 0) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<li><a href=\"nforum.php?page=$pagenum\">$mtopic-$mxtopic</a></li>";
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
		echo "<li><a href=\"nforum.php?page=$pagenum\">$mtopic-$mxtopic</a></li>";
	}
}
if ($pp != $pages) { echo ("<li><a href=\"nforum.php?page=$next\">Next</a></li> <li><a href=\"nforum.php?page=$pages\">»</a></li>"); }
?>
</ul>
</div>
</div>
</div>
<?
require_once("members/footer.php");
exit();
?>