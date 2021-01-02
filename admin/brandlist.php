<?php include 'inc/header.php'; ?>
<?php
include 'inc/sidebar.php';
require_once '../object/brand.php';
$brand = new brand();

if(isset($_GET['id']) && $_GET['id'] !='' ){
    $id = base64_decode($_GET['id']);
   $res = $brand->brandDelete($id);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php 
        if(isset($res)){
            echo '<span style="color:red">' . $res . '</span>';
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = $brand->getBrand();
                    
                    //$tool->pr($res);
                    $i = 1;
                    if ($res) {
                        foreach ($res as $val) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?= $i ?></td>
                                <td><?= $val['name'] ?></td>
                                <td>
                                    <a href="editbrand.php?id=<?= $val['id'] ?>">Edit</a> ||
                                    <a href="?id=<?= base64_encode($val['id']) ?>">Delete</a></td>
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

