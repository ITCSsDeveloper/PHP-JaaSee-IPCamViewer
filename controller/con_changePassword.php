<?php
error_reporting(0);
session_start();
include('../tool/checkToken.php');
include('../tool/checkLogin.php');
include('dbms.php');

if(isset($_POST['ChangePassword']))
{
	$username = $_SESSION['username'];
	$id = $_SESSION['id'];

	$old_password 	 = trim(@$_POST['old_password']);
	$new_password 	 = trim(@$_POST['new_password']);
	$re_new_password = trim(@$_POST['re_new_password']);

	if($old_password == '' || $new_password  == '' || $re_new_password == '')
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'ห้ามมีค่าว่าง กรุณาตรวจสอบการกรอกข้อมูล';
		header('Location: ..');
		exit();
	}

	$old_password 	 = hash('sha512', ($_POST['old_password'] . $appkey) );
	$new_password 	 = hash('sha512', ($_POST['new_password'] . $appkey) );
	$re_new_password = hash('sha512', ($_POST['re_new_password'] . $appkey) );

	if($new_password != $re_new_password)
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'รหัสผ่านใหม่ไม่ตรงกัน';
		header('Location: ..');
		exit();
	}

	if($new_password == $old_password)
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'รหัสผ่านใหม่ ต้องไม่ตรงกับรหัสผ่านเดิม';
		header('Location: ..');
		exit();
	}

	$sql_comm = "SELECT * FROM `user_tb` WHERE `username` = '$username' AND `password` = '$old_password'";
	if($obj->dbms_select($sql_comm))
	{	
		$sql_comm = "UPDATE `user_tb` SET `password` = '$new_password' WHERE `id` = '$id';";
		if($obj->dbms_update($sql_comm))
		{	
			$sql_comm = "UPDATE `user_tb` SET `first_login` = 'pass' WHERE `id` = '$id';";
			$obj->dbms_update($sql_comm);

			$_SESSION['notify_type'] = 'success';
			$_SESSION['notify_string'] = 'เปลี่ยนรหัส่านเรียบร้อย';
			header('Location: ..');
			exit();
		}
		else
		{
			$_SESSION['notify_type'] = 'danger';
			$_SESSION['notify_string'] = 'เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน';
			header('Location: ..');
			exit();
		}
	}
	else
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'รหัสผ่านปัจจุบันไม่ถูกต้อง';
		header('Location: ..');
		exit();
	}
}
?>