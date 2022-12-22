<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Management Form</title>
    <link rel="stylesheet" href="request.css">
    <script src="https://unpkg.com/phosphor-icons"></script>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="img/Vector.png" alt="outliers logo">
            </div>
            <div class="request-n-inventory">
                <a href="" class="active">Create Request</a>
                <a href="inventory/inventory.php">Assets Inventory</a>
            </div>

            <div class="emp-details__container">
                <div class="emp-details">
                    <p class="emp-name">Onwuka Stanley</p>
                    <p class="emp-department">Tech Department</p>
                    <p class="emp-role">Assistant</p>
                    <div class="logout">
                        <img src="img/bx_log-out-circle.jpg" alt="">
                        <a href="../emp-index.php" class="log_out">Log out</a>
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
            <form action="" method="">
                <div class="asset-info">
                    <input type="text" name="email" id="employee_mail" placeholder="Asset name (Required)" />
                </div>
                <div class="asset-info">
                    <input list="asset-type" id="asset" name="asset" placeholder="Asset type (Required)">
                    <datalist id="asset-type">
                        <option value="Office Item">
                        <option value="Kitchen Item">
                        <option value="Studio Item">
                    </datalist>
                </div>

                <div class="asset-info">
                    <textarea type="password" name="password" id="employee_password" rows="4" cols="50" placeholder="Briefly explain the importance (Required)"></textarea>
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
                    <li class="approved">Your request has been approved</li>
                    <li class="approved">Your request has been approved</li>
                    <li class="approved">Your request has been approved</li>
                    <li class="declined">Your request has been declined</li>
                    <li class="declined">Your request has been declined</li>
                    <li class="declined">Your request has been declined</li>
                    <li class="approved">Your request has been approved</li>
                    <li class="declined">Your request has been declined</li>
                    <li class="approved">Your request has been approved</li>
                    <li class="declined">Your request has been declined</li>
                    <li class="declined">Your request has been declined</li>
                </ul>
            </div>
        </div>
    </main>
</body>

</html>