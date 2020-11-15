<head>
    <title> </title>
    <link rel="stylesheet" type="text/css" href="Public/CSS/Style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
include __DIR__ . "/header.php";

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

    <table class="tbl-cart" cellpadding="10" cellspacing="5">
        <tbody>
        <tr>
            <td>
             <img border="5" src="Public\ProductIMGHighRes\mug.png" width="100" height="100" alt="kop">
            </td>

            <td style="text-align:left;" name="Productname">Productnaam<br>Beschrijving</td>

            <td style="text-align:left;">Verzend Informatie<br>Aanvullende Informatie</td>
            <td>
                <div id=field1>
                    Selecteer aantal:
                    <button type="button" id="sub" class=sub>-</button>
                    <input type="text" id="1" value=0 class=field>
                    <button type="button" id="add" class=add>+</button>
                    <script type='text/javascript' src='Public/JS/adjustbutton.js'></script>
                </div>
            </td>
            </select></td>

            <td style="text-align:right;">Prijs:</td>
    </tr>
    </tbody>
    </table>

    <br>
    <hr color="white">

</div>
    <div style="width:20%;">
        <form method="GET" action="CartFuncties.php">
            <td><label for="kortingsbon">Vul hier je kortingscode in (optioneel):</label>
                <input type="text" id="kortingsbon" name="kortingsbon" value="kortingsbon"></td><br>
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

<?php
include "CartFuncties.php";
$cart = GetCart();
print_r($cart);
?>
</body>
