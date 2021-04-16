<?php
   require_once "../config.php";

    if (isset($_SESSION['khach_hang'])) {
        unset($_SESSION['khach_hang']);
        header("location:".BASE_URL."tai_khoan/login.php?msgs=Đăng xuất thành công !") ; 
    } elseif (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        header("location:".BASE_URL."tai_khoan/login.php?msgs=Đăng xuất thành công !") ; 
    }



?>