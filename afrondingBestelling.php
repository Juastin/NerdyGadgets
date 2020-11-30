<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "CartFuncties.php";
include "viewFunctions.php";

if (!isset($_POST["afronden"])) {
    $cart = GetCart();
    UpdateVoorraad($Connection);
} else {
    RemoveProductFromCart($_POST["stockItemID"]);
    $cart = GetCart();
}
?>

<?php //hover in bootstrap nog aanpassen van FFF naar 000, geeft foutmelding ?>

<body>
<div>
    <form method="post" action="afrondingBestelling.php">
        <div style="text-align: center;">
            <a href="bestellingAfgerond.php" class="btn btn-primary btn-outline-dark font-weight-bold" style="background-color: #FFFF00;" id="afronden" role="button"> Bestelling Afronden &nbsp; <i class="fas fa-arrow-right"></i></a>
        </div>
    </form>
</div>
</body>
