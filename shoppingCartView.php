<?php
include "CartFuncties.php";
session_start(); //staat bij NerdyGadgets al in de header!


if(isset($_GET["stockItemID"])) {
    $stockItemID = $_GET["stockItemID"];
}else{
    $stockItemID = 0;
}
?>
<h3>Product <?php print($stockItemID)?></h3>

<form method="post">
    <input type="number" value='<?php print($stockItemID) ?>' name="stockItemID" hidden>
    <input type="submit" value="Voeg toe aan winkelmandje" name="submit">
</form>

<?php

if(isset($_POST['submit'])){
    $stockItemID = $_POST['stockItemID'];
    AddProductToCart($stockItemID);
    print("Product is toegevoegd aan het <a href='cart.php'> winkelmandje </a>");
}
?>
