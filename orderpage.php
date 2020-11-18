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

$nameErr = $emailErr = $addressErr = $placeErr = $postalcodeErr = $houseErr = "";
$name = $email = $address = $place = $postalcode = $housenumber = "";
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
        <label for='email'><i class='fa fa-envelope' style=" margin-left: 785px;"></i> Email</label><br>
        <!--Input Name + Email-->
        <input style="width:43.5%; margin-left: 50px;" type='text' name='name' placeholder="John" required>
        <input style="width:43.5%; margin-left: 50px;" type='text' id='email' name='email' placeholder='john@example.com' required><br>
        <!--Gender en Address-->
        <br><label for="gender"><i style="margin-left: 170px;"</i> Gender:</label>
        <label for='adr'><i style="margin-left: 100px;"></i> Address</label><br>
        <!--Male-->
        <input type="radio" id="male" name="gender" value="male" style="transform: scale(2);width: 50px; height: auto; margin-left: 50px;">
        <label for="male">Male</label>
        <!--Female-->
        <input type="radio" id="female" name="gender" value="female" style="transform: scale(2);width: 50px; height: auto; margin-left: 20px;">
        <label for="female">Female</label>
        <!--Other-->
        <input type="radio" id="other" name="gender" value="other" style="transform: scale(2);width: 50px; height: auto; margin-left: 20px;">
        <label for="other">Other</label>
        <!--Adress input-->
        <input type='text' style="margin-left: 100px; width: 66.5%" id='adr' name='address' placeholder='42 W. 15th Street' required><br>
        <!--Place-->
        <br><label for='place'><i style="margin-left: 50px;"></i> Place</label><br>
        <input type='text' style="margin-left: 50px; width: 90%" id='place' name='place' placeholder='New York' required><br>
        <!--Postal code and house number-->
        <br><label for='adr'><i style="margin-left: 50px;"></i> Postal Code</label>
        <label for='adr'><i style="margin-left: 1520px;"></i> House Number</label><br>
        <!--Input postal code and House number-->
        <input type='text' style="margin-left: 50px; width: 85%" id='postalcode' name='postalcode' placeholder='4444KA' required>
        <input type='text' style="margin-left: 15px; width: 4%" id='adr' name='housenumber' placeholder='10' required><br>
        <br>
        <div style="text-align: center;">
        <br><input type='submit' style="width: 20%;"value='Send' name="submit">
        </div>

        <?php

        if (isset($_POST["submit"])) {

            //Code hieronder zou checken of de velden 'name' en 'email' zijn ingevuld. Heb het toch anders gedaan
            //met justin's advies voor een required in de html tag
            //if (empty($_POST["name"]) OR empty($_POST["email"]) ) {
            //    print("Niet alle velden zijn ingevuld");
            //} else {
            //    $name = test_input($_POST["name"]);
            //    print($name);
            //}
            // Onderstaande code checkt of het een email is. en print dat uit onder de send knop.
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Dit is geen email joh"; ?>
                <h3 style="color: red; text-align: center;"><?php print($emailErr); ?></h3>
        <?php
            } else { ?>
                <h3 style="color: green; text-align: center;"><?php print("Ja dat kan kloppen!"); ?></h3> <?php
            }



//Code hieronder zou de ingevulde gegevns ophalen uit de ingevoerde velden.
//$name = test_input($_POST["name"]);
//$email = test_input($_POST["email"]);
//$address = test_input($_POST["address"]);
//$place = test_input($_POST["place"]);
//$postalcode = test_input($_POST["postalcode"]);
//$housenumber = test_input($_POST["housenumber"]);
            //Functie test_input maakt de string mooier.
            //trim($data) zorgt ervoor dat de spatie voor en achteraan worden weg gehaald
            //stripslashes($data) haalt de \ weg.
            //htmlspecialchars($data) doet ook iets. kunnen we vast zonder leven.!
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

</div>
<div style="width:20%;">
</div>
