<head>
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head><?php
include __DIR__ . "/header.php";
include "accountFunctions.php";
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets_simple");?>
<div class="row">
    <div class="col-2"></div>
    <div class="form-group col-8">
    <form method="post">
        <h3 class="row loginTekst">Login.</h3>
        <a class="row">Vul hier uw logingegevens in.</a>
        <input placeholder="E-mail" name="email" class="loginInput">
        <input placeholder="Wachtwoord" type="password" name="password" class="loginInput">
        <input type="submit" class="loginInput col-2 btn btn-primary btn-outline-dark addToCartButton" value="Inloggen" name="submit"><br><br>
        <a href="register.php">Heeft u nog geen account? Klik dan hier!</a>
    </form>
    <?php
    if (isset($_POST['email']) && isset($_POST['password'])){
        if (login($Connection, $_POST['email'], $_POST['password']) == true) {
            ?>
            <div class="row"></div>
            <div class="col-2"></div><br>
            <form class="col-8" action="http://localhost/nerdygadgets/">
                <a>U bent ingelogd, klik op de knop om terug te gaan.</a>
                <input class="loginInput btn btn-primary btn-outline-dark addToCartButton" type="submit" value="Ga terug naar de homepagina." />
            </form>
            <?php
        }
        else {
            echo "<script type='text/javascript'>alert('De inloggegevens zijn onjuist, probeer het overnieuw.');</script>";
        }
    }
    ?>
    </div>
    <div class="col-2"
</div>