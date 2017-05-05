<!DOCTYPE html>
<html>
<head>
	<title>ISC IP Camera</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="css/icon.png">
	<link href="css/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="css/navbar.css" rel="stylesheet">
	<script src="css/ie-emulation-modes-warning.js"></script>

	<?php error_reporting(0); ?>
	<?php date_default_timezone_set('Asia/Bangkok'); ?>
	<?php session_start(); ?>
	<?php $page = true; ?>
	<?php include_once('controller/dbms.php'); ?>
	<?php include_once('tool/reDirectHTTPS.php'); ?>
	<?php include_once('tool/checkCommand.php'); ?>
	<?php if($debug = 0) { echo '<pre>'; var_export($_SESSION);  echo '</pre>'; } ?>
	<?php if(($devmode = 0) > 0 ) { echo '<meta http-equiv="refresh" content="' , $devmode , '" >'; } ?>
	<?php $_token = hash('sha1', (date('h:i:sa') . $appkey . rand(0,10))  ) ; ?>
	<?php $_SESSION["_token"] = $_token; ?>
	<?php if(isset($_GET['iam_admin'])) { echo '<meta http-equiv="refresh" content="' , $_GET['iam_admin'] , '" >'; } ?>

</head>

<body>
	<?php 
	if(!isset($_SESSION['login']))
	{
		include_once('view/view_Login.php');
	}
	else
	{	
		include_once('view/_mainView/_main.php');
	}
	?>

	<script type="text/javascript">
		var _token = "<?php echo @$_token; ?>"
		var Element_From = (document.getElementsByTagName("form"));
		var input_token = document.createElement("input");      
		input_token.name = "_token";
		input_token.type = "hidden";
		input_token.value = _token;
		for(var i = 0; i < Element_From.length; i++ ) {	
			Element_From[i].appendChild(input_token.cloneNode(true));
		}
	</script>


	<script>window.jQuery || document.write('<script src="css/jquery.min.js"><\/script>')</script>
	<script src="css/js/bootstrap.min.js"></script>
	<script src="css/ie10-viewport-bug-workaround.js"></script>


</body>
</html>