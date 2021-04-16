<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;
    
    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 
    // kiểm tra id này có tồn tại trong dâtbase hay ko 

    $check = "SELECT * FROM users where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // nếu tồn tại thì mới cho xóa 
        $sql = "DELETE FROM users WHERE id = '$id'";
        insert_update_delete($sql) ; 
        header("Location:" . BASE_URL . "admin/users/list.php?msg=Xóa users thành công !");
    } else {
        try {
            header("Location:" . BASE_URL . "admin/users/list.php?msg=Users này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


?>