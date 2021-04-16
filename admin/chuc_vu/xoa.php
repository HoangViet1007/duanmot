<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;
  
 
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    // kiểm tra id này có tồn tại trong dâtbase hay ko 
            
    $check = "SELECT * FROM vai_tro where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // naaus toonf taij thif cho xoas
         $sql = "DELETE FROM vai_tro where id = '$id' " ; 
         insert_update_delete($sql) ; 
        header('location: ' . BASE_URL . "admin/chuc_vu/list.php?msg=Xóa chúc vụ thành công !");
    } else {
        try {
            header('location: ' . BASE_URL . "admin/chuc_vu/list.php?msg=Chức vụ này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>