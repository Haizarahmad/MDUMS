<?php
        include('config.php');
        include('Treasurer_Session.php');

        $expense_id = $_GET['expense_id'];
        $sql = "DELETE FROM expense WHERE Expense_id = '$expense_id'";


        if( mysqli_query($conn, $sql)){
            echo "<script> document.location.href = 'Akaun-Dashboard-View.php?bank_id=1';</script>";     
        }else{
            echo '<script>alert("Error")</script>';
        }
?>