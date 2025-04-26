<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try{
        require_once "dbh.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_control.inc.php";

        //error handlers
        //quwey->
        //show sothing on websit->
        //doing something with the data inputs-> contoller

        $errors = [];
        //1. if the input fields are empty or not.
        if( is_input_empty($username, $pwd, $email)){
            $errors["empty_input"] = "Fill in all fields";
        }
        //2. if the email is valid or not.
        if(is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid Email used";
        }
        //3. checking if the username is taken or not.
        if( is_username_taken( $pdo, $username)){
            $errors["username_taken"] = "Username already taken";
        }
        //4. checking if the email is taken or not.
        if( is_email_registered( $pdo, $email)){
            $errors["email_used"] = "Email already registered!";
        }
        //showing the error massages.
        require_once "config_session.inc.php";
        if($errors){
            $_SESSION["error_signup"] = $errors;
            $signupData = [
                "username"=> $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;
            header("Location: ../loginIndex.php");
            die();
        }

        //after checking the errors , we need to create the user.
        create_user( $pdo,  $username,  $pwd,  $email);

        header("Location: ../loginIndex.php?signup=success");
        $pdo = null;
        $stmt = null;
        die();
        

    }catch(PDOException $e){
        die("Query Failed: " . $e->getMessage());
    }

}else{
    header("Location: ../loginIndex.php");
    die();
}