<?php 
    require_once "../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    // lấy dữu liện bên thêm sang 
    $id = $_POST['id'] ; 
    $idErr = "" ; 

    $mat_khau = $_POST['mat_khau'] ; 
    $mat_khauErr = "" ; 

    $cf_mat_khau = $_POST['cf_mat_khau'] ; 
    $cf_mat_khauErr = "" ;

    $ho_ten = $_POST['ho_ten'] ; 
    $ho_tenErr = "" ; 

    $hinh = $_FILES['hinh'] ; 
    $hinhErr = "" ; 

    $email = $_POST['email'] ; 
    $emailErr = "" ; 

    $so_chung_minh = $_POST['so_chung_minh'] ; 
    $so_chung_minhErr = "" ; 

    $sdt = $_POST['sdt'] ; 
    $sdtErr = "" ; 

    
    // validate from 
    // kiem tra tên đăng nhập
    $id_hop_le = '/^[a-zA-Z0-9_]{3,30}$/' ;
    if(strlen($id) == 0){
        $idErr = "Hãy nhập tên đăng nhập !" ; 
    }
    else if(strlen($id) < 3 || strlen($id) > 30){
        $idErr = "Tên đăng nhập không hợp lệ !" ; 
    }
    else if(!preg_match($id_hop_le , $id)){
        $idErr = "Tên đăng nhập không hợp lệ !" ; 

    }else{
        $idErr = "" ; 
    }


    // mật khẩu         
    $removeWhiteSpacePassword = str_replace(" ", "", $mat_khau);
    
    if(strlen($mat_khau) < 6 || (strlen($removeWhiteSpacePassword) != strlen($mat_khau))){
        $mat_khauErr = "Mật khẩu không thỏa mãn đk (ít nhất 6 ký tự và không chứa khoảng trắng)";
    }

    // giống với xác nhận mk
    if(strlen($cf_mat_khau) == 0){
        $cf_mat_khauErr = "Hãy nhập xác nhận mật khẩu" ; 
    }
    if($cf_mat_khau != $mat_khau){
        $cf_mat_khauErr = "Mật khẩu và xác nhận mật khẩu không khớp";
    }

  
    // ho va ten 
    if(strlen($ho_ten) == 0 ){
        $ho_tenErr = "Hãy nhập họ và tên !" ; 
    }
    if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $ho_ten)) {
        $ho_tenErr = "Họ và tên không hợp lệ";
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


     // số chứng minh 
     $so_chung_minh__hop_le = '/(^0([0-9]{11}))$/' ; 
     if(empty($so_chung_minh)){
         $so_chung_minhErr = "Hãy nhập số chứng minh thư !" ; 
     }
     elseif(!preg_match($so_chung_minh__hop_le , $so_chung_minh)){
        $so_chung_minhErr = "Số chứng minh không hợp lệ !" ;  
    }else{
        $so_chung_minhErr = "" ; 
    }


    // sdt 
    $sdt_hop_le = '/((^0)(32|33|34|35|36|37|38|39|56|58|59|70|76|77|78|79|81|82|83|84|85|86|88|89|90|92|91|93|94|96|97|98|99)+([0-9]{7}))$/' ; 
   //  32,33,34,35,36,37,38,39,56,58,59,70,76,77,78,79,81,82,83,84,85,86,88,89,90,91,92,93,94,96,97,98,99   /^[a-zA-Z0-9_]{3,30}$/
   if (empty($_POST['sdt'])) {
       $sdtErr = "Hãy nhập số điện thoại !";

   }
   else if(!preg_match($sdt_hop_le , $sdt)){
       $sdtErr = "Số điện thoại không hợp lệ !";
   }
   else {
       $sdtErr = "";
   }


     // check ảnh 
    // updateload anh
    $dir = "../public/image/users/";
    $target_file = $dir . basename($hinh['name']);
    $filename = "";
    $path = "";
    $sizeanh = 1500000;
    $typeanh =  array('jpg', 'png', 'jpeg','bmp');
    $kieu = pathinfo($target_file, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES['hinh']['tmp_name']);
    if($_FILES['hinh']['size'] <= 0  ){
        $hinhErr = "Hãy nhập hình ảnh !";
    } 
    elseif(!($check !== false)) {
        $hinhErr = "Hãy nhập ảnh hợp lệ !";
    }   
    elseif ($hinh['size'] > $sizeanh) {
        $hinhErr = "File ảnh quá lớn. Vui lòng chọn ảnh khác !";
    }
    elseif(!in_array($kieu, $typeanh)){
        $hinhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG , BMP!";
    } 
    else if ($hinh['size'] > 0 && $hinh['size'] < $sizeanh) {
        $filename = uniqid() . "_" . $hinh['name'];
        move_uploaded_file($hinh['tmp_name'], "../public/image/users/" . $filename);
        $path = "public/image/users/" . $filename;
    } 
    else{
        $hinhErr = "";  
    }

   if($idErr.$mat_khauErr.$cf_mat_khauErr.$ho_tenErr.$hinhErr.$emailErr.$so_chung_minhErr.$sdtErr){
       header("location:".BASE_URL."tai_khoan/them.php?iderr=$idErr&mat_khauerr=$mat_khauErr&cf_mat_khauerr=$cf_mat_khauErr&ho_tenerr=$ho_tenErr&emailerr=$emailErr&so_chung_minherr=$so_chung_minhErr&sdterr=$sdtErr&hinherr=$hinhErr") ;
       die() ;  
   }
    //    var_dump(1) ; die() ; 

    // $mahoa = password_hash($mk,DEFAULT);
    // kiểm tra xem có trùng mã khách hàng ko ... nếu có thì ko cho insert và nếu ko thì cho insêrt 
   $check = "SELECT * FROM users WHERE id = '$id'";
   $cout = connect()->prepare($check);
   $cout->execute();
   if ($cout->rowCount() > 0) {
       header("location:".BASE_URL."tai_khoan/them.php?msg=Users này đã tồn tại !") ; 
       die();  
   } else {
       try {
           $sql = "INSERT INTO users(id,mat_khau,ho_ten,hinh,email,so_chung_minh,sdt,ma_vai_tro)
           VALUES 
                                   ('$id','$mat_khau','$ho_ten','$path','$email','$so_chung_minh','$sdt',2)" ;       
       
           insert_update_delete($sql) ; 
           header("location:".BASE_URL."tai_khoan/them.php?msg=Thêm users thành công !") ; 
       } catch (PDOException $e) {
           echo $e->getMessage();
       }
   }








?>