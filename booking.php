<?php
       require_once "config.php" ; 
       require_once APP_PATH."/dao/pdo.php" ;
   
       // lấy id cần sửa trên đường dẫn xuống 
       if (isset($_GET['id'])) {
           $id = $_GET['id'];
           $sql = "select * from loai_phong where id = '$id'" ; 
           // kiểm tra xem trong date base có sp này ko 
           $cout = connect()->prepare($sql);
           $cout->execute();
           if ($cout->rowCount() > 0) {
               $tt = select_one($sql) ; 
           } else {
               try {
                   header('location: ' . BASE_URL . "?msg=Loại phòng này không tồn tại !");      
               } catch (PDOException $e) {
                   echo $e->getMessage();
               }
           }
       }else{
           header('location: ' . BASE_URL . "?msg=Loại phòng này không tồn tại !");      
       }



       require_once "header-small.php" ; 

   
 
?>

<style>
.all-booking {
    display: grid;
    grid-template-columns: 6fr 2fr;
    column-gap: 30px;
    row-gap: 30px;
}

.info-book {
    background: #fff;
    border: 1px solid #e6e9eb;
    padding: 15px;
}

.abc-book {
    display: flex;
    padding: 10px 10px;
    border-bottom: 1px dashed #e6e9eb;
    font-size: 16px;
    position: relative;
}

.button-book button {
    background: #deb666;
    width: 100%;
    margin-top: 30px;
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
}

.button-book button:hover {
    background-color: #dfaf6c;
}
</style>
<div class="page-title " style="background: rgb(245, 243, 240); margin-top: 0px;">
    <div class="container">
        <div class="inner">
            <h1>Booking</h1>
            <ul id="" class="breadcrumb">
                <li class="item"><a href="<?php echo BASE_URL ?>">Home </a></li>
                <li class="item-current item">Booking</li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin: 50px 0px ;">
    <div class="container">
        <div class="all-booking">
            <div class="left">
                <form action="<?php echo BASE_URL ?>post-booking.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                    <?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) { ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Name" name="ten_nguoi_dat" class="form-control"
                                    style="border-radius: 0px;" value="<?php echo $_SESSION['admin']['ho_ten'] ?>"
                                    readonly>
                            </div> <br>

                            <div class="form-group">
                                <input type="text" placeholder="Email" name="email" class="form-control"
                                    value="<?php echo $_SESSION['admin']['email'] ?>" style="border-radius: 0%;"
                                    readonly>

                            </div> <br>

                            <div class="form-group">
                                <input type="date" placeholder="Chech-in" name="ngay_den" class="form-control"
                                    style="border-radius: 0%;">
                                <?php if(isset($_GET['ngay_denerr'])):?>
                                <span class="text-danger"><?php echo $_GET['ngay_denerr'] ?></span>
                                <?php endif ?>


                            </div> <br>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Number Phone" name="sdt" class="form-control" readonly
                                    value="<?php echo $_SESSION['admin']['sdt'] ?>" style="border-radius: 0%;">
                            </div><br>

                            <div class="form-group">
                                <input type="text" name="ma_loai_phong" value="<?php echo $tt['id'] ?>"
                                    class="form-control" readonly>
                            </div><br>

                            <div class="form-group">
                                <input type="date" placeholder="Check-out" name="ngay_di" class="form-control"
                                    style="border-radius: 0%;">
                                <?php if(isset($_GET['ngay_dierr'])):?>
                                <span class="text-danger"><?php echo $_GET['ngay_dierr'] ?></span>
                                <?php endif ?>

                            </div><br>
                        </div>
                    </div>
                    <?php } elseif(isset($_SESSION['khach_hang']) && !empty($_SESSION['khach_hang'])) { ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Name" name="ten_nguoi_dat" class="form-control" readonly
                                    value="<?php echo $_SESSION['khach_hang']['ho_ten'] ?>" style="border-radius: 0px;">
                            </div> <br>

                            <div class="form-group">
                                <input type="text" placeholder="Email" name="email" class="form-control" readonly
                                    value="<?php echo $_SESSION['khach_hang']['email'] ?>" style="border-radius: 0%;">

                            </div> <br>

                            <div class="form-group">
                                <input type="date" placeholder="Chech-in" name="ngay_den" class="form-control"
                                    style="border-radius: 0%;">
                                <?php if(isset($_GET['ngay_denerr'])):?>
                                <span class="text-danger"><?php echo $_GET['ngay_denerr'] ?></span>
                                <?php endif ?>

                            </div> <br>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Number Phone" name="sdt" class="form-control" readonly
                                    value="<?php echo $_SESSION['khach_hang']['sdt'] ?>" style="border-radius: 0%;">
                            </div><br>

                            <div class="form-group">
                                <input type="text" name="ma_loai_phong" value="<?php echo $tt['id'] ?>"
                                    class="form-control" readonly>
                            </div><br>

                            <div class="form-group">
                                <input type="date" placeholder="Check-out" name="ngay_di" class="form-control"
                                    style="border-radius: 0%;">
                                <?php if(isset($_GET['ngay_dierr'])):?>
                                <span class="text-danger"><?php echo $_GET['ngay_dierr'] ?></span>
                                <?php endif ?>

                            </div><br>
                        </div>
                    </div>
                    <?php } else{ ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Name" name="ten_nguoi_dat" class="form-control"
                                    style="border-radius: 0px;">
                                <?php if(isset($_GET['ten_nguoi_daterr'])):?>
                                <span class="text-danger"><?php echo $_GET['ten_nguoi_daterr'] ?></span>
                                <?php endif ?>
                            </div> <br>

                            <div class="form-group">
                                <input type="text" placeholder="Email" name="email" class="form-control"
                                    style="border-radius: 0%;">
                                <?php if(isset($_GET['emailerr'])):?>
                                <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                                <?php endif ?>

                            </div> <br>

                            <div class="form-group">
                                <input type="date" placeholder="Chech-in" name="ngay_den" class="form-control"
                                    style="border-radius: 0%;">
                                <?php if(isset($_GET['ngay_denerr'])):?>
                                <span class="text-danger"><?php echo $_GET['ngay_denerr'] ?></span>
                                <?php endif ?>

                            </div> <br>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Number Phone" name="sdt" class="form-control"
                                    style="border-radius: 0%;">
                                <?php if(isset($_GET['sdterr'])):?>
                                <span class="text-danger"><?php echo $_GET['sdterr'] ?></span>
                                <?php endif ?>
                            </div><br>

                            <div class="form-group">
                                <input type="text" name="ma_loai_phong" value="<?php echo $tt['id'] ?>"
                                    class="form-control" readonly>

                            </div><br>

                            <div class="form-group">
                                <input type="date" placeholder="Check-out" name="ngay_di" class="form-control"
                                    style="border-radius: 0%;">
                                <?php if(isset($_GET['ngay_dierr'])):?>
                                <span class="text-danger"><?php echo $_GET['ngay_dierr'] ?></span>
                                <?php endif ?>

                            </div><br>
                        </div>
                    </div>

                    <?php } ?>


                    <div class="row d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-info mr-1" name="addPro"
                            style="width: 100px; background-color: #CCA772; border: none; border-radius: 0%;">Booking</button>
                        <a href="<?php echo BASE_URL ?>" class="btn btn-danger ml-1"
                            style="width: 100px; background-color: #CCA772; border: none; border-radius: 0%;">Cancel</a>
                    </div>
                </form>
            </div>
            <div class="right">
                <div class="roombook">
                    <div class="img-book">
                        <img src="<?php echo BASE_URL.$tt['hinh'] ?>" width="285px" height="150px" alt="">
                    </div>
                    <div class="info-book">
                        <div class="title-book">
                            <div class="abc-book">
                                <div class="row">
                                    <span>Name:</span>
                                    <span
                                        style="position: absolute; right: 0px;color: gray;"><strong><?php echo $tt['ten_loai'] ?></strong></span>
                                </div>
                            </div>
                            <div class="abc-book">
                                <div class="row">
                                    <span>Total Price:</span>
                                    <span style="position: absolute; right: 0px; color: gray;"><strong><?php echo $tt['don_gia'] ?>$/
                                            a day</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="button-book">
                            <a href="<?php echo BASE_URL ?>chi_tiet_room.php?id=<?php echo $id ?>"><button
                                    style="background-color: #CCA772;">Back Room <i class="fa fa-reply"
                                        aria-hidden="true"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
       var today = new Date().toISOString().split('T')[0];
       document.getElementsByName("ngay_den")[0].setAttribute('min', today);
       document.getElementsByName("ngay_di")[0].setAttribute('min', today);

</script>
<?php require_once "./footer.php" ?>