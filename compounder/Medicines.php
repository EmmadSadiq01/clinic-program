<?php
require '../database.php';
session_start();
if (!isset($_SESSION['compounder_logedin']) || $_SESSION['compounder_logedin'] != true) {
    header('location: /CMS/login.php');
    exit;
}
if (isset($_GET['deliver'])) {
    $sno = $_GET['deliver'];
    $sql = "DELETE FROM `current_paitents` WHERE `current_paitents`.`paitent_id` = '$sno'";
    $result = mysqli_query($connection, $sql);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
</style>

<body onload=ajax()>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
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
                <li class="nav-item active">
                    <a class="nav-link" href="/CMS/compounder/medicines.php">Medicines</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/CMS/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container ">
        
        <div id="chat" class="mt-5">


        </div>
    </div>
    <?php
    include "../partials/footer.php";
    ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

       function deliver(e) {
                // $sno = e.target.id.substr(3, );
                console.log(e.id)
                window.location = `http://localhost/CMS/compounder/medicines.php?deliver=${e.id}`;
                
            }



        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {

                    document.getElementById('chat').innerHTML = req.responseText;

                    x.play();
                }

            }
            req.open('GET', 'http://localhost/CMS/compounder/chat.php', true);
            req.send();

        }
        setInterval(function() {
            ajax()
        }, 1000)
    </script>
</body>

</html>