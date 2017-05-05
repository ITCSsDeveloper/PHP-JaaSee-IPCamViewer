<?php
error_reporting(0);
session_start();
include('dbms.php');
include('../tool/getIP.php');

if(isset($_POST['doLogin']))
{	
	session_unset();

	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username == '' || $password == '')
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Username หรือ Password เป็นค่าว่าง';
		header('Location: ..');
		exit();
	}

	$password = hash('sha512', ($password . $appkey));

	$sql_comm = "SELECT * FROM `user_tb` WHERE `username` = '$username' AND `password` = '$password'";
	if($obj->dbms_select($sql_comm))
	{
		$_SESSION['login'] = true;
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $obj->dbms_select($sql_comm)[0]->id;
		$first_login = $obj->dbms_select($sql_comm)[0]->first_login;
		
	    $sql_comm = "INSERT INTO `log_view_tb` (`id`, `user_id`, `time`, `ip`, `type`, `browser`) 
	    VALUES (NULL, '". $_SESSION['id'] ."', '". date('Y-m-d H:i:s') ."', '". GetIP() ."', 'login', '". $_SERVER['HTTP_USER_AGENT'] ."');";
	    $obj->dbms_insert($sql_comm);

	 	if($first_login != 'pass')
		{	
			$_SESSION['notify_type'] = 'info';
			$_SESSION['notify_string'] = 'Username นี้ ถูกใช้งานเป็นครั้งแรก จำเป็นต้องตั้งรหัสผ่านใหม่ก่อน</a>';
			header('Location: ../index.php?changePassword');
			exit();
		}

		header('Location: ../index.php?main');
		exit();
	}
	else
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'เข้าสู่ระบบไม่สำเร็จ';
		header('Location: ..');
		exit();
	}
}
?>