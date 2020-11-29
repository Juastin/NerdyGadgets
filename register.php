<head>
    <title>Registreren</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head><?php
include __DIR__ . "/header.php";
include "accountFunctions.php";
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets_simple"); ?>
<div class="row">
    <div class="col-2"></div>
    <form method="post" class="form-group col-8" >
        <h1 class="row loginTekst">Registreren.</h1>
        <a class="row">Vul hier uw gegevens in om te registreren.</a>
        <a class="row">Alle velden met sterretje zijn verplicht.</a>
        <label for="firstname" class="loginInput">Voornaam*</label>
            <input placeholder="Voornaam*" name="firstname" required>
        <label for="middlename" class="loginInput">Tussenvoegsel</label>
            <input placeholder="Tussenvoegsel" name="middlename">
        <label for="lastname" class="loginInput">Achternaam*</label>
            <input placeholder="Achternaam*" name="lastname" required>
        <label for="email" class="loginInput">E-mail*</label>
        <br><a class="regfieldInfo">Wij gebruiken uw E-mail om facturen te versturen of u op de hoogte te stellen van uw bestelling</a>
            <input placeholder="E-mail*" type="email" name="email" required>
        <label for="password" class="loginInput">Wachtwoord*</label>
            <input placeholder="Wachtwoord*" type="password" name="password" required>
        <label for="passwordcheck" class="loginInput">Wachtwoord herhalen*</label>
            <input placeholder="Wachtwoord herhalen*" type="password" name="passwordcheck" required>
        <label for="city" class="loginInput">Woonplaats*</label>
            <input placeholder="Woonplaats*" name="city" required>
        <label for="address" class="loginInput">Adres*</label>
            <input placeholder="Adres*" name="address" required>
        <label for="housenumber" class="loginInput">Huisnummer*</label>
            <input placeholder="Huisnummer*" name="housenumber" required>
        <label for="postalcode" class="loginInput">Postcode*</label>
            <input placeholder="Postcode*" name="postalcode" required>
        <label for="tel" class="loginInput">Telefoonnummer</label>
        <br><a class="regfieldInfo">Wij kunnen uw telefoonnumer gebruiken om u te bellen als er wat mis is met uw bestelling</a>
            <input placeholder="Telefoonnummer" name="tel">
        <input type="submit" class="loginInput col-2 btn btn-primary btn-outline-dark addToCartButton" value="Registreren" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        if ($_POST['password'] == $_POST['passwordcheck']) {
            if (checkEmailExist($Connection, $_POST['email']) == false){
                register($Connection, $_POST);
            }
            else {
                echo "<script type='text/javascript'>alert('Email is al bekend bij ons, gebruik een ander email');</script>";
            }
        }
        else {
            echo "<script type='text/javascript'>alert('Wachtwoorden komen niet overeen met elkaar');</script>";
        }
    }
//    Register($Connection, $_POST)
//    print_r($_POST);
    ?>
    <div class="col-2"></div>
</div>
