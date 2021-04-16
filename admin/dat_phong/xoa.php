<?php
       require_once "../../config.php" ; 
       require_once APP_PATH."/dao/pdo.php" ; 

       // lấy dữ liệu trên đường dẫn xuống 
       $id = isset($_GET['id']) ? $_GET['id'] : "" ; 

       $ma_loai_phong = isset($_GET['ma_loai_phong']) ? $_GET['ma_loai_phong'] : "" ; 

       $view = 1 ; 
       // b1 : khi check out là phải update lại loại p 
       $sql = "SELECT * FROM loai_phong where id = '$ma_loai_phong'" ; 
       $lp = select_one($sql) ; 
       $so_phong_da_dat_new = $lp['so_phong_da_dat'] -= $view ; 
       $so_phong_trong_new = $lp['so_phong_trong'] += $view ; 
       $sql = "UPDATE loai_phong set so_phong_da_dat = '$so_phong_da_dat_new',
                                     so_phong_trong = '$so_phong_trong_new' where id = '$ma_loai_phong'" ; 
       insert_update_delete($sql) ;
       
       //-----
       $sql = "DELETE FROM dat_phong where id = '$id'" ; 
       insert_update_delete($sql) ; 

       // b2 : insert vào bảng order 

       // b3 : xóa khỏi bảng đặt phòng 

      
       // header về list.php 
       header("location:".BASE_URL."admin/dat_phong/list.php?msg=Xóa thông tin đặt hàng thành công !") ;
?>