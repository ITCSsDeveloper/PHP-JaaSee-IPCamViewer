<?php 
include('ViewControll.php');
?>

<?php @unlink($_SESSION['cam1']); ?>
<?php @unlink($_SESSION['cam2']); ?>


    <div class="col-xs-12">
        <div class="alert alert-info " >
            คุณมีสิทธิ์ดูภาพสำหรับวันนี้ : <?php echo getTokenToday($obj); ?> ครั้ง <br>
            หากคุณต้องการใช้สิทธิ์ กรุณากด <br><a href="?main&cam_view"><b> >>> ขอดูภาพ <<< </b></a>
        </div>
    </div>


<?php if(isset($_GET['cam_view'])) {  ?> 

    <?php if(disTokenToday($obj)) { ?>
        <?php 
            $_date     = date('Y-m-d H:i:s');
            $_id       = $_SESSION['id'];

            $cam1_name = hash('sha256', ('1'. $_date. $appkey. rand(00,50). $_id)); 
            $cam2_name = hash('sha256', ('2'. $_date. $appkey. rand(50,99). $_id)); 

            $cam1_file = '_temp/'. $cam1_name. '.bmp'; 
            $cam2_file = '_temp/'. $cam2_name. '.bmp';

            $_SESSION['cam1'] = $cam1_file;
            $_SESSION['cam2'] = $cam2_file;

            @copy('D:\VM Share File\ipcam\cam1.bmp', $cam1_file); 
            @copy('D:\VM Share File\ipcam\cam2.bmp', $cam2_file);

            saveLogView($obj);
         ?>

        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Camera 1 @<?php echo $_date; ?>
                </div>
                <div class="panel-body">
                    <img data-toggle="modal" data-target="#myModal1"  class="img-responsive" width="100%" src="view/view_img.php?url_img=../<?php echo $cam1_file; ?>&_token=<?php echo $_token; ?>">
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Camera 2 @<?php echo $_date; ?>
                </div>
                <div class="panel-body">
                    <img data-toggle="modal" data-target="#myModal2" class="img-responsive" width="100%" src="view/view_img.php?url_img=../<?php echo $cam2_file; ?>&_token=<?php echo $_token; ?>">
                </div>
            </div>
        </div>

        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="view/view_img.php?url_img=../<?php echo $cam1_file; ?>&_token=<?php echo $_token; ?>"  width="100%" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>

         <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="view/view_img.php?url_img=../<?php echo $cam2_file; ?>&_token=<?php echo $_token; ?>" width="100%" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function centerModal() {
                $(this).css('display', 'block');
                var $dialog = $(this).find(".modal-dialog");
                var offset = ($(window).height() - $dialog.height()) / 2;
                $dialog.css("margin-top", offset);
            }
            $('.modal').on('show.bs.modal', centerModal);
            $(window).on("resize", function () {
                $('.modal:visible').each(centerModal);
            });
        </script>

    <?php } else  { ?>
        <div class="col-xs-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <b>คำเตือน</b>
                </div>
                <div class="panel-body">
                    <p>หากข้อความนี้ปรากฏ ความเป็นไปได้ที่เกิดปัญหา</p>
                    <ul>
                        <li>คุณใช้สิทธิ์การขอดูภาพครบแล้ว</li>
                        <li>เกิดข้อผิดพลาดบางอย่าง ที่ไม่สามารถแสดงภาพได้</li>
                    </ul>
                </div>
                <div class="panel-footer">
                    หากมีข้อสงสัย โปรดติดต่อ <a href="https://www.facebook.com/GmtanBeartai2010">เจ้าหน้าที่ผู้ดูแล </a> 
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>


<div class="col-xs-12">
    <label>ข้อควรทราบ</label><br>
    <ul>
        <li>คลิกรูปภาพ เพื่อขยาย </li>
        <li>รูปภาพจะอัพเดททุกๆ 2 วินาที โปรดอย่ากดย้ำๆ (ป้องการการเสียสิทธิ์)</li>
        <li>หากใช้สิทธ์ขอดูภาพครบแล้ว วันนั้นจะไม่สามารถขอดูได้อีก (โปรดใช้เท่าที่จำเป็น)</li>
        <li>การกระทำทุกอย่างที่เกิดขึ้นกับระบบ จะถูกบันทึกไว้ (โปรดอย่าพยายามกระทำการอันมิสมควร ที่จะทำให้เกิดความเสียหายต่อ Server)</li>
        <li>Username & Password ต้องติดต่อขอกับ เจ้าหน้าที่ผู้ดูแล เท่านั้น</li>
    </ul>
    <label>ทำไมต้องจำกัดการขอดู ?</label><br>
    <ul>
        <li>เพื่อรักษาความปลอดภัย และ ความเป็นส่วนตัวของผู้อาศัยอยู่ในห้อง ไม่ให้มีการถูกติดตามตลอดเวลา</li>
        <li>ทุกครั้งที่ขอดูรูป จะมีเสียง beep ดังขึ้นที่ห้องทุกครั้ง เพื่อให้ผู้อาศัยรับทราบถึงการขอดูกล้อง</li>
        <li>เพื่อรักษาเสถียรภาพการทำงานของ Server ให้ใช้ IO น้อยที่สุด</li>
    </ul>
    <label>** Admin มีสิทธิ์ที่จะ Block Ban หรือ สั่ง Logout User นั้นๆได้โดยไม่ต้องแจ้งให้ทราบล้วงหน้า</label><br>
    <label>** หากระบบตรวจพบพฤติกรรมเสี่ยง ระบบจะ ban ip นั้นๆ โดยอัตโนมัติ</label><br>
    <label>** หากพบเจอบัค โปรดแจ้ง <a href="https://www.facebook.com/GmtanBeartai2010">เจ้าหน้าที่ผู้ดูแล </a></label>
</div>
