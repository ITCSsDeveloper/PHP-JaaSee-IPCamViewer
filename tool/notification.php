<?php
	@session_start();
		// Primary  Info  Success
		// Warning  Danger  Inverse  Pink
		// Purple  Yellow  Grey  Light 

	/*
	//////// HOW TO USE //////////
		<div class="row"><?php include("../notification.php"); ?></div>

		$_SESSION["notify_type"] = "success";
		$_SESSION["notify_string"] = "";
		header("Location: ../view/index.php?advertise");
		exit();

		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "";
		header("Location: ../view/index.php?advertise");
		exit();

	*/

	if(isset($_SESSION["notify_type"]) && isset($_SESSION["notify_string"]))
	{	
		$type   = $_SESSION["notify_type"];
		$string = $_SESSION["notify_string"];
		?>
		<!-- แก้ตรงนี้ -->
		<br>
		<div class="alert alert-block alert-<?php echo $type; ?>" id="_notification">
			<button type="button" class="close" data-dismiss="alert" onclick="_notification_close()">
				<i class="ace-icon fa fa-times"></i>
			</button>
			<?php echo $string; ?>
		</div>

		<script type="text/javascript">
			var count=30;
			var counter = setInterval(timer, 1000);
			function timer()
			{
				count=count-1;
				if (count <= 0){
					document.getElementById('_notification').style.display = 'none';
					return;
				}
			}

			function _notification_close()
			{ document.getElementById('_notification').style.display = 'none'; }
		</script> 

		<?php
		unset($_SESSION["notify_type"]);
		unset($_SESSION["notify_string"]);
	}
?>
