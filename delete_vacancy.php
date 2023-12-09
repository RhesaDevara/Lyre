<?php
include 'koneksi_pdo.php';
$id_lowongan = $_GET['id_lowongan'];

$deletelowongan = $koneksiPdo->prepare("DELETE from lowongan_pekerjaan where id_lowongan = '$id_lowongan'");
$deletelowongan->execute();

echo "<script>alert('Data lowongan berhasil dihapus');</script>";
echo "<script>location='our_vacancy.php';</script>";
?>