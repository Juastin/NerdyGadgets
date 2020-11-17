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
include "viewFunctions.php";
?>

<div>
    <header>
        <h2 style="text-align: center;">Betaalpagina</h2>
    </header>

    <style>

    </style>
    <!--Kale witte lijn: <hr color="white">-->
    <br>
        <table class="tbl-cart" cellpadding="10" cellspacing="5">
        </table>

    <br>
    <!--Begin hieronder aan de formulieren.-->
    <form method='get' action='NAW.php'>
        <label for='fname'><i class='fa fa-user' style=" margin-left: 20px;"></i> Full Name</label><br>
        <input style="width:30%; margin-left: 100px;" type='text' id='firstname' name='firstname' placeholder='John M. Doe'><br>
        <label for='email'><i class='fa fa-envelope'></i> Email</label>
        <input type='text' id='email' name='email' placeholder='john@example.com'><br>
        <label for='adr'><i class='fa fa-address-card-o'></i> Address</label>
        <input type='text' id='adr' name='address' placeholder='42 W. 15th Street'><br>
        <label for='place'><i class='fa fa-place'></i> Place</label>
        <input type='text' id='place' name='place' placeholder='New York'><br>
        <label for='adr'><i class='fa fa-postal-code-o'></i> Postal Code</label>
        <input type='text' id='postalcode' name='postalcode' placeholder='4444KA'><br>
        <label for='adr'><i class='fa fa-house_number-o'></i> House Number</label>
        <input type='text' id='adr' name='housenumber' placeholder='10'><br>
        <br><input type='submit' value='Verzenden'>


</div>
<div style="width:20%;">
</div>
