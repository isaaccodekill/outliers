<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/manager.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Manager</title>
</head>
<body>
<?php 
// if(!isset($_SESSION['isManagerLoggedIn']) || $_SESSION['isManagerLoggedIn']!=1){
//     header('Location: login.php');
//     exit();
// }

echo "the main page";
echo $_SESSION['ismanager'];
?>
</body>