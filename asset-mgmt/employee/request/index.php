<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Management Form</title>
    <link rel="stylesheet" href="inventory/shared.css">
    <link rel="stylesheet" href="request.css">
    <script src="https://unpkg.com/phosphor-icons"></script>
</head>

<body>
<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/services/auth.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/services/employee.php");


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $data = AuthService::authenticate($email, $password);
        if (is_null($data)) {
            $script = '<script>window.location = "/employee/index.php";</script>';
            echo "$script";
        }
        $_SESSION["data"] = $data;
    } else if (isset($_POST["title"]) && isset($_POST["justification"])) {
        $title = $_POST["title"];
        $justification = $_POST["justification"];

        $success = EmployeeService::createRequest($title, $justification, $_SESSION["data"]["id"]);
        if ($success) {
            $script = "<script>alert('request created successfully');</script>";
        } else {
            $script = "<script>alert('request failed');</script>";
        }
        echo "$script";
    } else {
        $script = '<script>window.location = "/employee/index.php";</script>';
        echo "$script";
    }

  } else {
    if (!isset($_SESSION["data"])) {
        $script = '<script>window.location = "/employee/index.php";</script>';
        echo "$script";
    }
  }
?>
    <header>
        <nav>
            <div class="logo">
                <img src="img/Vector.png" alt="outliers logo">
            </div>
            <div class="request-n-inventory">
                <a href="inventory/index.php">Assets Inventory</a>
            </div>

            <div class="emp-details__container">
                <div class="emp-details">
                    <p class="emp-name"><?php $val = $_SESSION["data"]["firstname"] . " " . $_SESSION["data"]["lastname"]; echo "$val"; ?></p>
                    <p class="emp-role"><?php $val = ucwords($_SESSION["data"]["role"]); echo "$val"; ?></p>
                    <div class="logout">
                        <img src="img/bx_log-out-circle.jpg" alt="">
                        <a href="/employee/logout.php" class="log_out">Log out</a>
                    </div>
                </div>
                <div class="emp-display_img">
                    <i class="ph-user-circle-light"></i>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="request">
            <div class="request-header">
                <h1>Assets Request Form</h1>
                <p>You will be notified once your request has been approved.</p>
            </div>
            <form action="/employee/request/index.php" method="POST">
                <div class="asset-info">
                    <input type="text" name="title" id="employee_mail" placeholder="Asset Name (Required)" />
                </div>

                <div class="asset-info">
                    <textarea type="text" name="justification" id="employee_password" rows="4" cols="50" placeholder="Briefly explain the importance (Required)"></textarea>
                </div>

                <div class="submit-request">
                    <input type="submit" value="SUBMIT">
                </div>
            </form>
        </div>

        <div class="vl"></div>

        <div class="request-history">
            <div class="history">
                <img src="img/material-symbols_history.jpg" alt="">
                <h1>Request History</h1>
            </div>
            <div class="request-list_container">
                <ul class="request-list">
                    <?php
                        $employeeId = $_SESSION["data"]["id"];
                        $data = EmployeeService::getEmployeeRequests($employeeId);

                        foreach ($data as $item) {
                            $output = "";
                            if ($item["status"] === "accepted") {
                                $output = '<li class="approved">Your request has been approved</li>';
                            } else if ($item["status"] === "rejected") {
                                $output = '<li class="declined">Your request has been declined</li>';
                            }
                            echo $output;
                        }
                    ?>
                </ul>
            </div>
        </div>
    </main>
</body>

</html>