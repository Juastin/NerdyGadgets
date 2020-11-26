<?php
session_start();

$_SESSION['loggedIn'];
if ($_SESSION['loggedIn'] == false) {
    header('Location: login.php');
}
include __DIR__ . "/header.php";
include "accountFunctions.php";
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets_simple");
$row = getInformation($Connection, $_SESSION['user']);
print_r($row);
