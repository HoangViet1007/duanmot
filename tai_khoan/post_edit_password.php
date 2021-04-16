<?php 
    require_once "../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    // lấy id cần đổi mật khẩu 
    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 


    $sql = "SELECT * FROM users where id = '$id'" ; 
    $mk = select_one($sql) ; 
    if(!$mk){
        header("location:".BASE_URL."tai_khoan/edit-password.php?msg=User không tồn tại !") ; 
        die ; 
    }
    $mkc = $mk['mat_khau'] ; 
     


    // lấ dữ liệu tư from 
    $mat_khau = $_POST['mat_khau'] ; 
    $mat_khauErr = "" ; 

    $new_mat_khau = $_POST['new_mat_khau'] ; 
    $new_mat_khauErr = "" ; 

    $cf_mat_khau = $_POST['cf_mat_khau'] ; 
    $cf_mat_khauErr = "" ; 

    // validate 
    // echo $mat_khau.$new_mat_khau.$cf_mat_khau ; 
    
    // ít nhất 6 ký tự
    // không chứa dấu cách
    if(strlen($mat_khau) == 0){
        $mat_khauErr = "Hãy nhập mật khẩu cũ !";
    }

    if(strlen($new_mat_khau) == 0){
      $new_mat_khauErr = "Hãy nhập mật khẩu mới !";
    }
  
    $removeWhiteSpacePassword = str_replace(" ", "", $new_mat_khau);
    if(strlen($new_mat_khau < 6) || (strlen($removeWhiteSpacePassword) != strlen($new_mat_khau))){
        $new_mat_khauErr = "Mật khẩu mới không thỏa mãn đk (ít nhất 6 ký tự và không chứa khoảng trắng)";
    }
  
    if(strlen($cf_mat_khau) ==0){
      $cf_mat_khauErr = "Hãy nhập xác nhận mật khẩu !"; 
    }

  

   if($mat_khau != $mkc){
      $mat_khauErr = "Mật khẩu cũ không hợp lệ !" ; 
    }

    // if($new_mat_khau != $cf_mat_khau){
    //     $cf_mat_khau = "Xác nhận mật khẩu không hợp lệ !" ; 
    // }

    $hash_new_pass = password_hash($new_mat_khau, PASSWORD_DEFAULT);

    if(!password_verify($cf_mat_khau,  $hash_new_pass)){
       $cf_mat_khauErr = "Xác nhận mật khẩu mới không hợp lệ !" ; 
     }


   if($mat_khauErr.$new_mat_khauErr.$cf_mat_khauErr != ""){
      header('location:'.BASE_URL."tai_khoan/edit-password.php?mat_khauerr=$mat_khauErr&new_mat_khauerr=$new_mat_khauErr&cf_mat_khauerr=$cf_mat_khauErr");
      die ;
    }
    

    $sql = "UPDATE users set
                            mat_khau = '$new_mat_khau'
                            where id = '$id'" ; 
                            insert_update_delete($sql) ; 
    header("location:".BASE_URL."tai_khoan/edit-password.php?msg=Đổi mật khẩu thành công !") ; 

?>