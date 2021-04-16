<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;

    // lấy id cần sửa trên đường dẫn xuống 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
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
                header('location: ' . BASE_URL . "admin/users/list.php?msg=Users này không tồn tại !");      
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location: ' . BASE_URL . "admin/loai_phong/list.php?msg=Users này không tồn tại !");      
    }
    $sql = "SELECT * FROM vai_tro" ; 
    $vai_tro = select_all($sql) ; 
   
    

    require_once APP_PATH."/admin/layout/layout.php" ; 
?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Sửa thông tin users</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/users/post-sua.php" method="POST" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Tên đăng nhập : </label>
                        <input type="hidden" name="ids" value="<?php echo $id; ?>">
                        <input type="text" placeholder="Tên đăng nhập" name="id" disabled class="form-control" value="<?php echo $tt['id'] ?>">
                        <?php if(isset($_GET['iderr'])):?>
                        <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Mật khẩu : </label>
                        <input type="password" placeholder="Mật khẩu" name="mat_khau" class="form-control" value="<?php echo $tt['mat_khau'] ?>">
                        <?php if(isset($_GET['mat_khauerr'])):?>
                        <span class="text-danger"><?php echo $_GET['mat_khauerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Nhập lại mật khẩu : </label>
                        <input type="password" placeholder="Nhập lại mật khẩu" name="cf_mat_khau" class="form-control" value="<?php echo $tt['mat_khau'] ?>">
                        <?php if(isset($_GET['cf_mat_khauerr'])):?>
                        <span class="text-danger"><?php echo $_GET['cf_mat_khauerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Họ và tên : </label>
                        <input type="text" placeholder="Họ và tên" name="ho_ten" class="form-control" value="<?php echo $tt['ho_ten'] ?>">
                        <?php if(isset($_GET['ho_tenerr'])):?>
                        <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                        <label for="" style="font-weight: bold;">Email : </label>
                        <input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo $tt['email'] ?>">
                        <?php if(isset($_GET['emailerr'])):?>
                        <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Số chứng minh thư : </label>
                        <input type="text" placeholder="Số chứng minh thư" name="so_chung_minh" class="form-control" value="<?php echo $tt['so_chung_minh'] ?>">
                        <?php if(isset($_GET['so_chung_minherr'])):?>
                        <span class="text-danger"><?php echo $_GET['so_chung_minherr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Số điện thoại : </label>
                        <input type="text" placeholder="Số điện thoại" name="sdt" class="form-control" value="<?php echo $tt['sdt'] ?>">
                        <?php if(isset($_GET['sdterr'])):?>
                        <span class="text-danger"><?php echo $_GET['sdterr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Tên vai trò :</label>
                        <select name="ma_vai_tro" class="form-control">
                            <?php foreach ($vai_tro as $key ) { ?>
                            <option <?php if($key['id'] == $tt['vt']) : ?> selected <?php endif ?>
                                value="<?php echo $key['id'] ?>">
                                <?= $key['ten_vai_tro']?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row d-flex justify-content-center align-items-center form-group">
                <label for="" style="font-weight: bold;">Hình ảnh : </label>
                <input type="file" placeholder="Hình ảnh" name="hinh" class="form-control">
                <?php if(isset($_GET['hinherr'])):?>
                <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                <?php endif ?>
            </div>


            <div class="row d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info mr-1" name="addPro">Lưu</button>
                <a href="<?php echo BASE_URL ?>admin/users/list.php" class="btn btn-danger ml-1">Hủy</a>
            </div>
        </form>
    </div>
</div>