<?php
include 'inc/header.php';
include 'inc/sidebar.php';
require_once '../object/category.php';
require_once '../object/brand.php';
require_once '../object/product.php';
$category = new category();
$brand = new brand();
$product = new product();


if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
    $res = $product->getProductById($id);
    $dbid = $res[0]['id'];
    $dbname = $res[0]['name'];
    $catid = $res[0]['catid'];
    $brandid = $res[0]['brandid'];
    $description = $res[0]['description'];
    $price = $res[0]['price'];
    $type = $res[0]['type'];
    $image = $res[0]['image'];
} else {
    //header("location:catlist.php");
    $tool->redirect(ADMIN_SITE . 'productlist.php');
}

if (isset($_POST['submit'])) {
    $result = $product->updateproduct($_POST, $_FILES,$image,$dbid);

    // print_r($res);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <?php
        if (isset($result)) {
            foreach ($result as $val) {
                ?>
                <div class="alert"><?= $val ?></div>
                <?php
            }
        }
        ?>
        <div class="block">               
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input name="name" type="text" placeholder="Enter Product Name..." class="medium" value="<?= (isset($dbname)) ? $dbname : '' ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="catid">
                                <option>Select Category</option>
                                <?php
                                // $select = '';
                                $res = $category->getCategory();
                                foreach ($res as $val) {
                                    ?>
                                    <option <?php
                                    if ($catid == $val['id']) {
                                        echo 'selected';
                                    }
                                    ?>  

                                        value="<?= $val['id'] ?>" ><?= $val['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brandid">
                                <option>Select Brand</option>
                                <?php
                                $resultbrand = $brand->getBrand();
                                foreach ($resultbrand as $val) {
                                    ?>
                                    <option <?php
                                    if ($val['id'] == $brandid) {
                                        echo 'selected';
                                    }
                                    ?> 

                                        value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                        <?php
                                    }
                                    ?>                            
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="description" class="tinymce" rows="15" cols="80"><?= (isset($description)) ? $description : '' ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input name="price" type="text" placeholder="Enter Price..." class="medium" value="<?= (isset($price)) ? $price : '' ?>"  />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input name="image" type="file" />
                            <img src="../assets/frontend/upload/product/<?= $image ?>" width="100px" height="100px" alt="" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
                                if ($type == 1) {
                                    ?>
                                    <option selected="" value="1">Featured</option>
                                    <option value="2">Non-Featured</option>
                                    <?php
                                } else {
                                    ?>
                                    <option  value="1">Featured</option>
                                    <option selected="" value="2">Non-Featured</option>
                                    <?php
                                }
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>


