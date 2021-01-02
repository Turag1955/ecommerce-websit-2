<?php
require_once './inc/header.php';
if (session::get('userlogin') == false) {
    $tool->redirect(SITE . 'index.php');
}
if (session::get('userlogin')) {
    $userinfo = $user->getUser();
}
if (isset($_POST['update'])) {
    $result = $user->userUpdate($_POST);
    echo '<pre>';
    //echo $res;
    echo '</pre>';
}
?>

<div class="main">
    <div class="content">
        <div class="register_account">
            <h3>Update Profile</h3>
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
                <div class="search"><div><button class="grey" name="update">Update Profile</button></div></div>
                <div class="clear"></div>
            </form>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php require_once './inc/footer.php'; ?>