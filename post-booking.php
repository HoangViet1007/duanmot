<?php 
    require_once "config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;

    require './lib/PHPMailer/src/Exception.php';
    require './lib/PHPMailer/src/SMTP.php'; 
    require './lib/PHPMailer/src/PHPMailer.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    // lấy id trên đường đãn xuống 
    $id = isset($_GET['id']) ? $_GET['id'] : "" ;
    $sql = "SELECT * from loai_phong where id = '$id'" ; 
    $tt = select_one($sql) ;  
    $tt_ten_loai = $tt['ten_loai'] ; 
    $tt_don_gia = $tt['don_gia'] ; 
    // echo $tt_ten_loai."-----".$tt_don_gia ; 

    // lấy dữ liệu bên from 
    $ten_nguoi_dat = $_POST['ten_nguoi_dat'] ; 
    $ten_nguoi_datErr = "" ; 


    $email = $_POST['email'] ; 
    $emailErr = "" ; 

    $sdt = $_POST['sdt'] ; 
    $sdtErr = "" ;
    
    $ngay_tao = date("Y/m/d");

    $ngay_den = $_POST['ngay_den'] ; 
    $ngay_denErr = "" ; 

    $ngay_di = $_POST['ngay_di'] ; 
    $ngay_diErr = "" ; 

    $ma_loai_phong = $_POST['ma_loai_phong'] ; 
    $ma_loai_phongErr = "" ; 

    // echo $ten_nguoi_dat.$email.$sdt.$ngay_den.$ngay_di ;
    // validate 
    if (empty($_POST['ten_nguoi_dat'])) {
        $ten_nguoi_datErr = "Hãy nhập họ và tên !";
    } 
    if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $_POST['ten_nguoi_dat'])) {
        $ten_nguoi_datErr = "Họ và tên không hợp lệ";
    }

    //email
    $email_hop_le = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ; 
    if (empty($email)) {
        $emailErr = "Hãy nhập email !";
    }
    if (!preg_match($email_hop_le , $email)) {
        $emailErr = "Định dạng email không hợp lệ !";
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

    // ngày đến 
    if(empty($_POST['ngay_den'])){
        $ngay_denErr = "Hãy nhập ngày đến !" ; 
    }
    // ngày đi 
    if(empty($_POST['ngay_di'])){
        $ngay_diErr = "Hãy nhập ngày đi !" ; 
    }

    // // nhập ngày đến và đi phải hợp lệ 
    // if (!validateDate($ngay_den,'d/m/Y')) {
    //     $ngay_denErr = "Vui lòng nhập ngày tháng năm đúng định dạng dd/mm/YYYY (VD : 08/09/2001)";
    // }else{
    //     $arr=explode("/",$ngay_den); // cái này đang là mảng các chuỗi 
    //     $mm=$arr[0]; // first element of the array is month
    //     $dd=$arr[1]; // second element is date
    //     $yy=$arr[2]; // third element is year
    //     if(!checkdate($mm,$dd,$yy)){
    //         $ngay_denErr = "Vui lòng nhập ngày tháng năm chính xác !";
    //     }else {
    //        $tmp = array_reverse($arr) ; 
    //        // ghép các mảng thành chuỗi 
    //        $ngay_den = implode("-",$tmp) ; 
    //     }
    // }

    //   // nhập ngày đến và đi phải hợp lệ 
    //   if (!validateDate($ngay_di,'d/m/Y')) {
    //     $ngay_diErr = "Vui lòng nhập ngày tháng năm đúng định dạng dd/mm/YYYY (VD : 08/09/2001)";
    // }else{
    //     $arr=explode("/",$ngay_di); // cái này đang là mảng các chuỗi 
    //     $mm=$arr[0]; // first element of the array is month
    //     $dd=$arr[1]; // second element is date
    //     $yy=$arr[2]; // third element is year
    //     if(!checkdate($mm,$dd,$yy)){
    //         $ngay_diErr = "Vui lòng nhập ngày tháng năm chính xác !";
    //     }else {
    //        $tmp = array_reverse($arr) ; 
    //        // ghép các mảng thành chuỗi 
    //        $ngay_di = implode("-",$tmp) ; 
    //     }
    // }

    // ngày đến và ngày đi phải sao nagyf hiện tại 
    if(strtotime($ngay_tao) - strtotime($ngay_den) > 0 ){
        $ngay_denErr = "Ngày đến không hợp lệ !" ; 
    }
    if(strtotime($ngay_tao) - strtotime($ngay_di) > 0 ){
        $ngay_diErr = "Ngày đi không hợp lệ !" ; 
    }
    // ngày đến ko được lớn hơn ngày đi 

    if(strtotime($ngay_den)-strtotime($ngay_di) >= 0 ){
        $ngay_denErr = "Ngày đến không hợp lệ !" ; 
    }
    if(strtotime($ngay_di) - strtotime($ngay_den) <= 0){
        $ngay_diErr = "Ngày đi không hợp lệ !" ; 
    }

    if($ten_nguoi_datErr.$emailErr.$sdtErr.$ngay_denErr.$ngay_diErr){
        header("location:".BASE_URL."booking.php?id=$id&ten_nguoi_daterr=$ten_nguoi_datErr&emailerr=$emailErr&sdterr=$sdtErr&ngay_dierr=$ngay_diErr&ngay_denerr=$ngay_denErr") ;
        die() ;  
    }else{

        // kiểm tra xem loại phòng đó còn phòng hay ko , nếu ko còn thì header về và đưa za thông báo 
        $sql = "SELECT so_phong_trong from loai_phong where id = '$id'" ; 
        $so_phong_trong = select_one($sql) ; 
        if($so_phong_trong['so_phong_trong'] > 0){
            // bắt dầu update loại p thông qua id 
            $view = 1 ; 
            $sql = "SELECT * FROM loai_phong where id = '$id'" ; 
            $lp = select_one($sql) ; 
            $so_phong_da_dat_new = $lp['so_phong_da_dat'] += $view ; 
            $so_phong_trong_new = $lp['so_phong_trong'] -= $view ; 
            $sql = "UPDATE loai_phong set so_phong_da_dat = '$so_phong_da_dat_new',
                                            so_phong_trong = '$so_phong_trong_new' where id = '$id'" ;
            insert_update_delete($sql) ;

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
          
                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = "ĐƠN HÀNG ĐẶT PHÒNG Ở KHÁCH SẠN MARVELLA";
                    $mail->Body    = "
                    <h3>THÔNG TIN ĐƠN HÀNG</h3>
                        <table class='table'>
                            <thead style='background-color: #cca772; color: white;'>
                                <th>TÊN</th>
                                <th>SĐT</th>
                                <th>CHECK-IN</th>
                                <th>CHECK-OUT</th>
                                <th>LOẠI PHÒNG</th>
                                <th>GIÁ</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>$ten_nguoi_dat</td>
                                    <td>$sdt</td>
                                    <td>$ngay_den</td>
                                    <td>$ngay_di</td>
                                    <td>$tt_ten_loai</td>
                                    <td>$tt_don_gia $</td>
                                </tr>
                            </tbody>
                        </table>
                    ";
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                        $mail->send();
                        echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
    

            // bắt đầu insert  vào bảng đặt p 
            $sql = "INSERT INTO dat_phong (ten_nguoi_dat,sdt,email,ngay_tao,ngay_den,ngay_di,trang_thai,ma_loai_phong) 
                                    VALUES ('$ten_nguoi_dat','$sdt','$email','$ngay_tao','$ngay_den','$ngay_di',0,'$id')" ;
                                    insert_update_delete($sql) ; 

                $sql = "SELECT * FROM dat_phong ORDER BY id DESC LIMIT 1"  ; 
                $lay = select_one($sql) ;  
                $id_dat_phong = $lay['id'];          
            header("location:".BASE_URL."order.php?ma_loai_phong=$id&id=$id_dat_phong") ; 

        }

        // else{
        //     // nếu ngày đến hoặc đi  người dùng nhập vào nằm trong khoảng ngày đến và ngày đi đã đặt thì ko cho đặt p 
            
        //     // WHERE
        //     //     id = 7 AND(
        //     //         '2020-12-09' BETWEEN ngay_den AND ngay_di OR '2020-12-09' BETWEEN ngay_den AND ngay_di
        //     //     )

        //   /*  
        //      Bước 1 : lấy ngày đến và ngày đi của người dùng nhập vào 
        //      Bước 2 : Check xem ngay đến hoặc ngày đi của khách hàng có nằm trong khoảng các ngày đã đặt không nếu + có thì ko cho booking
        //                                                                                                            + ko thì có cho booking
        //     SELECT * FROM `dat_phong` WHERE id = 7 AND '2020-12-10' BETWEEN ngay_den AND ngay_di OR '2020-12-13' BETWEEN ngay_den AND ngay_di
        //   */
        $sql = "SELECT * FROM `dat_phong` WHERE id = $id AND '$ngay_den' BETWEEN ngay_den AND ngay_di OR '$ngay_di' BETWEEN ngay_den AND ngay_di" ; 
        $tt = select_all($sql) ; 
        if ((!($tt)) && ($so_phong_trong['so_phong_trong'] <= 0)) {
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
          
                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = "ĐƠN HÀNG ĐẶT PHÒNG Ở KHÁCH SẠN MARVELLA";
                    $mail->Body    = "
                    <h3>THÔNG TIN ĐƠN HÀNG</h3>
                        <table class='table table-bordered'>
                            <thead style='background-color: #cca772; color: white;'>
                                <th>TÊN</th>
                                <th>SĐT</th>
                                <th>CHECK-IN</th>
                                <th>CHECK-OUT</th>
                                <th>LOẠI PHÒNG</th>
                                <th>GIÁ</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>$ten_nguoi_dat</td>
                                    <td>$sdt</td>
                                    <td>$ngay_den</td>
                                    <td>$ngay_di</td>
                                    <td>$tt_ten_loai</td>
                                    <td>$tt_don_gia $</td>
                                </tr>
                            </tbody>
                        </table>
                    ";
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                        $mail->send();
                        echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
    

            // bắt đầu insert  vào bảng đặt p 
            $sql = "INSERT INTO dat_phong (ten_nguoi_dat,sdt,email,ngay_tao,ngay_den,ngay_di,trang_thai,ma_loai_phong) 
                                    VALUES ('$ten_nguoi_dat','$sdt','$email','$ngay_tao','$ngay_den','$ngay_di',0,'$id')" ;
                                    insert_update_delete($sql) ; 

                $sql = "SELECT * FROM dat_phong ORDER BY id DESC LIMIT 1"  ; 
                $lay = select_one($sql) ;  
                $id_dat_phong = $lay['id'];          
            header("location:".BASE_URL."order.php?ma_loai_phong=$id&id=$id_dat_phong") ;
            die() ;     
        }
        if(($tt) && ($so_phong_trong['so_phong_trong'] <= 0)){
            header("location:".BASE_URL."list-type-room.php?msg=Hiện tại vào ngày quý khách đặt chúng tôi đã hết phòng , vui lòng chọn ngày khác hoặc chọn loại phòng khác !") ; 
            die() ; 
        }

        if($so_phong_trong['so_phong_trong'] <= 0){
            header("location:".BASE_URL."list-type-room.php?msg=Hiện tại khách sạn chúng tôi đã hết phòng loại phòng này , xin quý khách chuyển sang loại phòng khác !") ; 
            echo '<script language="javascript">';
            echo 'alert(Hiện tại khách sạn chúng tôi đã hết phòng loại phòng này , xin quý khách chuyển sang loại phòng khác !)';  //not showing an alert box.
            echo '</script>';
            die() ; 
        }
    }
    

?>