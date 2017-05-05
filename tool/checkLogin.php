<?php 
	@session_start();
	if(!isset($_SESSION['login']))
	{
		session_unset();
		echo 'Your No Login.';
		exit();
	}	
?>