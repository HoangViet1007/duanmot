<?php 
    require "config.php" ; 
    require APP_PATH."/dao/pdo.php" ; 

    // lấy mã loại p tí in lại 
    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 
    $id_dg = isset($_GET['id_dg']) ? $_GET['id_dg'] : "" ; 


    // echo $id.$id_dg ;
    $check = "SELECT * FROM danh_gia where id = '$id_dg' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // nếu tồn tại thì mới cho xóa 
        $sql = "DELETE FROM danh_gia WHERE id = '$id_dg'";
        insert_update_delete($sql) ; 
        header("Location:" . BASE_URL . "chi_tiet_room.php?id=$id");
    } else {
        try {
            header("Location:" . BASE_URL . "chi_tiet_room.php?id=$id");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } 


?>