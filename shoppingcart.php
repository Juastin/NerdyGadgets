<head>
</head>
<body>
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
<div>

    <header>
        <h2 style="text-align: left;">Winkelwagen</h2>
        <h6 style="text-align:right;">Aanvullende beschrijving</h6>
    </header>


    <style>

    </style>

    <hr color="white">
    <br>

    <?php
    SaveCart($cart);
    if (isset($_POST['update'])) {
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];
        UpdateProduct($productId, $quantity);
    }


    foreach ($_SESSION['cart'] as $item => $amount) {
        $Result = GetResult($Connection, $item);
        $Image = GetSingleImage($Connection, $item);
        $sql = "SELECT QuantityOnHand FROM stockitemholdings WHERE stockitemid=" . $item;
        $results = mysqli_query($Connection, $sql);
        $voorraadcheck = mysqli_fetch_all($results, MYSQLI_ASSOC);
        foreach ($voorraadcheck as $voorraad) {
            if ($amount > $voorraad['QuantityOnHand']) {
                $aantal = $voorraad;
            }
            ?>
            <table class="tbl-cart" cellpadding="10" cellspacing="5">
                <tbody>
                <tr>
                    <td>
                        <?php
                        // Prints single image from product.
                        if ($Image != null) {
                            ?>
                            <div id="ImageFrame"
                                 style="background-image: url('Public/StockItemIMG/<?php
                                 print ($Image);
                                 ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;">
                            </div>
                            <?php
                            // Prints backup image when there is no picture available.
                        } else {
                            ?>
                            <div id="ImageFrame"
                                 style="background-image: url('Public/StockGroupIMG/<?php
                                 print ($Result['BackupImagePath']);
                                 ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;">
                            </div>
                        <?php } ?>
                    </td>
                    <?php
                    //                print_r($Result)
                    ?>
                    <td style="text-align:left;" name="Productname"><?php print ($Result['StockItemName']); ?><br>Beschrijving
                    </td>
                    <td style="text-align:left;">Gratis verzending<br>2-4 dagen</td>
                    <td>
                        <div id="field1">
                            <form method="post">
                                Selecteer aantal:
                                <input type="number" min="1" max="<?php print($voorraad['QuantityOnHand']) ?>"
                                       name="quantity" id="quantity" value="<?php print_r($amount) ?>" class="field">
                                <input type="text" name="productId" id="productId" value="<?php print_r($item) ?>"
                                       hidden>
                                <button type="submit" name="update" id="update" class="update">Update</button>
                            </form>
                        </div>
                    </td>
                    <!--                <td><label for="amount">Selecteer aantal:</label>-->
                    <!--                    <input type="number" id="$=amount" name="amount" value="-->
                    <!--                </td>-->
                    <!--                    <select class="" name="Aantal" id="Aantal">-->
                    <!--                        <option value="1">1</option>-->
                    <!--                        <option value="2">2</option>-->
                    <!--                        <option value="3">3</option>-->
                    <!--                        <option value="4">4</option>-->
                    <!--                        <option value="5">5</option>-->
                    <!--                    </select></td>-->

                    <td style="text-align:right;">Prijs:</td>
                    <td>
                        <form method="post">
                            <input type="number" value='<?php print($item) ?>' name="stockItemID" hidden>
                            <input type="submit" class="btn btn-primary btn-outline-dark removeFromCartButton"
                                   name="submit"
                                   value="Verwijder product">
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        <?php }
    } ?>

    <br>
    <hr color="white">

</div>
<div style="width:20%;">
    <form method="post" action="CartFuncties.php">
        <td><label for="kortingsbon">Vul hier je kortingscode in (optioneel):</label>
            <input type="text" id="kortingsbon" name="kortingsbon" value="kortingsbon"></td>
        <br>
    </form>
</div>

<div>
    <table style="text-align:right">
        <td style="text-align:right;" name="Totaal">Totaal Artikelen</td>
        <td style="text-align:right;" name="Prijs1">Prijs</td>
    </table>

    <table>
        <td style="text-align:right;" name="Verzendkosten">Verzendkosten</td>
        <td style="text-align:right;" name="Prijs2">Gratis</td>
    </table>

    <hr color="white" style="width:10%;">

    <table>
        <td style="text-align:right;" name="Totaal">Totaal Artikelen</td>
        <td style="text-align:right;" name="Prijs3">Prijs</td>
        </td>
    </table>
</div>

<form method="post" action="shoppingcart.php">
    <div style="text-align: center;">
        <input type="number" value='<?php print($Result["StockItemID"]) ?>' name="stockItemID" hidden>
        <a href="afrondingBestelling.php" class="btn btn-primary btn-outline-dark font-weight-bold" style="background-color: #FFFF00;" id="afronden" role="button"> Verder Gaan &nbsp; <i class="fas fa-arrow-right"></i></a>
    </div>
</form>

