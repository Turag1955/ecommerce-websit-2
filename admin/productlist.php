<?php include 'inc/header.php'; ?>
<?php
include 'inc/sidebar.php';
require_once '../object/product.php';
$product = new product();
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = base64_decode($_GET['id']);
    $res = $product->productDelete($id);
}
if (isset($_GET['statusid']) && $_GET['statusid'] != '' && isset($_GET['type']) && $_GET['type'] != ''  ) {
    $id = base64_decode($_GET['statusid']);
    $type = $_GET['type'];
    $res = $product->productStatus($id,$type);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <?php
                    $res = $product->getproduct();

                    //$tool->pr($res);
                    $i = 1;
                    if ($res) {
                        foreach ($res as $val) {
                            ?>
                            <tr class="odd gradeX">
                                <td width="5px"><?= $i ?></td>
                                <td width="10px"><?= $val['name'] ?></td>
                                <td width="10px"><?= $val['category'] ?></td>
                                <td width="10px"><?= $val['brand'] ?></td>
                                <td width="20px"><?= $tool->textshort($val['description'], 50) ?></td>
                                <td width="10px"><?= '$' . $val['price'] ?></td>
                                <td width="10px">
                                    <?php
                                    if ($val['type'] == 1) {
                                        ?>
                                        <div class="badge">
                                            Featured
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="badge">
                                            No-Featured
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td width="10px"><img src="../assets/frontend/upload/product/<?= $val['image'] ?>" alt="" height="100px" width="100px"/></td>
                                <td width="20px">
                                    <a href="productedit.php?id=<?= $val['id'] ?>">Edit</a> ||
                                    <a href="?id=<?= base64_encode($val['id']) ?>" onclick="return confirm('Are You sure..?')">Delete</a>||
                                    <?php
                                    if ($val['status'] == 1) {
                                        ?>
                                        <a href="?statusid=<?= base64_encode($val['id']) ?>&&type=deactive">Active</a> 
                                        <?php
                                    } else {
                                        ?>
                                        <a href="?statusid=<?= base64_encode($val['id']) ?>&&type=active">DeActive</a> 
                                        <?php
                                    }
                                    ?>

                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
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
