<?php
    include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>
    <style>
        div,label, h2{
            color: black;
        }
        </style>
</head>
<body>
    <center>
        <h2 class="mt-5"> Buat Lowongan Baru </h2>
    <form action="new_vacancy_process.php" method="post">
    <div class="mt-5 px-5"  style="width:75%;text-align:left;">
    <div class="mb-3">
        <label for="posisi" class="form-label mt-2">Posisi</label>
        <input type="text" class="form-control" name="posisi" placeholder="Masukkan posisi" required>
    </div>
    <div class="mb-3">
        <label for="departemen" class="form-label">Departemen</label>
        <input type="text" class="form-control" name="departemen" placeholder="Masukkan departemen" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi_pekerjaan" class="form-label mt-2">Deskripsi Pekerjaan</label>
        <input type="text" class="form-control" name="deskripsi_pekerjaan" placeholder="Masukkan deskripsi pekerjaan" required>
    </div>
    <div class="mb-3">
        <label for="gaji" class="form-label mt-2">Gaji</label>
        <input type="number" class="form-control" name="gaji" placeholder="Masukkan gaji" required>
    </div>
    <div class="mb-3">
        <label for="lokasi_pekerjaan" class="form-label mt-2">Lokasi Pekerjaan</label>
        <input type="text" class="form-control" name="lokasi_pekerjaan" placeholder="Masukkan lokasi pekerjaan" required>
    </div>

    <div class="mb-3">
        <input type="submit" class="form-control btn btn-primary" value="Buat Lowongan">
    </div>
    
    </div>

</form>
</body>
</html>