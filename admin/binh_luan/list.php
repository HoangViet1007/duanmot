<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    
   
    $sql = "SELECT 
            b.id , 
            t.id as 'ma_tt',
            t.hinh as 'hinh_blog',
            count(b.id) as 'so_bl',
            max(b.ngay_binh_luan) as 'max' ,
            min(b.ngay_binh_luan) as 'min'
            from binh_luan as b join tin_tuc as t on b.ma_tin_tuc = t.id
            group by t.id" ;
    $tt = select_all($sql) ; 
  

?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Danh sách bình luận</h2>
    </div>
</div>

<?php if(isset($_GET['msg'])) : ?>
<p style="color: #AA0000; margin-left: 20px; font-weight: bold;"><?= $_GET['msg'] ?></p>
<?php endif ?>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-10">
            <table class="table table-hover" style="font-size: 13px; border: 1px solid #dedede;">
                <thead style="background-color: #2D3035;">
                    <th>HÌNH ẢNH</th>
                    <th>SỐ BÌNH LUẬN</th>
                    <th>BÌNH LUẬN CŨ NHẤT</th>
                    <th>BÌNH LUẬN MỚI NHẤT</th>
                    <th width="150">QUẢN LÍ</th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td>
                        <img src="<?php echo BASE_URL. $key['hinh_blog'] ?>" class="img-fluid" width="100" height="60"
                                alt="">
                        </td>
                        <td><?php echo $key['so_bl'] ?></td>
                        <td><?php echo $key['min'] ?></td>
                        <td><?php echo $key['max'] ?></td>
                        <td>
                            <a href="<?php echo BASE_URL?>admin/binh_luan/chi_tiet.php?ma_tin_tuc=<?= $key['ma_tt'] ?>"
                                class="btn btn-info btn-sm">
                                Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>