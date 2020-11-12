<?php
include "CartFuncties.php";
session_start();
$cart = GetCart();
foreach ($cart as $product => $aantal) {
    print("product: " . $product . " aantal: " . $aantal . "<br>");
}
ProductVooraad();
//gegevens per artikel (naam, prijs, etc.) in $cart-array  uit database halen
//totaal prijs berekeken
//winkelmandje weergeven in html (bv. met tabel)

?>