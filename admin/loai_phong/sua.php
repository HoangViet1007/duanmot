<?php
    require_once "../../config.php" ; 
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
                header('location: ' . BASE_URL . "admin/loai_phong/list.php?msg=Loại phòng này không tồn tại !");      
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location: ' . BASE_URL . "admin/loai_phong/list.php?msg=Loại phòng này không tồn tại !");      
    }
    

    require_once APP_PATH."/admin/layout/layout.php" ; 
?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Sửa thông tin loại phòng</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/loai_phong/post-sua.php" method="POST" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <label for="" style="font-weight: bold;">Tên loại phòng mới: </label>
                        <input type="text" placeholder="Tên loại phòng" name="ten_loai" class="form-control"
                            value="<?php echo $tt['ten_loai'] ?>">
                        <?php if(isset($_GET['ten_loaierr'])):?>
                        <span class="text-danger"><?php echo $_GET['ten_loaierr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Hình ảnh mới: </label>
                        <input type="file" placeholder="Hình ảnh" name="hinh" class="form-control">
                        <?php if(isset($_GET['hinherr'])):?>
                        <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Số lượng phòng mới: </label>
                        <input type="text" placeholder="Số lượng phòng" name="so_luong_phong" class="form-control"
                            value="<?php echo $tt['so_luong_phong'] ?>">
                        <?php if(isset($_GET['so_luong_phongerr'])):?>
                        <span class="text-danger"><?php echo $_GET['so_luong_phongerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Số phòng đã đặt : </label>
                        <input type="number" placeholder="Đơn giá" name="so_phong_da_dat" class="form-control"
                            value="<?php echo $tt['so_phong_da_dat'] ?>">
                        <?php if(isset($_GET['so_phong_da_daterr'])):?>
                            <span class="text-danger"><?php echo $_GET['so_phong_da_daterr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Đơn giá mới: </label>
                        <input type="number" placeholder="Đơn giá" name="don_gia" class="form-control"
                            value="<?php echo $tt['don_gia'] ?>">
                        <?php if(isset($_GET['don_giaerr'])):?>
                        <span class="text-danger"><?php echo $_GET['don_giaerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Đặc biệt mới :</label>
                        <div class="form-control">
                            <?php if($tt['dac_biet'] == 0){ ?>
                            <input name="dac_biet" value="0" type="radio" checked> Đặc biệt &ensp;
                            <input name="dac_biet" value="1" type="radio"> Bình thường
                            <?php } elseif ($tt['dac_biet'] == 1) {?>
                            <input name="dac_biet" value="0" type="radio"> Đặc biệt &ensp;
                            <input name="dac_biet" value="1" type="radio" checked> Bình thường
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Giới thiệu mới: </label>
                        <textarea name="gioi_thieu" id="" cols="40" rows="2" class="form-control"
                            placeholder="Giới thiệu"><?php echo $tt['gioi_thieu'] ?></textarea>
                        <?php if(isset($_GET['gioi_thieuerr'])):?>
                        <span class="text-danger"><?php echo $_GET['gioi_thieuerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Mô tả mới: </label>
                        <textarea name="mo_ta" id="" cols="40" rows="4" class="form-control"
                            placeholder="Mô tả"><?php echo $tt['mo_ta'] ?></textarea>
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