<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="shared.css">
    <script src="https://unpkg.com/phosphor-icons"></script>

</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../img/Vector.png" alt="outliers logo">
            </div>
            <div class="request-n-inventory">
                <a href="../request.php">Create Request</a>
                <a href="" class="active">Assets Inventory</a>
            </div>

            <div class="emp-details__container">
                <div class="emp-details">
                    <p class="emp-name">Onwuka Stanley</p>
                    <p class="emp-department">Tech Department</p>
                    <p class="emp-role">Assistant</p>
                    <div class="logout">
                        <img src="../img/bx_log-out-circle.jpg" alt="">
                        <a href="../../emp_index.php" class="log_out">Log out</a>
                    </div>
                </div>
                <div class="emp-display_img">
                    <i class="ph-user-circle-light"></i>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="asset-list">
            <div class="available-assets">
                <h1>Available Assets</h1>
                <input type="search" placeholder="Search">
            </div>
            <div class="item-grid">
                <div class="items">
                    <p class="item">Fridge</p>
                    <div class="description">
                        <p class="item-description">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                    </div>
                    <div class="serial-number">
                        <p class="serial-header">Serial Number:</p>
                        <p class="item-serial_no">076F2</p>
                    </div>
                </div>
                <div class="items">
                    <p class="item">Laptop</p>
                    <div class="description">
                        <p class="item-description">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                    </div>
                    <div class="serial-number">
                        <p class="serial-header">Serial Number:</p>
                        <p class="item-serial_no">076F2</p>
                    </div>
                </div>
                <div class="items">
                    <p class="item">Printer</p>
                    <div class="description">
                        <p class="item-description">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                    </div>
                    <div class="serial-number">
                        <p class="serial-header">Serial Number:</p>
                        <p class="item-serial_no"> 0389U</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="vl"></div>

        <div class="request-history">
            <div class="history">
                <img src="../img/material-symbols_history.jpg" alt="">
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