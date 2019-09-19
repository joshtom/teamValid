<?php
include "app/init.php";
$user = new User();
if(!$user->loggedIn()){
    header('Location:index.php');
}
$data = $user->show($_SESSION['user_id'],"username","password");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title><?php echo $data['username'] ?></title>
</head>
<body>
    <div class="container">
    <h2>Dashboard</h2>
        <div class="row">
            <div class="col-md-offset-3 col-md-3">
                <h3 class="text-success">Welcome <?php echo $data['username'] ?></h3>
                <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>