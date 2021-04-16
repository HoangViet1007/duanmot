<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    
    // lấy id xuống  
    $id = $_POST['id'] ; 
    // kiểm tra xem id này có trong database ko 
    $sql = "select * from tin_tuc where id = '$id'" ; 
    $tt = select_one($sql) ; 
    if(!$tt){
        header("location:".BASE_URL."admin/tin_tuc/list.php?msg=Bài viết này không tồn tại !") ; 
        die ; 
    }
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
       $dir = "../../public/image/tin_tuc/";
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
           move_uploaded_file($hinh['tmp_name'], "../../public/image/tin_tuc/" . $filename);
           $path = "public/image/tin_tuc/" . $filename;
       } 
       else {
           $hinhErr = "";
       }
   } 

    //in lỗi 
   
    if($tieu_deErr.$noi_dungErr.$hinhErr){
        header("location:".BASE_URL."admin/tin_tuc/list.php?id=$id&tieu_deerr=$tieu_deErr&noi_dungerr=$noi_dungErr&hinherr=$hinhErr") ; 
        die() ; 
    }

    // update 
    $sql = "UPDATE tin_tuc set tieu_de = '$tieu_de',
                                    hinh = '$path',
                                    noi_dung = '$noi_dung',
                                    trang_thai = $trang_thai
                                    where id = '$id'" ; 
                                    insert_update_delete($sql) ; 
    header("location:".BASE_URL."admin/tin_tuc/list.php?msg=Chỉnh sửa bài viết thành công !") ;                                 


?>