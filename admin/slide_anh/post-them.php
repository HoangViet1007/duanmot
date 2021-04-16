<?php 
     require_once "../../config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 

     // lấy dữ liệu từ bên from sang 
     $hinh = $_FILES['hinh'] ; 
     $hinhErr = "" ; 

     $noi_dung = $_POST['noi_dung'] ; 
     $noi_dungErr = "" ; 

     // validate 
     if(empty($noi_dung)){
         $noi_dungErr = "Nội dung không hợp lệ !" ; 
     }

     // up ảnh
         // validate 
       // check ảnh 
    // updateload anh
    $dir = "../../public/image/slide_anh/";
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
        move_uploaded_file($hinh['tmp_name'], "../../public/image/slide_anh/" . $filename);
        $path = "public/image/slide_anh/" . $filename;
    } 
    else{
        $hinhErr = "";  
    }


    // in looix 
    if($hinhErr.$noi_dungErr != ""){
        header('location:'.BASE_URL."admin/slide_anh/them.php?hinherr=$hinhErr&noi_dungerr=$noi_dungErr");
        die() ; 
      }


     // ínert into 
     
     $sql = "INSERT INTO slide_anh(hinh,noi_dung)
                            VALUES('$path','$noi_dung')" ; 
    insert_update_delete($sql) ; 
    header("location:".BASE_URL."admin/slide_anh/list.php?msg=Thêm ảnh thành công !") ;                        
     



?>