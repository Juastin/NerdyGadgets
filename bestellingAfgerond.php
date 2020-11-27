<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
session_start();
include __DIR__ . "/header.php";
?>
<body style="text-align: center;">

Je hebt de bestelling afgerond!

</body>