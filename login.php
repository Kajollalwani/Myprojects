<?php
//  $showAlert = false;
 $login = false;
 $showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'raw/_dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  // $cpassword = $_POST["cpassword"];
  //$exists=false;
  // if (($password == $cpassword) && $exists== false) 
  //{
      // $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
      $sql = "Select * from users where username='$username' AND password = '$password'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
          if ($num==1) {
            $login=true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$username;
            header("location: welcome.php");
          }
          else {
            $showError="Invalid Credentials";
          }
}
  //     if ($result){
  //       $showAlert = true;
  //     }
  // }
  // else{
  //   $showError = "Passwords do not match";
  // }


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'raw/_nav.php'  ?>
    <?php
    if($login)
    {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS!</strong> You are logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; 
    }
    
    
    if($showError)
    {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR!</strong> '.$showError.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; 
    }
     ?>
     <div class="container my-4"> <!--shortcut key is div.container then enter -->
        <h1 class="text-center">Login to our website</h1>
        <form action="/homeproj/login.php" method="post">
  <div class="mb-3">
    <!-- // <div class="mb-3 col-md-6">  shortcut for sizing-->
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <!-- <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure to type the same password.</div>
  </div> -->
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Login</button>
</form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>