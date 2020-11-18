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
    <form method='post'>
        <!--Name + Email-->
        <label for='fname'><i class='fa fa-user' style=" margin-left: 50px;"></i> Full Name</label>
        <label for='email'><i class='fa fa-envelope' style=" margin-left: 790px;"></i> Email</label><br>
        <!--Input Name + Email-->
        <input style="width:43.5%; margin-left: 50px;" type='text' name='name' placeholder="John" >
        <input style="width:43.5%; margin-left: 50px;" type='text' id='email' name='email' placeholder='john@example.com'><br>
        <!--Adress-->
        <br><label for='adr'><i style="margin-left: 50px;"></i> Address</label><br>
        <input type='text' style="margin-left: 50px; width: 90%" id='adr' name='address' placeholder='42 W. 15th Street'><br>
        <!--Place-->
        <br><label for='place'><i style="margin-left: 50px;"></i> Place</label><br>
        <input type='text' style="margin-left: 50px; width: 90%" id='place' name='place' placeholder='New York'><br>
        <!--Postal code and house number-->
        <br><label for='adr'><i style="margin-left: 50px;"></i> Postal Code</label>
        <label for='adr'><i style="margin-left: 1530px;"></i> House Number</label><br>
        <!--Input postal code and House number-->
        <input type='text' style="margin-left: 50px; width: 85%" id='postalcode' name='postalcode' placeholder='4444KA'>
        <input type='text' style="margin-left: 15px; width: 4%" id='adr' name='housenumber' placeholder='10'><br>
        <br>
        <div style="text-align: center;">
        <input type='submit' style="width: 20%;"value='Send' name="submit">
        </div>

        <?php
        if (isset($_POST["submit"])) {
echo("Knop gedrukt");
        }
        ?>

</div>
<div style="width:20%;">
</div>
