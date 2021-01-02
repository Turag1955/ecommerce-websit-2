<?php
require_once './inc/header.php';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = base64_decode($_GET['id']);
    $res = $product->getDetailsProductById($id);
} else {
    //header("location:catlist.php");
    $tool->redirect(SITE . '404.php');
}
if (isset($_POST['submit'])) {
    $qty = $_POST['qty'];
    $result = $cart->addToCart($qty, $id);
    //swal("Congratulations!", "You Successfully added!", "success");
    // print_r($res);
}
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="cont-desc span_1_of_2">	
                <?php
                if ($res) {
                    ?>
                    <div class="grid images_3_of_2">
                        <img src="./assets/frontend/upload/product/<?= $res[0]['image'] ?>" alt="" />
                    </div>
                    <div class="desc span_3_of_2">
                        <h2><?= $res[0]['name'] ?> </h2>
                        <div class="price">
                            <p>Price: <span>$<?= $res[0]['price'] ?></span></p>
                            <p>Category: <span><?= $res[0]['category'] ?></span></p>
                            <p>Brand:<span><?= $res[0]['brand'] ?></span></p>
                        </div>
                        <div class="add-cart">
                            <form action="" method="post">
                                <input type="number" class="buyfield" name="qty" value="1"/>
                                <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                            </form>				
                        </div>
                        <?php
                        if (isset($result) == 1) {
                            ?>
                            <script type="text/javascript">
                                swal("Error!", "Product All Ready Added", "error");
                            </script>

                            <?php
                        }
                        ?>
                    </div>
                    <div class="product-desc">
                        <h2>Product Details</h2>
                        <p><?= $res[0]['description'] ?></p>

                    </div>
                <?php } ?>
            </div>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <?php
                    $res = $category->getCategory();

                    //$tool->pr($res);
                    $i = 1;
                    if ($res) {
                        foreach ($res as $val) {
                            ?>
                    <li><a href="productbycat.php?id=<?= base64_encode($val['id'])?>"><?=$val['name']?></a></li>
                        <?php }
                    } ?>
                </ul>

            </div>
        </div>
    </div>
</div>
<?php require_once './inc/footer.php'; ?>