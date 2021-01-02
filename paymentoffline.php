<?php
require_once './inc/header.php';

if (session::get('userlogin')) {
    $userinfo = $user->getUser();
}
if(isset($_GET['order']) && base64_decode($_GET['order']) == 'order'){
    $cart->orderInsert();
}
if (isset($_POST['update'])) {
    $result = $user->userUpdate($_POST);
}
?>

<div class="main">
    <div class="content">
        <div class="cartoption">		
            <div class="cartpage">
                <h2>Your Shopint</h2>
                <table class="tblone">
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                    <tr>
                        <?php
                        $res = $cart->getCart();
                        $i = 1;
                        $sum = 0;
                        $qty = 0;
                        if ($res) {
                            foreach ($res as $val) {
                                $sum = $sum + ($val['price'] * $val['qty']);
                                $qty = $qty + $val['qty'];
                                ?>
                                <td><?= $i ?></td>
                                <td><?= $val['name'] ?></td>
                                <td>$<?= $val['price'] ?></td>
                                <td><?= $val['qty'] ?></td>
                                <td>$<?= $val['price'] * $val['qty'] ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </table>
                    <table style="float:right;text-align:left; margin-top: 30px" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td>$<?= $sum ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>5%</td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td><?php
                                $parcent = $sum * 0.5;
                                $total = $sum + $parcent;
                                echo '$' . $total;
                                ?></td>
                        </tr>
                    </table>
                    <?php
                } else {
                    $tool->redirect(SITE . 'index.php');
                }
                ?>
                <div class="register_account user_info">
                    <h3>Your Information</h3>
                    <?php
                    if (isset($result) > 0) {
                        echo '<span style="color:red">' . $result . '<br><br></span>';
                    }
                    ?>
                    <form action="" method="post">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <input type="text" name="name" placeholder="Name" value="<?= (isset($userinfo[0]['name'])) ? $userinfo[0]['name'] : '' ?>" >
                                        </div>

                                        <div>
                                            <input type="text" name="city" placeholder="City" value="<?= (isset($userinfo[0]['city'])) ? $userinfo[0]['city'] : '' ?>" >
                                        </div>

                                        <div>
                                            <input type="text" name="zip" placeholder="Zip Code" value="<?= (isset($userinfo[0]['zip'])) ? $userinfo[0]['zip'] : '' ?>" >
                                        </div>
                                        <div>
                                            <input readonly="" type="text" name="email" placeholder="Email" value="<?= (isset($userinfo[0]['email'])) ? $userinfo[0]['email'] : '' ?>" >
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="text" name="address" placeholder="address" value="<?= (isset($userinfo[0]['address'])) ? $userinfo[0]['address'] : '' ?>" >
                                        </div>
                                        <div>
                                            <input type="text" name="country" placeholder="Country" value="<?= (isset($userinfo[0]['country'])) ? $userinfo[0]['country'] : '' ?>" >
                                        </div>		        

                                        <div>
                                            <input type="text" name="phone" placeholder="phone" value="<?= (isset($userinfo[0]['phone'])) ? $userinfo[0]['phone'] : '' ?>" >
                                        </div>
                                    </td>
                                </tr> 
                            </tbody></table> 
                        <div class="search">
                            <div>
                                <button class="grey" name="update">Update Information</button> 
                                <a href="?order=<?= base64_encode('order')?>" class="btn order"> Order</a>
                            </div>
                        </div>

                        <div class="clear"></div>
                    </form>
                </div>  	

            </div>

        </div>  	

        <div class="clear"></div>
    </div>
</div>
<?php require_once './inc/footer.php'; ?>