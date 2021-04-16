<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 


    // lấy dữ liên bên them.php sang 
    $ten = $_POST['ten'] ; 
    $tenErr = "" ; 

    $duong_dan = $_POST['duong_dan'] ; 
    $duong_danErr = "" ; 

    $hinh = $_FILES['hinh'] ; 
    $hinhErr = "" ; 

    // validate 
    if(empty($ten)){
        $tenErr = "Hãy nhập tên thư viện !" ; 
    }

    if(empty($duong_dan)){
        $duong_danErr = "Hãy nhập đường dẫn cho thư viện !" ; 
    }

     // check ảnh 
    // updateload anh
    $dir = "../../public/image/thu_vien/";
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
        move_uploaded_file($hinh['tmp_name'], "../../public/image/thu_vien/" . $filename);
        $path = "public/image/thu_vien/" . $filename;
    } 
    else{
        $hinhErr = "";  
    }

    // in lỗi 
    if($tenErr.$hinhErr.$duong_danErr){
        header("location:".BASE_URL."admin/thu_vien/them.php?tenerr=$tenErr&duong_danerr=$duong_danErr&hinherr=$hinhErr") ; 
        die() ; 
    }
    // var_dump(1) ; die() ; 



    // bawts ddaauf insserrt 
    $sql = "INSERT INTO hinh_anh_khach_san (ten,hinh,duong_dan)
                                       VALUES ('$ten','$path','$duong_dan')" ; 

                                       insert_update_delete($sql) ; 

    header("location:".BASE_URL."admin/thu_vien/list.php?msg=Thêm ảnh thư viện thành công !") ;                                    
 

?>    