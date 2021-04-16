<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;
  
 
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    // kiểm tra id này có tồn tại trong dâtbase hay ko 
            
    $check = "SELECT * FROM orders where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // naaus toonf taij thif cho xoas
         $sql = "DELETE FROM orders where id = '$id' " ; 
         insert_update_delete($sql) ; 
        header('location: ' . BASE_URL . "admin/hoa_don/list.php?msg=Xóa đơn hàng thành công !");
    } else {
        try {
            header('location: ' . BASE_URL . "admin/hoa_don/list.php?msg=Thông tin hóa đơn này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>