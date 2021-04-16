<?php 
    require_once "config.php" ; 
    require_once "././dao/pdo.php" ; 
    // lấy tất cả loại phòng 
    $sql = "select * from loai_phong" ; 
    $lp = select_all($sql) ;
?>
<div class="container-fluid">
    <div class="container">
        <form action="<?php echo BASE_URL ?>list-type-room.php" method="POST" enctype="multipart/form-data">
            <div class="search-all">
                <div class="box-search-all">
                    <div class="box-search-all-tt">
                        <p style="font-family: 'Playfair Display', serif;text-transform: uppercase;">ROOM TYPE :</p>
                    </div>
                    <div class="box-search-all-input">
                        <select name="ma_loai_phong" class="form-control" style="border: 1px solid #CCA772; border-radius: 0%;">
                            <option value="">Select the room type</option>
                            <?php foreach ($lp as $key ) { ?>
                            <option value="<?= $key['id'] ?>">
                                <?= $key['ten_loai']?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="box-search-all">
                    <div class="box-search-all-tt">
                        <p style="font-family: 'Playfair Display', serif;text-transform: uppercase;">PRICE TO:</p>
                    </div>
                    <div class="box-search-all-input">
                        <input type="number" placeholder="Price to" name="gia_tu" class="form-control">
                    </div>
                </div>
                <div class="box-search-all">
                    <div class="box-search-all-tt">
                        <p style="font-family: 'Playfair Display', serif;text-transform: uppercase;">PRICE FROM:</p>
                    </div>
                    <div class="box-search-all-input">
                        <input type="number" placeholder="Price from" name="gia_den" class="form-control">
                    </div>
                </div>
                <div class="box-search-all">
                    <div class="box-search-all-tt"></div>
                    <div class="box-search-all-input">
                        <button type="submit" name="booking" class="btn" style="font-family: 'Playfair Display', serif;text-transform: uppercase;">Booking Now</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>