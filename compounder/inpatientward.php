<?php
require '../database.php';


session_start();
if (!isset($_SESSION['compounder_logedin']) || $_SESSION['compounder_logedin'] != true) {
    header('location: /CMS/login.php');
    exit;
}
$insert = false;
$paitent_id = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];

    $sql = "INSERT INTO `add_paitents` (`fname`, `lname`, `address`, `city`, `gender`, `phone`, `age`, `datetime`) VALUES ('$fname', '$lname', '$address', '$city', '$gender', '$phone', '$age', current_timestamp())";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $insert = true;
    } else {
        echo "there is an error";
    }
    $sql = "SELECT * FROM add_paitents";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $paitent_id = $row['id'];
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
    <!-- <link rel="stylesheet" href="/CMS/compounder/index.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Iqbal Homeo Clinic</title>
    <style>
        body {
            background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
            background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
            background-attachment: fixed;
            background-repeat: no-repeat;
            font-family: 'Vibur', cursive;
            font-family: 'Abel', sans-serif;
            opacity: .95;
            background-image: linear-gradient(to top, #d9afd9 0%, #97d9e1 100%);
        }

        label {
            font-family: sans-serif;
            font-weight: 600;
        }

        .text {
            font-weight: 600;
            font-size: 30px;
            color: #9bfff6 !important;
            font-family: sans-serif;
            margin-bottom: 0px;


        }

        .bg-dark.heading.p-3 {
            margin-bottom: 30px;
        }

        .clinic-heading h3 {
            display: inline-block;
            width: 70%;
        }

        .links a {
            padding: 10px;
            color: wheat;
            font-family: emoji;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/CMS/compounder" style="font-family: cursive; font-weight: 600;">IQBAL HOMEO CLINIC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/compounder/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/compounder/records.php">Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/compounder/medicines.php">Medicines</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Note!</strong> Paitent Id is 100" . $paitent_id . "
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
    }
    if ($database_error) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Note!</strong> There is an error in database.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
    }
    ?>
    <div class="container mt-4">
        <form action="/CMS/compounder/inpatientward.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address" required>
            </div>
            <!-- <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div> -->
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" value="Karachi" name="city" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputState">Gender</label>
                    <select id="inputState" class="form-control" name="gender" required>
                        <!-- <option selected>Choose...</option> -->
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="cellNo">Cell No.</label>
                    <input class="form-control" type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="age">Age</label>
                    <input class="form-control" type="number" id="age" name="age" required>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div> -->
            <button type="submit" class="btn btn-primary">Add Paitent</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>