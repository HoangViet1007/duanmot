<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 


    // lấy dữ liệu bên them.php 
    $hinh = $_FILES['hinh'] ; 
    $hinhErr = "" ; 

    $ma_loai_phong = $_POST['ma_loai_phong'] ; 
    $ma_loai_phongErr = "" ; 

    // validate 
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


    // in looix 
    if($hinhErr != ""){
        header('location:'.BASE_URL."admin/anh_loai_phong/them.php?hinherr=$hinhErr");
        die() ; 
      }
    
      
    $sql = "INSERT INTO hinh_anh_loai_phong(hinh,ma_loai_phong) VALUES ('$path','$ma_loai_phong')" ;   
    insert_update_delete($sql) ; 
    header('location: ' . BASE_URL . "admin/anh_loai_phong/list.php?msg=Thêm hình ảnh cho loại phòng thành công !");



    
?>