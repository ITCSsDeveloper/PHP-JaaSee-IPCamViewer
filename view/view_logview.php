<?php 
include('ViewControll.php');
$LogView = getLogView($limit='10', $obj);
$LogAuth = getLogAuth($limit='10', $obj);
?>

<div class="col-xs-12 col-sm-6">
	<div class="dataTable_wrapper">
		<div>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>วันเวลาที่ขอดูภาพ</th>
						<th>IP</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($LogView as $key => $value) { ?>
					<tr style="font-size: 10px">
						<td><?php echo $value->time; ?></td>
						<td><?php echo $value->ip; ?></td>
					</tr>
					<?php } ?>
					<?php if(!$LogView) { ?>
						<tr>
							<td colspan="2"> ไม่มีข้อมูล </td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="col-xs-12 col-sm-6">
	<div class="dataTable_wrapper">
		<div>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>วันเวลา</th>
						<th>Brwoser</th>
						<th>IP</th>
						<th>Type</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($LogAuth as $key => $value) { ?>
					<tr style="font-size: 10px">
						<td><?php echo $value->time; ?></td>
						<td><?php echo $value->browser; ?></td>
						<td><?php echo $value->ip; ?></td>
						<td>
							<?php if($value->type == 'login') { ?> 
								<span class="glyphicon-arrow-left" style="color: green"> LogIn</span>
							<?php } else { ?>
								<span class="glyphicon-circle-arrow-up" style="color: red;"> LogOut</span>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
					<?php if(!$LogAuth) { ?>
						<tr>
							<td colspan="3"> ไม่มีข้อมูล </td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

