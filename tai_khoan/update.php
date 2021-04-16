<?php
    require_once "../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
     $value  = "" ; 
     if(isset($_SESSION['khach_hang'])) {
       $value = $_SESSION['khach_hang']['id'] ; 
    } elseif(isset($_SESSION['admin'])){ 
      $value = $_SESSION['admin']['id'] ; 
    } 

    if (isset($value)) {
        $id = $value;
        $sql = "select * from users where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $sql = "SELECT 
            users.id ,
            users.mat_khau,
            users.ho_ten,
            users.hinh,
            users.email,
            users.so_chung_minh,
            users.sdt,
            users.ma_vai_tro as vt ,
            vai_tro.ten_vai_tro
            from users join vai_tro on users.ma_vai_tro = vai_tro.id where users.id = '$id'" ; 
            $tt = select_one($sql) ;  
        } else {
            try {
                header('location: ' . BASE_URL . "tai_khoan/update.php?msg=Users này không tồn tại !");      
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location: ' . BASE_URL . "admin/loai_phong/list.php?msg=Users này không tồn tại !");      
    }

    require_once "../header-small.php" ; 


?>
<div class="type" style="height: 70px; background-color: #CCA772; margin-top: 20px;">
    <h3 style="color: white; text-align: center; text-transform: uppercase; padding-top: 15px;">Update uers</h3>
</div>
<div class="container"
    style="margin-top: 50px; background-color: #FAFAFA;padding-top: 40px; padding-bottom: 40px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); margin-bottom: 50px;">
    <?php if(isset($_GET['msg'])) { ?>
            <span style="margin-left:470px; " class="text-danger mb-3"><?= $_GET['msg'] ?></span>
        <?php } ?>
    <form action="<?php echo BASE_URL ?>tai_khoan/post-sua.php" method="POST" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" style="font-weight: bold;color: gray;">Tên đăng nhập : </label>
                    <input type="hidden" name="ids" value="<?php echo $id; ?>">
                    <input type="text" placeholder="Tên đăng nhập" name="id" disabled class="form-control"
                        value="<?php echo $tt['id'] ?>">
                    <?php if(isset($_GET['iderr'])):?>
                    <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold; color: gray;">Email : </label>
                    <input type="text" placeholder="Email" name="email" class="form-control"
                        value="<?php echo $tt['email'] ?>">
                    <?php if(isset($_GET['emailerr'])):?>
                    <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                    <?php endif ?>
                </div>


                <div class="form-group">
                    <label for="" style="font-weight: bold; color: gray;">Họ và tên : </label>
                    <input type="text" placeholder="Họ và tên" name="ho_ten" class="form-control"
                        value="<?php echo $tt['ho_ten'] ?>">
                    <?php if(isset($_GET['ho_tenerr'])):?>
                    <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                    <?php endif ?>
                </div>
            </div>

            <div class="col-md-6">
                
                <div class="form-group">
                    <label for="" style="font-weight: bold; color: gray;">Số chứng minh thư : </label>
                    <input type="text" placeholder="Số chứng minh thư" name="so_chung_minh" class="form-control"
                        value="<?php echo $tt['so_chung_minh'] ?>">
                    <?php if(isset($_GET['so_chung_minherr'])):?>
                    <span class="text-danger"><?php echo $_GET['so_chung_minherr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold; color: gray;">Số điện thoại : </label>
                    <input type="text" placeholder="Số điện thoại" name="sdt" class="form-control"
                        value="<?php echo $tt['sdt'] ?>">
                    <?php if(isset($_GET['sdterr'])):?>
                    <span class="text-danger"><?php echo $_GET['sdterr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold; color: gray;">Hình ảnh : </label>
                    <input type="file" placeholder="Hình ảnh" name="hinh" class="form-control">
                    <?php if(isset($_GET['hinherr'])):?>
                    <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                    <?php endif ?>
                </div>
            </div>

        </div>


        <div class="row d-flex justify-content-center align-items-center">
        <button type="submit" class="btn btn-info mr-1" name="addPro" style="background-color: #CCA772; color: white; border-radius: 0%; width: 100px; border: none;">Lưu</button>
            <a href="<?php echo BASE_URL ?>" class="btn btn-danger ml-1" style="background-color: #CCA772; color: white; border-radius: 0%; width: 100px; border: none;">Hủy</a>
        </div>
    </form>
</div>



<?php require_once "../footer.php" ?>