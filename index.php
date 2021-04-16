<?php
    require_once "config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    // lấy loại phòng 
    $sql = "select * from loai_phong where ten_loai = 'Deluxe Room'" ;
    $de = select_one($sql) ;
    
    
    $sql = "select * from loai_phong where ten_loai != 'Deluxe Room' LIMIT 4" ; 
    $all_lp = select_all($sql) ; 


    $sql = "SELECT * FROM tin_tuc ORDER BY id LIMIT 3" ; 
    $tt = select_all($sql) ; 


    // lấy thư viện ảnh 
    $sql = "SELECT * FROM hinh_anh_khach_san" ; 
    $ha = select_all($sql) ; 

    // in ddanhs gias 
    $sql = "SELECT
                    b.so_sao,
                    b.noi_dung,
                    b.ngay_danh_gia,
                    b.ma_loai_phong,
                    n.ho_ten,
                    n.hinh
                FROM
                    danh_gia AS b
                JOIN users AS n
                ON
                    b.ma_nguoi_danh_gia = n.id
                    ORDER BY RAND() LIMIT 3" ; 
                    $dg = select_all($sql) ; 
?>
<?php require_once "./header.php" ?>
<!--------------- end header----------------->
<!--------------- end search-header----------------->

<div class="container-fluid" style="margin-top: 70px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 style="text-transform: uppercase; font-weight: bold; margin-bottom: 10px; ">HOTEL ZANTE SINCE 1992
                </h2>
                <p style="color: gray;">High quality accommodation services</p>
                <p style="color: gray; ">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                    euismod tincidunt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                    ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure
                    dolor in hendrerit in vulputate velit molestie consequat, vel illum dolore eu feugiat nulla
                    facilisis at vero eros et accumsan.</p>
                <p>
                    <a href="#" id="btn-lxkze" class="btn" target="_self">
                        <span>More Details <i class="fa fa-chevron-right" style="margin-left: 5px;"></i></span>
                    </a>
                </p>
            </div>
            <div class="col-md-6">
                <!-- <img src="./public/image/banner3.jpg" alt="" width="100%"> -->
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="./public/image/banner3.jpg" alt="First slide" width="100%"
                                height="370px">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./public/image/FLC-Luxury-Sam-Son-Resort.jpg"
                                alt="Second slide" width="100%" height="370px">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!------------------------- end thong tin khach san------------------------------->
</div>

<div class="container-fluid" style="background-color: #F1F0ED;height: 720px; margin-top: 50px;margin-bottom: 50px;">
    <div class="container">
        <div class="text-center" style="width: 100%;">
            <h2 style="text-transform: uppercase; font-weight: bold; margin-bottom: 10px;padding-top: 25px;">OUR
                FAVORITE ROOMS</h2>
            <p style="color: gray;">Check out now our best rooms</p>
        </div>

        <div class="sp" style="padding-bottom: 55px;">
            <div class="row" style="margin-top: 55px;">
                <div class="col-md-6">
                    <a href="">
                        <div class="all-sp-left">
                            <div class="image-left">
                                <a class="eee"
                                    href="<?php echo BASE_URL ?>chi_tiet_room.php?id=<?php echo $de['id'] ?>"><img
                                        src="<?php echo BASE_URL. $de['hinh'] ?>" class="img-fluid" alt=""></a>
                            </div>
                            <div class="price">
                                <p>$ <span><?php echo $de['don_gia'] ?></span> /night</p>
                            </div>

                            <div class="left-detail">
                                <div class="txt">
                                    <h4 style="padding-top: 8px;"><?php echo $de['ten_loai'] ?></h4>
                                    <p>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-wifi" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-bath" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-coffee" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-tablet" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-desktop" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-cutlery" aria-hidden="true"></i></a></li>
                                    </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <?php foreach ($all_lp as $key) { ?>
                        <div class="col-md-6">
                            <a href="#">
                                <div class="all-sp-right">
                                    <div class="image-right">
                                        <a class="eee"
                                            href="<?php echo BASE_URL ?>chi_tiet_room.php?id=<?php echo $key['id'] ?>"><img
                                                src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" alt=""></a>
                                    </div>
                                    <div class="price">
                                        <p>$ <span><?php echo $key['don_gia'] ?></span> /night</p>
                                    </div>
                                    <div class="right-detail">
                                        <div class="txt-right">
                                            <h5 style="padding-top: 8px;"><?php echo $key['ten_loai'] ?></h5>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-wifi" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-bath" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-coffee" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-tablet" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                        <?php } ?>

                        <!---------- end row------------->
                    </div>
                </div>
            </div>
        </div>
        <div class="row view d-flex justify-content-center align-items-center" style="margin-top: -45px;">
            <a href="" id="btn-lxkze" class="btn" target="_self">
                <span>View All Room <i class="fa fa-chevron-right" style="margin-left: 5px;"></i></span>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid" style="height: 700px;">
    <style>
    .blog {
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-gap: 50px;
    }

    .box-blog {
        box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        padding-bottom: 30px;
    }

    .box-blog-detail {
        padding: 20px 20px 30px 20px;
    }

    .box-blog-detail-tt a {
        text-decoration: none;
        font-size: 25px;
        color: black;
        font-weight: bold;
    }

    .box-blog-detail-tt a:hover {
        text-decoration: none;
        color: #CCA772;
    }

    .box-blog-detail-nt {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;
        padding-left: 25px;
    }

    .box-blog-detail-nt p {
        font-size: 13px;
        opacity: 0.7;
    }

    .box-blog-detail-nt-day {
        display: grid;
        grid-template-columns: 10px 1fr;
        grid-gap: 15px;
    }

    .box-blog-detail-nt-cmt {
        display: grid;
        grid-template-columns: 10px 1fr;
        grid-gap: 15px;
    }

    .aaa {
        padding-top: 3px;
    }

    .read-more a {
        text-decoration: none;
        color: black;
        font-weight: bold;
        padding-left: 30px;
        transition: .6s;
    }

    .read-more a:hover {
        text-decoration: none;
        color: #CCA772;
        transform: scale(1.1);
        transition: .6s;
    }

    .box-blog-img img {
        transition: all 0.5s;
    }

    .box-blog-img img:hover {
        transform: scale(1.08);
        transition: 0.5s;

    }

    .box-blog-img {
        overflow: hidden;

    }

    .box-blog-img>img {
        transition: 0.5s;
    }

    .box-blog:hover {
        box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);
    }
    </style>
    <div class="text-center" style="width: 100%;">
        <h2 style="text-transform: uppercase; font-weight: bold; margin-bottom: 10px;padding-top: 25px;">LATEST NEWS &
            EVENTS & BLOG
        </h2>
        <p style="color: gray;">Check out our latest news & events</p>
    </div>
    <div class="container">
        <div class="blog mt-5">
            <?php foreach ($tt as $key) {
                    $id = "" ; 
                    $id = $key['id'] ;  
                    $sql = "SELECT ma_tin_tuc FROM binh_luan WHERE ma_tin_tuc= $id" ; 
                    $sbl  = select_all($sql) ; 
                    $count = count($sbl); 
                ?>
            <div class="box-blog">
                <div class="box-blog-img">
                    <a href="<?php echo BASE_URL ?>blogDetail.php?id=<?php echo $key['id'] ?>"><img
                            src="<?php echo BASE_URL.$key['hinh'] ?>" width="350px" height="270px"
                            style="border-radius: 5px;" alt=""></a>
                </div>
                <div class="box-blog-detail">
                    <div class="box-blog-detail-tt">
                        <a href="<?php echo BASE_URL ?>blogDetail.php?id=<?php echo $key['id'] ?>">
                            <h3 style="font-size: 20px; font-weight: bold; color: gray;"><?php echo $key['tieu_de'] ?>
                            </h3>
                        </a>
                    </div>
                    <div class="box-blog-detail-nt mt-3">
                        <div class="box-blog-detail-nt-day">
                            <div><i class="fa fa-calendar" aria-hidden="true"></i> </div>
                            <div class="aaa">
                                <p> 20th Nov, 2018</p>
                            </div>
                        </div>
                        <div class="box-blog-detail-nt-cmt">
                            <div><i class="fa fa-commenting-o" aria-hidden="true"></i></div>
                            <div class="aaa">
                                <p><span><?php echo $count ?></span> Comment</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p style="text-align: justify; color: gray;">Lorem ipsum dolor sit amet, consectetuer adipiscing
                            elit, sed
                            diam nonummy nibh euismod tincidunt ut .
                    </div>

                </div>
                <div class="read-more" style="margin-top: -30px;">
                    <a href="<?php echo BASE_URL ?>blogDetail.php?id=<?php echo $key['id'] ?>" style="color: gray;">READ
                        MORE <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <?php  
                    }
            ?>


        </div>
    </div>

    <!-- -------------------------------------- end blog -------------------------------------------- -->
</div>

<div class="container-fluid" style="background-color: #F1F0ED; height: 470px;">
    <style>
    .image-gallery {

        overflow: hidden;
    }

    .image-gallery img {
        transition: all 0.5s;
    }

    .all-image-gallery:hover img {
        transform: scale(1.07);
        transition: all 0.5s;
        opacity: 0.8;
    }
    </style>
    <div class="text-center" style="width: 100%;">
        <h2 style="text-transform: uppercase; font-weight: bold; margin-bottom: 10px;padding-top: 25px;">ZANTE GALLERY
        </h2>
        <p style="color: gray;">Hotel Zante image gallery</p>
    </div>
    <div class="container-fluid" style="margin-top: 50px;">
        <div class="row owl-carousel owl-theme ">
            <?php foreach ($ha as $key) { ?>
            <div class="all-image-gallery item" style="height: 250px; border: 1px solid #dedede;">
                <div class="image-gallery" style="height: 210px;">
                    <a href=""> <img src="<?php echo BASE_URL. $key['hinh'] ?>" alt="" width="100%" height="100%"></a>
                </div>
                <div class="image-gallery-detail"
                    style="height: 40px; background-color: white; text-align: center; width: 100%;">
                    <p style="color: gray; padding-top: 7px; font-weight: bold;"><?php echo $key['ten'] ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- ---------------- end hình ảnh web --------------- -->
</div>

<div class="container-fluid" style="padding-bottom: 50px;">
    <style>
    .all-item:hover .all-item-conten {
        transition: all 0.5s;
        top: -10px;
    }
    </style>
    <div class="container">
        <div class="text-center" style="width: 100%;">
            <h2 style="text-transform: uppercase; font-weight: bold; margin-bottom: 10px;padding-top: 25px;">OUR GUESTS
                LOVE US</h2>
            <p style="color: gray;">What our guests are saying about us</p>
        </div>

        <div class="all-danh-gia" style="margin-top: 50px; padding-bottom: 50px; height: 350px;">
            <div class="row">
                <?php foreach ($dg as $key) { ?>
                <div class="col-md-4">
                    <div class="all-item" style="text-align: center;">
                        <div class="all-item-conten"
                            style="height: 250px; position: relative ;border: 1px solid #dedede; padding: 20px; border-radius: 7px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);transition: all 0.5s;">
                            <h3 style="color: gray;">Nice Place</h3>
                            <div class="star-danh-gia">
                                <!-- <i class="fa fa-star" aria-hidden="true" style="color: #CCA772;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color: #CCA772;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color: #CCA772;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color: #CCA772;"></i>
                                <i class="fa fa-star-o" aria-hidden="true" style="color: #CCA772;"></i> -->
                                <?php
                                if ($key['so_sao'] == "4") {
                                            echo "
                                                <div class='star-danh-gia'>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                                </div>
                                            ";
                                } else if($key['so_sao'] == "5"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($key['so_sao'] == "3"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($key['so_sao'] == "2"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($key['so_sao'] == "1"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else{
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    " ; 
                                }
                            ?>
                            </div>
                            <p>
                                <?php echo $key['noi_dung'] ?>
                            </p>
                        </div>
                        <div class="all-item-detail"
                            style="padding: 20px; display: flex; justify-content: center; align-items: center;">
                            <img src="<?php echo BASE_URL.$key['hinh'] ?>" alt="" style="border-radius: 50%;" width="70px" height="70px">
                            <div class="info" style="margin-left: 15px; color: gray;">
                                <a href="" style="text-decoration: none; color: gray;">
                                    <h5>
                                       <?php echo $key['ho_ten'] ?>
                                    </h5>
                                    <span>Day : <?php echo $key['ngay_danh_gia'] ?>, Việt Nam</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>






<?php require_once "./footer.php" ?>
<!--------------- end footer----------------->