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
    include ('Treasurer-Header.php'); 
    include('Treasurer_Session.php');
    ?>

    
    <div class="container-1">
        <div class="box-1">
        <div class="borang-ahli-kariah">
        <h1>Baucar Resit</h1>

        <form action="Baucar-Resit-Add-Data.php" id="click" method="POST" >
        <div class="form-row">

            <div class="col">
            <label>No. Baucar</label>
            <input type="text" class="form-control" disabled>
            </div>

            <div class="col">
            <label>Diterima Daripada</label>
            <input type="text" class="form-control" name="income_from" placeholder="Nama">
            </div>

            <div class="col">
            <label>Tarikh</label>
            <input type="date" name="income_date" class="form-control">
            </div>

            <div class="col">
            <label>Amaun (RM)</label>
            <input type="text" class="form-control" name="income_amount" placeholder="Amaun dibayar">
            </div>

            <div class="col">
            <label>Tajuk Akaun Penerimaan</label>
            <select name="income_type" class="form-select mt-3" aria-label="Default select example">     
            <option selected></option>
            <?php
                include('config.php');
                $sql_query=mysqli_query($conn,"SELECT * FROM income_type");
                while($row_2=mysqli_fetch_array($sql_query)){
            ?>  
                <option value="<?php echo $row_2['income_type_id']?>"><?php echo $row_2['income_type']?></option>
            
            <?php } ?>
            </select>
            </div>

            <div class="col">
            <label>Tujuan Bayaran</label>
            <input type="text" name="income_desc" class="form-control" placeholder="Tujuan Bayaran">
            </div>

            <div class="col mt-2">
            <label class="d-block">Akaun Bank</label>

            <select name="bank-type" class="form-select mt-3" aria-label="Default select example">
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
                <input type="radio" value= "tunai" name="payment-method" id="option1" autocomplete="off" checked> Tunai
                </label>   
                
                <label class="btn btn-primary">
                <input type="radio" value= "e-payment" name="payment-method" id="option2" autocomplete="off" checked> E-Payment
                </label>

            </div>
            </div>
 

        </div>
            <a href="Akaun-Dashboard-View.php?bank_id=1" class="btn btn-primary mt-5 ml-1"><i class="fa-solid fa-circle-chevron-left mr-1"></i>Kembali</a>
            <button class="btn btn-primary mt-5" name= "add" type = "submit" form="click"><i class="fa-solid fa-circle-plus mr-1"></i>Tambah</button>
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
<script src="script.js"></script>
</body>
<footer>
</footer>
</html>