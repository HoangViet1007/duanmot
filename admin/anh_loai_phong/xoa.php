<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;
  
 
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    $sql = "DELETE FROM hinh_anh_loai_phong where id = '$id' " ; 
    insert_update_delete($sql) ; 
    header('location: ' . BASE_URL . "admin/anh_loai_phong/list.php?msg=Xóa hình ảnh thành công !");


?>