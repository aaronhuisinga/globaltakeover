<?php
$title="Organized Robbery > Edit Advertisement";
include('config.php');
include("header.php");
include('striphtml.php');
checks(); 
  
$row=mysql_fetch_array(mysql_query("SELECT username FROM Players WHERE id='{$_COOKIE[id]}' LIMIT 1;"));
$u = $row[0];

$row=mysql_fetch_array(mysql_query("SELECT postid, title FROM thread WHERE author='$u' AND ads='yes' LIMIT 1;"));
$postid = $row[0];
$title = $row[1];
$row=mysql_fetch_array(mysql_query("SELECT post FROM post WHERE id='$postid' LIMIT 1;"));
$content = $row[0];
  if(!$_POST['post']){ 
  echo '<script type="text/javascript" src="nicEdit.js"></script> <script type="text/javascript">
					bkLib.onDomLoaded(
   					function() {
     					 var niceditor = new nicEditor();
     					 var niceditorpanel = new nicEditor({
           					 iconsPath : \'nicEditorIcons.gif\',
          					 buttonList : [\'bold\',\'italic\',\'underline\',\'strikethrough\',\'removeformat\',\'image\',\'link\',\'unlink\',\'forecolor\'],
           					 bbCode : false,
           					 xhtml : true
    					  }).panelInstance(\'area1\');
                               
    					  niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
   					 }
					);
					</script>';
		echo "
		<div id=\"ltable\" align=\"center\">
		<form method=\"POST\">
		<h1>Edit Advertisement</h1>
		<table align=\"center\">
		<tr align=\"center\"><td>Title: <input type=\"text\" name=\"title\" value=\"$title\" size=\"42\" maxlength=\"75\" ></td></tr>
		<tr><td><textarea name=\"content\" id=\"area1\" rows=\"15\" cols=\"40\">$content</textarea></td></tr>
		</table>
		<input name=\"id\" type=\"hidden\" id=\"id\" value=\"$id\">
		<p align=\"center\"><input type=\"submit\" value=\"Edit\" name=\"post\"></p>
		</form>
		</div>";
		include("footer.php");
}else{
  $content = stripHTML(addslashes($_POST['content']));
  $id = htmlspecialchars($_POST['id']);
  $title = htmlspecialchars(addslashes($_POST['title']));

  mysql_query("UPDATE post SET post = '$content' WHERE id = '$postid' LIMIT 1;");
  mysql_query("UPDATE thread SET title = '$title' WHERE author='$u' AND ads='yes' LIMIT 1;");
  echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=OR.php\"></head>
		<div align=\"center\" id=\"crimestext\">Successfully edited your OR advertisement. Redirecting...</div>";
  include("footer.php");
  }
?>