<?php 
$conn = mysqli_connect("localhost", "root", "", "officea_dmin");

if (!$conn) {
    die("ERROR: couldn't connect " . mysqli_connect_error());
}
?>