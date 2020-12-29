<head>
    <title> </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<>
<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
$ConnectionSimple = mysqli_connect("localhost", "root", "", "nerdygadgets_simple");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "viewFunctions.php";
include "accountFunctions.php";


if (isset($_SESSION['loggedIn']) == True) {
    $user = getInformation($ConnectionSimple, $_SESSION['user']);
}

$nameErr = $emailErr = $addressErr = $placeErr = $postalcodeErr = $houseErr = "";
$name = $email = $address = $place = $postalcode = $housenumber = "";
$totaalprijs = 0;
$verzendkosten = 0;

$cart = GetCart();

?>



<div>
    <header>
        <div class="row col-12">
            <h2 style="text-align: left;" class="col-2">Orderpagina</h2>
            <h4 style="text-align:right;" class="col-10">Aanvullende informatie</h4>
        </div>
    </header>
    <style>

    </style>
    <!--Begin hieronder aan de formulieren.-->
    <div class="row">
        <div class="col-8" style="border: 1px solid;">
        <form method='post' action="afrondingBestelling.php">
                     <h4 style="text-align: center;">Order gegevens</h4><br>
            <!--Name + Email-->
            <label for='fname'><i class='fa fa-user' style=" margin-left: 50px;"></i> Full Name</label>
            <label for='email'><i class='fa fa-envelope' style=" margin-left: 510px;"></i> Email</label><br>
            <!--Input Name + Email-->
            <input style="width:43.5%; margin-left: 50px;" type='text' name='name' value="<?php if (isset($user)) { print($user['firstName'] . " "); if (!empty($user['middleName'])) { print($user['middleName'] . " "); }; print($user['lastName']); } ?>" required>
            <input style="width:43.5%; margin-left: 50px;" type='email' id='email' name='email' value="<?php if (isset($user)) { print($user['email']); } ?>" required><br>
            <!--Gender en Address-->
            <br><label for="gender" style="margin-left: 50px;"> Gender</label>
            <label for='adr'><i style="margin-left: 125px;"></i> Address</label><br>
            <!--Gender-->
            <select name="gender" id="gender" style="width:10%; margin-left: 50px" required>
                <option value="hidden" hidden></option>
                <option value="man">Man</option>
                <option value="vrouw">Vrouw</option>
                <option value="onzijdig">Onzijdig</option>
            </select>
            <!--Adress input-->
            <input type='text' style="margin-left: 50px; width:76.8%" id='adr' name='address' value="<?php if (isset($user)) { print($user['address']); } ?>" required><br>
            <!--Place-->
            <br><label for='place'><i style="margin-left: 50px;"></i> Place</label><br>
            <input type='text' style="margin-left: 50px; width: 91%" id='city' name='city' value="<?php if (isset($user)) { print($user['city']); } ?>" required><br>

            <!--Postal code and house number-->
            <br><label for='adr' style="margin-left: 50px;"> Postal Code</label>
            <label for='adr'><i style="margin-left: 960px;"></i> House Number</label><br>
            <!--Input postal code and House number-->
            <input pattern="^[1-9][0-9]{3}?[A-Za-z]{2}$" maxlength="6" type='text' style="margin-left: 50px; width: 85%" id='postalcode' name='postalcode' value="<?php if (isset($user)) { print($user['postalCode']); } ?>" required>
            <input type='text' style="margin-left: 15px; width: 4%" id='adr' name='housenumber' value="<?php if (isset($user)) { print($user['houseNumber']); } ?>" required><br>
            <br>
            <div style="text-align: center;">
                <input type='hidden' value="<?php foreach ($cart as $item => $amount) {
                    $Result = GetResult($Connection, $item);
                    $totaalprijs = ($amount * $Result['SellPrice'] + ($totaalprijs));
                    $totaal = $totaalprijs+$verzendkosten;
                }  print ($totaal); ?>" name="totalPrice">
            <br><input type='submit' style="width: 20%; background-color: #FFFF00;"value='Send' class="btn btn-primary btn-outline-dark font-weight-bold" name="submit">
                </form>
            </div>
        </div>

        <div class="col-4" style="border: 1px solid;">
            <div class="container">
                <h4 style="text-align: center">Cart</h4>
                <br><h4>Totaal artikelen:   <?php headerCartAmount()?></h4>
                <br><h4>Verzendkosten:  <?php print($verzendkosten)?></h4>
                <br><h4>Kortingscode: Geen</h4>
                <br><hr color="white">
                <?php foreach ($cart as $item => $amount) {
                    $Result = GetResult($Connection, $item);
                    $Image = GetSingleImage($Connection, $item);
                    $totaalprijs = ($amount * $Result['SellPrice'] + ($totaalprijs));
                }
                $totaal = $totaalprijs+$verzendkosten
                ?>

                <h4>Totaal: <?php print sprintf("€ %.2f", $totaal);?></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8"
             <h6 style="text-align: center">Artikelen</h6>
        <br><br>
    </div>


<?php foreach ($cart as $item => $amount) {
    $Result = GetResult($Connection, $item);
    $Image = GetSingleImage($Connection, $item);
    $totaalprijs = ($amount*$Result['SellPrice']+($totaalprijs));
    ?>

            <div class="col-6" style="border: 1px solid; margin-left: 20px;"
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
                            </div><br>
                        <?php } ?>
                    </td>
                    <?php
                    //
                    ?>
                        <br><br><br><br><td> <p style="text-align:center;" name="Productname"><?php print ($Result['StockItemName']); ?></p>
                                        <h2 style="text-align: center;">Aantal: <?php print($amount)?></h2><br><br><br><br>
                        <br><br>


                    </td>
            </div>
    <div class="col-2" style="border: 1px solid;">
    <div class="container">
            <br><h2 style="text-align: center;">Bezorging</h2><br>
        <div style="height: auto;">
            <p>Dag</p><br>
            <p>Tijd <?php //print sprintf("€ %.2f", $Result['SellPrice']); ?></p><br>
            <p>Verzendingstype</p>
        </div>
    </div>
</div>
            </tr>
            </tbody>
        </table>
            <br>
        <?php } ?>
    </div>
</body>
<br>

</div>
<div style="width:20%;">
</div>
