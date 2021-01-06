<?php
session_start();

$_SESSION['loggedIn'];
if ($_SESSION['loggedIn'] == false) {
    header('Location: login.php');
}
include __DIR__ . "/header.php";
include "accountFunctions.php";
$Connection = mysqli_connect("localhost", "root", "MaineCoon18", "nerdygadgets_simple");
$row = getInformation($Connection, $_SESSION['user']); ?>
<div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
        <i class="fas fa-user fa-5x"></i>
            <a class="accountHeader">Welkom, <?php print($row['firstName']." "); print($row['middleName']." "); print($row['lastName']." ");?></a>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="accountContainer">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <i class="fas fa-user"></i>
            <a class="accountInfo">Klantennummer: <?php print($row['userId']);?></a>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <i class="fas fa-envelope"></i>
            <a class="accountInfo"><?php print($row['email']);?></a>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <i class="fas fa-home"></i>
            <a class="accountInfo"><?php print($row['address']." "); print($row['houseNumber'].", "); print($row['city']." "); ?></a>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <i class="fas fa-map-marker-alt"></i>
            <a class="accountInfo"><?php print($row['postalCode'])?></a>
        </div>
    </div>
</div>