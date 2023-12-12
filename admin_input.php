<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="text-left mb-3 mt-3">
                    <a href="admin.php" title="Back To Admin List" data-toggle="tooltip"><i class="fa-solid fa-arrow-left fa-2xl" style="color: #20444F;"></i></a>
                </div>
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Tambah <b>Admin</b></h2>
                        </div>
                    </div>
                </div>
                <form method="POST" action="admin_process.php">
                    <div class="mb-3">
                        <label for="na me" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label mt-2">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-3">
                        <label for="hak_akses" class="form-label mt-2">Hak Akses</label><br>
                        <select name="hak_akses" id="hak_akses" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="Superadmin">Superadmin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label mt-2">Kata Sandi</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label mt-2">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" name="confirm-password" placeholder="Konfirmasi Password" required>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-success w-100">Tambah Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>