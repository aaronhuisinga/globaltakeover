<?
require_once("members/config.php");
include("members/striphtml.php");
checks();
online();

function stripedit($Text) {
	$Text = preg_replace("(\[edit\](.+?)\[\/edit])is",'',$Text);
	return $Text;
}

$result=$mysqli->query("SELECT censor, corps FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$result->fetch_array();
$censor=$row[0];
$nid=$row[1];
$network=$_COOKIE['network'];
$username=$_COOKIE['username'];
if ($censor == 'yes') { include "bbcensored.php"; } else { include "BBCode.php"; }

if (is_numeric($_GET['id'])){
$id=$_GET['id']; #get id
$res=$mysqli->query("SELECT * FROM cthread WHERE id = '$id' AND corp='$nid' LIMIT 1");
$row=$res->fetch_assoc(); 
$d=stripslashes($row['date']);
$Text=stripslashes($row['title']);
$ttitle = BBCode($Text);
$views=stripslashes($row['view']);
$author=stripslashes($row['author']);
$pid=stripslashes($row['postid']);
$rid=stripslashes($row['id']);
$lock = $row['lo'];
$sql=$mysqli->query("SELECT * FROM `creply` WHERE topicid = '$id' LIMIT 1");
$page = $sql->num_rows;
$pagen = $page/25;
$pages = floor($pagen) + 1;
$pp = $_GET['page'];
$next=($pp+1);
$last=($pp-1);
$l = $pp * 25;
$limit = $l - 25;
$v = $views + 1;
$mysqli->query("UPDATE cthread SET view='$v' WHERE id = '$id' LIMIT 1");
$res=$mysqli->query("SELECT * FROM `cpost` WHERE id = '$pid'");
$post=$res->fetch_assoc();
$Text=stripslashes($post['post']);
$post = BBCode($Text);

$title="Network Forums > $ttitle";
require_once("members/header.php");

$rquery=$mysqli->query("SELECT * FROM `creply` WHERE topicid = '$id' ORDER BY id ASC LIMIT $limit, 25");
$reply=$rquery->num_rows;
$row2 = $rquery->fetch_array();

$d=stripslashes($row2['date']);

$result = $mysqli->query("SELECT id, avatar, posts FROM Players WHERE username='$author' LIMIT 1;");
$row = $result->fetch_array();
$auid = $row[0];
$avatar = $row[1];
$posts = $row[2];
if ($avatar != NULL) {
$av = "<img src=\"$avatar\" height=\"80px\ width=\"80px\" />";
} else {
$av = "<img src=\"/members/avatars/noavatar.png\" height=\"80px\ width=\"80px\" />";
}
$user = $result->fetch_assoc();
$res=$mysqli->query("SELECT * FROM cthread WHERE id = '$id' AND corp = '$nid' LIMIT 1");
$row=$res->fetch_array();
$d=stripslashes($row['date']);
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
?>
<div class="page-header">
	<h1>Forums <small>
	<?
	echo "$network Discussion";
	?></small></h1>
</div>
<ul class="breadcrumb">
  <li>
  	<?
	echo "<a href=\"nforum.php?page=1\">$network Discussion</a>";
	?>
     <span class="divider">/</span>
  </li>
  <li class="active"><? echo "$ttitle"; ?></li>
</ul>

<h3><? echo "$ttitle"; ?></h3>
<?
if ($pages > 1) {
echo '<div class="pagination"><ul>';
if ($pp != 1) { echo ("<li><a href=\"ntopic.php?id=$id&page=1\">«</a></li> <li><a href=\"ntopic.php?id=$id&page=$last\">Prev</a></li>"); }
$pless=($pp-4);
$fless=range($pless, $last);
foreach($fless as $pagenum) {
	if ($pagenum > 0) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<li><a href=\"ntopic.php?id=$id&page=$pagenum\">$mtopic-$mxtopic</a></li>";
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
		echo "<li><a href=\"ntopic.php?id=$id&page=$pagenum\">$mtopic-$mxtopic</a></li>";
	}
}
if ($pp != $pages) { echo ("<li><a href=\"ntopic.php?id=$id&page=$next\">Next</a></li> <li><a href=\"ntopic.php?id=$id&page=$pages\">»</a></li>"); }
echo "</ul></div>";
}
?>
<table class="table table-bordered table-striped">
  <tr>
    <td rowspan="2" align="center" width="10%"><? echo("$av"); ?><br><strong><? echo "<a  href=\"profile.php?id={$auid}\">$author</a>"; ?></strong><br>Posts: <? echo ("$posts"); ?></td>
    <td width="90%" height="1%"><span style="float:left;">Posted: <? echo "$d"; ?></span>
    <span style="float:right;">
    <div class="btn-group">
	    <a class="btn btn-mini" href="<? echo "ntopic.php?id=$id&page=$pages&tquote=$rid#go"; ?>"><i class="icon-comment"></i> Quote</a>
	    <? if ($author == $username OR $lvl > 0) { 
	    echo '<a class="btn btn-mini" href="ntopic.php?id='.$id.'&page='.$pages.'&tedit='.$rid.'#go"><i class="icon-edit"></i> Edit</a>';
	    } ?>
	</div>
	</span></td> 
  </tr>
  <tr>
    <td><? echo'<a name="'; echo "$pid"; echo'"></a>'; echo "$post"; ?></td>
  </tr>
</table>
<hr>
<?
if ($reply > 0){ #if there is more than 0 replies, show them!
$rquery1=$mysqli->query("SELECT * FROM `creply` WHERE topicid = '$id' ORDER BY id ASC LIMIT $limit, 25");
while ($row2=$rquery1->fetch_array()){
$rid=stripslashes($row2['id']);
$rauthor=stripslashes($row2['author']);
$pid=stripslashes($row2['postid']);
$res=$mysqli->query("SELECT * FROM `cpost` WHERE `id` = '$pid' LIMIT 1");
$rpost=$res->fetch_assoc(); 
#get reply post :o
$Text=stripslashes($rpost['post']);
$rpost = BBCode($Text);
$d=stripslashes($row2['date']);

$result = $mysqli->query("SELECT id, avatar, posts FROM Players WHERE username='$rauthor' LIMIT 1;");
$row = $result->fetch_array();
$reid = $row[0];
$avatar = $row[1];
$rposts = $row[2];
if ($avatar != NULL) {
$av = "<img src=\"$avatar\" height=\"80px\ width=\"80px\" />";
} else {
$av = "<img src=\"/members/avatars/noavatar.png\" height=\"80px\ width=\"80px\" />";
}
$user = $result->fetch_assoc();
?>
<table class="table table-bordered table-striped">
  <tr>
    <td rowspan="2" align="center" width="10%"><? echo("$av"); ?><br><strong><? echo "<a  href=\"profile.php?id={$reid}\">$rauthor</a>"; ?></strong><br>Posts: <? echo ("$rposts"); ?></td>
    <td width="90%" height="1%"><span style="float:left;">Posted: <? echo "$d"; ?></span>
    <span style="float:right;">
    <div class="btn-group">
	    <a class="btn btn-mini" href="<? echo "ntopic.php?id=$id&page=$pages&quote=$rid#go"; ?>"><i class="icon-comment"></i> Quote</a>
	    <? if ($rauthor == $username OR $lvl > 0) { 
	    echo '<a class="btn btn-mini" href="ntopic.php?id='.$id.'&page='.$pages.'&edit='.$rid.'#go"><i class="icon-edit"></i> Edit</a>'; 
	    echo '<a class="btn btn-mini" href="dpost.php?id='.$rid.'&pid='.$pid.'&t='.$id.'"><i class="icon-trash"></i> Delete</a>';
	    } ?>
	</div>
	</span></td> 
  </tr>
  <tr>
    <td><? echo'<a name="'; echo "$pid"; echo'"></a>'; echo "$rpost"; ?></td>
  </tr>
</table>

<?
}
if ($pages > 1) {
if ($pp != 1) { echo ("<a href=\"ntopic.php?id=$id&page=1\"><< First</a> <a href=\"topic.php?id=$id&page=$last\">< Prev</a> |  "); }
$pless=($pp-4);
$fless=range($pless, $last);
foreach($fless as $pagenum) {
	if ($pagenum > 0) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<a href=\"ntopic.php?id=$id&page=$pagenum\">$mtopic-$mxtopic</a> | ";
	}
}
$mtopic=(($pp*25)-24);
$mxtopic=($pp*25);
echo "<span class=\"currentpg\">$mtopic-$mxtopic</span> | ";
$pmore=($pp+4);
$fmore=range($next, $pmore);
foreach($fmore as $pagenum) {
	if ($pagenum <= $pages) {
		$mtopic=(($pagenum*25)-24);
		$mxtopic=($pagenum*25);
		echo "<a href=\"ntopic.php?id=$id&page=$pagenum\">$mtopic-$mxtopic</a> | ";
	}
}
if ($pp != $pages) { echo ("<a href=\"ntopic.php?id=$id&page=$next\">Next ></a> <a href=\"ntopic.php?id=$id&page=$pages\">Last >></a> "); }
}
} else {
echo '
  <div class="alert alert-info">
  <span class="label label-info">Info</span> There are currently no replies to this topic.
  </div>';
}

if ($lock == 0) {
// Get quoted post info
if (isset($_GET['quote'])) {
$qid = $_GET['quote'];
}
if (isset($_GET['tquote'])) {
$tid = $_GET['tquote'];
}
if (isset($qid)) {
$sql = $mysqli->query("SELECT postid, author FROM creply WHERE id='$qid' LIMIT 1");
$row = $sql->fetch_array();
$postid = $row[0];
$quoteauthor = $row[1];
} elseif (empty($qid) AND isset($tid)) {
$qid = $_GET['tquote'];
$sql = $mysqli->query("SELECT postid, author FROM cthread WHERE id='$qid' LIMIT 1");
$row = $sql->fetch_array();
$postid = $row[0];
$quoteauthor = $row[1];
}
if (isset($postid)) {
$sql = $mysqli->query("SELECT post FROM cpost WHERE id='$postid' LIMIT 1");
$row = $sql->fetch_array();
$quotedpost = stripedit($row[0]);
}
// Get edit post info
if (isset($_GET['edit'])) {
$eid = $_GET['edit'];
}
if (isset($_GET['tedit'])) {
$teid = $_GET['tedit'];
}
if (isset($eid)) {
$sql = $mysqli->query("SELECT postid, author FROM creply WHERE id='$eid' LIMIT 1");
$row = $sql->fetch_array();
$epostid = $row[0];
$eauthor = $row[1];
if ($eauthor != $username AND $lvl == 0) {
unset($epostid);
}
} elseif (empty($eid) AND isset($teid)) {
$eid = $_GET['tedit'];
$sql = $mysqli->query("SELECT postid, author FROM cthread WHERE id='$eid' LIMIT 1");
$row = $sql->fetch_array();
$epostid = $row[0];
$eauthor = $row[1];
if ($eauthor != $username AND $lvl == 0) {
unset($epostid);
}
}
if (isset($epostid)) {
$sql = $mysqli->query("SELECT post FROM cpost WHERE id='$epostid' LIMIT 1");
$row = $sql->fetch_array();
$editpost = stripedit($row[0]);
}
?>
<legend>Post Reply</legend>
<form name="form1" method="post" action="post_reply.php">
<textarea name="reply" id="area1" class="span12" rows="10">
<? if(isset($quotedpost)){ echo"[quote=$quoteauthor]"; echo "$quotedpost"; echo'[/quote]'; } elseif(isset($editpost)) { echo"$editpost"; } ?>
</textarea>
<input name="tid" type="hidden" id="tid" value="<? echo "$id"; ?>">
<input name="page" type="hidden" id="page" value="<? echo "$pages"; ?>">
<hr>
<button type="submit" class="btn btn-success" name="Submit" value="Submit"><i class="icon-share-alt icon-white"></i> Post Reply</button>
<? if(isset($editpost)) { echo"<input type=\"hidden\" name=\"edit\" value=\"$epostid\">"; } ?>
</form>
</div>
<?
} elseif ($lock == 1) {
?>
<center>This Topic is currently locked!</center>
</div>
<?
}
require_once("members/footer.php");
}
else {
echo "<div align=\"center\" id=\"crimestext\">Please Select A Topic </div>";
require_once("members/footer.php");
}
?>  