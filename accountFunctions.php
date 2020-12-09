<?php
// Registers user with information out of post from register.php
// @Param $connection: mysqli_connect
// @Param $post: $_POST
// @Return: void
function register ($connection, $post) {
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
        VALUES (?,?,?,?,?,?,?,?,?,?);";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 'ssssssssss', $firstname, $middlename, $lastname, $password, $postalcode, $email, $city, $address, $housenumber, $tel);
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
                    WHERE email= ?";

    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 's', $email);
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
    $query = "SELECT email FROM user WHERE email = ?";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);

    if (mysqli_stmt_num_rows($statement) > 0) {
        return true;
    }
    else {
        return false;
    }
}
// Returns data of specific user from user table from database
// @Param $connection: mysqli_connect
// @Param $email: string email
// @Return: 2 dimensional array: array(array(userId => int, firstName => string, middleName => string, lastName => string, postalCode => string, email => string, city => string, address => string, houseNumber => string, tel => string));
function getInformation($connection, $email){
    $query =
        "SELECT userId, firstName, middleName, lastName, postalCode, 
        email, city, address, houseNumber, tel FROM user WHERE email = ?";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $user =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $user[0];
}

// Saves a review together with the id of the belonging user and the id of the belonging stockitem out of posts from view.php
// @Param $connection: mysqli_connect
// @Param $userId: $_POST['reviewer']
// @Param $review: $_POST['review']
// @Param $stockitem: $_POST['stockitemid']
// @Return: void
function PlaceReview($connection, $userId, $review, $stockitem) {
    $query = "INSERT INTO review (reviewer, review, stockitem) VALUES (?,?,?)";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 'isi', $userId, $review, $stockitem);
    mysqli_stmt_execute($statement);
}

// Returns reviewers with their reviews and datetime of placing, belonging to the specific article at view.php from database
// @Param $connection: mysqli_connect
// @Param $stockitemAtshop: $Result["StockItemID"]
// @Return: associative array: Array ([] => Array (firstName, middleName, lastName, review, stockitem, date);
function ViewReview($connection, $stockitemAtShop) {
    $query = "SELECT firstName, middleName, lastName, review, stockitem , date FROM review JOIN user ON userId = reviewer WHERE stockitem = ? ORDER BY date DESC";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 'i', $stockitemAtShop);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    return  mysqli_fetch_all($result,MYSQLI_ASSOC);
}