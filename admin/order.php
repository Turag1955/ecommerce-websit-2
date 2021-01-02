<?php include 'inc/header.php'; ?>
<?php
include 'inc/sidebar.php';
require_once '../object/cart.php';
$cart = new cart();
if (isset($_GET['orderid']) && $_GET['orderid'] != '') {
    $cartid = base64_decode($_GET['orderid']);
    $res = $cart->orderStatusUpdate($cartid);
    if ($res == 1) {
        ?>
        <script type="text/javascript">
            swal("Shipted!", "Success", "success");
        </script>

        <?php
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5">No</th>
                        <th width="10px">Name</th>
                        <th width="10px">Qty</th>
                        <th width="10px">Price</th>
                        <th width="10px">Total Price</th>
                        <th width="15px">Image</th>
                        <th width="10px">Date</th>
                        <th width="10px">User Details</th>
                        <th width="10px">Product Details</th>
                        <th width="5px">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $res = $cart->getOrder();
                    $i = 1;
                    $sum = 0;
                    $qty = 0;
                    if ($res) {
                        foreach ($res as $val) {
                            $sum = $sum + $val['price'];
                            ?>
                            <tr class="odd gradeX">
                                <td><?= $i ?></td>
                                <td><?= $val['name'] ?></td>
                                <td><?= $val['qty'] ?></td>
                                <td>$<?= $val['price'] ?></td>
                                <td>$<?= $val['qty'] * $val['price'] ?></td>
                                <td><img src="../assets/frontend/upload/product/<?= $val['image'] ?>" alt="" width="100px" height="100px"/></td>
                                <td><?= $tool->dateFormate($val['insertdate']) ?></td>
                                <td><a href="profile.php?id=<?= $val['user_id'] ?>">user details</a></td>
                                <td><a href="product.php?product_id=<?= $val['Prduct_id'] ?>">Product</a></td>
                                <td>
                                    <?php
                                    if ($val['status'] == 0) {
                                        ?>
                                        <a href="?orderid=<?= base64_encode($val['id']) ?>">Shipted</a>
                                    <?php
                                    } else {
                                        echo 'ok';
                                    }
                                    ?>
                                </td>

                            </tr>
                            <?php
                            $i++;
                        }
                    } else {
                        echo 'No Order';
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>
