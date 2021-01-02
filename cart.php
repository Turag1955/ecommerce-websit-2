<?php
require_once './inc/header.php';

if (isset($_GET['cartid']) && $_GET['cartid'] != '') {
    $cartid = base64_decode($_GET['cartid']);
    $res = $cart->cartDelete($cartid);
    if ($res == 1) {
        ?>
        <script type="text/javascript">
            swal("Delete!", "Success", "success");
        </script>

        <?php
    }
}


if (isset($_POST['submit'])) {
    $result = $cart->updateQty($_POST);
    if ($result == 1) {
        ?>
        <script type="text/javascript">
            swal("Update!", "Success", "success");
        </script>

        <?php
    }
}
?>

<div class="main">
    <div class="content">
        <div class="cartoption">		
            <div class="cartpage">
                <h2>Your Cart</h2>
                <table class="tblone">
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th> Total Price</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <?php
                        $res = $cart->getCart();
                        $i = 1;
                        $sum = 0;
                        $qty = 0;
                        if ($res) {
                            foreach ($res as $val) {
                                $sum = $sum + $val['price'];
                                ?>
                                <td><?= $i ?></td>
                                <td><?= $val['name'] ?></td>
                                <td><img src="./assets/frontend/upload/product/<?= $val['image'] ?>" alt=""/></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="number" name="qty" value="<?= $val['qty'] ?>"/>
                                        <input type="hidden" name="cart_id" value="<?= $val['id'] ?>"/>
                                        <input type="submit" name="submit" value="Update"/>
                                    </form>
                                </td>
                                <td>$<?= $val['price'] ?></td>
                                <td>$<?= $val['qty'] * $val['price'] ?></td>
                                <td><a href="?cartid=<?= base64_encode($val['id']) ?>">X</a></td>

                            </tr>
                            <?php
                        }
                    } else {
                        $tool->redirect(SITE . 'index.php');
                    }
                    ?>
                </table>
                <table style="float:right;text-align:left; margin-top: 54px" width="40%">
                    <tr>
                        <th style="">Grand Total :</th>
                        <?= session::set('carttotal',$sum) ?>
                        <td>$<?= $sum ?> </td>
                    </tr>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="./assets/frontend/images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <?php
                    if (session::get('userlogin') == true) {
                        ?>
                        <a href="payment.php"> <img src="./assets/frontend/images/check.png" alt="" /></a>
                        <?php
                    } else {
                         ?>
                        <a href="login.php"> <img src="./assets/frontend/images/check.png" alt="" /></a>
                        <?php
                    }
                    ?>
                  
                </div>
            </div>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php require_once './inc/footer.php'; ?>