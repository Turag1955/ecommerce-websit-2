<?php
require_once '../object/adminlogin.php';
$adminlogin = new adminlogin();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $res = $adminlogin->login($username, $password);
}
?>


<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../assets/backend/css/stylelogin.css" media="screen" />
</head>
<body>
    <div class="container">
        <section id="content">
            <form action="" method="post">
                <h1>Admin Login</h1>
                <?php
                if (isset($res)) {
                    foreach ($res as $val) {
                        echo '<span style="color:red">' . $val . '<br><br></span>';
                    }
                }
                ?>
                <div>
                    <input type="text" placeholder="Username"  name="username" value="<?= (isset($username)) ? $username : '' ?>"/>
                </div>
                <div>
                    <input type="password" placeholder="Password"  name="password" value="<?= (isset($password)) ? $password : '' ?>"/>
                </div>
                <div>
                    <input name="submit" type="submit" value="Log in" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="#">Training with live project</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>
</html>