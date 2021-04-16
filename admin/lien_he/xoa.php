<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;
  
 
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    // kiểm tra id này có tồn tại trong dâtbase hay ko 
            
    $check = "SELECT * FROM lien_he where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // naaus toonf taij thif cho xoas
         $sql = "DELETE FROM lien_he where id = '$id' " ; 
         insert_update_delete($sql) ; 
        header('location: ' . BASE_URL . "admin/lien_he/list.php?msg=Xóa liên hệ thành công !");
    } else {
        try {
            header('location: ' . BASE_URL . "admin/lien_he/list.php?msg=Thông tin liên hệ này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>