<?php
     require_once "../config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 


     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;

     require APP_PATH.'/lib/PHPMailer/src/Exception.php';
     require APP_PATH.'/lib/PHPMailer/src/SMTP.php'; 
     require APP_PATH.'/lib/PHPMailer/src/PHPMailer.php';


 
       // laays is 
       $id = $_POST['id'] ; 
       $idErr = "" ; 

       $email = $_POST['email'] ; 
       $emailErr = "" ; 


       

   

       // validate
       $id_hop_le = '/^[a-zA-Z0-9_]{3,30}$/' ;
       if(strlen($id) == 0){
           $idErr = "Hãy nhập mã khách hàng " ; 
       }
       else if(strlen($id) < 3 || strlen($id) > 30){
           $idErr = "Mã khách hàng không hợp lệ !" ; 
       }
       else if(!preg_match($id_hop_le , $id)){
           $idErr = "Mã khách hàng không hợp lệ !" ; 
   
       }else{
           $idErr = "" ; 
       }
       
  
       // kiểm tra email
       $email_hop_le = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ; 
       if(empty($email)){
           $emailErr = "Hãy nhập email !" ;  
       }
       elseif(!preg_match($email_hop_le , $email)){
           $emailErr = "Email không hợp lệ !" ;  
       }else{
           $emailErr = "" ; 
       }

       // in looix 

       if($idErr.$emailErr){
           header("location:".BASE_URL."tai_khoan/forgot_password.php?iderr=$idErr&mat_khauerr=$mat_khauErr&emailerr=$emailErr") ; 
           die() ; 
       }

       $sql = "SELECT * from users where id = '$id' AND email = '$email'" ; 
       $tt = select_one($sql) ; 
       // xem có tồn tại ko 
       if(!$tt){
           header("location:".BASE_URL."tai_khoan/forgot_password.php?msg=User này không tồn tại !") ; 
           die() ;
       }else{
          
         // Load Composer's autoloader
         // require 'vendor/autoload.php';
         
         // Instantiation and passing `true` enables exceptions
         $mail = new PHPMailer(true);
                  
         try {
            //  Server settings
            //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
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
             $mkm = rand() ; 
             // Content
             $mail->isHTML(true);                                  // Set email format to HTML
             $mail->Subject = "Update mật khẩu";
             $mail->Body    = "Mật khẩu : $mkm";
             // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
         
             $mail->send();
             echo 'Message has been sent';
             // bắt đầu insert vào bảng liên hệ 
             $sql = "UPDATE users set mat_khau = '$mkm' where id = '$id'" ;
                                  insert_update_delete($sql)  ; 
             
             header("location:".BASE_URL."tai_khoan/forgot_password.php?msg=Vui lòng check email để nhận mật khẩu mới !") ; 
         } catch (Exception $e) {
             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         }
 
       }




     

        

     
?>