<?php
session_start();

include_once "includes/config.php";
include_once "includes/db.php";

if(isset($_POST['login'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  $result = $db->query($query);

  // If result exists redirect user to the admin panel
  if($result->num_rows == 1){
    $_SESSION['username'] = $username;
    header("Location:index.php");
    exit();
  } else {
    header("Location:signin.php?err_msg=Wrong username or password");
  }
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign in</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form method="post" class="form-signin">
        <?php if(isset($_GET['err_msg'])){
          echo "<div class='alert alert-danger'>$_GET[err_msg]</div>";
        } ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>
