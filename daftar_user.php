<?php require 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Register</title>
    <link href="https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/css.css" rel="stylesheet">
</head>

<body>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border border-light shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6 bg-login-register text-white">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-10 col-xl-8 py-3 text-center">
                                <a href="index.php"><img class="img-fluid rounded mb-4" loading="lazy" title="Back To Home" data-toggle="tooltip" src="assets/img/logo2.png" width="245" height="80" alt=""></a>
                                <hr class="border border-light mb-4">
                                <h2 class="h3 mb-4">Anda sedang berada di halaman <br>Daftar Pelamar</h2>
                                <p class="lead m-0 mb-3">Ingin daftar sebagai Perusahaan? <br><a class="link-offset-2 link-offset-3-hover link-underline-light text-light" href="daftar_company.php">
                                        Lewat sini!!!</a>
                                </p>
                                <p class="lead m-0">Sudah punya akun?<br><a class="link-offset-2 link-offset-3-hover link-underline-light text-light" href="login.php">Masuk Disini!!!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card border border-light shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title mb-3">Daftar Pelamar</h3>
                                <form method="post">
                                    <div class="mb-3">
                                        <label for="nin" class="form-label">NIK <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="nin" name="nin" min="0" placeholder="Enter your national identification number" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm-password" class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-grid">
                                            <button name="daftar" type="submit" class="btn btn-login-register">Daftar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script>
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
    $alamat = $_POST["address"];

    $birthdate = $_POST['dob'];

    $birthdateObj = new DateTime($birthdate);

    // Dapatkan tanggal hari ini dengan zona waktu Asia/Jakarta
    $timezone = new DateTimeZone('Asia/Jakarta');
    $now = new DateTime('now', $timezone);

    // Hitung selisih antara tanggal lahir dan tanggal hari ini
    $age = $now->diff($birthdateObj)->y;

    if ($age >= 18) {
        // Cek konfirmasi password
        if ($password != $confirm_password) {
            echo "<script>alert('Pendaftaran Gagal, Kata Sandi Tidak Sesuai!!');</script>";
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
            $insertQuery = "INSERT INTO pengguna (foto, nik, nama, tanggal_lahir, email, password, nomor_telepon, alamat) 
                        VALUES ('photo/profile.png', '$nik', '$nama', '$dob', '$email', '$password', '$phone', '$alamat')";
            if ($koneksi->query($insertQuery) === TRUE) {
                echo "<script>alert('Pendaftaran Berhasil, Silahkan Login');</script>";
                echo "<script>location='login.php';</script>";
            } else {
                echo "<script>alert('Pendaftaran Gagal');</script>";
                echo "<script>location='daftar_user.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Pendaftaran Gagal. Umur belum cukup.');</script>";
    }
}
?>