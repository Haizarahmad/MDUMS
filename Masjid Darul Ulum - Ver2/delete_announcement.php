<?php
        include('config.php');

        $announcementId = $_GET['announcement_id'];
        $sql = "DELETE FROM announcement WHERE announcement_id = '$announcementId'";

        if( mysqli_query($conn, $sql)){
            echo '<script>alert("Announcement deleted")</script>';
            echo "<script>window.location = 'Berita-ver3.php'</script>";
        }else{
            echo '<script>alert("Error")</script>';
            echo "<script>window.location = 'Berita-ver3.php'</script>";
        }

?>