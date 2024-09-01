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

    if(isset($_POST['update'])){
        $id = $_POST['income_id'];
        $type = $_POST['income_type'];
        $amount = $_POST['income_amount'];
        $description = $_POST['income_desc'];
        $date = $_POST['income_date'];
        $from = $_POST['income_from'];
        $method = $_POST['payment-method'];
        $bank = $_POST['bank-type'];

        echo $bank;
        echo $type;
        $sql = "UPDATE Income SET Income_Type ='$type' , Income_Amount='$amount', Income_Date='$date', Income_From='$from', Income_Description='$description', bank_id='$bank', payment_method='$method' WHERE Income_id = '$id' ";

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
        <h1>Baucar Resit</h1>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast">
                <div class="toast-header">
                <i class="fa-solid fa-square-check fa-xl mr-1" style="color: #007bff;"></i>
                <strong class="me-auto">Berjaya</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                <p>Kemaskini baucar resit berjaya</p>
                </div>
            </div>
        </div>

        <form id="click" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <div class="form-row">

            <?php
                include('config.php');
                $income_id = $_GET['income_id'];
                $query=mysqli_query($conn,"SELECT * FROM income WHERE Income_id = '$income_id'");

                while($row=mysqli_fetch_array($query)){
                    $income_type_id = $row['Income_Type'];
                    $income_bank = $row['bank_id'];
            ?>

            <div class="col">
            <label>No. Baucar</label>
            <input type="text" class="form-control" value="<?php echo $row['Income_id']; ?>" placeholder="ID" disabled>
            <input type="text" name = "income_id" class="form-control d-none" value="<?php echo $row['Income_id']; ?>" placeholder="ID">
            </div>

            <div class="col">
            <label>Diterima Daripada</label>
            <input type="text" class="form-control" name="income_from" value="<?php echo $row['Income_From']; ?>" placeholder="Nama">
            </div>

            <div class="col">
            <label>Tarikh</label>
            <input type="date" value="<?php echo $row['Income_Date']; ?>" name="income_date" class="form-control">
            </div>

            <div class="col">
            <label>Amaun (RM)</label>
            <input type="text" class="form-control" value="<?php echo $row['Income_Amount']; ?>" name="income_amount" placeholder="Amaun dibayar">
            </div>

            <div class="col">
            <label>Tajuk Akaun Penerimaan</label>
            <select name = "income_type" class="form-select mt-3" aria-label="Default select example">
            <?php
                $sql_query=mysqli_query($conn,"SELECT * FROM income_type WHERE income_type_id = '$income_type_id'");
                while($row_2=mysqli_fetch_array($sql_query)){
            ?>
            
                <option value="<?php echo $row_2['income_type_id']; ?>"><?php echo $row_2['income_type']; ?></option>
            <?php 
            }
            ?>

            <?php
                $sql_query_option=mysqli_query($conn,"SELECT * FROM income_type WHERE NOT income_type_id = '$income_type_id'");
                while($row_3=mysqli_fetch_array($sql_query_option)){
            ?>

                <option value="<?php echo $row_3['income_type_id']; ?>"><?php echo $row_3['income_type']; ?></option>

            <?php 
            }
            ?>

            </select>
            </div>

            <div class="col">
            <label>Tujuan Bayaran</label>
            <input type="text" class="form-control" value="<?php echo $row['Income_Description']; ?>" name="income_desc" placeholder="Tujuan Bayaran">
            </div>


            <div class="col mt-2">
            <label class="d-block">Akaun Bank</label>

            <select name="bank-type" class="form-select mt-3" aria-label="Default select example">

            <?php
                $sql_query=mysqli_query($conn,"SELECT * FROM bank WHERE bank_id = '$income_bank'");
                while($row_2=mysqli_fetch_array($sql_query)){
            ?>
            
                <option selected value="<?php echo $row_2['bank_id']; ?>"><?php echo $row_2['bank_name']; ?></option>
            <?php 
            }
            ?>

            <?php
                $sql_query_option=mysqli_query($conn,"SELECT * FROM bank WHERE NOT bank_id = '$income_bank'");
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
                <input type="radio" value= "tunai" name="payment-method" id="option1" autocomplete="on" checked> Tunai
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
            <button type="submit" name="update" form="click" class="btn btn-primary mt-5"><i class="fa-solid fa-floppy-disk mr-1"></i>Kemaskini</button>

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