<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ; 

   // kiểm tra xem có tồn tại trong dâtbase ko mới cho sửa 
   
   $id = $_POST['id'] ; 
   // kiểm tra xem id này có trong database ko 
   $sql = "select * from vai_tro where id = '$id'" ; 
   $tt = select_one($sql) ; 

   if(!$tt){
       header("location:".BASE_URL."admin/chuc_vu/list.php?msg=Chức vụ này không tồn tại !") ; 
       die ; 
   }
     // lấy dữ liệu bên sua.php 
     $ten_vai_tro = $_POST['ten_vai_tro'] ; 
     $ten_vai_troErr = "" ; 
 
     // validate 
     if(empty($ten_vai_tro)){
         $ten_vai_troErr = "Hãy nhập tên chức vụ !" ; 
     }
     if(strlen($ten_vai_tro) < 3 || strlen($ten_vai_tro) > 30){
         $ten_vai_troErr = "Tên chức vụ không hợp lệ !" ; 
     }
     if($ten_vai_troErr != ""){
         header('location:'.BASE_URL."admin/chuc_vu/sua.php?id=$id&ten_vai_troerr=$ten_vai_troErr");
         die() ; 
       }

    

    $check = "SELECT * FROM vai_tro WHERE ten_vai_tro = '$ten_vai_tro'";
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        header("location:".BASE_URL."admin/chuc_vu/list.php?msg=Chức vụ này đã tồn tại !") ; 
        die;  
    } else {
        try {
            $sql = "UPDATE vai_tro set 
            ten_vai_tro = '$ten_vai_tro'
            where id = '$id' ";  
            insert_update_delete($sql) ;     
            header("location:".BASE_URL."admin/chuc_vu/list.php?msg=Sửa chức vụ website thành công !") ;    
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


?>