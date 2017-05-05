<?php
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

function getLogTable($limit='50', $obj)
{
    $sql_comm = "SELECT  *  FROM `log_view_tb` ORDER BY `id` DESC LIMIT $limit";
    return $obj->dbms_select($sql_comm);
}


function getMember($obj)
{
    $sql_comm = "SELECT * FROM `user_tb`";
    return $obj->dbms_select($sql_comm);
}

function getTokenMember($user_id,$obj)
{
    $sql_comm ="SELECT * FROM `token_tb` WHERE  `user_id` = '". $user_id ."' and `time` = '". date('Y-m-d') ."'";
    $result = $obj->dbms_select($sql_comm);

    if(!$result)
    {
        $TokenCount = getTokenCount(getLevel($user_id, $obj));
        $sql_comm = "INSERT INTO `token_tb` (`id`, `user_id`, `time`, `token_today`) 
        VALUES (NULL, '". $user_id ."', '". date('Y-m-d') ."', '$TokenCount');";
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
?>