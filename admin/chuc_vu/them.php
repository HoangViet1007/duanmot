<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 


?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Thêm mới chức vụ</h2>
    </div>
</div>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="box" style="border: 2px solid gray; padding: 20px;">
        <form action="<?php echo BASE_URL ?>admin/chuc_vu/post-them.php" method="POST" enctype="multipart/form-data">
           <div class="row d-flex justify-content-center align-items-center">
               <div class="col-md-8">
                   <div class="form-group">
                       <label for="">Tên chức vụ : </label>
                       <input type="text" placeholder="Tên chức vụ" name="ten_vai_tro" class="form-control">
                       <?php if(isset($_GET['ten_vai_troerr'])):?>
                            <span class="text-danger"><?php echo $_GET['ten_vai_troerr'] ?></span>
                        <?php endif ?>
                   </div>
               </div>
           </div>

            <div class="row d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info mr-1" name="addPro">Lưu</button>
                <a href="<?php echo BASE_URL ?>admin/chuc_vu/list.php" class="btn btn-danger ml-1">Hủy</a>
            </div>
        </form>
    </div>
</div>