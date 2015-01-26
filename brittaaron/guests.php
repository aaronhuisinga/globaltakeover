<?
$mysqli=new mysqli("abweddinglist.db.9808275.hostedresource.com", "abweddinglist", "D7Awthkp2946!", "abweddinglist", 3306);
$pdo=new PDO('mysql:host=abweddinglist.db.9808275.hostedresource.com;dbname=abweddinglist', 'abweddinglist', 'D7Awthkp2946!');
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

if(isset($_POST['orderBy'])) {
	echo "
	<script type='text/javascript'>
	$(document).ready(function (){
		$('.address').click(function () {
			var user = $(this).val();
			$.ajax({
	    	url: 'guests.php',
	      data: {'address':user},
	      type: 'POST',
	      async: false,
	      success:  function(html){
	      	$('#addressEdit').val(html);
	      	$('#addressEdit').attr('user',user);
	      	$('#addr').modal('toggle');
	      },
	      error:  function(html){
	    		alert(\"Failed to pull up address.\");
	      }
	    });
	    return false;
		});
		$('.id,.name,.numguests').click(function () {
			if($(this).hasClass('name')) {
				var orderBy = '`name` ';
			} else if($(this).hasClass('id')) {
				var orderBy = '`id` ';
			} else {
				var orderBy = '`numguests` ';
			}
			if($(this).hasClass('asc') && !$(this).hasClass('name')) {
				orderBy += 'desc';
				var sort = 'desc';
			} else if($(this).hasClass('desc') && !$(this).hasClass('name')) {
				orderBy += 'asc';
				var sort = 'asc';
			}
			if($(this).hasClass('1') && $(this).hasClass('name')) {
				orderBy += 'desc';
				var sort = '2';
			} else if($(this).hasClass('2') && $(this).hasClass('name')) {
				orderBy += 'asc';
				var sort = '3';
			} else if($(this).hasClass('3') && $(this).hasClass('name')) {
				orderBy += 'desc';
				var sort = '4';
			} else if($(this).hasClass('4') && $(this).hasClass('name')) {
				orderBy += 'asc';
				var sort = '1';
			}
			$.ajax({
  	    url: 'guests.php',
  	   	data: {'orderBy':orderBy,'sort':sort},
  	   	type: 'POST',
  	   	async: false,
  	   	success:  function(html){
  	   		$('#all').empty();
  	   		$('#all').append(html);
  	   	}
    	});
		});
	});
	</script>";
	$orderby = $_POST['orderBy'];
	$sort = $_POST['sort'];
	if($orderby == '`name` asc' OR $orderby == '`name` desc') {
		echo '<table class="table table-bordered table-striped table-condensed">
			  	<thead>
			  		<tr>
			  			<th class="id asc">#</th>
			  			<th class="name '.$sort.'">Name</th>
			  			<th class="numguests asc">Plus Count</th>
			  			<th class="invitation">Invite</th>
			  			<th width="25%">Change</th>
			  	</thead>
			  	<tbody>';
		if($sort == '2' OR $sort == '1') {
			$res=$mysqli->query("SELECT `id`, `name`, `numguests`, `invitation` FROM `guests` ORDER BY $orderby");
		} else if($sort == '3') {
			$res=$mysqli->query("SELECT `id`, `name`, `numguests`, `invitation` FROM `guests` ORDER BY SUBSTR(LTRIM(`name`), LOCATE(' ',LTRIM(`name`))) ASC");
		} else {
			$res=$mysqli->query("SELECT `id`, `name`, `numguests`, `invitation` FROM `guests` ORDER BY SUBSTR(LTRIM(`name`), LOCATE(' ',LTRIM(`name`))) DESC");
		}
		while($row=$res->fetch_array()) {
			if($row[3] == '1') { $invite = 'Yes'; } else { $invite = 'No'; }
			echo "<tr class=\"$row[0]\"><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$invite</td>
					  	<td>
					  		<button value=\"$row[0]\" class=\"question btn btn-mini\"><span class=\"icon icon-question-sign\"></span> Question</button>
					  		<button value=\"$row[0]\" class=\"dance btn btn-mini\"><span class=\"icon icon-music\"></span> Dance</button>
					  		<button value=\"$row[0]\" class=\"address btn btn-mini\"><span class=\"icon icon-home\"></span> Address</button>
					  		<button value=\"$row[0]\" class=\"invite btn btn-mini\"><span class=\"icon icon-envelope\"></span> Invite</button>
					  	</td>
					  </tr>";
		}
		echo "</tbody></table>";
		exit();
	}
	echo '<table class="table table-bordered table-striped table-condensed">
			  	<thead>
			  		<tr>
			  			<th class="id '.$sort.'">#</th>
			  			<th class="name '.$sort.'">Name</th>
			  			<th class="numguests '.$sort.'">Plus Count</th>
			  			<th class="invitation">Invite</th>
			  			<th width="25%">Change</th>
			  	</thead>
			  	<tbody>';
	$res=$mysqli->query("SELECT `id`, `name`, `numguests`, `invitation` FROM `guests` ORDER BY $orderby");
	while($row=$res->fetch_array()) {
		if($row[3] == '1') { $invite = 'Yes'; } else { $invite = 'No'; }
		echo "<tr class=\"$row[0]\"><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$invite</td>
				  	<td>
				  		<button value=\"$row[0]\" class=\"question btn btn-mini\"><span class=\"icon icon-question-sign\"></span> Question</button>
				  		<button value=\"$row[0]\" class=\"dance btn btn-mini\"><span class=\"icon icon-music\"></span> Dance</button>
				  		<button value=\"$row[0]\" class=\"address btn btn-mini\"><span class=\"icon icon-home\"></span> Address</button>
				  		<button value=\"$row[0]\" class=\"invite btn btn-mini\"><span class=\"icon icon-envelope\"></span> Invite</button>
				  	</td>
				  </tr>";
	}
	echo "</tbody></table>";
	exit();
}

if(isset($_POST['guestName'])) {
	$res=$mysqli->query("SELECT `id` FROM `guests` WHERE `name` = '".$_POST['guestName']."' LIMIT 1");
	if($res->num_rows > 0) {
		echo "<div class=\"alert\"><span class=\"label label-warning\">Warning!</span> ".$_POST['guestName']." already exists!</div>";	
	} else {
		$mysqli->query("INSERT INTO `guests` (`name`,`numguests`,`address`) VALUES ('".$_POST['guestName']."','".$_POST['plus']."','".$_POST['address']."')");
		echo "<div class=\"alert alert-success\"><span class=\"label label-success\">Success!</span> Successfully added ".$_POST['guestName']." to the guest database!</div>";
  }
	exit();
}
if(isset($_POST['accept'])) {
	$mysqli->query("UPDATE `guests` SET `name` = REPLACE(`name`,'?','') WHERE `id` = '".$_POST['accept']."' LIMIT 1");
	echo $_POST['accept'];
	exit();
} elseif(isset($_POST['delete'])) {
	$mysqli->query("DELETE FROM `guests` WHERE `id` = '".$_POST['delete']."' LIMIT 1");
	echo $_POST['delete'];
	exit();
} elseif(isset($_POST['question'])) {
	$mysqli->query("UPDATE `guests` SET `name` = Concat(`name`,'?') WHERE `id` = '".$_POST['question']."' LIMIT 1");
	echo $_POST['question'];
	exit();
} elseif(isset($_POST['dance'])) {
	$mysqli->query("UPDATE `guests` SET `name` = REPLACE(`name`,'?','') WHERE `id` = '".$_POST['dance']."' LIMIT 1");
	$mysqli->query("UPDATE `guests` SET `name` = Concat(`name`,'!') WHERE `id` = '".$_POST['dance']."' LIMIT 1");
	echo $_POST['dance'];
	exit();
} elseif(isset($_POST['address'])) {
	$res=$mysqli->query("SELECT `address` FROM `guests` WHERE `id` = '".$_POST['address']."' LIMIT 1");
	$row=$res->fetch_array();
	echo $row[0];
	exit();
} elseif(isset($_POST['newAddress'])) {
	$res=$mysqli->query("UPDATE `guests` SET `address` = '".$_POST['newAddress']."' WHERE `id` = '".$_POST['user']."' LIMIT 1");
	echo $_POST['user'];
	exit();
} elseif(isset($_POST['invite'])) {
	$res=$mysqli->query("UPDATE `guests` SET `invitation` = (CASE WHEN `invitation` = '1' THEN '0' ELSE '1' END) WHERE `id` = '".$_POST['invite']."' LIMIT 1");
	echo $_POST['invite'];
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Brittney & Aaron &middot; 8/24/2012</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <!-- NAVBAR
    ================================================== -->
    <div class="container navbar-wrapper" style="margin-top: 15px;">
      <div class="navbar navbar-inverse">
        <div class="navbar-inner">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Guest DB</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="guests.php">Add Guests</a></li>
              <li><a href="guests.php?page=list">Guest List</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!-- /.navbar-inner -->
      </div><!-- /.navbar -->

    <?
    if(isset($_GET['page']) AND $_GET['page'] == 'list') {
    	// Calculate total guests + plusses
    	$res=$mysqli->query("SELECT SUM(`numguests`) FROM `guests`");
    	$row=$res->fetch_array();
    	$plusses=$row['0'];
    	$res=$mysqli->query("SELECT COUNT(*) FROM `guests`");
    	$row=$res->fetch_array();
    	$invited=$row['0'];
    	$total=$invited+$plusses;
    	// Calculate questionable guests + plusses
    	$res=$mysqli->query("SELECT SUM(`numguests`) FROM `guests` WHERE `name` LIKE '%?%'");
    	$row=$res->fetch_array();
    	$qplusses=$row['0'];
    	$res=$mysqli->query("SELECT COUNT(*) FROM `guests` WHERE `name` LIKE '%?%'");
    	$row=$res->fetch_array();
    	$qinvited=$row['0'];
    	$questionable=$qinvited+$qplusses;
    	// Calculate dance only guests + plusses
    	$res=$mysqli->query("SELECT SUM(`numguests`) FROM `guests` WHERE `name` LIKE '%!%'");
    	$row=$res->fetch_array();
    	$dplusses=$row['0'];
    	$res=$mysqli->query("SELECT COUNT(*) FROM `guests` WHERE `name` LIKE '%!%'");
    	$row=$res->fetch_array();
    	$dinvited=$row['0'];
    	$dance=$dinvited+$dplusses;
    	$certain=$total-($questionable+$dance);
    	// Calculate the number of kids
    	$res=$mysqli->query("SELECT SUM(`kids`) FROM `guests`");
    	$row=$res->fetch_array();
    	$kids=$row['0'];
    	// Calculate the number of invitations to sent
    	$res=$mysqli->query("SELECT COUNT(`invitation`) FROM `guests` WHERE `invitation` = '1'");
    	$row=$res->fetch_array();
    	$invites=$row['0'];
	  ?>
	  <p id="gStats"><span title="<? echo "$invited invited guests and $plusses plusses"; ?>"><strong>Total Guests: </strong><? echo number_format($total); ?></span> | <strong>Certain: </strong> <? echo number_format($certain); ?> | <strong>Questionable: </strong> <? echo number_format($questionable); ?> | <strong>Dance Only: </strong> <? echo number_format($dance); ?> | <strong>Invitations: </strong> <? echo number_format($invites); ?></p>
	  
	  <!-- Address Modal -->
		<div id="addr" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="addrLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="addrLabel">Address</h3>
		  </div>
		  <div class="modal-body">
		  	<label for="addressEdit">Address</label>
		    <textarea user="" id="addressEdit" class="span5" rows="6"></textarea>
		  </div>
		  <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button id="saveAddress" class="btn btn-primary">Save changes</button>
		  </div>
		</div>
	  
	  <ul class="nav nav-pills">
			<li class="active"><a href="#all" data-toggle="tab">All Guests</a></li>
			<li><a href="#wedding" data-toggle="tab">Wedding</a></li>
			<li><a href="#question" data-toggle="tab">Questionable</a></li>
			<li><a href="#dance" data-toggle="tab">Dance Only</a></li>
		</ul>
	  
	  <div class="tab-content">
			<div class="tab-pane active" id="all">
			  <table class="table table-bordered table-striped table-condensed">
			  	<thead>
			  		<tr>
			  			<th class="id asc">#</th>
			  			<th class="name 1">Name</th>
			  			<th class="numguests asc">Plus Count</th>
			  			<th class="invitation">Invite</th>
			  			<th width="25%">Change</th>
			  	</thead>
			  	<tbody>
			  		<?
			  		$res=$mysqli->query("SELECT `id`, `name`, `numguests`, `invitation` FROM `guests` ORDER BY `name` ASC");
			  		while($row=$res->fetch_array()) {
			  			if($row[3] == '1') { $invite = 'Yes'; } else { $invite = 'No'; }
				  		echo "<tr class=\"$row[0]\"><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$invite</td>
				  					<td>
				  						<button value=\"$row[0]\" class=\"question btn btn-mini\"><span class=\"icon icon-question-sign\"></span> Question</button>
				  						<button value=\"$row[0]\" class=\"dance btn btn-mini\"><span class=\"icon icon-music\"></span> Dance</button>
				  						<button value=\"$row[0]\" class=\"address btn btn-mini\"><span class=\"icon icon-home\"></span> Address</button>
				  						<button value=\"$row[0]\" class=\"invite btn btn-mini\"><span class=\"icon icon-envelope\"></span> Invite</button>
				  					</td></tr>";
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>
			<div class="tab-pane" id="wedding">
				<table class="table table-bordered table-striped table-condensed">
			  	<thead>
			  		<tr>
			  			<th>#</th>
			  			<th>Name</th>
			  			<th>Plus Count</th>
			  	</thead>
			  	<tbody>
			  		<?
			  		$res=$mysqli->query("SELECT `id`, `name`, `numguests` FROM `guests` WHERE `name` NOT LIKE '%!%' AND `name` NOT LIKE '%?%' ORDER BY `name` ASC");
			  		while($row=$res->fetch_array()) {
				  		echo "<tr class=\"$row[0]\">
				  					<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>
				  					</tr>";
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>
			<div class="tab-pane" id="question">
				<table class="table table-bordered table-striped table-condensed">
			  	<thead>
			  		<tr>
			  			<th>#</th>
			  			<th>Name</th>
			  			<th>Plus Count</th>
			  			<th>Verdict</th>
			  	</thead>
			  	<tbody>
			  		<?
			  		$res=$mysqli->query("SELECT `id`, `name`, `numguests` FROM `guests` WHERE `name` LIKE '%?%' ORDER BY `name` ASC");
			  		while($row=$res->fetch_array()) {
				  		echo "<tr class=\"$row[0]\">
				  					<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>
				  					<td>
				  						<button value=\"$row[0]\" class=\"accept btn btn-success btn-mini\"><span class=\"icon icon-check icon-white\"></span> Accept</button>
				  						<button value=\"$row[0]\" class=\"delete btn btn-danger btn-mini\"><span class=\"icon icon-trash icon-white\"></span> Delete</button>
				  					</td></tr>";
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>
			<div class="tab-pane" id="dance">
				<table class="table table-bordered table-striped table-condensed">
			  	<thead>
			  		<tr>
			  			<th>#</th>
			  			<th>Name</th>
			  			<th>Plus Count</th>
			  	</thead>
			  	<tbody>
			  		<?
			  		$res=$mysqli->query("SELECT `id`, `name`, `numguests` FROM `guests` WHERE `name` LIKE '%!%' ORDER BY `name` ASC");
			  		while($row=$res->fetch_array()) {
				  		echo "<tr class=\"$row[0]\">
				  					<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>
				  					</tr>";
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>
		</div>

	  <?
    } else {
    ?>

    <div class="well">
  		<p class="lead">To add guests to the wedding database, simply use the form below!</p> 	
    	<form id="addGuest" action="guests.php" method="POST">
    		<label for="guestName">Guest Name</label>
    		<input type="text" class="span6" id="guestName" name="guestName">
    		<label for="plus">Plus Count</label>
    		<select id="plus" class="span6" name="plus">
    			<option value="0">0</option>
    			<option value="1">1</option>
    			<option value="2">2</option>
    			<option value="3">3</option>
    			<option value="4">4</option>
    			<option value="5">5</option>
    			<option value="6">6</option>
    			<option value="7">7</option>
    			<option value="8">8</option>
    		</select>
    		<label for="address">Address</label>
    		<textarea id="address" name="address" class="span6" rows="5"></textarea>
    		<hr>
    		<input type="submit" id="addBtn" class="btn btn-success" value="Submit">
    	</form>
    </div>
    <? } ?>

    </div><!-- /.container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    	$('#addBtn').click(function () {
    		if($('#guestName').val() != '') {
					$.ajax({
			    	url: 'guests.php',
			      data: {'guestName':$('#guestName').val(),'plus':$('#plus').val(),'address':$('#address').val()},
			      type: 'POST',
			      async: false,
			      success:  function(html){
			      	$('.alert').remove();
			      	$('#guestName').val('');
			      	$('#address').val('');
			      	$('#plus').val('0');
			      	$('#addGuest').prepend(html);
			      	return false;
			      },
			      error:  function(html){
			    		alert("Failed to submit!");
			      }
			    });
			  }
		    return false;
			});
			$('.accept').click(function () {
				$.ajax({
		    	url: 'guests.php',
		      data: {'accept':$(this).val()},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('.'+html).addClass('success');
		      	return false;
		      },
		      error:  function(html){
		    		alert("Failed to accept!");
		      }
		    });
		    return false;
			});
			$('.delete').click(function () {
				$.ajax({
		    	url: 'guests.php',
		      data: {'delete':$(this).val()},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('.'+html).addClass('error');
		      	return false;
		      },
		      error:  function(html){
		    		alert("Failed to delete!");
		      }
		    });
		    return false;
			});
			$('.question').click(function () {
				$.ajax({
		    	url: 'guests.php',
		      data: {'question':$(this).val()},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('.'+html).addClass('warning');
		      	return false;
		      },
		      error:  function(html){
		    		alert("Failed to change!");
		      }
		    });
		    return false;
			});
			$('.dance').click(function () {
				$.ajax({
		    	url: 'guests.php',
		      data: {'dance':$(this).val()},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('.'+html).addClass('warning');
		      	return false;
		      },
		      error:  function(html){
		    		alert("Failed to add to dance list!");
		      }
		    });
		    return false;
			});
			$('.invite').click(function () {
				$.ajax({
		    	url: 'guests.php',
		      data: {'invite':$(this).val()},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('.'+html).addClass('info');
		      	return false;
		      },
		      error:  function(html){
		    		alert("Failed to change invite status");
		      }
		    });
		    return false;
			});
			$('.address').click(function () {
				var user = $(this).val();
				$.ajax({
		    	url: 'guests.php',
		      data: {'address':user},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('#addressEdit').val(html);
		      	$('#addressEdit').attr('user',user);
		      	$('#addr').modal('toggle');
		      },
		      error:  function(html){
		    		alert("Failed to pull up address.");
		      }
		    });
		    return false;
			});
			$('#saveAddress').click(function () {
				$.ajax({
		    	url: 'guests.php',
		      data: {'newAddress':$('#addressEdit').val(),'user':$('#addressEdit').attr('user')},
		      type: 'POST',
		      async: false,
		      success:  function(html){
		      	$('.alert').remove();
		      	$('#addr').modal('toggle');
		      	$('.'+html).addClass('success');
		      	$('#gStats').before('<div class="alert alert-success"><span class="label label-success">Success!</span> Successfully updated the address.</div>');
		      },
		      error:  function(html){
		    		alert("Failed to pull up address.");
		      }
		    });
		    return false;
			});
			$(document).ready(function (){
				$('.id,.name,.numguests').click(function () {
					if($(this).hasClass('name')) {
						var orderBy = '`name` ';
					} else if($(this).hasClass('id')) {
						var orderBy = '`id` ';
					} else {
						var orderBy = '`numguests` ';
					}
					if($(this).hasClass('asc') && !$(this).hasClass('name')) {
						orderBy += 'desc';
						var sort = 'desc';
					} else if($(this).hasClass('desc') && !$(this).hasClass('name')) {
						orderBy += 'asc';
						var sort = 'asc';
					}
					if($(this).hasClass('1') && $(this).hasClass('name')) {
						orderBy += 'desc';
						var sort = '2';
					} else if($(this).hasClass('2') && $(this).hasClass('name')) {
						orderBy += 'asc';
						var sort = '3';
					} else if($(this).hasClass('3') && $(this).hasClass('name')) {
						orderBy += 'desc';
						var sort = '4';
					} else if($(this).hasClass('4') && $(this).hasClass('name')) {
						orderBy += 'asc';
						var sort = '1';
					}
					$.ajax({
      	    url: 'guests.php',
      	   	data: {'orderBy':orderBy,'sort':sort},
      	   	type: 'POST',
      	   	async: false,
      	   	success:  function(html){
      	   		$('#all').empty();
      	   		$('#all').append(html);
      	   	}
        	});
				});
			});
    </script>
  </body>
</html>