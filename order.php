<?php
    require_once "header-small.php" ; 
    // laays id treen duowng dan
    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 

    // lay ma loai phong 
    $ma_loai_phong = isset($_GET['ma_loai_phong']) ? $_GET['ma_loai_phong'] : "" ; 

    $sql = "SELECT * FROM loai_phong where id = '$ma_loai_phong'" ; 
    $lp = select_one($sql) ; 


    $sql = "SELECT * FROM dat_phong where id = '$id'" ; 
    $dp = select_one($sql) ; 

?>
<style>
.all-order {
    width: 100%;
    border: 1px solid #dedede;
    box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.2);
    color: gray;
}

.image img {
    width: 100%;
    height: 300px;
}

.order-info {
    width: 100%;
    padding: 15px;
}
.abc{
    border-bottom: 1px dashed #e6e9eb;
    padding: 5px;
    margin:10px ;
}
.abc:hover{
    background-color: #dedede;
}

.button-book button {
    background: #deb666;
    width: 400px;
    font-size: 14px;
    border-radius: 2px;
    border: 0;
    box-shadow: none;
    outline: none;
    padding: 8px 16px;
    color: #fff;
    font-weight: 700;
    text-transform: none;
    cursor: pointer;
    margin-top: -20px;
    display: flex;
    justify-content: center;
    margin-left: 70px;
    margin-bottom: 20px;
    margin-top: 5px;
}

.button-book button:hover {
    background-color: #dfaf6c;
}
</style>
<div class="page-title " style="background: rgb(245, 243, 240); margin-top: 0px;">
    <div class="container">
        <div class="inner">
            <h1>Order</h1>
            <ul id="" class="breadcrumb">
                <li class="item"><a href="<?php echo BASE_URL ?>">Home </a></li>
                <li class="item-current item">Order</li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="container">
        <div class="row d-flex justify-content-center align-content-center">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="all-order">
                    <div class="image">
                        <img src="<?php echo BASE_URL.$lp['hinh'] ?>" alt="">
                    </div>
                    <div class="order-info">
                        <div class="row abc">
                            <div class="order-info-detail">
                                <span style="font-weight: bold;">Check-in :</span>
                                <span style="position: absolute; right: 40px;color: gray;"><?php echo $dp['ngay_den'] ?></span>
                            </div>
                        </div>
                        <div class="row abc">
                            <div class="order-info-detail">
                                <span style="font-weight: bold;">Check-out :</span>
                                <span style="position: absolute; right: 40px;color: gray;"><?php echo $dp['ngay_di'] ?></span>
                            </div>
                        </div>
                        <div class="row abc">
                            <div class="order-info-detail">
                                <span style="font-weight: bold;">Room Type :</span>
                                <span style="position: absolute; right: 40px;color: gray;"><?php echo $lp['ten_loai'] ?></span>
                            </div>
                        </div>
                        <div class="row abc">
                            <div class="order-info-detail">
                                <span style="font-weight: bold;">People Order :</span>
                                <span style="position: absolute; right: 40px;color: gray;"><?php echo $dp['ten_nguoi_dat'] ?></span>
                            </div>
                        </div>
                        <div class="row abc">
                            <div class="order-info-detail">
                                <span style="font-weight: bold;">Total Price :</span>
                                <span style="position: absolute; right: 40px;color: gray;"><?php echo $lp['don_gia'] ?> $ /a day</span>
                            </div>
                        </div>
                    </div>
                    <div class="button-order">
                        <a href="<?php echo BASE_URL ?>" class="button-book" style="text-decoration: none;">
                            <button>Back Home</button>
                        </a>
                    </div>
                </div>


            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>



<?php require_once "footer.php" ;  ?>