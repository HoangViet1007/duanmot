<?php
    require_once "../config.php" ; 
    require_once "../dao/pdo.php" ; 


    // lấy dữ liệu bên form
    $id = $_POST['id'] ; 

    $mat_khau = $_POST['mat_khau'] ; 

    // check và đăng nhập bằng khách hàng 
      $check_khach_hang = "SELECT * FROM users WHERE id = '$id' AND mat_khau = '$mat_khau' AND ma_vai_tro=2";
      $conn = connect();
      $stmt = $conn->prepare($check_khach_hang);
      $stmt->execute();
      $count_khach_hang =$stmt->fetch() ; 
 
     //  login admin
     $check_admin = "SELECT * FROM users WHERE id = '$id' AND mat_khau = '$mat_khau' AND ma_vai_tro=1";
     $conn = connect();
     $stmt = $conn->prepare($check_admin);
     $stmt->execute();
     $count_admin=$stmt->fetch() ; 
     
     // kiểm tra 
     if ($count_admin) {
         $_SESSION['admin'] = [
             'id' => $count_admin['id'],
             'mat_khau' => $count_admin['mat_khau'],
             'ho_ten' => $count_admin['ho_ten'],
             'hinh' => $count_admin['hinh'],
             'email'=> $count_admin['email'],
             'so_chung_minh'=> $count_admin['so_chung_minh'],
             'sdt'=>$count_admin['sdt'],
             'ma_vai_tro'=>$count_admin['ma_vai_tro']
         ];
 
         header("location:".BASE_URL."admin/dashbroad/dashbroad.php?msgs=Đăng nhập thành công !") ;
 
     } elseif ($count_khach_hang) {
         $_SESSION['khach_hang'] = [
            'id' => $count_khach_hang['id'],
            'mat_khau' => $count_khach_hang['mat_khau'],
            'ho_ten' => $count_khach_hang['ho_ten'],
            'hinh' => $count_khach_hang['hinh'],
            'email'=> $count_khach_hang['email'],
            'so_chung_minh'=> $count_khach_hang['so_chung_minh'],
            'sdt'=>$count_khach_hang['sdt'],
            'ma_vai_tro'=>$count_khach_hang['ma_vai_tro']
         ];
         header("location:".BASE_URL."index.php?msgs=Đăng nhập thành công !") ; 
     } else {
         header("location:".BASE_URL."tai_khoan/login.php?msgs=Tài khoản hoặc mật khẩu không chính xác !") ; 
     }
    


?>