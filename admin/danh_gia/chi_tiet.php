<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

      $ma_loai_phong = isset($_GET['ma_loai_phong']) ? $_GET['ma_loai_phong'] : "" ; 

      $sql = "SELECT
                    d.id AS 'id_dg',
                    d.ma_loai_phong,
                    d.trang_thai,
                    lp.hinh,
                    lp.ten_loai,
                    d.so_sao,
                    d.noi_dung,
                    d.ngay_danh_gia,
                    K.id,
                    k.ho_ten
                FROM
                    danh_gia d
                JOIN users k ON
                    d.ma_nguoi_danh_gia = k.id
                JOIN loai_phong lp ON
                    d.ma_loai_phong = lp.id
                WHERE
                    d.ma_loai_phong = '$ma_loai_phong';" ; 

                $tt = select_all($sql) ; 


    require_once APP_PATH."/admin/layout/layout.php" ; 


?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Chi tiết đánh giá</h2>
    </div>
</div>

<?php if(isset($_GET['msg'])) : ?>
<p style="color: #AA0000; margin-left: 20px; font-weight: bold;"><?= $_GET['msg'] ?></p>
<?php endif ?>

<div class="conten"
    style="margin: 30px 20px 30px 20px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); background-color: #FAFAFA;">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-12">
            <table class="table table-hover" style="font-size: 13px; border: 1px solid gray;">
                <thead style="background-color: #2D3035;">
                    <th>ID ĐG</th>
                    <th>PHÒNG</th>
                    <th>HÌNH</th>
                    <th width="100">SAO</th>
                    <th width="330">ND</th>
                    <th>TT</th>
                    <th>NGÀY</th>
                    <th>TÊN</th>
                    <th width="50">QL</th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td><?php echo $key['id_dg'] ?></td>
                        <td><?php echo $key['ten_loai'] ?></td>

                        <td>
                            <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="100" height="60"
                                alt="">
                        </td>
                        <td>
                            <?php
                                if ($key['so_sao'] == "4") {
                                            echo "
                                                <div class='star-danh-gia'>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                                    <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                                </div>
                                            ";
                                } else if($key['so_sao'] == "5"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($key['so_sao'] == "3"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($key['so_sao'] == "2"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else if($key['so_sao'] == "1"){
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    
                                       " ; 
                                }else{
                                    echo "
                                        <div class='star-danh-gia'>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                            <i class='fa fa-star-o' aria-hidden='true' style='color: #CCA772;'></i>
                                        </div>
                                    " ; 
                                }
                            ?>
                        </td>
                        <td><?php echo $key['noi_dung'] ?></td>
                        <td>
                            <?php if ($key['trang_thai'] == "0") {
                                    echo "Chưa trả lời";
                              } else {
                                    echo "Đã trả lời";
                              } 
                            ?>
                        </td>
                        <td><?php echo $key['ngay_danh_gia'] ?></td>
                        <td><?php echo $key['ho_ten'] ?></td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại hàng này không ?')"
                                href="<?php echo BASE_URL?>admin/danh_gia/xoa.php?id=<?= $key['id_dg'] ?>"
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
                            <a href="<?php echo BASE_URL?>admin/danh_gia/list.php" class="btn btn-info btn-sm">
                                Quay lại danh sách danh_gia
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>