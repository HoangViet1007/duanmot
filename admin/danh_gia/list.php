<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    
   
    $sql = "SELECT 
            d.id , 
            lp.id as 'ma_lp',
            lp.hinh as 'hinh_lp',
            count(d.id) as 'so_dg',
            max(d.ngay_danh_gia) as 'max' ,
            min(d.ngay_danh_gia) as 'min'
            from danh_gia as d join loai_phong as lp on d.ma_loai_phong = lp.id
            group by lp.id" ;
    $tt = select_all($sql) ; 
  

?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Danh sách đánh giá</h2>
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
                    <th>SỐ ĐÁNH GIÁ</th>
                    <th>ĐÁNH GIÁ CŨ NHẤT</th>
                    <th>ĐÁNH GIÁ MỚI NHẤT</th>
                    <th width="150">QUẢN LÍ</th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td>
                        <img src="<?php echo BASE_URL. $key['hinh_lp'] ?>" class="img-fluid" width="100" height="60"
                                alt="">
                        </td>
                        <td><?php echo $key['so_dg'] ?></td>
                        <td><?php echo $key['min'] ?></td>
                        <td><?php echo $key['max'] ?></td>
                        <td>
                            <a href="<?php echo BASE_URL?>admin/danh_gia/chi_tiet.php?ma_loai_phong=<?= $key['ma_lp'] ?>"
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