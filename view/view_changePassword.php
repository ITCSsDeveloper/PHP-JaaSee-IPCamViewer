<?php 
include('ViewControll.php');
?>

<div class="col-md-4 col-md-offset-4" >
	<?php include('tool/notification.php'); ?>
</div>

<div class="col-md-4 col-md-offset-4" style="margin-top: 25px">
	<div class="panel panel-info">
		<div class="panel-heading">
			<label style="font-size: 20px">เปลี่ยนรหัสผ่าน</label>
		</div>
		<div class="panel-body">
			<form action="controller/con_changePassword.php" method="post">
				<label>รหัสผ่าน : </label>
				<input type="password" name="old_password" class="form-control" required></input><br><br>
				<label>รหัสผ่านใหม่ : </label>
				<input type="text" name="new_password"class="form-control" required></input><br>
				<label>ยืนยันรหัสผ่านใหม่ : </label>
				<input type="text" name="re_new_password" class="form-control"required></input><br>
				<button type="submit"  name="ChangePassword" class="btn btn-success" style="float: right;">เปลี่ยนรหัสผ่าน</button>
			</form>
		</div>
	</div>
</div>