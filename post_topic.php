<?
$title="Post New Topic";
require_once("members/config.php");
require_once("members/header.php");
include("fbanned.php");
include("members/striphtml.php");
checks();

$result = $mysqli->query("SELECT lpost, username FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row = $result->fetch_array();
$lpost = $row[0];
$author=stripslashes($row[1]);

if (isset($_POST['post'])) { #check to see if a post is made

	$title=addslashes(htmlspecialchars($_POST['title'])); #post the title
	$post=stripHTML(addslashes($_POST['post'])); #post the post
	
	if ($post == NULL OR $post == '' OR $title == NULL OR $title == '') {
	echo ("<div class=\"alert alert-danger\"><span class=\"label label-important\">Error!</span> You left one or more fields blank.</div>");
	echo $_POST['title'];
	echo $_POST['post'];
	require_once("members/footer.php");
	exit();
	}
	
	$npost = (time() + 15);
	if (time() <= $lpost) {
	echo ("<div class=\"alert alert-danger\"><span class=\"label label-important\">Error!</span> You have already made a post in the last 15 seconds!</div>");
	require_once("members/footer.php");
	exit();
	}
	
	$mysqli->query("INSERT INTO post (post) VALUES ('$post')"); 
	$res=$mysqli->query("SELECT `id` FROM post ORDER BY id DESC LIMIT 1");
	$pid=$res->fetch_assoc();
	$pid=$pid['id'];

	$mysqli->query("UPDATE Players SET lpost='$npost', posts=(posts+1) WHERE id = '$_COOKIE[id]' LIMIT 1");
	if(!isset($_POST['board'])) {
	$mysqli->query("INSERT INTO `thread` (`title` , `postid` , `view` , `author` , `time` , `count`, `date`) VALUES ('$title', '$pid', '0', '$author', '".time()."', '1', '$date')");
	} else {
		if($_POST['board'] == 'sales') {
			$mysqli->query("INSERT INTO `thread` (`title` , `postid` , `view` , `author` , `time` , `count`, `date`, `sales`) VALUES ('$title', '$pid', '0', '$author', '".time()."', '1', '$date', 'yes')");
		} elseif($_POST['board'] == 'vip') {
			$mysqli->query("INSERT INTO `thread` (`title` , `postid` , `view` , `author` , `time` , `count`, `date`, `vip`) VALUES ('$title', '$pid', '0', '$author', '".time()."', '1', '$date', 'yes')");
		}
	}
	
	$res=$mysqli->query("SELECT `id` FROM `thread` ORDER BY id DESC LIMIT 1");
	$tid=$res->fetch_assoc();
	$id=$tid['id'];
	
	echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=topic.php?id=$id&page=1\"></head>
	<div align=\"center\" id=\"crimestext\">Topic successfully posted. Redirecting...</div>";
	require_once("members/footer.php");
}
?> 