<?php
     require_once "../header-small.php" ; 
     $value  = "" ; 
     if(isset($_SESSION['khach_hang'])) {
       $value = $_SESSION['khach_hang']['id'] ; 
    } elseif(isset($_SESSION['admin'])){ 
      $value = $_SESSION['admin']['id'] ; 
    } 

?>
<style>

</style>
<div class="type" style="height: 70px; background-color: #CCA772; margin-top: 20px;">
    <h3 style="color: white; text-align: center; text-transform: uppercase; padding-top: 15px;">Change Password</h3>
</div>

<div class="container-fluid">
    <div class="container"
        style="margin-top: 50px; background-color: #FAFAFA;padding-top: 40px; padding-bottom: 40px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); margin-bottom: 50px;">

         <?php if(isset($_GET['msg'])) { ?>
            <span style="margin-left:470px; " class="text-danger mb-3"><?= $_GET['msg'] ?></span>
        <?php } ?>
        <form action="<?php echo BASE_URL ?>tai_khoan/post_edit_password.php?id=<?php echo $value ?>" method="POST"
            enctype="multipart/form-data">
        
            <div class="row d-flex justify-content-center align-content-center mb-3">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" style="font-weight: 600; color: gray;">Username :</label>
                        <input type="text" name="id" placeholder="Username" disabled class="form-control"
                            style="border-radius: 0%;" value="<?php echo $value ?>">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" style="font-weight: 600; color: gray;">Old password :</label>
                        <input type="text" placeholder="Old password" class="form-control"
                            style="border-radius: 0%;" name="mat_khau">
                        <?php if(isset($_GET['mat_khauerr'])) : ?>
                        <span class="text-danger"> <?= $_GET['mat_khauerr'] ?> </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row d-flex justify-content-center align-content-center">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" style="font-weight: 600; color: gray;">A new password :</label>
                        <input type="text" placeholder="A new password" class="form-control"
                            style="border-radius: 0%;" name="new_mat_khau">
                        <?php if(isset($_GET['new_mat_khauerr'])) : ?>
                        <span class="text-danger"> <?= $_GET['new_mat_khauerr'] ?> </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" style="font-weight: 600; color: gray;">Enter the password :</label>
                        <input type="text" placeholder="Enter the password" class="form-control"
                            style="border-radius: 0%;" name="cf_mat_khau">
                        <?php if(isset($_GET['cf_mat_khauerr'])) : ?>
                        <span class="text-danger"> <?= $_GET['cf_mat_khauerr'] ?> </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row d-flex justify-content-center align-items-center mt-3">
                <button type="submit" class="btn btn-info mr-1 ml-1" name="addPro"
                    style="background-color: #CCA772; color: white; border-radius: 0%; border: none; width: 100px;">Lưu</button>
                <a href="<?php echo BASE_URL ?>" class="btn btn-danger ml-1"
                    style="background-color: #CCA772; color: white; border-radius: 0%; border: none; width: 100px;">Hủy</a>
            </div>

        </form>
    </div>
</div>
<?php require_once "../footer.php" ?>