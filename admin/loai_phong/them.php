<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 


?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Thêm mới loại phòng</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/loai_phong/post-them.php" method="POST" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Tên loại phòng : </label>
                        <input type="text" placeholder="Tên loại phòng" name="ten_loai" class="form-control">
                        <?php if(isset($_GET['ten_loaierr'])):?>
                        <span class="text-danger"><?php echo $_GET['ten_loaierr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Hình ảnh : </label>
                        <input type="file" placeholder="Hình ảnh" name="hinh" class="form-control">
                        <?php if(isset($_GET['hinherr'])):?>
                        <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Số lượng phòng : </label>
                        <input type="text" placeholder="Số lượng phòng" name="so_luong_phong" class="form-control">
                        <?php if(isset($_GET['so_luong_phongerr'])):?>
                        <span class="text-danger"><?php echo $_GET['so_luong_phongerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-control">
                            <input name="trang_thai" value="0" type="radio" checked> Còn phòng &ensp;
                            <input name="trang_thai" value="1" type="radio"> Hết phòng
                            <?php if(isset($_GET['trang_thaierr'])):?>
                            <span class="text-danger"><?php echo $_GET['trang_thaierr'] ?></span>
                            <?php endif ?>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Đơn giá : </label>
                        <input type="number" placeholder="Đơn giá" name="don_gia" class="form-control">
                        <?php if(isset($_GET['don_giaerr'])):?>
                        <span class="text-danger"><?php echo $_GET['don_giaerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Đặc biệt</label>
                        <div class="form-control">
                            <input name="dac_biet" value="0" type="radio"> Đặc biệt &ensp;
                            <input name="dac_biet" value="1" type="radio" checked> Bình thường
                            <?php if(isset($_GET['dac_bieterr'])):?>
                            <span class="text-danger"><?php echo $_GET['dac_bieterr'] ?></span>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Giới thiệu : </label>
                        <textarea name="gioi_thieu" id="" cols="40" rows="2" class="form-control" placeholder="Giới thiệu"></textarea>
                        <?php if(isset($_GET['gioi_thieuerr'])):?>
                        <span class="text-danger"><?php echo $_GET['gioi_thieuerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Mô tả : </label>
                        <textarea name="mo_ta" id="" cols="40" rows="4" class="form-control" placeholder="Mô tả"></textarea>
                        <?php if(isset($_GET['mo_taerr'])):?>
                        <span class="text-danger"><?php echo $_GET['mo_taerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info mr-1" name="addPro">Lưu</button>
                <a href="<?php echo BASE_URL ?>admin/loai_phong/list.php" class="btn btn-danger ml-1">Hủy</a>
            </div>
        </form>
    </div>
</div>