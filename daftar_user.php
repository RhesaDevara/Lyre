<?php include 'koneksi.php'; ?>

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
            <form method="post">
                <div class="mb-3">
                    <label for="nin" class="form-label">National Identification Number</label>
                    <input type="number" class="form-control" id="nin" name="nin" min="0" placeholder="Enter your national identification number" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-3">
                    <label for="education" class="form-label">Education</label>
                    <input type="text" class="form-control" id="education" name="education" placeholder="Enter your education" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
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

<?php
// Jika tombol daftar ditekan
if (isset($_POST["daftar"])) {
    $nik = $_POST["nin"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];
    $nama = $_POST["name"];
    $dob = $_POST["dob"];
    $phone = $_POST["phone"];
    $pendidikan = $_POST["education"];
    $alamat = $_POST["address"];

    // Cek konfirmasi password
    if ($password != $confirm_password) {
        echo "<script>alert('Pendaftaran Gagal, Email Sudah Digunakan');</script>";
        echo "<script>location='daftar_user.php';</script>";
        return false;
    }

    // Query untuk mengecek apakah email atau NIN sudah digunakan sebelumnya
    $checkEmailQuery = "SELECT * FROM pengguna WHERE email='$email'";
    $checkNINQuery = "SELECT * FROM pengguna WHERE nik='$nin'";
    $emailResult = $koneksi->query($checkEmailQuery);
    $ninResult = $koneksi->query($checkNINQuery);

    // Jika email atau NIN sudah ada dalam database
    if ($emailResult->num_rows > 0) {
        echo "<script>alert('Pendaftaran Gagal, Email Sudah Digunakan');</script>";
        echo "<script>location='daftar_user.php';</script>";
    } elseif ($ninResult->num_rows > 0) {
        echo "<script>alert('Pendaftaran Gagal, NIN Sudah Digunakan');</script>";
        echo "<script>location='daftar_user.php';</script>";
    } else {
        // Jika email dan NIN belum pernah digunakan, lakukan pendaftaran
        $insertQuery = "INSERT INTO pengguna (nik, nama, tanggal_lahir, email, password, nomor_telepon, alamat, pendidikan_terakhir) 
                        VALUES ('$nik', '$nama', '$dob', '$email', '$password', '$phone', '$alamat', '$pendidikan')";
        if ($koneksi->query($insertQuery) === TRUE) {
            echo "<script>alert('Pendaftaran Berhasil, Silahkan Login');</script>";
            echo "<script>location='login.php';</script>";
        } else {
            echo "<script>alert('Pendaftaran Gagal');</script>";
            echo "<script>location='daftar_user.php';</script>";
        }
    }
}
?>
