<?php 
    require_once 'config.php';
    require_once APP_PATH."/dao/pdo.php" ; 

    //  lấy id trên đường dẫn xuống vaà tăng luoẹt xem của sản phẩm lên 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM loai_phong where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $lp = select_one($sql) ;
        } else {
            try {
                header('location:'.BASE_URL."index.php?msg=Sản phẩm này không tồn tại !");
                die() ; 
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location:'.BASE_URL."index.php");
    }


    // laays za hinh anh laoi p 
    $sql = "SELECT * FROM hinh_anh_loai_phong where ma_loai_phong = '$id'" ; 
    $ha = select_all($sql) ;
    
    // lay za p lien quan 
    $sql = "SELECT * FROM loai_phong where id != '$id' ORDER BY RAND() LIMIT 3" ; 
    $lplq = select_all($sql) ; 


        // in đánh giá
        $sqlinbl = "SELECT * FROM danh_gia where ma_loai_phong = '$id'" ; 
        $bls = select_all($sqlinbl) ; 

        $sql = "SELECT AVG(so_sao) as avg FROM danh_gia WHERE ma_loai_phong = $id" ;
        $avg = select_all($sql) ;  


    require_once "./header-small.php"  ; 


?>
<!--------------- end header----------------->
<style>
.all-content {
    margin-top: 40px;
    display: grid;
    grid-template-columns: 780px 1fr;
    grid-gap: 30px;
}

.giatien {
    float: right;
}

.giatien strong {
    font-weight: bold;
    font-size: 28px;
}

.room-item {
    margin-top: 80px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.room-item .item i {
    margin-right: 10px;
    display: inline-block;
    width: 36px;
    height: 36px;
    line-height: 40px;
    border-radius: 50%;
    text-align: center;
    background: #f2f5f3;
    margin-top: 2px;

}

.item {
    display: flex;
    flex-wrap: wrap;
}

.room-item-content-title {
    font-weight: 600;
}

.room-content p {
    line-height: 30px;
    margin: 40px 0;
}

.list-content {
    margin: 20px 0 20px 20px;
    padding-left: 15px;
    line-height: 30px;
}

.room-services-item {
    padding: 5px 12px;
    border: 1px dashed #dedede;
    font-size: 18px;
    border-radius: 2px;
}

.room-services-list {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    row-gap: 20px;
    column-gap: 30px;
    margin-top: 30px;
}

.room-services {
    margin-top: 40px;
}

.room-review {
    margin-top: 40px;
}

.review-box {
    display: grid;
    grid-template-columns: 80px 1fr;
    grid-gap: 20px;
    margin-top: 30px;
}

.review-content {
    padding: 20px 30px;
    border: 1px solid #eaeaea;
    border-left-width: 8px;
}

.review-sao i {
    margin-right: 2px;
    color: #deb666;
    font-size: 13px;
}

.review-info span {
    font-size: 13px;
    font-style: italic;
}

.review-info {
    margin-top: 10px;
}

.review-text p {
    line-height: 28px;
    margin-top: 20px;
}

.samilar-room {
    margin-top: 40px;
}

.samilar-room-all {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-gap: 10px;
    margin-top: 30px;
}

.samilar-room-item {
    height: 290px;
    width: 230px;
    position: relative;
}

.samilar-room-detail {
    position: absolute;
    bottom: 0px;
    left: 0px;
    padding: 15px;
    background: linear-gradient(to bottom, rgba(15, 15, 15, 0), rgba(15, 15, 15, .75) 100%);
    width: 100%;
}

.samilar-room-detail h4 {
    font-size: 18px;
    font-weight: 400;
}

.samilar-room-detail-gia {
    font-size: 13px;
    line-height: 28px;
}

.samilar-room-detail-gia strong {
    font-weight: 700;
}

.samilar-room-item a {
    height: 100%;
    width: 100%;
    text-decoration: none;
    color: white;
}

.samilar-room-item a:hover {
    text-decoration: none;
    color: white;
}

.samilar-room-item-img {
    overflow: hidden;
}

.samilar-room-item-img>img {
    transition: .5s;
}

.samilar-room-item:hover .samilar-room-item-img>img {
    transform: scale(1.07);
    transition: .5s;
}


.book-your-room {
    height: 330px;
    background-color: red;
}

.poster {
    margin-top: 30px;
}

/* css cho cais ddanhs gias sao  */
.all-dg {
    border: 1px solid #dedede;
    width: 100%;
    margin-left: 1px;
    margin-top: 30px;
}

/* -----------------------------  */
/* star rating */
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

/*reset css*/
div,
label {
    margin: 0;
    padding: 0;
}

body {
    margin: 20px;
}

h1 {
    font-size: 1.5em;
    margin: 10px;
}

/****** Style Star Rating Widget *****/
#rating {
    border: none;
    float: left;
}

#rating>input {
    display: none;
}


#rating>label:before {
    margin: 5px;
    font-size: 1.25em;
    font-family: FontAwesome;
    display: inline-block;
    content: "\f005";
}

/*1 ngôi sao*/
#rating>.half:before {
    content: "\f089";
    position: absolute;
}

/*0.5 ngôi sao*/
#rating>label {
    color: #ddd;
    float: right;
}


#rating>input:checked~label,
#rating:not(:checked)>label:hover,
#rating:not(:checked)>label:hover~label {
    color: #CCA772;
}


#rating>input:checked+label:hover,
#rating>input:checked~label:hover,
#rating>label:hover~input:checked~label,
#rating>input:checked~label:hover~label {
    color: #FFED85;
}
</style>
<div class="container-fluid" style="margin-bottom: 50px;">
    <div class="container">
        <div class="banners mt-5">
            <!-- <img src="<?php echo BASE_URL.$lp['hinh'] ?>" height="400px" width="1110px" alt=""> -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo BASE_URL.$lp['hinh'] ?>" height="400px"
                            width="1110px" alt="First slide">
                    </div>

                    <!-- // các ảnh loại phòng -->
                    <?php foreach ($ha as $key ) {  ?>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo BASE_URL.$key['hinh'] ?>" height="400px"
                            width="1110px" alt="First slide">
                    </div>
                    <?php } ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"
                    style="z-index: 999;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"
                    style="z-index: 999;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="all-content">
            <div class="left">
                <div class="name-room">
                    <div class="title">
                        <h3><?php echo $lp['ten_loai'] ?></h3>
                    </div>
                    <div class="giatien" style="margin-top: -40px;">
                        <span> <strong>€<?php echo $lp['don_gia'] ?></strong> </span>
                        <span> / per day</span>
                    </div>
                    <div class="room-item">
                        <div class="item">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <div class="room-item-content">
                                Max. Guests
                                <div class="room-item-content-title"> 5 Adults / 2 Children </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <div class="room-item-content">
                                Booking Nights
                                <div class="room-item-content-title"> 3 Min. </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="fa fa-bed" aria-hidden="true"></i>
                            <div class="room-item-content">
                                Bed Type
                                <div class="room-item-content-title"> Twins Bed </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                            <div class="room-item-content">
                                Area
                                <div class="room-item-content-title"> 80 m² </div>
                            </div>
                        </div>
                    </div>

                    <div class="room-content">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel
                            illum
                            dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui
                            blandit praesent
                            luptatum zzril delenit… Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber
                            tempor cum soluta
                            nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim
                            assum. Typi non habent
                            claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes
                            demonstraverunt lectores
                            legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.
                        </p>
                        <div class="list-content">
                            <span><i class="fa fa-circle" aria-hidden="true" style="color: rgb(162, 157, 157);"></i>
                                &ensp;Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span> <br>
                            <span><i class="fa fa-circle" aria-hidden="true" style="color: rgb(162, 157, 157);"></i>
                                &ensp;Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span> <br>
                            <span><i class="fa fa-circle" aria-hidden="true"
                                    style="color: rgb(162, 157, 157);"></i>&ensp; Lorem ipsum dolor sit amet,
                                consectetuer adipiscing elit.</span> <br>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat
                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>

                <!-------------------->

                <div class="room-services">
                    <div class="title">
                        <h3>Room Services</h3>
                    </div>
                    <div class="room-services-list">
                        <div class="room-services-item">
                            <i class="fa fa-wifi"></i>&ensp;
                            Wi-Fi
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-female"></i>&ensp;
                            Hair Dryer
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-bath"></i>&ensp;
                            Sauna
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-cutlery"></i>&ensp;
                            Breakfast
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-coffee"></i>&ensp;
                            Coffee Maker
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-glass"></i>&ensp;
                            Mini Bar
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-mobile"></i>&ensp;
                            Free-use-phone
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-television"></i>&ensp;
                            Widescreen TV
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-snowflake-o"></i>&ensp;
                            Air Conditioner
                        </div>
                    </div>
                </div>

                <!---------------------->

                <div class="room-services">
                    <div class="title">
                        <h3>Room Services</h3>
                    </div>
                    <div class="room-services-list">
                        <div class="room-services-item">
                            <i class="fa fa-taxi" aria-hidden="true"></i>&ensp;
                            Airport Pickup
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-pencil" aria-hidden="true"></i>&ensp;
                            Sightseeing Tour
                        </div>
                        <div class="room-services-item">
                            <i class="fa fa-pagelines" aria-hidden="true"></i>&ensp;
                            Massage &amp; Spa
                        </div>
                    </div>
                </div>

                <div class="room-review">
                    <div class="title">
                        <h3>Comment</h3>
                    </div>

                    <div class="ad-comment">
                        <!-- --------------- bắt đầu from đánh giá ------------------------------->
                        <form action="<?php echo BASE_URL ?>danh_gia.php?id=<?php echo $id ?>" method="GET"
                            id="ratingForm">
                            <div class="row all-dg">
                                <div class="col-md-3"
                                    style="padding: 30px ; text-align: center; border-right: 1px solid #dedede;">
                                    <p
                                        style="display: flex; justify-content: center; align-items: center; font-weight: 600; color: gray; font-size: 20px;">
                                        Average Star</p>
                                    <p style="display: flex; justify-content: center; align-items: center;">
                                        <span><?php foreach ($avg as $key) { ?>
                                            <span><?php echo number_format($key['avg'], 2, '.', ''); ?></span>
                                        <?php } ?>  
                                        
                                        </span>&ensp;&ensp; <i class='fa fa-star' aria-hidden='true'
                                            style='color: #CCA772;'></i>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="row d-flex justify-content-center align-content-center">
                                        <input type="hidden" name="ma_loai_phong" value="<?php echo $id ?>">
                                        <fieldset>
                                            <legend style="text-transform: uppercase; color: gray;font-weight: bold;">
                                                Star rating</legend>
                                            <div id="rating" style="margin-top: -20px;">
                                                <input type="radio" id="star5" name="rating" value="5" />
                                                <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                                <input type="radio" id="star4" name="rating" value="4" />
                                                <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                                <input type="radio" id="star3" name="rating" value="3" />
                                                <label class="full" for="star3" title="Meh - 3 stars"></label>

                                                <input type="radio" id="star2" name="rating" value="2" />
                                                <label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                                <input type="radio" id="star1" name="rating" value="1" />
                                                <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="row d-flex justify-content-center align-content-center">
                                        <div class="form-group">
                                            <textarea name="noi_dung" id="" cols="40" rows="2" class="form-control"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"
                                    style="display: flex; justify-content: center; align-items: center; border-left: 1px solid #dedede;">
                                    <input type="submit"
                                        style="background-color: #CCA772; color: white; border: none;border-radius: 0%;"
                                        class="form-control submit clearfix" value="SEND" name="send">
                                </div>
                            </div>
                        </form>

                        <!-- -------------------  kết thúc from đánh giá ----------------------- -->
                    </div>


                    <?php
                        foreach ($bls as $row) {  $id_user = "" ; $id_user = $row['ma_nguoi_danh_gia'];     
                        foreach (select_all("SELECT * FROM users WHERE id= '$id_user'") as $tow) { ?>

                    <div class="review-box">
                        <div class="review-box-img">
                            <img src="<?php echo BASE_URL.$tow['hinh'] ?>" height="80px" width="80px" alt="">
                        </div>
                        <div class="review-content">
                            <div class="review-sao">
                                <!-- <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i> -->
                                <?php
                                if ($row['so_sao'] == "4") {
                                            echo "
                                                <div class='star-danh-gia'>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                                </div>
                                            ";
                                } else if($row['so_sao'] == "5"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($row['so_sao'] == "3"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($row['so_sao'] == "2"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($row['so_sao'] == "1"){
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
                            <div class="review-info">
                                <span><?php echo $tow['ho_ten'] ?>, Việt Nam</span>
                                <span style="float: right;">
                                        <!-- <a href="" class="btn btn-block" style="background-color: #CCA772; border-radius: 0%; border: none; color: white; margin-top: -7px;">Delete</a> -->
                                        <?php
                                            if (isset($_SESSION['khach_hang'])) {
                                                    if ($tow['id'] == $_SESSION['khach_hang']['id']) { ?>
                                            <a  class="btn btn-block" style="background-color: #CCA772; border-radius: 0%; border: none; color: white; margin-top: -7px;"
                                                href="<?php BASE_URL ?>delete_dg.php?id=<?php echo $id ?>&id_dg=<?php echo $row['id'] ?>">Xóa</a>
                                            <?php

                                            }
                                                } else if (isset($_SESSION['admin']))
                                                        if ($tow['id'] == $_SESSION['admin']['id']) { ?>
                                           <a  class="btn btn-block" style="background-color: #CCA772; border-radius: 0%; border: none; color: white; margin-top: -7px;"
                                                href="<?php BASE_URL ?>delete_dg.php?id=<?php echo $id ?>&id_dg=<?php echo $row['id'] ?>">Xóa</a>

                                        <?php } ?>
                                </span>
                            </div>
                            <div class="review-text">
                                <p style=" font-size: 13px; font-style: italic; color: gray;">
                                    <?php echo $row['noi_dung'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    // đóng hai cái php trên đầu 
                            }
                        }
                    ?>

                </div>

                <!------------------------------>

                <div class="samilar-room">
                    <div class="title">
                        <h3>Similar Rooms</h3>
                    </div>
                    <div class="samilar-room-all">
                        <?php foreach ($lplq as $key) {  ?>
                        <div class="samilar-room-box">
                            <div class="samilar-room-item">
                                <a href="<?php echo BASE_URL ?>chi_tiet_room.php?id=<?php echo $key['id'] ?>">
                                    <div class="samilar-room-item-img">
                                        <img src="<?php echo BASE_URL.$key['hinh'] ?>" height="290px" width="230px"
                                            alt="">
                                    </div>
                                    <div class="samilar-room-detail">
                                        <h4 class="samilar-room-detail-title"><?php echo $key['ten_loai'] ?></h4>
                                        <div class="samilar-room-detail-gia">
                                            <span><strong>€<?php echo $key['don_gia'] ?></strong></span>
                                            <span> / day</span>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                        <!------------------>
                    </div>
                </div>
            </div>
            <div class="right">
                <a href="<?php echo BASE_URL ?>booking.php?id=<?php echo $id ?>" class="btn btn-danger"
                    style="background-color: #CCA772; color: white;border-radius: 0%; border: none; width: 100%; ">CHECK
                    AVAILABILITY</a>
                <div class="poster">
                    <a href=""> <img src="././public/image/poster.jpg" width="300px" height="500px" alt=""> </a>
                </div>
            </div>

        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script>
$(document).ready(function() {
    $("form#ratingForm").submit(function(e) {
        e.preventDefault(); // prevent the default click action from being performed
        if ($("#ratingForm :radio:checked").length == 0) {
            $('#status1').val('bạn chưa rating')

            return false;
        } else {
            // $('#status').html('bạn chọn  ' + $('input:radio[name=rating]:checked').val());
            var fieldID = $(this).prev().attr("id");
            let value = $('input:radio[name=rating]:checked')
            $('#status1').val(value[0].defaultValue)
        }
    });
});
</script> -->
<?php require_once "./footer.php" ?>
<!--------------- end footer----------------->