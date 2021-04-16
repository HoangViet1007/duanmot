<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    
    // lấy id và kiểm tra xem có tồn tại trong dâtbase ko 
    $id = $_POST['id'] ; 
 // kiểm tra xem id này có trong database ko 
    $sql = "select * from hinh_anh_khach_san where id = '$id'" ; 
    $tt = select_one($sql) ; 

    if(!$tt){
        header("location:".BASE_URL."admin/thu_vien/list.php?msg=Thư viện hình ảnh này không tồn tại !") ; 
        die ; 
    }

    
    // lấy dữ liên bên them.php sang 
    $ten = $_POST['ten'] ; 
    $tenErr = "" ; 

    $duong_dan = $_POST['duong_dan'] ; 
    $duong_danErr = "" ; 

    $hinh = $_FILES['hinh'] ; 
    $hinhErr = "" ; 

    // validate 
    if(empty($ten)){
        $tenErr = "Hãy nhập tên thư viện !" ; 
    }

    if(empty($duong_dan)){
        $duong_danErr = "Hãy nhập đường dẫn cho thư viện !" ; 
    }


    $path = $tt['hinh'] ;
    $check = getimagesize($_FILES['hinh']['tmp_name']); 
    $sizeanh = 1500000;
    if($_FILES['hinh']['size'] <= 0  ){
        $path = $tt['hinh']; 
    }    
    elseif ($_FILES['hinh']['size'] > $sizeanh) {
        $hinhErr = "File ảnh quá lớn. Vui lòng chọn ảnh khác !";
    }
    elseif(!($check !== false)) {
        $hinhErr = "Hãy nhập ảnh hợp lệ !";
    } 
    else{
        $dir = "../../public/image/thu_vien/";
        $target_file = $dir . basename($hinh['name']);
        $filename = "";
        $path = "";
        $typeanh =  array('jpg', 'png', 'jpeg','bmp');;
        $kieu = pathinfo($target_file, PATHINFO_EXTENSION);

        if (!in_array($kieu, $typeanh)) {
            $hinhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG";
        }
        elseif ($hinh['size'] > 0 && $hinh['size'] < $sizeanh) {
            $filename = uniqid() . "_" . $hinh['name'];
            move_uploaded_file($hinh['tmp_name'], "../../public/image/thu_vien/" . $filename);
            $path = "public/image/thu_vien/" . $filename;
        } 
        else {
            $hinhErr = "";
        }
    } 

     // hiển thị lỗi 
     if($tenErr.$hinhErr.$duong_danErr){
        header("location:".BASE_URL."admin/thu_vien/them.php?id=$id&tenerr=$tenErr&duong_danerr=$duong_danErr&hinherr=$hinhErr") ; 
        die() ; 
    }

    // update 
    $sql = "UPDATE hinh_anh_khach_san set ten = '$ten' , 
                                          hinh = '$path',
                                          duong_dan = '$duong_dan'
                                          where id = '$id'" ; 

                                          insert_update_delete($sql) ; 
    header("location:".BASE_URL."admin/thu_vien/list.php?msg=Sửa ảnh thư viện thành công !") ;                                    


?>