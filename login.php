<head>
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head><?php
include __DIR__ . "/header.php";
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets_simple");?>
<div class="row">
    <div class="col-2"></div>
    <form method="post" class="form-group col-8">
        <h3 class="row loginTekst">Login.</h3>
        <a class="row">Vul hier uw logingegevens in.</a>
        <input placeholder="E-mail" name="email" class="loginInput">
        <input placeholder="Wachtwoord" type="password" name="password" class="loginInput">
        <input type="submit" class="loginInput col-2 btn btn-primary btn-outline-dark addToCartButton" value="Inloggen" name="submit">
    </form>
    <?php login($Connection, $_POST); ?>
    <div class="col-2"
</div>