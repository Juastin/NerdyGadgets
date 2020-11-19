<head>
    <title>Registreren</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head><?php
include __DIR__ . "/header.php";
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets_simple"); ?>
<div class="row">
    <div class="col-2"></div>
    <form method="post" class="form-group col-8">
        <h1 class="row loginTekst">Registreren.</h1>
        <a class="row">Vul hier uw gegevens in om te registreren.</a>
        <a class="row">Alle velden met sterretje zijn verplicht.</a>
        <input placeholder="Voornaam*" name="firstname" class="loginInput" required>
        <input placeholder="Tussenvoegsel*" name="middlename" class="loginInput" required>
        <input placeholder="Achternaam*" name="lastname" class="loginInput" required>
        <input placeholder="E-mail*" type="email" name="email" class="loginInput" required>
        <input placeholder="Wachtwoord*" type="password" name="password" class="loginInput" required>
        <input placeholder="Woonplaats*" name="city" class="loginInput" required>
        <input placeholder="Adres*" name="address" class="loginInput" required>
        <input placeholder="Postcode*" name="postalcode" class="loginInput" required>
        <input placeholder="Telefoonnummer" name="tel" class="loginInput">
        <input type="submit" class="loginInput col-2 btn btn-primary btn-outline-dark addToCartButton" value="Registreren" name="submit">
    </form>
    <?php print_r($_POST); ?>
    <div class="col-2"
</div>
