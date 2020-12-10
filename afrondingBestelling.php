<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "viewFunctions.php";
print_r($_POST);
print_r($_SESSION);
?>


<div style="text-align: center;">
    <form method="post" action="bestellingAfgerond.php">
        <input type="submit" class="btn btn-primary btn-outline-dark font-weight-bold" name="afronden" style="background-color: #FFFF00; width: 200px;" value="Bestelling Afronden">
        <input type="hidden" name="name" value="<?php print($_POST['name']); ?>">
        <input type="hidden" name="email" value="<?php print($_POST['email']); ?>">
        <input type="hidden" name="gender" value="<?php print($_POST['gender']); ?>">
        <input type="hidden" name="address" value="<?php print($_POST['address']); ?>">
        <input type="hidden" name="city" value="<?php print($_POST['city']); ?>">
        <input type="hidden" name="postalcode" value="<?php print($_POST['postalcode']); ?>">
        <input type="hidden" name="housenumber" value="<?php print($_POST['housenumber']); ?>">
        <input type="hidden" name="price" value="<?php print($_POST['totalPrice']); ?>">
    </form>
</div>