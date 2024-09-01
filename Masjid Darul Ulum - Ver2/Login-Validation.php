<?php
include "config.php";

if(isset($_POST['login'])){
	$uname = $_POST['username'];
	$upassword = $_POST['password'];
	$sql = "SELECT user_username, user_password, user_role FROM user WHERE user_username = '$uname' AND user_password = '$upassword'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            if($row["user_username"] == $uname AND $row["user_password"] == $upassword){

                echo '<script>alert("You have been successfully log in")</script>';
                if($row["user_role"] == "admin"){
                    session_start();
                    $_SESSION['last_login_timestamp'] = time();
                    $_SESSION['admin'] = 'admin';
                    echo "<script>window.location = 'Admin-Dashboard-Ver1.php'</script>";
    
                }else{
                    session_start();
                    $_SESSION['last_login_timestamp'] = time();
                    $_SESSION['treasurer'] = 'treasurer';
                    echo "<script>window.location = 'Akaun-Dashboard-View.php?bank_id=1'</script>";
                }
            }
            elseif($row["user_username"] != $uname AND $row["user_password"] == $upassword){
                echo '<script>alert("Wrong username")</script>';
                echo "<script>window.location = 'New-Login-Page.php'</script>";
            }
            elseif($row["user_username"] == $uname AND $row["user_password"] != $upassword){
                echo '<script>alert("Wrong password")</script>';
                echo "<script>window.location = 'New-Login-Page.php'</script>";
            }
            else{
                echo '<script>alert("Username does not exist")</script>';
                echo "<script>window.location = 'New-Login-Page.php'</script>";
            }
        } 
    } else {
            echo '<script>alert("No user have been register into the system")</script>';
            echo "<script>window.location = 'New-Login-Page.php'</script>";
        }
}
?>