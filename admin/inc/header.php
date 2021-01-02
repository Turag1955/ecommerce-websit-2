<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");

require_once '../object/session.php';

session::checksession();
require_once '../object/database.php';
require_once '../config/function.php';
require_once '../config/constant.php';
$query = new query();
$tool = new tool();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session::sessiondestroy();
}
//session_destroy();
//$tool->prx($_SESSION);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="../assets/backend/css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../assets/backend/css/text.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../assets/backend/css/grid.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../assets/backend/css/layout.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../assets/backend/css/nav.css" media="screen" />
        <link href="../assets/backend/css/table/demo_page.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../assets/backend/css/custom.css" media="screen" />
        <!-- BEGIN: load jquery -->
        <script src="../assets/backend/js/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../assets/backend/js/jquery-ui/jquery.ui.core.min.js"></script>
        <script src="../assets/backend/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
        <script src="../assets/backend/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
        <script src="../assets/backend/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
        <script src="../assets/backend/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
        <script src="../assets/backend/js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
        <script src="../assets/backend/js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
        <script src="../assets/backend/js/table/jquery.dataTables.min.js" type="text/javascript"></script>
        <!-- END: load jquery -->
        <script type="text/javascript" src="../assets/backend/js/table/table.js"></script>
        <script src="../assets/backend/js/setup.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setupLeftMenu();
                setSidebarHeight();
            });
        </script>

    </head>
    <body>
        <div class="container_12">
            <div class="grid_12 header-repeat">
                <div id="branding">
                    <div class="floatleft logo">
                        <img src="img/livelogo.png" alt="Logo" />
                    </div>
                    <div class="floatleft middle">
                        <h1>Training with live project</h1>
                        <p>www.trainingwithliveproject.com</p>
                    </div>
                    <div class="floatright">
                        <div class="floatleft">
                            <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                        <div class="floatleft marginleft10">
                            <ul class="inline-ul floatleft">
                                <li>Hello Admin</li>
                                <li><a href="?action=logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear">
                    </div>
                </div>
            </div>
            <div class="clear">
            </div>
            <div class="grid_12">
                <ul class="nav main">
                    <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                    <li class="ic-form-style"><a href=""><span>User Profile</span></a></li>
                    <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
                    <li class="ic-grid-tables"><a href="order.php"><span>Orders</span></a></li>
                    <li class="ic-charts"><a href=""><span>Visit Website</span></a></li>
                </ul>
            </div>
            <div class="clear">
            </div>
