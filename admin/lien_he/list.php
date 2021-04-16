<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    
    $sql = "select * from lien_he" ; 
    $lh = select_all($sql) ; 
  

?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Danh sách liên hệ của khách sạn</h2>
    </div>
</div>

<?php if(isset($_GET['msg'])) : ?>
<p style="color: #AA0000; margin-left: 20px; font-weight: bold;"><?= $_GET['msg'] ?></p>
<?php endif ?>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-12">
            <table class="table table-hover" style="font-size: 13px; border: 1px solid #dedede;">
                <thead style="background-color: #2D3035;">
                    <th>TÊN</th>
                    <th>SĐT</th>
                    <th>TT</th>
                    <th width="350">ND</th>
                    <th>TT</th>
                    <th>EMAIL</th>
                    <th width="90">QL</th>
                </thead>

                <tbody>
                    <?php foreach ($lh as $key) { ?>
                    <tr>
                        <td><?php echo $key['ho_ten']?></td>
                        <td><?php echo $key['sdt']?></td>
                        <td><?php echo $key['tieu_de']?></td>
                        <td><?php echo $key['noi_dung']?></td>
                        <td>
                            <?php if ($key['trang_thai'] == "0") {
                                            echo "Chưa trả lời";
                                        } else {
                                            echo "Đã trả lời";
                                        } 
                            ?>
                        </td>
                        <td><?php echo $key['email']?></td>

                        <td>
                            <a href="<?php echo BASE_URL?>admin/lien_he/tl.php?id=<?= $key['id'] ?>"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-reply-all" aria-hidden="true"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại hàng này không ?')"
                                href="<?php echo BASE_URL?>admin/lien_he/xoa.php?id=<?= $key['id'] ?>"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>