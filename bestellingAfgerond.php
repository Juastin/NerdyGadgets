<?php
session_start();
include __DIR__ . "/header.php";
include "viewFunctions.php";
$Connection = mysqli_connect("localhost", "root", "MaineCoon18", "nerdygadgets_simple");
mysqli_set_charset($Connection, 'latin1');


//print_r($_POST);
//print_r($_SESSION);
//$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets_simple");
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $quantity){
        if (isset($_POST["afronden"])){
            if (isset($_SESSION['user'])){
                $email = $_SESSION['user'];
            }
            else {
                $email = null;
            }
            finishOrder($Connection, $_POST, $_SESSION['cart'], $quantity, $email);
//        UpdateVoorraad($Connection, $quantity, $id);
            unset($_SESSION['cart']); ?>
            <!--        <script> window.location.href = 'bestellingAfgerond.php'; </script>-->
        <?php  }
    }
} ?>

<body>
<div class="container" style="text-align: center;">
    <?php print "U heeft betaald!🎉 🎉 🙌. <br> Wij gaan meteen voor u aan de slag!👷 🛒 "; ?>
</div>
</body>