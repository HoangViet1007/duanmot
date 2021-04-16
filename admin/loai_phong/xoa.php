<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;
    
    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 
    // kiểm tra id này có tồn tại trong dâtbase hay ko 

    $check = "SELECT * FROM loai_phong where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // nếu tồn tại thì mới cho xóa 
        $sql = "DELETE FROM loai_phong WHERE id = '$id'";
        insert_update_delete($sql) ; 
        header("Location:" . BASE_URL . "admin/loai_phong/list.php?msg=Xóa loại phòng thành công !");
    } else {
        try {
            header("Location:" . BASE_URL . "admin/loai_phong/list.php?msg=Loại phòng này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>