<?php
require 'database.php';
session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header('location: /CMS/login.php');
    exit;
}




if (isset($_GET['update'])) {
    $sno = $_GET['update'];


    $_SESSION['paitent_id'] = $sno;


    //     // echo $sno;
    //     // echo $sno;
    //     // echo $sno;
    $sql = "SELECT * FROM `add_paitents` WHERE `id`=$sno";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result)) {

        $paitentName = $row['fname'] . " " . $row['lname'];
        $_SESSION['paitent_name'] = $paitentName;
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['age'] = $row['age'];
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Iqbal Homeo Clinic</title>
    <!-- <link rel="stylesheet" href="print.css" media="print"> -->
    <link rel="stylesheet" href="screen.css" media="screen">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <!-- <div class="mrgin-onprint bg-dark heading p-3">
        <div class="hide d-inline links">
            <a href="/CMS/index.php" class="hide">Home</a>
            <a href="/CMS/records.php" class="hide">Records</a>
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
    echo "<div class='py-3 px-5 mx-4 hide header mt-2'>
    <div><h3>Paitent Name : <span id='paitentName'>" . $_SESSION['paitent_name'] . "</span></h3>
    <h3>Age : <span id='PaitentId'> " . $_SESSION['age'] . "</span></h3></div>
    
    <h3>ID : <span id='PaitentId'> 100" . $_SESSION['paitent_id'] . "</span></h3></div>";
    echo "<div class='m-3 hide_on_screen print_header'>
    <div class='d-inline name_section mr-3'>

        <div class='d-inline key'>
            Name:
        </div>
        <div class='d-inline inline value'>
            <p>" . $_SESSION['paitent_name'] . "</p>
            

        </div>
    </div>
    <div class='d-inline id_section mr-3'>

        <div class='d-inline key'>
            ID:
        </div>
        <div class='d-inline inline value'>
             <p>100" . $_SESSION['paitent_id'] . " </p>
            
        </div>
    </div>
    <div class='d-inline gender_section mr-3'>
        <div class='d-inline key'>
            Gender:
        </div>
        <div class='d-inline inline value'>
             <p> " . $_SESSION['gender'] . " </p>
            
        </div>
    </div>
    


</div>
<div class='m-3 hide_on_screen print_header'>
<div class='d-inline age_section mr-3'>
        <div class='d-inline key'>
            Age:
        </div>
        <div class='d-inline inline value'>
             <p> " . $_SESSION['age'] . "</p> 
            
        </div>
    </div>
    <div class='d-inline age_section mr-3'>
        <div class='d-inline key'>
            Date:
        </div>
        <div class='d-inline inline value'>
             <p> " . date('j-n-Y') . "</p> 
            
        </div>
    </div>
    </div>";

    ?>



    <div class="container mt-4">


    <div class="last_record">
        <?php
        $sno = $_SESSION['paitent_id'];
        $sql = "SELECT * FROM paitents_opd where `paitent_id`= '$sno' ORDER BY `datetime` DESC";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo ' 
                <h3>Last Visit Details</h3><p id="date"> Last Visit Date: <span>' . $row['datetime'] . '</span></p> <div class="visit_box">
               
                <div class="box">
                    <h4>Old Symptoms:</h4>
                    <p>' . nl2br($row['diagnostics']) . '</p>
                </div>
                <div class="box">
                <h4>Old Medicines:</h4>
                <p>' . nl2br($row['meds'] ). '</p>
                </div>
            </div>';
        }

        ?>
        </div>



        <h3 id="updates">New Updates</h3>

        <form action="/CMS/records.php" method="post">

            <div class="hide ml-3 form-group">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="diabetics" value="Yes">Diabetics
                </label>
            </div>
            <div class="form-row" id="additoional">
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Fever</span>
                        </div>
                        <input type="text" class="form-control" name="fever">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Blood Presure</span>
                        </div>
                        <input type="text" class="form-control" name="bp">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">HBa1c</span>
                        </div>
                        <input type="text" class="form-control" name="hba1c">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">FBS</span>
                        </div>
                        <input type="text" class="form-control" name="fbs">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">RBS</span>
                        </div>
                        <input type="text" class="form-control" name="rbs">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Chol.</span>
                        </div>
                        <input type="text" class="form-control" name="chol">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Urea</span>
                        </div>
                        <input type="text" class="form-control" name="urea">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Creatinine</span>
                        </div>
                        <input type="text" class="form-control" name="creati">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tryglaceride</span>
                        </div>
                        <input type="text" class="form-control" name="trygla">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Weight</span>
                        </div>
                        <input type="text" class="form-control" name="weight">
                    </div>
                </div>
                <div class="hide form-group col-md-3 col-6">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Height</span>
                        </div>
                        <input type="text" class="form-control" name="height">
                    </div>
                </div>

            </div>
            <p  onclick="show()" class="btn btn-success" id="show" >Extra Details</p>
            <!-- <a  >hide</a> -->
            <div class="form-row">
                <div class="hide form-group col-md-6">
                    <label for="diagnostics">Paitent`s Symptoms</label>
                    <textarea class="form-control" id="disgnostics" name="disgnostics" rows="6"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="meds">Medicines</label>
                    <textarea class="form-control" id="meds" name="meds" rows="6"></textarea>
                </div>
            </div>
            <button type="submit" class="hide btn btn-primary">Save</button>
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
    <script media="print">
        let meds = document.getElementById("meds").value
        console.log(meds);
        sessionStorage.setItem("medciens", meds);
        x=0;

        // let btn = document.getElementsByName("show")
        function show(){
            if(x===1){
            let butn = document.getElementById("additoional")
            let show = document.getElementById("show")
            show.innerHTML="Extra Details"

            butn.style.display = "none"

            x=0
            }
            else{
                let butn = document.getElementById("additoional")
                let show = document.getElementById("show")
            butn.style.display = "flex"
            show.innerHTML="Hide"
            x=1
            }

        }
    </script>

</body>

</html>