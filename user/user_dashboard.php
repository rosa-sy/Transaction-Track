<?php 
require('../config.php');
require('../header.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../style/tabel.css">
    <link rel="icon" href="../images/NEW LOGO/NEW LOGO.png">

</head>
<body>
    
<main class="table" id="customers_table" style="margin-top:100px;">
    <section class="table__header">
        <h1 style="margin-right: 20px; margin-top:10px; color:#265E7E;">متابعة طلبات المعاملات</h1>
    </section>
    
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th> رقم المعاملة</th>
                    <th> رقم الهوية </th>
                    <th> رقم الوارد </th>
                    <th> المرفقات</th>
                    <th> الرد على المعامة</th>
                </tr>
            </thead>
            <?php
            $res=mysqli_query($conn, " SELECT * FROM transactions WHERE sendto='$_SESSION[dept]' AND status='0' ");
            while($row=mysqli_fetch_array($res))
            {
                ?>
                <tr>
                    <td><?php echo $row["transno"];?></td>
                    <td><?php echo $row["idn"];?></td>
                    <td><?php echo $row["inboxno"];?></td>
                    <td><a href='../admin/pdf/<?php echo $row['adminpdf'];?>' target="_blank"><?php echo $row['adminpdf'];?></a></td>
                    <td><button style="padding: .2rem 0.5rem; border-radius: 2px; font-size: 14px; text-align: center; text-decoration: none; border: none; cursor: pointer; background-color: #d893a3; color: black;" onclick="create(<?php echo $row['id'];?>)"> للـرد على المعاملة </button></td>
                    <td> </td>

                </tr>

                <?php
            }
            ?>
        </table>
    </section>
</main>

<!--.....................................................popup model!.................... -->
     <div class="overlay-container" id="createmodel">
        <div class="popup-box" style="width:30% !important; hight:80% !important;">
        <button class="btn-close-popup"  onclick=' create() '>X</button>
        
            <h1 style="margin-top:15px; color:#265E7E; font-size:25px;" >الرد على المعاملة</h1>
            <hr>
            <form  class= "form-container" action="update.php" method ="POST" enctype="multipart/form-data">
                <input type="hidden"  id="transactionId" name="transactionId" value="<?php $row['id'];?>"/>

                <div class="row">
                    <div class="column">
                        <label class="form-label">إضافة ملاحظة</br></label></br>
                        <input class="box" type="text" id ="sendnote" name="sendnote"></br></br>
                    </div>
                </div>
                <div class="column" style="margin-top:90px;"> 
                    <label class="form-label">إرفاق ملفات الرد</br></label></br>
                    <input style="border:none;text-align:center;color:#265E7E;" class="labelbdf" type="file" placeholder="ارفاق ملف pdf " id ="pdfsend" name="pdfsend" accept=".pdf" required></br></br>
                </div>
                <div class="row" style="align-items: left;">
                    <button class="btn-open-popup" type="submit" name="submit1"> حفظ </button>
                </div>
            </form>
        <!-- <div class="row"></div> -->
        </div>
     </div>
     <script>
        function create(id){
            const overlay=document.getElementById('createmodel');
            overlay.classList.toggle('show');
            document.getElementById('transactionId').value=id;
        }
        // function close(){
        // document.getElementById('createmodel').style.display="none";
            
        // }
        </script>
</body>
</html>