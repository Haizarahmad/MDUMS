<!DOCTYPE html>
<head>
  <link rel="icon" href="MDUMS (1).ico" type="image/x-icon">
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
    include('Admin_Session.php');
    ?>
    
    <div class="container-1">
        <div class="box-1">
            <div class="kariah-tool">
                <a href="Ahli-Kariah-Add.php" class="btn btn-primary mb-2"><i class="fa-solid fa-user-plus mr-1"></i>Tambah</a>
            </div>
            <table id="example" class="table table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Emel</th>
                        <th>Tarikh</th>
                        <th>Tetapan</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                    include('config.php');
                    $query=mysqli_query($conn,"SELECT * FROM permanentresident");
                    while($row=mysqli_fetch_array($query)){
                ?>
                    <tr>
                        <td><?php echo $row['application_id']; ?></td>
                        <td><?php echo $row['application_name']; ?></td>
                        <td><?php echo $row['application_status']; ?></td>
                        <td><?php echo $row['application_email']; ?></td>
                        <td><?php echo $row['application_date']; ?></td>
                        <td>
                            <a href="Ahli-kariah-View-Dashboard.php?application_id=<?php echo $row['application_id'];?>" class="btn btn-primary"><i class="fa-regular fa-eye mr-1"></i>Lihat</a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row['application_id']; ?>"><i class="fa-solid fa-trash-can mr-1"></i>Padam</a>
                        </td>
                    </tr>

                <div class="modal fade" id="staticBackdrop<?php echo $row['application_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ahli Kariah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Anda pasti untuk padam data ahli kariah ini?
                        </div>
                        <div class="modal-footer">
                        <a href="Delete_PermanentResident.php?application_id=<?php echo $row['application_id']; ?>" class="btn btn-primary">Padam</a>
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