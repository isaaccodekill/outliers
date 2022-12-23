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
session_start();
if(!isset($_SESSION['ismanager'])){
    header('Location:login.php');
    exit();
}



require_once($_SERVER["DOCUMENT_ROOT"]."/outliers/asset-mgmt/services/manager.php");
$requests = ManagerService::getRedirectedRequests();


if (isset($_POST['submit'])) {

    $id = $_POST['submit'];
    $url= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    $query = parse_url($url, PHP_URL_QUERY);
    parse_str($query, $params);
    $action = $params['action'];

    echo $action, $id;

    if($action === "reject"){
        ManagerService::rejectRequest($id);
    }else {
        ManagerService::acceptRequest($id);
    }

    header('Location:index.php');
    exit();
}

?>
<div class="managerWrapper">
    <div class="managerWrapperTop">
    <img src="./assets/images/logo.png" class="logo" />
    <a href="./requests.php"> View Requests </a>
    <a href="./logout.php"> Logout </a>
    </div>


    <div class="managerHeading">
        <h1> Requests </h1>
        <p> Requests that have been redirected by the Human Resources department</p>
    </div>

    <div class="incomingRequests">

        <?php if (empty($requests)): ?>
            <p class="lead mt-3">There is no new request</p>
        <?php endif; ?>

        <?php foreach ($requests as $item): ?>
            <div class="card">
                <h2> <?php echo $item["title"] ?> </h2>
                <span> <?php echo $item["request.id"] ?> </span>
                <span> <?php echo $item["firstname"].' '.$item["lastname"] ?> </span>
                <div class="description">
                    <h2> Description: </h2>
                    <p> <?php echo $item["justification"] ?> </p>
                </div>
                <div class="buttongroup">
                    <?php
                        echo '<form action="index.php?action=accept" method="POST">
                        <button class="black" value="'.$item['request.id'].'" name="submit" type="submit"> <img src="./assets/images/check.png" alt="check"> <span> Approve request</span> </button>
                        </form>'
                    ?>
                    <?php
                        echo '<form action="index.php?action=reject" method="POST">
                        <button class="white" value="'.$item['request.id'].'" name="submit" type="submit"> <img src="./assets/images/close.png" alt="check"> <span> Reject request</span> </button>
                        </form>'
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>