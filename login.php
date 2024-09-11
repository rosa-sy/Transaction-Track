<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php
/*
// require ("header.php");
$error="";
$valid_admin_name = 'admin'; // Replace with your valid admin name
$valid_password = 'password'; // Replace with your valid password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['admin_name']) && isset($_POST['password'])) {
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];

    if ($admin_name === $valid_admin_name && $password === $valid_password) {
    // header("Location: adminpanel.php");
    // $_SESSION['username'];
    $_SESSION['username'] = $username;
    exit(); 

    } else {

        $error= "Invalid admin name or password. Please try again.";
        echo"<script>
        alert('$error');
        window.location.href='login.php';
        </script>";
        exit();
    }   
} 
}
*/
session_start();
include('config.php');
if(isset($_POST['btnLogin']))
{
    $username=mysqli_real_escape_string($conn, $_POST["username"]);
    $password=mysqli_real_escape_string($conn, $_POST["password"]);

    $count=0;
    $res = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' && password='$password'");
    $count = mysqli_num_rows($res);

    if($count>0)
    {
        while($row = mysqli_fetch_assoc($res))
        {
            $_SESSION['role'] = $row['role'];
            $_SESSION['dept'] = $row['dept'];

            if($row['role'] == 'admin')
            {
                header("location:admin/admin_page.php");
            }
            elseif($row['role'] == 'user')
            {
                header("location:user/user_dashboard.php");
            }

        }
    }
    else
    {
        ?>
        <script>
            window.addEventListener('load', function()
            {
                swal({
                    text: "اسم المستخدم أو كلمة المرور غير صحيحة",
                    icon: "error",
                    });
            });

        </script>
        <?php
    }

}     
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="icon" href="images/NEW LOGO/NEW LOGO.png">

    <style>
        body {
            background-image: url("images/bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: "Zain", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        h2 {
            text-align: center;
            /* color: #51A4D1; */
            color: #265E7E;
            font-size: 30px;
            margin-bottom: 50px;
        }
        h5{
            text-align: left;
            /* padding:5px? */
            transform: translate(10%, 10%);
        }
        .container {
            top: 450px;
            position: absolute;
            left: 50%;  
            transform: translate(-50%, -50%);
            width: 700px;
            height: 400px;
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 8, 0.4);
            display: inline-block;
            align-items: center;
            text-align:center;
            font-size: 20px;
            font-weight: bold;
            color: #FFFFFF; 
        }
  
        .column{
            float: left;
            width: 50%;
            height: 150px;
            /* direction: ltr; */
            justify-content: center;
            padding-bottom: 15%;
            padding-top: 20px;

        }
        .row::after{
            content: "";
            display: table;
            clear: both;
            padding: 10% 8%;
            margin-right: 15px;
            margin-left: 15px;
        }

        button[type="submit"] {
     
        padding: 5px ;
        align-items: center;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(1, 1, 1, 0.4);
        border:none;
        justify-content: center;
        color: rgba(255, 255, 255, 1);
        border-radius: 20px;
        background: #265E7E;
        font-size: 20px;
        font-style: Medium;
        font-weight: 600;
        margin-top: 55px;
        width:250px;
        cursor: pointer;
        font-family: "Zain", sans-serif;
        }

        button:hover {
        background-color: #ACB9BC;
        color: #265E7E;
        }


        input[type="text"],
        input[type="password"]{
            
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 30px;
            border: 2px solid #265E7E;
            margin: -10px;
            cursor: pointer;
            background-color: transparent;
            width: 75%;
            height: 25%;
            color:#679ABE;
            font-weight: bold;
            color-scheme: white;
        }
        .vl {

            border-right: 2px solid #ACB9BC;
            height: 370px;
            margin: auto;
            }

    </style>
    </head>
    <body>

    <div class="container">
        <div class="column">
        <div class="vl">
            <img src="images/newLOGO.png" style="width:260px;height:152px;margin-top:110px;float:end;"alt="log" />
        </div>
        </div>
        <div class="column">
        <div class="row">
                <form action="" method="POST" autocomplete="off">
                    <h2>تسجيـل الدخـول</h2>
                <div class="form-group">
                    <label for="username" style="color: #265E7E; float:right; padding: 5px; padding-right: 45px; margin-bottom: 2px;">اسم المستخدم</label>
                    <input type="text" id="username" name="username"  placerequired >
                </div>
                <div class="form-group" style="margin-top: 15px;">
                    <label for="password" style="color:#265E7E; float:right; padding: 5px; padding-right: 45px; margin-bottom: 2px;">كلمة المرور</label></h5>
                    <input type="password" id="password" name="password" required >
            </div>

        <?php
                    if(isset($_SESSION['status']))
                    {
                        unset($_SESSION['status']);
                    }
                    ?>
        <button type="submit" name="btnLogin">دخـول</button>
        </form>

        </div>
        </div>
    </div>

    <footer style="margin-top: 45%;">
        <p> &copy; <script>document.write(new Date().getFullYear());</script>,  &nbsp; Created By : Atheer Alsulu, Rania Aldaas </p>
    </footer>

    </body>
</html>