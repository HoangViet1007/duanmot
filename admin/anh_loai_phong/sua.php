<?php
      require_once "../../config.php" ; 
      require_once APP_PATH."/dao/pdo.php" ; 

    // lấy id xuống và fill dữ liệu cũ      

    // lấy id cần sửa trên đường dẫn xuống 
     if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "select * from hinh_anh_loai_phong where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $sql = "select
            loai_phong.ten_loai as 'a' ,
            hinh_anh_loai_phong.id ,
            hinh_anh_loai_phong.hinh,
            hinh_anh_loai_phong.ma_loai_phong 
            from hinh_anh_loai_phong join loai_phong on hinh_anh_loai_phong.ma_loai_phong = loai_phong.id where hinh_anh_loai_phong.id = '$id'" ; 
            $tt = select_one($sql) ;  
        } else {
            try {
                header('location: ' . BASE_URL . "admin/anh_loai_phong/list.php?msg=Hình ảnh này không tồn tại !");      
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location: ' . BASE_URL . "admin/website/list.php?msg=Hình ảnh này không tồn tại !");      
    }

    $sqls = "select * from loai_phong"; 
    $lp = select_all($sqls) ; 
    require_once APP_PATH."/admin/layout/layout.php" ; 
    
?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Sửa hình ảnh loại phòng</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/anh_loai_phong/post-sua.php" method="POST"
            enctype="multipart/form-data">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Hình ảnh mới: </label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="file" placeholder="Hình ảnh" name="hinh" class="form-control">
                        <?php if(isset($_GET['hinherr'])):?>
                        <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên loại phòng mới:</label>
                        <select name="ma_loai_phong" class="form-control">
                            <?php foreach ($lp as $key ) { ?>
                            <option <?php if($key['id'] == $tt['ma_loai_phong']) : ?> selected <?php endif ?>
                                value="<?php echo $key['id'] ?>">
                                <?php echo $key['ten_loai'] ?>
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