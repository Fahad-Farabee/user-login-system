<?php
declare (strict_types=1);
//if we need to run any query we will have to use this model.
//like if i want to check if there is any other user by the same name or not.

//1.if the usename exists
function get_username(object $pdo, string $username){
    $quey = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($quey);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function get_email(object $pdo, string $email){
    $quey = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($quey);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//creating a user .
function set_user(object $pdo, string $username, string $pwd ,string $email){
    $quey = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
    $stmt = $pdo->prepare($quey);

    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}