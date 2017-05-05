<?php 
include('tool/getIP.php');
include('tool/getTokenCount.php');

function getLevel($user_id, $obj)
{
    $sql_comm = "SELECT * FROM `user_tb` WHERE `id` = '". $user_id ."'";
    $user_lavel = $obj->dbms_select($sql_comm);

    if($user_id)
    {
        return $user_lavel['0']->level;
    }
    else
    {
        return 'false';
    }
}

function getTokenToday($obj)
{
    $sql_comm ="SELECT * FROM `token_tb` WHERE  `user_id` = '". $_SESSION['id'] ."' and `time` = '". date('Y-m-d') ."'";
    $result = $obj->dbms_select($sql_comm);

    if(!$result)
    {
        $TokenCount = getTokenCount(getLevel($_SESSION['id'], $obj));
        $sql_comm = "INSERT INTO `token_tb` (`id`, `user_id`, `time`, `token_today`) 
        VALUES (NULL, '". $_SESSION['id'] ."', '". date('Y-m-d') ."', '$TokenCount');";
        if($obj->dbms_insert($sql_comm))
        {
           return $TokenCount;
        }
        else
        {
            return 0;
        }
    }
    else
    {
        return $result[0]->token_today;
    }
}

function disTokenToday($obj)
{
    $token_today = getTokenToday($obj);
    if($token_today > 0)
    {
        $token_today--;
        $sql_comm = "UPDATE `token_tb` SET `token_today` = '$token_today' WHERE `user_id` = '". $_SESSION['id'] ."'";
        
        if($obj->dbms_update($sql_comm))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }

}
 
function saveLogView($obj)
{     
    $sql_comm = "INSERT INTO `log_view_tb` (`id`, `user_id`, `time`, `ip`, `type`, `browser`) 
    VALUES (NULL, '". $_SESSION['id'] ."', '". date('Y-m-d H:i:s') ."', '". GetIP() ."', 'view', '". $_SERVER['HTTP_USER_AGENT'] ."');";
    $obj->dbms_insert($sql_comm);
}      
?>