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
    $sql = "SELECT count(*) FROM `loai_phong`";
    $conn = connect();
    $result = $conn->prepare($sql);
    $result->execute();
    $number = $result->fetchColumn();
    $page = ceil($number / $data);
    $tin = ($product - 1) * $data;

    $sql = "select * from loai_phong LIMIT $tin , $data" ; 
    $tt = select_all($sql) ; 


?>
<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Danh sách loại phòng của website</h2>
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
                    <th>HÌNH ẢNH</th>
                    <th>SỐ LƯỢNG</th>
                    <th>CHECK IN </th>
                    <th>PHÒNG TRỐNG</th>
                    <th>GIÁ</th>
                    <th>KIỂU</th>
                    <th width="150" style="display: none;">GIỚI THIỆU</th>
                    <th width="150" style="display: none;">MÔ TẢ</th>
                    <th width="100">QUẢN LÍ</th>
                    <th width="110">
                        <a href="<?= BASE_URL?>admin/loai_phong/them.php" class="btn btn-info"
                            style="background-color: #2D3035;">
                            Tạo mới
                        </a>
                    </th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td><?php echo $key['ten_loai']?></td>
                        <td>
                            <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="60" height="40"
                                alt="">
                        </td>
                        <td><?php echo $key['so_luong_phong']?></td>
                        <!-- <td>
                            <?php 
                                if ($key['trang_thai'] == "1"){
                                    echo "Hết phòng" ; 
                                }else{
                                    echo "Còn phòng" ; 
                                }
                              
                            ?>
                        </td> -->
                        <td><?php echo $key['so_phong_da_dat']?></td>
                        <td><?php echo $key['so_phong_trong']?></td>
                        <td><?php echo $key['don_gia']?></td>
                        <td>
                            <?php
                             if ($key['dac_biet'] == "1") {
                                    echo "Bình thường";
                                } else {
                                    echo "Đặc biệt";
                                } 
                            ?>
                        </td>
                        <td style="display: none;"><?php echo $key['gioi_thieu']?></td>
                        <td style="display: none;"><?php echo $key['mo_ta']?></td>

                        <td>
                            <a href="<?php echo BASE_URL?>admin/loai_phong/sua.php?id=<?= $key['id'] ?>"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại hàng này không ?')"
                                href="<?php echo BASE_URL?>admin/loai_phong/xoa.php?id=<?= $key['id'] ?>"
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

    <div class="row" style="margin-top: 30px;margin-left: 0px;">
    <?php
                                        for ($t = 1; $t <= $page; $t++) { ?>
            &nbsp;<a name="" id="" class="btn btn-secondary" href="<?php echo BASE_URL ?>admin/loai_phong/list.php?product=<?= $t ?>" role="button">
                <?= $t ?></a>
            <?php
                }
                ?>
    </div>
   
</div>