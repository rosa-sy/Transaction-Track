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
    $adminpdf=$_FILES['adminpdf']["name"];
    $sendnote=$_POST["sendnote"]=0;
    $pdfsend=$_POST["pdfsend"]=0;
    $status=$_POST["status"]=0;

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
                         <th> PDF  <span class="icon-arrow">&UpArrow;</span></th>
                         <th> حالة المعاملة <span class="icon-arrow">&UpArrow;</span></th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
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
                         <!-- <td> <strong>$399.99</strong> </td> -->
                     </tr>
                     
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
                        <input class="form-input"type="file" placeholder="ارفاق ملف pdf " id ="adminpdf"name="adminpdf" required></br></br>
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