

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="stylelogin.css">
  <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/4829/4829008.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background-image:url('https://www.racksolutions.com/news//app/uploads/AdobeStock_87909563.jpg');
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    .input-group {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 0.5rem;
      background-color: #f9f9f9;
    }

    .input-group i {
      margin-right: 0.5rem;
      color: #555;
    }

    .input-group input {
      border: none;
      outline: none;
      flex: 1;
      background: none;
      padding: 0.5rem;
      font-size: 1rem;
      color: #333;
    }

    .login-button {
      background-color: #222D51;
      color: #fff;
      border: none;
      padding: 0.75rem;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .login-button:hover {
      background-color:white;
      color: #222D51;
    }

    .signup-text {
      text-align: center;
      color: #555;
    }

    .signup-text a {
      color: #222D51;
      text-decoration: none;
    }

    .signup-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <?php
        if (isset($_POST["login"])) {
            $email=$_POST["email"];
            $password=$_POST["password"];
            require_once "database.php";
            $sql="SELECT * FROM users WHERE email='$email'";
            $result=mysqli_query($conn,$sql);
            $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password,$user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: data.php");
                    die();
                }
                else{
                    echo "<div style='color: red; text-align: center;'>Password incorrect</div>";
                }
            }
            else{
                echo "<div style='color: red; text-align: center;'>Email does not exist</div>";
            }
        }
    ?>
    <form class="login-form" action="login.php" method="post">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwhhDo0NZ9iWcEgTHVMjJWGnWIOunvh-a0Pg&s" style="height: 50px; width: 50px; margin: 0 auto;" alt="Logo">
      <h2 class="animate__animated animate__slideInDown">Log In</h2>
      
      <!-- Email Input Group -->
      <div class="input-group animate__animated animate__slideInDown">
        <i class="fas fa-envelope"></i>
        <input type="text" id="email" placeholder="Enter Email" name="email">
      </div>

      <!-- Password Input Group -->
      <div class="input-group animate__animated animate__slideInDown">
        <i class="fas fa-key"></i>
        <input type="password" id="password" placeholder="Enter Password" name="password">
      </div>

      <!-- Login Button -->
      <button type="submit" class="login-button animate__animated animate__slideInDown" name="login">Log In</button>
      
      <!-- Signup Link -->
      <p class="signup-text animate__animated animate__slideInDown">
        Don't have an account? <a href="login register.php">Sign Up</a>
      </p>
    </form>
  </div>
</body>
</html>
