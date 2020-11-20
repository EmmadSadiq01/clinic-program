<?php
$reset = false;
$showError = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'database.php';
    $user_name = $_POST['user_name'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT * FROM `users` WHERE `users`.`username`='$user_name'";
    $result1 = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result1);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result1)) {
            if (password_verify($old_password, $row['password'])) {
                if ($new_password == $confirm_password) {
                    $hash = password_hash("$new_password", PASSWORD_DEFAULT);
                    $sql = "UPDATE `users` SET `password` = '$hash' WHERE `users`.`username` = '$user_name'";
                    $result = mysqli_query($connection, $sql);
                    if ($result) {
                        $reset = true;
                    }
                } else {
                    $showError = " Password not same";
                }

                // $_SESSION['username'] = $user_name;
                // if ($row['role'] == "Compounder") {
                //     $_SESSION['compounder_logedin'] = true;
                //     header('location: /CMS/compounder');
                // } else {
                //     $_SESSION['logedin'] = true;
                //     header('location: /CMS');
                // }
            } else {
                $showError = " Invalid Credentials";
            }
        }
    } else {
        $showError = " Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Iqbal Homeo Clinic - Reset Password</title>
</head>

<body>
    <?php
    require 'partials/_nav.php';
    if ($reset) {

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Contratulations!</strong> Password has been set.
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></button>
          </div>";
    }
    if ($showError) {

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Contratulations!</strong> ". $showError ."
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></button>
          </div>";
    }
    ?>
    <div class="overlay">
        <!-- LOGN IN FORM by Omar Dsoky -->
        <form action="/CMS/reset.php" method="post">
            <!--   con = Container  for items in the form-->
            <div class="con">
                <!--     Start  header Content  -->
                <header class="head-form">
                    <h2>Reselt Password</h2>
                    <p>Reset password requires your old password</p>
                    <!--     A welcome message or an explanation of the login form -->
                </header>
                <!--     End  header Content  -->
                <br>
                <div class="field-set">

                    <!--   user name -->
                    <span class="input-item">
                        <i class="fa fa-user-circle"></i>
                    </span>
                    <!--   user name Input-->
                    <input class="form-input" id="txt-input" type="text" placeholder="@UserName" name="user_name" required>

                    <br>

                    <!--   Password -->

                    <span class="input-item">
                        <i class="fa fa-key"></i>
                    </span>
                    <!--   Password Input-->
                    <input class="form-input" type="password" placeholder="Old Password" id="pwd" name="old_password" required>

                    <!--      Show/hide password  -->
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye"></i>
                    </span>


                    <br>
                    <!--   Password -->

                    <span class="input-item">
                        <i class="fa fa-key"></i>
                    </span>
                    <!--   Password Input-->
                    <input class="form-input" type="password" placeholder="New Password" id="pwd1" name="new_password" required>

                    <!--      Show/hide password  -->
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye1"></i>
                    </span>


                    <br>
                    <!--   Password -->

                    <span class="input-item">
                        <i class="fa fa-key"></i>
                    </span>
                    <!--   Password Input-->
                    <input class="form-input" type="password" placeholder="Confirm Password" id="pwd2" name="confirm_password" required>

                    <!--      Show/hide password  -->
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye2"></i>
                    </span>


                    <br>
                    <!--        buttons -->
                    <!--      button LogIn -->
                    <button class="log-in"> Confirm </button>
                </div>

                <!--   other buttons -->
                <!-- <div class="other">
                    <button class="btn submits frgt-pass">Forgot Password</button>
                    <button class="btn submits sign-up">Sign Up
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </button>
                </div> -->
            </div>

            <!-- End Form -->
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


    <script>
        function show() {
            var p = document.getElementById('pwd');
            p.setAttribute('type', 'text');
        }

        function hide() {
            var p = document.getElementById('pwd');
            p.setAttribute('type', 'password');
        }

        var pwShown = 0;

        document.getElementById("eye").addEventListener("click", function() {
            if (pwShown == 0) {
                pwShown = 1;
                show();
            } else {
                pwShown = 0;
                hide();
            }
        }, false);

        function show1() {
            var p = document.getElementById('pwd1');
            p.setAttribute('type', 'text');
        }

        function hide1() {
            var p = document.getElementById('pwd1');
            p.setAttribute('type', 'password');
        }

        var pwShown1 = 0;

        document.getElementById("eye1").addEventListener("click", function() {
            if (pwShown1 == 0) {
                pwShown1 = 1;
                show1();
            } else {
                pwShown1 = 0;
                hide1();
            }
        }, false);

        function show2() {
            var p = document.getElementById('pwd2');
            p.setAttribute('type', 'text');
        }

        function hide2() {
            var p = document.getElementById('pwd2');
            p.setAttribute('type', 'password');
        }

        var pwShown2 = 0;

        document.getElementById("eye2").addEventListener("click", function() {
            if (pwShown2 == 0) {
                pwShown2 = 1;
                show2();
            } else {
                pwShown2 = 0;
                hide2();
            }
        }, false);
    </script>
</body>

</html>