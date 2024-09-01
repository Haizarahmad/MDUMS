<!DOCTYPE html>
<head>
  <link rel="icon" href="MDUMS.ico" type="image/x-icon">
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
  <link rel="stylesheet" href="Admin-Dashboard-Style.css" media="screen">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php 
    include ('Treasurer-Header.php'); 
    include('Treasurer_Session.php');
    ?>

    <div class="bank-account-details">
        <div class = "bank-details">

            <div class="chart-js-bottom">
            <?php
            include('config.php');
            $bank_id = $conn->real_escape_string($_GET['bank_id']);
            $query_total=mysqli_query($conn,"SELECT SUM(expense.Expense_Amount) AS total, 'Perbelanjaan' AS type FROM expense WHERE bank_id='$bank_id' UNION SELECT SUM(income.Income_Amount) AS total, 'Penerimaan' AS type FROM income WHERE bank_id='$bank_id'");

            foreach($query_total as $data){
              $total_type[] = $data['type'];
              $transaction_total[] = $data['total'];
            }

            ?>

            <canvas id="myChart-3"></canvas>   
            </div>
          
  

            <?php
            $query=mysqli_query($conn,"SELECT * FROM bank WHERE bank_id = $bank_id");
            while($row=mysqli_fetch_array($query)){ 
            ?>

            <div class="card-info mt-5">
              <p class="card-info-items muted-color" >Akaun</p>
              <p class="card-info-items text-end font-weight-bold" ><?php echo $row['bank_name'];?></p>
              <p class="card-info-items muted-color" >Status</p>
              <p class="card-info-items text-end font-weight-bold" >Aktif</p>
            </div>

            <?php
            }
            ?>

            <div class="dropdown mt-2">

                <a class="btn btn-primary dropdown-toggle mb-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-building-columns mr-1"></i>Pilih Akaun
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                <?php
                include('config.php');
                $bank_id = $_GET['bank_id'];
                $query=mysqli_query($conn,"SELECT * FROM bank");

                while($row=mysqli_fetch_array($query)){
                ?>
                  <a class="dropdown-item" href="Akaun-Dashboard-View.php?bank_id=<?php echo $row['bank_id'];?>"><?php echo $row['bank_name'];?></a>
                <?php
                }
                ?>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="Bank-Akaun-add.php">Tambah Akaun</a>

                </div>

            </div>
            <div class="dropdown mt-2">

            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-circle-plus mr-1"></i>Tambah Transaksi
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="Baucar-Bayaran-Add.php">Baucar Bayaran</a>
              <a class="dropdown-item" href="Baucar-Resit-Add.php">Baucar Resit</a>
            </div>

            </div>

        </div>
    </div>

<div class="bank-container">
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert" style="width:100%">
          Buka Tetapan untuk mengemaskini profil anda, sila abaikan mesej ini jika selesai
          <button type="button" class="btn-close button-alert" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="width:100%">
          Sebarang aduan berkaitan dengan sistem boleh dihantar <a target="_blank" href="https://forms.gle/GstfWu4SwchaAK6y9">disini</a>, Terima Kasih
          <button type="button" class="btn-close button-alert" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
</div>

<div class="category-table">
<div class="box-1">
    <h1>Baucar Bayaran</h1>
    
    <div class="chart-js-top">
        <canvas id="myChart"></canvas>
          
        <?php
          $query =mysqli_query($conn,"SELECT Expense_Date AS date, SUM(Expense_Amount) AS amount FROM expense WHERE bank_id = '$bank_id' GROUP BY date ORDER BY date ASC;");
          //SELECT Income_Date AS date, Income_Amount AS amount FROM income WHERE bank_id = '1' AND Income_Date BETWEEN '2024-01-23' AND '2024-01-24' ORDER BY income_date ASC;
          foreach($query as $data){    

              $expense_amount[] = $data['amount'];
              $expense_month[] = $data['date'];

          }
        ?>   
        </div>   
    
</div>

<div class="box-1">
    <h1>Baucar Resit</h1>
    <div class="chart-js-top">
        <canvas id="myChart-4"></canvas>

        <?php
          $query =mysqli_query($conn,"SELECT Income_Date AS date, SUM(Income_Amount) AS amount FROM income WHERE bank_id = '$bank_id' GROUP BY date ORDER BY date ASC;");
          //SELECT Income_Date AS date, Income_Amount AS amount FROM income WHERE bank_id = '1' AND Income_Date BETWEEN '2024-01-23' AND '2024-01-24' ORDER BY income_date ASC;
          foreach($query as $data){    
          
              $income_amount[] = $data['amount'];
              $income_month[] = $data['date'];

          }
        ?>   
           </div>
</div>

</div>

<div class="category-table">

<div class="box-1">
    <h1>Jumlah Bayaran Berdasarkan Kategori</h1>
    <div class="chart-js-bottom">
        <canvas id="myChart-2"></canvas>

        <?php
        $query = mysqli_query($conn,
        "SELECT COUNT(expense.Expense_Type) AS total, expense.Expense_Type AS type, expense_type.expense_type AS type_name
        FROM expense
        INNER JOIN expense_type ON expense.Expense_Type = expense_type.expense_type_id
        WHERE expense.bank_id = '$bank_id'
        GROUP BY expense.Expense_Type, expense_type.expense_type;");

        foreach($query as $data){
          $expense_type[] = $data['type_name'];
          $expense_total[] = $data['total'];
        }

        ?>
    </div>
</div>

<div class="box-1">
    <h1>Jumlah Resit Berdasarkan Kategori</h1>
    <div class="chart-js-bottom">
        <canvas id="myChart-5"></canvas>

        <?php
        $query = mysqli_query($conn,
        "SELECT COUNT(income.Income_Type) AS total, income.Income_Type AS type, income_type.income_type AS type_name
        FROM income
        INNER JOIN income_type ON income.Income_Type = income_type.income_type_id
        WHERE income.bank_id = '$bank_id'
        GROUP BY income.Income_Type, income_type.income_type;");

        foreach($query as $data){
          $income_type[] = $data['type_name'];
          $income_total[] = $data['total'];
        }

        ?>

    </div>
</div>

</div>



<div class="transaction-table">


<div class="box-1">
    <h1>Baucar Bayaran</h1>
    <table id="example" class="table table-striped nowrap" style="width:100%">

        <thead>
            <tr>
                <th>ID</th>
                <th>Tujuan Bayaran</th>
                <th>Tarikh</th>
                <th>Status</th>
                <th>Amaun (RM)</th>
                <th>Tetapan</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $query = mysqli_query($conn, "SELECT * FROM expense WHERE bank_id = '$bank_id' ORDER BY Expense_Date DESC");
            while ($row = mysqli_fetch_array($query)) {
            ?>

                <tr>
                    <td><?php echo $row['Expense_id']; ?></td>
                    <td><?php echo $row['Expense_description']; ?></td>
                    <td><?php echo $row['Expense_Date']; ?></td>
                    <?php if($row['Expense_status'] == 'pending') {?>

                    <td>
                      <span  data-bs-toggle="tooltip" data-bs-placement="top" title="Pending">
                      <i class=" fa-solid fa-hourglass-half" style="color: #FFD43B;"></i>
                      <p class="visually-hidden">pending</p>
                      </span>
                    </td>
                      <?php }else{ ?>
                    <td>
                      <span data-bs-toggle="tooltip" data-bs-placement="top" title="Accepted">
                      <i class = "fa-solid fa-circle-check" style="color: #90f316;"></i>
                      <p class="visually-hidden">accepted</p>
                      </span>
                    </td>
                      <?php } ?>

                    <td><?php echo $row['Expense_Amount']; ?></td>
                    <td>
                        <a href="Baucar-Bayaran-View.php?expense_id=<?php echo $row['Expense_id']; ?>" class="btn btn-primary"><i class="fa-regular fa-eye mr-1"></i>Lihat</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row['Expense_id']; ?>"><i class="fa-solid fa-trash-can mr-1"></i>Padam</button>
                    </td>
                </tr>

        <div class="modal fade" id="staticBackdrop<?php echo $row['Expense_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Baucar Bayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Anda pasti untuk padam baucar bayaran ini?
            </div>
            <div class="modal-footer">
            <a href="Delete_CashVoucher_Treasurer.php?expense_id=<?php echo $row['Expense_id']; ?>" class="btn btn-primary">Padam</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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

<div class="box-1">
    <h1>Baucar Resit</h1>
    <table id="example-2" class="table table-striped nowrap" style="width:100%">

        <thead>
            <tr>
                <th>ID</th>
                <th>Tujuan Bayaran</th>
                <th>Tarikh</th>
                <th>Amaun (RM)</th>
                <th>Tetapan</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $query = mysqli_query($conn, "SELECT * FROM income WHERE bank_id = '$bank_id' ORDER BY Income_Date DESC");
            while ($row = mysqli_fetch_array($query)) {
            ?>

                <tr>
                    <td><?php echo $row['Income_id']; ?></td>
                    <td><?php echo $row['Income_Description']; ?></td>
                    <td><?php echo $row['Income_Date']; ?></td>
                    <td><?php echo $row['Income_Amount']; ?></td>
                    <td>
                        <a href="Baucar-Resit-View.php?income_id=<?php echo $row['Income_id']; ?>" class="btn btn-primary"><i class="fa-regular fa-eye mr-1"></i>Lihat</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-2<?php echo $row['Income_id']; ?>"><i class="fa-solid fa-trash-can mr-1"></i>Padam</button>
                    </td>
                </tr>

              <div class="modal fade" id="staticBackdrop-2<?php echo $row['Income_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <a href="Delete_CashReceipt_Treasurer.php?expense_id=<?php echo $row['Income_id']; ?>" class="btn btn-primary">Padam</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
         
    <script>
      const dateArrayJS = <?php echo json_encode($expense_month)?>;
      
      const dateChartJS = dateArrayJS.map((day, index) => {
        let dayjs = new Date(day);
        return dayjs.setHours(0,0,0,0);
      });

      const dateArrayJS2 = <?php echo json_encode($income_month)?>;
      
      const dateChartJS2 = dateArrayJS2.map((day, index) => {
        let dayjs = new Date(day);
        return dayjs.setHours(0,0,0,0);
      });

      
      const ctx = document.getElementById('myChart');

      new Chart(ctx, {
        type: 'line',
        data: {
          labels: dateChartJS,
          datasets: [{
            label: 'RM',
            data: <?php echo json_encode($expense_amount)?>,
            backgroundColor: [
              'rgb(255, 107, 107)'
            ],borderColor: 'rgb(255, 107, 107)',
            fill: false,
            tension: 0.4
          }]
        },options: {
        scales: {
            x: {
                type: 'time',
                time:{
                  unit: 'day'
                }
            },
            y: {
              beginAtZero: true
            }
        }
      }
      });

      const ctx2 = document.getElementById('myChart-2');

      new Chart(ctx2, {
        type: 'doughnut',
        data: {
          labels: <?php echo json_encode($expense_type)?>,
          datasets: [{
            label: 'Jumlah Transaksi',
            data: <?php echo json_encode($expense_total)?>,
          }]

        },
      });

      const ctx3 = document.getElementById('myChart-3');

      new Chart(ctx3, {
        type: 'pie',
        data: {
          labels: <?php echo json_encode($total_type)?>,
          datasets: [{
            label: 'RM',
            data: <?php echo json_encode($transaction_total)?>,
            backgroundColor: [
              'rgb(255, 107, 107)',
              'rgb(107, 203, 119)'
            ]
          }]
        },
      });

      const ctx4 = document.getElementById('myChart-4');

      new Chart(ctx4, {
        type: 'line',
        data: {
          labels: dateChartJS2,
          datasets: [{
            label: 'RM',
            data: <?php echo json_encode($income_amount)?>,
            backgroundColor: [
              'rgb(107, 203, 119)'
            ],borderColor: 'rgb(107, 203, 119)',
            fill: false,
            tension: 0.4
          }]
        },options: {
        scales: {
            x: {
                type: 'time',
                time:{
                  unit: 'day'
                }
            },
            y: {
              beginAtZero: true
            }
        }
      }
      });

      const ctx5 = document.getElementById('myChart-5');

      new Chart(ctx5, {
        type: 'doughnut',
        data: {
          labels: <?php echo json_encode($income_type)?>,
          datasets: [{
            label: 'Jumlah Transaksi',
            data: <?php echo json_encode($income_total)?>,
          }]

        },
      });
    </script>

<script>
const tooltipTrigger = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipContent = [...tooltipTrigger].map(tooltipE1 => new bootstrap.Tooltip(tooltipE1));
</script>

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
<?php include ('footer.php'); ?>
</footer>

</html>