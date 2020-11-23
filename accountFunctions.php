<?php
function register ($connection, $post) {
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
    $housenumber = $post['housenumber'];
    $tel = $post['tel'];
        $query = "
        INSERT INTO user (firstName, middleName, lastName, password, postalCode, email, city, address, houseNumber, tel) 
        VALUES ('".$firstname."',
        '".$middlename."','".$lastname."',
        '".$password."','".$postalcode."',
        '".$email."','".$city."',
        '".$address."','".$housenumber."','".$tel."')";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($statement);
}
function login ($connection, $email, $password) {
    $query = "
                    SELECT email, password
                    FROM user
                    WHERE email = '".$email."'";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $email, $hash);
    if(password_verify($password, $hash)) {
        print "Nice, wachtwoord klopt";
    }
    else {
        print "Lol ur bad, password dont match";
    }
}
function checkEmailExist($connection, $email){
    $query = "SELECT email FROM user WHERE email = '".$email."'";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    if (mysqli_stmt_num_rows($statement) > 0) {
        return true;
    }
    else {
        return false;
    }
}