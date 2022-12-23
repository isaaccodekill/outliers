<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="emp_index.css">
  <title>Asset Management</title>
</head>

<body>
  <div id="content">
    <div class="left">
      <header>
        <nav>
          <img src="img\Vector.png" alt="outliers logo">
        </nav>
      </header>
      <main>
        <div class="main_text">
          <h1>Welcome back</h1>
          <p>Enter your employee login details</p>
        </div>

        <form action="request\index.php" method="POST">
          <div class="employee_details">
            <input type="email" name="email" id="employee_mail" placeholder="Employee Email" />
          </div>
          <div class="employee_details">
            <input type="password" name="password" id="employee_password" placeholder="Password" />
          </div>

          <div class="log-in_btn">
            <input type="submit" value="LOGIN">
          </div>

        </form>

        <p class="forgot_details">Forgot login details? <a href="">Contact Administrator</a></p>
      </main>
    </div>

    <div class="right">
      <div class="img_container">
        <img src="img/employees.jpg" alt="an image of people discussing">
      </div>
    </div>

  </div>

</body>

</html>