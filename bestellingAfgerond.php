<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "CartFuncties.php";
include "viewFunctions.php";

$cart = GetCart();
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $quantity){
    if (isset($_POST["afronden"])){
        UpdateVoorraad($Connection, $quantity, $id);
        }
    }
    unset($_SESSION['cart']);
    ?>
    <body>

    <?php print "U heeft betaald!🎉 🎉 🙌. <br> Wij gaan meteen voor u aan de slag!👷 🛒 "; ?>

    </body>
<?php
}
else {
    
}
