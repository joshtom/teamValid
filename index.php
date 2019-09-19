<?php
include "app/init.php";
$guest = new Validation();
if($guest->loggedIn()){
  header('Location:dashboard.php');
}
if(isset($_POST['submit'])){
  $user = new User();
  $required_feilds = array("username","password");
  foreach($_POST as $key=>$value){
    if(empty($value) && in_array($key,$required_feilds)){
      $errors[] = "All feilds are required";
      break 1;
    } 
  }
  if($user->username_exists($_POST['username'])){
      $old_password = $user->passwordHash($_POST['username']);
      if(password_verify($_POST['password'],$old_password)){
        $_SESSION['user_id'] = $user->login($_POST['username'],$old_password);
        //echo $_SESSION['user_id'];
        header('Location:dashboard.php');
      }else{
        $errors[] = "invalid username/password combination";
      }
  }else{
    $errors[] = "sorry, we cant find a user with that username";
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

    <title>TeamValid | Loginpage</title>
  </head>
  <body>
   <div class="container ">
     <div class="row mt-3 d-flex">
       <div class="col-lg-4 m-auto">
         <?php if(isset($_GET['submitted'])) {
              echo '<div class="alert alert-success">
                      Account created successfully!
              </div>';
           }
          ?>
         <?php if(!empty($errors)){ echo $user->errors($errors); } ?> 
         <div class="card">
           <form method="POST">
           <div class="card-header">
             LOGIN
           </div>
           <div class="card-body">
             <div class="login">
           <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
          </div>
          <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        

         </div>
         <div class="login">
           <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
          </div>
          <input type="Password" class="form-control" name="password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        

         </div>
           </div>
           <div class="card-footer">
             <button type="submit" name="submit" class="btn btn-primary">Log in</button>
           </div>
          </form>       
         </div>
         <div class="mt-3">Don't have an account? <a href="register.php">register here</a></div>
       </div>
     </div>
   </div>

   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>