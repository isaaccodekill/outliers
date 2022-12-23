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
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=1){
    header('Location: login.php');
    exit();
}
?>
    <div class="loginWrapper">
        <div class="loginFormContainer">
        <img src="./assets/images/logo.png" class="logo" />
        <div class="loginForm">
            <h1> Welcome back! </h1>
            <p> This page is for strictly managers</p>
            <form action="">
                <input type="text" name="email" placeholder="Email"/>
                <input type="password" name="password" placeholder="Password">
                <button class="submit" type="submit" value="submit">
                    <span>
                        Log in
                    </span>
                </button>
            </form>
        </div>
        </div>
        <div class="loginImage">
        <img src="./assets/images/manager.png" />
    </div>
    </div>
</body>
</html>