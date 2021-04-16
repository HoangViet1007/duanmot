<?php
    require_once "config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;

    require './lib/PHPMailer/src/Exception.php';
    require './lib/PHPMailer/src/SMTP.php'; 
    require './lib/PHPMailer/src/PHPMailer.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    $ho_ten = $_POST['ho_ten'] ; 
    $ho_tenErr = "" ;

    $sdt = $_POST['sdt'] ; 
    $sdtErr = "" ; 

    $tieu_de = $_POST['tieu_de'] ; 
    $tieu_deErr = "" ; 

    $noi_dung = $_POST['noi_dung'] ; 
    $noi_dungErr = "" ; 

    $email = $_POST['email'] ; 
    $emailErr = "" ; 

    // validate 

    if (empty($_POST['ho_ten'])) {
        $ho_tenErr = "Vui lòng nhập họ và tên !";
    } 
    if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $_POST['ho_ten'])) {
        $ho_tenErr = "Họ và tên không hợp lệ";
    }

    // sdt 
    $sdt_hop_le = '/((^0)(32|33|34|35|36|37|38|39|56|58|59|70|76|77|78|79|81|82|83|84|85|86|88|89|90|92|91|93|94|96|97|98|99)+([0-9]{7}))$/' ; 
   if (empty($sdt)) {
       $sdtErr = "Vui lòng nhập số điện thoại !";

   }
   if(!preg_match($sdt_hop_le , $sdt)){
       $sdtErr = "Số điện thoại không hợp lệ !";
   }

   if(empty($tieu_de)){
       $tieu_deErr = "Hãy nhập tiêu đề !" ; 
   }

   // noi dung 
   if(empty($noi_dung)){
       $noi_dungErr = "Hãy nhập nội dung !" ;
   }

   //email
    $email_hop_le = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ; 
    if (empty($email)) {
        $emailErr = "Vui lòng nhập email !";
    }
    if (!preg_match($email_hop_le , $email)) {
        $emailErr = "Định dạng email không hợp lệ !";
    }


    // in các lỗi za 
    if($ho_tenErr.$sdtErr.$tieu_deErr.$noi_dungErr.$emailErr){
        header("location:".BASE_URL."contact.php?ho_tenerr=$ho_tenErr&sdterr=$sdtErr&tieu_deerr=$tieu_deErr&noi_dungerr=$noi_dungErr&emailerr=$emailErr") ; 
        die() ; 
    }else{
       
        // Load Composer's autoloader
        // require 'vendor/autoload.php';
        
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();    
            $mail->CharSet = 'utf8' ;                                         // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'sendemailcuaviet@gmail.com';                     // SMTP username
            $mail->Password   = 'viet10072001';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('sendemailcuaviet@gmail.com','Send Email');
            $mail->addAddress('hoangviet10072001@gmail.com', 'Hoàng Quốc Bảo Việt');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo($email,$ho_ten);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $tieu_de;
            $mail->Body    = "Email : $email<br>
                              Nội dung : $noi_dung";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
            // bắt đầu insert vào bảng liên hệ 
            $sql = "INSERT INTO lien_he(ho_ten,sdt,tieu_de,noi_dung,trang_thai,email) 
                                 VALUES('$ho_ten','$sdt','$tieu_de','$noi_dung',0,'$email')" ;
                                 insert_update_delete($sql)  ; 
            
            header("location:".BASE_URL."contact.php?msg=Gửi email thành công ! ") ; 
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }


    
?>
