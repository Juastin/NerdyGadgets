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
include "CartFuncties.php";
include "viewFunctions.php";
?>

<div>
    <header>
        <h2 style="text-align: left;">Betaalpagina</h2>
        <h6 style="text-align:right;">Aanvullende beschrijving</h6>
    </header>

    <style>

    </style>

    <hr color="white">
    <br>
        <table class="tbl-cart" cellpadding="10" cellspacing="5">
            <tbody>
            </tbody>
        </table>

    <br>
    <hr color="white">

</div>
<div style="width:20%;">
</div>
