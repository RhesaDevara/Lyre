<?php
include 'koneksi.php';
// Jika tombol daftar ditekan
if (isset($_POST["daftar"])) {
    $nama_perusahaan = $_POST["nama_perusahaan"];
    $email_perusahaan = $_POST["email_perusahaan"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];
    $no_telp = $_POST["no_telp"];
    $alamat_perusahaan = $_POST["alamat_perusahaan"];
    $deskripsi_perusahaan = $_POST["deskripsi_perusahaan"];

    // Cek konfirmasi password
    if ($password != $confirm_password) {
        echo "<script>alert('Pendaftaran Gagal, Email Perusahaan Sudah Digunakan');</script>";
        echo "<script>location='daftar_user.php';</script>";
        return false;
    }

    // Query untuk mengecek apakah email_perusahaan atau nama_perusahaan sudah digunakan sebelumnya
    $checkemail_perusahaanQuery = "SELECT * FROM perusahaan WHERE email_perusahaan='$email_perusahaan'";
    $checknama_perusahaanQuery = "SELECT * FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'";
    $email_perusahaanResult = $koneksi->query($checkemail_perusahaanQuery);
    $nama_perusahaanResult = $koneksi->query($checknama_perusahaanQuery);

    // Jika email_perusahaan atau nama_perusahaan sudah ada dalam database
    if ($email_perusahaanResult->num_rows > 0) {
        echo "<script>alert('Pendaftaran Gagal, email_perusahaan Sudah Digunakan');</script>";
        echo "<script>location='daftar_user.php';</script>";
    } elseif ($nama_perusahaanResult->num_rows > 0) {
        echo "<script>alert('Pendaftaran Gagal, nama_perusahaan Sudah Digunakan');</script>";
        echo "<script>location='daftar_user.php';</script>";
    } else {
        // Jika email_perusahaan dan nama_perusahaan belum pernah digunakan, lakukan pendaftaran
        $insertQuery = "INSERT INTO perusahaan (nama_perusahaan, email_perusahaan, password, nomor_telepon, alamat_perusahaan, deskripsi_perusahaan, kuota, status_akun) 
                        VALUES ('$nama_perusahaan', '$email_perusahaan', '$password', '$no_telp', '$alamat_perusahaan', '$deskripsi_perusahaan', 1 , 'Belum Review')";
        if ($koneksi->query($insertQuery) === TRUE) {
            echo "<script>alert('Pendaftaran Berhasil, Silahkan Login');</script>";
            echo "<script>location='login.php';</script>";
        } else {
            echo "<script>alert('Pendaftaran Gagal');</script>";
            echo "<script>location='daftar_company.php';</script>";
        }
    }
}
?>