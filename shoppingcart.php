<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
include __DIR__ . "/header.php";
include "CartFuncties.php";
include "viewFunctions.php";
$cart = GetCart();
print_r($cart);
//$Images['ImagePath'];
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
    <?php foreach ($cart as $item => $amount) { ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="5">
            <tbody>
            <tr>
                <td>
                    <?php
                    $Image = GetSingleImage($Connection, $item);
                    if ($Image != null) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php
                             print ($Image);
                         ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;">
                    </div>
                <?php } else {
                        $Result = GetResult($Connection, $item); ?>
                        <div id="ImageFrame"
                         style="background-image: url('Public/StockGroupIMG/<?php
                             print ($Result['BackupImagePath']);
                         ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;">
                    </div>
                   <?php } ?>
                </td>

                <td style="text-align:left;" name="Productname">Productnaam<br>Beschrijving</td>

                <td style="text-align:left;">Verzend Informatie<br>Aanvullende Informatie</td>

                <td><label for="amount">Selecteer aantal:</label></td>

                <td><input type="number" id="$=amount" name="amount" value="<?php print($amount) ?>">
<!--                    <select class="" name="Aantal" id="Aantal">-->
<!--                        <option value="1">1</option>-->
<!--                        <option value="2">2</option>-->
<!--                        <option value="3">3</option>-->
<!--                        <option value="4">4</option>-->
<!--                        <option value="5">5</option>-->
<!--                    </select>-->
                </td>

                <td style="text-align:right;">Prijs:</td>
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

