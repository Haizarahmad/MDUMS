<?php
        include('config.php');
        include('Admin_Session.php');

        $announcementId = $_GET['announcement_id'];
        $sql = "UPDATE announcement SET announcement_status = 'stop' WHERE announcement_id = '$announcementId'";

        if( mysqli_query($conn, $sql)){
            echo '<script>alert("Announcement stop")</script>';
            echo "<script>window.location = 'Berita-ver3.php'</script>";
        }else{
            echo '<script>alert("Error")</script>';
            echo "<script>window.location = 'Berita-ver3.php'</script>";
        }

?>