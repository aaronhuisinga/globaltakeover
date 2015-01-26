<?php
$title="Garage";
require_once("members/config.php");
checks();
online();
require_once("members/header.php");

if(isset($_POST['sell']) OR isset($_POST['repair'])) {
	$res=$mysqli->query("SELECT `money` FROM `Players` WHERE `id`='$_COOKIE[id]' LIMIT 1");
	$row=$res->fetch_array();
	if(!isset($_POST['checkbox']) OR $_POST['checkbox'] == '') {
		echo '<div class="alert alert-error">You must select at least one vehicle</div>';	
	} else {
		if(isset($_POST['repair'])) {
			if($row[0] < str_replace(",", '', $_POST['price'])) {
				echo '<div class="alert alert-error">You cannot afford to repair these vehicles</div>';
			} else {
				foreach($_POST['checkbox'] AS $x) {
					$mysqli->query("UPDATE `garage` SET `percent` = '100' WHERE `id`='$x' LIMIT 1");
				}
				$mysqli->query("UPDATE `Players` SET `money`=(`money`-".str_replace(",", '', $_POST['price']).") WHERE `id`='$_COOKIE[id]' LIMIT 1");
				echo '<div class="alert alert-success">Successfully repaired the selected vehicles for $'.$_POST['price'].'</div>';
			}
		} elseif(isset($_POST['sell'])) {
			foreach($_POST['checkbox'] AS $x) {
				$mysqli->query("DELETE FROM `garage` WHERE `id`='$x' LIMIT 1");
			}
			$mysqli->query("UPDATE `Players` SET `money`=(`money`+".str_replace(",", '', $_POST['price']).") WHERE `id`='$_COOKIE[id]' LIMIT 1");
			echo '<div class="alert alert-success">Successfully sold the selected vehicles for $'.$_POST['price'].'</div>';
		}
	}
}

?>
<script type="text/javascript">
$(document).ready(function() {
	$(".checkAll").click(function () {
		var targetDiv = $(this).parents().eq(2).attr('id');
		$("#"+targetDiv+" input:checkbox").attr('checked', 'checked');
	});
	$(".removeAll").click(function () {
		var targetDiv = $(this).parents().eq(2).attr('id');
		$("#"+targetDiv+" input:checkbox").removeAttr('checked');
	});
	$(".sell,.repair").click(function () {
		var targetDiv = $(this).parents().eq(2).attr('id');
			totalVal = 0;
		if($(this).attr('name') == 'sell') {
			$("#"+targetDiv+" input:checkbox").each(function() {
				if($(this).is(':checked')) {
					totalVal = parseInt(totalVal)+parseInt($(this).attr('worth'));
				}
			});	
		} else if($(this).attr('name') == 'repair') {
			$("#"+targetDiv+" input:checkbox").each(function() {
				if($(this).is(':checked')) {
					var repairVal = parseInt($(this).attr('orig'))-parseInt($(this).attr('worth'));
					totalVal = parseInt(totalVal)+parseInt(repairVal);
				}
			});
		}
		if(totalVal == 0) { return false; }
		$('#aType').empty().text($(this).attr('name'));
		$('#aCost').empty().text(totalVal.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
		$('#submitYes').val(targetDiv).attr('name', $(this).attr('name'));
		$('#confirmModal').modal();
	});
	$("#submitYes").click(function() {
		$('#'+$(this).val()+"Form").append("<input type=\"hidden\" name=\""+$(this).attr('name')+"\" value=\""+$(this).val()+"\">");
		$('#'+$(this).val()+"Form").append("<input type=\"hidden\" name=\"price\" value=\""+$('#aCost').text()+"\">");
		$('#'+$(this).val()+"Form").submit();
	});
	
});
</script>
<div class="page-header"><h1>Garage <small>Repair, Sell, or Admire your vehicles</small></h1></div>
<? prisonCheck(); ?>

<div class="modal hide fade" id="confirmModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Confirm action</h3>
  </div>
  <div class="modal-body">
    <p>Are you sure you want to <span id="aType"></span> these vehicles for $<span id="aCost"></span>?</p>
  </div>
  <div class="modal-footer">
    <button class="btn" val="no" data-dismiss="modal">No</button>
    <button class="btn btn-success" id="submitYes">Yes</button>
  </div>
</div>

<ul class="nav nav-pills">
  <li class="active">
    <a href="#garage" data-toggle="tab">Garage</a>
  </li>
  <li><a href="#hanger" data-toggle="tab">Hanger</a></li>
  <li><a href="#dock" data-toggle="tab">Dock</a></li>
</ul>

<div class="tab-content">
	<div id="garage" class="tab-pane active well">
		<div class="btn-toolbar">
			<div class="btn-group">
				<button class="btn btn-small checkAll"><i class="icon-plus"></i> Check All</button>
				<button class="btn btn-small removeAll"><i class="icon-minus"></i> Uncheck All</button>
			</div>
			<div class="btn-group">
				<button type="submit" name="sell" class="btn btn-small sell"><i class="icon-shopping-cart"></i> Sell Selected</button>
				<button type="submit" name="repair" class="btn btn-small repair"><i class="icon-tag"></i> Repair Selected</button>
			</div>
		</div>
		<br>
		<form action="garage.php" id="garageForm" method="post">
		<table class="table table-condensed table-striped table-bordered">
		<thead>
		  <tr>
		    <th>Vehicle</th>
		    <th>Value</th>
		    <th>Percentage</th>
		    <th>Select</th>
		  </tr>
		</thead><tbody>
		<?
		$res=$mysqli->query("SELECT * FROM `garage` WHERE `username`='$_COOKIE[id]' AND `type`='car' ORDER BY `vehicle` ASC"); 
		if ($res->num_rows < 1) {
			echo "<tr><td colspan=\"4\">You currently do not own any vehicles.</td></tr>";
		} else {
			while ($row=$res->fetch_assoc()) {
				$car=$row['vehicle'];
				$percent=$row['percent'];
				$np=$row['percent']/100;
				$cid=$row['id'];
				if ($car == 'Jeep') {
					$orig=10000;
					$price=$orig*$np;
				} elseif ($car == 'Hummer H3') {
					$orig=25000;
					$price=$orig*$np;
				} elseif ($car == 'Range Rover') {
					$orig=55000;
					$price=$orig*$np;
				} elseif ($car == 'Lamborghini Gallardo') {
					$orig=75000;
					$price=$orig*$np;
				} elseif ($car == 'Ferrari 458') {
					$orig=125000;
					$price=$orig*$np;
				} elseif ($car == 'Patrol Car') {
					$orig=200000;
					$price=$orig*$np;
				} elseif ($car == 'Bugatti Veyron') {
					$orig=500000;
					$price=$orig*$np;
				} elseif ($car == 'Tank') {
					$orig=700000;
					$price=$orig*$np;
				}
			?>		
			<tr>
				<td><? echo "$car"; ?></td>
				<td ><? echo "$".number_format($price).""; ?></td>
				<td><? echo "$percent"; ?>%</td>
				<td><input name="checkbox[]" type="checkbox" orig="<? echo $orig; ?>" worth="<? echo $price; ?>" value="<? echo "$cid"; ?>"></td>
			</tr>	
			<?
			}
		}
		?>
		</tbody>
		</table>
		</form>
	</div>
	<div id="hanger" class="tab-pane well">
		<div class="btn-toolbar">
			<div class="btn-group">
				<button class="btn btn-small checkAll"><i class="icon-plus"></i> Check All</button>
				<button class="btn btn-small removeAll"><i class="icon-minus"></i> Uncheck All</button>
			</div>
			<div class="btn-group">
				<button type="submit" name="sell" class="btn btn-small sell"><i class="icon-shopping-cart"></i> Sell Selected</button>
				<button type="submit" name="repair" class="btn btn-small repair"><i class="icon-tag"></i> Repair Selected</button>
			</div>
		</div>
		<br>
		<form action="garage.php" id="hangerForm" method="post">
		<table class="table table-condensed table-striped table-bordered">
		<thead>
		  <tr>
		    <th>Vehicle</th>
		    <th>Value</th>
		    <th>Percentage</th>
		    <th>Select</th>
		  </tr>
		</thead><tbody>
		<?
		$res=$mysqli->query("SELECT * FROM `garage` WHERE `username`='$_COOKIE[id]' AND `type`='plane' ORDER BY `vehicle` ASC"); 
		if ($res->num_rows < 1) {
			echo "<tr><td colspan=\"4\">You currently do not own an aircraft.</td></tr>";
		} else {
			while ($row=$res->fetch_assoc()) {
				$car=$row['vehicle'];
				$percent=$row['percent'];
				$np=$row['percent']/100;
				$cid=$row['id'];
				if ($car == 'Training Plane') {
					$orig=10000;
					$price=$orig*$np;
				} elseif ($car == 'Glider') {
					$orig=25000;
					$price=$orig*$np;
				} elseif ($car == 'Passenger Plane') {
					$orig=55000;
					$price=$orig*$np;
				} elseif ($car == 'Vulcan Bomber') {
					$orig=75000;
					$price=$orig*$np;
				} elseif ($car == 'Jumbo Jet') {
					$orig=125000;
					$price=$orig*$np;
				} elseif ($car == 'F15 Fighter') {
					$orig=200000;
					$price=$orig*$np;
				} elseif ($car == 'Eagle Fighter') {
					$orig=350000;
					$price=$orig*$np;
				} elseif ($car == 'Stealth Fighter F117') {
					$orig=550000;
					$price=$orig*$np;
				} elseif ($car == 'Eurofighter Typhoon') {
					$orig=700000;
					$price=$orig*$np;
				}
			?>		
			<tr>
				<td><? echo "$car"; ?></td>
				<td ><? echo "$".number_format($price).""; ?></td>
				<td><? echo "$percent"; ?>%</td>
				<td><input name="checkbox[]" type="checkbox" orig="<? echo $orig; ?>" worth="<? echo $price; ?>" value="<? echo "$cid"; ?>"></td>
			</tr>	
			<?
			}
		}
		?>
		</tbody>
		</table>
		</form>
	</div>
	<div id="dock" class="tab-pane well">
		<div class="btn-toolbar">
			<div class="btn-group">
				<button class="btn btn-small checkAll"><i class="icon-plus"></i> Check All</button>
				<button class="btn btn-small removeAll"><i class="icon-minus"></i> Uncheck All</button>
			</div>
			<div class="btn-group">
				<button type="submit" name="sell" class="btn btn-small sell"><i class="icon-shopping-cart"></i> Sell Selected</button>
				<button type="submit" name="repair" class="btn btn-small repair"><i class="icon-tag"></i> Repair Selected</button>
			</div>
		</div>
		<br>
		<form action="garage.php" id="dockForm" method="post">
		<table class="table table-condensed table-striped table-bordered">
		<thead>
		  <tr>
		    <th>Vehicle</th>
		    <th>Value</th>
		    <th>Percentage</th>
		    <th>Select</th>
		  </tr>
		</thead><tbody>
		<?
		$res=$mysqli->query("SELECT * FROM `garage` WHERE `username`='$_COOKIE[id]' AND `type`='boat' ORDER BY `vehicle` ASC"); 
		if ($res->num_rows < 1) {
			echo "<tr><td colspan=\"4\">You currently do not own any ships.</td></tr>";
		} else {
			while ($row=$res->fetch_assoc()) {
				$car=$row['vehicle'];
				$percent=$row['percent'];
				$np=$row['percent']/100;
				$cid=$row['id'];
				if ($car == 'Dingy') {
					$orig=10000;
					$price=$orig*$np;
				} elseif ($car == 'Catamaran') {
					$orig=25000;
					$price=$orig*$np;
				} elseif ($car == 'Aircraft Carrier') {
					$orig=55000;
					$price=$orig*$np;
				} elseif ($car == 'Submarine') {
					$orig=75000;
					$price=$orig*$np;
				} elseif ($car == 'Battleship') {
					$orig=150000;
					$price=$orig*$np;
				} elseif ($car == 'Destroyer') {
					$orig=300000;
					$price=$orig*$np;
				} elseif ($car == 'Cruiser') {
					$orig=600000;
					$price=$orig*$np;
				} elseif ($car == 'Nuclear Submarine') {
					$orig=700000;
					$price=$orig*$np;
				}
			?>		
			<tr>
				<td><? echo "$car"; ?></td>
				<td ><? echo "$".number_format($price).""; ?></td>
				<td><? echo "$percent"; ?>%</td>
				<td><input name="checkbox[]" type="checkbox" orig="<? echo $orig; ?>" worth="<? echo $price; ?>" value="<? echo "$cid"; ?>"></td>
			</tr>	
			<?
			}
		}
		?>
		</tbody>
		</table>
		</form>
	</div>
</div>
<? require_once("members/footer.php"); ?>