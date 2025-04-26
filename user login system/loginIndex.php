<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/signup_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Login</h3>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="username"><br>
        <input type="password" name="pwd" placeholder="password"><br>
        <button>Login</button>
    </form>
 
    <h3>Signup</h3>
    <form action="includes/signup.inc.php" method="post">
        <!-- <input type="text" name="username" placeholder="username"><br>
        <input type="password" name="pwd" placeholder="password"><br>
        <input type="text" name="email" placeholder="e-mail"><br> -->
        <?php
        signup_inputs();
        ?>
        
        <button>Signup</button>
    </form>
    <?php
        check_sign_up_error();
    ?>

</body>
</html>