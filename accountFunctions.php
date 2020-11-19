<?php
function register ($Connection, $post) {
    print_r($post);
    print($post['firstname']);
    $firstname = $post['firstname'];
    $middlename = $post['middlename'];
    $lastname = $post['lastname'];
    $password = password_hash($post['password'], PASSWORD_BCRYPT);
    $postalcode = $post['postalcode'];
    $email = $post['email'];
    $city = $post['city'];
    $address = $post['address'];
    $tel = $post['tel'];
    $Query = "
    INSERT INTO user (firstName, middleName, lastName, password, postalCode, email, city, address, tel) 
    VALUES ('".$firstname."',
    '".$middlename."','".$lastname."',
    '".$password."','".$postalcode."',
    '".$email."','".$city."',
    '".$address."','".$tel."')";
    $Statement = mysqli_prepare($Connection, $Query);
//    mysqli_stmt_bind_param($Statement, "i", );
    mysqli_stmt_execute($Statement);
}
function login ($Connection, $post) {
    print ($post);
    print $Connection;
}