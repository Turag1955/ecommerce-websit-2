<?php
include 'inc/header.php';
include 'inc/sidebar.php';
require_once '../object/category.php';
require_once '../object/brand.php';
require_once '../object/product.php';
$category = new category();
$brand = new brand();
$product = new product();
if (isset($_POST['submit'])) {
    $result = $product->insertproduct($_POST, $_FILES);

    // print_r($res);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
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
                            <input name="name" type="text" placeholder="Enter Product Name..." class="medium" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ?>" />
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
                                // $selected = '';
                                $res = $category->getCategory();
                                foreach ($res as $val) {
                                    ?>
                                    <option  value="<?= $val['id'] ?>" ><?= $val['name'] ?></option>
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
                                    <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
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
                            <textarea name="description" class="tinymce" rows="15" cols="80"><?=(isset($_POST['description']))?$_POST['description']:'' ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input name="price" type="text" placeholder="Enter Price..." class="medium" value="<?= (isset($_POST['price'])) ? $_POST['price'] : '' ?>"  />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input name="image" type="file" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <option value="1">Featured</option>
                                <option value="2">Non-Featured</option>
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


