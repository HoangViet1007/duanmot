<?php
 require_once "./header-small.php" ; 

?>

<style>
.type {
    text-align: center;
    padding-top: 10px;
    margin-top: 50px;
    margin-left: -10px;
}

.type h1 {
    color: white;
    text-shadow: black 0.1em 0.1em 0.2em;

}

.form-contact input {
    height: 52px;
    width: 340px;
    border-radius: 1px;
    border: 1px solid #dedede;
    background-color: #fcfcfc;
}

.abc input {
    border-radius: 1px;
    border: 1px solid #dedede;
    background-color: #fcfcfc;
}

.check-accept {
    margin-top: 50px;
}

.check-accept span {
    margin-left: 15px;
}

.send button {
    height: 43px;
    width: 228px;
    background-color: #CCA772;
    color: white;
    border: none;
    margin-left: 15px;
    margin-top: 20px;
}

.iconn {
    margin-left: 5px;
    margin-top: 10px;
}

.iconn a {
    border: 1px solid rgb(191, 188, 188);
    display: inline-block;
    height: 30px;
    width: 30px;
    border-radius: 1px;
    margin-right: 22px;
    text-align: center;
    background-color: white;
}

.iconn .facebook {
    color: #3b5998;
}

.iconn .twitter {
    color: #4099FF;
}

.iconn .pinterest {
    color: #cb2027;
}

.iconn .linkedin {
    color: #007bb6;
}

.iconn .youtube {
    color: #b00;
}

.iconn .instagram {
    color: #125688;
}

.iconn a:hover {
    background-color: rgb(196, 170, 170);
}
</style>

<!-- <div class="type" style="height: 70px; background-color: #CCA772;">
    <h1>Contact Us</h1>
</div> -->
<div class="page-title " style="background: rgb(245, 243, 240); margin-top: 0px;">
    <div class="container">
        <div class="inner">
            <h1>CONTACT</h1>
            <ul id="" class="breadcrumb">
                <li class="item"><a href="<?php echo BASE_URL ?>">Home </a></li>
                <li class="item-current item">Contact</li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid"
    style="margin-top: 40px; padding: 1px 1px; background-color: #F1F0ED; padding-bottom: 40px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <?php if(isset($_GET['msg'])) { ?>
                       <p style="color: red;padding-top: 20px; margin-left: 290px;">
                            <?php echo $_GET['msg'] ?>
                       </p>
                  <?php } ?>
                <form action="contact-send-email.php" method="POST" enctype="multipart/form-data">
                    <div class="row mt-5">
                        <div class="col-md-4 ">
                            <div class="form-contact ">
                                <input type="text" placeholder="Your Name" class="form-control" name="ho_ten">
                                <?php if(isset($_GET['ho_tenerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                                <?php endif ?>
                            </div>

                            <div class="form-contact mt-5">
                                <input type="text" placeholder="Your Email" class="form-control" name="email">
                                <?php if(isset($_GET['emailerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                                <?php endif ?>
                            </div>

                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-contact">
                                <input type="text" placeholder="Your Phone" class="form-control" name="sdt">
                                <?php if(isset($_GET['sdterr'])):?>
                                    <span class="text-danger"><?php echo $_GET['sdterr'] ?></span>
                                <?php endif ?>
                            </div>
                            <div class="form-contact mt-5">
                                <input type="text" placeholder="Subject" class="form-control" name="tieu_de">
                                <?php if(isset($_GET['tieu_deerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['tieu_deerr'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5 abc">
                        <textarea id="" cols="97" rows="10" placeholder="Your Message"
                            style="padding:10px ; margin-left: -15px; border: 1px solid #dedede;background-color: #fcfcfc; width: 720px; border-radius: 0%;"
                            class="form-control" name="noi_dung"></textarea>
                            <?php if(isset($_GET['noi_dungerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['noi_dungerr'] ?></span>
                                <?php endif ?>
                    </div>
                    <div class="row send">
                        <button type="sumit">SEND YOUR MESSAGE NOW</button>
                    </div>
                    <!-- ------------------ end from --------------------- -->
                </form>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="map mt-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.989893291681!2d105.73314331437827!3d21.033090393007612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454628b4b0fc9%3A0xf1c1260d3392abaa!2zQW4gVHJhaSwgVsOibiBDYW5oLCBIb8OgaSDEkOG7qWMsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1605717366020!5m2!1svi!2s"
                        width="350" style="border: 5px solid white;" height="450" frameborder="0" style="border:0;"
                        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="iconn">
                    <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                    <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                    <a class="youtube" href="#"><i class="fa fa-youtube"></i></a>
                    <a class="instagram" href="#"><i class="fa fa-instagram"></i></a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once "./footer.php" ?>