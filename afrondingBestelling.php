<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "CartFuncties.php";
include "viewFunctions.php";

if (!isset($_POST["submit"])) {
    $cart = GetCart();
} else {
    RemoveProductFromCart($_POST["stockItemID"]);
    $cart = GetCart();
}
?>

<?php //hover in bootstrap nog aanpassen van FFF naar 000, geeft foutmelding ?>
<?php
SaveCart($cart);
if (isset($_POST['update'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    UpdateProduct($productId, $quantity);
}


    foreach ($_SESSION['cart'] as $item => $amount) {
    $Result = GetResult($Connection, $item);
    $sql = "SELECT QuantityOnHand FROM stockitemholdings WHERE stockitemid=" . $item;
    $results = mysqli_query($Connection, $sql);
    $voorraadcheck = mysqli_fetch_all($results, MYSQLI_ASSOC);
    foreach ($voorraadcheck as $voorraad) {
    if ($amount > $voorraad['QuantityOnHand']) {
        $aantal = $voorraad;
    }
?>
<body>
<div>
    <form method="post" action="afrondingBestelling.php">
        <div style="text-align: center;">
            <a href="bestellingAfgerond.php" class="btn btn-primary btn-outline-dark font-weight-bold" style="background-color: #FFFF00;" id="afronden" role="button"> Bestelling Afronden &nbsp; <i class="fas fa-arrow-right"></i></a>
        </div>
    </form>
</div>
</body>
