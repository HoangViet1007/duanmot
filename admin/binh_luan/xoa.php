<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;
  
 
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    // kiểm tra id này có tồn tại trong dâtbase hay ko 
            
    $check = "SELECT * FROM binh_luan where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // naaus toonf taij thif cho xoas
         $sql = "DELETE FROM binh_luan where id = '$id' " ; 
         insert_update_delete($sql) ; 
        header('location: ' . BASE_URL . "admin/binh_luan/list.php?msg=Xóa bình luận thành công !");
    } else {
        try {
            header('location: ' . BASE_URL . "admin/binh_luan/list.php?msg=Thông tin bình luận này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>