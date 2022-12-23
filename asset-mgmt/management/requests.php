<?php
session_start();

if(!isset($_SESSION['ismanager'])){
    header('Location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/manager.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Manager - All Requests</title>
</head>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/services/manager.php");
$requests = ManagerService::getAllConcernedRequests();

?>
<div class="managerWrapper">
    <div class="managerWrapperTop">
    <img src="./assets/images/logo.png" class="logo" />
    <a href="./index.php"> View New Requests </a>
    <a href="./logout.php"> Logout </a>
    </div>


    <div class="managerHeading">
        <h1> All Requests </h1>
        <p> View All approved or rejected requests</p>
    </div>

    <div class="incomingRequests">

        <?php if (empty($requests)): ?>
            <p class="lead mt-3">There are no approved or rejected requests</p>
        <?php endif; ?>
        <?php if (!empty($requests)): ?>
        <div class="card">
            <?php foreach ($requests as $item): ?>
                <div class="requestitem">
                    <?php echo ($item["status"] === "rejected" ? '❌': '✅').' Request for '.$item["title"].' by '.$item["firstname"].' '.$item["lastname"].' was '.($item["status"] === "rejected" ? 'rejected' : 'accepted')  ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
</div>
</div>
</body>