<?php
    require_once "../../config.php" ; 
      require_once APP_PATH."/dao/pdo.php" ; 

    // lấy id xuống và fill dữ liệu cũ      

    // lấy id cần sửa trên đường dẫn xuống 
//      if (isset($_GET['id'])) {
//         $id = $_GET['id'];
//         $sql = "select * from slide_anh where id = '$id'" ; 
//         // kiểm tra xem trong date base có sp này ko 
//         $cout = connect()->prepare($sql);
//         $cout->execute();
//         if ($cout->rowCount() > 0) {
//             $tt = select_one($sql) ; 
//         } else {
//             try {
//                 header('location: ' . BASE_URL . "admin/slide_anh/list.php?msg=Ảnh này không tồn tại !");      
//             } catch (PDOException $e) {
//                 echo $e->getMessage();
//             }
//         }
//     }else{
//         header('location: ' . BASE_URL . "admin/website/list.php?msg=Ảnh này không tồn tại !");      
//     }

      // lấy mã blog 
      $ma_tin_tuc = isset($_GET['ma_tin_tuc']) ? $_GET['ma_tin_tuc'] : "" ; 

      $sql = "SELECT
                b.id as 'id_bl',
                b.ma_tin_tuc,
                b.trang_thai,
                h.hinh,
                b.noi_dung,
                b.ngay_binh_luan,
                K.id,
                k.ho_ten
                from binh_luan b join users k on b.ma_nguoi_binh_luan = k.id
                                 join tin_tuc h on b.ma_tin_tuc = h.id 
                where b.ma_tin_tuc = '$ma_tin_tuc' ; " ; 

                $tt = select_all($sql) ; 


    require_once APP_PATH."/admin/layout/layout.php" ; 


?>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Chi tiết bình luận</h2>
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
                    <th>ID BL</th>
                    <th>ID TT</th>
                    <th>HÌNH</th>
                    <th width="380">ND</th>
                    <th>TT</th>
                    <th>NGÀY</th>
                    <th>TÊN</th>
                    <th width="50">QL</th>
                </thead>

                <tbody>
                    <?php foreach ($tt as $key) { ?>
                    <tr>
                        <td><?php echo $key['id_bl'] ?></td>
                        <td><?php echo $key['ma_tin_tuc'] ?></td>

                        <td>
                            <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="100" height="60"
                                alt="">
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
                        <td><?php echo $key['ngay_binh_luan'] ?></td>
                        <td><?php echo $key['ho_ten'] ?></td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại hàng này không ?')"
                                href="<?php echo BASE_URL?>admin/binh_luan/xoa.php?id=<?= $key['id_bl'] ?>"
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
                            <a href="<?php echo BASE_URL?>admin/binh_luan/list.php" class="btn btn-info btn-sm">
                                Quay lại danh sách bính luận
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>