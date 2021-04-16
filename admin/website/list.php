<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    $sql = "select * from thong_tin_website" ; 
    $tt = select_all($sql) ; 


?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Danh sách thông tin website</h2>
    </div>
</div>

<?php if(isset($_GET['msg'])) : ?>
<p style="color: #AA0000; margin-left: 20px; font-weight: bold;"><?= $_GET['msg'] ?></p>
<?php endif ?>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">

    <table class="table table-hover" style="font-size: 13px; border: 1px solid #dedede;">
        <thead style="background-color: #2D3035;">
            <th>TÊN</th>
            <th>LOGO</th>
            <th>SỐ ĐIỆN THOẠI</th>
            <th>ĐỊA CHỈ</th>
            <th>EMAIL</th>
            <th>QUẢN LÍ</th>

        </thead>

        <tbody>
            <?php foreach ($tt as $key) { ?>
            <tr>
                <td><?php echo $key['ten_web']?></td>
                <td>
                    <img src="<?php echo BASE_URL. $key['logo'] ?>" class="img-fluid" width="60" height="40" alt="">
                </td>
                <td><?php echo $key['sdt']?></td>
                <td><?php echo $key['dia_chi']?></td>
                <td><?php echo $key['email']?></td>
                <td>
                    <a href="<?php echo BASE_URL?>admin/website/sua.php?id=<?= $key['id'] ?>"
                        class="btn btn-info btn-sm">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại hàng này không ?')"
                        href="<?php echo BASE_URL?>admin/website/xoa.php?id=<?= $key['id'] ?>"
                        class="btn btn-danger btn-sm">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>

            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="12">
                    <a href="<?= BASE_URL?>admin/website/them.php" class="btn btn-info"
                        style="background-color: #2D3035;">
                        Tạo mới
                    </a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>