<?php
    /// hàm kết nối database 
    function connect(){
        $host = "localhost" ; 
        $dbname = "duanmot" ; 
        $dbusername = "root" ; 
        $dbpass = "" ; 
        return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbusername,$dbpass) ; 
    }

      // hàm lấy tất cả accs dữ liệu 
      function select_all($sql){
        $connect = connect();
        $stml = $connect->prepare($sql);
        $stml->execute();
        return $select_all = $stml->fetchAll();
    }

    // hàm lấy 1 dữ liệu 
    function select_one($sql){
        $connect = connect() ; 
        $stmt = $connect->prepare($sql) ; 
        $stmt->execute() ; 
        return $select_one = $stmt->fetch() ; 
    }

    // hàm thêm sửa xóa dữ liệu 
    function insert_update_delete($sql){
        $connect = connect() ; 
        $stmt = $connect->prepare($sql) ; 
        $stmt->execute() ; 
    }

    // hàm formart thời gian

    function datetimeConvert($datetimedata,$formatString="d/m/Y"){
        $date = new DateTime($datetimedata) ; 
        return $date->format($formatString) ; 
    }


    function validateDate($date, $format = 'Y-m-d H:i:s'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
    }


?>