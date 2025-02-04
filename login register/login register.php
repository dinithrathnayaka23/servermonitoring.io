<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/4829/4829008.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Open Sans';
      background-image: url('https://www.racksolutions.com/news//app/uploads/AdobeStock_87909563.jpg');
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signup-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
      height: 100%;
    }

    .signup-container h2 {
      text-align: center;
      color: #333;
    }

    .form-group {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 0.5rem;
      background-color: #f9f9f9;
      margin-bottom: 1.5rem;
    }

    .form-group i {
      margin-right: 0.5rem;
      color: #555;
    }

    .form-group input {
      border: none;
      outline: none;
      flex: 1;
      background: none;
      padding: 0.5rem;
      font-size: 1rem;
      color: #333;
    }

    .name-group {
      display: flex;
      gap: 1rem;
    }

    .name-group .form-group {
      flex: 1;
    }

    .signup-button {
      background-color: #222D51;
      color: #fff;
      border: none;
      padding: 0.75rem;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
      width: 100%;
      font-weight: bold;
    }

    .signup-button:hover {
      background-color:white;
      color: #222D51;
      border: 1px solid #222D51;
    }

    .signup-container p {
      text-align: center;
      color: #555;
    }

    .signup-container p a {
      color: #222D51;
      text-decoration: none;
    }

    .signup-container p a:hover {
      text-decoration: underline;
    }

    .alert {
      color: red;
      text-align: center;
      margin-bottom: 1rem;
    }

    /* Responsive Design for Mobile Screens */
    @media (max-width: 600px) {
      .signup-container {
        padding: 1.5rem; /* Reduce padding for smaller screens */
        margin: 10px; /* Reduce margin for smaller screens */
      }

      .signup-container h2 {
        font-size: 1.5rem; /* Smaller font size for heading on mobile */
      }

      .name-group {
        flex-direction: column; /* Stack first name and last name vertically */
        gap: 0.5rem; /* Reduce gap between stacked fields */
      }

      .form-group input {
        font-size: 0.9rem; /* Slightly smaller font size for inputs on mobile */
      }

      .signup-button {
        font-size: 0.9rem; /* Smaller font size for button on mobile */
      }

      .signup-container p {
        font-size: 0.9rem; /* Smaller font size for text on mobile */
      }
    }
  </style>
</head>
<body>
  <div class="signup-container">
  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwhhDo0NZ9iWcEgTHVMjJWGnWIOunvh-a0Pg&s" style="height: 50px; width: 50px; margin: 0 auto; display:flex; justify-content:center" alt="Logo">
    <h2 class="animate__animated animate__slideInDown">Sign Up</h2>
    <form action="login register.php" method="post">
      <?php
          if(isset($_POST["submit"])){
              $firstname=$_POST["firstname"];
              $lastname=$_POST["lastname"];
              $email=$_POST["email"];
              $password=$_POST["password"];
              $confirmpassword=$_POST["confirmpassword"];

              $passwordhash=password_hash($password,PASSWORD_DEFAULT);
              $error=array();
              if(empty($firstname) OR empty($lastname) OR empty($email) OR empty($password) OR empty($confirmpassword)){
                  array_push($error,"All fields are required");
              }

              if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                  array_push($error,"Email is not Valid");
              }

              if (strlen($password)<8) {
                array_push($error,"Password must be at least 8 characters long");
              }

              if ($password!==$confirmpassword) {
                 array_push($error,"Password does not match");
              }

              require_once "database.php";
              $sql="SELECT * FROM users WHERE email='$email'";
              $result= mysqli_query($conn,$sql);
              $rowCount=mysqli_num_rows($result);
              if ($rowCount>0) {
                 array_push($error,"Email Already Exists");
              }

              if (count($error)>0) {
                  foreach ($error as $error) {
                      echo "<div class='alert alert-danger'>$error</div>";
                  }
              }

              else {
                
                 $sql="INSERT INTO users (first_name,last_name,email,password) VALUES(? , ? , ? , ?)";
                 $stmt=mysqli_stmt_init($conn);
                 $preparestmt=mysqli_stmt_prepare($stmt,$sql);
                 if ($preparestmt) {
                     mysqli_stmt_bind_param($stmt,"ssss",$firstname,$lastname,$email,$passwordhash);
                     mysqli_stmt_execute($stmt);
                     echo "<div>You are registered Successfully</div>";
                 }

                 else {
                   die("Something went wrong");
                 }
              }
          }
      ?>
      <!-- First Name and Last Name in the same line -->
      <div class="name-group animate__animated animate__slideInDown">
        <div class="form-group">
          <i class="fas fa-user"></i>
          <input type="text" id="first-name" placeholder="First Name" name="firstname">
        </div>
        <div class="form-group">
          <i class="fas fa-user-tag"></i>
          <input type="text" id="last-name" placeholder="Last Name" name="lastname">
        </div>
      </div>

      <!-- Email -->
      <div class="form-group animate__animated animate__slideInDown">
        <i class="fas fa-envelope"></i>
        <input type="text" id="email" placeholder="Enter Email" name="email">
      </div>

      <!-- Password -->
      <div class="form-group animate__animated animate__slideInDown">
        <i class="fas fa-key"></i>
        <input type="password" id="password" placeholder="Enter Password" name="password">
      </div>

      <!-- Confirm Password -->
      <div class="form-group animate__animated animate__slideInDown">
        <i class="fas fa-lock"></i>
        <input type="password" id="confirm-password" placeholder="Re-enter Password" name="confirmpassword">
      </div>

      <!-- Submit Button -->
      <button type="submit" class="signup-button animate__animated animate__slideInDown" name="submit">Sign Up</button>
    </form>
    <p class="animate__animated animate__slideInDown">Already have an account? <a href="login.php">Log In</a></p>
  </div>
</body>
</html>