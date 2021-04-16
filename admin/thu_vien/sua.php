<?php
      require_once "../../config.php" ; 
      require_once APP_PATH."/dao/pdo.php" ; 

    // lấy id xuống và fill dữ liệu cũ      

    // lấy id cần sửa trên đường dẫn xuống 
     if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "select * from hinh_anh_khach_san where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $tt = select_one($sql) ; 
        } else {
            try {
                header('location: ' . BASE_URL . "admin/thu_vien/list.php?msg=Thư viện hình ảnh này không tồn tại !");      
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location: ' . BASE_URL . "admin/thu_vien/list.php?msg=Thư viện hình ảnh này không tồn tại !");      
    }


    require_once APP_PATH."/admin/layout/layout.php" ; 

?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Sửa thư viện ảnh</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/thu_vien/post-sua.php" method="POST" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Tên thư viện : </label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" placeholder="Tên thư viện" name="ten" class="form-control" value="<?php echo $tt['ten'] ?>">
                        <?php if(isset($_GET['tenerr'])):?>
                        <span class="text-danger"><?php echo $_GET['tenerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Đường dẫn :</label>
                        <input type="text" placeholder="Đường dẫn" name="duong_dan" class="form-control" value="<?php echo $tt['duong_dan'] ?>">
                        <?php if(isset($_GET['duong_danerr'])):?>
                        <span class="text-danger"><?php echo $_GET['duong_danerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Hình ảnh :</label>
                        <input type="file" placeholder="Hình ảnh" name="hinh" class="form-control" value="<?php echo $tt['hinh'] ?>">
                        <?php if(isset($_GET['hinherr'])):?>
                        <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info mr-1" name="addPro">Lưu</button>
                <a href="<?php echo BASE_URL ?>admin/thu_vien/list.php" class="btn btn-danger ml-1">Hủy</a>
            </div>
        </form>
    </div>
</div>