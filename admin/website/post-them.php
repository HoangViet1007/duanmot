<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    // lấy thong tin bên form
    $ten_web = $_POST['ten_web'] ; 
    $ten_webErr = "" ; 

    $logo = $_FILES['logo'] ; 
    $logoErr = "" ; 

    $sdt = $_POST['sdt'] ; 
    $sdtErr = "" ; 

    $dia_chi = $_POST['dia_chi'] ; 
    $dia_chiErr = "" ; 

    $email = $_POST['email'] ; 
    $emailErr = "" ; 

    $map_url = $_POST['map_url'] ; 
    $map_urlErr = "" ; 


    // validate 
    // teen
    $ten_web_hop_le = '/^[a-zA-Z0-9_]{3,30}$/' ;
    if(strlen($ten_web) == 0){
        $ten_webErr = "Hãy nhập tên website " ; 
    }
    else if(strlen($ten_web) < 3 || strlen($ten_web) > 30){
        $ten_webErr = "Tên website không hợp lệ !" ; 
    }
    else if(!preg_match($ten_web_hop_le , $ten_web)){
        $ten_webErr = "Tên website không hợp lệ !" ; 

    }else{
        $ten_webErr = "" ; 
    }

    $sdt_hop_le = '/((^0)(32|33|34|35|36|37|38|39|56|58|59|70|76|77|78|79|81|82|83|84|85|86|88|89|90|92|91|93|94|96|97|98|99)+([0-9]{7}))$/' ; 
    //  32,33,34,35,36,37,38,39,56,58,59,70,76,77,78,79,81,82,83,84,85,86,88,89,90,91,92,93,94,96,97,98,99   /^[a-zA-Z0-9_]{3,30}$/
    if (empty($_POST['sdt'])) {
        $sdtErr = "Vui lòng nhập số điện thoại !";

    }
    else if(!preg_match($sdt_hop_le , $sdt)){
        $sdtErr = "Số điện thoại không hợp lệ !";
    }
    else {
        $sdtErr = "";
    }

    //diachi
    if(empty($dia_chi)){
        $dia_chiErr = "Hãy nhập địa chỉ !" ; 
    }

    // email
    $email_hop_le = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ; 
    if(empty($email)){
        $emailErr = "Hãy nhập email !" ;  
    }
    elseif(!preg_match($email_hop_le , $email)){
        $emailErr = "Email không hợp lệ !" ;  
    }else{
        $emailErr = "" ; 
    }

    // map
    if(empty($map_url)){
        $map_urlErr = "Hãy nhập bản đồ !" ; 
    }
    
    // check ảnh 
    // updateload anh
    $dir = "../../public/image/website/";
    $target_file = $dir . basename($logo['name']);
    $filename = "";
    $path = "";
    $sizeanh = 1500000;
    $check = getimagesize($_FILES['logo']['tmp_name']);
    $typeanh =  array('jpg', 'png', 'jpeg','bmp');
    $kieu = pathinfo($target_file, PATHINFO_EXTENSION);
    if($_FILES['logo']['size'] <= 0  ){
        $logoErr = "Hãy nhập hình ảnh !";
    }  
    elseif(!($check !== false)) {
        $logoErr = "Hãy nhập ảnh hợp lệ !";
    } 
    elseif ($logo['size'] > $sizeanh) {
        $logoErr = "File ảnh quá lớn. Vui lòng chọn ảnh khác !";
    }
    elseif(!in_array($kieu, $typeanh)){
        $logoErr = "Chỉ được upload các định dạng JPG, PNG, JPEG , BMP!";
    } 
    elseif ($logo['size'] > 0 && $logo['size'] < $sizeanh) {
        $filename = uniqid() . "_" . $logo['name'];
        move_uploaded_file($logo['tmp_name'], "../../public/image/website/" . $filename);
        $path = "public/image/website/" . $filename;
    }
    else{
        $logoErr = "";  
    }




    if($ten_webErr.$sdtErr.$dia_chiErr.$emailErr.$logoErr.$map_urlErr){
        header("location:".BASE_URL."admin/website/them.php?ten_weberr=$ten_webErr&sdterr=$sdtErr&dia_chierr=$dia_chiErr&emailerr=$emailErr&map_urlerr=$map_urlErr&logoerr=$logoErr") ; 
        die() ; 
    }


    $sql = "INSERT INTO thong_tin_website(ten_web,logo,sdt,dia_chi,email,map_url)
    VALUES 
            ('$ten_web','$path','$sdt','$dia_chi','$email',$map_url)" ;       

    insert_update_delete($sql) ; 
    header("location:".BASE_URL."admin/website/list.php?msg=Thêm mới thông tin thành công !") ; 
    
?>