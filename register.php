<?php
include "app/init.php";
$guest = new Validation();
if($guest->loggedIn()){
  header('Location:dashboard.php');
}
  if(isset($_POST['submit'])){
      $user = new User();
      $required_feilds = array("username","password","confirm_password","email");
      foreach($_POST as $key=>$value){
        if(empty($value) && in_array($key,$required_feilds)){
          $errors[] = "All feilds are required";
          break 1;
        } 
      }
      if($user->username_exists($_POST['username'])){
          $errors[] = "username already exists!";
      }else if($user->email_exists($_POST['email'])){
          $errors[] = "email already exists!";
      }else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please enter a valid Email!";
      }else if(strlen($_POST['password']) < 6){
          $errors[] = "password must be greater than five(5) characters!";
      }else if($_POST['password'] !== $_POST['confirm_password']){
          $errors[] = "passwords do not match!";
      }else if(empty($errors)){
        $new_data = array([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'active' => 1
        ]);
        $user->create($new_data);
        header('Location:index.php?submitted');
      }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>TeamValid | Registrationpage</title>
  </head>
  <body class="">
   <div class="container ">
     <div class="row mt-3 d-flex">
       <div class="col-lg-4 m-auto">
         <?php if(!empty($errors)){ echo $user->errors($errors); } ?>
         <div class="card">
           <div class="card-header">
             REGISTER
           </div>
           <div class="card-body">
             <form method="POST">
            <div class="login">
              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>">
              </div>
          </div>
         <div class="login">
           <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
          </div>
          <input type="email" class="form-control" name="email" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
        </div>
         </div>
         <div class="login">
           <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" name="password" placeholder="Enter Password" aria-label="email" aria-describedby="basic-addon1">
        </div>

        

         </div>
         <div class="login">
           <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" aria-label="email" aria-describedby="basic-addon1">
        </div>

        

         </div>
        
           </div>
           <div class="card-footer">
             <button type="submit" class="btn btn-primary" name="submit">Register</button>
           </div>
           </form>
         </div>
         <div class="mt-3">Already have an account? <a href="index.php">Log in</a></div>
       </div>
     </div>
   </div>

   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>