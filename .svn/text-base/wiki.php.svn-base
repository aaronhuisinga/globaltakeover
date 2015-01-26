<?
$title="Wiki";
require_once("members/config.php");
checks();
online();
require_once("members/header.php");

$stmt=$pdo->prepare('SELECT rank, username, Level, wteam FROM Players WHERE id= :id LIMIT 1');
$stmt->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_NUM);
$rank=$row[0];
$username=$row[1];
$lvl=$row[2];
$wteam=$row[3];
$aid=$_GET['id'];

function dateFormatter($orig) {
	$timegone=time()-$orig;
	$minsgone=floor($timegone/60);
	$hgone=floor($minsgone/60);
	$dgone=floor($hgone/24);
	$wgone=floor($dgone/7);
	if ($minsgone < 61) {
		return "$minsgone Minutes Ago";
	} elseif ($minsgone > 60 AND $minsgone < 1441) {
		return "$hgone Hours Ago";
	} elseif ($minsgone > 1440 AND $minsgone < 10080) {
		return "$dgone Days Ago";
	} else {
		return "$wgone Weeks Ago";
	}
}

switch ($_GET['action']) {
case "article":
	$stmt=$pdo->prepare('SELECT title, author, article, permission, lastedit, version, leditor, createdate FROM wiki WHERE id= :article LIMIT 1');
	$stmt->bindParam(':article', $_GET['id'], PDO::PARAM_INT);
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_NUM);
	$title=$row[0];
	$author=$row[1];
	$article=$row[2];
	$perms=$row[3];
	$ledit=$row[4];
	$version=$row[5];
	$leditor=$row[6];
	$cdate=$row[7];
	
	$stmt=$pdo->prepare('SELECT (SELECT `id` FROM `Players` WHERE `username` = :author LIMIT 1) AS authid, (SELECT `id` FROM `Players` WHERE `username` = :editor LIMIT 1) AS editid');
	$stmt->bindParam(':author', $author, PDO::PARAM_STR);
	$stmt->bindParam(':editor', $leditor, PDO::PARAM_STR);
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$authorid=$row['authid'];
	$editorid=$row['editid'];
	?>
	<div id="content-header"><h1>Wiki</h1></div>
		<div id="breadcrumb">
			<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
			<a href="wiki.php?action=article&id=1" class="current">Wiki</a>
		</div>
		<br>
		<div class="container-fluid gplay">
	<?
	echo "<div class=\"btn-group\"><a class=\"btn\" href=\"wiki.php?action=create\">Create</a> <a class=\"btn\" href=\"wiki.php?action=edit&id=$aid\">Contribute</a>";if ($aid != 1 AND $wteam == 1) { echo " <a class=\"btn\" href=\"wiki.php?action=delete&id=$aid\">Remove</a>"; }echo"</div><br>";
	
	echo "
	<div class=\"row-fluid\">
	<div class=\"span8\">
		<table class=\"table table-bordered table-striped\">
		<thead>
			<tr><th>$title</th></tr>
		</thead>
		<tbody>
			<tr><td>$article</td></tr>
		</tbody>
		</table>
	</div>
	<div class=\"span4\">
		<table class=\"table table-bordered table-striped\">
		<thead>
			<tr><th>Actions</th></tr>
		</thead>
		<tbody>
			<tr><td><form name='search' action='wiki.php?action=search' method='get'>
							<input type=\"hidden\" name=\"action\" value=\"search\">
							<div class=\"input-append\">
							<input class=\"span8\" placeholder=\"Search Articles\" name=\"term\" type=\"text\"><button class=\"btn\" name='search' value='Search' type=\"submit\">Go</button>
							</div>
							</form></td></tr>";
	if (($perms == "Wiki Team+" AND $wteam == 1) OR ($perms == "Staff Only" AND $lvl != 0) OR $perms == "All Users") { 
		echo "<tr><td><form name=\"perms\" method=\"post\" action=\"wiki.php?action=perms&id=$aid\"><select name='permissions'> <option value='Staff Only'>Staff Only<option value='Wiki Team+'>Wiki Team+<option value='All Users'>All Users</select>
	<br>
	<button class=\"btn btn-small\" name='perms' value='Change' type=\"submit\">Change</button>
	</form></td></tr>"; 
	}
	echo "<tr><td><a href=\"wiki.php?action=browse\">Browse Articles</a></td></tr>
				<tr><td><strong>Protection:</strong>
								<ul><li>Edit: $perms</li></ul>
								<strong>Details:</strong>
								<ul>
									<li>Version: r$version</li>
									<li>Author: <a href=\"profile.php?id=$authorid\">$author</a></li>
									<li>Created: ".dateFormatter($cdate)."</li>
								</ul>
								<strong>History:</strong>
								<ul>
									<li>Last Edited: ".dateFormatter($ledit)."</li>
									<li>Last Editor: <a href=\"profile.php?id=$editorid\">$leditor</a></li>
								</ul>
				</td></tr></tbody></table>";
	echo "</div></div>";
	include("members/footer.php");
break;
case "create":
	if (isset($_POST['create'])) {
		$stmt=$pdo->prepare("INSERT INTO `wiki` ( `id` , `title` , `author` , `article` , `permission` , `lastedit` , `version`, `leditor`, `createdate` ) VALUES ('', :title, :uname, :article, 'All Users', :time, '1.0', :uname, :time)");
		$stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
		$stmt->bindParam(':uname', $username, PDO::PARAM_STR);
		$stmt->bindParam(':article', $_POST['article'], PDO::PARAM_STR);
		$stmt->bindValue(':time', time(), PDO::PARAM_INT);
		$stmt->execute();
		$lid=$pdo->lastInsertId();
		echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=wiki.php?action=article&id=$lid\"></head>
			  	<div class=\"alert alert-success\">Your article has been successfully submitted. Redirecting...</div>";
		include("members/footer.php");
		exit();
	} else {
		if ($wteam == 0) {
			echo "<div id=\"crimestext\" align=\"center\">Currently only wiki team members can create new articles. This will change soon!</div>";
			include("members/footer.php");
			exit();
		}
		echo '<script type="text/javascript" src="members/nicEdit.js"></script> <script type="text/javascript">
							bkLib.onDomLoaded(
		   					function() {
		     					 var niceditor = new nicEditor();
		     					 var niceditorpanel = new nicEditor({
		           					 iconsPath : \'members/nicEditorIcons.gif\',
		          					 buttonList : [\'bold\',\'italic\',\'underline\',\'strikethrough\',\'removeformat\',\'image\',\'link\',\'unlink\',\'forecolor\',\'left\',\'center\',\'right\',\'ol\',\'ul\'],
		           					 bbCode : false,
		           					 xhtml : true
		    					  }).panelInstance(\'area1\');
		                               
		    					  niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
		   					 }
							);
							</script>';
		?>
		<div id="content-header"><h1>Create an Article</h1></div>
			<div id="breadcrumb">
				<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="wiki.php?action=article&id=1" title="Go to Wiki" class="tip-bottom">Wiki</a>
				<a href="#" class="current">Create</a>
			</div>
			<div class="container-fluid gplay">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>Create an Article</h5>
							</div>
							<div class="widget-content nopadding">
								<form name="create" method="post" class="form-horizontal" action="wiki.php?action=create">
									<div class="control-group">
										<label class="control-label">Title</label>
										<div class="controls">
											<input type="text" name="title" id="title" maxlength="100">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Article Content</label>
										<div class="controls">
											<textarea name="article" id="area1" rows="15"></textarea>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-success pull-left" name="create" value="Submit"><i class="icon-arrow-right icon-white"></i> Submit</button>
									</div>
								</form>
							</div>
						</div>						
					</div>
				</div>
			</div>
		<?
		include("members/footer.php");
	}
break ;
case "edit":
	$stmt=$pdo->prepare('SELECT title, article, permission FROM wiki WHERE id= :article LIMIT 1');
	$stmt->bindParam(':article', $_GET['id'], PDO::PARAM_INT);
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	
	if (isset($_POST['edit'])) {		
		$stmt=$pdo->prepare('UPDATE wiki SET title = :title, article = :article, lastedit= :time, version=(version+1), leditor= :uname WHERE id= :aid LIMIT 1');
		$stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
		$stmt->bindParam(':article', $_POST['article'], PDO::PARAM_STR);
		$stmt->bindValue(':time', time(), PDO::PARAM_INT);
		$stmt->bindParam(':uname', $_COOKIE['username'], PDO::PARAM_STR);
		$stmt->bindParam(':aid', $_GET['id'], PDO::PARAM_INT);
		$stmt->execute();
		echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=wiki.php?action=article&id=$_GET[id]\"></head>
			  	<div class=\"alert alert-success\">Successfully edited the article. Redirecting...</div>";
		include("members/footer.php");
		exit();
	} else {
	if (($row['permission'] == "Wiki Team+" AND $wteam == 0) OR ($row['permission'] == "Staff Only" AND $lvl == 0)) {
		echo "<div class=\"alert alert-error\">You do not have permission to edit this article!</div>";
		include("members/footer.php");
		exit();
	}
	echo '<script type="text/javascript" src="members/nicEdit.js"></script> <script type="text/javascript">
						bkLib.onDomLoaded(
	   					function() {
	     					 var niceditor = new nicEditor();
	     					 var niceditorpanel = new nicEditor({
	           					 iconsPath : \'members/nicEditorIcons.gif\',
	          					 buttonList : [\'bold\',\'italic\',\'underline\',\'strikethrough\',\'removeformat\',\'image\',\'link\',\'unlink\',\'forecolor\',\'left\',\'center\',\'right\',\'ol\',\'ul\'],
	           					 bbCode : false,
	           					 xhtml : true
	    					  }).panelInstance(\'area1\');
	                               
	    					  niceditorpanel.nicInstances[0].setContent(niceditorpanel.nicInstances[0].getContent())
	   					 }
						);
						</script>';
	?>
	<div id="content-header"><h1>Edit an Article</h1></div>
	<div id="breadcrumb">
		<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="wiki.php?action=article&id=1" title="Go to Wiki" class="tip-bottom">Wiki</a>
		<a href="#" class="current">Edit</a>
	</div>
	<div class="container-fluid gplay">
	<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-align-justify"></i>									
						</span>
						<h5>Create an Article</h5>
					</div>
					<div class="widget-content nopadding">
						<form name="edit" method="post" class="form-horizontal" action="wiki.php?action=edit&id=<? echo $_GET['id']; ?>">
							<div class="control-group">
								<label class="control-label">Title</label>
								<div class="controls">
									<input type="text" name="title" id="title" value="<? echo $row['title']; ?>" maxlength="100">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Article Content</label>
								<div class="controls">
									<textarea name="article" id="area1" rows="15"><? echo $row['article']; ?></textarea>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-success" name="edit" value="Submit"><i class="icon-arrow-right icon-white"></i> Submit</button>
							</div>
						</form>
					</div>
				</div>						
			</div>
		</div>
	</div>
	<?
	include("members/footer.php");
	}
break;
case "browse":
	?>
	<div id="content-header"><h1>Browse Articles</h1></div>
	<div id="breadcrumb">
		<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="wiki.php?action=article&id=1" title="Go to Wiki" class="tip-bottom">Wiki</a>
		<a href="#" class="current">Browse</a>
	</div>
	<br>
	<div class="container-fluid gplay">
	<?
	echo "<table class=\"table table-striped table-bordered table-condensed\">
	<thead><tr><th>Article</th> <th>Last Updated</th> <th>Author</th></tr></thead><tbody>";
	$res=$mysqli->query("SELECT title, author, lastedit, id FROM wiki ORDER BY title ASC");
	while ($row=$res->fetch_array()){
	$aid=$mysqli->query("SELECT id FROM Players WHERE username='$row[1]' LIMIT 1");
	$row2=$aid->fetch_array();
	echo "<tr>
					<td><a href=\"wiki.php?action=article&id=$row[3]\">$row[0]</a></td>
					<td>".dateFormatter($row[2])."</td> <td><a href=\"profile.php?id=$row2[0]\">$row[1]</a></td>
				</tr>";
	}
	echo "</tbody></table></div>";
	include("members/footer.php");
break;
case "perms":
	if (isset($_POST['perms'])) {
		if ($wteam == 1) {
			$mysqli->query("UPDATE wiki SET permission='$_POST[perms]' WHERE id='$_GET[id]' LIMIT 1");
			echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=wiki.php?action=article&id=$aid\"></head>
			      <div class=\"alert alert-success\">Successfully changed article edit permissions. Redirecting...</div>";
		} else {
			echo "<div class=\"alert alert-error\">You must be a member of the wiki team to edit article permissions!</div>";
		}
	} else {
		echo "<div class=\"alert alert-error\">You must select an article to change permissions for!</div>";
	}
	include("members/footer.php");
	exit();
break;
case "delete":
	if ($wteam == 1) {
		$mysqli->query("DELETE FROM wiki WHERE id='$_GET[id]' LIMIT 1");
		echo "<head><meta HTTP-EQUIV=\"REFRESH\" content=\"2; url=wiki.php?action=article&id=1\"></head>
			  	<div class=\"alert alert-success\">Successfully deleted the article. Redirecting...</div>";
	} else {
		echo "<div class=\"alert alert-error\">You don't have permission to delete this article!</div>";
	}
	include("members/footer.php");
	exit();
break;
case "search":
	if (empty($_GET['term'])) {
		echo "<div class=\"alert alert-success\">You must enter a term to search for!</div>" ;
	}
	?>
	<div id="content-header"><h1>Search Results</h1></div>
	<div id="breadcrumb">
		<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="wiki.php?action=article&id=1" title="Go to Wiki" class="tip-bottom">Wiki</a>
		<a href="#" class="current">Results for "<? echo $_GET['term']; ?>"</a>
	</div>
	<br>
	<div class="container-fluid gplay">
	<?
	echo "<table class=\"table table-bordered table-striped table-condensed\">
					<thead>
					<tr><th>Article</th> <th>Last Updated</th> <th>Author</th></tr>
					</thead>
					<tbody>";
	$stmt=$pdo->prepare("SELECT * FROM wiki WHERE title LIKE :search");
	$stmt->bindValue(':search', '%'.$_GET['term'].'%', PDO::PARAM_STR);
	$stmt->execute();
	if ($stmt->rowCount() == 0) {
		echo "<tr><td colspan=\"3\">No Results Were Found For <em>$_GET[term]</em>.</td><tr></tbody></table>";
	}
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$aid=$mysqli->query("SELECT id FROM Players WHERE username='$row[author]' LIMIT 1");
		$row2=$aid->fetch_array();
		echo "<tr>
						<td><a href=\"wiki.php?action=article&id=$row[id]\">$row[title]</a></td>
						<td>".dateFormatter($row['lastedit'])."</td>
						<td><a href=\"profile.php?id=$row2[0]\">$row[author]</a></td>
					</tr>";
	}
	echo "</tbody></table></div>";
	include("members/footer.php");
	exit();
break;
}
?>