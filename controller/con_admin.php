<?php
error_reporting(0);
session_start();
include('../tool/checkLogin.php');
include('../tool/checkToken.php');
include('dbms.php');


function getLevel($user_id, $obj)
{
    $sql_comm = "SELECT * FROM `user_tb` WHERE `id` = '". $user_id ."'";
    $user_lavel = $obj->dbms_select($sql_comm);

    if($user_id)
    {
        return $user_lavel['0']->level;
    }
    else
    {
        return 'false';
    }
}


// Function Check SuperAdmin Access 
@$_level = @getLevel(@$_SESSION['id'], $obj);
if(@$_level != 'superAdmin') 
{
	header('Location: con_logout.php');
	exit();
}
// END Function Check SuperAdmin Access 



// Function RegisMember
if(isset($_POST['RegisMember']))
{
	$username = @$_POST['username'];
	$password = @$_POST['password'];
	$level 	  = @$_POST['level'];

	if($username == '' || $password == '' || $level == '')
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Value be must Null.';
		header('Location: ..');
		exit();
	}

	if($level == 'superAdmin') // Admin is Only One.
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = ' Admin is Only One.';
		header('Location: ..');
		exit();
	}

	if($level != 'member' && $level != 'guest' && $level != 'tester')
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Level Invalid.';
		header("Location: ..");
		exit();
	}

	$password = hash('sha512', ($password . $appkey));

	$sql_comm = "SELECT * FROM `user_tb` WHERE `username` = '$username'";
	if(!$obj->dbms_select($sql_comm)) // Check Duplicate Member
	{
		$sql_comm = "INSERT INTO `user_tb` (`id`, `username`, `password`, `datetime`, `level`) VALUES (NULL, '$username', '$password', CURRENT_TIMESTAMP, '$level');";
		if($obj->dbms_insert($sql_comm))
		{
			$_SESSION['notify_type'] = 'success';
			$_SESSION['notify_string'] = 'Register Member Success.';
			header('Location: ..');
			exit();
		}
		else
		{
			$_SESSION['notify_type'] = 'danger';
			$_SESSION['notify_string'] = 'Register Member Fail.';
			header('Location: ..');
			exit();
		}
	}
	else
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Member Username Duplicate.';
		header('Location: ..');
		exit();
	}
}
// END Function RegisMember




// Function updateLevel
else if(isset($_POST['updateLevel']))
{
	$user_id = @$_POST['user_id'];
	$level 	 = @$_POST['level'];

	if($user_id == "" || $level == "")
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Value be must not null.';
		header('Location: ..');
		exit();
	}
	if($level == 'superAdmin') // Admin is Only One.
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = ' Admin is Only One.';
		header('Location: ..');
		exit();
	}
	if($level != 'member' && $level != 'guest' && $level != 'tester')
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Level Invalid.';
		header('Location: ..');
		exit();
	}


	$sql_comm = "UPDATE `user_tb` SET `level` = '$level' WHERE `id` = '$user_id';";
	if($obj->dbms_update($sql_comm))
	{
		$_SESSION['notify_type'] = 'success';
		$_SESSION['notify_string'] = 'Updete User Success.';
		header('Location: ..');
		exit();
	}
	else
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Updete User Fail.';
		header('Location: ..');
		exit();
	}
}
// END Function updateLevel



// Function updateCommand
else if(isset($_POST['updateCommand']))
{
	$user_id = @$_POST['user_id'];
	$command = @$_POST['command'];

	if($user_id == "" || $command == "")
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Value be must not null.';
		header('Location: ..');
		exit();
	}
	if($command == 'superAdmin') // Admin is Only One.
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = ' Admin is Only One.';
		header('Location: ..');
		exit();
	}
	if($command != 'block' && $command != 'forceLogout' && $command != 'banUser' && $command != '_')
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Command Invalid.';
		header('Location: ..');
		exit();
	}
	
	$sql_comm = "UPDATE `user_tb` SET `command` = '$command' WHERE `id` = '$user_id';";
	if($obj->dbms_update($sql_comm))
	{
		$_SESSION['notify_type'] = 'success';
		$_SESSION['notify_string'] = 'Updete Command User Success.';
		header('Location: ..');
		exit();
	}
	else
	{
		$_SESSION['notify_type'] = 'danger';
		$_SESSION['notify_string'] = 'Updete Command User Fail.';
		header('Location: ..');
		exit();
	}
}
// END Function updateCommand
?>