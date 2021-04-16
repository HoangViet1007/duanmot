<?php
    require_once "config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    // lấy za thông tin website 
    $sql = "SELECT * FROM thong_tin_website" ; 
    $kh = select_one($sql) ; 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="././public/css/index.css"> -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/main.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/search-header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/blog.css">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap" rel="stylesheet">
    <?php require_once APP_PATH."/link/link.php" ?>
    <link rel="stylesheet" href="./lib/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="./lib/owlcarousel/assets/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="./lib/owlcarousel/owl.carousel.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 6
                }
            }
        })
    });
    </script>

</head>

<body>
    <div class="container-fluid header-top">
        <div class="row" style="border-bottom: 1px solid #F0F0F0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo BASE_URL.$kh['logo'] ?>" alt="" class="header-img-logo">
                    </div>

                    <div class="col-md-3">
                        <a href="" style="text-decoration: none;">
                            <p
                                style="font-family: 'Satisfy', cursive;font-size: 55px; margin-top: 30px;margin-left: -100px;z-index: 3;color: black;">
                                <?php echo $kh['ten_web'] ?></p>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <div class="phone">
                            <div class="phone-top">
                                <i class="fa fa-phone-square" aria-hidden="true"
                                    style="color: #CCA772; margin-right: 10px; font-size: 20px;"></i>
                                <span style="color: gray;">Have any question?</span>
                            </div>
                            <div class="phone-bottom">
                                <span class="stt" style="color: black;">Free: <b><?php echo $kh['sdt'] ?></b></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="email">
                            <div class="email-top">
                                <i class="fa fa-envelope-o" aria-hidden="true"
                                    style="color: #CCA772; margin-right: 10px; font-size: 20px;"></i>
                                <span style="color: gray;">Have any question?</span>
                            </div>
                            <div class="email-bottom">
                                <span class="stt1" style="color: black;">Free: <b><?php echo $kh['email'] ?></b></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid" style="border-bottom: 1px solid #F0F0F0;" id="scrolls">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="nav main-menu" style="margin-left: 10px;">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL ?>">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL ?>list-type-room.php">ROOM</a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="" class="nav-link">Room1</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="" class="nav-link">Room1</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">GALLERY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL ?>blog.php?product=1">BLOG</a>
                                <ul class="sub-menu">

                                    <li class="nav-item">
                                        <a href="<?php echo BASE_URL ?>blogDetail.php" class="nav-link">BLOG DETAIL</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL ?>contact.php">CONTACT</a>
                            </li>
                        </ul>


                    </div>
                    <div class="col-md-4">
                        <ul class="main-menu nav1" style="float:right; margin-right: -30px;">
                            <!-- <li class="nav-item" style="padding-top: 10px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>tai_khoan/login.php" style="color: gray; border: 2px solid #CCA772;">LOGIN</a>
                            </li>
                            <li class="nav-item" style="padding-top: 10px;">
                                <a class="nav-link a" href="#" style="color: gray;border: 2px solid #CCA772;">SIGN
                                    UP</a>
                            </li> -->
                            <?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) { ?>
                            <li>
                                <!-- -------------------------------------------------------------- -->
                                <button type="button"
                                    style="width: 25px; background-color: #CCA772; color: white; border: none; margin-top: 27px;position: absolute; margin-left: 15px;z-index: 999;"
                                    data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </button>

                                <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="width: 600px;">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Thông tin cá nhân</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row" style="font-size: 14px;">
                                                        <div class="col-md-6">
                                                            <img src="<?php echo BASE_URL.'/'. $_SESSION['admin']['hinh'] ; ?>"
                                                                alt="" width="200px" height="200px">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="model-info"
                                                                style="font-weight: bold; margin-left: -20px;">
                                                                <p">ID :
                                                                    <span><?php echo $_SESSION['admin']['id'] ; ?></span>
                                                                    </p>
                                                                    <p>Họ và tên :
                                                                        <span><?php echo $_SESSION['admin']['ho_ten'] ; ?></span>
                                                                    </p>
                                                                    <p>Số điện thoại :
                                                                        <span><?php echo $_SESSION['admin']['sdt'] ; ?></span>
                                                                    </p>
                                                                    <p>Email :
                                                                        <span><?php echo $_SESSION['admin']['email'] ; ?></span>
                                                                    </p>
                                                                    <p>SCM :
                                                                        <span><?php echo $_SESSION['admin']['so_chung_minh'] ; ?></span>
                                                                    </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ----------------------------------------------------------------------  -->
                            </li>
                            <li class="nav-item" style="padding-top: 15px;">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        style="color: gray; text-decoration: none;">
                                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                        <img src="<?php echo BASE_URL.'/'. $_SESSION['admin']['hinh'] ; ?>" alt=""
                                            class="image-me mb-2" width="40px" height="40px"
                                            style="border-radius: 0%; margin-top: 5px;border: 2px solid #CCA772;">
                                        <!-- <span style="font-size: 14px;"><?php echo $_SESSION['admin']['ho_ten'] ?></span> -->
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                        style="overflow: hidden;">
                                        <a class="dropdown-item"
                                            href="<?php echo BASE_URL ?>tai_khoan/edit-password.php"
                                            style="color: gray;">Đổi mật khẩu</a>
                                        <a class="dropdown-item" href="<?php echo BASE_URL ?>tai_khoan/update.php"
                                            style="color: gray;">Cập nhật tài khoản</a>
                                        <a class="dropdown-item"
                                            href="<?php echo BASE_URL ?>tai_khoan/forgot_password.php"
                                            style="color: gray;">Quên mật khẩu</a>

                                    </div>
                                </div>
                            </li>
                            <li class="nav-item" style="padding-top: 15px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>tai_khoan/dang-xuat.php"
                                    style="color: gray;border: 2px solid #CCA772;">LOGOUT</a>
                            </li>
                            <li class="nav-item" style="padding-top: 15px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>admin/dashbroad/dashbroad.php"
                                    style="color: gray;border: 2px solid #CCA772;">ADMIN</a>
                            </li>

                            <li class="nav-item" style="padding-top: 15px; width: 150px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>list-type-room.php"
                                    style="color: gray;border: 2px solid #CCA772;"><i class="fa fa-calendar"
                                        aria-hidden="true"></i>&ensp;BOOKING</a>
                            </li>

                            <?php } elseif(isset($_SESSION['khach_hang']) && !empty($_SESSION['khach_hang'])) { ?>
                            <li>
                                <!-- -------------------------------------------------------------- -->
                                <button type="button"
                                    style="width: 25px; background-color: #CCA772; color: white; border: none; margin-top: 27px;position: absolute; margin-left: 15px;z-index: 999;"
                                    data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </button>

                                <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="width: 600px;">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Thông tin cá nhân</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row" style="font-size: 14px;">
                                                        <div class="col-md-6">
                                                            <img src="<?php echo BASE_URL.'/'. $_SESSION['khach_hang']['hinh'] ; ?>"
                                                                alt="" width="200px" height="200px">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="model-info"
                                                                style="font-weight: bold;margin-left: -20px;">
                                                                <p">ID :
                                                                    <span><?php echo $_SESSION['khach_hang']['id'] ; ?></span>
                                                                    </p>
                                                                    <p>Họ và tên :
                                                                        <span><?php echo $_SESSION['khach_hang']['ho_ten'] ; ?></span>
                                                                    </p>
                                                                    <p>Số điện thoại :
                                                                        <span><?php echo $_SESSION['khach_hang']['sdt'] ; ?></span>
                                                                    </p>
                                                                    <p>Email :
                                                                        <span><?php echo $_SESSION['khach_hang']['email'] ; ?></span>
                                                                    </p>
                                                                    <p>SCM :
                                                                        <span><?php echo $_SESSION['khach_hang']['so_chung_minh'] ; ?></span>
                                                                    </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ----------------------------------------------------------------------  -->
                            </li>
                            <li class="nav-item" style="padding-top: 15px;">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        style="color: gray; text-decoration: none;">
                                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                        <img src="<?php echo BASE_URL.'/'. $_SESSION['khach_hang']['hinh'] ; ?>" alt=""
                                            class="image-me mb-2" width="40px" height="40px"
                                            style="border-radius: 0%; margin-top: 5px;border: 2px solid #CCA772;">
                                        <!-- <span style="font-size: 14px;"><?php echo $_SESSION['khach_hang']['ho_ten'] ?></span> -->
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                        style="overflow: hidden;">
                                       
                                        <a class="dropdown-item"
                                            href="<?php echo BASE_URL ?>tai_khoan/edit-password.php"
                                            style="color: gray;">Đổi mật khẩu</a>
                                        <a class="dropdown-item" href="<?php echo BASE_URL ?>tai_khoan/update.php"
                                            style="color: gray;">Cập nhật tài khoản</a>
                                        <a class="dropdown-item"
                                            href="<?php echo BASE_URL ?>tai_khoan/forgot_password.php"
                                            style="color: gray;">Quên mật khẩu</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item" style="padding-top: 15px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>tai_khoan/dang-xuat.php"
                                    style="color: gray;border: 2px solid #CCA772;">LOGOUT</a>
                            </li>

                            <li class="nav-item" style="padding-top: 15px; width: 150px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>list-type-room.php"
                                    style="color: gray;border: 2px solid #CCA772;"><i class="fa fa-calendar"
                                        aria-hidden="true"></i>&ensp;BOOKING</a>
                            </li>
                            <?php } else{ ?>
                            <li class="nav-item" style="padding-top: 10px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>tai_khoan/login.php"
                                    style="color: gray; border: 2px solid #CCA772;">LOGIN</a>
                            </li>
                            <li class="nav-item" style="padding-top: 10px; width: 120px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>tai_khoan/them.php"
                                    style="color: gray;border: 2px solid #CCA772;">SIGN
                                    UP</a>
                            </li>

                            <li class="nav-item" style="padding-top: 10px; width: 150px;">
                                <a class="nav-link a" href="<?php echo BASE_URL ?>list-type-room.php"
                                    style="color: gray;border: 2px solid #CCA772;"><i class="fa fa-calendar"
                                        aria-hidden="true"></i>&ensp;BOOKING</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row main-banner">
                <div class="col-md-12">
                    <img src="<?php echo BASE_URL; ?>/public/image/banner-small.jpg" alt=""
                        style="margin-top: 10px; width: 100%; height: 300px; ">
                </div>
            </div>
        </div>
    </div>