<?php
require_once './inc/header.php';
require_once './inc/slider.php';
?>


<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $res = $product->getProductFront();
            if ($res) {
                foreach ($res as $val) {
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="preview.php?id=<?= base64_encode($val['id'] )?>"><img src="./assets/frontend/upload/product/<?= $val['image'] ?>" width="100px" height="100px" alt="" /></a>
                        <h2><?= $val['name'] ?> </h2>
                        <p><?= $tool->textshort($val['description'], 50) ?></p>
                        <p><span class="price">$<?= $val['price'] ?></span></p>
                        <div class="button"><span><a href="preview.php?id=<?= base64_encode($val['id'] )?>" class="details">Details</a></span></div>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
        <div class="content_bottom">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $result = $product->getNewProductFront();
            if ($result) {
                foreach ($result as $val) {
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="preview.php?id=<?= base64_encode($val['id'] )?>"><img src="./assets/frontend/upload/product/<?= $val['image'] ?>" width="100px" height="100px" alt="" /></a>
                        <h2><?= $val['name'] ?> </h2>
                        <p><span class="price">$<?= $val['price'] ?></span></p>
                        <div class="button"><span><a href="preview.php?id=<?= base64_encode($val['id'] )?>" class="details">Details</a></span></div>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>
</div>
<?php require_once './inc/footer.php'; ?>