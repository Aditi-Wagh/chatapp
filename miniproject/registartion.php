<?php
include('database_connection.php');
// session_start();
// if(isset($_SESSION['uid']))
// {
//  header('location:chatpage.php');
// }
$messege="";
if(isset($_POST['username']) && isset($_POST['userpassword'])){
$username=$_POST['username'];
$userpassword=$_POST['userpassword'];
// $uid=103;
$admin_id=2001;
$query='INSERT INTO user(userpassword,username,admin_id) values(:userpassword,:username,:admin_id)';
$statement=$conn->prepare($query);
if($statement->execute([':userpassword'=>$userpassword,':username'=>$username,':admin_id'=>$admin_id])){
    $message="data inserted successfully.";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>

    <!--Bootstrap links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body style="padding-left: 500px; padding-right: 500px; padding-top: 100px; background-image: url(https://www.ilovewallpaper.com/images/buzzy-bees-wallpaper-white-p8721-35735_medium.jpg); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
    <h1 style="font-family: cursive;">REGISTRATION PAGE</h1>
    <div class="card text-center mb-3" style="width: 250; font-family: cursive; opacity: 90%;">
        <div class="card-body">
            <?php if(!empty($message)) : ?>
                <div class="alert alert-success">
                    <?=$message;?>
                </div>
            <?php endif; ?>
          <h5 class="card-title">Welcome to our chat application registration page! We're excited to have you join our community. Please fill out the following information to create your account..</h5>
          <form method="post">
          <div class="mb-4">
            <label for="username" class="form-label">Name</label>
            <input type="text" name="username" class="form-control border-success" id="username" placeholder="Your Name">
          </div>

          <div class="mb-4">
            <label for="userpassword" class="form-label">Password</label>
            <input type="password" name="userpassword" class="form-control border-success" id="userpassword" placeholder="Password">
          </div>
          <br><br>
          <!-- <a href="chatpage.php" class="btn btn-primary"><input type="submit" name="login" class="btn btn-info" value="Sign up" /></a> -->
          <br>
          <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Sign up" />
      </div>
          <a class="icon-link icon-link-hover" style="--bs-link-hover-color-rgb: 25, 135, 84;" href="userlogin.php">
            Go back to login page...
            <svg class="bi" aria-hidden="true"><use xlink:href="#arrow-right"></use></svg>
          </a>

       
        </form>
        </div>
      </div>
</body>
</html>