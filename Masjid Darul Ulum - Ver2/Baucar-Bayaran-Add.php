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
    include('Sanitize_Input.php');
    include('config.php');
    include('Treasurer_Session.php');

    if (isset($_POST["add"])) {
        $to = sanitizeInput($_POST['expense_to']);
        $date = sanitizeInput($_POST['expense_date']);
        $amount = sanitizeInput($_POST['expense_amount']);
        $type = sanitizeInput($_POST['expense_type']);
        $desc = sanitizeInput($_POST['expense_description']);
        $prepare = sanitizeInput($_POST['expense_prepare']);
        $accept = sanitizeInput($_POST['expense_accept']);
        $method = sanitizeInput($_POST['payment-method']);
        $bank = sanitizeInput($_POST['bank-type']);
        $status = "pending";

            $sql = "INSERT INTO expense(Expense_Type, Expense_Amount, Expense_Date, Expense_status, Expense_To, Expense_Description, Expense_prepare, accepted_by, payment_method, bank_id) VALUES ('$type', '$amount', '$date', '$status', '$to', '$desc','$prepare','$accept','$method','$bank')";

        if(validateNumericInput($_POST['expense_amount'])){
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
        }else{
            echo '<script>alert("Sila pastikan amaun diisi dengan betul (Contoh: 800)")</script>';
        }

    }

    ?>

    <?php include ('Treasurer-Header.php'); ?>
    
    <div class="container-1">
        <div class="box-1">
        <div class="borang-ahli-kariah">
        <h1>Tambah Baucar Bayaran</h1>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast">
                <div class="toast-header">
                <i class="fa-solid fa-square-check fa-xl mr-1" style="color: #007bff;"></i>
                <strong class="me-auto">Berjaya</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                <p>Baucar bayaran telah berjaya dihantar, sila tunggu pengesahan daripada pengurusi</p>
                </div>
            </div>
        </div>

        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" id="click" method="POST">
        <div class="form-row">

            <div class="col">
            <label>No. Baucar</label>
            <input type="text" class="form-control" placeholder="" disabled>
            </div>

            <div class="col">
            <label>Bayar Kepada</label>
            <input type="text" class="form-control" name="expense_to" placeholder="Nama" required>
            </div>

            <div class="col">
            <label>Tarikh</label>
            <input type="date" name="expense_date" class="form-control" required>
            </div>

            <div class="col">
            <label>Amaun (RM)</label>
            <input type="text" class="form-control" name="expense_amount" placeholder="Masukkan Amaun (Contoh: 800)" required>
            </div>

            <div class="col">
            <label>Tajuk Akaun Perbelanjaan</label>

            <select name = "expense_type" class="form-select mt-3" aria-label="Default select example" required>
                <option selected></option>
            <?php
                include('config.php');
                $sql_query=mysqli_query($conn,"SELECT * FROM expense_type");
                while($row_2=mysqli_fetch_array($sql_query)){
            ?>
            
                <option value="<?php echo $row_2['expense_type_id']; ?>"><?php echo $row_2['expense_type']; ?></option>

            <?php 
            }
            ?>

            </select>

            </div>

            <div class="col">
            <label>Tujuan Bayaran</label>
            <input type="text" class="form-control" name="expense_description" placeholder="Tujuan Bayaran" required>
            </div>

            <div class="col">
            <label>Disediakan oleh</label>
            <input type="text" class="form-control" name="expense_prepare" placeholder="Nama" required>
            </div>

            <div class="col">
            <label>Diluluskan oleh</label>
            <input type="text" class="form-control" name="expense_accept" placeholder="Nama" required>
            </div>

            <div class="col mt-2">
            <label class="d-block">Akaun Bank</label>

            <select name="bank-type" class="form-select mt-3" aria-label="Default select example" required>
                <option selected></option>
            <?php
                $sql_query=mysqli_query($conn,"SELECT * FROM bank");
                while($row_2=mysqli_fetch_array($sql_query)){
            ?>   
                <option value="<?php echo $row_2['bank_id']; ?>"><?php echo $row_2['bank_name']; ?></option>
            <?php 
            }
            ?>

            </select>
        
            </div>

            <div class="col mt-2 d-block">
            <label class="d-block">Kaedah Bayaran</label>
            
            <div class="btn-group btn-group-toggle mt-2" data-toggle="buttons">

                <label class="btn btn-primary">
                <input type="radio" value= "tunai" name="payment-method" id="option1" autocomplete="off" required> Tunai
                </label>        
                <label class="btn btn-primary">
                <input type="radio" value= "e-payment" name="payment-method" id="option2" autocomplete="off" required> E-Payment
                </label>

            </div>
            </div>


        </div>
            <a href="Akaun-Dashboard-View.php?bank_id=1" class="btn btn-primary mt-5 ml-1"><i class="fa-solid fa-circle-chevron-left mr-1"></i>Kembali</a>
            <button type="submit" id="add-expense" name="add" form="click" class="btn btn-primary mt-5"><i class="fa-solid fa-share-from-square mr-1"></i>Hantar</button>
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