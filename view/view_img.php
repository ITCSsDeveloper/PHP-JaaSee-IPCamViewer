<?php 
error_reporting(0);
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
		$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: $redirect");
		exit();
	}

header('Content-type: image/jpeg');
date_default_timezone_set('Asia/Bangkok'); 
session_start();

include_once('../tool/checkLogin.php');
include_once('../tool/checkToken.php');

// array imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )


// Load Source IMG 
$filename = $_GET['url_img'];
$percent = 2;

// * Size To $val
list($width, $height) = getimagesize($filename);
$newwidth = $width * $percent;
$newheight = $height * $percent;

// Create New Template
$imgNewSize = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

// Coppy Source To Template and Resize
imagecopyresized($imgNewSize, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);


// Create Pen Color
$white     = imagecolorallocate($imgNewSize, 255, 255, 0);

// Set Font
$font_path = '..\css\img_font\OldStandard-Regular.ttf';

// Set Text 
$text = 'User: ' . $_SESSION['username'] ."\n". 'Time:' . date('Y-m-d H:i:s');

// Write Text To Img
imagettftext($imgNewSize, 15, 0, 10, 30, $white, $font_path, $text);

// Send Show To Img
imagejpeg($imgNewSize);

// Clear Memory
unlink($filename);
imagedestroy($imgNewSize);
imagedestroy($source);
?>