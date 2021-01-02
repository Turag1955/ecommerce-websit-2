<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
            $res = $product->getLatestBrand();
            if ($res) {
                foreach ($res as $val) {
                    if ($val) {
                        ?>
                        <div class="listview_1_of_2 images_1_of_2">
                            <div class="listimg listimg_2_of_1">
                                <a href="preview.php?id=<?= base64_encode($val[0]['id']) ?>"> <img src="./assets/frontend/upload/product/<?= $val[0]['image'] ?>" alt="" /></a>
                            </div>
                            <div class="text list_2_of_1">
                                <h2>
                                    <?php
                                    $brand_id = $val[0]['brandid'];
                                    $br = $brand->getBrandByName($brand_id);
                                    if ($br) {
                                        echo $br[0]['name'];
                                    }
                                    ?>
                                </h2>
                                <p><?= $val[0]['name'] ?></p>
                                <div class="button"><span><a href="preview.php?id=<?= base64_encode($val[0]['id']) ?>">Add to cart</a></span></div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>

        </div>

        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="./assets/frontend/images/1.jpg" alt=""/></li>
                    <li><img src="./assets/frontend/images/2.jpg" alt=""/></li>
                    <li><img src="./assets/frontend/images/3.jpg" alt=""/></li>
                    <li><img src="./assets/frontend/images/4.jpg" alt=""/></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>