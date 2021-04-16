<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;
    
    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 
    // kiểm tra id này có tồn tại trong dâtbase hay ko 
            
    $check = "SELECT * FROM thong_tin_website where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // nếu tồn tại thì mới cho xóa 
        $sql = "DELETE FROM thong_tin_website WHERE id = '$id'";
        insert_update_delete($sql) ; 
        header("Location:" . BASE_URL . "admin/website/list.php?msg=Xóa thông tin website thành công !");
    } else {
        try {
            header("Location:" . BASE_URL . "admin/website/list.php?msg=Thông tin website này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


?>