<?php
     require_once "../config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 
   
     $id = $_POST['ids'] ; 
     $sql = "select * from users where id = '$id'" ; 
     $tt = select_one($sql) ; 
  
     if(!$tt){
         header("location:".BASE_URL."?msg=Users này không tồn tại !") ; 
         die ; 
     }



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

   // hình ảnh
   
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
       $dir = "../public/image/users/";
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
           move_uploaded_file($hinh['tmp_name'], "../public/image/users/" . $filename);
           $path = "public/image/users/" . $filename;
       } 
       else {
           $hinhErr = "";
       }
   }

//    echo $id.$ho_ten."----------".$email."-----------"."----------".$so_chung_minh."--------".$sdt ."---".$tt['hinh']; 

//    var_dump(1) ; die() ; 
   
   


      // in lỗi 
      if($ho_tenErr.$hinhErr.$emailErr.$so_chung_minhErr.$sdtErr){
        header("location:".BASE_URL."tai_khoan/update.php?ho_tenerr=$ho_tenErr&emailerr=$emailErr&so_chung_minherr=$so_chung_minhErr&sdterr=$sdtErr&hinherr=$hinhErr") ;
        die() ;  
    }
    


   // update 
   $sql = "UPDATE users set 
                          ho_ten = '$ho_ten',
                          hinh = '$path',
                          email = '$email',
                          so_chung_minh = '$so_chung_minh',
                          sdt = '$sdt'
                          where id = '$id'" ; 
                          insert_update_delete($sql) ; 
    header("location:".BASE_URL."tai_khoan/login.php?msg=Sửa thông tin tài khoản thành công vui lòng đăng nhập lại !") ;                      
?>