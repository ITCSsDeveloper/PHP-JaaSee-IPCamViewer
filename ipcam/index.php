<!DOCTYPE html>
<html>
<head>
	<title>ISC IP CAMERA</title>
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<?php
	error_reporting(1);
	if(isset($_GET['update']))
	{
		$url = $_GET['update'];
		$myfile = fopen('jmkLZC32m2S5dGjFeM26ZNKY72etbvHv.txt', 'w') or die('Unable to open file!');
		$url = fwrite($myfile,$url);
		fclose($myfile);

		echo 'URL UPDATED <br>';

		$myfile = fopen('jmkLZC32m2S5dGjFeM26ZNKY72etbvHv.txt', 'r') or die('Unable to open file!');
		$url = fread($myfile,filesize('jmkLZC32m2S5dGjFeM26ZNKY72etbvHv.txt'));
		fclose($myfile);

		echo 'URL : '. $url .'<br>';
		exit();
	}
	else
	{
		$myfile = fopen('jmkLZC32m2S5dGjFeM26ZNKY72etbvHv.txt', 'r') or die('Unable to open file!');
		$url = fread($myfile,filesize('jmkLZC32m2S5dGjFeM26ZNKY72etbvHv.txt'));
		fclose($myfile);
	}
	?>
</head>
<body>
	<center>
		<h1>ISC IP CAMERA</h1>
		<br>
		<label>โปรดติดตั้ง VPN KKU ก่อนเข้าใช้งาน <a href="https://network.kku.ac.th/index.php/user-guide/srv-manual/vpn-pptp/327-kku-pptp" target="_blank"> วิธีตั้งค่า VPN KKU </a> </label>
		<br><br><br><br>
		<a href="http://<?php echo $url; ?>/ipcam"><button class="btn btn-success"> ลิงค์ไปสู่ Server IP CAMERA </button></a>
		<br><br><br><br>
		<label>** ติดต่อ <a href="https://www.facebook.com/GmtanBeartai2010" target="_blank">เจ้าหน้าที่ผู้ดูแล </a> ** </label>
	</center>
</body>
</html>