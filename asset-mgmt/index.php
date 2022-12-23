<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Management</title>
</head>
<body> 
<?php
    require_once("./services/auth.php");
    require_once("./services/human-resources.php");
    var_dump(HRService::getAllEmployees());
    var_dump(AuthService::authenticate("manager@outliers.com", "password"));
    echo "Hello World";
?>
</body>
</html>