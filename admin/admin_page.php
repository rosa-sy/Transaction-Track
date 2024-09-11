<?php
require('../config.php');
require('../header.php');
?>

 <!DOCTYPE html>
 <html lang="en">
 
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     
     <title>Admin Panel</title>
     <link rel="stylesheet" type="text/css" href="../style/tabel.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
 
 <body>
     <main class="table" id="customers_table" style="margin-top:100px;">
        <section class="table__header">
            <button  class="btn-open-popup" onclick="create()">  +  معاملة جديدة  </button>
            <form class="input-group">
                <input type="text" id="search" style="text-align:center;" placeholder="البحث ..." oninput= " liveSearch() " />
                <img src="../images/search.png" alt="">
            </form>
        </section>

        <section class="table__body">
            <table style="margin-top:10px;">
                 <thead>
                     <tr >
                         <th> رقم المعاملة </th>
                         <th> الاسم </th>
                         <th> رقم الهوية </th>
                         <th> رقم الوارد </th>
                         <th> الجهة الواردة</th>
                         <th> موجه الى  </th>
                         <th> PDF المرسل </th>
                         <th> ملاحظات المعاملة</th>
                         <th> PDF المستلم  </th>
                         <th> حالة المعاملة </th>
                     </tr>
                 </thead>
                 <tbody  id="results">
                 
            <?php
    $db= mysqli_connect("localhost", "root", "", "officea_dmin");
    $query="SELECT * FROM transactions";
    $result=$db->query($query);
    
    try {
        $db= new mysqli("localhost", "root", "", "officea_dmin");

        if($db->connect_error){
            die("Connection failed: ". $db->connect_error);
        }else{
            $result=$conn->query($query);
        }
        while($user=$result->fetch_assoc()){
            echo "
            <tr>
            <td> $user[transno] </td>
            <td> $user[firstname] </td>
            <td> $user[idn] </td>
            <td> $user[inboxno] </td>
            <td> $user[inbox] </td>
            <td> $user[sendto] </td>
            <td>
            <a href='../admin/pdf/$user[adminpdf]' target='_blank'>$user[adminpdf]</a>
            </td>
            <td> $user[sendnote]</td>
            <td>
            <a href='../user/pdf/$user[pdfsend]' target='_blank'>$user[pdfsend]</a>
            </td>

            <td>"?><?php  
            if($user['status'] == 0){
                echo '<p><a href="status.php?id='.$user['id'].'&status=1" class="status cancelled"> لم يتم الرد </a></p>'?>
                <?php 
                }
                else
                {
                    echo'<a href="status.php?id='.$user['id'].'&status=0"  class="status shipped">   تم  الرد   </a>'?>
                    <?php
                    }
                    echo "
            </td>
            </tr>";
        }
    $db->close();
} catch (Exception $e){
    $error_message =  $e->getMessage();
    echo "ErrorMessage: $error_message";
}
?>
                    
                     
                 </tbody>
             </table>
         </section>
     </main>

<!--.....................................................popup model!.................... -->
    <div class="overlay-container" id="createmodel">
    <div class="popup-box">
        <button class="btn-close-popup"  onclick=' create() '>X</button>
        
            <h1 style="margin-top:25px; color:#265E7E; font-size:25px;">إنشاء معاملة</h1>
            <hr>
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
                    <div class="column">
                        <label class="form-label" for="idn"> الاسم :-</br></label></br>
                        <input class="form-input"type="text" placeholder="الاسم" id ="firstname"  name="firstname" required></br>
                    </div>
                    <div class="column">
                        <label class="form-label" for="inboxno">رقم الوارد :-</br></label></br>
                        <input class="form-input"type="text" placeholder="رقم الوارد" id ="inboxno"name="inboxno" required></br>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label class="form-label" for="inbox">الجهة الواردة </br></label></br>
                        <input class="form-input"type="text" placeholder="الجهة الواردة" id ="inbox"name="inbox" required></br></br>
                    </div>
                    <div class="column">
                        <legend class="" for="adminpdf">ارفاق معاملة PDF:-</br></legend></br>
                        <input style="border:none;text-align:center;color:#265E7E;" class="labelbdf"type="file" placeholder="ارفاق ملف pdf " id ="adminpdf" name="adminpdf" accept=".pdf" required></br></br>
                    </div>
                </div>
                <div class="row">
                <div class="column">
                    <div class="column-radio">
                        <fieldset class="chkgroup" role="radiogroup" aria-labelledby="question">
                            <legend id="question" style="margin:0;">موجه الى قسم : </legend>
                            <input id="c1" type="radio" name="chk"value="الشؤون القانونية"/> 
                            <label class="label" for="c1" style="direction: rtl;">الشؤون القانونية</label>
                            <input id="c2" type="radio" name="chk"value="خدمات المرضى"/> 
                            <label class="label" for="c2"style="direction: rtl;">خدمات المرضى </label>
                            <input id="c3" type="radio" name="chk"value="الخدمات العلاجية المساندة"/> 
                            <label class="label" for="c3"style="direction: rtl;">الخدمات العلاجية المساندة</label>
                        </fieldset>
                    </div>
                </div>
                </div>
                <br>
                    <div class="row" style="align-items: left;">
                        <button type='submit' name='submit' class="btn-open-popup"> حـفـظ </button> 
                    </div>
            </form>
        <!-- <div class="row"></div> -->
        </div>
     </div>

<?php
    if(isset($_POST["submit"])){
    $transno=$_POST["transno"];
    $firstname=$_POST["firstname"];
    $idn=$_POST["idn"];
    $inboxno=$_POST["inboxno"];
    $inbox=$_POST["inbox"];
    $sendto=$_POST["chk"];
    
    $adminpdf = $_FILES['adminpdf']['name'];
    $file_tmp_admin = $_FILES['adminpdf']['tmp_name'];
    $sendnote=$_POST["sendnote"]=0;
    $pdfsend=$_FILES['pdfsend']['name']='';
    $file_tmp_send = $_FILES['pdfsend']['tmp_name']='';
    $status=$_POST["status"]=0;

    
    
    // $pdf_store="./pdf/";
    move_uploaded_file($file_tmp_admin,"../admin/pdf/".$adminpdf);
    move_uploaded_file($file_tmp_send,"../user/pdf/".$pdfsend);

    $qurey="INSERT INTO transactions VALUES('','$transno','$firstname','$idn','$inboxno','$inbox','$sendto','$adminpdf','$sendnote','$pdfsend','$status')";
   

    mysqli_query($conn,$qurey);
    ?>
    <script type="text/javascript">
        window.addEventListener('load', function()
        {
            swal({
                text: "تم الإضافة بنجاح",
                icon: "success",
                });
        });
        
        
        setTimeout(function()
        {
            window.location.href=window.location.href;
        },3000);
    </script>
    <?php
    }
?>
     <script>
        function create(){
            const overlay=document.getElementById('createmodel');
            overlay.classList.toggle('show');
        }
        // function close(){
        // document.getElementById('createmodel').style.display="none";
            
        // }

        
        function liveSearch() {
            const query = document.getElementById('search').value;

            // Create an AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../search.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('results').innerHTML = this.responseText;
                }
            };

            xhr.send('transno=' + encodeURIComponent(query))
           
            
        }
        </script>
     
 
 </body>
 
 </html>