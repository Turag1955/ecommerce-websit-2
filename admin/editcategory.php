
<?php
require_once 'inc/header.php';
require_once 'inc/sidebar.php';
require_once '../object/category.php';
//require_once '../config/function.php';
$category = new category();
//$tool = new tool();


if (isset($_GET['id']) && $_GET['id'] != '') {
   $id = $_GET['id'];
   $res = $category->getCategoryById($id);
   $dbid = $res[0]['id'];
    $dbname = $res[0]['name'];
} else {
    //header("location:catlist.php");
    $tool->redirect(ADMIN_SITE.'catlist.php');
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $result = $category->updatecategory($dbid,$name);
    // print_r($res);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <?php
        if (isset($result)) {
            foreach ($result as $val) {
                echo '<span style="color:red">' . $val . '<br><br></span>';
            }
        }
        ?>
        <div class="block copyblock"> 
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Enter Category Name..." class="medium" value="<?= (isset($dbname)) ? $dbname : '' ?>" />
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