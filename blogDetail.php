<?php
       require_once 'config.php';
       require_once APP_PATH."/dao/pdo.php" ; 

    //  xóa bình luận 
      if(isset($_GET['id_cmt'])){
        $id_cmt = $_GET['id_cmt'];
        $sql = "SELECT * FROM binh_luan where id = '$id_cmt'" ; 
        $count = connect()->prepare($sql) ; 
        $count->execute() ; 
        if ($count->rowCount() > 0) {
            $sqldelete = "DELETE FROM binh_luan WHERE id = '$id_cmt'" ; 
            insert_update_delete($sqldelete) ; 
        } else {
            try {
                header('location:'.BASE_URL."index.php?msg=Bình luận này không tồn tại !");
                die ; 
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
      
    }   

          
    // kieemr tra xem bai vieets cos ton taij trogn database k 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tin_tuc where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $tt = select_one($sql) ;
        } else {
            try {
                header('location:'.BASE_URL."index.php?msg=Bài viết này không tồn tại !");
                die ; 
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location:'.BASE_URL."index.php");

    }

    // laays cacs baif vieets lien quan 
    $sql = "SELECT * FROM tin_tuc where id != '$id' ORDER BY RAND() LIMIT 3 " ; 
    $lq = select_all($sql) ; 


    // ---------------------------

    if(isset($_POST['comment'])){
        if(!(isset($_SESSION['admin']) || isset($_SESSION['khach_hang']))){
            header("location:".BASE_URL."tai_khoan/login.php?msgs=Vui lòng đăng nhập trước khi bình luận !") ;  
        }else{
            // code bình luận cho khách hàng
            if(isset($_SESSION['khach_hang'])){
                // lấy noi dung
                $noi_dung = $_POST['commentPro'] ; 
                // lấy ngay bl
                $ngay_binh_luan = date("Y/m/d");
                // lấy h 
                $gio_binh_luan = date('H:i:s');

                // lấy ma tin tuc 
                $ma_tin_tuc = $id ; 
                $ma_nguoi_binh_luan = $_SESSION['khach_hang']['id']  ; 
                // bắt đầu ínert bình luận 
                $sqlbl = "INSERT INTO binh_luan
                                            (noi_dung,ngay_binh_luan,gio_binh_luan,trang_thai,ma_tin_tuc,ma_nguoi_binh_luan)
                                            VALUES
                                            ('$noi_dung','$ngay_binh_luan','$gio_binh_luan',0,'$ma_tin_tuc','$ma_nguoi_binh_luan') " ; 
                insert_update_delete($sqlbl) ; 

            }
            
            // bình luận choadmin 
            if(isset($_SESSION['admin'])){
                // lấy noi dung
                $noi_dung = $_POST['commentPro'] ; 
                // lấy ngay bl
                $ngay_binh_luan = date("Y/m/d");
                // lấy h 
                $timestamp = time();
                $gio_binh_luan = date("F d, Y h:i:s", $timestamp) ; 

                // lấy trang thái 
                $trang_thai = 0 ; 
                // lấy ma tin tuc 
                $ma_tin_tuc = $id ; 
                $ma_nguoi_binh_luan = $_SESSION['admin']['id']  ; 
                // bắt đầu ínert bình luận 
                $sqlbl = "INSERT INTO binh_luan
                                            (noi_dung,ngay_binh_luan,gio_binh_luan,trang_thai,ma_tin_tuc,ma_nguoi_binh_luan)
                                            VALUES
                                            ('$noi_dung','$ngay_binh_luan','$gio_binh_luan',0,'$ma_tin_tuc','$ma_nguoi_binh_luan') " ; 
                insert_update_delete($sqlbl) ; 

            }
        }
    }

    // in bình luận 
    $sqlinbl = "SELECT * FROM binh_luan where ma_tin_tuc = '$id'" ; 
    $bls = select_all($sqlinbl) ; 
    

require_once "./header-small.php" ; 
?>
<!--------------- end header----------------->
<!-- content start  -->
<style>

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
</style>
<div class="page-title " style="background: rgb(245, 243, 240); margin-top: 0px;">
    <div class="container">
        <div class="inner">
            <h1>BLOG DETAIL</h1>
            <ul id="" class="breadcrumb">
                <li class="item"><a href="<?php echo BASE_URL ?>">Home </a></li>
                <li class="item-current item">Blog Deatil</li>
            </ul>
        </div>
    </div>
</div>
<main>
    <div class="container pt-4 mb-5">
        <div class="row">
            <div class="col-md-9">
                    <article class="">
                        <a href="#" class="img">
                            <img src="<?php echo BASE_URL.$tt['hinh'] ?>"
                                alt="10 Things You Should Know" style="width: 100%;">
                        </a>
                        <div class="details px-3 pt-4 pb-2">
                            <h2 class="title"><a href="#"><?php echo $tt['tieu_de'] ?></a></h2>
                            <div class="info">
                                <span class="meta_part author-avatar"><img
                                        src="https://secure.gravatar.com/avatar/4bb7ecf65c4865cc500764daefa121ba?s=16&amp;d=mm&amp;r=g"
                                        alt="admin"><a href="#">admin</a></span>
                                <span class="meta_part"><i class="fas fa-clock"></i> February 17, 2018</span>
                                <span class="meta_part"><i class="fa fa-comments" aria-hidden="true"></i><a href="#"> 1 Comment</a></span>
                            </div>
                        </div>

                        <div class="content">
                            <p class="text-content">
                                <?php echo $tt['noi_dung'] ?>
                            </p>
                            
                            <blockquote class="blockquote">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Mauris non laoreet dui, Morbi
                                    lacus massa, euismod ut turpis molestie, tristique sodales est There are many variations
                                    of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>
                            </blockquote>
                        </div>
                    </article>

                <div class="post">
                    <div class="tags">
                        <span><i class="fa fa-tags"></i>Tags</span>
                        <a href="#" class=" custom-my-btn">greece</a>
                        <a href="#" class=" custom-my-btn">holiday</a>
                        <a class=" custom-my-btn" href="#">hotel</a>
                    </div>

                    <div class="share">
                        <div class="social_media">
                            <span><i class="fa fa-share-alt"></i> Share</span>
                            <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                            <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                            <a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>

                <div class="all-comment border-bottom">
                    <h3 style="text-transform: uppercase; color: gray;">Comment</h3>
                    <form action="" method="POST" style="margin-bottom: 30px;">
                        <textarea name="commentPro" id="inputcommentPro" class="form-control" rows="4"></textarea> <br>
                        <!-- <?php if (isset($err)) {
                                echo "<p style='color: red;'>" . $err . "</p>";
                            } ?> -->
                        <button type="submit" name="comment" class="btn btn-danger" style="background-color: #CCA772; border: none; border-radius: 0%;">Bình luận</button>
                    </form>                    
                    <!-- -------------------- end bình luận ------------------ -->
                </div>

                <?php
                foreach ($bls as $row) {  $id_user = "" ; $id_user = $row['ma_nguoi_binh_luan'];     
                    foreach (select_all("SELECT * FROM users WHERE id= '$id_user'") as $tow) { ?>
                    <div class="review-box">
                            <div class="review-box-img">
                                <img src="<?php echo BASE_URL.$tow['hinh'] ?>" height="80px" width="80px" alt="">
                            </div>
                            <div class="review-content">
                                <div class="review-info">
                                    <span style="font-weight: bold; color: gray;"><?php echo $tow['ho_ten'] ?> <span> , Việt Nam <br>
                                    <span>Day : <?php echo $row['ngay_binh_luan'] ?> 
                                    <span style="float: right;">
                                        <!-- <a href="" class="btn btn-block" style="background-color: #CCA772; border-radius: 0%; border: none; color: white; margin-top: -7px;">Delete</a> -->
                                        <?php
                                            if (isset($_SESSION['khach_hang'])) {
                                                    if ($tow['id'] == $_SESSION['khach_hang']['id']) { ?>
                                            <a  class="btn btn-block" style="background-color: #CCA772; border-radius: 0%; border: none; color: white; margin-top: -7px;"
                                                href="<?php BASE_URL ?>blogDetail.php?id=<?php echo $id ?>&id_cmt=<?php echo $row['id'] ?>">Xóa</a>
                                            <?php

                                            }
                                                } else if (isset($_SESSION['admin']))
                                                        if ($tow['id'] == $_SESSION['admin']['id']) { ?>
                                            <a  class="btn btn-block" style="background-color: #CCA772; border-radius: 0%; border: none; color: white; margin-top: -7px;"
                                                href="<?php BASE_URL ?>blogDetail.php?id=<?php echo $id ?>&id_cmt=<?php echo $row['id'] ?>">Xóa</a>

                                        <?php } ?>
                                    </span>
                                </div>
                                <div class="review-text">
                                    <p style=" font-size: 13px; font-style: italic; color: gray;">
                                        <?php echo $row['noi_dung'] ?>
                                    </p>
                                </div>
                            </div>
                        <!-- --------------- end in bình luận --------------- -->
                    </div>
                <?php
                // đóng hai cái php trên đầu 
                        }
                    }
                ?>    
            </div>

            <div class="col-md-3">
                <div class="sidebar">
                    <div class="widget widget_search">
                        <h4 class="widget-title"><i class="fas fa-caret-square-right"></i> Search</h4>
                        <form class="sidebar-search" action="">
                            <input name="s" type="text" class="form-control" value="" placeholder="Search">
                            <button type="submit">| <i class="fa fa-search" aria-hidden="true"></i></button>
                            <input type="hidden" name="lang" value="en">
                        </form>
                    </div>

                    <div class="widget clearfix zante_recent_posts_widget">
                        <h4 class="widget-title"><i class="fas fa-caret-square-right"></i> Recent Posts</h4>

                        <?php foreach ($lq as $key) { ?>
                            <div class="">
                                <div class="row border-bottom pt-3">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <figure class="slide-right-hover">
                                            <a href="<?php echo BASE_URL ?>blogDetail.php?id=<?php echo $key['id'] ?>">
                                                <img src="<?php echo BASE_URL.$key['hinh'] ?>"
                                                    style="width: 100%;" alt="Hotel Zante in pictures">
                                            </a>
                                        </figure>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="details p-0 ">
                                            <h6 class="title"><a href="<?php echo BASE_URL ?>blogDetail.php?id=<?php echo $key['id'] ?>"><?php echo $key['tieu_de'] ?></a></h6>
                                            <span class="post-date"><i class="fa fa-clock-o"></i> June 17, 2018</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->

</main>


<?php require_once "./footer.php" ?>