<?php
include "CartFuncties.php";
session_start();
$cart = GetCart();
print_r($cart);
//gegevens per artikel (naam, prijs, etc.) in $cart-array  uit database halen
//totaal prijs berekeken
//winkelmandje weergeven in html (bv. met tabel)

?>

