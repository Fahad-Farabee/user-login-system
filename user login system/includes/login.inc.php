<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try{
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_control.inc.php';

        //ERROR HAndlers
        $errors = [];
        //1. if the input fields are empty or not.
        if( is_input_empty($username, $pwd)){
            $errors["empty_input"] = "Fill in all fields";
        }
        $result = get_user($pdo,$username);
        if(is_username_wrong($result)){
            $errors["login_incorrect"] = "Incorrect Login Info!";
        }
        if(!is_username_wrong($result) && is_password_wrong($pwd,$result["pwd"])){
            $errors["login_incorrect"] = "Incorrect login info";
        }
        //showing the error massages.
        require_once "config_session.inc.php";
        if($errors){
            $_SESSION["errors_login"] = $errors;
            header("Location: ../loginIndex.php");
            die();
        }
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../loginIndex.php?login=success");
        $pdo = null;
        $stmt = null;
    }catch(PDOException $e){
        die("Query Failed: " . $e->getMessage());
    }

}else{
    header("Location: ../loginIndex.php");
    die();
}
