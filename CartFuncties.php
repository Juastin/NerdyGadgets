<?php

//ophalen van winkelmandje
function GetCart() {
    if (isset($_SESSION['cart'])) { //controleren of winkelmandje al bestaat
        $cart = $_SESSION['cart']; //zo ja, winkelmandje ophalen
    } else {
        $cart = array(); // zo nee, nieuwe array aanmaken
    }
    return $cart;
}

//toevoegen van product aan winkelmandje
function AddProductToCart($stockItemID){
    $cart = GetCart();

    if (array_key_exists($stockItemID, $cart)) { // controleren of product al in winkelmandje zit
        $cart[$stockItemID]++;//zo ja, verhogen van aantal
    }
    else {
        $cart[$stockItemID] = 1;//zo nee, product toevoegen aan winkelmandje
    }

    SaveCart($cart);
}

//winkelmandje opslaan in sessie variabele
function SaveCart($cart){
    $_SESSION['cart'] = $cart;
}
//winkelmand product niet boven de vooraad
function ProductVooraad()
{
    //Stap 1 Verbinding maken
    $host = "localhost";
    $databasename = "nerdygadgets";
    $user = "root";
    $pass = ""; // eigen wachtwoord
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);


//Stap 2 Query maken en uitvoeren
    $sql = "SELECT * FROM stockitemholdings";
    $result = mysqli_query($connection, $sql);

//Stap 3 Resultaten uitlezen
    $voorraadcheck = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $cart = GetCart();
    foreach ($cart as $product => $voorraad{
    print("NIET OP VOORAAD");

}
        //"product ID: " . $voorraadcheck["StockItemID"] . " heeft nog " . $voorraadcheck["QuantityOnHand"] . " op voorraad " . "<br>");

//Stap 4 Verbinding opruimen
    mysqli_close($connection);

 ?>


