<?php
session_start();
$_SESSION['loggedIn'];
if ($_SESSION['loggedIn'] == false) {

    header('Location: login.php');
}
include __DIR__ . "/header.php";
