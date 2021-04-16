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
    $data = 3;
    $sql = "SELECT count(*) FROM `users`";
    $conn = connect();
    $result = $conn->prepare($sql);
    $result->execute();
    $number = $result->fetchColumn();
    $page = ceil($number / $data);
    $tin = ($product - 1) * $data;

    $sql = "SELECT 
                  users.id ,
                  users.ho_ten,
                  users.hinh,
                  users.email,
                  users.so_chung_minh,
                  users.sdt,
                  vai_tro.ten_vai_tro as vt 
                  from users join vai_tro on users.ma_vai_tro = vai_tro.id LIMIT $tin , $data" ; 
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
                    <th>TĐN</th>
                    <th>HỌ TÊN</th>
                    <th>HÌNH</th>
                    <th>EMAIL</th>
                    <th>CMT</th>
                    <th>SĐT</th>
                    <th>VT</th>
                    <th width="100">QUẢN LÍ</th>
                    <th width="110">
                        <a href="<?= BASE_URL?>admin/users/them.php" class="btn btn-info"
                            style="background-color: #2D3035;">
                            Tạo mới
                        </a>
                    </th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td><?php echo $key['id']?></td>
                        <td><?php echo $key['ho_ten']?></td>
                        <td>
                            <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="60" height="30"
                                alt="">
                        </td>
                        <td><?php echo $key['email']?></td>
                        <td><?php echo $key['so_chung_minh']?></td>
                        <td><?php echo $key['sdt']?></td>
                        <td><?php echo $key['vt']?></td>
                      
                        <td>
                            <a href="<?php echo BASE_URL?>admin/users/sua.php?id=<?= $key['id'] ?>"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại hàng này không ?')"
                                href="<?php echo BASE_URL?>admin/users/xoa.php?id=<?= $key['id'] ?>"
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
            &nbsp;<a name="" id="" class="btn btn-secondary" href="<?php echo BASE_URL ?>admin/users/list.php?product=<?= $t ?>" role="button">
                <?= $t ?></a>
            <?php
                }
                ?>
    </div>
</div>