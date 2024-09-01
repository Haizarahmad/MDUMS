<!DOCTYPE html>
<head>
  <link rel="icon" href="MDUMS.ico" type="image/x-icon">
  <link rel="stylesheet" href="Admin-Dashboard-Style.css" media="screen">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

    <?php 
    include ('Admin-Header.php'); 
    include('Admin_Session.php');
    ?>
    
    <div class="container-1">
        <div class="box-1">
            <h1>Notifikasi</h1>
            <table id="example" class="table table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Tarikh</th>
                        <th>Jenis Permohonan</th>
                        <th>Mesej</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                <?php
                        include('config.php');
                        $query = mysqli_query($conn, "SELECT * FROM expense WHERE Expense_status = 'pending' ORDER BY Expense_Date DESC");
                        while ($row = mysqli_fetch_array($query)) {
                ?>

                <tr>

                    <td>
                        <div class="form-check text-center">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        </div>
                    </td>
                    <td><?php echo $row['Expense_Date']; ?></td>
                    <td>Baucar Bayaran</td>
                    <td>Permohonan Baucar resit (No. baucar: <?php echo $row['Expense_id']; ?>)</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-3<?php echo $row['Expense_id'];?>"><i class="fa-regular fa-eye mr-1"></i>Lihat</button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row['Expense_id']; ?>"><i class="fa-solid fa-circle-check mr-1"></i>Terima</button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-2<?php echo $row['Expense_id']; ?>"><i class="fa-solid fa-trash-can mr-1"></i>Padam</button>
                    </td>

                </tr>

                <!-- Terima Button -->

                <div class="modal fade" id="staticBackdrop<?php echo $row['Expense_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Baucar Resit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Anda pasti untuk Terima baucar resit ini?
                        </div>
                        <div class="modal-footer">
                        <a href="Accept_CashVoucher.php?expense_id=<?php echo $row['Expense_id']; ?>" class="btn btn-primary">Terima</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Padam Button -->

                <div class="modal fade" id="staticBackdrop-2<?php echo $row['Expense_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Baucar Resit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Anda pasti untuk padam baucar resit ini?
                        </div>
                        <div class="modal-footer">
                        <a href="Delete_CashVoucher_admin.php?expense_id=<?php echo $row['Expense_id']; ?>" class="btn btn-primary">Padam</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- View Button -->
                <div class="modal fade" id="staticBackdrop-3<?php echo $row['Expense_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Baucar Bayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <div class="col">
                        <label>No. Baucar</label>
                        <input type="text" class="form-control" value="<?php echo $row['Expense_id']; ?>" placeholder="ID" disabled>
                        <input type="text" name = "expense_id" class="form-control d-none" value="<?php echo $row['Expense_id']; ?>">
                        </div>

                        <div class="col mt-4">
                        <label>Bayar Kepada</label>
                        <input type="text" class="form-control" name="expense_to" value="<?php echo $row['Expense_To']; ?>" placeholder="Nama">
                        </div>

                        <div class="col mt-4">
                        <label>Tarikh</label>
                        <input type="date" name="expense_date" value="<?php echo $row['Expense_Date']; ?>" class="form-control">
                        </div>

                        <div class="col mt-4">
                        <label>Amaun (RM)</label>
                        <input type="text" name="expense_amount" class="form-control" value="<?php echo $row['Expense_Amount']; ?>" placeholder="Amaun dibayar">
                        </div>

                        <div class="col mt-4">
                        <label>Tajuk Akaun Perbelanjaan</label>

                        <select name="expense_type" class="form-select mt-1" aria-label="Default select example">

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

                        <div class="col mt-4">
                        <label>Tujuan Bayaran</label>
                        <input type="text" name="expense_description" class="form-control" value="<?php echo $row['Expense_description']; ?>" placeholder="Tujuan Bayaran">
                        </div>

                        <div class="col mt-4">
                        <label>Disediakan oleh</label>
                        <input type="text" name="expense_prepare" class="form-control" value="<?php echo $row['Expense_prepare']; ?>" placeholder="Nama">
                        </div>

                        <div class="col mt-4">
                        <label>Diluluskan oleh</label>
                        <input type="text" name="expense_accept" class="form-control" value="<?php echo $row['accepted_by']; ?>" placeholder="Nama">
                        </div>

                        <div class="col mt-4">
                        <label class="d-block">Bank Akaun</label>

                        <select name="bank-type" class="form-select mt-1" aria-label="Default select example">

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
                        
                        <div class="col mt-4 d-block">
                        <label class="d-block">Kaedah Bayaran</label>
                        
                        <div class="btn-group btn-group-toggle mt-1" data-toggle="buttons">

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

                        <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark mr-1"></i>Tutup</button>
                        </div>
                    </div>
                    </div>
                </div>

                <?php
                    }
                ?> 

                </tbody>  

            </table>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
<footer>
<?php include ('footer.php'); ?>
</footer>
</html>