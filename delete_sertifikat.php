<?php
include 'koneksi_pdo.php';
$id_sertifikat = $_GET['id_sertifikat'];

$deleteSertifikat = $koneksiPdo->prepare("DELETE FROM sertifikat where id_sertifikat = '$id_sertifikat'");
$deleteSertifikat->execute();

echo "<script>alert('Data Sertifikat berhasil dihapus');</script>";
echo "<script>location='user_profile.php';</script>";
