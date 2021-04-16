<?php 
     require_once "../../config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 
     
     // lấy id xuống  
     $id = $_POST['id'] ; 
  // kiểm tra xem id này có trong database ko 
    $sql = "select * from slide_anh where id = '$id'" ; 
    $tt = select_one($sql) ; 
    if(!$tt){
        header("location:".BASE_URL."admin/slide_anh/list.php?msg=Ảnh này không tồn tại !") ; 
        die ; 
    }


    // lấy dữ liệu 
    $hinh = $_FILES['hinh'] ; 
    $hinhErr = "" ; 

    $noi_dung = $_POST['noi_dung'] ; 
    $noi_dungErr = "" ; 

    // validate 
    if(empty($noi_dung)){
        $noi_dungErr = "Nội dung không hợp lệ !" ; 
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
  


   // in looix 
   if($hinhErr.$noi_dungErr != ""){
       header('location:'.BASE_URL."admin/slide_anh/sua.php?id=$id&hinherr=$hinhErr&noi_dungerr=$noi_dungErr");
       die() ; 
     }

     // update 
     $sql = "UPDATE slide_anh set 
                                 hinh = '$path',
                                 noi_dung = '$noi_dung'
                                 where id = '$id'" ; 
     insert_update_delete($sql) ; 
     header("location:".BASE_URL."admin/slide_anh/list.php?msg=Sửa thông tin slide ảnh thành công !") ;                             


?>