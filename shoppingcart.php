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

<div id="ArticleHeader">
<div id="StockItemHeaderLeft">
    <div class="CenterPriceLeft">
        <div class="CenterPriceLeftChild">


<form method="post" >
    <input type="number" value='<?php print($cart["StockItemID"]) ?>' name="stockItemID" hidden>
    <input type="submit" class="btn btn-primary btn-outline-dark removeFromCartButton" name="submit" value="Verwijder product">
</form>
            <?php
            include 'CartFuncties.php';
            if ($cart["StockItemID"] == 220) {
                if (isset($_POST['submit'])){
                RemoveProductFromCart($_POST["stockItemID"]);
            } }
            ?>
        </div>
    </div>
</div>
</div>

