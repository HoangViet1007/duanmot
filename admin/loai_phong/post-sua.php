<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    
    // lấy id và kiểm tra xem có tồn tại trong dâtbase ko 
    $id = $_POST['id'] ; 
 // kiểm tra xem id này có trong database ko 
    $sql = "select * from loai_phong where id = '$id'" ; 
    $tt = select_one($sql) ; 

    if(!$tt){
        header("location:".BASE_URL."admin/loai_phong/list.php?msg=Loại phòng này không tồn tại này không tồn tại !") ; 
        die ; 
    }

      // lấy dữu liệu bên form sua.php
      $ten_loai = $_POST['ten_loai'] ; 
      $ten_loaiErr = "" ; 
  
      $hinh = $_FILES['hinh'] ; 
      $hinhErr = "" ;
  
      $so_luong_phong = $_POST['so_luong_phong'] ; 
      $so_luong_phongErr = "" ; 
  
      $so_phong_da_dat = $_POST['so_phong_da_dat'] ; 
      $so_phong_da_datErr = "" ; 
  
      $don_gia = $_POST['don_gia'] ; 
      $don_giaErr = "" ; 
  
      $gioi_thieu = $_POST['gioi_thieu'] ; 
      $gioi_thieuErr = ""  ; 
  
      $mo_ta = $_POST['mo_ta'] ; 
      $mo_taErr = "" ; 
  
      $dac_biet = $_POST['dac_biet'] ; 
      $dac_bietErr = "" ; 
  
      // validate 
  
      if(strlen($ten_loai) == 0 || strlen($ten_loai) < 3 || strlen($ten_loai) > 30){
          $ten_loaiErr = "Tên loại phòng không hợp lệ !" ; 
      }
  
      // slp 
      if( strlen($so_luong_phong) == 0 || $so_luong_phong <= 0 ){
          $so_luong_phongErr = "Số lượng phòng không hợp lệ !" ; 
      }
      // đơn giá
      if( strlen($so_phong_da_dat) == 0 || $so_phong_da_dat < 0  || $so_phong_da_dat > $so_luong_phong){
          $so_phong_da_datErr = "Số phòng đã đặt không hợp lệ !" ; 
      }
      
      if( strlen($don_gia) == 0 || $don_gia <= 0 ){
        $don_giaErr = "Gía không hợp lệ !" ; 
     }

      if(strlen($gioi_thieu) == 0){
          $gioi_thieuErr = "Hãy nhập giới thiệu cho loại phòng !" ; 
      }
      if(strlen($mo_ta) == 0){
          $mo_taErr = "Hãy nhập mô tả cho loại phòng !" ; 
      }

  
  
      $path = $tt['hinh'] ;
      $check = getimagesize($_FILES['hinh']['tmp_name']); 
      $sizeanh = 1500000;
      if($_FILES['hinh']['size'] <= 0  ){
          $path = $tt['hinh']; 
      }    
      elseif ($_FILES['hinh']['size'] > $sizeanh) {
          $hinhErr = "File ảnh quá lớn. Vui lòng chọn ảnh khác !";
      }
      elseif(!($check !== false)) {
          $hinhErr = "Hãy nhập ảnh hợp lệ !";
      } 
      else{
          $dir = "../../public/image/loai_phong/";
          $target_file = $dir . basename($hinh['name']);
          $filename = "";
          $path = "";
          $typeanh =  array('jpg', 'png', 'jpeg','bmp');;
          $kieu = pathinfo($target_file, PATHINFO_EXTENSION);
  
          if (!in_array($kieu, $typeanh)) {
              $hinhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG";
          }
          elseif ($hinh['size'] > 0 && $hinh['size'] < $sizeanh) {
              $filename = uniqid() . "_" . $hinh['name'];
              move_uploaded_file($hinh['tmp_name'], "../../public/image/loai_phong/" . $filename);
              $path = "public/image/loai_phong/" . $filename;
          } 
          else {
              $hinhErr = "";
          }
      } 
    
   
  
      // hiển thị lỗi 

      if($ten_loaiErr.$hinhErr.$so_luong_phongErr.$so_phong_da_datErr.$don_giaErr.$gioi_thieuErr.$mo_taErr.$dac_bietErr){
        header("location:".BASE_URL."admin/loai_phong/sua.php?id=$id&ten_loaierr=$ten_loaiErr&hinherr=$hinhErr&so_luong_phongerr=$so_luong_phongErr&so_phong_da_daterr=$so_phong_da_datErr&don_giaerr=$don_giaErr&gioi_thieuerr=$gioi_thieuErr&mo_taerr=$mo_taErr") ; 
        die() ; 
    }
    
    $so_phong_trong = $so_luong_phong - $so_phong_da_dat ; 

    $sql = "UPDATE loai_phong set       
                                ten_loai = '$ten_loai',
                                hinh = '$path',
                                so_luong_phong = '$so_luong_phong',
                                so_phong_da_dat = '$so_phong_da_dat',
                                so_phong_trong = '$so_phong_trong',
                                don_gia = '$don_gia',
                                gioi_thieu = '$gioi_thieu',
                                mo_ta = '$mo_ta',
                                dac_biet = $dac_biet
                                where id = '$id'
                                " ;  
                                insert_update_delete($sql) ; 
    header("location:".BASE_URL."admin/loai_phong/list.php?msg=Sửa loại phòng thành công !") ;    



   
?>