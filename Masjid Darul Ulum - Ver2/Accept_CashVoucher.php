<?php
        include('config.php');

        $expenseId = $_GET['expense_id'];
        $sql = "UPDATE expense SET Expense_status = 'accepted' WHERE Expense_id = '$expenseId'";

        if( mysqli_query($conn, $sql)){
            echo "<script>window.location = 'Notification-Manager-Admin.php'</script>";
        }else{
            echo '<script>alert("Error")</script>';
            echo "<script>window.location = 'Notification-Manager-Admin.php'</script>";
        }


        
?>