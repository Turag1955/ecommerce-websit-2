
<?php
require_once 'inc/header.php';
require_once 'inc/sidebar.php';
require_once '../object/brand.php';
$brand = new brand();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $res = $brand->insertbrand($name);
    // print_r($res);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Brand</h2>
        <?php
        if (isset($res)) {
            foreach ($res as $val) {
                echo '<span style="color:red">' . $val . '<br><br></span>';
            }
        }
        ?>
        <div class="block copyblock"> 
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Enter Brand Name..." class="medium" value="<?= (isset($name)) ? $name : '' ?>" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input  type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>