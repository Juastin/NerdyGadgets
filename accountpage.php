<?php
if (!$_SESSION['loggedIn'] == TRUE) {
    header('Location: login.php');
}
include __DIR__ . "/header.php";
print_r($_SESSION);