<?php
require 'koneksi_pdo.php';
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$conf_password = $_POST['confirm-password'];
$hak_akses = $_POST['hak_akses'];

$sqlCekAdmin = $koneksiPdo->prepare("SELECT count(*) FROM admin where email = '$email'");
$sqlCekAdmin->execute();

$sqlCekPengguna = $koneksiPdo->prepare("SELECT count(*) FROM pengguna where email = '$email'");
$sqlCekPengguna->execute();

$sqlCekPerusahaan = $koneksiPdo->prepare("SELECT count(*) FROM perusahaan where email_perusahaan = '$email'");
$sqlCekPerusahaan->execute();

$cekAdmin = $sqlCekAdmin->fetchColumn();
$cekPengguna = $sqlCekPengguna->fetchColumn();
$cekPerusahaan = $sqlCekPerusahaan->fetchColumn();
if ($password == $conf_password) {
    if ($cekAdmin == 0 && $cekPengguna == 0 && $cekPerusahaan == 0) {
        $sql = ('insert into admin (nama,email,password,hak_akses) values (?,?,?,?)');
        $row = $koneksiPdo->prepare($sql);
        $row->execute(array($name, $email, $password, $hak_akses));
        header('location:admin.php');
    } else {
        echo "<script>alert('Email telah terdaftar. Silahkan gunakan email lain!');</script>";
        echo "<script>location='admin.php';</script>";
    }
}
