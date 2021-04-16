<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 


?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Thêm thông tin website</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/website/post-them.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên website</label>
                        <input type="text" placeholder="Tên website" class="form-control" name="ten_web">
                        <?php if(isset($_GET['ten_weberr'])):?>
                            <span class="text-danger"><?php echo $_GET['ten_weberr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Logo</label>
                        <input type="file" placeholder="Logo" class="form-control" name="logo">
                        <?php if(isset($_GET['logoerr'])):?>
                            <span class="text-danger"><?php echo $_GET['logoerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" placeholder="Số điện thoại" class="form-control" name="sdt">
                        <?php if(isset($_GET['sdterr'])):?>
                            <span class="text-danger"><?php echo $_GET['sdterr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" placeholder="Địa chỉ" class="form-control" name="dia_chi">
                        <?php if(isset($_GET['dia_chierr'])):?>
                            <span class="text-danger"><?php echo $_GET['dia_chierr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" placeholder="Email" class="form-control" name="email">
                        <?php if(isset($_GET['emailerr'])):?>
                            <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Map url</label>
                        <input type="text" placeholder="Map url" class="form-control" name="map_url">
                        <?php if(isset($_GET['map_urlerr'])):?>
                            <span class="text-danger"><?php echo $_GET['map_urlerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info mr-1" name="addPro">Lưu</button>
                <a href="<?php echo BASE_URL ?>admin/website/list.php" class="btn btn-danger ml-1">Hủy</a>
            </div>
        </form>
    </div>
</div>