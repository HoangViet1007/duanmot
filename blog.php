<?php
    require_once "./header-small.php" ; 


    // làm phân trang 
    if (!isset($_GET['product'])) {
        $product = 1;
    } else {
        $product = $_GET['product'];
        if(!is_numeric($product) || $product <= 0){
            header("location:".BASE_URL) ; 
        }
    }
    $data = 3;
    $sql = "SELECT count(*) FROM `tin_tuc`";
    $conn = connect() ; 
    $result = $conn->prepare($sql);
    $result->execute();
    $number = $result->fetchColumn();
    $page = ceil($number / $data);
    $tin = ($product - 1) * $data;

    // lấy key 
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "" ; 
 
    // lấy za danh sách bài viết 
    $sql = "SELECT * FROM tin_tuc LIMIT $tin, $data" ; 

    if($keyword !== ""){
        $sql = "SELECT * FROM tin_tuc where tieu_de like '%$keyword%' LIMIT $tin , $data";
    }
    $tt = select_all($sql) ; 


    // laays za soos binhf luaanj 
 
 
 ?>
<!--------------- end header----------------->
<!-- content start  -->
<div class="page-title " style="background: rgb(245, 243, 240); margin-top: 0px;">
    <div class="container">
        <div class="inner">
            <h1>Blog</h1>
            <ul id="" class="breadcrumb">
                <li class="item"><a href="<?php echo BASE_URL ?>">Home </a></li>
                <li class="item-current item">Blog</li>
            </ul>
        </div>
    </div>
</div>
<main>
    <div class="container pt-4 ">
        <div class="row">

            <div class="col-md-9 border-bottom">
                <?php foreach ($tt as $key) {
                    $id = "" ; 
                    $id = $key['id'] ;  
                    $sql = "SELECT ma_tin_tuc FROM binh_luan WHERE ma_tin_tuc= $id" ; 
                    $sbl  = select_all($sql) ; 
                    $count = count($sbl); 
                ?>
                <article class="">
                    <a href="<?php echo BASE_URL ?>blogDetail.php?id=<?php echo $key['id'] ?>" class="img">
                        <img src="<?php echo BASE_URL.$key['hinh'] ?>" alt="10 Things You Should Know"
                            style="width: 100%;">
                    </a>

                    <div class="details">
                        <h2 class="title"><a
                                href="<?php echo BASE_URL ?>blogDetail.php?id=<?php echo $key['id'] ?>"><?php echo $key['tieu_de'] ?></a>
                        </h2>
                        <div class="info">
                            <span class="meta_part author-avatar"><img
                                    src="https://secure.gravatar.com/avatar/4bb7ecf65c4865cc500764daefa121ba?s=16&amp;d=mm&amp;r=g"
                                    alt="admin"><a href="#">admin</a></span>
                            <span class="meta_part"><i class="fas fa-clock"></i> February 17, 2018</span>
                            <span class="meta_part"><i class="fa fa-comments" aria-hidden="true"></i><a href="#">
                                    <?php echo $count ?>
                                    Comment</a></span>
                        </div>
                        <div class="content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                                quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
                                consequat. Duis autem vel eum iriure</p>
                        </div>
                    </div>
                </article>
                <?php  
                    }
                 ?>
            </div>

            <div class="col-md-3">
                <div class="sidebar">
                    <div class="widget widget_search">
                        <h4 class="widget-title"><i class="fas fa-caret-square-right"></i> Search</h4>
                        <form class="sidebar-search" action="" method="GET">
                            <input type="text" class="form-control" value="<?= $keyword ?>" placeholder="Search"
                                name="keyword">
                            <button type="submit">| <i class="fa fa-search" aria-hidden="true"></i></button>
                            <!-- <input type="hidden" name="lang" value="en"> -->
                        </form>
                    </div>

                    <div class="widget clearfix zante_recent_posts_widget">
                        <h4 class="widget-title"><i class="fas fa-caret-square-right"></i> Recent Posts</h4>

                        <?php foreach (select_all("SELECT * FROM tin_tuc  ORDER BY RAND() LIMIT 4 ") as $key) {  ?>
                        <div class="">

                            <div class="row border-bottom pt-3">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <figure class="slide-right-hover">
                                        <a href="<?php echo BASE_URL ?>blogDetail.php?id=<?php echo $key['id'] ?>">
                                            <img src="<?php echo BASE_URL.$key['hinh'] ?>" style="width: 100%;"
                                                alt="Hotel Zante in pictures">
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

    <!-- pagination -->
    <div class="pagination my-5 py-5 d-flex justify-content-center">
        <a href="#" class="active">&laquo;</a>
        <?php
            for ($t = 1; $t <= $page; $t++) { ?>
        &nbsp;<a name="" class="active" href="<?php echo BASE_URL ?>blog.php?product=<?= $t ?>" role="button">
            <?= $t ?></a>
        <?php
            }
            ?>
        <a href="#" class="active">&raquo;</a>
    </div>

</main>


<?php require_once "./footer.php" ?>