<!DOCTYPE html>
<head>
  <link rel="icon" href="MDUMS (1).ico" type="image/x-icon">
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
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
    include ('admin-header.php'); 
    include('Admin_Session.php');
    ?>

    <div class="container-1">
        <div class="box-1">
            <h1>Bilangan Pemohon</h1>
            <div class="chart-js-bottom">
                <canvas id="myChart-2"></canvas>
            </div>
        </div>

        <div class="box-1">
            <h1>Bilangan Baucar Resit</h1>
            <div class="chart-js-bottom">
                <canvas id="myChart-3"></canvas>
            </div>
        </div>

        <div class="box-1">
            <h1>Bilangan pembaca untuk setiap berita</h1>
            <div class="chart-js-top">
                <canvas id="myChart-4"></canvas>
            </div>
        </div>
    
    </div>

    <div class="container-2">
      
    <div class="box-2">
        <h1>Notifikasi</h1>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
        <i class="fa-solid fa-circle-exclamation fa-lg mr-2"></i>
        <div>
          Anda telah menerima baucar bayaran! sila pergi ke notifikasi untuk tindakan yang selanjutnya.
        </div>
        </div>
    </div>

    <div class="box-2">
        <h1>Pengumuman</h1>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          Buka Tetapan untuk mengemaskini profil anda, sila abaikan mesej ini jika selesai
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          Sebarang aduan berkaitan dengan sistem boleh dihantar <a target="_blank" href="https://forms.gle/GstfWu4SwchaAK6y9">disini</a>, Terima Kasih
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
              
    <script>

      const ctx2 = document.getElementById('myChart-2');

      new Chart(ctx2, {
        type: 'pie',
        data: {
          labels: ['Diterima', 'Ditolak', 'Diproses'],
          datasets: [{
            label: 'Jumlah',
            data: [5, 2, 4],
            borderWidth: 1
          }]
        }
      });

      const ctx3 = document.getElementById('myChart-3');

      new Chart(ctx3, {
        type: 'pie',
        data: {
          labels: ['Diterima', 'Ditolak', 'Diproses'],
          datasets: [{
            label: 'Jumlah',
            data: [15, 20, 10],
            borderWidth: 1
          }]
        }
      });

      const ctx4 = document.getElementById('myChart-4');

      new Chart(ctx4, {
        type: 'bar',
        data: {
          labels: ['Diterima', 'Ditolak', 'Diproses'],
          datasets: [{
            label: 'Jumlah',
            data: [15, 20, 10],
            borderWidth: 1
          }]
        }
      });
    </script>

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
<?php include ('footer.php'); ?>
</footer>
</html>