<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Manager Login</title>
</head>
<body>

<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/outliers/asset-mgmt/services/auth.php");

$email = $password = '';

// Form submit
if (isset($_POST['submit'])) {

    // Validate email
    if (!empty($_POST['email'])) {
        // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    };

    if(!empty($_POST['password'])){
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    }


    if (!empty($email) && !empty($password)) {
        // call login function

        $user = AuthService::authenticate($email, $password);
        if(isset($user) && $user['role'] === 'hr'){
            // user has signed in, store user info into session
            $_SESSION["ishr"] = 'true';
            $_SESSION["user"] = $user;
            header('Location:overview.php');
            exit();
        }else {
            echo '<script type="text/JavaScript"> 
            alert("Not allowed!!");
            </script>';
        }

    }
}
?>

<div class="loginWrapper">
    <div class="loginFormContainer">
        <img src="./assets/images/logo.png" class="logo" />
        <div class="loginForm">
            <h1> Welcome back! </h1>
            <p>This is strictly for members of the Human Resources dept  </p>
            <form action="login.php" method="POST">
                <input type="text" name="email" placeholder="Email"/>
                <input type="password" name="password" placeholder="Password">
                <button class="submit" type="submit" value="submit" name="submit">
                    <span>
                        Log in
                    </span>
                </button>
            </form>
        </div>
    </div>
    <div class="loginImage">
        <img src="./assets/images/hr.png" />
    </div>
</div>
</body>
</html><?php
