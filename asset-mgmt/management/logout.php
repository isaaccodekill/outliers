<?php
unset($_SESSION["ismanager"]);
$script = '<script>window.location = "/management/login.php";</script>';
echo "$script";
exit();
?>
