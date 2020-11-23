<head>
    <title> </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "CartFuncties.php";
include "viewFunctions.php";

if (!isset($_POST["submit2"])){
    $cart = GetCart();
    $_SESSION["cart"] = $cart;
    } else {
    RemoveProductFromCart($_POST["stockItemID"]);
    $cart = GetCart();
    $_SESSION["cart"] = $cart;
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

    <?php foreach ($cart as $item => $amount) {
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
                <td style="text-align:left;" name="Productname"><?php print ($Result['StockItemName']); ?><br>Beschrijving</td>

                <td style="text-align:left;">Verzend Informatie<br>Aanvullende Informatie</td>

                <td>
                    <div id=field1>
                        Selecteer aantal:
                        <button type="button" id="sub" class=sub>-</button>
                        <input type="text" id="1" value=0 class=field>
                        <button type="button" id="add" class=add>+</button>
                        <script type='text/javascript' src='Public/JS/adjustbutton.js'></script>
                        <br><?php ProductVooraad($Connection, $item); ?>
                    </div>
                </td>
<!--                <td><label for="amount">Selecteer aantal:</label>-->
<!--                    <input type="number" id="$=amount" name="amount" value="--><?php //print($amount) ?><!--">-->
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
                    <form method="post" >
                        <input type="number" value='<?php print($item) ?>' name="stockItemID" hidden>
                        <input type="submit" class="btn btn-primary btn-outline-dark removeFromCartButton" name="submit2" value="Verwijder product">
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
