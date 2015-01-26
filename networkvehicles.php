<?php
require_once("members/config.php");
checks();
online();
$res=$mysqli->query("SELECT `corps`, `health` FROM Players WHERE id='$_COOKIE[id]' LIMIT 1");
$row=$res->fetch_array();
$netid=$row[0];
$health=$row[1];
$res=$mysqli->query("SELECT * FROM Corps WHERE id='$netid' LIMIT 1");
$row=$res->fetch_assoc();
$network=$row['name'];
$vs=$row['vehicles'];
$staff=array($row['owner'],$row['co'],$row['leftl'],$row['rightl'],$row['leftro'],$row['rightro']);
$title = "$network Garage";

// Sell, Repair, Transfer, or Donate
if(isset($_POST['type'])) {
	if($_POST['action'] == 'donate') {
		$count=0;
		foreach($_POST['vehicles'] as $x) {
			$res=$mysqli->query("SELECT `vehicle`,`percent` FROM `garage` WHERE `username`='$_COOKIE[id]' AND `id`='$x' LIMIT 1");
			if($res->num_rows == 0) {
				echo '<div class="alert alert-error"><span class="label label-important">Error!</span> The selected vehicle(s) do not exist or do not belong to you.</div>';
				exit();
			} else {
				$row=$res->fetch_array();
				$mysqli->query("INSERT INTO `cgarage` (`corp`,`vehicle`,`percent`,`type`) VALUES ('$netid','$row[0]','$row[1]','$_POST[type]')");
				$mysqli->query("DELETE FROM `garage` WHERE `username`='$_COOKIE[id]' AND `id`='$x' LIMIT 1");
			}
			$count++;
		}
		echo "<div class=\"page-header\"><h2>$network Vehicles</h2></div>";
		echo '<div class="alert alert-success"><span class="label label-success">Success!</span> Successfully donated '.$count.' vehicles to '.$network.'. Redirecting...</div>';
		echo '<meta http-equiv="REFRESH" content="3;url=networkvehicles.php">';
		exit();
	}
	// For other actions, authenticate the user
	if(($vs == '0' AND in_array($_COOKIE['id'], $staff)) OR $vs == '1') {
		if($_POST['action'] == 'calcrepair') {
			// Calculate the cost to repair the vehicles	
			$count=0;
			$cost=0;
			foreach($_POST['vehicles'] as $x) {
				$res=$mysqli->query("SELECT `vehicle`,`percent` FROM `cgarage` WHERE `corp`='$netid' AND `id`='$x' LIMIT 1");
				if($res->num_rows == 0) {
					echo '<div class="alert alert-error"><span class="label label-important">Error!</span> The selected vehicle(s) do not exist or do not belong to your network.</div>';
					exit();
				} else {
					$row=$res->fetch_array();
					$percent=(100-$row[1])/100;
					$car=$row[0];
					$cars=array('10000'=>'Jeep','25000'=>'Hummer H3','55000'=>'Range Rover','75000'=>'Lamborghini Gallardo','125000'=>'Ferrari 458','200000'=>'Patrol Car','500000'=>'Bugatti Veyron','700000'=>'Tank');
					$cost+=array_search('Jeep', $cars)*$percent;
					// Add the tax per vehicle
					$cost+=1500;
				}
				$count++;
			}
			echo "Repair $count vehicles for $".number_format($cost)."?";
			exit();
		} else if($_POST['action'] == 'repair') {
			// Repair the selected Vehicles
			$count=0;
			foreach($_POST['vehicles'] as $x) {
				$res=$mysqli->query("SELECT `vehicle`,`percent` FROM `cgarage` WHERE `corp`='$netid' AND `id`='$x' LIMIT 1");
				if($res->num_rows == 0) {
					echo '<div class="alert alert-error"><span class="label label-important">Error!</span> The selected vehicle(s) do not exist or do not belong to you.</div>';
					exit();
				} else {
					$row=$res->fetch_array();
					$mysqli->query("INSERT INTO `cgarage` (`corp`,`vehicle`,`percent`,`type`) VALUES ('$netid','$row[0]','$row[1]','$_POST[type]')");
					$mysqli->query("DELETE FROM `garage` WHERE `username`='$_COOKIE[id]' AND `id`='$x' LIMIT 1");
				}
				$count++;
			}
			echo "<div class=\"page-header\"><h2>$network Vehicles</h2></div>";
			echo '<div class="alert alert-success"><span class="label label-success">Success!</span> Successfully donated '.$count.' vehicles to '.$network.'. Redirecting...</div>';
			echo '<meta http-equiv="REFRESH" content="3;url=networkvehicles.php">';
			exit();
		}
	} else {
		echo '<div class="alert alert-error"><span class="label label-important">Error!</span> You do not have access to this action.</div>';
		exit();
	}
}

require_once("members/header.php");
if($netid == 'None') {
	header('Location: index.php');
	exit();
}
echo "<div class=\"page-header\"><h2>$network Vehicles</h2></div>";
?>
<ul class="nav nav-pills">
  <li class="active">
    <a href="#garage" data-toggle="tab">Garage</a>
  </li>
  <li><a href="#hanger" data-toggle="tab">Hanger</a></li>
  <li><a href="#dock" data-toggle="tab">Dock</a></li>
</ul>

<div class="tab-content">
	<div id="garage" class="tab-pane active well">
				<form action="garage.php" method="post">
				<legend><? echo("$network"); ?> Garage</legend>
				<table class="table table-striped table-bordered table-condensed">
				  <thead>
				  	<tr>
				    <th>Vehicle</th>
				    <th>Percent</th>
				    <? if(($vs == '0' AND in_array($_COOKIE['id'], $staff)) OR $vs == '1') { ?>
				    <th>Select</th>
				    <? } ?>
				  	</tr>
				  </thead>
				  <tbody>
		<?
					$res=$mysqli->query("SELECT * FROM `cgarage` WHERE `corp`='$netid' AND `type`='car' ORDER BY `vehicle` ASC"); 
					while ($row=$res->fetch_assoc()){
					  echo "<tr>
										<td>$row[vehicle]</td>
										<td>$row[percent]%</td>";
										if(($vs == '0' AND in_array($_COOKIE['id'], $staff)) OR $vs == '1') { ?>
										<td><input name="gVehicles[]" id="gVehicles" class="g" type="checkbox" value="<? echo $row['id']; ?>"></td>
										<? }
					  echo "</tr>";
				 }
		?>
				  </tbody>
				</table>
			<? if(($vs == '0' AND in_array($_COOKIE['id'], $staff)) OR $vs == '1') { ?>
			<div class="form-inline">
				<input name="Submit" id="sgBtn" type="submit" class="btn btn-primary" value="Sell">
				<input name="Submit" id="rgBtn" type="submit" class="btn btn-primary" value="Repair">
				<div class="input-append">
					<input type="text" name="gTo" id="gTo" placeholder="Username"><input name="Submit" id="tgBtn" type="submit" class="btn btn-primary" value="Transfer">
				</div>
			</div>
			</form>
			<? } ?>
			<br>
			<legend>Your Garage</legend>
			<form action="networkvehicles.php" method="POST">
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
			    	<th>Vehicle</th>
			    	<th>Percent</th>
			    	<th>Select</th>
			  	</tr>
				</thead>
				<tbody>
					<?
					$res=$mysqli->query("SELECT `id`,`vehicle`,`percent` FROM `garage` WHERE `username`='$_COOKIE[id]' AND `type` = 'car'"); 
					while ($row=$res->fetch_assoc()){
				  	echo "<tr>
										<td>$row[vehicle]</td>
										<td>$row[percent]%</td>
										<td><input name=\"donateg[]\" class=\"dg\" type=\"checkbox\" value=\"$row[id]\"></td>
									</tr>";
			 		}
					?>
				</tbody>
			</table>
		<input name="Submit" id="dgBtn" type="submit" class="btn btn-primary" value="Donate">
		</form>
	</div>
	<div id="hanger" class="tab-pane well">
	</div>
	<div id="dock" class="tab-pane well">
	</div>
	
	<!-- Modal for vehicle action confirmations -->
	<div class="modal hide" id="action" tabindex="-1" role="dialog" aria-labelledby="actionLabel" aria-hidden="true">
		<div class="modal-header">
	  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	  	<h3 id="actionLabel">Sell Vehicles</h3>
	  </div>
	  <div class="modal-body" id="actionBody">
	  	Some generic filler text. Good on you if you find me.
	  </div>
	  <div class="modal-footer">
	  	<input type="submit" class="btn btn-success actionBtn" id="actionBtn" value="Action">
	  	<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Cancel</button>
	  </div>
	</div>
	
</div>
<script type='text/javascript'>
$(document).ready(function (){
	$('#sgBtn').click(function () {
		var vehicles = new Array();
		$(".g:checked").each(function() {
			vehicles.push($(this).val());
		});
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'car','action':'sell','vehicles':vehicles},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#rgBtn').click(function () {
		var vehicles = new Array();
		$(".g:checked").each(function() {
			vehicles.push($(this).val());
		});
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'car','action':'calcrepair','vehicles':vehicles},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#actionLabel,#actionBody').empty();
      	$('#actionLabel').append('Repair Vehicles');
      	$('#actionBody').append(html);
      	$('.actionBtn').val('Repair');
      	$('#action').modal('show');
      }
    });
    return false;
	});
	$("#actionBtn").click(function () {
		var vehicles = new Array();
		$(".g:checked").each(function() {
			vehicles.push($(this).val());
		});
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'car','action':$("#actionBtn").val(),'vehicles':vehicles},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#tgBtn').click(function () {
		var vehicles = new Array();
		$(".g:checked").each(function() {
			vehicles.push($(this).val());
		});
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'car','action':'transfer','user':$('#gTo').val(),'vehicles':vehicles},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#dgBtn').click(function () {
		var vehicles = new Array();
		$(".dg:checked").each(function() {
			vehicles.push($(this).val());
		});
		console.log(vehicles);
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'car','action':'donate','vehicles':vehicles},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	
	$('#shBtn').click(function () {
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'plane','action':'sell','vehicles':$('[name="hVehicles[]"]').val()},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#rhBtn').click(function () {
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'plane','action':'repair','vehicles':$('[name="hVehicles[]"]').val()},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#thBtn').click(function () {
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'plane','action':'transfer','user':$('#gTo').val(),'vehicles':$('[name="hVehicles[]"]').val()},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#dhBtn').click(function () {
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'plane','action':'donate','vehicles':$('[name="donateh[]"]').val()},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	
	$('#sdBtn').click(function () {
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'boat','action':'sell','vehicles':$('[name="dVehicles[]"]').val()},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#rdBtn').click(function () {
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'boat','action':'repair','vehicles':$('[name="dVehicles[]"]').val()},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#tdBtn').click(function () {
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'boat','action':'transfer','user':$('#gTo').val(),'vehicles':$('[name="dVehicles[]"]').val()},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
	$('#ddBtn').click(function () {
		$.ajax({
    	url: 'networkvehicles.php',
      data: {'type':'boat','action':'donate','vehicles':$('[name="donated[]"]').val()},
      type: 'POST',
      async: false,
      success:  function(html){
      	$('#gplay').empty();
      	$('#gplay').append(html);
      }
    });
    return false;
	});
});
</script>		
<?
require_once("members/footer.php");
?>