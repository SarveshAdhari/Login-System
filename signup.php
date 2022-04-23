<?php
  $showAlert = false;
  $showErrUsername = false;
  $showErrEmail = false;
  $showErrPasword = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  include 'partials/_dbconnect.php';

  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  $email_existSql = "SELECT * from users where email = '$email'";
  $email_result = mysqli_query($conn,$email_existSql);
  $email_ExistsRows = mysqli_num_rows($email_result);
  if($email_ExistsRows>0){
    $showErrEmail = true;
  }
  else{
  $user_existSql = "SELECT * from users where username = '$username'";
  $user_result = mysqli_query($conn,$user_existSql);
  $user_ExistsRows = mysqli_num_rows($user_result);
  if($user_ExistsRows>0){
        $showErrUsername = true;
  }
   else{
       if($password == $cpassword){
          $passHash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `users` (`email`, `username`, `password`) VALUES ('$email', '$username', '$passHash')";
         $result = mysqli_query($conn,$sql);
         if($result){
           $showAlert = true;
          }
        }
        else{
          $showErrPasword = true;
        }
      }
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

    <title>signup page</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php 
      if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your account was successfully created. Kindly login to continue.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      if($showErrUsername){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Username already exists! Kindly signup again with a different username.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      if($showErrEmail){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Email has already been used! Kindly signup again with a different email.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      if($showErrPasword){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Passwords do not match! Kindly signup again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
    ?>
    <div class="container my-3">
      <h1 class="text-center">Signup To Our Website</h1>
      <form class="row g-3 my-3" action="/loginsys/signup.php" method="post">
        <div class="row mt-3">
          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <i class="fa fa-asterisk" style="font-size:18px;color:red">*</i>
            <input type="email" class="form-control" id="email" name="email" maxlength="30" required placeholder="email@email.com">
          </div>
          <div class="col-md-6">
            <label for="username" class="form-label">Username</label>
            <i class="fa fa-asterisk" style="font-size:18px;color:red">*</i>
            <input type="text" class="form-control" id="username" name="username" maxlength="30" required placeholder="username">
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <label for="password" class="form-label">Password</label>
            <i class="fa fa-asterisk" style="font-size:18px;color:red">*</i>
            <input type="password" class="form-control" id="password" name="password" maxlength="30" required placeholder="****">
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <i class="fa fa-asterisk" style="font-size:18px;color:red">*</i>
            <input type="password" class="form-control" id="cpassword" name="cpassword" maxlength="30" required placeholder="****">
          </div>
          <div class="mt-2">
            <input type="checkbox" name="policy" required>
            <small>
              I accept the user policies and guidelines.
            </small>  
          </div>
        </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign up</button>
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