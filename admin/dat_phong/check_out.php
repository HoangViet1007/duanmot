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
       $sql = "UPDATE dat_phong set trang_thai = 2 where id = '$id'" ; 
       insert_update_delete($sql) ; 

       // b2 : insert vào bảng order (id,thue_VAT,tong_tien,ngay_tao,ma_loai_phong)
       // --- lấy za số ngày thuê p 
       $sql = "SELECT * FROM dat_phong where id = '$id'" ; 
       $dp = select_one($sql) ; 
       $ngay_den = $dp['ngay_den'] ; 
       $ngay_di = $dp['ngay_di'] ;
       $a = (strtotime($ngay_di) - strtotime($ngay_den)) ;  
       $so_ngay_thue = ceil($a/(24*60*60)) ;
       $tong_tien = ($so_ngay_thue * $lp['don_gia']) + ($so_ngay_thue * $lp['don_gia'])*0.05 ; 
        $thue_VAT = 0.05 ;

       // b3 : insserrt 
       $sql = "INSERT INTO orders(thue_VAT,tong_tien,ngay_tao,ma_dat_phong) 
                           VALUES ('$thue_VAT','$tong_tien','$ngay_di','$id')" ; 
       insert_update_delete($sql) ; 

       // echo $thue_VAT."---".$tong_tien."----".$ngay_di."----".$ma_loai_phong ; 
       // header về list.php 
       header("location:".BASE_URL."admin/dat_phong/list.php?msg=Check out thành công !") ;
?>