<?php

$host = "localhost";      
$user = "root";           
$password = "";           
$dbname = "movie_booking";     


$conn = mysqli_connect("localhost", "root", "", "movie_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>