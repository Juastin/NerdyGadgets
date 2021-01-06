<?php
$Connection = mysqli_connect("localhost", "root", "nerdygadgets", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "viewFunctions.php";

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $quantity){
    if (isset($_POST["afronden"])){
        UpdateVoorraad($Connection, $quantity, $id);
        unset($_SESSION['cart']); ?>
        <script> window.location.href = 'bestellingAfgerond.php'; </script>
    <?php  }
    }}

    ?>

    <body>
    <div class="container" style="text-align: center;">
        <?php print "U heeft betaald!🎉 🎉 🙌. <br> Wij gaan meteen voor u aan de slag!👷 🛒 "; ?>
    </div>
    </body>