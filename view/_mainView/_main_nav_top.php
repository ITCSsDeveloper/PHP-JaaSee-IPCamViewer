<?php 
function setActiveHighlight($varDD)
{
  if(isset($_GET[$varDD])) { echo "active";}
}

function nav_getLevel($user_id, $obj)
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
?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ISC IP CAM</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
     <ul class="nav navbar-nav ">
       <li class="<?php setActiveHighlight('main'); ?>" ><a href="?main">ดูกล้อง</a></li>
       <li class="<?php setActiveHighlight('logview'); ?>" ><a href="?logview">LogView</a></li>
     </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a>สวัสดีคุณ <b><?php echo $_SESSION['username']; ?> </b></a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
        <ul class="dropdown-menu">

          <?php if(nav_getLevel($_SESSION['id'], $obj)  == 'superAdmin') { ?>
            <li><a href="index.php?admin">AdminPanel</a></li>
          <?php } ?>
          <li><a href="index.php?changePassword">เปลี่ยนรหัสผ่าน</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="controller/con_logout.php">ออกจากระบบ</a></li>

        </ul>
      </li>
    </ul>
  </div>
</div>
</nav>
