<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS-->
    <?php require_once "../../link/link.php" ?>

    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../../vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../../public/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../../public/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!---------- js ------------------>

    <style>
    .header {
        width: 100%;
        height: 70px;
        background-color: #2D3035;
        display: flex;
    }

    .header-left {
        background-color: #2D3035;
    }

    .header-right li {
        margin: 0 20px;
        list-style: none;
    }

    .menu-right {
        display: flex;
        margin-left: 170px;
        margin-top: 15px;
    }

    .menu-right li a {
        text-decoration: none;
    }
    </style>
</head>

<body>

    <div class="all">
        <div class="header">
            <div class="header-left" style="width: 280.4px; border-right: 1px solid gray;">
                <img src="../../public/image/logo1.png" alt=""
                    style="z-index: 99;width: 200px; height: 60px;margin-left: 30px;">
            </div>
            <div class="header-right" style="display: flex;">
                <ul style="display: flex; margin-left: -30px; margin-top: 15px;">
                    <li style="margin-top: 5px;">
                        <a href="<?php echo BASE_URL ?>" style="color: gray; text-decoration: none;"><i
                                class="fa fa-home" aria-hidden="true"></i>&ensp; Trang chủ</a>
                    </li>
                    <li>
                        <form action="">
                            <input type="text" placeholder="   Bạn cần gi nào... ?"
                                style="border: 1px solid #BB414D; height: 38px; border-radius: 5px;  outline-color: none;">
                            <button class="btn btn-outline-danger" style="height: 40px; margin-top: -2px;">Tìm
                                kiếm</button>
                        </form>
                    </li>
                </ul>

                <ul class="menu-right">
                    <li style="margin-top: 5px;"><a href=""><i class="fa fa-envelope-o" aria-hidden="true"
                                style="color: gray;"></i></a></li>
                    <li style="margin-top: 5px;"><a href=""><i class="fa fa-facebook-official" aria-hidden="true"
                                style="color: gray;"></i></a></li>
                    <li style="margin-top: 5px;"><a href=""><i class="fa fa-twitter-square" aria-hidden="true"
                                style="color: gray;"></i></a></li>
                    <li><a href="<?php echo BASE_URL ?>tai_khoan/dang-xuat.php" class="btn btn-outline-danger"> Đăng
                            xuất</a></li>

                </ul>

            </div>
        </div>
    </div>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar">
                    <!-- <img src="../../public/image/me.jpg" alt="..." class="img-fluid"
                        style="width: 100px; height: 50px;border-radius: 50%;"> -->
                    <?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])): ?>
                    <img src="../../<?php echo $_SESSION['admin']['hinh'] ; ?>" alt=""
                        style="width: 50px;height: 50px;border-radius: 50%;">
                    <?php endif ?>
                </div>
                <div class="title">
                    <h3 class="h5" style="font-size: 14px;"> 
                        <?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])): ?>
                                <?php echo $_SESSION['admin']['ho_ten'] ; ?>
                        <?php endif ?> 
                    </h3>
                    <p><i class="fa fa-circle" aria-hidden="true" style="color: #33ff00;"></i>&ensp;Online</p>
                </div>
            </div>
            <ul class="list-unstyled">
                <li>
                    <a href="<?php echo BASE_URL ?>admin/dashbroad/dashbroad.php" aria-expanded="false">
                        <i style="font-size: 16px;" class="fa fa-tachometer" aria-hidden="true"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-hospital-o" aria-hidden="true" style="font-size: 20px;"></i>Website khách
                        sạn</a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/website/list.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Danh sách thông tin</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/website/them.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Thêm thông tin</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-bed" aria-hidden="true" style="font-size: 16px;"></i>Quản lí loại phòng
                    </a>
                    <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/loai_phong/list.php?product=1"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>List loại phòng</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/loai_phong/them.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Thêm loại phòng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-user" aria-hidden="true" style="font-size:23px;"></i>Quản lí user</a>
                    <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/users/list.php?product=1"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Danh sách user</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/users/them.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Thêm mới user</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-check-circle-o" aria-hidden="true"></i>Quản lí đặt phòng</a>
                    <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/dat_phong/list.php?product=1"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>List đặt phòng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#exampledropdownDropdown4" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 17px;"></i>Quản lí
                        đơn hàng </a>
                    <ul id="exampledropdownDropdown4" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/hoa_don/list.php?product=1"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>List đơn hàng</a></li>
                    </ul>
                </li>
       
                <!-- <li>
                    <a href="#exampledropdownDropdown6" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-picture-o" aria-hidden="true" style="font-size: 15px;"></i>Quản lí ảnh loại
                        phòng </a>
                    <ul id="exampledropdownDropdown6" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/anh_loai_phong/list.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Danh sách hình ảnh</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/anh_loai_phong/them.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Thêm hình ảnh</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="#exampledropdownDropdown7" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-commenting" aria-hidden="true" style="font-size: 16px;"></i>Quản lí bình
                        luận </a>
                    <ul id="exampledropdownDropdown7" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/binh_luan/list.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>List bình luận </a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="#exampledropdownDropdown99" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-compress" aria-hidden="true"></i>Quản lí liên hệ </a>
                    <ul id="exampledropdownDropdown99" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/lien_he/list.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Danh sách liên hệ</a></li>
                        <!-- <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li> -->
                    </ul>
                </li> -->
                <!-- <li>
                    <a href="#exampledropdownDropdown8" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-star-o" aria-hidden="true"></i>Quản lí đánh giá</a>
                    <ul id="exampledropdownDropdown8" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/danh_gia/list.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>List đánh giá</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="#exampledropdownDropdown9" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-sliders" aria-hidden="true"></i>Quản lí slider ảnh</a>
                    <ul id="exampledropdownDropdown9" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/slide_anh/list.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Danh sách hình ảnh</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/slide_anh/them.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Thêm hình ảnh</a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="#exampledropdownDropdown10" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-book" aria-hidden="true"></i>Quản lí bài viết</a>
                    <ul id="exampledropdownDropdown10" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/tin_tuc/list.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Danh sách bài viết</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/tin_tuc/them.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Thêm bài viết</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#exampledropdownDropdown11" aria-expanded="false" data-toggle="collapse"><i
                            class="fa fa-address-book-o" aria-hidden="true"></i>Quản lí vai trò</a>
                    <ul id="exampledropdownDropdown11" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/chuc_vu/list.php?product=1"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Danh sách vai trò</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/chuc_vu/them.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Thêm mới vai trò</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#exampledropdownDropdown12" aria-expanded="false" data-toggle="collapse"><i class="fa fa-picture-o" aria-hidden="true"></i>Thư viện ảnh</a>
                    <ul id="exampledropdownDropdown12" class="collapse list-unstyled ">
                        <li><a href="<?php echo BASE_URL ?>admin/thu_vien/list.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Danh sách thư viện</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/thu_vien/them.php"><i class="fa fa-genderless"
                                    aria-hidden="true"></i>Thêm mới ảnh</a></li>
                    </ul>
                </li> -->
        </nav>
        <!-- Sidebar Navigation end-->
        <div class="page-content" style="background-color: white;">
            <!-- <div class="page-header"
                style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Dashboard</h2>
                </div>
            </div>

            <div class="conten">
                hahaha
            </div> -->

            <!-- 
        </div>
    </div>
    </div>
</body>

</html> -->