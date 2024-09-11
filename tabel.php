<?php
// require ("header.php");
?>


<?php
require('config.php');

if(isset($_POST["submit"])){
    $transno=$_POST["transno"];
    $idn=$_POST["idn"];
    $inboxno=$_POST["inboxno"];
    $inbox=$_POST["inbox"];
    $sendto=$_POST["sendto"]=0;
    // $adminpdf=$_FILES['adminpdf']["type"]='application/pdf';
    $adminpdf = $_FILES['adminpdf']['name'];
    $file_tmp_admin = $_FILES['adminpdf']['tmp_name'];
    $sendnote=$_POST["sendnote"]=0;
    $pdfsend=$_FILES['pdfsend']=0;
    // $pdfsend=$_FILES['pdfsend']['name'];
    // $file_tmp_send = $_FILES['pdfsend']['tmp_name'];
    $status=$_POST["status"]=0;

    
    
    // $pdf_store="./pdf/";
    move_uploaded_file($file_tmp_admin,"./pdf/".$adminpdf);
    // move_uploaded_file($file_tmp_send,"./pdf/".$pdfsend);

    $qurey="INSERT INTO transactions VALUES('','$transno','$idn','$inboxno','$inbox','$sendto','$adminpdf','$sendnote','$pdfsend','$status')";
   

    mysqli_query($conn,$qurey);
    echo "<script>alert('Your Request Under Process');</script>";


}
?>

 <!DOCTYPE html>
 <html lang="en">
 
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Convert | Export html Table to CSV & EXCEL File</title>
     <link rel="stylesheet" type="text/css" href="style/tabel.css">
 </head>
 
 <body>
     <main class="table" id="customers_table">
         <section class="table__header">
             <h1>طلبات المعاملات </h1>
             <button  class="btn-open-popup" onclick="create()"  > create </button>
         </section>
         
         
         <section class="table__body">
            




             <table>
                 <thead>
                     <tr>
                         <th> رقم المعاملة <span class="icon-arrow">&UpArrow;</span></th>
                         <th> رقم الهوية <span class="icon-arrow">&UpArrow;</span></th>
                         <th> رقم الوارد <span class="icon-arrow">&UpArrow;</span></th>
                         <th> الجهة الواردة <span class="icon-arrow">&UpArrow;</span></th>
                         <th> موجه الى  <span class="icon-arrow">&UpArrow;</span></th>
                         <th> PDF المرسل   <span class="icon-arrow">&UpArrow;</span></th>
                         <th> PDF المستلم  <span class="icon-arrow">&UpArrow;</span></th>
                         <th> حالة المعاملة <span class="icon-arrow">&UpArrow;</span></th>
                     </tr>
                 </thead>
                 <tbody>
                 <thead>
            <?php
$db= mysqli_connect("localhost", "root", "", "officea_dmin");
$query="SELECT *FROM transactions";
$result=$db->query($query);
try{ 
    while($user=$result->fetch_assoc()){
        echo "
        <tr>
        <td> $user[transno] </td>
        <td> $user[idn] </td>
        <td> $user[inboxno] </td>
        <td> $user[inbox] </td>
        <td> $user[sendto] </td>
        <td>
        <a href='./pdf/$user[adminpdf]'>$user[adminpdf]</a>
        </td>
        
        <td>"?><?php  if($user['status'] == 0){
            echo '   <button  class=" btn btn-danger btn-sm" onclick=".$user[id].$status=1"> Pending </button>';?>
            <?php 
            }else{
                echo' <button class="btn btn-success btn-sm" role="alert" disabled>Approved</button>';
        }?>
            <?php echo "         
        </td>


        <td>"?><?php  if($user['status'] == 0){
                                echo '<a href="new_req.php?id='.$user['id'].'&status=1" class="btn btn-outline-danger"> Pending </a>'?>
                                <?php 
                                }else{
                                    echo'<a href="new_req.php?id='.$user['id'].'&status=0"  class="btn btn-success"> Approved </a>'?>
                                    <?php
                            }
                                 echo "         
                            </td>
            
           
        </tr>
            ";

    }
    $db->close();
} catch (Exception $e){
    $error_message =  $e->getMessage();
    echo "ErrorMessage: $error_message";
}
?>
                     <!-- <tr>
                         <td> 1 </td>
                         <td> <img src="images/Zinzu Chan Lee.jpg" alt="">Zinzu Chan Lee</td>
                         <td> Seoul </td>
                         <td> 17 Dec, 2022 </td>
                         <td>to</td>
                         <td>PDF</td>
                         <td>
                             <p class="status delivered">Delivered</p>
                         </td>
                     </tr>
                     <tr>
                         <td> 2 </td>
                         <td><img src="images/Jeet Saru.png" alt=""> Jeet Saru </td>
                         <td> Kathmandu </td>
                         <td> 27 Aug, 2023 </td>
                         <td>to</td>
                         <td>PDF</td>
                         <td>
                             <p class="status cancelled">Cancelled</p>
                         </td>
                     </tr>
                     <tr>
                         <td> 3</td>
                         <td><img src="images/Sonal Gharti.jpg" alt=""> Sonal Gharti </td>
                         <td> Tokyo </td>
                         <td> 14 Mar, 2023 </td>
                         <td>to</td>
                         <td>PDF</td>
                         <td>
                             <p class="status shipped">Shipped</p>
                         </td>
                     </tr>
                     <tr>
                         <td> 4</td>
                         <td><img src="images/Alson GC.jpg" alt=""> Alson GC </td>
                         <td> New Delhi </td>
                         <td> 25 May, 2023 </td>
                         <td>to</td>
                         <td>PDF</td>
                         <td>
                             <p class="status delivered">Delivered</p>
                         </td>
                     </tr>
                     <tr>
                         <td> 5</td>
                         <td><img src="images/Sarita Limbu.jpg" alt=""> Sarita Limbu </td>
                         <td> Paris </td>
                         <td> 23 Apr, 2023 </td>
                         <td>to</td>
                         <td>PDF</td>
                         <td>
                             <p class="status pending">Pending</p>
                         </td>
                     </tr> -->
                     
                 </tbody>
             </table>
         </section>
     </main>

<!--.....................................................popup model!.................... -->
     <div class="overlay-container" id="createmodel">
        <div class="popup-box">
            <h2>إنشاء معاملة</h2>
            <hr >
            <form  class= "form-container"action="" method ="POST"enctype="multipart/form-data">
                <div class="row">
                    <div class="column">
                        <label class="form-label" for="transno">رقم المعاملة :-</br></label></br>
                        <input class="form-input"type="text" placeholder="رقم المعاملة" id ="transno"name="transno" required></br></br>
                    </div>
                    <div class="column">
                        <label class="form-label" for="idn">رقم الهوية :-</br></label></br>
                        <input class="form-input"type="text" placeholder="رقم الهوية" id ="idn"name="idn" required></br>
                    </div>
                </div>
                <div class="row">
                <div class="column">
                        <label class="form-label" for="inboxno">رقم الوارد :-</br></label></br>
                        <input class="form-input"type="text" placeholder="رقم الوارد" id ="inboxno"name="inboxno" required></br>
                    </div>
                    <div class="column">
                        <label class="form-label" for="inbox">الجهة الواردة </br></label></br>
                        <input class="form-input"type="text" placeholder="الجهة الواردة" id ="inbox"name="inbox" required></br></br>
                    </div>
                   
                </div>
                <div class="row" style="width:40%;margin:0 200px 20px 200px;">
                    <!-- <div class="column"> -->
                        <label class="form-label" for="adminpdf">ارفاق معاملة PDF:-</br></label></br>
                        <input class="form-input"type="file" placeholder="ارفاق ملف pdf " id ="adminpdf"name="adminpdf" accept=".pdf" required></br></br>
                    <!-- </div> -->
                    
                </div>
                <div class="row" style="justify-content:center !important;">
                    <!-- <div class="column" style="width:70px;"> -->
                    <button   type= "submit" name="submit" class="btn-open-popup"  id="sendto" value="elq-ksha-it@moh.gov.sa" style="margin:0 15px;"> الشؤون القانونية  </button>

                    <!-- </div> -->
                    <!-- <div class="column"style="width:70px;"> -->
                    <button type= "submit" name="user2"class="btn-open-popup"  style="margin:0 15px;"> الخدمات العلاجية المساندة   </button>
                    <!-- </div> -->
                    <!-- <div class="column"> -->
                    <button type= "submit" name="user3" class="btn-open-popup" style="margin:0 15px;"> خدمات المرضى  </button>

                    <!-- </div> -->
                </div>
                <button class="btn-close-popup"  onclick="create()"> 
                    Close 
                    </button> 
            </form>
        <!-- <div class="row"></div> -->
        </div>
     </div>
     <script>
        function create(){
            const overlay=document.getElementById('createmodel');
            overlay.classList.toggle('show');
        }
        // function close(){
        // document.getElementById('createmodel').style.display="none";
            
        // }
        </script>
     <script src="script.js"></script>
 
 </body>
 
 </html>