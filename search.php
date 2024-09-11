<?php
require('config.php');

if (isset($_POST['transno'])) {
    $transno = $_POST['transno'];
    // $firstname = $_POST['firstname'];
    $query = "SELECT * FROM transactions WHERE transno LIKE '%$transno%' OR firstname LIKE '%$transno%' OR idn LIKE '%$transno%' ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Output the results as table rows
        while ($user = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$user['transno']}</td>
                    <td>{$user['firstname']}</td>
                    <td>{$user['idn']}</td>
                    <td>{$user['inboxno']}</td>
                    <td>{$user['inbox']}</td>
                    <td>{$user['sendto']}</td>
                    <td><a href='../admin/pdf/{$user['adminpdf']}'>{$user['adminpdf']}</a></td>
                    <td>{$user['sendnote']}</td>
                    <td><a href='../user/pdf/{$user['pdfsend']}' target='_blank'>{$user['pdfsend']}</a></td>
                    <td>" . ($user['status'] == 0 ? '<p><a href="status.php?id='.$user['id'].'&status=1" class="status cancelled"> لم يتم الرد </a></p>' : '<a href="status.php?id='.$user['id'].'&status=0" class="status shipped">   تم  الرد   </a>') . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No results found</td></tr>";
    }
}
?>