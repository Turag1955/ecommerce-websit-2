<?php
require_once './inc/header.php';
if(session::get('userlogin') == true){
    $tool->redirect(SITE.'index.php');
}

if (isset($_POST['register'])) {
    $result = $user->userRegister($_POST);
    echo '<pre>';
    //echo $res;
    echo '</pre>';
}
if (isset($_POST['login'])) {
    $login = $user->userLogin($_POST);
    //echo '<pre>';
    //echo $res;
    //echo '</pre>';
}
?>

<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <?php
            if (isset($login) > 0) {
                echo '<span style="color:red">' . $login . '<br><br></span>';
            }
            ?>
            <form action="" method="post">
                <input name="email" type="text" placeholder="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" class="field">
                <input name="password" type="password" placeholder="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>" class="field" >
                <div class="buttons"><div><button name="login" class="grey">Sign In</button></div></div>
            </form>
        </div>
        <div class="register_account">
            <h3>Register New Account</h3>
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
                                    <input type="text" name="name" placeholder="Name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ?>" >
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="City" value="<?= (isset($_POST['city'])) ? $_POST['city'] : '' ?>" >
                                </div>

                                <div>
                                    <input type="text" name="zip" placeholder="Zip Code" value="<?= (isset($_POST['zip'])) ? $_POST['zip'] : '' ?>" >
                                </div>
                                <div>
                                    <input type="text" name="email" placeholder="Email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" >
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="address" value="<?= (isset($_POST['address'])) ? $_POST['address'] : '' ?>" >
                                </div>
                                <div>
                                    <input type="text" name="country" placeholder="Country" value="<?= (isset($_POST['country'])) ? $_POST['country'] : '' ?>" >
                                </div>		        

                                <div>
                                    <input type="text" name="phone" placeholder="phone" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : '' ?>" >
                                </div>

                                <div>
                                    <input type="text" name="password" placeholder="Password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>" >
                                </div>
                            </td>
                        </tr> 
                    </tbody></table> 
                <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
                <div class="clear"></div>
            </form>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php require_once './inc/footer.php'; ?>