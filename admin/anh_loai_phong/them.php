<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    // lấy loại phòng za 
    $sql = "SELECT * FROM loai_phong" ; 
    $tt = select_all($sql) ; 
?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Thêm hình ảnh cho loại phòng</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/anh_loai_phong/post-them.php" method="POST"
            enctype="multipart/form-data">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Hình ảnh : </label>
                        <input type="file" placeholder="Hình ảnh" name="hinh" class="form-control">
                        <?php if(isset($_GET['hinherr'])):?>
                        <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên loại phòng :</label>
                        <select name="ma_loai_phong" class="form-control">
                            <?php foreach ($tt as $key ) { ?>
                            <option value="<?= $key['id'] ?>">
                                <?= $key['ten_loai']?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info mr-1" name="addPro">Lưu</button>
                <a href="<?php echo BASE_URL ?>admin/anh_loai_phong/list.php" class="btn btn-danger ml-1">Hủy</a>
            </div>
        </form>
    </div>
</div>