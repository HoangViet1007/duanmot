<?php
    require_once "../header-small.php" ; 
    


?>
<style>
    .for input{
        border-radius: 0%;
    }
</style>
<div class="type" style="height: 70px; background-color: #CCA772; margin-top: 20px;">
    <h3 style="color: white; text-align: center; text-transform: uppercase; padding-top: 15px;">FORGOT PASSWORD</h3>
</div>

<div class="container for" style="margin-top: 50px; background-color: #FAFAFA;padding-top: 40px; padding-bottom: 40px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1); margin-bottom: 50px;">
    <?php if(isset($_GET['msg'])) { ?>
        <span style="margin-left:410px; " class="text-danger mb-3"><?= $_GET['msg'] ?></span>
    <?php } ?>
    <form action="<?php echo BASE_URL ?>tai_khoan/post-forgot.php" method="POST" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" style="font-weight: bold;color: gray;">Username : </label>
                    <input type="text" placeholder="Username" name="id" class="form-control"
                        value="">
                    <?php if(isset($_GET['iderr'])):?>
                    <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                    <?php endif ?>
                </div>
               
                <div class="form-group">
                    <label for="" style="font-weight: bold; color: gray;">Email : </label>
                    <input type="text" placeholder="Email" name="email" class="form-control"
                        value="">
                    <?php if(isset($_GET['emailerr'])):?>
                        <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                    <?php endif ?>
                </div>

            </div>
        </div>


        <div class="row d-flex justify-content-center align-items-center">
        <button type="submit" class="btn btn-info mr-1" name="addPro" style="background-color: #CCA772; color: white; border-radius: 0%; width: 100px; border: none;">Lưu</button>
            <a href="<?php echo BASE_URL ?>" class="btn btn-danger ml-1" style="background-color: #CCA772; color: white; border-radius: 0%; width: 100px; border: none;">Hủy</a>
        </div>
    </form>
</div>


<?php require_once "../footer.php" ?>
