<?php
    require_once "./header-small.php" ;
    $sqls = "SELECT * FROM loai_phong" ; 
    $lps = select_all($sqls) ; 
   
    // tìm kienm 
    if(isset($_POST['booking'])){
        $ma_loai_phong = $_POST['ma_loai_phong'] ; 
        $gia_tu = $_POST['gia_tu'] ; 
        $gia_den = $_POST['gia_den'] ; 

        if(($ma_loai_phong != "") && ($gia_tu.$gia_den == "")){
            $sqls .= " where id like '%$ma_loai_phong%'" ;   
        }
        if(($gia_tu != "") && ($gia_den.$ma_loai_phong == "")){
            $sqls .= " where don_gia >= '$gia_tu'" ;   
        }
        if(($gia_den != "") && ($gia_tu.$ma_loai_phong == "")){
            $sqls .= " where don_gia <= '$gia_den'" ;   
        }
        if(($gia_den != "") && ($gia_tu != "") && ($ma_loai_phong == "")){
            $sqls .= " where don_gia >= '$gia_tu' AND don_gia <= '$gia_den'" ; 
        }
        if(($ma_loai_phong != "") && ($gia_tu != "") && ($gia_den == "")){
            $sqls .= " where id like '%$ma_loai_phong%' AND don_gia >= '$gia_tu'" ;  
        }
        if(($ma_loai_phong != "") && ($gia_den != "") && ($gia_tu == "")){
            $sqls .= " where id like '%$ma_loai_phong%' AND don_gia <= '$gia_den'" ;  
        }

        if(($ma_loai_phong != "") && ($gia_den != "") && ($gia_tu != "")){
            $sqls .= " where id like '%$ma_loai_phong%' AND don_gia >= '$gia_tu' AND don_gia <= '$gia_den'" ; 
        }
    }
            
    
    $lp = select_all($sqls) ; 
 
 ?>
<!--------------- end header----------------->
<style>
.type {
    text-align: center;
    padding-top: 10px;
    margin-top: 50px;
}

.type h1 {
    color: white;
    text-shadow: black 0.1em 0.1em 0.2em;
}

.list-room-all {
    display: grid;
    grid-template-columns: 391px 540px 1fr;
    grid-gap: 20px;
    margin-top: 50px;
    border: 1px solid #dedede;
    background-color: white;
}

.list-room-all-tt {
    padding-top: 20px;
}
.list-room-all-tt a{
    text-decoration: none;
    color: black;
}
.list-room-all-img>img{
    transition: all 0.5s;
}
.list-room-all-img:hover img{
    transform: scale(1.07);
    transition: all 0.5s;
    opacity: 0.8;
}
.list-room-all-giatien {
    padding-left: 5px;
    padding-top: 30px;
}

.list-room-all-giatien a {
    text-decoration: none;
    font-weight: bold;
    color: #CCA772;
}

.list-room-all-giatien a:hover {
    text-decoration: none;
    color: white;
    padding: 7px 5px;
    background-color: #CCA772;
    border-radius: 20px;
}

.abc ul {
    display: flex;
    align-items: center;
    margin-left: -50px;
    margin-top: 60px;
}

.abc ul li {
    width: 35px;
    height: 35px;
    text-align: center;
    border: 1px dotted gray;
    padding: 5px 5px;
    margin: 0 15px;
}

.abc a {
    color: gray;
}

</style>
<div class="page-title " style="background: rgb(245, 243, 240); margin-top: 0px;">
    <div class="container">
        <div class="inner">
            <h1>List Room</h1>
            <ul id="" class="breadcrumb">
                <li class="item"><a href="<?php echo BASE_URL ?>">Home </a></li>
                <li class="item-current item">List Room</li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <form action="<?php echo BASE_URL ?>list-type-room.php" method="POST" enctype="multipart/form-data">
            <div class="search-all">
                <div class="box-search-all">
                    <div class="box-search-all-tt">
                        <p style="font-family: 'Playfair Display', serif;text-transform: uppercase;">ROOM TYPE :</p>
                    </div>
                    <div class="box-search-all-input">
                        <select name="ma_loai_phong" class="form-control" style="border: 1px solid #CCA772; border-radius: 0%;">
                            <option value="">All type room</option>
                            <?php foreach ($lps as $key ) { ?>
                            <option value="<?= $key['id'] ?>">
                                <?= $key['ten_loai']?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="box-search-all">
                    <div class="box-search-all-tt">
                        <p style="font-family: 'Playfair Display', serif;text-transform: uppercase;">PRICE TO:</p>
                    </div>
                    <div class="box-search-all-input">
                        <input type="number" placeholder="Price to" name="gia_tu" class="form-control">
                    </div>
                </div>
                <div class="box-search-all">
                    <div class="box-search-all-tt">
                        <p style="font-family: 'Playfair Display', serif;text-transform: uppercase;">PRICE FROM:</p>
                    </div>
                    <div class="box-search-all-input">
                        <input type="number" placeholder="Price from" name="gia_den" class="form-control">
                    </div>
                </div>
                <div class="box-search-all">
                    <div class="box-search-all-tt"></div>
                    <div class="box-search-all-input">
                        <button type="submit" name="booking" class="btn" style="font-family: 'Playfair Display', serif;text-transform: uppercase;">Booking Now</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container-fluid " style="margin-top: 40px; padding: 1px 1px; background-color: #F1F0ED; padding-bottom: 40px;">
    <div class="container">
        <div class="list-room" style="margin-top: 30px;">
            <?php foreach ($lp as $key) { ?>
                <div class="list-room-all" style="height: 257px;">
                    <div class="list-room-all-img" style="overflow: hidden;">
                        <a href="<?php echo BASE_URL ?>chi_tiet_room.php?id=<?php echo $key['id'] ?>"><img src="<?php echo BASE_URL.$key['hinh'] ?>" height="255px" width="391px" alt=""></a>
                    </div>
                    <div class="list-room-all-tt">
                        <a href="<?php echo BASE_URL ?>chi_tiet_room.php?id=<?php echo $key['id'] ?>">
                            <h4><?php echo $key['ten_loai'] ?></h4>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
                        <div class="abc">
                            <ul>
                                <li><a href="#"><i class="fa fa-wifi" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-bath" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-coffee" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-tablet" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-desktop" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-cutlery" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-wifi" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-bath" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="list-room-all-giatien">
                        <h3>€<?php echo $key['don_gia'] ?></h3>
                        <span>A DAY</span> <br> <br>
                        <a href="<?php echo BASE_URL ?>chi_tiet_room.php?id=<?php echo $key['id'] ?>">More Details <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>




<?php require_once "./footer.php" ?>
<!--------------- end footer----------------->