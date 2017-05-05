<?php
// Content Auto Load -> Find in $Route
if(!isset($_SESSION['lastPage'])) { $_SESSION['lastPage'] = $route['main']; }

$flag = false;
foreach ($_GET as $keyGet => $valueGet) {
	foreach ($route as $keyRoute => $valueRoute) {
		if($keyGet == $keyRoute)
		{
			$flag = true;
			$_SESSION['lastPage'] = $valueRoute;
			include("view/" . $valueRoute);
			break;
		}
	}
	if($flag) { break; } 
}

if(!$flag) {  include ('view/' . $_SESSION['lastPage']);  }
?>
