<?php
  require_once "../../config.php" ; 
  require_once APP_PATH."/dao/pdo.php" ; 

// lấy id xuống và fill dữ liệu cũ      

// lấy id cần sửa trên đường dẫn xuống 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "select * from lien_he where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $tt = select_one($sql) ; 
        } else {
            try {
                header('location: ' . BASE_URL . "admin/lien_he/list.php?msg=Liên hệ này không tồn tại !");      
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location: ' . BASE_URL . "admin/lien_he/list.php?msg=Liên hệ này không tồn tại !");      
    }

    // select và lấy za dữ liệu 
    $sql = "SELECT * FROM lien_he where id = '$id'" ; 
    $tt = select_one($sql) ; 


    require_once APP_PATH."/admin/layout/layout.php" ; 
?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Trả lời liên hệ của khách hàng</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/lien_he/send-email-tl.php" method="POST" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Email của khách hàng : </label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">                  
                        <input type="email" placeholder="Email" name="email" class="form-control" value="<?php echo $tt['email'] ?>" readonly>
                        <?php if(isset($_GET['hinherr'])):?>
                        <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tiêu đề : </label>
                        <input type="text" placeholder="Tiêu đề" name="tieu_de" class="form-control" value="Thư trả lời từ khách sạn Marvella" readonly>
                        <?php if(isset($_GET['tieu_deerr'])):?>
                        <span class="text-danger"><?php echo $_GET['tieu_deerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>

            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nội dung : </label>
                        <textarea name="noi_dung" id="" cols="102" rows="3" placeholder="Nội dung"></textarea>
                        <?php if(isset($_GET['noi_dungerr'])):?>
                        <span class="text-danger"><?php echo $_GET['noi_dungerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info mr-1" name="addPro">Lưu</button>
                <a href="<?php echo BASE_URL ?>admin/lien_he/list.php" class="btn btn-danger ml-1">Hủy</a>
            </div>
        </form>
    </div>
</div>