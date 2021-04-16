<?php
       require_once "../../config.php" ; 
       require_once APP_PATH."/dao/pdo.php" ; 

       // lấy dữ liệu trên đường dẫn xuống 
       $id = isset($_GET['id']) ? $_GET['id'] : "" ; 

       $ma_loai_phong = isset($_GET['ma_loai_phong']) ? $_GET['ma_loai_phong'] : "" ; 

       // check-in thì chuyển trạng thái đặt p thành check-in 
       $sql = "UPDATE dat_phong set 
                                    trang_thai = 1 
                                    where id = '$id'" ; 
        insert_update_delete($sql) ;                             

       // gửi mã số p về email của khách hàng 

       // header về list.php 
       header("location:".BASE_URL."admin/dat_phong/list.php?msg=Check in thành công !") ; 
?>