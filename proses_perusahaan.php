<?php
session_start();
include 'koneksi_pdo.php';
$action = $_GET['action'];
$today = date("Y-m-d");
$id_perusahaan = $_GET['id_perusahaan'];
if ($action == 'review') {
    $id_admin = $_SESSION['admin']['id_admin'];
    $nama_admin = $_SESSION['admin']['nama'];
    $nama_perusahaan = $_GET['nama_perusahaan'];
    $sql = $koneksiPdo->prepare("UPDATE perusahaan set status_akun = 'Sedang Review' where id_perusahaan = '$id_perusahaan'");
    $sql->execute();

    $sql1 = $koneksiPdo->prepare("INSERT INTO konfirmasi_perusahaan (id_admin, id_perusahaan, nama_admin, nama_perusahaan, tanggal_mulai, status_akun) 
        values ('$id_admin', '$id_perusahaan', '$nama_admin', '$nama_perusahaan', '$today', 'Sedang Review')");
    $sql1->execute();
    echo "<script>alert('Perusahaan Sedang Direview!!');</script>";
    echo "<script>location='company.php';</script>";
} else if ($action == 'confirm') {
    $sql2 = $koneksiPdo->prepare("UPDATE perusahaan set status_akun = 'Sudah Aktif' where id_perusahaan = '$id_perusahaan'");
    $sql2->execute();

    $sql3 = $koneksiPdo->prepare("UPDATE konfirmasi_perusahaan set status_akun = 'Sudah Aktif', tanggal_selesai = '$today' where id_perusahaan = '$id_perusahaan'");
    $sql3->execute();

    echo "<script>alert('Perusahaan Telah Dikonfirmasi!!');</script>";
    echo "<script>location='company.php';</script>";
} else {

    $sql2 = $koneksiPdo->prepare("UPDATE perusahaan set status_akun = 'Ditolak' where id_perusahaan = '$id_perusahaan'");
    $sql2->execute();

    $sql4 = $koneksiPdo->prepare("UPDATE konfirmasi_perusahaan set status_akun = 'Ditolak', tanggal_selesai = '$today' where id_perusahaan = '$id_perusahaan'");
    $sql4->execute();
    echo "<script>alert('Perusahaan Telah Ditolak!!');</script>";
    echo "<script>location='company.php';</script>";
}
