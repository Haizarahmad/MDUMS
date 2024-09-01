<?php
        include('Admin_Session.php');
        include('config.php');

        $application_id = $conn->real_escape_string($_GET['application_id']);
        $sql = "DELETE FROM permanentresident WHERE application_id = '$application_id'";


        if( mysqli_query($conn, $sql)){
            echo "<script>window.location = 'Ahli-Kariah-Dashboard.php'</script>";
        }else{
            echo '<script>alert("Error")</script>';
            echo "<script>window.location = 'Ahli-Kariah-Dashboard.php'</script>";
        }
?>