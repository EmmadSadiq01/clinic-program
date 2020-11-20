<?php
$server =  "localhost";
$username = "root";
$password = "";
$database = "iqbal";
$database_error = false;

$connection = mysqli_connect($server, $username, $password, $database);
if (!$connection) {
    $database_error = true;
}
?>