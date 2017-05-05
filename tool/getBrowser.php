<?php 
function getBrowser($m){
	if($m == 1)
	{
		return $_SERVER['HTTP_USER_AGENT'];
	}
	else if($m == 2)
	{
		return get_browser();
	}
}
?>