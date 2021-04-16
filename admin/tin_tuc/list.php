<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    $sql = "select * from tin_tuc" ; 
    $tt = select_all($sql) ; 


?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Danh sách ảnh slide</h2>
    </div>
</div>

<?php if(isset($_GET['msg'])) : ?>
<p style="color: #AA0000; margin-left: 20px; font-weight: bold;"><?= $_GET['msg'] ?></p>
<?php endif ?>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-12">
            <table class="table" style="font-size: 13px; border: 1px solid #dedede;">
                <thead style="background-color: #2D3035;">
                    <th>TĐ</th>
                    <th>HÌNH</th>
                    <th>ND</th>
                    <th>TT</th>
                    <th width="100">QUẢN LÍ</th>
                    <th width="120">
                        <a href="<?= BASE_URL?>admin/tin_tuc/them.php" class="btn btn-info"
                            style="background-color: #2D3035;">
                            Tạo mới
                        </a>
                    </th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td><?php echo $key['tieu_de'] ?></td>
                        <td>
                            <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="100" height="60"
                                    alt="">
                        </td>
                        <td><?php echo $key['noi_dung'] ?></td>
                        <td>
                            <?php 
                               if($key['trang_thai'] == 0){
                                   echo "Không kích hoạt" ; 
                               }else{
                                   echo "Kích hoạt" ; 
                               }
                            
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo BASE_URL?>admin/tin_tuc/sua.php?id=<?= $key['id'] ?>"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại hàng này không ?')"
                                href="<?php echo BASE_URL?>admin/tin_tuc/xoa.php?id=<?= $key['id'] ?>"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>