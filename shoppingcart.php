<head>
</head>
<body>
<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
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
    if (isset($_GET['update'])){
        $productId = $_GET['productId'];
        $quantity = $_GET['quantity'];
        UpdateProduct($productId,$quantity);
    }

    foreach ($_SESSION['cart'] as $item => $amount) {
        $Result = GetResult($Connection, $item);
        $Image = GetSingleImage($Connection, $item);

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

                <td style="text-align:left;">Verzend Informatie<br>Aanvullende Informatie</td>
                <td>
                    <div id="field1">
                        <form>
                            Selecteer aantal:
                            <input type="number" min="1" name="quantity" id="quantity" value="<?php print_r($amount) ?>"  class="field">
                            <input type="text" name="productId" id="productId" value="<?php print_r($item) ?>" hidden>
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
                        <input type="submit" class="btn btn-primary btn-outline-dark removeFromCartButton" name="submit"
                               value="Verwijder product">
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    <?php } ?>

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
<table style="text-align:right">
    <td style="text-align:right;" name="Totaal">Totaal Artikelen</td>
    <td style="text-align:right;" name="Prijs1">Prijs</td>
</table>

<table>
    <td style="text-align:right;" name="Verzendkosten">Verzendkosten</td>
    <td style="text-align:right;" name="Prijs2">Prijs</td>
</table>

<hr color="white" style="width:10%;">

<table>
    <td style="text-align:right;" name="Totaal">Totaal Artikelen</td>
    <td style="text-align:right;" name="Prijs3">Prijs</td>
    </td>
</table>
