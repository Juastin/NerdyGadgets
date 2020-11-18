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
        <br>
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
    <form method='get' action='php'>
        <!--Name + Email-->
        <label for='fname'><i class='fa fa-user' style=" margin-left: 50px;"></i> Full Name</label>
        <label for='email'><i class='fa fa-envelope' style=" margin-left: 770px;"></i> Email</label><br>
        <!--Input Name + Email-->
        <input style="width:42.5%; margin-left: 50px;" type='text' id='firstname' name='name' placeholder='John M. Doe'>
        <input style="width:42.5%; margin-left: 100px;" type='text' id='email' name='email' placeholder='john@example.com'><br>
        <!--Adress-->
        <br><label for='adr'><i style="margin-left: 50px;"></i> Address</label><br>
        <input type='text' style="margin-left: 50px; width: 90%" id='adr' name='address' placeholder='42 W. 15th Street'><br>
        <!--Place-->
        <br><label for='place'><i style="margin-left: 50px;"></i> Place</label><br>
        <input type='text' style="margin-left: 50px; width: 90%" id='place' name='place' placeholder='New York'><br>
        <!--Postal code-->
        <br><label for='adr'><i style="margin-left: 50px;"></i> Postal Code</label><br>
        <input type='text' style="margin-left: 50px; width: 90%" id='postalcode' name='postalcode' placeholder='4444KA'><br>
        <!--House number-->
        <br><label for='adr'><i style="margin-left: 50px;"></i> House Number</label><br>
        <input type='text' style="margin-left: 50px; width: 90%" id='adr' name='housenumber' placeholder='10'><br>
        <br><input type='submit' style="width: 20%;"value='Send'>


</div>
<div style="width:20%;">
</div>
