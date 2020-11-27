<?php
// Registers user with information out of post from register.php
// @Param $connection: mysqli_connect
// @Param $post: $_POST
// @Return: void
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
// User login set $_SESSION['loggedIn'] true when email and password are correct from login.php
// @Param $connection: mysqli_connect
// @Param $email: $_POST['email']
// @Param $password: $_POST['password']
// @Return: void
function login ($connection, $email, $password) {
    $query = "
                    SELECT email, password
                    FROM user
                    WHERE email='$email'";

    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    if (mysqli_stmt_num_rows($statement) > 0) {
        mysqli_stmt_bind_result($statement, $email, $password_hash);
        mysqli_stmt_fetch($statement);
        if (password_verify($password, $password_hash)){
            unset($_SESSION['loggedIn']);
            unset($_SESSION['user']);
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['user'] = $email;
            return true;
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}
// Checks if email exists in table user of database
// @Param $connection: mysqli_connect
// @Param $email: string email
// @Return: True || False
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
// Returns data of specific user from database
// @Param $connection: mysqli_connect
// @Param $email: string email
// @Return: array(firstName, middleName, lastName, postalCode, email, city, address, houseNumber, tel)
function getInformation($connection, $email){
    $query =
        "SELECT firstName, middleName, lastName, postalCode, 
        email, city, address, houseNumber, tel FROM user WHERE email = '".$email."'";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result);
}