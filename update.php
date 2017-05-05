<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

if (!isset($_GET['renew'])) 
{
	echo "fail.";
	exit();
}

	@session_start();
	ini_set('max_execution_time', 60 * 5); //300 seconds = 5 minutes

	include('config.php');

	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,'utf8');

	if ($conn->connect_error) {
		die('Connection failed: ' . $conn->connect_error);
		exit();
	}

	$conn->query('DROP TABLE user_tb');
	$conn->query('DROP TABLE token_tb');
	$conn->query('DROP TABLE log_view_tb');

	$conn->query("CREATE TABLE IF NOT EXISTS `user_tb` (
		`id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		`username` text,
		`password` text,
		`datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		`level` text,
		`command` text,
		`first_login` text
		)AUTO_INCREMENT=954761;");

	$conn->query("CREATE TABLE IF NOT EXISTS `token_tb` (
		`id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		`user_id` text,
		`time` text,
		`token_today` text
		)AUTO_INCREMENT=111111;");

	$conn->query("CREATE TABLE IF NOT EXISTS `log_view_tb` (
		`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		`user_id` int(11),
		`time` text,
		`ip` text,
		`type` text,
		`browser` text
		)");

	$conn->query("INSERT INTO `user_tb` (`id`, `username`, `password`, `datetime`, `level`) VALUES (NULL, 'admin', '35c0384d41452a8604845557685e98c9b423255ca566482b45d145b015dea451c9d4ccf722a61037964bb7fcb951beb664fe297879acafb4ee7b62c91422ae15', CURRENT_TIMESTAMP, 'superAdmin');");

	$conn->close();
	session_unset();
	header("Location: index.php");
	?>