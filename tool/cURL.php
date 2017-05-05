<?php
// Example
// $array["test"] = "1234";
// $array["name"] = "TAN";
// echo cURL_POST("http://10.199.120.187/index.php",$array);
// echo cURL_GET("http://10.199.120.187/index.php?vval=1111");


function cURL_GET($url)
{	
	$curl = curl_init($url);
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'Mozilla Firefox'
		));
	$resp = curl_exec($curl);
	if($resp==false) { $resp = 'false'; }
	curl_close($curl);
	return  $resp;
}

function cURL_POST($url,$array_data)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);// we are doing a POST request
	curl_setopt($ch, CURLOPT_POSTFIELDS, $array_data);// adding the post variables to the request
	$output = curl_exec($ch);
	curl_close($ch);

	return $output;
}

function cURL_FILE($url,$path_file,$method = "get")
{
	$file = fopen($path_file, "r");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_UPLOAD, 1);
	curl_setopt($ch, CURLOPT_INFILE, $fp);
	($method == "post" || $method == "POST") ? curl_setopt($ch, CURLOPT_POST, 1) :  "";
	curl_setopt($ch, CURLOPT_INFILESIZE, filesize($path_file));
	curl_setopt($ch, CURLOPT_FTPASCII, 1);
	$output = curl_exec($ch);
	curl_close($ch);
}
?>