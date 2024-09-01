<?php                 

session_start();

if(isset($_SESSION["admin"]))  
{  
     if((time() - $_SESSION['last_login_timestamp']) > 3800) // 900 = 15 * 60  
     {  
        header('location:Logout.php');
        exit();
     }
}  
else  
{  
     header('location:New-Login-Page.php');
     exit();
}

?>