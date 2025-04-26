<?php
declare (strict_types=1);
//if we want to do something with the given data, then we have to use controller.
//like now we have to check the inputs of the sign up form 

//1. checking if the form is empty or not..
function is_input_empty(string $username, string $pwd, string $email){
    if(empty($username) || empty($pwd) || empty($email) ){
        return true;
    }else{
        return false;
    }
}
//2. checking if the email is valid or not.
function is_email_invalid(string $email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}
//3. checking if the username is taken or not
function is_username_taken(object $pdo,string $username){
    if(get_username( $pdo,$username)){
        return true;
    }else{
        return false;
    }
}
//5. checking if the email is taken or not
function is_email_registered(object $pdo,string $email){
    if(get_email( $pdo,$email)){
        return true;
    }else{
        return false;
    }
}

//creating a user.
function create_user(object $pdo, string $username, string $pwd, string $email){
    set_user($pdo, $username, $pwd, $email);
}
