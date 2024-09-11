<?php
require ('config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content= 
          "width=device-width, initial-scale=1.0">
          <link rel="icon" href="../images/NEW LOGO/NEW LOGO.png">
    <!-- <link rel="stylesheet" type="text/css" href="style/style.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>
<body>

<style>
@import url('https://fonts.googleapis.com/css2?family=Zain:wght@200;300;400;700;800;900&display=swap');

*{
    font-family: "Zain", sans-serif;
}

header {
    position: fixed;
    display:flex;
    top: 0;
    /* right: 0; */
    /* width: 70%; */
    /* background: #7497b1; */
    box-shadow: #265E7E;
    color:#aabfd4;
    z-index: 1000;
    /* height: 90px; */
    padding: 10px;
    overflow: hidden;
    margin:auto;
    font-family: "Zain", sans-serif;
    font-weight: 400;
    font-style: normal;
    
}
h2{
    position: fixed;
    /* display:flex; */
    top: 0;
    margin-top: 35px;
    right:87%;
    font-family: "Zain", sans-serif;
    font-style: normal;
    font-size: 22px;
    color: #aabfd4;
}

.logo{
    right:95%;
    top: 15px;
    height: 40px;
    width:70px;
    position:fixed;
    display:inline-flex;
    margin: 10px;
    transform: rotate(180deg);
}
</style>

 <header class="header"style="margin-bottom:5px;">
    <img src="../images/logo.png" alt="" width='170px;'height='90px;'>
    <a href="../logout.php" class="logo" ><img src="../images/logout1.png" alt="تسجيل خروج"></a>
</header>

<?php
require ('../config.php');
$db= mysqli_connect("localhost", "root", "", "officea_dmin");
$query="SELECT * FROM users";
$result=$db->query($query);
try{ 
    while($user=$result->fetch_assoc()){
        echo "<h2>$_SESSION[dept]</h2>";
    }
    
}catch (Exception $e){
    $error_message =  $e->getMessage();
    echo "ErrorMessage: $error_message";
}
?>



</body>
</html>
