<?php
        include('config.php');
        include('Admin_Session.php');

        $expense_id = $_GET['expense_id'];
        $sql = "DELETE FROM expense WHERE Expense_id = '$expense_id'";


        if( mysqli_query($conn, $sql)){
            echo "<script>window.location = 'Notification-Manager-Admin.php'</script>";
        }else{
            echo '<script>alert("Error")</script>';
            echo "<script>window.location = 'Notification-Manager-Admin.php'</script>";
        }
?>