<?php

require_once './inc/header.php';
if (session::get('userlogin') == false) {
    $tool->redirect(SITE . 'login.php');
}
?>
<style>
   
</style>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <div class="notfound">
                <h2 class="headingpayment">Please Chose Your Payment Option</h2>
                <div class="mt-5">
                    <a href="paymentoffline.php" class="btn">Offline</a>
                    <a href="paymentonline.php" class="btn btn-2">Online</a>
                </div>

            </div>
        </div>
    </div>
    <?php require_once './inc/footer.php'; ?>