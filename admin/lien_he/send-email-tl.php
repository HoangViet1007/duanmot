<?php
     require_once "../../config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 

     require APP_PATH.'/lib/PHPMailer/src/Exception.php';
     require APP_PATH.'/lib/PHPMailer/src/SMTP.php'; 
     require APP_PATH.'/lib/PHPMailer/src/PHPMailer.php';
 
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;
 
    $id = $_POST['id'] ; 

     // lấy dữ liệu bên tl.php
    $email = $_POST['email'] ; 

    $tieu_de = $_POST['tieu_de'] ; 
 
    $noi_dung = $_POST['noi_dung'] ; 
    $noi_dungErr = "" ; 

 
    // noi dung 
    if(empty($noi_dung)){
        $noi_dungErr = "Hãy nhập nội dung !" ;
    }
 
     // in các lỗi za 
     if($noi_dungErr){
         header("location:".BASE_URL."tl.php?id=$id&noi_dungerr=$noi_dungErr") ; 
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
             $mail->addAddress($email , 'Khách hàng');     // Add a recipient
             // $mail->addAddress('ellen@example.com');               // Name is optional
             $mail->addReplyTo('sendemailcuaviet@gmail.com','Hoàng Quốc Bảo Việt');
             // $mail->addCC('cc@example.com');
             // $mail->addBCC('bcc@example.com');
         
             // Attachments
             // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
             // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
         
             // Content
             $mail->isHTML(true);                                  // Set email format to HTML
             $mail->Subject = $tieu_de;
             $mail->Body    = "Nội dung : $noi_dung";
             // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
         
             $mail->send();
             echo 'Message has been sent';
             // bắt đầu insert vào bảng liên hệ 
             $sql = "UPDATE lien_he set trang_thai = 1 where id = '$id'" ;
                                  insert_update_delete($sql)  ; 
             
             header("location:".BASE_URL."admin/lien_he/list.php?msg=Trả lời email khách hàng thành công !") ; 
         } catch (Exception $e) {
             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         }
 
     }
 
 


?>