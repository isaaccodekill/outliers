<?php
    if(!isset($_SESSION['ishr'])){
        header('Location:login.php');
        exit();
    }

    require_once($_SERVER["DOCUMENT_ROOT"] . "/outliers/asset-mgmt/services/human-resources.php");
    $requestId = $_GET["requestId"];
    $action = $_GET["action"];

    if($action === "redirect"){
        HRService::redirectRequest($requestId);
    }else{
        HRService::rejectRequest($requestId);
    }

    header('Location: request.php')
?>
