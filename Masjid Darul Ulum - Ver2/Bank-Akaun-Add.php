<!DOCTYPE html>
<head>
  <link rel="icon" href="MDUMS.ico" type="image/x-icon">
  <link rel="stylesheet" href="Admin-Dashboard-Style.css" media="screen">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

    <?php

    include('config.php');
    include('Treasurer_Session.php');

    if (isset($_POST["add"])) {
        $bank = $_POST['bank_account'];
        $amount = $_POST['bank_amount'];

            $sql = "INSERT INTO bank(bank_name, bank_amount) VALUES ('$bank','$amount')";

            if( mysqli_query($conn, $sql)){
                echo "<script>
                window.onload = function() {
                    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                    var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show()) 
                };
                </script>";
            }else{
                echo '<script>alert("Error")</script>';
            }
    }

    ?>

    <?php include ('Treasurer-Header.php'); ?>
    
    <div class="container-1">
        <div class="box-1">
        <div class="borang-ahli-kariah">
        <h1>Bank Akaun</h1>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast">
                <div class="toast-header">
                <i class="fa-solid fa-square-check fa-xl mr-1" style="color: #007bff;"></i>
                <strong class="me-auto">Berjaya</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                <p>Bank Akaun berjaya ditambah</p>
                </div>
            </div>
        </div>

        <form id="click" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <div class="form-row">

            <div class="col mt-2">
            <label>Nama Akaun</label>
            <input type="text" class="form-control" name="bank_account" placeholder="Nama">
            </div>

            <div class="col mt-2">
            <label>Amaun</label>
            <input type="text" class="form-control" name="bank_amount" placeholder="Amaun (Jika Ada)">
            </div>


        </div>
            <a href="Akaun-Dashboard-View.php?bank_id=1" class="btn btn-primary ml-1"><i class="fa-solid fa-circle-chevron-left mr-1"></i>Kembali</a>
            <button class="btn btn-primary" name= "add" type = "submit" form="click"><i class="fa-solid fa-circle-plus mr-1"></i>Tambah</button>

       

        </form>

        </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
<footer>
</footer>
</html>