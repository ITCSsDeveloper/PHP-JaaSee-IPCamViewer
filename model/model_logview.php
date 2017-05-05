<?php 
function getLogView($limit='10', $obj)
{
	$sql_comm = "SELECT * FROM `log_view_tb` WHERE `user_id` = '". $_SESSION['id'] ."' AND `type` = 'view' ORDER BY `id` DESC LIMIT $limit";
	return $obj->dbms_select($sql_comm);
}

function getLogAuth($limit='10', $obj)
{
	$sql_comm = "SELECT  *  FROM `log_view_tb` WHERE `user_id` = '". $_SESSION['id'] ."' AND `type` != 'view' ORDER BY `id` DESC LIMIT $limit";
	return $obj->dbms_select($sql_comm);
}

?>