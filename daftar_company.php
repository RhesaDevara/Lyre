<?php require 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .register-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .register-container .btn-primary {
            width: 100%;
        }

        .logo {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="register-container">
            <div class="logo">LYRE</div>
            <div class="text-center mb-4">
                <h4>Apply and Recruit</h4>
            </div>
            <form method="post" action="daftar_company_proses.php">
                <div class="mb-3">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" min="0" placeholder="Masukkan nama perusahaan" required>
                </div>
                <div class="mb-3">
                    <label for="email_perusahaan" class="form-label">Email Perusahaan</label>
                    <input type="email" class="form-control" id="email_perusahaan" name="email_perusahaan" placeholder="Masukkan email perusahaan" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Ulangi password untuk kofirmasi" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Alamat Perusahaan</label>
                    <input type="text" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Masukkan alamat perusahaan" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_perusahaan" class="form-label">Deskripsi Perusahaan</label>
                    <input type="text" class="form-control" id="deskripsi_perusahaan" name="deskripsi_perusahaan" placeholder="Masukkan deskripsi perusahaan" required>
                </div>
                <div class="mb-3 text-center">
                    <button name="daftar" type="submit" class="btn btn-primary">Register User</button>
                </div>
            </form>
            <div class="mb-3 text-center">
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
