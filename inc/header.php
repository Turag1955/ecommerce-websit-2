<?php
require_once './object/session.php';
require_once './object/database.php';
require_once './config/function.php';
session::init();

spl_autoload_register(function($class) {
    require_once './object/' . $class . '.php';
});

$query = new query();
$tool = new tool();
$product = new product();
$cart = new cart();
$brand = new brand();
$category = new category();
$user = new user();

if (isset($_GET['logout']) && $_GET['logout'] != '') {
    $logout = base64_decode($_GET['logout']);
    $sesssion_id = session_id();
    $condition = ['session_id' => " '$sesssion_id' "];
    $res = $query->deleteData('addcart', $condition);
    session::unsetSession('userlogin');
    session::unsetSession('username');
    session::unsetSession('userid');
    $tool->redirect(SITE . 'index.php');
}
//$tool->prx($_SESSION);
?>

<!DOCTYPE HTML>
<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="./assets/frontend/css/sweetalert.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="./assets/frontend/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="./assets/frontend/css/menu.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="./assets/frontend/js/jquerymain.js"></script>
    <script src="./assets/frontend/js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="./assets/frontend/js/jquery-1.7.2.min.js"></script> 
    <script type="text/javascript" src="./assets/frontend/js/sweetalert.min.js"></script> 
    <script type="text/javascript" src="./assets/frontend/js/nav.js"></script>
    <script type="text/javascript" src="./assets/frontend/js/move-top.js"></script>
    <script type="text/javascript" src="./assets/frontend/js/easing.js"></script> 
    <script type="text/javascript" src="./assets/frontend/js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function ($) {
            $('#dc_mega-menu-orange').dcMegaMenu({rowItems: '4', speed: 'fast', effect: 'fade'});
        });
    </script>
</head>
<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="assets/frontend/images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form>
                        <input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {
                                    this.value = 'Search for Products';
                                }"><input type="submit" value="SEARCH">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="#" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <?php
                            $res = $cart->getCart();
                            if ($res) {
                                ?>
                                <span class="no_product">$<?= session::get('carttotal') ?></span>
                                <?php
                            } else {
                                ?>
                                <span class="no_product">$0</span>
                                <?php
                            }
                            ?>

                        </a>
                    </div>
                </div>
                <?php
                if (session::get('userlogin') == true) {
                    ?>
                    <div class="login"><a href="?logout=<?= base64_encode(session::get('userid')) ?>">Logout</a></div>
                    <?php
                } else {
                    ?>  <div class="login"><a href="login.php">Login</a></div><?php
                }
                ?>

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a> </li>
                <li><a href="topbrands.php">Top Brands</a></li>
                <?php
                $getcart = $cart->getCart();
                if ($getcart) {
                    ?>
                    <li><a href="cart.php">Cart</a></li>
                  <!--  <li><a href="payment.php">Payment</a></li> -->
                    <?php
                }
                ?>
                <?php
                if (session::get('userlogin') == true) {
                    ?>
                    <li><a href="orderdetails.php">Order</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <?php
                }
                ?>
                <li><a href="contact.php">Contact</a> </li>
                <div class="clear"></div>
            </ul>
        </div>

