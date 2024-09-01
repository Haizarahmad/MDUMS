<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Log Keluar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Anda pasti untuk log keluar?
        </div>
        <div class="modal-footer">
            <a href ="New-Login-Page.php" class="btn btn-primary">Log Keluar</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
    </div>
    </div>
</div>

<nav class="nav-bar">
        <header>
          <img class="logo-icon"src="images/MDUMS.png">
            <div class="list-bar">
                <a href ="Akaun-Dashboard-View.php?bank_id=1" class="button-bar">Akaun</a>
                <a href ="Notification-Manager-treasurer.php" class="button-bar">Notifikasi</a>
                <a href ="" class="button-bar" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Log Keluar</a>
            </div>
        </header>

        
    <div class="header-bar">
        <div class="list-top-header">
        <?php
            include('config.php');
            $sql_query=mysqli_query($conn,"SELECT COUNT(*) AS total FROM expense WHERE Expense_Date >= DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND Expense_status = 'accepted';");
            while($row=mysqli_fetch_array($sql_query)){
  
        if($row['total'] > 0){ ?>
            <span class="circle"><?php echo $row['total']?></span>
        <?php
            }
        }
        ?>

            <a href ="Notification-Manager-Treasurer.php" class="box-top"><img class= "top-nav-icon" src="images/envelope.png"></a>
            <a href ="Tetapan-Akaun-Treasurer.php" class="box-top"><img class= "top-nav-icon" src="images/settings.png"></a>
        </div>

        <div class="list-top-header">

        <?php
            $sql_query_2=mysqli_query($conn,"SELECT * FROM user WHERE id='2'");
            while($row=mysqli_fetch_array($sql_query_2)){
        ?>

            <img class="header-image" src="images/profile/treasurer/<?php echo $row['profile_img']; ?>" alt="">
            <p class="mb-0">Selamat Datang, <?php echo $row['user_username']; ?></p>
        </div>

        <?php
        } 
        ?>
    </div>
</nav>
</html>