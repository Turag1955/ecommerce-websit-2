<?php
require_once './inc/header.php';
if (session::get('userlogin') == false) {
    $tool->redirect(SITE . 'login.php');
}

if (isset($_GET['orderid']) && $_GET['orderid'] != '') {
    $orderid = base64_decode($_GET['orderid']);
    $res = $cart->orderDelete($orderid);
    if ($res == 1) {
        ?>
        <script type="text/javascript">
            swal("Delete!", "Success", "success");
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
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <?php
                        $res = $cart->getOrderdetails();
                        $i = 1;
                        $sum = 0;
                        $qty = 0;
                        if ($res) {
                            foreach ($res as $val) {
                                ?>
                                <td><?= $i ?></td>
                                <td><?= $val['name'] ?></td>
                                <td><img src="./assets/frontend/upload/product/<?= $val['image'] ?>" alt=""/></td>
                                <td><?= $val['qty'] ?></td>
                                <td>$<?= $val['qty'] * $val['price'] ?></td>
                                <td><?php
                                    if ($val['status'] == 0) {
                                        echo 'pending';
                                    } else {
                                        echo 'shiped';
                                    }
                                    ?> </td>
                                <td><?= $tool->dateFormate($val['insertdate']) ?></td>
                                <td>
                                    <?php
                                    if ($val['status'] == 1) {
                                        ?>
                                        <a href="?orderid=<?= base64_encode($val['id']) ?>">X</a>
                                        <?php
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    } else {
                        $tool->redirect(SITE . 'index.php');
                    }
                    ?>
                </table>

            </div>  	
            <div class="clear"></div>
        </div>
    </div>
    <?php require_once './inc/footer.php'; ?>