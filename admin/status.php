<?php
require ('../config.php');


session_start();
$id=$_GET['id'];
$status=$_GET['status'];
$updatequery="UPDATE transactions SET status=$status WHERE id=$id";
mysqli_query($conn ,$updatequery);
header("Location:admin_page.php");
?>