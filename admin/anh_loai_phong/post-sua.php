<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ; 

   // kiểm tra xem có tồn tại trong dâtbase ko mới cho sửa 
   
   $id = $_POST['id'] ; 
   // kiểm tra xem id này có trong database ko 
   $sql = "select * from hinh_anh_loai_phong where id = '$id'" ; 
   $tt = select_one($sql) ; 

   if(!$tt){
       header("location:".BASE_URL."admin/anh_loai_phong/list.php?msg=Hình ảnh này không tồn tại !") ; 
       die ; 
   }
     // lấy dữ liệu bên sua.php 
     // lấy dữ liệu bên them.php 
     $hinh = $_FILES['hinh'] ; 
     $hinhErr = "" ; 
 
     $ma_loai_phong = $_POST['ma_loai_phong'] ; 
     $ma_loai_phongErr = "" ; 
 
    
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
   

     // in lỗi 
     if($hinhErr != ""){
         header('location:'.BASE_URL."admin/anh_loai_phong/sua.php?id=$id&hinherr=$hinhErr");
         die() ; 
       }

    // bat đầu câu lệnh 
    $sql = "UPDATE hinh_anh_loai_phong set 
                                        ma_loai_phong = '$ma_loai_phong',
                                        hinh = '$path'
                                        where id = '$id' ";  
    insert_update_delete($sql) ;     
    header("location:".BASE_URL."admin/anh_loai_phong/list.php?msg=Sửa hình ảnh thành công !") ;    



?>