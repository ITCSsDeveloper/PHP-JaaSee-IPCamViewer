	<?php
	if(isset($_SESSION['id']))
	{
		$sql_comm = "SELECT * FROM `user_tb` WHERE `id` = '" . $_SESSION['id']. "'";
		$command = $obj->dbms_select($sql_comm)[0]->command;

		if($command == 'forceLogout') {
			$obj->dbms_update("UPDATE `user_tb` SET `command` = '' WHERE `id` = '". $_SESSION['id'] ."';");
			$_SESSION['notify_type'] = 'danger';
			$_SESSION['notify_string'] = 'Username ถูกบังคับให้ออกจากระบบ <br>โปรดทำการเข้าสู่ระบบใหม่ <br>หรือ สอบถาม <a href="https://www.facebook.com/GmtanBeartai2010">เจ้าหน้าที่ผู้ดูแล </a>';
			header('Location: index.php');
			header('Location: controller/con_logout.php');
			exit();
		}
		else if($command == 'block')
		{
			session_unset();
			$_SESSION['notify_type'] = 'danger';
			$_SESSION['notify_string'] = 'Username ถูกบล็อคการเข้าใช้งาน <br>โปรดติดต่อ <a href="https://www.facebook.com/GmtanBeartai2010">เจ้าหน้าที่ผู้ดูแล </a>';
			header('Location: index.php');
			exit();
		}
		else if($command == 'banUser')
		{	
			session_unset();
			$_SESSION['notify_type'] = 'danger';
			$_SESSION['notify_string'] = 'Username ถูกแบนจากระบบ <br>โปรดติดต่อ <a href="https://www.facebook.com/GmtanBeartai2010">เจ้าหน้าที่ผู้ดูแล </a>';
			header('Location: index.php');
			exit();
		}
	}
	?>