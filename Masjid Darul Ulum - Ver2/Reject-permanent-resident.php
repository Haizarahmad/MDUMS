<?php
        include('config.php');
        include('Admin_Session.php');

        $application_id = $_GET['application_id'];
        $sql = "UPDATE permanentresident SET application_status = 'rejected' WHERE application_id = '$application_id'";


        if( mysqli_query($conn, $sql)){
            echo '<script>alert("Permanent Resident is rejected")</script>';
            echo "<script>window.location = 'Ahli-kariah-ver3.php'</script>";
        }else{
            echo '<script>alert("Error")</script>';
            echo "<script>window.location = 'Ahli-kariah-ver3.php'</script>";
        }
?>