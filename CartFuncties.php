<?php


//ophalen van winkelmandje
function GetCart()
{
    if (isset($_SESSION['cart'])) { //controleren of winkelmandje al bestaat
        $cart = $_SESSION['cart']; //zo ja, winkelmandje ophalen
    } else {
        $cart = array(); // zo nee, nieuwe array aanmaken
    }
    return $cart;
}

// Toevoegen van product aan winkelmandje
// Parameter: StockitemId van item dat toegevoegd wordt
function AddProductToCart($stockItemID)
{
    $cart = GetCart();

    if (array_key_exists($stockItemID, $cart)) { // controleren of product al in winkelmandje zit
        $cart[$stockItemID]++;//zo ja, verhogen van aantal
    } else {
        $cart[$stockItemID] = 1;//zo nee, product toevoegen aan winkelmandje
    }

    SaveCart($cart);
}

//winkelmandje opslaan in sessie variabele
function SaveCart($cart)
{
    $_SESSION['cart'] = $cart;
}

//winkelmand product niet boven de vooraad
// TODO: Check if function works, otherwise fix it. Probably has to do with array indexes since $voorraadcheck is a 2 dimensional array.
function ProductVoorraad($Connection, $id)
{

    $cart = GetCart();
    foreach ($cart as $product => $aantal) {
        $query = "SELECT QuantityOnHand FROM stockitemholdings WHERE stockitemid= ?";
        $statement = mysqli_prepare($Connection, $query);
        mysqli_stmt_bind_param($statement, 's', $email);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $voorraadcheck = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    foreach ($voorraadcheck as $voorraad) {
        if ($aantal > $voorraad['QuantityOnHand']) {
            print ("Product $id heeft minder dan het geselecteerde aantal beschikbaar!<br>");
        }
    }
}

// Verwijderen van product uit winkelmandje
// Parameter: StockitemId van het item dat verwijderd wordt
function RemoveProductFromCart($stockItemID)
{
    $cart = GetCart(); // winkelmandje ophalen
        unset($cart[$stockItemID]); // item uit winkelmand verwijderen
        SaveCart($cart); // winkelmandje opslaan
    }
?>

<script>
    // Melding op knop dat het product is toegevoegd na toevoegen van het product, de knop is (veranderd van paars naar) groen
    function NotificationAddedItem() {
        document.getElementById('button').value = "Aantal verhogen ++"; // de waarde van value wordt vervangen
    }

</script>
<?php 
function headerCartAmount() {
    $totaalartikelen = 0;
    $cart = GetCart();
    foreach ($cart as $item => $amount) {
        $totaalartikelen = $totaalartikelen+$amount;
    }
    return($totaalartikelen);
}    
function UpdateProduct($stockItemID,$quantity){
    $cart = GetCart();

    if (array_key_exists($stockItemID, $cart)) { // controleren of product al in winkelmandje zit
        $cart[$stockItemID] = $quantity;//zo ja, verander aantal in winkelmandje
    } else {
        $cart[$stockItemID] = 1;//zo nee, product toevoegen aan winkelmandje
    }

    SaveCart($cart);
}
function finishOrder() {

}

