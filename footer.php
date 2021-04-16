<a id="back-to-top" style="position: fixed;
                            display: none;
                            background: #CCA772 ;
                            height: 50px;
                            width: 50px;
                            bottom: 25px;
                            right: 25px;
                            color: #fff;
                            text-align: center;
                            border-radius: 50%;
                            line-height: 40px;
                            font-size: 20px;
                            border: 2px solid transparent;" href="#" class="back" role="button"><i
        class="fa fa-angle-double-up" aria-hidden="true"></i></i></a>
<div class="container-fluid footer">
    <div class="container">
        <div class="row top">
            <div class="col-md-3 mt-5 cot ">
                <h4 style="font-family: 'Playfair Display', serif;text-transform: uppercase;">Menu</h4>
                <a href="#">About Us</a> <br>
                <a href="#">My Account</a> <br>
                <a href="#">Orders History</a> <br>
                <a href="#">Advanced Search</a>
            </div>
            <div class="col-md-3 mt-5 cot">
                <h4 style="font-family: 'Playfair Display', serif;text-transform: uppercase;">Quick Links</h4>
                <a href="#">Rooms</a> <br>
                <a href="#">Events</a> <br>
                <a href="#">FAQs</a> <br>
                <a href="#">Blogs</a>
            </div>

            <div class="col-md-3 mt-5 cot">
                <h4 style="font-family: 'Playfair Display', serif;text-transform: uppercase;">Contact</h4>
                <p><i class="fa fa-phone" aria-hidden="true" style="color:#6F7880;"></i> (+84) <?php echo $kh['sdt'] ?></p>
                <p><i class="fa fa-envelope-o" aria-hidden="true" style="color:#6F7880;">&ensp;</i><?php echo $kh['email'] ?></p>
                <p><i class="fa fa-map-marker" aria-hidden="true" style="color:#6F7880;"></i> <?php echo $kh['dia_chi'] ?></p>

            </div>
            <div class="col-md-3 mt-5 cot">
                <h4 style="font-family: 'Playfair Display', serif;text-transform: uppercase;">Newsletter</h4>
                <p>You can trust us, we only send promo offers.</p>
                <form action="">
                    <input class="sub" type="text" placeholder="Your Email Address ...">
                    <button class="ml-2" style="font-size: 14px;">SEND</button>
                </form>
            </div>
        </div>
        <div class="row mt-5 pt-5">
            <div class="col-md-7 ">
                <p style="font-size: 15px; color:#ffffff;"> Our hotels are always reputed first&ensp;
                    <i class="fa fa-heart" aria-hidden="true" style="color: #ffffff; "></i>&ensp; by <a
                        style="text-decoration: none; color: #A7602D; " href=""></a> GROUP 1
                </p>
            </div>
            <div class="col-md-5 ">
                <div class="icon">
                    <li> <a href=""> <i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                    <li> <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                    <li> <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
                    <li> <a href=""><i class="fa fa-dribbble" aria-hidden="true"></i></a> </li>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// back to top

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
});

// scroll mane
window.onscroll = function() {
    scroll();
};
</script>

</body>
</html>