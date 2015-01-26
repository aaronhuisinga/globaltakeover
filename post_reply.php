<?
$title="Post Reply";
require_once("members/config.php");
require_once("members/header.php");
include("fbanned.php");
include("members/striphtml.php");
checks();
online();

$result = $mysqli->query("SELECT lpost, username FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row = $result->fetch_array();
$lpost = $row[0];
$author=stripslashes($row[1]);
$npost = (time() + 15);

// Post editor
if (isset($_POST['edit'])){
$pid=$_POST['edit'];
$page=$_POST['page'];
$tid=addslashes(htmlspecialchars($_POST['tid']));
$reply="$_POST[reply]

[edit]Last edited on $date by $author\[/edit]";
$reply=stripHTML(addslashes($reply));

$mysqli->query("UPDATE post SET post='$reply' WHERE id='$pid' LIMIT 1");

echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=topic.php?id=$tid&page=$page#$pid\"></head>
<div align=\"center\" id=\"crimestext\">Post successfully edited. Redirecting...</div>";
require_once("members/footer.php");
exit();
}

// New Reply
if (time() <= $lpost) {
echo ("<div align=\"center\" id=\"crimestext\">You have already made a post in the last 15 seconds!<br /><a href=\"javascript: history.go(-1)\">Go back.</a></div>");
require_once("members/footer.php");
exit();
}

if (isset($_POST['tid'])){
$page=$_POST['page'];
$tid=addslashes(htmlspecialchars($_POST['tid']));
$reply=stripHTML(addslashes($_POST['reply']));

if ($reply == NULL) {
echo ("<div align=\"center\" id=\"crimestext\">You cannot leave the post field blank!<br /><a href=\"javascript: history.go(-1)\">Go back.</a></div>");
require_once("members/footer.php");
exit();
}

$mysqli->query("INSERT INTO post (post) VALUES ('$reply')"); 
$res=$mysqli->query("SELECT * FROM `post` ORDER BY `id` DESC LIMIT 1");
$pid=$res->fetch_assoc(); 
$pid=$pid['id'];

$mysqli->query("UPDATE Players SET lpost='$npost', posts=(posts+1) WHERE id = '$_COOKIE[id]' LIMIT 1");
$mysqli->query("INSERT INTO `reply` (`postid` , `topicid` , `author` , `time`, `date` ) VALUES ('$pid', '$tid', '$author', '".time()."', '$date')");
$mysqli->query("UPDATE thread SET time='".time()."' WHERE id = '$tid' LIMIT 1");
echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=topic.php?id=$tid&page=$page#$pid\"></head>
<div align=\"center\" id=\"crimestext\">Reply successfully added. Redirecting...</div>";
require_once("members/footer.php");
}
else {
echo "<div align=\"center\" id=\"crimestext\">This is not a valid topic number.<br /><a href='forum.php?page=1'>Go Back.</a></div>";
require_once("members/footer.php");
}
?> 