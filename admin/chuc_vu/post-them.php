<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 


    // lấy dữ liệu bên them.php 
    $ten_vai_tro = $_POST['ten_vai_tro'] ; 
    $ten_vai_troErr = "" ; 

    // validate 
    if(empty($ten_vai_tro)){
        $ten_vai_troErr = "Hãy nhập tên chức vụ !" ; 
    }
    if(strlen($ten_vai_tro) < 3 || strlen($ten_vai_tro) > 30){
        $ten_vai_troErr = "Tên chức vụ không hợp lệ !" ; 
    }
    if($ten_vai_troErr != ""){
        header('location:'.BASE_URL."admin/chuc_vu/them.php?ten_vai_troerr=$ten_vai_troErr");
        die() ; 
      }
    
      $check = "SELECT * FROM vai_tro WHERE ten_vai_tro = '$ten_vai_tro'";
      $cout = connect()->prepare($check);
      $cout->execute();
      if ($cout->rowCount() > 0) {
          header("location:".BASE_URL."admin/chuc_vu/list.php?msg=Chức vụ này đã tồn tại !") ; 
          die;  
      } else {
            try {
                $sql = "INSERT INTO vai_tro(ten_vai_tro)
                VALUES 
                        ('$ten_vai_tro')" ;   
                insert_update_delete($sql) ; 
                    header('location: ' . BASE_URL . "admin/chuc_vu/list.php?msg=Thêm chức vụ thành công !");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
      }


    
?>