<?php 
include('ViewControll.php');

@$_level = @getLevel(@$_SESSION['id'], $obj);
if(@$_level != 'superAdmin') 
{
	header('Location: controller/con_logout.php');
	exit();
}
?>

<!-- DataTables CSS -->
<link href="css/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="css/dataTables.responsive.css" rel="stylesheet">


<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalRegisMember">RegisMember</button>


<div class="row">
	<div class="col-xs-12 col-sm-12"><?php include('tool/notification.php'); ?></div>
</div>

<div class="modal fade" id="myModalRegisMember" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">RegisMember</h4>
			</div>
			<form action="controller/con_admin.php" method="post" role="form">
				<div class="modal-body">
					<label>Username : </label> <input type="text" name="username" class="form-control" required></input>
					<label>Password : </label> <input type="text" name="password" class="form-control" required></input>
					<label>Level : </label>
					<select name="level" class="form-control" required>
						<option value="tester">Tester</option>
						<option value="member">Member</option>
						<option value="guest">Guest</option>
					</select>
					<br>
				</div>
				<div class="modal-footer">
					<button type="submit" name="RegisMember" class="btn btn-success" > Register </button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="panel panel-default" style="margin-top: 10px">
	<div class="panel-heading">
		Member Tables
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">
		<div class="dataTable_wrapper">
			<div>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>UserName</th>
							<th>RegDate</th>
							<th>Level</th>
							<th>command</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($objects = getMember($obj) as $key => $value) { ?>
						<tr>
							<td><?php echo $value->id; ?></td>
							<td><?php echo $value->username; ?></td>
							<td><?php echo $value->datetime; ?></td>
							<td>
								<?php if($value->level != 'superAdmin') { ?>
								<form action="controller/con_admin.php" metdod="post" id="F_Level_<?php echo $value->id; ?>">
									<input type="hidden" name="user_id" value="<?php echo $value->id; ?>"></input>
									<input type="hidden" name="updateLevel" value="true"></input>
									<select name="level" class="form-control" onchange="_updateLevel('<?php echo $value->id; ?>')" >
										<option value="tester" <?php echo ($value->level == 'tester') ? 'selected': ''; ?>>Tester</option>
										<option value="member" <?php echo ($value->level == 'member') ? 'selected': ''; ?>>Member</option>
										<option value="guest"  <?php echo ($value->level == 'guest') ? 'selected': ''; ?>>Guest</option>
									</select>
								</form>
								<?php } else { echo "superAdmin"; } ?>
							</td>
							<td>
								<?php if($value->level != 'superAdmin') { ?>
								<form action="controller/con_admin.php" metdod="post" id="F_Command_<?php echo $value->id; ?>">
									<input type="hidden" name="user_id" value="<?php echo $value->id; ?>"></input>
									<input type="hidden" name="updateCommand" value="true"></input>
									<select name="command" class="form-control" onchange="_updateCommand('<?php echo $value->id; ?>')">
										<option value="_"></option>
										<option value="block" <?php echo ($value->command == 'block') ? 'selected': ''; ?>>block</option>
										<option value="forceLogout" <?php echo ($value->command == 'forceLogout') ? 'selected': ''; ?>>forceLogout</option>
										<option value="banUser" <?php echo ($value->command == 'banUser') ? 'selected': ''; ?>>banUser</option>
									</select>
								</form>
								<?php } else { echo "superAdmin"; } ?>
							</td>
							<td><?php echo getTokenMember($value->id,$obj); ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="col-xs-12">
	<div class="dataTable_wrapper">
		<div>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>date</th>
						<th>UserID</th>
						<th>IP</th>
						<th>Browser</th>
						<th>Type</th>
					</tr>
				</thead>
				<tbody>
					<?php $LogViewAdmin = getLogTable($limit = '25', $obj); ?>
					<?php foreach ($LogViewAdmin as $key => $value) { ?>
					<tr style="font-size: 10px">
						<td><?php echo $value->time; ?></td>
						<td><?php echo $value->user_id; ?></td>
						<td><?php echo $value->ip; ?></td>
						<td><?php echo $value->browser; ?></td>
						<td><?php echo $value->type; ?></td>
					</tr>
					<?php } ?>
					<?php if(!$LogViewAdmin) { ?>
						<tr>
							<td colspan="2"> ไม่มีข้อมูล </td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script type="text/javascript">
	function _updateLevel(id)
	{	
		document.getElementById("F_Level_"+id).method = "post";
		document.getElementById("F_Level_"+id).submit();
	}
	function _updateCommand(id)
	{	
		document.getElementById("F_Command_"+id).method = "post";
		document.getElementById("F_Command_"+id).submit();
	}
</script>


<!-- jQuery -->
<script src="css/jquery.min.js"></script>

<!-- DataTables JavaScript -->
<script src="css/jquery.dataTables.min.js"></script>
<script src="css/dataTables.bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
			responsive: true
		});
	});
</script>
