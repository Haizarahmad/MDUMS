<?php
        include('config.php');

        $application_id = $_GET['application_id'];
        $sql = "UPDATE permanentresident SET application_status = 'accepted' WHERE application_id = '$application_id'";


        if( mysqli_query($conn, $sql)){
            echo '<script>alert("Application accepted")</script>';
            echo "<script>window.location = 'Notification-modified.php'</script>";
        }else{
            echo '<script>alert("Error")</script>';
            echo "<script>window.location = 'Notification-modified.php'</script>";
        }     
?>