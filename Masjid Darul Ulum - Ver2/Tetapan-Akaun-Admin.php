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
    include ('admin-header.php');
    include('config.php');
    include('Admin_Session.php');
    ?>

    <?php
          if (isset($_POST['profile-update'])) {
              $username = $_POST['username'];
              $img = $_POST['current-img'];
              $email = $_POST['email'];
              $targetDir = "images/profile/admin/";
              $fileName = basename($_FILES["image"]["name"]);
              $targetFilePath = $targetDir . $fileName;
              $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

              echo $username;

              if (!empty($_FILES["image"]["name"])) {
                  // Allow certain file formats
                  $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                  if (in_array($fileType, $allowTypes)) {
                      // Upload file to server
                    $current_img = "images/profile/admin/".$img;

                        if (file_exists($current_img)) {
                            // Attempt to delete the file
                            if (unlink($current_img)) {

                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                                    // Insert image file name into database
                                    $sql = "UPDATE user SET user_username = '$username', profile_img = '$fileName', user_email = '$email' WHERE id = '1'";
                                    if (mysqli_query($conn, $sql)) {
                                        include ('Admin-Header.php');
                                        echo "<script>
                                        window.onload = function() {
                                        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                                        var toastList = toastElList.map(function(toastEl) {
                                          return new bootstrap.Toast(toastEl)
                                        })
                                        toastList.forEach(toast => toast.show()) 
                                        }; </script>";
                                    } else {
                                        echo '<script>alert("Error adding announcement to the database")</script>';
                                    }
                                } else {
                                    echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
                                }

                            } else {
                                echo "Unable to delete the file.";
                            }
                        } else {
                            echo "File does not exist.";
                        }

                  } else {
                      echo '<script>alert("Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.")</script>';
                  }
              } else {

                $sql = "UPDATE user SET user_username = '$username', user_email = '$email' WHERE id = '1'";
                if (mysqli_query($conn, $sql)) {
                    include ('Admin-Header.php');
                    echo "<script>
                    window.onload = function() {
                    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                    var toastList = toastElList.map(function(toastEl) {
                      return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show()) 
                    }; </script>";                    
                } else {
                    echo '<script>alert("Tidak dapat update")</script>';
                }

              }

          }
          ?>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast">
            <div class="toast-header">
            <i class="fa-solid fa-square-check fa-xl mr-1" style="color: #007bff;"></i>
            <strong class="me-auto">Berjaya</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
            <p>Kemaskini data telah berjaya</p>
            </div>
        </div>
    </div>


    <div class="container-1">
        <div class="box-1">
            <h1>Tetapan Akaun</h1>

            <div class="row mt-4">
                <div class="col-3">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Profil</a>
                    <a class="list-group-item list-group-item-action" id="list-guide-list" data-bs-toggle="list" href="#list-guide" role="tab" aria-controls="list-guide">Buku Panduan</a>
                    <a class="list-group-item list-group-item-action" id="list-language-list" data-bs-toggle="list" href="#list-language" role="tab" aria-controls="list-language">Bahasa</a>
                    </div>
                </div>

                <div class="col-8">

                    <div class="tab-content" id="nav-tabContent">
                    <!-- Profile section -->
                    <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <h1 class="mb-5" >Profil</h1>
                            <div class="col-6 px-0">
                                <div class="col mb-5">
                            <?php
                                $query=mysqli_query($conn,"SELECT * FROM user WHERE id = '1' ");
                                while($row=mysqli_fetch_array($query)){
                            ?>

                                <img src="images/profile/admin/<?php echo $row['profile_img']; ?>" class="rounded-circle" alt="" width="220" height="220">
                                </div>

                                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" id="profile" method="POST" enctype="multipart/form-data">
                                    <div class="col mb-4">
                                        <label for="formGroupExampleInput" class="form-label">Ubah Gambar Profil</label>
                                        <input type="file" name="image" id="image" accept="image/*" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        <input type="text" name="current-img" class="d-none form-control" value="<?php echo $row['profile_img'];?>">
                                    </div>
                                    <div class="col mb-4">
                                        <label for="formGroupExampleInput" class="form-label">Nama Pengguna</label>
                                        <input type="text" name="username" class="form-control" value="<?php echo $row['user_username'];?>" placeholder="Masukkan nama pengguna">
                                    </div>
                                    <div class="col mb-5">
                                        <label for="formGroupExampleInput" class="form-label">Emel</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo $row['user_email'];?>" placeholder="Masukkan emel yang sah">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary mb-3" name="profile-update" id= "profile-update" form="profile"><i class="fa-solid fa-pen-to-square mr-1"></i>Kemaskini</button>
                                    </div>
                                </form>

                            <?php
                            } 
                            ?>

                            </div>
                    </div>

                    <!-- Guide section -->
                    <div class="tab-pane fade" id="list-guide" role="tabpanel" aria-labelledby="list-guide-list">
                        <h1 class="mb-4">Buku Panduan</h1>
                        <p>Muat Turun Buku Panduan Masjid Darul Ulum Management System</p>
                        <a href="#" class="btn btn-primary"><i class="fa-solid fa-download mr-1"></i>Muat Turun</a>
                    </div>

                    <!-- Language section -->
                    <div class="tab-pane fade" id="list-language" role="tabpanel" aria-labelledby="list-language-list">
                        <h1 class="mb-4">Bahasa</h1>
                        <p>Sila pilih bahasa mengikut keinginan anda</p>
                    </div>

                    </div>
                </div>
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
<script src="form.js"></script>

</body>
<footer>
<?php include ('footer.php'); ?>
</footer>
</html>