<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    
    // lấy dữu liệu bên form them.php
    $ten_loai = $_POST['ten_loai'] ; 
    $ten_loaiErr = "" ; 

    $hinh = $_FILES['hinh'] ; 
    $hinhErr = "" ;

    $so_luong_phong = $_POST['so_luong_phong'] ; 
    $so_luong_phongErr = "" ; 

    // $trang_thai = $_POST['trang_thai'] ; 
    // $trang_thaiErr = "" ; 

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
    if( strlen($don_gia) == 0 || $don_gia <= 0 ){
        $don_giaErr = "Gía không hợp lệ !" ; 
    }
    if(strlen($gioi_thieu) == 0){
        $gioi_thieuErr = "Hãy nhập giới thiệu cho loại phòng !" ; 
    }
    if(strlen($mo_ta) == 0){
        $mo_taErr = "Hãy nhập mô tả cho loại phòng !" ; 
    }

    // check ảnh 
    // updateload anh
    $dir = "../../public/image/loai_phong/";
    $target_file = $dir . basename($hinh['name']);
    $filename = "";
    $path = "";
    $sizeanh = 1500000;
    $typeanh =  array('jpg', 'png', 'jpeg','bmp');
    $kieu = pathinfo($target_file, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES['hinh']['tmp_name']);
    if($_FILES['hinh']['size'] <= 0  ){
        $hinhErr = "Hãy nhập hình ảnh !";
    } 
    elseif(!($check !== false)) {
        $hinhErr = "Hãy nhập ảnh hợp lệ !";
    }   
    elseif ($hinh['size'] > $sizeanh) {
        $hinhErr = "File ảnh quá lớn. Vui lòng chọn ảnh khác !";
    }
    elseif(!in_array($kieu, $typeanh)){
        $hinhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG , BMP!";
    } 
    else if ($hinh['size'] > 0 && $hinh['size'] < $sizeanh) {
        $filename = uniqid() . "_" . $hinh['name'];
        move_uploaded_file($hinh['tmp_name'], "../../public/image/loai_phong/" . $filename);
        $path = "public/image/loai_phong/" . $filename;
    } 
    else{
        $hinhErr = "";  
    }


    // hiển thị lỗi 

    if($ten_loaiErr.$hinhErr.$so_luong_phongErr.$don_giaErr.$gioi_thieuErr.$mo_taErr.$dac_bietErr){
        header("location:".BASE_URL."admin/loai_phong/them.php?ten_loaierr=$ten_loaiErr&hinherr=$hinhErr&so_luong_phongerr=$so_luong_phongErr&don_giaerr=$don_giaErr&gioi_thieuerr=$gioi_thieuErr&mo_taerr=$mo_taErr") ; 
        die() ; 
    }


    $so_phong_da_dat = 0 ; 
    $so_phong_trong = ($so_luong_phong - $so_phong_da_dat) ; 
    // bắt đầu inserrt 
    $check = "SELECT * FROM loai_phong WHERE ten_loai = '$ten_loai'";
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        header("location:".BASE_URL."admin/loai_phong/list.php?msg=Loại phòng này đã tồn tại !") ; 
        die;  
    } else {
          try {
              $sql = "INSERT INTO loai_phong(ten_loai,hinh,so_luong_phong,so_phong_da_dat,so_phong_trong,don_gia,gioi_thieu,mo_ta,dac_biet)
              VALUES 
                                            ('$ten_loai','$path','$so_luong_phong',0,$so_phong_trong,'$don_gia','$gioi_thieu','$mo_ta',$dac_biet)" ;   
              insert_update_delete($sql) ; 
                  header('location: ' . BASE_URL . "admin/loai_phong/list.php?msg=Thêm loại phòng thành công !");
          } catch (PDOException $e) {
              echo $e->getMessage();
          }
    }







 

    


?>