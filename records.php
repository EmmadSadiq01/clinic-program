<?php
require 'database.php';
session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header('location: /CMS/login.php');
    exit;
}

$insert = false;
if (isset($_GET['update'])) {
    $_SESSION['paitent_sno']=$_GET['update'];
    $sno = $_GET['update'];


    $_SESSION['paitent_id'] = $sno;


    // echo $sno;
    // echo $sno;
    // echo $sno;
    $sql = "SELECT * FROM `add_paitents` WHERE `id`=$sno";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result)) {

        $paitentName = $row['fname'] . " " . $row['lname'];
        $_SESSION['paitent_name'] = $paitentName;
    }
    if ($result) {
        $insert = true;
    } else {
        echo "there is an error";
    }

    // $sql = "DELETE FROM `notes` where `notes`.`id` = $sno";
    // $result = mysqli_query($connection, $sql);
    // $delete = true;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $diabetics = $_POST['diabetics'];
    $fever = $_POST['fever'];
    $bp = $_POST['bp'];
    $hb1ca = $_POST['hba1c'];
    $fbs = $_POST['fbs'];
    $rbs = $_POST['rbs'];
    $chol = $_POST['chol'];
    $urea = $_POST['urea'];
    $creati = $_POST['creati'];
    $trygla = $_POST['trygla'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $disgnostics = $_POST['disgnostics'];
    $meds = $_POST['meds'];
    $paitientId = $_SESSION['paitent_id'];
    $pName = $_SESSION['paitent_name'];
    $date = date("Y-m-d");

    // echo $sno;
    $sql = "INSERT INTO `paitents_opd` (`paitent_id`, `paitent_name`,`diabetics`, `fever`, `blood_presure`,`HBa1c`,`FBS`, `RBS`,`Chol`,`Urea`,`Creatinine`,`Tryglaceride`,`diagnostics`, `meds`,`weight`,`height`) VALUES ('$paitientId', '$pName' ,'$diabetics', '$fever', '$bp', '$hb1ca', '$fbs','$rbs','$chol','$urea','$creati','$trygla', '$disgnostics', '$meds','$weight','$height')";
    $result = mysqli_query($connection, $sql);

// send to current paitents

    $sql_pass = "INSERT INTO `current_paitents` (`paitent_id`, `paitent_name`, `meds`, `date`) VALUES ('$paitientId', '$pName', '$meds', '$date');";
    $result_pass = mysqli_query($connection, $sql_pass);

// set last entry

    $sql_visit = "SELECT * FROM `last visit` Where `paitent_id` = '$paitientId'";
    $result_visit = mysqli_query($connection, $sql_visit);

    $user_exist =  mysqli_num_rows($result_visit) ;

    
    if($user_exist > 0){
        $sql_visit_data = "UPDATE `last visit` SET `meds` = '$meds', `symtoms`='$disgnostics', `date`='$date' WHERE `last visit`.`paitent_id` = $paitientId";
        $result_visit_data = mysqli_query($connection, $sql_visit_data);
    }
    else{
        $sql_visit_data = "INSERT INTO `last visit` (`paitent_id`, `paitent_name`, `symtoms`, `meds`, `date`) VALUES ('$paitientId', '$pName', '$disgnostics', '$meds', '$date')";
        $result_visit_data = mysqli_query($connection, $sql_visit_data);
    }


    // -----ends last visit------


    if ($result) {
        $insert = true;
    } else {
        echo "there is an error";
    }


    header('location: /CMS/records.php');
    $_SESSION['print_data'] = "print";
}
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    echo $sno;
    // $sql = "DELETE FROM `notes` where `notes`.`id` = $sno";
    // $result = mysqli_query($connection, $sql);
    // $delete = true;
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <title>Iqbal Homeo Clinic</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
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

    #records-heading {
        font-family: sans-serif;
        font-weight: 600;
        color: #317d31;
        text-align: center;
        text-decoration: underline;
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

<body>
    <!-- <div class="bg-dark heading p-3">
        <div class="d-inline links">
            <a href="/CMS/index.php">Home</a>
            <a href="/CMS/records.php">Records</a>
        </div>
        <div class="d-inline clinic-heading">
            <h3 class="text-center text-white text">

                IQBAL HOMEO CLINIC <i class="fas fa-clinic-medical"></i></h3>

        </div>
    </div> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="/CMS" style="font-family: cursive; font-weight: 600;">IQBAL HOMEO CLINIC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/CMS/records.php">Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <h1 id="records-heading">Paitents Record</h1>
    <div class="container my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Paitent ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM add_paitents";
                $result = mysqli_query($connection, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "";
                    echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td> 100" . $row['id'] . "</td>
            <td style='text-transform:capitalize'>" . $row['fname'] . " " . $row['lname'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td><button type='button' class='updateButton btn btn-primary' onclick='handleSubmit' id=" . $row['id'] . ">Update</button> <button type='button' class='View btn btn-danger' id=" . 'd' . $row['id'] . ">View</button></td>
            </tr>";
                }

                ?>
            </tbody>
        </table>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        update = document.getElementsByClassName("updateButton");
        Array.from(update).forEach((element) => {
            element.addEventListener("click", (e) => {
                sno = e.target.id;
                window.location = `/CMS/update.php?update=${sno}`;



            })
        })

        view = document.getElementsByClassName("View");
        Array.from(view).forEach((element) => {
            element.addEventListener("click", (e) => {
                sno = e.target.id.substr(1, );
                window.location = `/CMS/view.php?view=${sno}`;



            })
        })
        if (sessionStorage.getItem('print_data') === "print") {
            window.location.href("www.google.com")
        }
    </script>

</body>

</html>