<?php
// Header For View 
// include By view_*
include_once('tool/checkLogin.php');
@include_once('tool/checkRequest.php');
@include_once('../tool/checkRequest.php');

$pageLoad = 'model/model_' . str_replace('view_', '', $_SESSION['lastPage']);
include_once($pageLoad);
?>