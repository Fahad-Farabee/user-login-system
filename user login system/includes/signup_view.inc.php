<?php
declare (strict_types=1);

function signup_inputs(){
    if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])){
        echo '<input type="text" name="username" placeholder="username" value = "'. $_SESSION["signup_data"]["username"] .'"><br>';
    }
    else{
        echo '<input type="text" name="username" placeholder="username"><br>';
    }

    echo '<input type="password" name="pwd" placeholder="password"><br>';

    if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_used"]) && !isset($_SESSION["errors_signup"]["invalid_email"])){
        echo ' <input type="text" name="email" placeholder="e-mail" value = "' . $_SESSION["signup_data"]["email"] .  '"><br>';
    }
    else{
        echo ' <input type="text" name="email" placeholder="e-mail"><br>';
    }
}


function check_sign_up_error(){
    if(isset($_SESSION['error_signup'])){
        $errors = $_SESSION['error_signup'];

        echo "<br>";

        foreach($errors as $error){
            echo '<p>' . $error . '</p>';
        }


        unset($_SESSION['error_signup']);
    }else if(isset($_GET["signup"]) && $_GET["signup"]==="success"){
        echo "Signup Success!!!!!";
    }
}



