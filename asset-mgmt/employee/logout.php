<?php
ob_start();
unset($_SESSION["data"]);
header('Location: ./index.php');
?>