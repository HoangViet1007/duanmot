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
    $sql = "SELECT count(*) FROM `dat_phong`";
    $conn = connect();
    $result = $conn->prepare($sql);
    $result->execute();
    $number = $result->fetchColumn();
    $page = ceil($number / $data);
    $tin = ($product - 1) * $data;
    
   $sql = "SELECT 
                d.id ,
                d.ten_nguoi_dat,
                d.sdt,
                d.email,
                d.ngay_tao,
                d.ngay_den,
                d.ngay_di,
                d.trang_thai,
                d.ma_loai_phong,
                l.ten_loai,
                l.don_gia as 'gia'
                from dat_phong as d join loai_phong as l on d.ma_loai_phong = l.id LIMIT $tin , $data " ; 
   $tt = select_all($sql) ; 
    
  

?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Danh sách đặt phòng</h2>
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
                    <th style="display: none;">EMAIL</th>
                    <th>NGÀY TẠO</th>
                    <th>CHECK-IN</th>
                    <th>CHECK-OUT</th>
                    <th>TT</th>
                    <th width="100">TÊN LP</th>
                    <th>GIÁ</th>
                    <th width="130">HOẠT ĐỘNG</th>
                    <th width='100'>QL</th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td>
                        <!-- <img src="<?php echo BASE_URL. $key['hinh_lp'] ?>" class="img-fluid" width="100" height="60"
                                alt=""> --><?php echo $key['ten_nguoi_dat'] ?>
                        </td>
                        <td><?php echo $key['sdt'] ?></td>
                        <td style="display: none;"><?php echo $key['email'] ?></td>
                        <td><?php echo $key['ngay_tao'] ?></td>
                        <td><?php echo $key['ngay_den'] ?></td>
                        <td><?php echo $key['ngay_di'] ?></td>
                        <td>
                            <?php 
                                    if ($key['trang_thai'] == "0"){
                                        echo "Đặt phòng" ; 
                                    }
                                    elseif ($key['trang_thai'] == "1"){
                                        echo " Đã Check-in" ; 
                                    }else{
                                        echo " Đã Check-out" ; 
                                    }
                                
                                ?>
                        </td>
                        <td><?php echo $key['ten_loai'] ?></td>
                        <td><?php echo $key['gia'] ?></td>
                        <td>
                            <?php 
                                if ($key['trang_thai'] == "0"){ ?>
                                        <a href='<?php echo BASE_URL ?>admin/dat_phong/check_in.php?id=<?= $key['id'] ?>&ma_loai_phong=<?= $key['ma_loai_phong'] ?>' class='btn btn-info'>Check-in</a>
                                
                               <?php } else if ($key['trang_thai'] == "1"){ ?> 
                                    <a href='<?php echo BASE_URL ?>admin/dat_phong/check_out.php?id=<?= $key['id'] ?>&ma_loai_phong=<?= $key['ma_loai_phong'] ?>' class='btn btn-danger'>Check-out</a>
                                <?php } ?>
                            
                        </td>

                        <td>
                        <a href="<?php echo BASE_URL?>admin/dat_phong/sua.php?id=<?= $key['id'] ?>"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn đặt phòng này không ?')"
                                href="<?php echo BASE_URL?>admin/dat_phong/xoa.php?id=<?= $key['id'] ?>"
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
    <div class="row" style="margin-top: 30px;margin-left: 0px;">
    <?php
                                        for ($t = 1; $t <= $page; $t++) { ?>
            &nbsp;<a name="" id="" class="btn btn-secondary" href="<?php echo BASE_URL ?>admin/dat_phong/list.php?product=<?= $t ?>" role="button">
                <?= $t ?></a>
            <?php
                }
                ?>
    </div>
   
    <!-- <a href="<?php echo BASE_URL ?>admin/dat_phong/check_in.php?id=<?= $key['id'] ?>&ma_loai_phong=<?= $key['ma_loai_phong'] ?>"></a> -->
</div>
