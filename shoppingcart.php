<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
include __DIR__ . "/header.php";

include "CartFuncties.php";
$cart = GetCart();
print_r($cart);
?>

<div>

<table class="tbl-cart" cellpadding="10" cellspacing="1">
    <tbody>
    <tr>
        <th style="text-align:left;" name="Productname">Productnaam</th>
    </tr>
    <tr>
        <th style="text-align:left; name="Description">Beschrijving</th>
        <th style="text-align:right width="5%";">Aantal</th>
        <th style="text-align:right width="10%";">Prijs</th>
    </tr>
    </tbody>
</table>

</div>

