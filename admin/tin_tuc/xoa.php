<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;
    
    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 
    // kiểm tra id này có tồn tại trong dâtbase hay ko 
    $check = "SELECT * FROM tin_tuc where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // nếu tồn tại thì mới cho xóa 
        $sql = "DELETE FROM tin_tuc WHERE id = '$id'";
        insert_update_delete($sql) ; 
        header("Location:" . BASE_URL . "admin/tin_tuc/list.php?msg=Xóa bài viết thành công !");
    } else {
        try {
            header("Location:" . BASE_URL . "admin/tin_tuc/list.php?msg=Bài viết này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>