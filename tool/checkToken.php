<?php
 @session_start();
 if(isset($_GET['_token']) || isset($_POST['_token']))
 {
 	if(isset($_GET['_token'])) { $_Coppytoken = $_GET['_token']; }
 	if(isset($_POST['_token'])) { $_Coppytoken = $_POST['_token']; }

	if($_SESSION['_token'] != $_Coppytoken)
	{
		echo 'Token Invalid.';
		exit();
	}
 }
 else
 {
 	echo 'No Token.';
	exit();
 }
?>