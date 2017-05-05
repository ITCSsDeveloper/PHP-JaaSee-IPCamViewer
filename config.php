<?php
//Run App in HTTPS only ?
$https = true;

//DataBase Config
$servername = "localhost";
$dbname 	= "isc_ipcam";
$username 	= "isc_ipcam";
$password 	= "fuVxtfuXYdjHYFR6";

// App Key For Encryption Value
$appkey = "@@@X8GaHuGP7dM@@@@fuVxtfuXYdjHYFR6fuVxtfuVxtfuXYdjHYFR611111!!!@@@@@!!!";

// Route Array Can Access Content
$route = 
array(
	'main' => 'view_main.php',
	'logview' => 'view_logview.php',
	'admin' => 'view_admin.php',
	'changePassword' => 'view_changePassword.php',
);
?>
