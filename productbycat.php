
<?php
require_once './inc/header.php';


if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = base64_decode($_GET['id']);
    $res = $product->getProductByCatId($id);
} else {
    //header("location:catlist.php");
    $tool->redirect(SITE . '404.php');
}
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Latest from Iphone</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            if ($res) {
                foreach ($res as $val) {
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="preview.php?id=<?= base64_encode($val['id']) ?>"><img src="./assets/frontend/upload/product/<?= $val['image'] ?>" alt="" /></a>
                        <h2><?= $val['name'] ?> </h2>
                        <p><?= $tool->textshort($val['description'], 50) ?></p>
                        <p><span class="price">$<?= $val['price'] ?></span></p>
                        <div class="button"><span><a href="preview.php?id=<?= base64_encode($val['id']) ?>" class="details">Details</a></span></div>
                    </div>
                    <?php
                }
            } else {
                $tool->redirect(SITE . '404.php');
            }
            ?>
        </div>



    </div>
</div>
<?php
require_once './inc/footer.php';
