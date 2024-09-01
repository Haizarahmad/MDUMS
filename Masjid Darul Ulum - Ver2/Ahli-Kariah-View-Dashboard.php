<!DOCTYPE html>
<head>
  <link rel="icon" href="MDUMS.ico" type="image/x-icon">
  <link rel="stylesheet" href="Admin-Dashboard-Style.css" media="screen">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php 
    include ('admin-header.php');
    include('config.php');
    include('Admin_Session.php'); 

    if (isset($_POST["update"])) {

        $name = $_POST['name'];
        $date = date("Y-m-d");
        $age = $_POST['age'];
        $status = "pending";
        $nation = $_POST['nationality'];
        $marital = $_POST['marital'];
        $address = $_POST['address'];
        $phonenumber = $_POST['phone'];
        $email = $_POST['email'];
        $application_id = $_POST['id'];

        $sql = "UPDATE permanentresident SET 
        application_name ='$name',application_age='$age',application_religion='$nation',application_marital='$marital',application_address='$address',application_phonenumber='$phonenumber',application_email='$email',application_date='$date' WHERE application_id = '$application_id'";

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

    <div class="container-1">
        <div class="box-1">
        <div class="borang-ahli-kariah">
        <h1>Borang Ahli Kariah</h1>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast">
                <div class="toast-header">
                <i class="fa-solid fa-square-check fa-xl mr-1" style="color: #007bff;"></i>
                <strong class="me-auto">Berjaya</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                <p>Data ahli kariah sudah dikemaskini</p>
                </div>
            </div>
        </div>

        <form id = "click" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method = "POST" >
        <div class="form-row">

        
            <?php
            $application_id = $_GET['application_id'];
            include('config.php');
            $query=mysqli_query($conn,"SELECT * FROM permanentresident WHERE application_id = '$application_id' ");
            while($row=mysqli_fetch_array($query)){
            ?>

            <div class="col">
            <label>ID</label>
            <input type="text" class="form-control" value="<?php echo $row['application_id']; ?>" placeholder="ID" disabled>
            <input type="text" name="id" class="form-control visually-hidden" value="<?php echo $row['application_id']; ?>">
            </div>
            <div class="col">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="<?php echo $row['application_name']; ?>" placeholder="Nama">
            </div>
            <div class="col">
            <label>Umur</label>
            <input type="text" name="age" class="form-control" value="<?php echo $row['application_age']; ?>" placeholder="Umur">
            </div>
            <div class="col">
            <label>Hubungan</label>
            <select name="marital" class="form-select mt-3" aria-label="Default select example">
                <option selected><?php echo $row['application_marital']; ?></option>
                <option value="Bujang">Bujang</option>
                <option value="Berkahwin">Berkahwin</option>
                <option value="Bercerai">Bercerai</option>
            </select>
            </div>
            <div class="col">
            <label>Bangsa</label>
            <select name="nationality" class="form-select mt-3" aria-label="Default select example">
                <option selected><?php echo $row['application_religion']; ?></option>
                <option value="Melayu">Melayu</option>
                <option value="Melayu">Melayu</option>
                <option value="Melayu">Melayu</option>
            </select>
            </div>
            <div class="col">
            <label>E-mel</label>
            <input type="text" name="email" class="form-control" value="<?php echo $row['application_email']; ?>" placeholder="E-mel">
            </div>
            <div class="col">
            <label>Telefon</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $row['application_phonenumber']; ?>" placeholder="Telefon">
            </div>
            <div class="col">
            <label>Alamat</label>
            <input type="text" name="address" class="form-control" value="<?php echo $row['application_address']; ?>" placeholder="Alamat">
            </div>

            <?php
            }
            ?>
            
        </div>
            <a href="Ahli-Kariah-Dashboard.php" class="btn btn-primary mt-5 ml-1"><i class="fa-solid fa-circle-chevron-left mr-1"></i>Kembali</a>
            <button type="submit" form="click" name="update" class="btn btn-primary mt-5"><i class="fa-solid fa-floppy-disk mr-1"></i>Kemaskini</button>
        </form>
        
        </div>
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
</footer>
</html>