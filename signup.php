<?php

$showAlert = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'database.php';
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $role = $_POST['role'];
    $exist = false;
    $existsql = "SELECT * FROM `users` where `username` = '$user_name'";
    $result = mysqli_query($connection, $existsql);
    $user_exist =  mysqli_num_rows($result) ;

    if($user_exist > 0){
        $showError = " User Already Exist";
    }
    else{

        if (($password == $cpassword) || $exist=false) {
            $hash = password_hash("$password",PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`id`, `username`, `password`, `role`, `date`) VALUES (NULL, '$user_name', '$hash', '$role', current_timestamp())";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $showAlert = true;
            }
        }
        else{
            $showError= "Passwors do not match";
    
        }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Signup</title>
</head>

<body>
    <?php
      require 'partials/_nav.php';
      if ($showAlert) {

          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Contratulations!</strong> Your Account has been created successfull.
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></button>
          </div>";
      }
      if ($showError) {

          echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <strong>Error!</strong>" . $showError . ".
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
      }
    ?>

    <div class="container">
        <h3 class="text-center">Register your Account</h3>
        <form action="/CMS/signup.php" method="post">
            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" id="name" name="user_name">
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" class="form-control" id="Password" name="password">
            </div>
            <div class="form-group">
                <label for="cPassword">Confirm Password</label>
                <input type="password" class="form-control" id="cPassword" name="cpassword">
                <small id="emailHelp" class="form-text text-muted">Password must be same.</small>
            </div>
            <div class="form-group">
                    <label for="role">Staff Role</label>
                    <select id="role" class="form-control" name="role" required>
                        <option selected>Choose...</option>
                        <option>Admin</option>
                        <option>Compounder</option>
                    </select>
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php
    include "partials/footer.php";
    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>