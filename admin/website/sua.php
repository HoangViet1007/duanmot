<?php
      require_once "../../config.php" ; 
      require_once APP_PATH."/dao/pdo.php" ; 

      // lấy id xuống và fill dữ liệu cũ      

    // lấy id cần sửa trên đường dẫn xuống 
     if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "select * from thong_tin_website where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $tt = select_one($sql) ; 
        } else {
            try {
                header('location: ' . BASE_URL . "admin/website/list.php?msg=Thông tin này không tồn tại !");      
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location: ' . BASE_URL . "admin/website/list.php?msg=Thông tin này không tồn tại !");      
    }


    require_once APP_PATH."/admin/layout/layout.php" ; 
    
?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Sửa thông tin website</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/website/post-sua.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên website mới</label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" placeholder="Tên website" class="form-control" name="ten_web" value="<?php echo $tt['ten_web'] ?>">
                        <?php if(isset($_GET['ten_weberr'])):?>
                            <span class="text-danger"><?php echo $_GET['ten_weberr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Logo mới</label>
                        <input type="file" placeholder="Logo" class="form-control" name="logo">
                        <?php if(isset($_GET['logoerr'])):?>
                            <span class="text-danger"><?php echo $_GET['logoerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Số điện thoại mới</label>
                        <input type="text" placeholder="Số điện thoại" class="form-control" name="sdt" value="<?php echo $tt['sdt'] ?>">
                        <?php if(isset($_GET['sdterr'])):?>
                            <span class="text-danger"><?php echo $_GET['sdterr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Địa chỉ mới</label>
                        <input type="text" placeholder="Địa chỉ" class="form-control" name="dia_chi" value="<?php echo $tt['dia_chi'] ?>">
                        <?php if(isset($_GET['dia_chierr'])):?>
                            <span class="text-danger"><?php echo $_GET['dia_chierr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Email mới</label>
                        <input type="text" placeholder="Email" class="form-control" name="email" value="<?php echo $tt['email'] ?>">
                        <?php if(isset($_GET['emailerr'])):?>
                            <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="">Map url mới</label>
                        <input type="text" placeholder="Map url" class="form-control" name="map_url" value="<?php echo $tt['map_url'] ?>">
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