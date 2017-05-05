<?php 
error_reporting(0);
session_start();
include('dbms.php');
include('../tool/getIP.php');

if(isset($_SESSION['id']))
{
	$sql_comm = "INSERT INTO `log_view_tb` (`id`, `user_id`, `time`, `ip`, `type`, `browser`) 
	VALUES (NULL, '". $_SESSION['id'] ."', '". date('Y-m-d H:i:s') ."', '". GetIP() ."', 'logout', '". $_SERVER['HTTP_USER_AGENT'] ."');";
	$obj->dbms_insert($sql_comm);
}

session_unset();
header('Location: ..');
exit();
?>