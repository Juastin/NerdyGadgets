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

// Toevoegen van product aan winkelmandje
// Parameter: StockitemId van item dat toegevoegd wordt
function AddProductToCart($stockItemID){
    $cart = GetCart();

    if (array_key_exists($stockItemID, $cart)) { // controleren of product al in winkelmandje zit
        $cart[$stockItemID]++;//zo ja, verhogen van aantal
    } else {
        $cart[$stockItemID] = 1;//zo nee, product toevoegen aan winkelmandje
    }

    SaveCart($cart);
}

// Verwijderen van product uit winkelmandje
// Parameter: StockitemId van het item dat verwijderd wordt
function RemoveProductFromCart($stockItemID){
    $cart = GetCart(); // winkelmandje ophalen
            unset($cart[$stockItemID]); // item uit winkelmand verwijderen
        SaveCart($cart); // winkelmandje opslaan
    }


//winkelmandje opslaan in sessie variabele
function SaveCart($cart) {
    $_SESSION['cart'] = $cart;
}