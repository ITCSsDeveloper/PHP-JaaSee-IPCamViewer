<?php @include('tool/checkRequest.php'); ?>
<?php @include('../tool/checkRequest.php'); ?>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4"><?php include('tool/notification.php'); ?></div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Please Sign In</h3>
				</div>
				<div class="panel-body" align="center">
					<img src="image/Cloud-Server-Philippines.png"  class="img-responsive"  >
					<form action="controller/con_login.php" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" maxlength="100" autofocus required> 
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" maxlength="100" required>
							</div>
							<button name="doLogin" class="btn btn-success" style="width: 100%"> Login</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
