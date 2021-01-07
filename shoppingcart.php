
<head>
</head>
<div>
<?php
$Connection = mysqli_connect("localhost", "root", "MaineCoon18", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "viewFunctions.php";
$totaalprijs = 0;

$totaalprijs = 0;
if (!isset($_POST["submit"])) {
    $cart = GetCart();
    $_SESSION['cart'] = $cart;
    } else {
    RemoveProductFromCart($_POST["stockItemID"]);
    $cart = GetCart(); ?>
    <script> window.location.href = 'shoppingcart.php'; </script>
<?php
    $_SESSION['cart'] = $cart;
}
$totaalprijs = 0;

?>
<div>

    <header>
            <div class="row col-12">
                <h2 style="text-align: left;" class="col-2">Winkelwagen</h2>
                <h4 style="text-align:right;" class="col-10">Aanvullende beschrijving</h4>
            </div>
        <hr color="white">
    </header>
  
        <br>

        <?php
        SaveCart($cart);
        if (isset($_POST['update'])){
            $productId = $_POST['productId'];
            $quantity = $_POST['quantity'];
            UpdateProduct($productId,$quantity);
            ?> <script> window.location.href = 'shoppingcart.php'; </script> <?php
        }


        foreach ($_SESSION['cart'] as $item => $amount) {
            $Result = GetResult($Connection, $item);
            $Image = GetSingleImage($Connection, $item);
            $query = "SELECT QuantityOnHand FROM stockitemholdings WHERE stockitemid= ?";
            $statement = mysqli_prepare($Connection, $query);
            mysqli_stmt_bind_param($statement, 's', $item);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $voorraadcheck = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $artikelprijs = ($amount * $Result['SellPrice']);
            $totaalprijs = ($amount * $Result['SellPrice'] + $totaalprijs);
            foreach ($voorraadcheck as $voorraad) {
                if ($amount > $voorraad['QuantityOnHand']) {
                    $aantal = $voorraad;
                }
            ?>
            <div class="row col-12">
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
                                    <input type="number" min="1" max="<?php print($voorraad['QuantityOnHand'])?>" name="quantity" id="quantity" value="<?php print_r($amount) ?>"  class="field">
                                    <input type="text" name="productId" id="productId" value="<?php print_r($item) ?>" hidden>
                                    <button type="submit" name="update" id="update" class="btn btn-primary btn-outline-dark toevoegen">Update</button>
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

                        <td style="text-align:right;">Prijs: <?php print sprintf("€ %.2f", $artikelprijs)?></td>
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
            </div>
            <?php }
        }?>

        <br>
        <hr color="white">

    </div>

    <div class="row col-12">
        <form method="post" action="CartFuncties.php" class="col-6">
            <td>
                <label for="kortingsbon">Vul hier je kortingscode in (optioneel):</label><br>
                <input type="text" id="kortingsbon" name="kortingsbon" style="width:350px">
                <button type="submit" name="codetoevoegen" id="toevoegen" class="btn btn-primary btn-outline-dark toevoegen">Toevoegen</button>
            </td>
                <br>
        </form>
        <table class="col-2" style="margin-left:auto">
            <td style="text-align:right;" name="Totaal">Totaal Artikelen</td>
            <td style="text-align:right;" name="Prijs1"><?php print sprintf("€ %.2f", $totaalprijs) ?></td>

            <thead><br></thead>

            <td style="text-align:right;" name="Verzendkosten">Verzendkosten</td>
            <td style="text-align:right;" name="Prijs2">Gratis</td>

            <thead><br></thead>

            <td style="text-align:right;" name="Totaal">Totaal</td>
            <td style="righttext-align:right;" name="Prijs3"> <?php print sprintf("€ %.2f", $totaalprijs) ?></td>
        </table>
    </div>
  <form method="post" action="shoppingcart.php">
    <div style="text-align: center;">
        <input type="number" value='<?php print($Result["StockItemID"]) ?>' name="stockItemID" hidden>
        <input type="number" value='<?php print($Result["QuantityOnHand"]) ?>' name="QuantityOnHand" hidden>
        <a href="orderpage.php" class="btn btn-primary btn-outline-dark font-weight-bold" style="background-color: #FFFF00; width: 300px; height: 50px;" id="afronden" role="button"> Verder Gaan &nbsp; <i class="fas fa-arrow-right"></i></a>
    </div>
</form>
</div>
