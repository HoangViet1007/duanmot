<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;
    
    if (!isset($_GET['product'])) {
        $product = 1;
    } else {
        $product = $_GET['product'];
        if (!is_numeric($product) || $product <= 0) {
            header("Location:" . BASE_URL);
        }
    }
    $data = 6;
    $sql = "SELECT count(*) FROM `orders`";
    $conn = connect();
    $result = $conn->prepare($sql);
    $result->execute();
    $number = $result->fetchColumn();
    $page = ceil($number / $data);
    $tin = ($product - 1) * $data;
    
   $sql = "SELECT
                h.id as 'id_hd',
                d.ten_nguoi_dat,
                d.sdt,
                d.ngay_den,
                d.ngay_di,
                d.ma_loai_phong,
                h.thue_VAT,
                h.tong_tien,
                h.ngay_tao,
                h.ma_dat_phong
                FROM
                orders AS h
                JOIN dat_phong AS d
                ON
                h.ma_dat_phong = d.id LIMIT $tin , $data" ; 
   $tt = select_all($sql) ; 
    
  

?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Danh sách hóa đơn</h2>
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
                    <th>CHECK-IN</th>
                    <th>CHECK-OUT</th>
                    <th>MÃ LP</th>
                    <th>VAT</th>
                    <th>TT</th>
                    <th>MÃ ĐP</th>
                    <th>QUẢN LÍ</th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td><?php echo $key['ten_nguoi_dat'] ?></td>
                        <td><?php echo $key['sdt'] ?></td>
                        <td><?php echo $key['ngay_den'] ?></td>
                        <td><?php echo $key['ngay_di'] ?></td>
                        <td><?php echo $key['ma_loai_phong'] ?></td>
                        <td><?php echo $key['thue_VAT'] ?></td>
                        <td><?php echo $key['tong_tien'] ?></td>
                        <td><?php echo $key['ma_dat_phong'] ?></td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn đặt phòng này không ?')"
                                href="<?php echo BASE_URL?>admin/hoa_don/xoa.php?id=<?= $key['id_hd'] ?>"
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
    <!-- <a href="<?php echo BASE_URL ?>admin/dat_phong/check_in.php?id=<?= $key['id'] ?>&ma_loai_phong=<?= $key['ma_loai_phong'] ?>"></a> -->
    <div class="row" style="margin-top: 30px;margin-left: 0px;">
    <?php
                                        for ($t = 1; $t <= $page; $t++) { ?>
            &nbsp;<a name="" id="" class="btn btn-secondary" href="<?php echo BASE_URL ?>admin/hoa_don/list.php?product=<?= $t ?>" role="button">
                <?= $t ?></a>
            <?php
                }
                ?>
    </div>
</div>