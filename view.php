<?php
require 'database.php';
session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header('location: /CMS/login.php');
    exit;
}
if (isset($_GET['view'])) {
    $sno = $_GET['view'];
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

    <title>Iqbal Homeo Clinic</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

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

    .top-section {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px dotted;
    }

    .name-section,
    .description {
        border-bottom: 1px dotted;
    }

    h6.title {
        background-color: #461818ad;
        border-radius: 8px;
        color: white;
        width: 100px;
        height: 45px;
        line-height: 39px;
        margin-right: 1px;
    }

    p.value {
        padding: 10px;
    }

    .value-box {
        border-bottom: 1px solid #251818;
        height: 45px;
        width: 60%;
    }

    .name-box {
        border-bottom: 1px solid #251818;
        height: 45px;
    }

    .name-box h3 {
        padding-left: 10px;
        padding-right: 10px;
        text-transform: capitalize;
    }

    #name-heading {
        width: 100px;
        height: 45px;
        line-height: 39px;
        margin-right: 1px;

    }

    .id-section p {
        font-size: 20px;
        line-height: 35px;
        margin-left: 10px;
    }

    .date-section p {
        font-size: 20px;
        line-height: 35px;
        margin-left: 10px;
    }

    .text-heading {
        padding: 0px 10px;
        margin-bottom: 10px;
    }

    .text-field {
        border: 1px solid;
        padding: 10px;
        text-align: justify;
        background-color: white;
        font-size: 19px;
        font-family: sans-serif;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 2px dashed rgb(243 14 14 / 63%);
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
    .header {
    display: flex;
    justify-content: space-between;
    box-shadow: 0px 4px 13px 0px #484545;
}
span#paitentName {
    text-transform: capitalize;
    border-bottom: 1px solid gray;
    padding: 0px 5px;

}
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <a class="navbar-brand" href="/CMS" style="font-family: cursive; font-weight: 600;">IQBAL HOMEO CLINIC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/records.php">Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
    if ($database_error) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Note!</strong> There is an error in database.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
    }

    $sql_add = "SELECT * FROM add_paitents WHERE add_paitents.id='$sno'";
    $result_add = mysqli_query($connection, $sql_add);
    while($row = mysqli_fetch_assoc($result_add)){
        echo"<div class='py-3 px-5 mx-4 hide header mt-2'>
        <div><h3>Paitent Name : <span id='paitentName'>" . $row['fname'] . " ". $row['lname']."</span></h3>
        <h3>Age : <span id='PaitentId'> " . $row['age'] . "</span></h3></div>
        
        <h3>ID : <span id='PaitentId'> 100" . $row['id'] . "</span></h3></div><br>";
    break;
    };
    $sql = "SELECT * FROM paitents_opd where `paitent_id`= '$sno' ORDER BY `datetime` DESC";
    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
    <div class='container'>
        <div class='top-section'>
           
        <div class='date-section d-flex p-2 bd-highlight'>

            <h3>

                Date:
            </h3>
            <p>" . $row['datetime'] . "</p>
        </div>
        </div>
        

        <div class='description row m-2'>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>Diabetic:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['diabetics'] . "</p>
            </div>


        </div>
        
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>Fever:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['fever'] . "</p>
            </div>


        </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>B.P:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['blood_presure'] . "</p>
            </div>


        </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>HBa1c:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['HBa1c'] . "</p>
            </div>


        </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>FBS:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['FBS'] . "</p>
            </div>


        </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>RBS:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['RBS'] . "</p>
            </div>


        </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>Chol:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['Chol'] . "</p>
            </div>


        </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>Urea:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['Urea'] . "</p>
            </div>


        </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
            <h6 class='title text-center'>Creatinine:</h6>
            <div class='value-box'>

                <p class='value text-center'>" . $row['Creatinine'] . "</p>
            </div>


        </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
        <h6 class='title text-center'>Tryglaceride:</h6>
        <div class='value-box'>

            <p class='value text-center'>" . $row['Tryglaceride'] . "</p>
        </div>


    </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
        <h6 class='title text-center'>Weight:</h6>
        <div class='value-box'>

            <p class='value text-center'>" . $row['weight'] . "</p>
        </div>


    </div>
        <div class='d-flex p-2 bd-highlight col-md-2 col-6'>
        <h6 class='title text-center'>Height:</h6>
        <div class='value-box'>

            <p class='value text-center'>" . $row['height'] . "</p>
        </div>


    </div>
     

        </div>
        <div class='row'>

        <div class='col-md-6 col-12'>
            <h3 class='text-heading'>
                Diagnostics:
            </h3>
            <p class='mt-2 text-field'>" .nl2br( $row['diagnostics'] ). "</p>
        </div>
        <div class='col-md-6 col-12'>
            <h3 class='text-heading'>
                Medicines:
            </h3>
            <p class='mt-2 text-field'>" .nl2br( $row['meds'] ). "</p>
        </div>
        </div>
        </div>
        <hr>";
    }
    ?>


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
    </script>
</body>

</html>