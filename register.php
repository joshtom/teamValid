<?php
include "app/init.php";
$guest = new Validation();
if($guest->loggedIn()){
  header('Location:dashboard.php');
}
//register user
  if(isset($_POST['save'])){
      $user = new User();
    if(empty($_POST['signup_username']) || empty($_POST['signup_email']) || empty($_POST['signup_password']) || empty($_POST['signup_confirm_password'])){
        $errors[] = "All feilds are required";
    }
      if($user->username_exists($_POST['signup_username'])){
          $errors[] = "username already exists!";
      }else if($user->email_exists($_POST['signup_email'])){
          $errors[] = "email already exists!";
      }else if(!filter_var($_POST['signup_email'],FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please enter a valid Email!";
      }else if(strlen($_POST['signup_password']) < 6){
          $errors[] = "password must be greater than five(5) characters!";
      }else if($_POST['signup_password'] !== $_POST['signup_confirm_password']){
          $errors[] = "passwords do not match!";
      }else if(empty($errors)){
        $new_data = array([
            'username' => $_POST['signup_username'],
            'email' => $_POST['signup_email'],
            'password' => $_POST['signup_password'],
            'active' => 1
        ]);
        $user->create($new_data);
        header('Location:index.php?submitted');
      }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="title">teamValid | Sign in</title>
    <link rel="stylesheet" href="styles/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <div class="container">
        <div class="big-image">
            <img src="img/signup-design.png" alt="img">
        </div>
        <div class="form-section">
            <div class="the-forms" id="the-forms">
                <form action="" id="sign-up-form" method="POST" class="sign-up-form">
                    <h2 class="signup-form-heading">SIGN UP</h2>
                    <p class="signup-form-subheading">It’s free and only takes a minute</p>
                    <?php if(!empty($errors)){ echo $user->errors($errors); } ?>
                    <div class="form-group">
                        <i class="fas fa-user fa-sm  "></i>
                        <input type="text" name="signup_username" id="signup-username" required>
                        <label for="signup-username">Username</label>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-envelope fa-sm  "></i>
                        <input type="text" name="signup_email" id="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-user-lock fa-sm  "></i>
                        <input type="password" name="signup_password" id="signup-password" required>
                        <label for="signup-password">Enter password</label>
                    </div>
                    <div class="form-group">
                            <i class="fas fa-user-lock fa-sm  "></i>
                        <input type="password" name="signup_confirm_password" id="signup-confirm-password" required>
                        <label for="signup-confirm-password">Confirm Password</label>
                    </div>
                    <p class=terms-and-con>
                        By clicking the sign up button you agree to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
                    </p>
                    <button type="submit" name="save">Sign up</button>
                    <p>Already have an account? <a href="index.php" id="sign-in-form-link">Log in</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- <script src="scripts/app.js"></script> -->
</body>

</html>