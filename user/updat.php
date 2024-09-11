<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 
require('../config.php');

if (isset($_POST['submit1'])) {
    $transactionId = $_POST['transactionId'];
    $sendnote = $_POST['sendnote'];
    $pdfsend=$_FILES['pdfsend']['name'];
    $file_tmp_send = $_FILES['pdfsend']['tmp_name'];

    if (move_uploaded_file($file_tmp_send,"../user/pdf/".$pdfsend)) {
        $pdfFile = basename($_FILES['pdfsend']['name']);
    } else {
        $pdfFile = null;
    }

    // Update the transaction
    if ($pdfFile!=null) {
        $query = "UPDATE transactions SET sendnote='$sendnote', pdfsend='$pdfsend' WHERE id='$transactionId'";
    } else {
        $query = "UPDATE transactions SET sendnote='$sendnote' WHERE id='$transactionId'";
    }

    if (mysqli_query($conn, $query)) {
        ?>
        <script>
        window.addEventListener('load', function()
        {
            swal({
                text: "تم الإضافة بنجاح",
                icon: "success",
                });
        });
        
        
        setTimeout(function()
        {
            window.location.href='user_dashboard.php';
        },3000);
    </script>
    <?php
       
    } else {
        echo "<script>alert('Error updating transaction.');</script>";
    }
}


?>

