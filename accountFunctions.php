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
                    SELECT password, userId
                    FROM user
                    WHERE email = '".$email."'";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($statement);
//    print($R);
//    if (password_verify($password, $R) == TRUE){
//        $_POST['login'] ==
//    };
}
function checkEmailExist($email, $connection){
//    print $email;
//    $query = "SELECT COUNT(*) FROM user WHERE email = '".$email."'";
    $query = "SELECT email FROM user WHERE email = '".$email."'";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($statement);
    if (mysqli_stmt_num_rows($statement) > 0) {
        return print "Bestaat al";
    }
    else {
        return "nah fam";
    }
//    print($result);
//    if ($result > 0) {
//        return print "email is bekend";
//    }
//    else {
//        return print "nah man";
//    }
}