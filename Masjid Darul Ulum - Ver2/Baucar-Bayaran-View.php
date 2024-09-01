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
if (isset($_POST["update"])) {
    $id = $_POST['expense_id'];
    $to = sanitizeInput($_POST['expense_to']);
    $date = sanitizeInput($_POST['expense_date']);
    $amount = sanitizeInput($_POST['expense_amount']);
    $type = sanitizeInput($_POST['expense_type']);
    $desc = sanitizeInput($_POST['expense_description']);
    $prepare = sanitizeInput($_POST['expense_prepare']);
    $accept = sanitizeInput($_POST['expense_accept']);
    $method = sanitizeInput($_POST['payment-method']);
    $bank = sanitizeInput($_POST['bank-type']);

        $sql = "UPDATE expense SET Expense_Type = '$type', Expense_Amount = '$amount', Expense_Date='$date', Expense_To='$to', Expense_Description='$desc', Expense_prepare='$prepare', accepted_by='$accept', payment_method='$method', bank_id='$bank' WHERE Expense_id = '$id'";

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
        <h1>Baucar Bayaran</h1>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast">
                <div class="toast-header">
                <i class="fa-solid fa-square-check fa-xl mr-1" style="color: #007bff;"></i>
                <strong class="me-auto">Berjaya</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                <p>Kemaskini baucar bayaran berjaya</p>
                </div>
            </div>
        </div>
    
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" id="click" method="POST">
        <div class="form-row">


            <?php
                include('config.php');
                $expense_id = $_GET['expense_id'];
                $query=mysqli_query($conn,"SELECT * FROM expense WHERE Expense_id = '$expense_id'");

                while($row=mysqli_fetch_array($query)){
                    $expense_type_id = $row['Expense_Type'];
                    $expense_bank = $row['bank_id'];
            ?>

            <div class="col">
            <label>No. Baucar</label>
            <input type="text" class="form-control" value="<?php echo $row['Expense_id']; ?>" placeholder="ID" disabled>
            <input type="text" name = "expense_id" class="form-control d-none" value="<?php echo $row['Expense_id']; ?>">
            </div>

            <div class="col">
            <label>Bayar Kepada</label>
            <input type="text" class="form-control" name="expense_to" value="<?php echo $row['Expense_To']; ?>" placeholder="Nama" required>
            </div>

            <div class="col">
            <label>Tarikh</label>
            <input type="date" name="expense_date" value="<?php echo $row['Expense_Date']; ?>" class="form-control">
            </div>

            <div class="col">
            <label>Amaun (RM)</label>
            <input type="text" name="expense_amount" class="form-control" value="<?php echo $row['Expense_Amount']; ?>" placeholder="Masukkan Amaun (contoh: 800)">
            </div>

            <div class="col">
            <label>Tajuk Akaun Perbelanjaan</label>

            <select name="expense_type" class="form-select mt-3" aria-label="Default select example">

            <?php
                $sql_query=mysqli_query($conn,"SELECT * FROM expense_type WHERE expense_type_id = '$expense_type_id'");
                while($row_2=mysqli_fetch_array($sql_query)){
            ?>
            
                <option value="<?php echo $row_2['expense_type_id']; ?>"><?php echo $row_2['expense_type']; ?></option>
            <?php 
            }
            ?>

            <?php
                $sql_query_option=mysqli_query($conn,"SELECT * FROM expense_type WHERE NOT expense_type_id = '$expense_type_id'");
                while($row_3=mysqli_fetch_array($sql_query_option)){
            ?>

                <option value="<?php echo $row_3['expense_type_id']; ?>"><?php echo $row_3['expense_type']; ?></option>

            <?php 
            }
            ?>

            </select>


            </div>

            <div class="col">
            <label>Tujuan Bayaran</label>
            <input type="text" name="expense_description" class="form-control" value="<?php echo $row['Expense_description']; ?>" placeholder="Tujuan Bayaran">
            </div>

            <div class="col">
            <label>Disediakan oleh</label>
            <input type="text" name="expense_prepare" class="form-control" value="<?php echo $row['Expense_prepare']; ?>" placeholder="Nama">
            </div>

            <div class="col">
            <label>Diluluskan oleh</label>
            <input type="text" name="expense_accept" class="form-control" value="<?php echo $row['accepted_by']; ?>" placeholder="Nama">
            </div>

            <div class="col mt-2">
            <label class="d-block">Akaun Bank</label>

            <select name="bank-type" class="form-select mt-3" aria-label="Default select example">

            <?php
                $sql_query=mysqli_query($conn,"SELECT * FROM bank WHERE bank_id = '$expense_bank'");
                while($row_2=mysqli_fetch_array($sql_query)){
            ?>
            
                <option selected value="<?php echo $row_2['bank_id']; ?>"><?php echo $row_2['bank_name']; ?></option>
            <?php 
            }
            ?>

            <?php
                $sql_query_option=mysqli_query($conn,"SELECT * FROM bank WHERE NOT bank_id = '$expense_bank'");
                while($row_3=mysqli_fetch_array($sql_query_option)){
            ?>

                <option value="<?php echo $row_3['bank_id']; ?>"><?php echo $row_3['bank_name']; ?></option>

            <?php 
            }
            ?>

            </select>
        
            </div>
            
            <div class="col mt-2 d-block">
            <label class="d-block">Kaedah Bayaran</label>
            
            <div class="btn-group btn-group-toggle mt-2" data-toggle="buttons">

            <?php if ($row['payment_method'] == 'tunai' ){ ?>
                <label class="btn btn-primary active">
                <input type="radio" value= "tunai" name="payment-method" id="option1" autocomplete="off" checked> Tunai
                </label>        
                <label class="btn btn-primary">
                <input type="radio" value= "e-payment" name="payment-method" id="option2" autocomplete="off"> E-Payment
                </label>    
            <?php }else{ ?>
                <label class="btn btn-primary">
                <input type="radio" value= "tunai" name="payment-method" id="option1" autocomplete="off"> Tunai
                </label>        
                <label class="btn btn-primary active">
                <input type="radio" value= "e-payment" name="payment-method" id="option2" autocomplete="off" checked> E-Payment
                </label>
            <?php } ?>

            </div>

            </div>

        </div>
            <a href="Akaun-Dashboard-View.php?bank_id=<?php echo $row['bank_id'];?>" class="btn btn-primary mt-5 ml-1"><i class="fa-solid fa-circle-chevron-left mr-1"></i>Kembali</a>
            <button type="submit" form="click" name="update" class="btn btn-primary mt-5"><i class="fa-solid fa-floppy-disk mr-1"></i>Kemaskini</button>
            
            <?php if($row['Expense_status'] == 'pending'){ ?>
                <a href="print.php?Expense_id=<?php echo $row['Expense_id'];?>" target="_blank" class="btn btn-primary mt-5 disabled"><i class="fa-solid fa-print mr-1"></i>Cetak</a>
                <p class="muted-color mt-2">*Sila dapatkan pengesahan dari pengerusi untuk mencetak baucar bayaran</p>
            <?php }else{?>
                <a href="print.php?Expense_id=<?php echo $row['Expense_id'];?>" target="_blank" class="btn btn-primary mt-5"><i class="fa-solid fa-print mr-1"></i>Cetak</a>
            <?php } ?>
            <?php } ?>

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