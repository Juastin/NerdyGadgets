<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
include "CartFuncties.php";
include "viewFunctions.php";
?>


<div style="text-align: center;">
    <form method="post" action="bestellingAfgerond.php">
        <input type="submit" class="btn btn-primary btn-outline-dark font-weight-bold" name="afronden" style="background-color: #FFFF00; width: 200px;" value="Bestelling Afronden">
    </form>
</div>