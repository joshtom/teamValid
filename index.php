<?php
include "app/init.php";
$guest = new Validation();
if($guest->loggedIn()){
  header('Location:dashboard.php');
}
if(isset($_POST['submit'])){
  $user = new User();
  if(empty($_POST['username']) || empty($_POST['password']) ){
    $log_errors[] = "All feilds are required";
    }
  if($user->username_exists($_POST['username'])){
      $old_password = $user->passwordHash($_POST['username']);
      if(password_verify($_POST['password'],$old_password)){
        $_SESSION['user_id'] = $user->login($_POST['username'],$old_password);
        header('Location:dashboard.php');
      }else{
        $log_errors[] = "invalid username/password combination";
      }
  }else{
    $log_errors[] = "sorry, we cant find a user with that username";
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
                <form method="POST" id="sign-in-form" class="sign-in-form">
                    <img src="img/logo.svg" alt="logo-image">
                    <?php
                     if(isset($_GET['submitted'])) {
                        echo '<div class="alert alert-success">
                                Account created successfully!
                        </div>';
                    echo '<p>Thank you for signing up, <a href="index.php" style="color:blue;" id="sign-in-form-link">Log in</a></p>';
                     }else{
                        if(!empty($log_errors)){ echo $user->errors($log_errors); }
                        ?> 
                        <div class="form-group">
                            <i class="fas fa-user fa-sm  "></i>
                            <input type="text" name="username" id="username" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="form-group">
                            <i class="fas fa-lock fa-sm  "></i>
                            <input type="password" name="password" id="signin-password" required>
                            <label for="signin-password">Password</label>
                        </div>
                        <div class="rem-me-and-forget-password">
                            <div class="c-remember-me">
                                    <input type="checkbox" name="remember-me" id="remember-me">
                                    <label for="remember-me">Remember me</label>
                            </div>
                            <a href="#">Forget password?</a>
                        </div>
                        <button type="submit" name="submit">Sign in</button>
                        <p>Don't have an account yet? <a href="register.php" id="sign-up-form-link">SIGN UP</a></p>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <!-- <script src="scripts/app.js"></script> -->
</body>

</html>