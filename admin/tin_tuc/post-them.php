<?php
     require_once "../../config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 
    
     // lấy dữ liệu thêm 
     $tieu_de = $_POST['tieu_de'] ; 
     $tieu_deErr = "" ; 

     $noi_dung = $_POST['noi_dung'] ; 
     $noi_dungErr = "" ; 

     $hinh = $_FILES['hinh'] ; 
     $hinhErr = ""  ; 

     $trang_thai = $_POST['trang_thai'] ; 
     

    //  validate
    if(empty($tieu_de)){
        $tieu_deErr = "Hãy nhập tiêu đề !" ; 
    }
    if(empty($noi_dung)){
        $noi_dungErr = "Hãy nhập tiêu đề !" ; 
    }

     // up ảnh
         // validate 
       // check ảnh 
    // updateload anh
    $dir = "../../public/image/tin_tuc/";
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
        move_uploaded_file($hinh['tmp_name'], "../../public/image/tin_tuc/" . $filename);
        $path = "public/image/tin_tuc/" . $filename;
    } 
    else{
        $hinhErr = "";  
    }


    // in lỗi 
    if($tieu_deErr.$noi_dungErr.$hinhErr){
        header("location:".BASE_URL."admin/tin_tuc/them.php?tieu_deerr=$tieu_deErr&noi_dungerr=$noi_dungErr&hinherr=$hinhErr") ; 
        die() ; 
    }


    // inserrt vao database 
    $sql = "INSERT INTO tin_tuc(tieu_de,noi_dung,hinh,trang_thai)
                               VALUES ('$tieu_de','$noi_dung','$path',$trang_thai)" ;
                               insert_update_delete($sql) ; 
                               
    header("location:".BASE_URL."admin/tin_tuc/list.php?msg=Thêm bài viết thành công !") ;                            

    
    
?>