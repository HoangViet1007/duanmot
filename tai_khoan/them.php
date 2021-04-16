<?php
     require_once "../header-small.php" ; 
?>
<style>
    .them label{
        color: gray;
    }
    .them input{
        border-radius: 0%;
    }
</style>
<div class="type" style="height: 70px; background-color: #CCA772; margin-top: 20px;">
    <h3 style="color: white; text-align: center; text-transform: uppercase; padding-top: 15px;">New uers</h3>
</div>
<div class="container them"
    style="margin-top: 50px; background-color: #FAFAFA;padding-top: 40px; padding-bottom: 40px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); margin-bottom: 50px;">
    <?php if(isset($_GET['msg'])) { ?>
    <span style="margin-left:470px; " class="text-danger mb-3"><?= $_GET['msg'] ?></span>
    <?php } ?>
    <form action="<?php echo BASE_URL ?>tai_khoan/post-them.php" method="POST" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" style="font-weight: bold;">Tên đăng nhập : </label>
                    <input type="text" placeholder="Tên đăng nhập" name="id" class="form-control">
                    <?php if(isset($_GET['iderr'])):?>
                    <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold;">Mật khẩu : </label>
                    <input type="password" placeholder="Mật khẩu" name="mat_khau" class="form-control">
                    <?php if(isset($_GET['mat_khauerr'])):?>
                    <span class="text-danger"><?php echo $_GET['mat_khauerr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold;">Nhập lại mật khẩu : </label>
                    <input type="password" placeholder="Nhập lại mật khẩu" name="cf_mat_khau" class="form-control">
                    <?php if(isset($_GET['cf_mat_khauerr'])):?>
                    <span class="text-danger"><?php echo $_GET['cf_mat_khauerr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold;">Họ và tên : </label>
                    <input type="text" placeholder="Họ và tên" name="ho_ten" class="form-control">
                    <?php if(isset($_GET['ho_tenerr'])):?>
                    <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                    <?php endif ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" style="font-weight: bold;">Email : </label>
                    <input type="text" placeholder="Email" name="email" class="form-control">
                    <?php if(isset($_GET['emailerr'])):?>
                    <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold;">Số chứng minh thư : </label>
                    <input type="text" placeholder="Số chứng minh thư" name="so_chung_minh" class="form-control">
                    <?php if(isset($_GET['so_chung_minherr'])):?>
                    <span class="text-danger"><?php echo $_GET['so_chung_minherr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold;">Số điện thoại : </label>
                    <input type="text" placeholder="Số điện thoại" name="sdt" class="form-control">
                    <?php if(isset($_GET['sdterr'])):?>
                    <span class="text-danger"><?php echo $_GET['sdterr'] ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="" style="font-weight: bold;">Hình ảnh : </label>
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