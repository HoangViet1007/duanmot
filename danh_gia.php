<?php 
       require_once 'config.php';
       require_once APP_PATH."/dao/pdo.php" ; 

   if(isset($_GET['send'])){
      if(!(isset($_SESSION['admin']) || isset($_SESSION['khach_hang']))){
          header("location:".BASE_URL."tai_khoan/login.php?msgs=Vui lòng đăng nhập trước khi đánh giá !") ;  
      }else{
          // code bình luận cho khách hàng
          if(isset($_SESSION['khach_hang'])){
              $sao = isset($_GET['rating']) ? $_GET['rating'] : "";
              // lấy noi dung
              $noi_dung = $_GET['noi_dung'] ; 
              // lấy ngay bl
              $ngay_danh_gia = date("Y/m/d");
              // lấy h 
              $gio_danh_gia = date('H:i:s');
              // ma laoi p 
              $ma_loai_phong = $_GET['ma_loai_phong'] ; 

              // ma nguoi danh gia
              $ma_nguoi_danh_gia = $_SESSION['khach_hang']['id'] ; 

              $sql = "INSERT INTO danh_gia (so_sao,noi_dung,ngay_danh_gia,gio_danh_gia,trang_thai,ma_loai_phong,ma_nguoi_danh_gia)
                                  VALUES ('$sao','$noi_dung','$ngay_danh_gia','$gio_danh_gia',0,'$ma_loai_phong','$ma_nguoi_danh_gia')" ; 
                                  insert_update_delete($sql) ; 

              header("location:".BASE_URL."chi_tiet_room.php?id=$ma_loai_phong") ; 
          }
          // bình luận choadmin 
          if(isset($_SESSION['admin'])){
            $sao = isset($_GET['rating']) ? $_GET['rating'] : "";
            // lấy noi dung
            $noi_dung = $_GET['noi_dung'] ; 
            // lấy ngay bl
            $ngay_danh_gia = date("Y/m/d");
            // lấy h 
            $gio_danh_gia = date('H:i:s');
            // ma laoi p 
            $ma_loai_phong = $_GET['ma_loai_phong'] ; 

            // ma nguoi danh gia
            $ma_nguoi_danh_gia = $_SESSION['admin']['id'] ; 

            
            $sql = "INSERT INTO danh_gia (so_sao,noi_dung,ngay_danh_gia,gio_danh_gia,trang_thai,ma_loai_phong,ma_nguoi_danh_gia)
            VALUES ('$sao','$noi_dung','$ngay_danh_gia','$gio_danh_gia',0,'$ma_loai_phong','$ma_nguoi_danh_gia')" ; 
            insert_update_delete($sql) ; 
            header("location:".BASE_URL."chi_tiet_room.php?id=$ma_loai_phong") ; 
          }
      }
  }
 

?>