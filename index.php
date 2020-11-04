<?php
session_start();
if( !isset($_SESSION['logedin']) || $_SESSION['logedin']!=true){
  header('location: /CMS/login.php');
  exit;
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
    <link rel="stylesheet" href="/CMS/index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel = "icon" href ="/cms/clinic_logo.png" type = "image/x-icon">
    <title>Iqbal Homeo Clinic</title>
</head>

<body>
<?php
require 'partials/_nav.php'
?>
    <div class="home mt-4 center_div">


        <div class="container ">
            <h3 class="mx-auto" style="text-transform: uppercase;">Welcome to Iqbal Homeo Clinic</h3>
            <div class="buttons row">
                <div class="col-md-3 col-sm-3 col-xs-6"> <a href="/CMS/inpatientward.php" class="btn btn-sm animated-button victoria-one">Add Paitents  <span style="display: block;" class="mt-1"><i class="fas fa-user-md" style="font-size: 20px;"></i></span> </a> </div>
                <div class="col-md-3 col-sm-3 col-xs-6"> <a href="/CMS/records.php" class="btn btn-sm animated-button victoria-one">Search Paitents  <span style="display: block;" class="mt-1"><i class="fas fa-search" style="font-size: 20px;"></i></span> </a> </a> </div>
            </div>

        </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- <script>
        function changeLocation() {
            window.location.href = "/CRUD app/inpatientward.php";
        }

        function changeLocationrecords() {
            window.location.href = "/CRUD app/records.php";
        }
    </script> -->
</body>

</html>