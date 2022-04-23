<?php
  $login = false;
  $login_emailErr = false;
  $login_passErr = false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    include 'partials/_dbconnect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * from users where email='$email'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);


    if($num == 1){
      while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['password'])){
          $login = true;
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['email'] = $email;
          header("location: welcome.php");

        }
        else{
          $login_passErr = true;
        }
      }
      
      
    }
    else{
     $login_emailErr = true;
    }
  }
?>  



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>login page</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php 
      if($login){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your successfully logged in.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      if($login_passErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> You entered the wrong password. Kindly login again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      if($login_emailErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> The email you entered is not valid. Kindly login again with a valid email.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
    ?>
    <div class="container my-3">
      <h1 class="text-center">Login To Your Account</h1>
      <form class="row g-3 my-3" action="/loginsys/login.php" method="post">
        <div class="row mt-3">
          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <i class="fa fa-asterisk" style="font-size:18px;color:red">*</i>
            <input type="email" class="form-control" id="email" name="email" maxlength="30" required placeholder="email@email.com">
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <label for="password" class="form-label">Password</label>
            <i class="fa fa-asterisk" style="font-size:18px;color:red">*</i>
            <input type="password" class="form-control" id="password" name="password" maxlength="30" placeholder="****">
          </div>
        </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>